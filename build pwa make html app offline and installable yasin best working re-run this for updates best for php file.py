import os
import json
import hashlib
from PIL import Image
from bs4 import BeautifulSoup

SOURCE_LOGO_PATH = r"logo.jpg"
PROJECT_DIR = os.path.dirname(os.path.abspath(__file__))
APP_NAME = "My Web App"
SHORT_NAME = "WebApp"
APP_DESCRIPTION = "A description of the web application."
BACKGROUND_COLOR = "#ffffff"
THEME_COLOR = "#007bff"
VERSION = "2.0.0"  # PHP compatible version

def get_file_hash(path):
    hasher = hashlib.md5()
    try:
        with open(path, 'rb') as f:
            buf = f.read()
            hasher.update(buf)
        return hasher.hexdigest()
    except Exception as e:
        print(f"   ❌ Could not hash file {os.path.basename(path)}: {e}")
        return None

def generate_pwa_icons(source_path, output_dir):
    print("--- 1. Generating PWA Icons ---")
    if not os.path.exists(source_path):
        print(f"❌ Error: Source logo not found at '{source_path}'.")
        return []
    icon_sizes = [72, 96, 128, 144, 152, 192, 384, 512]
    generated_icons, icon_metadata = [], []
    try:
        with Image.open(source_path) as logo:
            logo = logo.convert("RGBA")
            for size in icon_sizes:
                filename = f"icon-{size}.png"
                output_path = os.path.join(output_dir, filename)
                canvas = Image.new("RGBA", (size, size), (0, 0, 0, 0))
                logo_copy = logo.copy()
                logo_copy.thumbnail((size, size))
                left = (size - logo_copy.width) // 2
                top = (size - logo_copy.height) // 2
                canvas.paste(logo_copy, (left, top))
                canvas.save(output_path, "PNG")
                print(f"✅ Created: {filename}")
                file_hash = get_file_hash(output_path)
                if file_hash:
                    generated_icons.append({"url": filename, "revision": file_hash})
                icon_metadata.append({"src": filename, "sizes": f"{size}x{size}", "type": "image/png"})
        return generated_icons, icon_metadata
    except Exception as e:
        print(f"❌ Error generating icons: {e}")
        return [], []

def generate_favicon(source_path, output_dir):
    print("\n--- Generating favicon.ico ---")
    try:
        if not os.path.exists(source_path):
            print(f"❌ Error: Source logo not found at '{source_path}'.")
            return None
        with Image.open(source_path) as logo:
            logo = logo.convert("RGBA")
            logo = logo.resize((48, 48))
            favicon_path = os.path.join(output_dir, "favicon.ico")
            logo.save(favicon_path, format='ICO')
            print(f"✅ Created: favicon.ico")
            return "favicon.ico"
    except Exception as e:
        print(f"❌ Error creating favicon.ico: {e}")
        return None

def discover_assets(project_dir, generated_icons):
    print(f"\n--- 2. Discovering App Files and Generating Hashes ---")
    precache_list = generated_icons[:]
    existing_urls = {entry['url'] for entry in precache_list}
    php_files = []
    
    for root, _, files in os.walk(project_dir):
        if any(part.startswith('.') for part in root.split(os.sep)):
            continue
        for file in files:
            file_path = os.path.join(root, file)
            relative_path = os.path.relpath(file_path, project_dir).replace("\\", "/")
            if relative_path in existing_urls:
                continue
            if file.endswith(".php"):   # << changed from .html to .php
                php_files.append(file_path)
            file_hash = get_file_hash(file_path)
            if file_hash:
                precache_list.append({"url": relative_path, "revision": file_hash})
                existing_urls.add(relative_path)
    if not php_files:
        print("❌ Error: No PHP files found.")
        return [], []
    print(f"✅ Discovered and hashed {len(precache_list)} local files.")
    return precache_list, php_files

