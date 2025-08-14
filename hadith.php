<?php
session_start();

// --- Database Connection ---
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "islamic_hub";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- API Logic: Fetch Hadiths ---
if (isset($_GET['action']) && $_GET['action'] === 'get_hadiths') {
    header('Content-Type: application/json');

    $searchTerm = $_GET['search'] ?? '';
    $sourceFilter = $_GET['source'] ?? '';

    $sql = "SELECT * FROM hadiths WHERE 1=1";
    $params = [];
    $types = '';

    if (!empty($searchTerm)) {
        $sql .= " AND (hadith_ur LIKE ? OR hadith_en LIKE ?)";
        $likeTerm = "%" . $searchTerm . "%";
        $params[] = $likeTerm;
        $params[] = $likeTerm;
        $types .= 'ss';
    }

    if (!empty($sourceFilter)) {
        $sql .= " AND (source_ur = ? OR source_en = ?)";
        $params[] = $sourceFilter;
        $params[] = $sourceFilter;
        $types .= 'ss';
    }

    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $hadiths = [];
    while ($row = $result->fetch_assoc()) {
        $hadiths[] = $row;
    }
    $stmt->close();

    // Also fetch all unique sources for the filter dropdown
    $sources_result = $conn->query("SELECT DISTINCT source_ur, source_en FROM hadiths ORDER BY source_ur");
    $sources = [];
    while($row = $sources_result->fetch_assoc()){
        $sources[] = $row;
    }

    echo json_encode(['hadiths' => $hadiths, 'sources' => $sources]);
    $conn->close();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Hadiths - Islamic Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Additional styles for this page */
        .hadith-card {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            margin-bottom: 20px;
            padding: 20px;
            text-align: right;
            direction: rtl;
        }
        .hadith-card-en {
            text-align: left;
            direction: ltr;
        }
        .hadith-text {
            font-size: 1.4rem;
            line-height: 1.8;
            margin-bottom: 15px;
        }
        .hadith-source {
            font-size: 1rem;
            color: #cce7ff;
            font-style: italic;
        }
        .filter-bar {
            background-color: rgba(0, 0, 0, 0.3);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .copy-btn {
            background: none;
            border: none;
            color: #85c1e9;
            font-size: 1.2rem;
            cursor: pointer;
        }
        body {
    margin: 0;
    font-family: var(--bs-body-font-family);
    font-size: var(--bs-body-font-size);
    font-weight: var(--bs-body-font-weight);
    line-height: var(--bs-body-line-height);
    color: var(--bs-body-color);
    text-align: var(--bs-body-text-align);
    background-color: chocolate;
    -webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: transparent;
}
    </style>
</head>
<body class="dark-mode">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">صلی اللہ علیہ و سلم</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="hadith.php">All Hadiths</a></li>
                    <li class="nav-item"><a class="nav-link" href="quran.php">All Quran Verses</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content container mt-4">
        <h1 class="mb-4">All Hadiths (تمام احادیث)</h1>

        <!-- Filter and Search Bar -->
        <div class="filter-bar row g-3 align-items-center">
            <div class="col-md-6">
                <input type="text" id="searchInput" class="form-control bg-secondary text-white border-0" placeholder="Search Hadith text...">
            </div>
            <div class="col-md-4">
                <select id="sourceFilter" class="form-select bg-secondary text-white border-0">
                    <option value="">All Sources</option>
                </select>
            </div>
            <div class="col-md-2">
                 <button class="btn btn-primary w-100" onclick="fetchHadiths()">Search</button>
            </div>
        </div>

        <!-- Hadith Display Area -->
        <div id="hadith-container" class="mt-4">
            <!-- Hadiths will be loaded here by JavaScript -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetchHadiths();
        });

        function fetchHadiths() {
            const searchTerm = document.getElementById('searchInput').value;
            const sourceFilter = document.getElementById('sourceFilter').value;
            
            const url = `hadith.php?action=get_hadiths&search=${encodeURIComponent(searchTerm)}&source=${encodeURIComponent(sourceFilter)}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    renderHadiths(data.hadiths);
                    populateSourceFilter(data.sources);
                })
                .catch(error => console.error('Error fetching hadiths:', error));
        }

        function renderHadiths(hadiths) {
            const container = document.getElementById('hadith-container');
            container.innerHTML = ''; // Clear previous results

            if (hadiths.length === 0) {
                container.innerHTML = '<p class="text-center">No hadiths found matching your criteria.</p>';
                return;
            }

            hadiths.forEach(hadith => {
                const card = document.createElement('div');
                card.className = 'hadith-card';
                
                const hadithContent = `
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="hadith-text">${hadith.hadith_ur}</p>
                            <p class="hadith-source">ماخذ: ${hadith.source_ur}</p>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)" title="Copy Urdu"><i class="far fa-copy"></i></button>
                    </div>
                    <hr class="border-secondary">
                    <div class="d-flex justify-content-between align-items-start hadith-card-en">
                         <div>
                            <p class="hadith-text">${hadith.hadith_en}</p>
                            <p class="hadith-source">Source: ${hadith.source_en}</p>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)" title="Copy English"><i class="far fa-copy"></i></button>
                    </div>
                `;
                
                card.innerHTML = hadithContent;
                container.appendChild(card);
            });
        }

        function populateSourceFilter(sources) {
            const select = document.getElementById('sourceFilter');
            // Don't clear if it's already populated to preserve selection
            if(select.options.length > 1) return;

            sources.forEach(source => {
                let option = document.createElement('option');
                option.value = source.source_ur; // Filter by Urdu source name
                option.textContent = `${source.source_ur} / ${source.source_en}`;
                select.appendChild(option);
            });
        }

        function copyToClipboard(button) {
            const textToCopy = button.parentElement.querySelector('.hadith-text').innerText;
            navigator.clipboard.writeText(textToCopy).then(() => {
                const icon = button.querySelector('i');
                icon.classList.replace('fa-copy', 'fa-check');
                setTimeout(() => {
                   icon.classList.replace('fa-check', 'fa-copy');
                }, 1500);
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        }
    </script>
</body>
</html>
