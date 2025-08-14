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

// --- API Logic: Fetch Quran Verses ---
if (isset($_GET['action']) && $_GET['action'] === 'get_verses') {
    header('Content-Type: application/json');

    $searchTerm = $_GET['search'] ?? '';
    $surahFilter = $_GET['surah'] ?? '';

    $sql = "SELECT * FROM quran_verses WHERE 1=1";
    $params = [];
    $types = '';

    if (!empty($searchTerm)) {
        $sql .= " AND (translation_ur LIKE ? OR translation_en LIKE ? OR transliteration LIKE ?)";
        $likeTerm = "%" . $searchTerm . "%";
        $params[] = $likeTerm;
        $params[] = $likeTerm;
        $params[] = $likeTerm;
        $types .= 'sss';
    }

    if (!empty($surahFilter)) {
        $sql .= " AND surah_number = ?";
        $params[] = $surahFilter;
        $types .= 'i';
    }
    
    $sql .= " ORDER BY surah_number, verse_number";

    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $verses = [];
    while ($row = $result->fetch_assoc()) {
        $verses[] = $row;
    }
    $stmt->close();

    // Fetch unique surah numbers for the filter
    $surahs_result = $conn->query("SELECT DISTINCT surah_number FROM quran_verses ORDER BY surah_number");
    $surahs = [];
    while($row = $surahs_result->fetch_assoc()){
        $surahs[] = $row['surah_number'];
    }

    echo json_encode(['verses' => $verses, 'surahs' => $surahs]);
    $conn->close();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Quran Verses - Islamic Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .verse-card {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            margin-bottom: 20px;
            padding: 20px;
        }
        .arabic-text {
            font-size: 2rem;
            direction: rtl;
            line-height: 2.5;
            margin-bottom: 1rem;
        }
        .translation-text {
            font-size: 1.1rem;
            margin-top: 10px;
        }
        .transliteration-text {
            font-size: 1rem;
            font-style: italic;
            color: #bde0ff;
        }
        .verse-info {
            font-weight: bold;
            color: #cce7ff;
        }
        .filter-bar {
            background-color: rgba(0, 0, 0, 0.3);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .verse-controls button {
            background: none;
            border: none;
            color: #85c1e9;
            font-size: 1.2rem;
            cursor: pointer;
            margin: 0 5px;
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
                    <li class="nav-item"><a class="nav-link" href="hadith.php">All Hadiths</a></li>
                    <li class="nav-item"><a class="nav-link active" href="quran.php">All Quran Verses</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content container mt-4">
        <h1 class="mb-4">Quran Verses (قرآنی آیات)</h1>

        <!-- Filter and Search Bar -->
        <div class="filter-bar row g-3 align-items-center">
            <div class="col-md-6">
                <input type="text" id="searchInput" class="form-control bg-secondary text-white border-0" placeholder="Search translation/transliteration...">
            </div>
            <div class="col-md-4">
                <select id="surahFilter" class="form-select bg-secondary text-white border-0">
                    <option value="">All Surahs</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100" onclick="fetchVerses()">Search</button>
            </div>
        </div>

        <!-- Verses Display Area -->
        <div id="verse-container" class="mt-4">
            <!-- Verses will be loaded here -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetchVerses();
        });

        function fetchVerses() {
            const searchTerm = document.getElementById('searchInput').value;
            const surahFilter = document.getElementById('surahFilter').value;
            
            const url = `quran.php?action=get_verses&search=${encodeURIComponent(searchTerm)}&surah=${encodeURIComponent(surahFilter)}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    renderVerses(data.verses);
                    populateSurahFilter(data.surahs);
                })
                .catch(error => console.error('Error fetching verses:', error));
        }

        function renderVerses(verses) {
            const container = document.getElementById('verse-container');
            container.innerHTML = '';

            if (verses.length === 0) {
                container.innerHTML = '<p class="text-center">No verses found matching your criteria.</p>';
                return;
            }

            verses.forEach(verse => {
                const card = document.createElement('div');
                card.className = 'verse-card';
                
                const verseContent = `
                    <p class="verse-info">Surah ${verse.surah_number}, Verse ${verse.verse_number}</p>
                    <p class="arabic-text">${verse.arabic_text}</p>
                    <p class="transliteration-text">${verse.transliteration || ''}</p>
                    <hr class="border-secondary">
                    <p class="translation-text"><strong>Urdu:</strong> ${verse.translation_ur}</p>
                    <p class="translation-text"><strong>English:</strong> ${verse.translation_en}</p>
                    <div class="d-flex justify-content-end align-items-center mt-3">
                        <audio id="audio-${verse.id}" src="${verse.audio_url || ''}" preload="none"></audio>
                        <div class="verse-controls">
                            ${verse.audio_url ? `<button onclick="playAudio(${verse.id})" title="Play Audio"><i class="fas fa-play"></i></button>` : ''}
                            <button onclick="copyToClipboard(this)" title="Copy Verse"><i class="far fa-copy"></i></button>
                        </div>
                    </div>
                `;
                
                card.innerHTML = verseContent;
                container.appendChild(card);
            });
        }

        function populateSurahFilter(surahs) {
            const select = document.getElementById('surahFilter');
            if (select.options.length > 1) return;

            surahs.forEach(surahNum => {
                let option = document.createElement('option');
                option.value = surahNum;
                option.textContent = `Surah ${surahNum}`;
                select.appendChild(option);
            });
        }

        function playAudio(verseId) {
            const audio = document.getElementById(`audio-${verseId}`);
            if (audio.paused) {
                audio.play();
            } else {
                audio.pause();
                audio.currentTime = 0;
            }
        }

        function copyToClipboard(button) {
            const card = button.closest('.verse-card');
            const verseInfo = card.querySelector('.verse-info').innerText;
            const arabicText = card.querySelector('.arabic-text').innerText;
            const englishText = card.querySelector('.translation-text:nth-of-type(2)').innerText;
            
            const textToCopy = `${verseInfo}\n\n${arabicText}\n\n${englishText}`;
            
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