def create_manifest(output_dir, icon_metadata, php_files):
    print("\n--- 3. Creating manifest.json ---")
    start_url, app_title_from_html, app_description_from_html = "index.php", None, None
    potential_mains = [f for f in php_files if "index.php" in f.lower()] or php_files
    if not potential_mains:
        print("❌ Error: No suitable start file (like index.php) found.")
        return
    start_file_path = potential_mains[0]
    start_url = os.path.relpath(start_file_path, output_dir).replace("\\", "/")
    try:
        with open(start_file_path, 'r', encoding='utf-8', errors='ignore') as f:
            soup = BeautifulSoup(f.read(), 'html.parser')
            if soup.title and soup.title.string:
                app_title_from_html = soup.title.string.strip()
                print(f"✅ Detected App Title: '{app_title_from_html}'")
            meta_desc = soup.find("meta", attrs={"name": "description"})
            if meta_desc and meta_desc.get("content"):
                app_description_from_html = meta_desc["content"].strip()
                print(f"✅ Detected Description: '{app_description_from_html}'")
    except Exception as e:
        print(f"⚠️ Could not read title/description from PHP: {e}")
    manifest = {
        "name": app_title_from_html or APP_NAME,
        "short_name": app_title_from_html or SHORT_NAME,
        "description": app_description_from_html or APP_DESCRIPTION,
        "start_url": start_url,
        "display": "standalone",
        "background_color": BACKGROUND_COLOR,
        "theme_color": THEME_COLOR,
        "orientation": "portrait-primary",
        "icons": icon_metadata
    }
    with open(os.path.join(output_dir, "manifest.json"), 'w', encoding='utf-8') as f:
        json.dump(manifest, f, indent=2)
    print(f"✅ Created: manifest.json")

def create_service_worker(output_dir, precache_list):
    print("\n--- 4. Creating sw.js (Service Worker) ---")
    sw_template = f"""
// Auto-generated by PWA builder script for PHP apps.
importScripts('https://storage.googleapis.com/workbox-cdn/releases/7.0.0/workbox-sw.js');

if (workbox) {{
    console.log(`Workbox is loaded.`);
    
    self.addEventListener('message', (event) => {{
      if (event.data && event.data.type === 'SKIP_WAITING') {{
        console.log('Service Worker received SKIP_WAITING message, activating now.');
        self.skipWaiting();
      }}
    }});

    workbox.precaching.precacheAndRoute({json.dumps(precache_list, indent=4)});

    workbox.routing.registerRoute(
        ({{request}}) => request.destination === 'style' || request.destination === 'script',
        new workbox.strategies.StaleWhileRevalidate({{ cacheName: 'asset-cache' }})
    );

    workbox.routing.registerRoute(
        ({{request}}) => request.destination === 'image',
        new workbox.strategies.CacheFirst({{
            cacheName: 'image-cache',
            plugins: [ new workbox.expiration.ExpirationPlugin({{ maxEntries: 60, maxAgeSeconds: 30 * 24 * 60 * 60 }}) ],
        }})
    );

    workbox.routing.setCatchHandler(async ({{event}}) => {{
        if (event.request.destination === 'document') {{
            return await caches.match('offline.html') || Response.error();
        }}
        return Response.error();
    }});

}} else {{
    console.log(`Workbox failed to load.`);
}}
"""
    with open(os.path.join(output_dir, "sw.js"), 'w', encoding='utf-8') as f:
        f.write(sw_template.strip())
    print("✅ Created: sw.js")

import re

def _escape_for_php_string(s: str, quote: str) -> str:
    """
    Escape a string so it is safe to put inside a PHP quoted string
    using the same quote character (single or double).
    For double-quoted PHP strings we also escape $ to avoid accidental interpolation.
    """
    if quote == "'":
        # In single-quoted PHP strings only backslash and single-quote need escaping
        return s.replace('\\', '\\\\').replace("'", "\\'")
    else:
        # Double-quoted: escape backslash, double-quote and $ to avoid interpolation
        return s.replace('\\', '\\\\').replace('"', '\\"').replace('$', '\\$')

def _insert_into_heads_non_php(segment: str, manifest_link_str: str, favicon_link_str: str) -> str:
    """
    Insert manifest and favicon after every <head...> in non-PHP HTML segments,
    but skip a head if it already contains a manifest reference.
    """
    head_re = re.compile(r'<head\b[^>]*>', re.IGNORECASE)
    last = 0
    out = []
    for m in head_re.finditer(segment):
        out.append(segment[last:m.end()])  # include tag itself
        # look ahead for the head content (up to closing </head> or a reasonable window)
        close_idx = segment.find('</head>', m.end())
        if close_idx == -1:
            # if no closing head in the fragment, take small window
            check_region = segment[m.end(): m.end() + 2000]
        else:
            check_region = segment[m.end(): close_idx]
        if ('manifest.json' in check_region) or ('rel="manifest"' in check_region) or ("rel='manifest'" in check_region):
            insertion = ''
        else:
            insertion = '\n    ' + manifest_link_str + '\n    ' + favicon_link_str + '\n'
        out.append(insertion)
        last = m.end()
    out.append(segment[last:])
    return ''.join(out)

def _insert_script_before_body_non_php(segment: str, sw_script_str: str) -> str:
    """
    Insert the service-worker-registration script before the first </body> in non-PHP segments,
    unless the segment already contains workbox-window/script text.
    """
    if ('workbox-window' in segment) or ('wb.register' in segment) or ('navigator.serviceWorker' in segment):
        return segment
    idx = segment.lower().find('</body>')
    if idx != -1:
        return segment[:idx] + sw_script_str + '\n' + segment[idx:]
    return segment

def update_php_files(php_files):
    print("\n--- 5. Updating PHP Files (safe mode) ---")
    manifest_link_str = '<link rel="manifest" href="manifest.json">'
    favicon_link_str = '<link rel="icon" type="image/x-icon" href="favicon.ico">'
    sw_script_str = """<script type="module">
  import { Workbox } from 'https://storage.googleapis.com/workbox-cdn/releases/7.0.0/workbox-window.prod.mjs';

  const swUrl = './sw.js';
  const wb = new Workbox(swUrl);

  wb.addEventListener('waiting', (event) => {
    console.log('A new service worker is waiting to activate.');
    wb.messageSW({ type: 'SKIP_WAITING' });
  });

  wb.addEventListener('controlling', (event) => {
    console.log('The new service worker is now in control. Reloading page for updates...');
    window.location.reload();
  });

  wb.register();
</script>"""

    # Regex to split into PHP blocks and non-PHP (keeps delimiters)
    php_split_re = re.compile(r'(<\?(?:php)?[\s\S]*?\?>)', re.IGNORECASE)

    # Regex to match PHP string literals (single or double quoted), including escapes
    php_string_re = re.compile(r"('(?:\\.|[^\\'])*'|\"(?:\\.|[^\\\"])*\")", re.DOTALL)

    for php_path in php_files:
        try:
            with open(php_path, 'r', encoding='utf-8', errors='ignore') as f:
                original = f.read()

            parts = php_split_re.split(original)  # keeps PHP blocks as separate elements
            new_parts = []
            changed = False

            for part in parts:
                if part.startswith("<?"):
                    # PHP block: we will only touch string literals inside it
                    last = 0
                    new_block_parts = []
                    for m in php_string_re.finditer(part):
                        new_block_parts.append(part[last:m.start()])
                        s_literal = m.group(0)             # includes surrounding quotes
                        quote = s_literal[0]
                        inner = s_literal[1:-1]           # content inside the quotes
                        inner_lower = inner.lower()

                        modified_inner = inner
                        # Insert manifest/favicon into strings that contain <head> (e.g. echo "<head>...")
                        if ('<head' in inner_lower) and ('manifest.json' not in inner_lower) and ('rel="manifest"' not in inner_lower) and ("rel='manifest'" not in inner_lower):
                            head_match = re.search(r'<head\b[^>]*>', inner, re.IGNORECASE)
                            if head_match:
                                insert_content = '\n' + manifest_link_str + '\n' + favicon_link_str + '\n'
                                # Insert after the <head...> tag
                                pos = head_match.end()
                                modified_inner = inner[:pos] + insert_content + inner[pos:]
                                changed = True

                        # Insert service-worker script before </body> inside string literals
                        if ('</body>' in inner_lower) and ('workbox-window' not in inner_lower) and ('wb.register' not in inner_lower) and ('navigator.serviceWorker' not in inner_lower):
                            # Insert the script (escaped for the current quote type)
                            insert_point = modified_inner.lower().find('</body>')
                            if insert_point != -1:
                                # Note: we'll insert the raw script text; it will be escaped below
                                modified_inner = modified_inner[:insert_point] + sw_script_str + modified_inner[insert_point:]
                                changed = True

                        if modified_inner != inner:
                            # escape the modified inner for the quote type
                            escaped = _escape_for_php_string(modified_inner, quote)
                            new_literal = quote + escaped + quote
                            new_block_parts.append(new_literal)
                        else:
                            new_block_parts.append(s_literal)

                        last = m.end()
                    new_block_parts.append(part[last:])
                    new_part = ''.join(new_block_parts)
                    new_parts.append(new_part)
                else:
                    # Non-PHP segment: treat as HTML, insert into all <head> occurrences and before </body>
                    seg = part
                    seg_lower = seg.lower()
                    before = seg
                    # only insert head links if there's at least one <head>
                    if '<head' in seg_lower and 'manifest.json' not in seg_lower and 'rel="manifest"' not in seg_lower and "rel='manifest'" not in seg_lower:
                        seg = _insert_into_heads_non_php(seg, manifest_link_str, favicon_link_str)
                        changed = True
                    # insert sw script before </body>
                    if '</body>' in seg_lower and ('workbox-window' not in seg_lower and 'wb.register' not in seg_lower and 'navigator.serviceWorker' not in seg_lower):
                        seg = _insert_script_before_body_non_php(seg, sw_script_str)
                        changed = True
                    new_parts.append(seg)

            new_content = ''.join(new_parts)

            if changed and new_content != original:
                with open(php_path, 'w', encoding='utf-8') as f:
                    f.write(new_content)
                print(f"   - Updated {os.path.basename(php_path)}")
            else:
                print(f"   - No changes needed: {os.path.basename(php_path)}")
        except Exception as e:
            print(f"   ❌ Could not update {os.path.basename(php_path)}: {e}")
    print("✅ PHP files updated (safe mode).")

if __name__ == "__main__":
    print(f"🚀 Starting PHP PWA Build Script [v{VERSION}]...")
    offline_page_path = os.path.join(PROJECT_DIR, 'offline.html')
    if not os.path.exists(offline_page_path):
        with open(offline_page_path, 'w', encoding='utf-8') as f:
            f.write("<!DOCTYPE html><html lang=\"en\"><head><meta charset=\"UTF-8\"><title>Offline</title></head><body><h1>You are offline.</h1></body></html>")
        print("✅ Created 'offline.html'.")

    generated_icons, icon_metadata = generate_pwa_icons(SOURCE_LOGO_PATH, PROJECT_DIR)
    generate_favicon(SOURCE_LOGO_PATH, PROJECT_DIR)
    precache_list, php_files = discover_assets(PROJECT_DIR, generated_icons)
    
    if php_files:
        create_manifest(PROJECT_DIR, icon_metadata, php_files)
        create_service_worker(PROJECT_DIR, precache_list)
        update_php_files(php_files)
        print(f"\n🎉 PHP PWA setup is complete!")
    else:
        print("\n❌ Script stopped: No PHP files were found.")
