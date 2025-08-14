<?php
$session_path = __DIR__ . '/sessions';
if (!is_dir($session_path)) {
    mkdir($session_path, 0777, true);
}
session_save_path($session_path);
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "islamic_hub";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sample_data_configs = [
    'hadiths' => [
        'fields' => ['hadith_ur', 'hadith_en', 'source_ur', 'source_en'],
        'data' => [
            ["رسول اللہ صلی اللہ علیہ و سلم نے فرمایا: اعمال کا دارومدار نیتوں پر ہے، اور ہر شخص کو وہی ملے گا جو اس نے نیت کی ہو۔", "The Messenger of Allah (ﷺ) said: The reward of deeds depends upon the intentions and every person will get the reward according to what he has intended.", "صحیح بخاری", "Sahih Bukhari"],
            ["ایک شخص نے رسول اللہ صلی اللہ علیہ و سلم سے پوچھا: اسلام میں سب سے بہتر کون سا عمل ہے؟ آپ نے فرمایا: کھانا کھلانا اور ہر ایک کو سلام کہنا، چاہے تم اسے جانتے ہو یا نہیں جانتے۔", "A man asked the Prophet (ﷺ): What is the best thing in Islam? He said: To feed people and to greet those whom you know and those whom you do not know.", "صحیح بخاری، حدیث 12", "Sahih Bukhari, Hadith 12"],
            ["رسول اللہ صلی اللہ علیہ و سلم نے فرمایا: تم میں سے بہترین وہ ہے جو قرآن سیکھے اور سکھائے۔", "The best among you is he who learns the Qur'an and teaches it.", "صحیح بخاری", "Sahih Bukhari"],
            ["اللہ کے رسول صلی اللہ علیہ و سلم نے فرمایا: جو شخص روزانہ سو مرتبہ سبحان اللہ و بحمدہ کہے گا، اس کے گناہ معاف کر دیے جائیں گے اگرچہ وہ سمندر کی جھاگ کے برابر ہی ہوں۔", "The Prophet (ﷺ) said: Whoever says, 'Subhan Allah wa bihamdihi,' one hundred times a day, will have all his sins forgiven, even if they were as much as the foam of the sea.", "صحیح مسلم", "Sahih Muslim"]
        ]
    ],
    'quran_verses' => [
        'fields' => ['surah_number', 'verse_number', 'arabic_text', 'transliteration', 'translation_ur', 'translation_en', 'audio_url'],
        'data' => [
            [1, 1, "بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ", "Bismi Allahi alrrahmani alrraheemi", "شروع اللہ کے نام سے جو بڑا مہربان نہایت رحم والا ہے۔", "In the name of Allah, the Entirely Merciful, the Especially Merciful.", "https://download.quranicaudio.com/quran/minshawi_murattal/001.mp3"],
            [2, 255, "اللَّهُ لَا إِلَٰهَ إِلَّا هُوَ الْحَيُّ الْقَيُّومُ ۚ لَا تَأْخُذُهُ سِنَةٌ وَلَا نَوْمٌ ۚ لَهُ مَا فِي السَّمَاوَاتِ وَمَا فِي الْأَرْضِ ۗ مَنْ ذَا الَّذِي يَشْفَعُ عِنْدَهُ إِلَّا بِإِذْنِهِ ۚ يَعْلَمُ مَا بَيْنَ أَيْدِيهِمْ وَمَا خَلْفَهُمْ ۖ وَلَا يُحِيطُونَ بِشَيْءٍ مِنْ عِلْمِهِ إِلَّا بِمَا شَاءَ ۚ وَسِعَ كُرْسِيُّهُ السَّمَاوَاتِ وَالْأَرْضَ ۖ وَلَا يَئُودُهُ حِفْظُهُمَا ۚ وَهُوَ الْعَلِيُّ الْعَظِيمُ", "Allahu la ilaha illa huwa alhayyu alqayyoomu la ta'khuthuhu sinatun wala nawmun lahu ma fi alssamawati wama fi al-ardi man tha allathee yashfa'u 'indahu illa bi-ithnihi ya'lamu ma bayna aydeehim wama khalfahum wala yuheetoona bishay-in min 'ilmihi illa bima shaa wasi'a kursiyyuhu alssamawati wal-arda wala ya'ooduhu hifthuhuma wahuwa al'aliyyu al'atheemu", "اللہ وہی ہے جس کے سوا کوئی معبود نہیں، زندہ ہے، سب کا تھامنے والا ہے۔ نہ اس کو اونگھ آتی ہے اور نہ نیند۔ اسی کا ہے جو کچھ آسمانوں میں ہے اور جو کچھ زمین میں ہے۔ کون ہے جو اس کی اجازت کے بغیر اس کے پاس سفارش کر سکے۔ وہ جانتا ہے جو کچھ ان کے آگے ہے اور جو کچھ ان کے پیچھے ہے، اور وہ اس کے علم میں سے کسی چیز پر احاطہ نہیں کر سکتے مگر جتنا وہ چاہے، اس کی کرسی آسمانوں اور زمین پر وسیع ہے، اور ان دونوں کی حفاظت اس پر گراں نہیں، اور وہ سب سے بلند، سب سے بڑا ہے۔", "Allah - there is no deity except Him, the Ever-Living, the Sustainer of [all] existence. Neither slumber nor sleep overtakes Him. To Him belongs whatever is in the heavens and whatever is on the earth. Who is it that can intercede with Him except by His permission? He knows what is [presently] before them and what will be after them, and they encompass not a thing of His knowledge except for what He wills. His Kursi extends over the heavens and the earth, and their preservation tires Him not. And He is the Most High, the Most Great.", "https://download.quranicaudio.com/quran/minshawi_murattal/002.mp3"],
            [112, 1, "قُلْ هُوَ اللَّهُ أَحَدٌ", "Qul huwa Allahu ahadun", "کہہ دیجیے کہ وہ اللہ ایک ہے۔", "Say, 'He is Allah, [who is] One,", null],
            [112, 2, "اللَّهُ الصَّمَدُ", "Allahu alssamadu", "اللہ بے نیاز ہے۔", "Allah, the Eternal Refuge.", null]
        ]
    ],
    'daily_duas' => [
        'fields' => ['dua_title_ur', 'dua_title_en', 'arabic_text', 'transliteration', 'translation_ur', 'translation_en'],
        'data' => [
            ["نیند سے بیدار ہونے کی دعا", "Dua upon waking up", "الحَمْدُ للهِ الّذي أَحْيانا بَعْدَ ما أَماتَنا وإليه النُّشورُ", "Alhamdulillahilladhi ahyana ba'da ma amatana wa ilaihin nushoor.", "تمام تعریفیں اللہ کے لیے ہیں جس نے ہمیں موت کے بعد زندگی بخشی اور اسی کی طرف لوٹنا ہے۔", "All praise is for Allah who gave us life after having taken it from us and unto Him is the Resurrection."],
            ["کھانا کھانے سے پہلے کی دعا", "Dua before eating", "بِسْمِ اللهِ وَعَلَى بَرَكَةِ اللهِ", "Bismillahi wa 'ala barakatillah.", "اللہ کے نام سے اور اللہ کی برکت پر۔", "In the Name of Allah and with the blessings of Allah."],
            ["گھر سے نکلنے کی دعا", "Dua upon leaving home", "بِسْمِ اللهِ تَوَكَّلْتُ عَلَى اللهِ، لاَ حَوْلَ وَلاَ قُوَّةَ إِلاَّ بِاللهِ", "Bismillahi tawakkaltu 'ala Allah, la hawla wa la quwwata illa billah.", "اللہ کے نام سے، میں نے اللہ پر توکل کیا۔ اللہ کی توفیق کے بغیر نہ گناہوں سے بچنے کی طاقت ہے اور نہ نیکی کرنے کی قوت۔", "In the name of Allah, I place my trust in Allah. There is no might nor power except with Allah."],
            ["سفر کی دعا", "Dua for travel", "سُبْحَانَ الَّذِي سَخَّرَ لَنَا هَذَا وَمَا كُنَّا لَهُ مُقْرِنِينَ وَإِنَّا إِلَى رَبِّنَا لَمُنْقَلِبُونَ", "Subhanalladhi sakhkhara lana hadha wama kunna lahu muqrineen wa inna ila Rabbina lamunqaliboon.", "پاک ہے وہ ذات جس نے ہمارے لیے اسے مسخر کیا، اور ہم اسے مسخر کرنے والے نہ تھے اور بے شک ہم اپنے رب کی طرف لوٹنے والے ہیں۔", "Glory be to Him Who has subjected this to us, and we were not capable of it, and indeed to Our Lord we will return."]
        ]
    ],
    'quiz_questions' => [
        'fields' => ['question_ur', 'question_en', 'options_ur', 'options_en', 'correct_answer_index', 'explanation_ur', 'explanation_en'],
        'data' => [
            ["حضرت محمد صلی اللہ علیہ و سلم کی والدہ کا نام کیا تھا؟", "What was the name of Prophet Muhammad's (PBUH) mother?", json_encode(["آمنہ", "خدیجہ", "فاطمہ", "عائشہ"]), json_encode(["Aminah", "Khadijah", "Fatimah", "Aishah"]), 0, "نبی اکرم صلی اللہ علیہ و سلم کی والدہ کا نام آمنہ بنت وہب تھا۔", "The mother of Prophet Muhammad (PBUH) was Aminah bint Wahb."],
            ["قرآن پاک میں سب سے طویل سورت کون سی ہے؟", "Which is the longest Surah in the Quran?", json_encode(["سورہ فاتحہ", "سورہ بقرہ", "سورہ آل عمران", "سورہ یٰسین"]), json_encode(["Al-Fatiha", "Al-Baqarah", "Al-Imran", "Ya-Sin"]), 1, "قرآن پاک میں سب سے طویل سورت سورہ بقرہ ہے جس میں 286 آیات ہیں۔", "The longest Surah in the Quran is Al-Baqarah, with 286 verses."],
            ["اسلام کے پانچ ستونوں میں سے دوسرا ستون کون سا ہے؟", "What is the second pillar of Islam?", json_encode(["توحید", "نماز", "زکوٰۃ", "روزہ"]), json_encode(["Shahadah", "Salat", "Zakat", "Sawm"]), 1, "اسلام کا دوسرا ستون نماز (روزانہ پانچ وقت کی نماز) ہے۔", "The second pillar of Islam is Salat (performing the five daily prayers)."],
            ["غزوہ بدر کس ہجری سال میں ہوا تھا؟", "In which Hijri year did the Battle of Badr take place?", json_encode(["1 ہجری", "2 ہجری", "3 ہجری", "4 ہجری"]), json_encode(["1 Hijri", "2 Hijri", "3 Hijri", "4 Hijri"]), 1, "غزوہ بدر 2 ہجری (624 عیسوی) میں ہوا تھا، جو مسلمانوں اور مکی مشرکین کے درمیان پہلی بڑی جنگ تھی۔", "The Battle of Badr took place in 2 Hijri (624 CE), which was the first major battle between the Muslims and the Meccan polytheists."]
        ]
    ],
    'seerah_events' => [
        'fields' => ['title_ur', 'title_en', 'gregorian_date', 'hijri_date', 'description_ur', 'description_en', 'source'],
        'data' => [
            ["عام الفیل (ہاتھیوں کا سال)", "Year of the Elephant", "0570-04-20", "Rabi al-Awwal 12, 53 BH", "یہ وہ سال ہے جس میں حضرت محمد صلی اللہ علیہ و سلم کی ولادت ہوئی۔ اس سال ابرہہ نے خانہ کعبہ کو گرانے کی کوشش کی تھی۔", "The year in which Prophet Muhammad (PBUH) was born. Abraha attempted to destroy the Kaaba in this year.", "Seerat Ibn Hisham"],
            ["ہجرت مدینہ", "Hijra to Medina", "0622-09-24", "Rabi al-Awwal 1, 1 AH", "نبی اکرم صلی اللہ علیہ و سلم اور صحابہ کرام کا مکہ سے مدینہ ہجرت کرنا۔ یہ اسلامی کیلنڈر کا آغاز ہے۔", "The migration of Prophet Muhammad (PBUH) and his companions from Mecca to Medina. This marks the beginning of the Islamic calendar.", "Seerat Ibn Hisham"],
            ["غزوہ بدر", "Battle of Badr", "0624-03-13", "Ramadan 17, 2 AH", "مسلمانوں اور مکی مشرکین کے درمیان پہلی بڑی جنگ، جس میں مسلمانوں کو فتح حاصل ہوئی۔", "The first major battle between the Muslims and the Meccan polytheists, resulting in a Muslim victory.", "Sahih Bukhari"],
            ["فتح مکہ", "Conquest of Mecca", "0630-01-11", "Ramadan 20, 8 AH", "مسلمانوں نے بغیر کسی خونریزی کے مکہ پر فتح حاصل کی اور خانہ کعبہ کو بتوں سے پاک کیا۔", "The Muslims peacefully conquered Mecca and purified the Kaaba from idols.", "Seerat Ibn Hisham"]
        ]
    ],
    'asma_ul_husna' => [
        'fields' => ['arabic_name', 'transliteration', 'meaning_ur', 'meaning_en'],
        'data' => [
            ["الرَّحْمَن", "Ar-Rahman", "انتہائی مہربان", "The Most Compassionate"],
            ["الرَّحِيم", "Ar-Rahim", "نہایت رحم کرنے والا", "The Most Merciful"],
            ["الْمَلِك", "Al-Malik", "بادشاہ", "The King, The Sovereign"],
            ["الْقُدُّوس", "Al-Quddus", "انتہائی پاک", "The Most Holy, The Most Pure"]
        ]
    ],
    'prophet_names' => [
        'fields' => ['arabic_name', 'transliteration', 'meaning_ur', 'meaning_en'],
        'data' => [
            ["محمد", "Muhammad", "وہ جس کی تعریف کی گئی ہو", "The Praised One"],
            ["احمد", "Ahmad", "انتہائی قابل تعریف", "The Most Praiseworthy"],
            ["مصطفیٰ", "Mustafa", "منتخب کیا ہوا", "The Chosen One"],
            ["طٰہٰ", "Taha", "قرآن میں ایک حروفِ مقطعات، جس کے کئی معانی ہیں۔", "Mystic letters from Quran, having various interpretations."]
        ]
    ],
    'islamic_calendar_events' => [
        'fields' => ['hijri_day', 'hijri_month', 'event_title_ur', 'event_title_en', 'description_ur', 'description_en'],
        'data' => [
            [1, 1, "نیا اسلامی سال", "New Islamic Year", "محرم الحرام کا پہلا دن، نئے اسلامی سال کا آغاز۔", "The first day of Muharram, marking the beginning of the new Islamic year."],
            [10, 1, "یوم عاشورہ", "Day of Ashura", "اہل بیت پر کربلا کا واقعہ اور حضرت موسیٰ علیہ السلام کا فرعون سے نجات کا دن۔", "Commemorates the martyrdom of Husayn ibn Ali and the salvation of Moses from Pharaoh."],
            [12, 3, "عید میلاد النبی", "Mawlid (Birthday of Prophet Muhammad ﷺ)", "حضرت محمد صلی اللہ علیہ و سلم کی ولادت کا دن۔", "The birthday of Prophet Muhammad (PBUH)."],
            [1, 10, "عید الفطر", "Eid al-Fitr", "رمضان کے بعد شوال کے پہلے دن منائی جانے والی عید۔", "The festival marking the end of Ramadan."]
        ]
    ],
    'users' => [
        'fields' => ['username', 'email', 'password_hash'],
        'data' => [
            ["userone", "userone@example.com", password_hash("userpass123", PASSWORD_DEFAULT)],
            ["usertwo", "usertwo@example.com", password_hash("userpass123", PASSWORD_DEFAULT)],
            ["userthree", "userthree@example.com", password_hash("userpass123", PASSWORD_DEFAULT)],
            ["userfour", "userfour@example.com", password_hash("userpass123", PASSWORD_DEFAULT)]
        ]
    ],
    'admins' => [
        'fields' => ['username', 'email', 'password_hash'],
        'data' => [
            ["admin", "adminone@example.com", password_hash("admin123", PASSWORD_DEFAULT)],
            ["admintwo", "admintwo@example.com", password_hash("adminpass123", PASSWORD_DEFAULT)],
            ["adminthree", "adminthree@example.com", password_hash("adminpass123", PASSWORD_DEFAULT)],
            ["adminfour", "adminfour@example.com", password_hash("adminpass123", PASSWORD_DEFAULT)]
        ]
    ],
    'quran_recitations' => [
        'fields' => ['surah_number', 'verse_number', 'reciter_name', 'audio_url'],
        'data' => [
            [1, 1, "Abdul Basit Abdus Samad", "https://download.quranicaudio.com/quran/minshawi_murattal/001.mp3"],
            [2, 255, "Mishary Alafasy", "https://download.quranicaudio.com/quran/mishary_alafasy/002.mp3"],
            [112, 1, "Sheikh Sudais", "https://download.quranicaudio.com/quran/saud_al-shuraym/112.mp3"],
            [114, 1, "Maher Al Muaiqly", "https://download.quranicaudio.com/quran/maher_almuaiqly/114.mp3"]
        ]
    ]
];
function createTablesAndInsertSampleData($conn, $sample_data_configs)
{
    $tables = [
        'users' => "CREATE TABLE IF NOT EXISTS users (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL UNIQUE,
            password_hash VARCHAR(255) NOT NULL,
            email VARCHAR(255) UNIQUE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            last_login TIMESTAMP NULL,
            settings JSON,
            INDEX(username)
        )",
        'admins' => "CREATE TABLE IF NOT EXISTS admins (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL UNIQUE,
            password_hash VARCHAR(255) NOT NULL,
            email VARCHAR(255) UNIQUE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            INDEX(username)
        )",
        'hadiths' => "CREATE TABLE IF NOT EXISTS hadiths (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            hadith_ur TEXT NOT NULL,
            hadith_en TEXT NOT NULL,
            source_ur VARCHAR(255),
            source_en VARCHAR(255)
        )",
        'quran_verses' => "CREATE TABLE IF NOT EXISTS quran_verses (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            surah_number INT(11) NOT NULL,
            verse_number INT(11) NOT NULL,
            arabic_text TEXT NOT NULL,
            transliteration TEXT,
            translation_ur TEXT NOT NULL,
            translation_en TEXT NOT NULL,
            audio_url VARCHAR(255)
        )",
        'daily_duas' => "CREATE TABLE IF NOT EXISTS daily_duas (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            dua_title_ur VARCHAR(255) NOT NULL,
            dua_title_en VARCHAR(255) NOT NULL,
            arabic_text TEXT NOT NULL,
            transliteration TEXT,
            translation_ur TEXT NOT NULL,
            translation_en TEXT NOT NULL
        )",
        'quiz_questions' => "CREATE TABLE IF NOT EXISTS quiz_questions (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            question_ur TEXT NOT NULL,
            question_en TEXT NOT NULL,
            options_ur JSON NOT NULL,
            options_en JSON NOT NULL,
            correct_answer_index INT(11) NOT NULL,
            explanation_ur TEXT,
            explanation_en TEXT
        )",
        'seerah_events' => "CREATE TABLE IF NOT EXISTS seerah_events (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            title_ur VARCHAR(255) NOT NULL,
            title_en VARCHAR(255) NOT NULL,
            gregorian_date DATE NOT NULL,
            hijri_date VARCHAR(255) NOT NULL,
            description_ur TEXT,
            description_en TEXT,
            source VARCHAR(255)
        )",
        'asma_ul_husna' => "CREATE TABLE IF NOT EXISTS asma_ul_husna (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            arabic_name VARCHAR(255) NOT NULL,
            transliteration VARCHAR(255),
            meaning_ur TEXT NOT NULL,
            meaning_en TEXT NOT NULL
        )",
        'prophet_names' => "CREATE TABLE IF NOT EXISTS prophet_names (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            arabic_name VARCHAR(255) NOT NULL,
            transliteration VARCHAR(255),
            meaning_ur TEXT NOT NULL,
            meaning_en TEXT NOT NULL
        )",
        'islamic_calendar_events' => "CREATE TABLE IF NOT EXISTS islamic_calendar_events (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            hijri_day INT(11) NOT NULL,
            hijri_month INT(11) NOT NULL,
            event_title_ur VARCHAR(255) NOT NULL,
            event_title_en VARCHAR(255) NOT NULL,
            description_ur TEXT,
            description_en TEXT
        )",
        'user_prayer_locations' => "CREATE TABLE IF NOT EXISTS user_prayer_locations (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            user_id INT(11) NOT NULL,
            location_name VARCHAR(255) NOT NULL,
            latitude DECIMAL(10, 8) NOT NULL,
            longitude DECIMAL(11, 8) NOT NULL,
            calculation_method VARCHAR(255),
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )",
        'user_daily_zikr' => "CREATE TABLE IF NOT EXISTS user_daily_zikr (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            user_id INT(11) NOT NULL,
            zikr_text_arabic TEXT NOT NULL,
            zikr_text_english TEXT,
            zikr_text_urdu TEXT,
            daily_target INT(11) NOT NULL DEFAULT 100,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )",
        'user_favorites' => "CREATE TABLE IF NOT EXISTS user_favorites (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            user_id INT(11) NOT NULL,
            item_type VARCHAR(255) NOT NULL,
            item_id INT(11) NOT NULL,
            UNIQUE (user_id, item_type, item_id),
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )",
        'quran_recitations' => "CREATE TABLE IF NOT EXISTS quran_recitations (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            surah_number INT(11) NOT NULL,
            verse_number INT(11) NOT NULL,
            reciter_name VARCHAR(255) NOT NULL,
            audio_url VARCHAR(255) NOT NULL
        )"
    ];
    foreach ($tables as $tableName => $createSql) {
        $conn->query($createSql);
        $check_empty_sql = "SELECT COUNT(*) as count FROM {$tableName}";
        $result = $conn->query($check_empty_sql);
        $row = $result->fetch_assoc();
        if ($row['count'] == 0 && isset($sample_data_configs[$tableName])) {
            $config = $sample_data_configs[$tableName];
            $fields = $config['fields'];
            $placeholders = implode(', ', array_fill(0, count($fields), '?'));
            $columns = implode(', ', $fields);
            $insertSql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$placeholders})";
            $stmt = $conn->prepare($insertSql);
            foreach ($config['data'] as $dataRow) {
                $types = '';
                foreach ($dataRow as $val) {
                    if (is_int($val)) $types .= 'i';
                    else if (is_float($val)) $types .= 'd';
                    else $types .= 's';
                }
                $stmt->bind_param($types, ...$dataRow);
                $stmt->execute();
            }
            $stmt->close();
        }
    }
}
function fetchData($conn, $table, $where = '', $params = [])
{
    $sql = "SELECT * FROM " . $table;
    if ($where) {
        $sql .= " WHERE " . $where;
    }
    $stmt = $conn->prepare($sql);
    if ($params) {
        $types = '';
        foreach ($params as $param) {
            if (is_int($param)) $types .= 'i';
            elseif (is_double($param)) $types .= 'd';
            else $types .= 's';
        }
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    $stmt->close();
    return $data;
}
function handleAdminCrud($conn)
{
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        http_response_code(403);
        echo json_encode(['error' => 'Unauthorized access. Admin privileges required.']);
        exit();
    }
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data['action'] ?? '';
    $table = $data['table'] ?? '';
    $id = $data['id'] ?? null;
    $fields = $data['fields'] ?? [];
    $response = ['success' => false, 'message' => 'Invalid action or table.'];
    switch ($action) {
        case 'create':
            if (($table === 'users' || $table === 'admins') && isset($fields['password'])) {
                $fields['password_hash'] = password_hash($fields['password'], PASSWORD_DEFAULT);
                unset($fields['password']);
            }
            $columns = implode(', ', array_keys($fields));
            $placeholders = implode(', ', array_fill(0, count($fields), '?'));
            $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $types = '';
                foreach ($fields as $col => $val) {
                    if (is_int($val)) $types .= 'i';
                    elseif (is_double($val)) $types .= 'd';
                    else $types .= 's';
                }
                $stmt->bind_param($types, ...array_values($fields));
                if ($stmt->execute()) {
                    $response = ['success' => true, 'message' => 'Record created successfully.', 'id' => $conn->insert_id];
                } else {
                    $response = ['success' => false, 'message' => 'Error creating record: ' . $stmt->error];
                }
                $stmt->close();
            } else {
                $response = ['success' => false, 'message' => 'Failed to prepare statement: ' . $conn->error];
            }
            break;
        case 'read':
            $data = fetchData($conn, $table);
            if ($table === 'quiz_questions') {
                foreach ($data as &$row) {
                    if (isset($row['options_ur'])) $row['options_ur'] = json_decode($row['options_ur']);
                    if (isset($row['options_en'])) $row['options_en'] = json_decode($row['options_en']);
                }
            }
            if ($table === 'seerah_events') {
                foreach ($data as &$event) {
                    $event['gregorian_date_iso'] = (new DateTime($event['gregorian_date']))->format(DATE_ISO8601);
                }
            }
            $response = ['success' => true, 'data' => $data];
            break;
        case 'update':
            if (!$id || empty($fields)) {
                $response = ['success' => false, 'message' => 'Missing ID or fields for update.'];
                break;
            }
            if (($table === 'users' || $table === 'admins') && isset($fields['password']) && !empty($fields['password'])) {
                $fields['password_hash'] = password_hash($fields['password'], PASSWORD_DEFAULT);
                unset($fields['password']);
            } else {
                unset($fields['password']);
            }
            $setClauses = [];
            $params = [];
            $types = '';
            foreach ($fields as $col => $val) {
                $setClauses[] = "{$col} = ?";
                $params[] = $val;
                if (is_int($val)) $types .= 'i';
                elseif (is_double($val)) $types .= 'd';
                else $types .= 's';
            }
            $params[] = $id;
            $types .= 'i';
            $setSql = implode(', ', $setClauses);
            $sql = "UPDATE {$table} SET {$setSql} WHERE id = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param($types, ...$params);
                if ($stmt->execute()) {
                    $response = ['success' => true, 'message' => 'Record updated successfully.'];
                } else {
                    $response = ['success' => false, 'message' => 'Error updating record: ' . $stmt->error];
                }
                $stmt->close();
            } else {
                $response = ['success' => false, 'message' => 'Failed to prepare statement: ' . $conn->error];
            }
            break;
        case 'delete':
            if (!$id) {
                $response = ['success' => false, 'message' => 'Missing ID for deletion.'];
                break;
            }
            $sql = "DELETE FROM {$table} WHERE id = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param('i', $id);
                if ($stmt->execute()) {
                    $response = ['success' => true, 'message' => 'Record deleted successfully.'];
                } else {
                    $response = ['success' => false, 'message' => 'Error deleting record: ' . $stmt->error];
                }
                $stmt->close();
            } else {
                $response = ['success' => false, 'message' => 'Failed to prepare statement: ' . $conn->error];
            }
            break;
    }
    echo json_encode($response);
    exit();
}
if (isset($_POST['action'])) {
    if ($_POST['action'] === 'register_user') {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $_POST['email'];
        $stmt = $conn->prepare("INSERT INTO users (username, password_hash, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $email);
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Registration successful. Please log in.']);
        } else {
            if ($conn->errno == 1062) {
                echo json_encode(['success' => false, 'message' => 'Registration failed. Username or Email might already exist.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Registration failed: ' . $stmt->error]);
            }
        }
        $stmt->close();
        exit();
    } elseif ($_POST['action'] === 'login') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $is_admin_login = isset($_POST['is_admin']) && $_POST['is_admin'] === 'true';
        $table = $is_admin_login ? 'admins' : 'users';
        $stmt = $conn->prepare("SELECT id, password_hash, username FROM {$table} WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $is_admin_login ? 'admin' : 'user';
            if (!$is_admin_login) {
                $update_stmt = $conn->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
                $update_stmt->bind_param("i", $user['id']);
                $update_stmt->execute();
                $update_stmt->close();
            }
            echo json_encode(['success' => true, 'message' => 'Login successful.', 'role' => $_SESSION['role']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
        }
        $stmt->close();
        exit();
    } elseif ($_POST['action'] === 'logout') {
        session_destroy();
        echo json_encode(['success' => true, 'message' => 'Logged out successfully.']);
        exit();
    }
}
// --- START: Replace from here ---

if (($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) || isset($_GET['action'])) {

    $action = $_POST['action'] ?? $_GET['action'];

    // Admin-only DB Actions
    if ($action === 'backup_db' || $action === 'restore_db') {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            die("Unauthorized access.");
        }

        if ($action === 'backup_db') {
            $backup_file = 'db_backup_' . $dbname . '_' . date("Y-m-d_H-i-s") . '.sql';

            // NOTE: mysqldump must be available in the system's PATH.
            $command = "mysqldump --user={$username} --password={$password} --host={$servername} {$dbname} > {$backup_file}";

            system($command, $result_code);

            if ($result_code === 0) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($backup_file) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($backup_file));
                readfile($backup_file);
                unlink($backup_file); // Delete file from server after download
                exit;
            } else {
                die("Error creating database backup.");
            }
        }

        if ($action === 'restore_db') {
            if (isset($_FILES['backup_file']) && $_FILES['backup_file']['error'] == UPLOAD_ERR_OK) {
                $file_tmp_path = $_FILES['backup_file']['tmp_name'];

                // NOTE: mysql client must be available in the system's PATH.
                $command = "mysql --user={$username} --password={$password} --host={$servername} {$dbname} < {$file_tmp_path}";

                system($command, $result_code);

                if ($result_code === 0) {
                    echo "<script>alert('Database restored successfully!'); window.location.href='index.php';</script>";
                } else {
                    echo "<script>alert('Error restoring database.'); window.location.href='index.php';</script>";
                }
                exit;
            } else {
                echo "<script>alert('File upload failed.'); window.location.href='index.php';</script>";
                exit;
            }
        }
    }

    // Existing User/Admin Auth Actions
    if ($action === 'register_user') {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $_POST['email'];

        $stmt = $conn->prepare("INSERT INTO users (username, password_hash, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $email);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Registration successful. Please log in.']);
        } else {
            if ($conn->errno == 1062) {
                echo json_encode(['success' => false, 'message' => 'Registration failed. Username or Email might already exist.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Registration failed: ' . $stmt->error]);
            }
        }
        $stmt->close();
        exit();
    } elseif ($action === 'login') {
        // Your existing login code...
        $username = $_POST['username'];
        $password = $_POST['password'];
        $is_admin_login = isset($_POST['is_admin']) && $_POST['is_admin'] === 'true';

        $table = $is_admin_login ? 'admins' : 'users';
        $stmt = $conn->prepare("SELECT id, password_hash, username FROM {$table} WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $is_admin_login ? 'admin' : 'user';

            if (!$is_admin_login) {
                $update_stmt = $conn->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
                $update_stmt->bind_param("i", $user['id']);
                $update_stmt->execute();
                $update_stmt->close();
            }

            echo json_encode(['success' => true, 'message' => 'Login successful.', 'role' => $_SESSION['role']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
        }
        $stmt->close();
        exit();
    } elseif ($action === 'logout') {
        session_destroy();
        echo json_encode(['success' => true, 'message' => 'Logged out successfully.']);
        exit();
    }
}
if (isset($_GET['api'])) {
    header('Content-Type: application/json');
    switch ($_GET['api']) {
        case 'get_daily_content':
            $response = [];
            $hadiths = fetchData($conn, 'hadiths');
            $day_of_year = (new DateTime())->format('z');
            $hadith_index = count($hadiths) > 0 ? ($day_of_year % count($hadiths)) : 0;
            $response['hadith_of_the_day'] = $hadiths[$hadith_index] ?? null;
            $quran_verses = fetchData($conn, 'quran_verses');
            $verse_index = count($quran_verses) > 0 ? ($day_of_year % count($quran_verses)) : 0;
            $response['quran_verse_of_the_day'] = $quran_verses[$verse_index] ?? null;
            $daily_duas = fetchData($conn, 'daily_duas');
            $dua_index = count($daily_duas) > 0 ? ($day_of_year % count($daily_duas)) : 0;
            $response['dua_of_the_day'] = $daily_duas[$dua_index] ?? null;
            $quiz_questions = fetchData($conn, 'quiz_questions');
            $question_index = count($quiz_questions) > 0 ? ($day_of_year % count($quiz_questions)) : 0;
            if (isset($quiz_questions[$question_index])) {
                $response['quiz_question_of_the_day'] = $quiz_questions[$question_index];
                $response['quiz_question_of_the_day']['options_ur'] = json_decode($response['quiz_question_of_the_day']['options_ur']);
                $response['quiz_question_of_the_day']['options_en'] = json_decode($response['quiz_question_of_the_day']['options_en']);
            } else {
                $response['quiz_question_of_the_day'] = null;
            }
            $seerah_events = fetchData($conn, 'seerah_events');
            foreach ($seerah_events as &$event) {
                $event['gregorian_date_iso'] = (new DateTime($event['gregorian_date']))->format(DATE_ISO8601);
            }
            $response['seerah_events'] = $seerah_events;
            $response['asma_ul_husna'] = fetchData($conn, 'asma_ul_husna');
            $response['prophet_names'] = fetchData($conn, 'prophet_names');
            echo json_encode($response);
            break;
        case 'crud':
            handleAdminCrud($conn);
            break;
        case 'get_calendar_events':
            $sql = "SELECT * FROM islamic_calendar_events";
            $result = $conn->query($sql);
            $events = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $events[] = $row;
                }
            }
            echo json_encode($events);
            break;
        case 'get_user_data':
            if (!isset($_SESSION['user_id'])) {
                http_response_code(401);
                echo json_encode(['error' => 'Not authenticated.']);
                exit();
            }
            $user_id = $_SESSION['user_id'];
            $user_data = fetchData($conn, 'users', 'id = ?', [$user_id]);
            $user_data = $user_data[0] ?? null;
            if ($user_data) {
                $user_data['settings'] = json_decode($user_data['settings'], true);
                $user_data['prayer_locations'] = fetchData($conn, 'user_prayer_locations', 'user_id = ?', [$user_id]);
                $user_data['daily_zikr'] = fetchData($conn, 'user_daily_zikr', 'user_id = ?', [$user_id]);
                $user_data['favorites'] = fetchData($conn, 'user_favorites', 'user_id = ?', [$user_id]);
            }
            echo json_encode(['success' => true, 'data' => $user_data]);
            break;
        case 'save_user_settings':
            if (!isset($_SESSION['user_id'])) {
                http_response_code(401);
                echo json_encode(['error' => 'Not authenticated.']);
                exit();
            }
            $user_id = $_SESSION['user_id'];
            $settings_data = json_decode(file_get_contents('php://input'), true);
            $settings_json = json_encode($settings_data['settings']);
            $stmt = $conn->prepare("UPDATE users SET settings = ? WHERE id = ?");
            $stmt->bind_param("si", $settings_json, $user_id);
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Settings saved successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error saving settings: ' . $stmt->error]);
            }
            $stmt->close();
            break;
        case 'add_user_prayer_location':
            if (!isset($_SESSION['user_id'])) {
                http_response_code(401);
                echo json_encode(['error' => 'Not authenticated.']);
                exit();
            }
            $user_id = $_SESSION['user_id'];
            $data = json_decode(file_get_contents('php://input'), true);
            $location_name = $data['location_name'];
            $latitude = $data['latitude'];
            $longitude = $data['longitude'];
            $calculation_method = $data['calculation_method'];
            $stmt = $conn->prepare("INSERT INTO user_prayer_locations (user_id, location_name, latitude, longitude, calculation_method) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("isdds", $user_id, $location_name, $latitude, $longitude, $calculation_method);
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Location added.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error adding location: ' . $stmt->error]);
            }
            $stmt->close();
            break;
        case 'delete_user_prayer_location':
            if (!isset($_SESSION['user_id'])) {
                http_response_code(401);
                echo json_encode(['error' => 'Not authenticated.']);
                exit();
            }
            $user_id = $_SESSION['user_id'];
            $data = json_decode(file_get_contents('php://input'), true);
            $location_id = $data['location_id'];
            $stmt = $conn->prepare("DELETE FROM user_prayer_locations WHERE id = ? AND user_id = ?");
            $stmt->bind_param("ii", $location_id, $user_id);
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Location deleted.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error deleting location: ' . $stmt->error]);
            }
            $stmt->close();
            break;
        case 'add_favorite':
            if (!isset($_SESSION['user_id'])) {
                http_response_code(401);
                echo json_encode(['error' => 'Not authenticated.']);
                exit();
            }
            $user_id = $_SESSION['user_id'];
            $data = json_decode(file_get_contents('php://input'), true);
            $item_type = $data['item_type'];
            $item_id = $data['item_id'];
            $existing = fetchData($conn, 'user_favorites', 'user_id = ? AND item_type = ? AND item_id = ?', [$user_id, $item_type, $item_id]);
            if (!empty($existing)) {
                echo json_encode(['success' => false, 'message' => 'Already favorited.']);
                break;
            }
            $stmt = $conn->prepare("INSERT INTO user_favorites (user_id, item_type, item_id) VALUES (?, ?, ?)");
            $stmt->bind_param("isi", $user_id, $item_type, $item_id);
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Added to favorites.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error adding favorite: ' . $stmt->error]);
            }
            $stmt->close();
            break;
        case 'remove_favorite':
            if (!isset($_SESSION['user_id'])) {
                http_response_code(401);
                echo json_encode(['error' => 'Not authenticated.']);
                exit();
            }
            $user_id = $_SESSION['user_id'];
            $data = json_decode(file_get_contents('php://input'), true);
            $item_type = $data['item_type'];
            $item_id = $data['item_id'];
            $stmt = $conn->prepare("DELETE FROM user_favorites WHERE user_id = ? AND item_type = ? AND item_id = ?");
            $stmt->bind_param("isi", $user_id, $item_type, $item_id);
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Removed from favorites.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error removing favorite: ' . $stmt->error]);
            }
            $stmt->close();
            break;
        case 'add_user_zikr':
            if (!isset($_SESSION['user_id'])) {
                http_response_code(401);
                echo json_encode(['error' => 'Not authenticated.']);
                exit();
            }
            $user_id = $_SESSION['user_id'];
            $data = json_decode(file_get_contents('php://input'), true);
            $zikr_text_arabic = $data['zikr_text_arabic'];
            $zikr_text_english = $data['zikr_text_english'];
            $zikr_text_urdu = $data['zikr_text_urdu'];
            $daily_target = $data['daily_target'];
            $stmt = $conn->prepare("INSERT INTO user_daily_zikr (user_id, zikr_text_arabic, zikr_text_english, zikr_text_urdu, daily_target) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("isssi", $user_id, $zikr_text_arabic, $zikr_text_english, $zikr_text_urdu, $daily_target);
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Zikr added.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error adding zikr: ' . $stmt->error]);
            }
            $stmt->close();
            break;
        case 'delete_user_zikr':
            if (!isset($_SESSION['user_id'])) {
                http_response_code(401);
                echo json_encode(['error' => 'Not authenticated.']);
                exit();
            }
            $user_id = $_SESSION['user_id'];
            $data = json_decode(file_get_contents('php://input'), true);
            $zikr_id = $data['zikr_id'];
            $stmt = $conn->prepare("DELETE FROM user_daily_zikr WHERE id = ? AND user_id = ?");
            $stmt->bind_param("ii", $zikr_id, $user_id);
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Zikr deleted.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error deleting zikr: ' . $stmt->error]);
            }
            $stmt->close();
            break;
        default:
            echo json_encode(['error' => 'Invalid API endpoint']);
            break;
    }
    $conn->close();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Prophet Muhammad (صلی اللہ علیہ و سلم) Islamic Hub">
    <meta name="description"
        content="A comprehensive Islamic application dedicated to Prophet Muhammad (PBUH), featuring Hijri calendar, event timelines, Hadith, Asma-ul-Husna, prayer times, Qibla direction, and more.">
    <meta name="keywords"
        content="Prophet Muhammad, Islam, Hijri Calendar, Mawlid, Hadith, Asma-ul-Husna, Prayer Times, Qibla, Islamic Events, Seerah, Migration, Badr, Mecca, Quran, Allah, Urdu, Arabic, PBUH, Pakistan, Yasin Ullah">
    <meta name="author" content="Yasin Ullah, Pakistan">
    <title>Prophet Muhammad (صلی اللہ علیہ و سلم) Islamic Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Calibri, Arial, sans-serif;
            text-align: center;
            background-image: linear-gradient(to bottom, #2980b9, #6ab0de);
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: background-color 0.5s ease;
        }

        body.dark-mode {
            background-image: linear-gradient(to bottom, #1a1a2e, #16213e);
            color: #e0e0e0;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.7);
        }

        .navbar.dark-mode {
            background-color: rgba(0, 0, 0, 0.9);
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }

        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            padding: 20px;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #ffffff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 15px;
            color: #f8f9fa;
        }

        .container-card {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 25px;
            border-radius: 15px;
            border: 2px solid #3498db;
            margin: 15px;
            max-width: 90%;
            width: 97%;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            transition: background-color 0.5s ease, border-color 0.5s ease;
        }

        .container-card.dark-mode {
            background-color: rgba(10, 10, 20, 0.8);
            border-color: #0f4c75;
        }

        .countdown-display,
        .total-info,
        .event-info,
        .hadith-text,
        .asma-name,
        .prophet-name,
        .qibla-display {
            font-size: 1.5rem;
            margin: 15px 0;
            line-height: 1.8;
            font-weight: bold;
            color: #e0f2f7;
        }

        .total-info {
            font-size: 1.2rem !important;
            margin-top: 10px;
            color: #cfd8dc;
        }

        .form-label,
        .modal-title,
        .modal-body label {
            color: white;
        }

        .modal-content {
            background-color: #1f2833;
            color: white;
        }

        .modal-header,
        .modal-footer {
            border-bottom: 1px solid #0f4c75;
            border-top: none;
        }

        .modal-body .form-control,
        .modal-body .form-select {
            background-color: #2c394b;
            color: white;
            border: 1px solid #0f4c75;
        }

        .btn-close-white {
            filter: invert(1);
        }

        .timeline-container {
            overflow-x: auto;
            white-space: nowrap;
            padding: 20px 0;
            margin-bottom: 30px;
        }

        .timeline {
            display: inline-block;
            position: relative;
            padding-top: 1px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            top: 25px;
            height: 4px;
            background-color: #3498db;
        }

        .timeline-event {
            display: inline-block;
            width: 200px;
            margin: 0 50px;
            position: relative;
            text-align: center;
            vertical-align: top;
            cursor: pointer;
        }

        .timeline-event::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            background-color: #2980b9;
            border-radius: 50%;
            border: 3px solid #fff;
            z-index: 1;
        }

        .timeline-event-content {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 15px;
            border-radius: 10px;
            margin-top: 30px;
            font-size: 0.9rem;
            line-height: 1.4;
            white-space: normal;
            transition: background-color 0.3s ease;
        }

        .timeline-event-content:hover {
            background-color: rgba(52, 152, 219, 0.8);
        }

        .language-options button {
            margin: 5px;
        }

        .share-buttons button {
            margin: 5px;
            font-size: 1.2rem;
        }

        .qibla-container {
            position: relative;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background-color: #34495e;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px auto;
            overflow: hidden;
        }

        .compass-arrow {
            position: absolute;
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-bottom: 80px solid #e74c3c;
            transform-origin: bottom center;
            top: 10%;
            transition: transform 0.5s ease-out;
        }

        #qiblaMap {
            height: 300px;
            width: 100%;
            margin-top: 20px;
            border-radius: 10px;
        }

        .font-size-controls button {
            margin: 5px;
        }

        .hadith-container {
            min-height: 150px;
        }

        .asma-list,
        .prophet-names-list {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #3498db;
            border-radius: 8px;
            padding: 10px;
        }

        .asma-item,
        .prophet-name-item {
            padding: 8px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: right;
        }

        .asma-item:last-child,
        .prophet-name-item:last-child {
            border-bottom: none;
        }

        .asma-item strong,
        .prophet-name-item strong {
            display: block;
            font-size: 1.3rem;
            margin-bottom: 5px;
            color: #85c1e9;
        }

        .footer {
            margin-top: auto;
            padding: 15px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            font-size: 0.9rem;
        }

        #quranVerseDisplay .verse-arabic {
            font-family: Calibri, Arial, sans-serif;
            font-size: 2.2rem;
            line-height: 1.8;
            margin-bottom: 10px;
        }

        #quranVerseDisplay .verse-transliteration {
            font-size: 1rem;
            font-style: italic;
            color: #ccc;
        }

        #quranVerseDisplay .verse-translation {
            font-size: 1.1rem;
            margin-top: 10px;
            color: #e0f2f7;
        }

        #quranVerseDisplay .verse-source {
            font-size: 0.9rem;
            color: #cfd8dc;
            margin-top: 5px;
        }

        #quranVerseDisplay .audio-player {
            margin-top: 15px;
            width: 100%;
            background-color: #2c394b;
            border-radius: 5px;
        }

        #duaDisplay .dua-arabic {
            font-family: Calibri, Arial, sans-serif;
            font-size: 2rem;
            line-height: 1.8;
            margin-bottom: 10px;
        }

        #duaDisplay .dua-transliteration {
            font-size: 1rem;
            font-style: italic;
            color: #ccc;
        }

        #duaDisplay .dua-translation {
            font-size: 1.1rem;
            margin-top: 10px;
            color: #e0f2f7;
        }

        .tasbih-counter {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .tasbih-count {
            font-size: 3rem;
            font-weight: bold;
            color: #85c1e9;
            margin-bottom: 10px;
        }

        .tasbih-button {
            padding: 15px 30px;
            font-size: 1.5rem;
            border-radius: 50px;
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .tasbih-button:hover {
            background-color: #2980b9;
        }

        .tasbih-reset {
            margin-top: 10px;
            font-size: 0.9rem;
            color: #ccc;
            cursor: pointer;
            text-decoration: underline;
        }

        .calendar-nav button {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            margin-top: 15px;
        }

        .calendar-day-header {
            font-weight: bold;
            font-size: 0.9rem;
            padding: 5px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        .calendar-day {
            padding: 8px 0;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            font-size: 0.85rem;
            cursor: pointer;
            min-height: 60px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            position: relative;
        }

        .calendar-day.empty {
            background-color: rgba(255, 255, 255, 0.05);
            cursor: default;
        }

        .calendar-day.today {
            background-color: #28a745;
            border-color: #28a745;
        }

        .calendar-day.highlighted {
            background-color: #007bff;
            border-color: #007bff;
        }

        .calendar-day span.gregorian {
            font-size: 0.7rem;
            color: #b0c4de;
        }

        .calendar-day .event-dot {
            width: 8px;
            height: 8px;
            background-color: yellow;
            border-radius: 50%;
            position: absolute;
            top: 5px;
            right: 5px;
        }

        .quiz-question {
            font-size: 1.3rem;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .quiz-options button {
            width: 100%;
            padding: 12px;
            margin-bottom: 10px;
            background-color: #34495e;
            color: white;
            border: 1px solid #4a657f;
            border-radius: 8px;
            text-align: center;
            font-size: 1rem;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .quiz-options button:hover {
            background-color: #4a657f;
        }

        .quiz-options button.correct {
            background-color: #28a745;
            border-color: #28a745;
        }

        .quiz-options button.incorrect {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .quiz-feedback {
            margin-top: 20px;
            font-size: 1rem;
            color: #e0f2f7;
            text-align: left;
        }

        .quiz-next-button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1.1rem;
        }

        .favorite-btn {
            background: none;
            border: none;
            color: #ffc107;
            font-size: 1.5rem;
            cursor: pointer;
            margin-left: 10px;
        }

        .favorite-btn.favorited {
            color: #ffda07;
            filter: drop-shadow(0 0 5px #ffda07);
        }

        .admin-crud-table {
            width: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .admin-crud-table th,
        .admin-crud-table td {
            padding: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            text-align: left;
            word-break: break-word;
        }

        .admin-crud-table th {
            background-color: #0f4c75;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .admin-crud-table tbody tr:nth-child(even) {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .admin-crud-table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.3);
        }

        .admin-crud-actions button {
            margin-right: 5px;
            white-space: nowrap;
        }

        .admin-crud-actions .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .admin-crud-actions .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }

        .admin-crud-actions .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .admin-crud-form-group {
            margin-bottom: 15px;
        }

        .admin-crud-form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .admin-crud-form-group input,
        .admin-crud-form-group textarea,
        .admin-crud-form-group select {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #0f4c75;
            background-color: #2c394b;
            color: white;
        }

        .admin-crud-form-group textarea {
            min-height: 80px;
            resize: vertical;
        }

        .admin-crud-form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .modal-body.admin-crud-edit {
            max-height: 70vh;
            overflow-y: auto;
        }

        .user-fav-list li,
        .user-zikr-list li,
        .user-location-list li {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
            margin-bottom: 8px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-fav-list li span,
        .user-zikr-list li span,
        .user-location-list li span {
            flex-grow: 1;
            text-align: right;
            padding-left: 10px;
        }

        .user-fav-list li button,
        .user-zikr-list li button,
        .user-location-list li button {
            flex-shrink: 0;
        }

        #authModalMessage {
            margin-top: 15px;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            h2 {
                font-size: 1.7rem;
            }

            .countdown-display,
            .event-info,
            .hadith-text,
            .asma-name,
            .prophet-name,
            .qibla-display {
                font-size: 1.2rem;
            }

            .total-info {
                font-size: 1rem;
            }

            .timeline-event {
                width: 150px;
                margin: 0 20px;
            }

            .timeline-event-content {
                font-size: 0.8rem;
            }

            #quranVerseDisplay .verse-arabic {
                font-size: 1.8rem;
            }

            #duaDisplay .dua-arabic {
                font-size: 1.6rem;
            }

            .tasbih-count {
                font-size: 2.5rem;
            }

            .tasbih-button {
                padding: 10px 20px;
                font-size: 1.2rem;
            }

            .calendar-day {
                min-height: 50px;
                font-size: 0.75rem;
            }

            .calendar-day span.gregorian {
                font-size: 0.6rem;
            }

            .quiz-question {
                font-size: 1.1rem;
            }

            .quiz-options button {
                font-size: 0.9rem;
                padding: 10px;
            }
        }

        @media (max-width: 576px) {
            h1 {
                font-size: 1.8rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            .container-card {
                padding: 15px;
                margin: 10px;
            }

            .countdown-display,
            .event-info,
            .hadith-text,
            .asma-name,
            .prophet-name,
            .qibla-display {
                font-size: 1rem;
            }

            .total-info {
                font-size: 0.9rem;
            }

            .timeline-event {
                width: 120px;
                margin: 0 10px;
            }

            #quranVerseDisplay .verse-arabic {
                font-size: 1.5rem;
            }

            #duaDisplay .dua-arabic {
                font-size: 1.3rem;
            }

            .tasbih-count {
                font-size: 2rem;
            }

            .tasbih-button {
                padding: 8px 15px;
                font-size: 1rem;
            }

            .calendar-day {
                min-height: 40px;
                font-size: 0.7rem;
            }

            .quiz-question {
                font-size: 1rem;
            }

            .quiz-options button {
                font-size: 0.8rem;
                padding: 8px;
            }
        }
    </style>
    <link rel="manifest" href="manifest.json">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>

<body>
    <div class="modal fade" id="restoreDbModal" tabindex="-1" aria-labelledby="restoreDbModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="restoreDbModalLabel">Restore Database</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-danger">Warning: This will overwrite the current database. Proceed with caution.</p>
                    <form action="index.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="restore_db">
                        <div class="mb-3">
                            <label for="backup_file" class="form-label">Select SQL Backup File</label>
                            <input class="form-control bg-secondary text-white" type="file" name="backup_file" id="backup_file" accept=".sql" required>
                        </div>
                        <button type="submit" class="btn btn-warning">Upload and Restore</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">صلی اللہ علیہ و سلم</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php#birthCountdown"
                            data-translate-key="اہم تاریخیں">اہم تاریخیں</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#seerahEvents"
                            data-translate-key="سیرت کے واقعات">سیرت کے واقعات</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#hadithOfTheDay"
                            data-translate-key="حدیثِ مبارکہ">حدیثِ مبارکہ</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#quranVerseOfTheDay"
                            data-translate-key="قرآنی آیت">قرآنی آیت</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#dailyDuaAndZikr"
                            data-translate-key="دعا و ذکر">دعا و ذکر</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#islamicCalendar"
                            data-translate-key="اسلامی کیلنڈر">اسلامی کیلنڈر</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#islamicQuiz"
                            data-translate-key="اسلامی کوئز">اسلامی کوئز</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#asmaUlHusna"
                            data-translate-key="اسمائے حسنیٰ">اسمائے حسنیٰ</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#prophetNames"
                            data-translate-key="نبی اکرم کے القاب">نبی اکرم کے القاب</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#prayerTimesSection"
                            data-translate-key="اوقاتِ نماز">اوقاتِ نماز</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal"
                            data-bs-target="#dateConverterModal" data-translate-key="تاریخ کنورٹر">تاریخ کنورٹر</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal"
                            data-bs-target="#settingsModal" data-translate-key="ترتیبات">ترتیبات</a></li>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="?page=admin_dashboard"
                                data-translate-key="ایڈمن ڈیش بورڈ">ایڈمن ڈیش بورڈ</a></li>
                    <?php elseif (isset($_SESSION['user_id']) && $_SESSION['role'] === 'user'): ?>
                        <li class="nav-item"><a class="nav-link" href="?page=user_dashboard"
                                data-translate-key="یوزر ڈیش بورڈ">یوزر ڈیش بورڈ</a></li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin'): ?>
<li class="nav-item"><a class="nav-link" href="index.php?action=backup_db" data-translate-key="بیک اپ">بیک اپ</a></li>
<li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#restoreDbModal" data-translate-key="بحال کریں">بحال کریں</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="hadith.php" data-translate-key="تمام احادیث">All Hadiths</a></li>
                    <li class="nav-item"><a class="nav-link" href="quran.php" data-translate-key="تمام قرآنی آیات">All Quran Verses</a></li>
                    <li class="nav-item">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a class="nav-link" href="#" onclick="logout()"
                                data-translate-key="لاگ آؤٹ">لاگ آؤٹ</a>
                        <?php else: ?>
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#authModal"
                                data-translate-key="لاگ ان">لاگ ان</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="main-content">
        <?php if (isset($_GET['page']) && $_GET['page'] === 'admin_dashboard'): ?>
            <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin'): ?>
                <div class="container-card animate__animated animate__fadeInUp mt-4" style="max-width: 95%; width: auto;">
                    <h2 data-translate-key="ایڈمن ڈیش بورڈ">ایڈمن ڈیش بورڈ</h2>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="adminCrudTableSelect" class="form-label"
                                data-translate-key="ٹیبل منتخب کریں">ٹیبل منتخب کریں:</label>
                            <select class="form-select bg-secondary text-white border-0" id="adminCrudTableSelect">
                                <option value="hadiths" data-translate-key="احادیث">احادیث</option>
                                <option value="quran_verses" data-translate-key="قرآنی آیات">قرآنی آیات</option>
                                <option value="daily_duas" data-translate-key="روزانہ کی دعائیں">روزانہ کی دعائیں</option>
                                <option value="quiz_questions" data-translate-key="کوئز سوالات">کوئز سوالات</option>
                                <option value="seerah_events" data-translate-key="سیرت کے واقعات">سیرت کے واقعات</option>
                                <option value="asma_ul_husna" data-translate-key="اسمائے حسنیٰ">اسمائے حسنیٰ</option>
                                <option value="prophet_names" data-translate-key="نبی اکرم کے القاب">نبی اکرم کے القاب</option>
                                <option value="islamic_calendar_events" data-translate-key="اسلامی کیلنڈر کے واقعات">اسلامی کیلنڈر کے واقعات</option>
                                <option value="users" data-translate-key="صارفین">صارفین</option>
                                <option value="admins" data-translate-key="ایڈمنز">ایڈمنز</option>
                                <option value="quran_recitations" data-translate-key="قرآن کی تلاوت">قرآن کی تلاوت</option>
                            </select>
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <button class="btn btn-success w-100" onclick="openAdminCrudModal('create')"
                                data-translate-key="نیا ریکارڈ شامل کریں">نیا ریکارڈ شامل کریں</button>
                        </div>
                    </div>
                    <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                        <table class="table table-bordered admin-crud-table">
                            <thead id="adminCrudTableHeader"></thead>
                            <tbody id="adminCrudTableBody"></tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-danger mt-5" role="alert" data-translate-key="آپ کو اس صفحے تک رسائی حاصل نہیں ہے۔">
                    آپ کو اس صفحے تک رسائی حاصل نہیں ہے۔
                </div>
            <?php endif; ?>
        <?php elseif (isset($_GET['page']) && $_GET['page'] === 'user_dashboard'): ?>
            <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'user'): ?>
                <div class="container-card animate__animated animate__fadeInUp mt-4" style="max-width: 95%; width: auto;">
                    <h2 data-translate-key="یوزر ڈیش بورڈ">یوزر ڈیش بورڈ</h2>
                    <h3 class="mt-4" data-translate-key="پسندیدہ آئٹمز">پسندیدہ آئٹمز</h3>
                    <ul class="list-unstyled text-start user-fav-list" id="userFavoritesList">
                        <li data-translate-key="کوئی پسندیدہ آئٹم نہیں">کوئی پسندیدہ آئٹم نہیں</li>
                    </ul>
                    <h3 class="mt-4" data-translate-key="میری ذاتی ذکر/دعائیں">میری ذاتی ذکر/دعائیں</h3>
                    <ul class="list-unstyled text-start user-zikr-list" id="userZikrList">
                        <li data-translate-key="کوئی ذاتی ذکر/دعا شامل نہیں کی گئی۔">کوئی ذاتی ذکر/دعا شامل نہیں کی گئی۔</li>
                    </ul>
                    <button class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#addZikrModal"
                        data-translate-key="نیا ذکر/دعا شامل کریں">نیا ذکر/دعا شامل کریں</button>
                    <h3 class="mt-4" data-translate-key="محفوظ کردہ اوقاتِ نماز کی جگہیں">محفوظ کردہ اوقاتِ نماز کی جگہیں</h3>
                    <ul class="list-unstyled text-start user-location-list" id="userPrayerLocationsList">
                        <li data-translate-key="کوئی محفوظ کردہ جگہ نہیں۔">کوئی محفوظ کردہ جگہ نہیں۔</li>
                    </ul>
                    <button class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#addLocationModal"
                        data-translate-key="نیا مقام شامل کریں">نیا مقام شامل کریں</button>
                </div>
            <?php else: ?>
                <div class="alert alert-danger mt-5" role="alert" data-translate-key="آپ کو اس صفحے تک رسائی حاصل نہیں ہے۔">
                    آپ کو اس صفحے تک رسائی حاصل نہیں ہے۔
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="container-card animate__animated animate__fadeInUp" id="birthCountdown">
                <h2 data-translate-key="ولادت کا وقت (Birth Countdown):">ولادت کا وقت (Birth Countdown):</h2>
                <div id="countdownBirth" class="countdown-display"></div>
                <div id="totalDaysMonthsBirth" class="total-info"></div>
                <h2 data-translate-key="اگلی ولادت کی سالگرہ (Next Mawlid)">اگلی ولادت کی سالگرہ (Next Mawlid):</h2>
                <div id="nextMawlidCountdown" class="countdown-display"></div>
                <div class="mt-3">
                    <button class="btn btn-info share-buttons"
                        onclick="shareContent('nextMawlidCountdown', 'اگلی ولادت کی سالگرہ')"><i
                            class="fas fa-share-alt"></i></button>
                </div>
            </div>
            <div class="container-card animate__animated animate__fadeInUp" id="deathCountdown">
                <h2 data-translate-key="وفات کا وقت (Death Countdown):">وفات کا وقت (Death Countdown):</h2>
                <div id="countdownDeath" class="countdown-display"></div>
                <div id="totalDaysMonthsDeath" class="total-info"></div>
                <h2 style="display: none;" data-translate-key="وفات کی اگلی سالگرہ (Next Death Anniversary)">وفات کی اگلی سالگرہ (Next Death
                    Anniversary):</h2>
                <div style="display: none;" id="nextDeathCountdown" class="countdown-display"></div>
                <div class="mt-3">
                    <button class="btn btn-info share-buttons"
                        onclick="shareContent('nextDeathCountdown', 'وفات کی اگلی سالگرہ')"><i
                            class="fas fa-share-alt"></i></button>
                </div>
            </div>
            <div class="container-card animate__animated animate__fadeInUp" id="todayInSeerah">
                <h2 data-translate-key="آج سیرت میں (On This Day in Seerah)">آج سیرت میں (On This Day in Seerah):</h2>
                <div id="seerahEventToday" class="event-info"></div>
                <div class="mt-3">
                    <button class="btn btn-info share-buttons" onclick="shareContent('seerahEventToday', 'آج سیرت میں')"><i
                            class="fas fa-share-alt"></i></button>
                </div>
            </div>
            <div class="container-card animate__animated animate__fadeInUp hadith-container" id="hadithOfTheDay">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="mb-0" data-translate-key="آج کی حدیث (Hadith of the Day)">آج کی حدیث (Hadith of the Day):</h2>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'user'): ?>
                        <button class="favorite-btn" data-item-type="hadith" data-item-id="" onclick="toggleFavorite(this)">
                            <i class="far fa-star"></i>
                        </button>
                    <?php endif; ?>
                </div>
                <div id="currentHadith" class="hadith-text"></div>
                <div id="hadithSource" class="total-info text-end"></div>
                <div class="mt-3">
                    <button class="btn btn-info share-buttons" onclick="shareContent('currentHadith', 'آج کی حدیث')"><i
                            class="fas fa-share-alt"></i></button>
                </div>
            </div>
            <div class="container-card animate__animated animate__fadeInUp" id="quranVerseOfTheDay">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="mb-0" data-translate-key="قرآنی آیت (Quranic Verse of the Day)">آج کی قرآنی آیت (Quranic Verse of the Day):</h2>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'user'): ?>
                        <button class="favorite-btn" data-item-type="quran_verse" data-item-id="" onclick="toggleFavorite(this)">
                            <i class="far fa-star"></i>
                        </button>
                    <?php endif; ?>
                </div>
                <div id="quranVerseDisplay" class="total-info text-center">
                    <p class="verse-arabic" dir="rtl"></p>
                    <p class="verse-transliteration"></p>
                    <p class="verse-translation"></p>
                    <p class="verse-source"></p>
                    <audio controls class="audio-player"></audio>
                </div>
                <div class="mt-3">
                    <button class="btn btn-info share-buttons"
                        onclick="shareContent('quranVerseDisplay', 'آج کی قرآنی آیت')"><i
                            class="fas fa-share-alt"></i></button>
                </div>
            </div>
            <div class="container-card animate__animated animate__fadeInUp" id="dailyDuaAndZikr">
                <h2 data-translate-key="روزانہ کی دعا اور ذکر (Daily Dua & Zikr)">روزانہ کی دعا اور ذکر (Daily Dua & Zikr):
                </h2>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0" data-translate-key="آج کی دعا (Dua of the Day)">آج کی دعا:</h3>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'user'): ?>
                        <button class="favorite-btn" data-item-type="dua" data-item-id="" onclick="toggleFavorite(this)">
                            <i class="far fa-star"></i>
                        </button>
                    <?php endif; ?>
                </div>
                <div id="duaDisplay" class="total-info text-center">
                    <p class="dua-arabic" dir="rtl"></p>
                    <p class="dua-transliteration"></p>
                    <p class="dua-translation"></p>
                    <p class="dua-source"></p>
                </div>
                <h3 class="mt-4" data-translate-key="ذکر کاؤنٹر (Zikr Counter)">ذکر کاؤنٹر:</h3>
                <div class="tasbih-counter">
                    <div class="tasbih-count" id="tasbihCount">0</div>
                    <button class="tasbih-button" onclick="incrementTasbih()"><i class="fas fa-plus"></i></button>
                    <span class="tasbih-reset" onclick="resetTasbih()"
                        data-translate-key="ری سیٹ کریں (Reset)">ری سیٹ کریں</span>
                </div>
                <div class="mt-3">
                    <button class="btn btn-info share-buttons" onclick="shareContent('duaDisplay', 'آج کی دعا')"><i
                            class="fas fa-share-alt"></i></button>
                </div>
            </div>
            <div class="container-card animate__animated animate__fadeInUp" id="islamicCalendar">
                <h2 data-translate-key="اسلامی کیلنڈر (Islamic Calendar)">اسلامی کیلنڈر (Islamic Calendar):</h2>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <button class="btn btn-primary" onclick="changeMonth(-1)"><i class="fas fa-chevron-left"></i></button>
                    <h3 id="currentHijriMonthYear" class="mb-0"></h3>
                    <button class="btn btn-primary" onclick="changeMonth(1)"><i class="fas fa-chevron-right"></i></button>
                </div>
                <div class="calendar-grid" id="calendarGrid">
                    <div class="calendar-day-header" data-translate-key="اتوار">اتوار</div>
                    <div class="calendar-day-header" data-translate-key="پیر">پیر</div>
                    <div class="calendar-day-header" data-translate-key="منگل">منگل</div>
                    <div class="calendar-day-header" data-translate-key="بدھ">بدھ</div>
                    <div class="calendar-day-header" data-translate-key="جمعرات">جمعرات</div>
                    <div class="calendar-day-header" data-translate-key="جمعہ">جمعہ</div>
                    <div class="calendar-day-header" data-translate-key="ہفتہ">ہفتہ</div>
                </div>
            </div>
            <div class="container-card animate__animated animate__fadeInUp" id="islamicQuiz">
                <h2 data-translate-key="اسلامی کوئز (Islamic Quiz)">اسلامی کوئز (Islamic Quiz):</h2>
                <div id="quizQuestion" class="quiz-question"></div>
                <div id="quizOptions" class="quiz-options d-grid gap-2">
                </div>
                <div id="quizFeedback" class="quiz-feedback"></div>
                <button id="nextQuizQuestionBtn" class="btn btn-primary quiz-next-button"
                    data-translate-key="اگلا سوال (Next Question)" style="display: none;"
                    onclick="loadQuizQuestion()">اگلا سوال</button>
                <div class="mt-3">
                    <button class="btn btn-info share-buttons" onclick="shareContent('quizQuestion', 'اسلامی کوئز')"><i
                            class="fas fa-share-alt"></i></button>
                </div>
            </div>
            <div class="container-card animate__animated animate__fadeInUp" id="seerahEvents">
                <h2 data-translate-key="سیرتِ نبوی کے اہم واقعات (Key Events from Seerah)">سیرتِ نبوی کے اہم واقعات (Key Events
                    from Seerah):</h2>
                <div class="timeline-container">
                    <div class="timeline" id="prophetTimeline">
                    </div>
                </div>
            </div>
            <div class="container-card animate__animated animate__fadeInUp" id="asmaUlHusna">
                <h2 data-translate-key="اللہ کے 99 نام (99 Names of Allah - Asma-ul-Husna)">اللہ کے 99 نام (99 Names of Allah
                    - Asma-ul-Husna):</h2>
                <div class="asma-list">
                </div>
            </div>
            <div class="container-card animate__animated animate__fadeInUp" id="prophetNames">
                <h2 data-translate-key="نبی اکرم (صلی اللہ علیہ و سلم) کے القاب (Names & Titles of the Prophet ﷺ)">نبی اکرم
                    (صلی اللہ علیہ و سلم) کے القاب (Names & Titles of the Prophet ﷺ):</h2>
                <div class="prophet-names-list">
                </div>
            </div>
            <div class="container-card animate__animated animate__fadeInUp" id="prayerTimesSection">
                <h2 data-translate-key="اوقاتِ نماز (Prayer Times)">اوقاتِ نماز (Prayer Times):</h2>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="prayerLocation" class="form-label"
                            data-translate-key="اپنا شہر درج کریں (Enter your City)">اپنا شہر درج کریں (Enter your
                            City):</label>
                        <input type="text" class="form-control bg-secondary text-white border-0" id="prayerLocation"
                            data-translate-key-placeholder="مثلاً: لاہور, پاکستان" placeholder="مثلاً: لاہور, پاکستان">
                    </div>
                    <div class="col-md-6 mt-3 mt-md-0">
                        <label for="calculationMethod" class="form-label"
                            data-translate-key="طریقہ حساب (Calculation Method)">طریقہ حساب (Calculation Method):</label>
                        <select class="form-select bg-secondary text-white border-0" id="calculationMethod">
                            <option value="Karachi">University of Islamic Sciences, Karachi</option>
                            <option value="MuslimWorldLeague">Muslim World League</option>
                            <option value="NorthAmerica">ISNA (North America)</option>
                            <option value="UmmAlQura">Umm al-Qura University, Makkah</option>
                            <option value="Egyptian">Egyptian General Authority of Survey</option>
                            <option value="Tehran">Institute of Geophysics, University of Tehran</option>
                            <option value="Turkey">Diyanet (Turkey)</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary mb-3" onclick="getPrayerTimes()"
                    data-translate-key="اوقاتِ نماز حاصل کریں">اوقاتِ نماز حاصل کریں</button>
                <div id="prayerTimesDisplay" class="total-info">
                </div>
            </div>
            <div class="container-card animate__animated animate__fadeInUp" id="qiblaDirectionSection">
                <h2 data-translate-key="قبلہ کی سمت (Qibla Direction)">قبلہ کی سمت (Qibla Direction):</h2>
                <div class="qibla-container">
                    <div class="compass-arrow" id="qiblaArrow"></div>
                    <i class="fas fa-compass fa-spin text-white" style="font-size: 80px;"></i>
                </div>
                <div id="qiblaMap"></div>
                <div id="qiblaInfo" class="total-info mt-3"
                    data-translate-key="براہ کرم مقام کی اجازت دیں۔ (Please allow location access.)">براہ کرم مقام کی اجازت
                    دیں۔ (Please allow location access.)
                </div>
            </div>
            <div class="container-card animate__animated animate__fadeInUp" id="sourcesSection">
                <h2 data-translate-key="ماخذ اور کتابیات (Sources & Bibliography)">ماخذ اور کتابیات (Sources &
                    Bibliography):</h2>
                <div class="total-info text-start">
                    <ul>
                        <li>سیرت ابن ہشام (Seerat Ibn Hisham)</li>
                        <li>صحیح بخاری (Sahih Bukhari)</li>
                        <li>صحیح مسلم (Sahih Muslim)</li>
                        <li>سنن ابی داؤد (Sunan Abu Dawud)</li>
                        <li>جامع الترمذی (Jami` at-Tirmidhi)</li>
                        <li>سنن نسائی (Sunan an-Nasa'i)</li>
                        <li>سنن ابن ماجہ (Sunan Ibn Majah)</li>
                        <li>(Additional scholarly Islamic texts and historical records)</li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="modal fade" id="settingsModal" tabindex="-1" aria-labelledby="settingsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="settingsModalLabel" data-translate-key="ترتیبات (Settings)">ترتیبات
                        (Settings)</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="dateSettingsForm">
                        <div class="mb-3">
                            <label for="birthDateInput" class="form-label"
                                data-translate-key="تاریخِ ولادت (Gregorian Birth Date)">تاریخِ ولادت (Gregorian Birth
                                Date):</label>
                            <input type="date" class="form-control bg-secondary text-white border-0"
                                id="birthDateInput">
                        </div>
                        <div class="mb-3">
                            <label for="deathDateInput" class="form-label"
                                data-translate-key="تاریخِ وفات (Gregorian Death Date)">تاریخِ وفات (Gregorian Death
                                Date):</label>
                            <input type="date" class="form-control bg-secondary text-white border-0"
                                id="deathDateInput">
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block" id="theme-label"
                                data-translate-key="تھیم (Theme)">تھیم (Theme):</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="themeMode" id="lightMode"
                                    value="light" checked>
                                <label class="form-check-label" for="lightMode"
                                    data-translate-key="روشنی (Light)">روشنی (Light)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="themeMode" id="darkMode"
                                    value="dark">
                                <label class="form-check-label" for="darkMode"
                                    data-translate-key="تاریک (Dark)">تاریک (Dark)</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block" id="font-size-label"
                                data-translate-key="فونٹ سائز (Font Size)">فونٹ سائز (Font Size):</label>
                            <div class="font-size-controls">
                                <button type="button" class="btn btn-sm btn-outline-light"
                                    onclick="changeFontSize(-2)">A-</button>
                                <button type="button" class="btn btn-sm btn-outline-light"
                                    onclick="changeFontSize(2)">A+</button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="languageSelect"
                                data-translate-key="زبان (Language)">زبان (Language):</label>
                            <select class="form-select bg-secondary text-white border-0" id="languageSelect">
                                <option value="ur">اردو (Urdu)</option>
                                <option value="en">English</option>
                                <option value="ar">العربية (Arabic)</option>
                                <option value="id">Bahasa Indonesia</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100"
                            data-translate-key="محفوظ کریں (Save Changes)">محفوظ کریں (Save Changes)</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="eventDetailModal" tabindex="-1" aria-labelledby="eventDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="eventDetailModalLabel"
                        data-translate-key="واقعہ کی تفصیل (Event Details)">واقعہ کی تفصیل (Event Details)</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <h3 id="modalEventTitle" class="text-primary mb-3"></h3>
                    <p id="modalEventGregorianDate"></p>
                    <p id="modalEventHijriDate"></p>
                    <p id="modalEventDescription"></p>
                    <h6 class="mt-4"><span id="modal-source-label" data-translate-key="حوالہ (Source)">حوالہ (Source):
                        </span><span id="modalEventSource" class="text-info"></span></h6>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        data-translate-key="بند کریں (Close)">بند کریں (Close)</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="calendarEventDetailModal" tabindex="-1"
        aria-labelledby="calendarEventDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="calendarEventDetailModalLabel"
                        data-translate-key="کیلنڈر ایونٹ کی تفصیل (Calendar Event Details)">کیلنڈر ایونٹ کی تفصیل (Calendar
                        Event Details)</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <h3 id="modalCalendarEventTitle" class="text-primary mb-3"></h3>
                    <p id="modalCalendarEventHijriDate"></p>
                    <p id="modalCalendarEventDescription"></p>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        data-translate-key="بند کریں (Close)">بند کریں (Close)</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="dateConverterModal" tabindex="-1" aria-labelledby="dateConverterModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="dateConverterModalLabel"
                        data-translate-key="تاریخ کنورٹر (Date Converter)">تاریخ کنورٹر (Date Converter)</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="gregorianToHijriInput" class="form-label"
                            data-translate-key="عیسوی تاریخ (Gregorian Date)">عیسوی تاریخ (Gregorian Date):</label>
                        <input type="date" class="form-control bg-secondary text-white border-0"
                            id="gregorianToHijriInput">
                        <button class="btn btn-primary mt-2 w-100" onclick="convertGregorianToHijri()"
                            data-translate-key="عیسوی سے ہجری (Gregorian to Hijri)">عیسوی سے ہجری (Gregorian to
                            Hijri)</button>
                        <p id="convertedHijriDate" class="mt-2"></p>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label for="hijriYearInput" class="form-label"
                            data-translate-key="ہجری سال (Hijri Year)">ہجری سال (Hijri Year):</label>
                        <input type="number" class="form-control bg-secondary text-white border-0" id="hijriYearInput"
                            min="1" value="1445">
                        <label for="hijriMonthInput" class="form-label"
                            data-translate-key="ہجری ماہ (Hijri Month)">ہجری ماہ (Hijri Month):</label>
                        <select class="form-select bg-secondary text-white border-0" id="hijriMonthInput">
                            <option value="1" data-translate-key="محرم (Muharram)">محرم (Muharram)</option>
                            <option value="2" data-translate-key="صفر (Safar)">صفر (Safar)</option>
                            <option value="3" data-translate-key="ربیع الاول (Rabi' al-Awwal)">ربیع الاول (Rabi'
                                al-Awwal)</option>
                            <option value="4" data-translate-key="ربیع الثانی (Rabi' al-Thani)">ربیع الثانی (Rabi'
                                al-Thani)</option>
                            <option value="5" data-translate-key="جمادی الاول (Jumada al-Ula)">جمادی الاول (Jumada
                                al-Ula)</option>
                            <option value="6" data-translate-key="جمادی الثانی (Jumada al-Akhira)">جمادی الثانی (Jumada
                                al-Akhira)</option>
                            <option value="7" data-translate-key="رجب (Rajab)">رجب (Rajab)</option>
                            <option value="8" data-translate-key="شعبان (Sha'ban)">شعبان (Sha'ban)</option>
                            <option value="9" data-translate-key="رمضان (Ramadan)">رمضان (Ramadan)</option>
                            <option value="10" data-translate-key="شوال (Shawwal)">شوال (Shawwal)</option>
                            <option value="11" data-translate-key="ذوالقعدہ (Dhul-Qadah)">ذوالقعدہ (Dhul-Qadah)</option>
                            <option value="12" data-translate-key="ذوالحجہ (Dhul-Hijjah)">ذوالحجہ (Dhul-Hijjah)</option>
                        </select>
                        <label for="hijriDayInput" class="form-label" data-translate-key="ہجری دن (Hijri Day)">ہجری دن
                            (Hijri Day):</label>
                        <input type="number" class="form-control bg-secondary text-white border-0" id="hijriDayInput"
                            min="1" max="30" value="1">
                        <button class="btn btn-primary mt-2 w-100" onclick="convertHijriToGregorian()"
                            data-translate-key="ہجری سے عیسوی (Hijri to Gregorian)">ہجری سے عیسوی (Hijri to
                            Gregorian)</button>
                        <p id="convertedGregorianDate" class="mt-2"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="authModalLabel" data-translate-key="لاگ ان/رجسٹر">لاگ ان/رجسٹر</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-pills nav-fill mb-3" id="authTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="login-tab" data-bs-toggle="tab"
                                data-bs-target="#login-panel" type="button" role="tab" aria-controls="login-panel"
                                aria-selected="true" data-translate-key="لاگ ان">لاگ ان</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="register-tab" data-bs-toggle="tab"
                                data-bs-target="#register-panel" type="button" role="tab" aria-controls="register-panel"
                                aria-selected="false" data-translate-key="رجسٹر">رجسٹر</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="authTabsContent">
                        <div class="tab-pane fade show active" id="login-panel" role="tabpanel"
                            aria-labelledby="login-tab">
                            <form id="loginForm">
                                <div class="mb-3">
                                    <label for="loginUsername" class="form-label"
                                        data-translate-key="یوزرنیم">یوزرنیم</label>
                                    <input type="text" class="form-control bg-secondary text-white border-0"
                                        id="loginUsername" required>
                                </div>
                                <div class="mb-3">
                                    <label for="loginPassword" class="form-label"
                                        data-translate-key="پاس ورڈ">پاس ورڈ</label>
                                    <input type="password" class="form-control bg-secondary text-white border-0"
                                        id="loginPassword" required>
                                </div>
                                <div class="form-check mb-3 text-start">
                                    <input class="form-check-input" type="checkbox" id="isAdminLogin">
                                    <label class="form-check-label" for="isAdminLogin"
                                        data-translate-key="ایڈمن لاگ ان">ایڈمن لاگ ان</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100"
                                    data-translate-key="لاگ ان کریں">لاگ ان کریں</button>
                                <div id="loginMessage" class="alert mt-3" style="display:none;"></div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="register-panel" role="tabpanel"
                            aria-labelledby="register-tab">
                            <form id="registerForm">
                                <div class="mb-3">
                                    <label for="registerUsername" class="form-label"
                                        data-translate-key="یوزرنیم">یوزرنیم</label>
                                    <input type="text" class="form-control bg-secondary text-white border-0"
                                        id="registerUsername" required>
                                </div>
                                <div class="mb-3">
                                    <label for="registerEmail" class="form-label" data-translate-key="ای میل">ای میل</label>
                                    <input type="email" class="form-control bg-secondary text-white border-0"
                                        id="registerEmail" required>
                                </div>
                                <div class="mb-3">
                                    <label for="registerPassword" class="form-label"
                                        data-translate-key="پاس ورڈ">پاس ورڈ</label>
                                    <input type="password" class="form-control bg-secondary text-white border-0"
                                        id="registerPassword" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label"
                                        data-translate-key="پاس ورڈ کی تصدیق کریں">پاس ورڈ کی تصدیق کریں</label>
                                    <input type="password" class="form-control bg-secondary text-white border-0"
                                        id="confirmPassword" required>
                                </div>
                                <button type="submit" class="btn btn-success w-100"
                                    data-translate-key="رجسٹر کریں">رجسٹر کریں</button>
                                <div id="registerMessage" class="alert mt-3" style="display:none;"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="adminCrudModal" tabindex="-1" aria-labelledby="adminCrudModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="adminCrudModalLabel"></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body admin-crud-edit" id="adminCrudModalBody">
                    <form id="adminCrudForm">
                        <input type="hidden" id="crudItemId">
                        <input type="hidden" id="crudTableName">
                        <div id="crudFormFields"></div>
                        <div class="admin-crud-form-actions mt-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                data-translate-key="منسوخ کریں">منسوخ کریں</button>
                            <button type="submit" class="btn btn-primary" id="crudSubmitBtn"></button>
                        </div>
                        <div id="crudFormMessage" class="alert mt-3" style="display:none;"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addZikrModal" tabindex="-1" aria-labelledby="addZikrModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="addZikrModalLabel" data-translate-key="نیا ذکر/دعا شامل کریں">نیا ذکر/دعا شامل کریں</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addZikrForm">
                        <div class="mb-3">
                            <label for="zikrArabic" class="form-label" data-translate-key="عربی متن">عربی متن:</label>
                            <textarea class="form-control bg-secondary text-white border-0" id="zikrArabic" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="zikrEnglish" class="form-label" data-translate-key="انگریزی ترجمہ">انگریزی ترجمہ:</label>
                            <textarea class="form-control bg-secondary text-white border-0" id="zikrEnglish" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="zikrUrdu" class="form-label" data-translate-key="اردو ترجمہ">اردو ترجمہ:</label>
                            <textarea class="form-control bg-secondary text-white border-0" id="zikrUrdu" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="zikrTarget" class="form-label" data-translate-key="روزانہ کا ہدف">روزانہ کا ہدف:</label>
                            <input type="number" class="form-control bg-secondary text-white border-0" id="zikrTarget" value="33" min="1">
                        </div>
                        <button type="submit" class="btn btn-primary w-100" data-translate-key="شامل کریں">شامل کریں</button>
                        <div id="addZikrMessage" class="alert mt-3" style="display:none;"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addLocationModal" tabindex="-1" aria-labelledby="addLocationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="addLocationModalLabel" data-translate-key="نیا مقام شامل کریں">نیا مقام شامل کریں</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addLocationForm">
                        <div class="mb-3">
                            <label for="locationName" class="form-label" data-translate-key="مقام کا نام">مقام کا نام:</label>
                            <input type="text" class="form-control bg-secondary text-white border-0" id="locationName" required>
                        </div>
                        <div class="mb-3">
                            <label for="locationLatitude" class="form-label" data-translate-key="عرض بلد">عرض بلد (Latitude):</label>
                            <input type="number" step="0.00000001" class="form-control bg-secondary text-white border-0" id="locationLatitude" required>
                        </div>
                        <div class="mb-3">
                            <label for="locationLongitude" class="form-label" data-translate-key="طول بلد">طول بلد (Longitude):</label>
                            <input type="number" step="0.00000001" class="form-control bg-secondary text-white border-0" id="locationLongitude" required>
                        </div>
                        <div class="mb-3">
                            <label for="locationCalculationMethod" class="form-label" data-translate-key="طریقہ حساب">طریقہ حساب:</label>
                            <select class="form-select bg-secondary text-white border-0" id="locationCalculationMethod">
                                <option value="Karachi">University of Islamic Sciences, Karachi</option>
                                <option value="MuslimWorldLeague">Muslim World League</option>
                                <option value="NorthAmerica">ISNA (North America)</option>
                                <option value="UmmAlQura">Umm al-Qura University, Makkah</option>
                                <option value="Egyptian">Egyptian General Authority of Survey</option>
                                <option value="Tehran">Institute of Geophysics, University of Tehran</option>
                                <option value="Turkey">Diyanet (Turkey)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" data-translate-key="شامل کریں">شامل کریں</button>
                        <div id="addLocationMessage" class="alert mt-3" style="display:none;"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2023 Yasin Ullah, Pakistan. All rights reserved.</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="adhan.umd.min.js"></script>
    <script>
        let prophetMuhammadBirthDateGregorian, prophetMuhammadDeathDateGregorian;
        let currentTheme = 'light';
        let currentFontSize = 16;
        let currentLanguage = 'ur';
        const APP_DATA_KEY = 'prophet_islamic_hub_data';
        const defaultBirthDateGregorian = new Date(Date.UTC(570, 3, 20));
        const defaultDeathDateGregorian = new Date(Date.UTC(632, 5, 8));
        const MAWLID_MONTH = 3;
        const MAWLID_DAY = 12;
        const DEATH_ANNIVERSARY_MONTH = 3;
        const DEATH_ANNIVERSARY_DAY = 13;
        let allHadiths = [];
        let allAsmaUlHusna = [];
        let allProphetNames = [];
        let allSeerahEvents = [];
        let allQuranVerses = [];
        let allQuizQuestions = [];
        let allDailyDuas = [];
        let allCalendarEvents = [];
        let currentQuizQuestion = null;
        let tasbihCount = 0;
        let currentHijriCalendarMonth = null;
        let currentHijriCalendarYear = null;
        let userFavorites = [];
        let userPrayerLocations = [];
        let userDailyZikr = [];
        const hijriMonths = ["محرم", "صفر", "ربیع الاول", "ربیع الثانی", "جمادی الاول", "جمادی الثانی", "رجب", "شعبان", "رمضان", "شوال", "ذوالقعدہ", "ذوالحجہ"];
        const hijriMonthsEn = ["Muharram", "Safar", "Rabi' al-Awwal", "Rabi' al-Thani", "Jumada al-Ula", "Jumada al-Akhira", "Rajab", "Sha'ban", "Ramadan", "Shawwal", "Dhul-Qadah", "Dhul-Hijjah"];
        const gregorianDaysOfWeek = ["اتوار", "پیر", "منگل", "بدھ", "جمعرات", "جمعہ", "ہفتہ"];
        const gregorianDaysOfWeekEn = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        const translations = {
            ur: {
                "Prophet Muhammad (صلی اللہ علیہ و سلم) Islamic Hub": "سیدنا محمد (صلی اللہ علیہ و سلم) اسلامی مرکز",
                "ہوم": "ہوم",
                "تمام احادیث": "تمام احادیث",
                "تمام قرآنی آیات": "تمام قرآنی آیات",
                "اہم تاریخیں": "اہم تاریخیں",
                "Remaining": "باقی",
                "سیرت کے واقعات": "سیرت کے واقعات",
                "حدیثِ مبارکہ": "حدیثِ مبارکہ",
                "قرآنی آیت": "قرآنی آیت",
                "دعا و ذکر": "دعا و ذکر",
                "اسلامی کیلنڈر": "اسلامی کیلنڈر",
                "اسلامی کوئز": "اسلامی کوئز",
                "اسمائے حسنیٰ": "اسمائے حسنیٰ",
                "نبی اکرم کے القاب": "نبی اکرم کے القاب",
                "اوقاتِ نماز": "اوقاتِ نماز",
                "تاریخ کنورٹر": "تاریخ کنورٹر",
                "ترتیبات": "ترتیبات",
                "بیک اپ": "بیک اپ",
                "بحال کریں": "بحال کریں",
                "ولادت کا وقت (Birth Countdown):": "ولادت کا وقت:",
                "وفات کا وقت (Death Countdown):": "وفات کا وقت:",
                "اگلی ولادت کی سالگرہ (Next Mawlid)": "اگلی ولادت کی سالگرہ:",
                "وفات کی اگلی سالگرہ (Next Death Anniversary)": "وفات کی اگلی سالگرہ:",
                "آج سیرت میں (On This Day in Seerah)": "آج سیرت میں:",
                "آج کی حدیث (Hadith of the Day)": "آج کی حدیث:",
                "آج کی قرآنی آیت (Quranic Verse of the Day)": "آج کی قرآنی آیت:",
                "روزانہ کی دعا اور ذکر (Daily Dua & Zikr)": "روزانہ کی دعا اور ذکر:",
                "آج کی دعا (Dua of the Day)": "آج کی دعا:",
                "ذکر کاؤنٹر (Zikr Counter)": "ذکر کاؤنٹر:",
                "ری سیٹ کریں (Reset)": "ری سیٹ کریں",
                "اسلامی کیلنڈر (Islamic Calendar)": "اسلامی کیلنڈر:",
                "اتوار": "اتوار",
                "پیر": "پیر",
                "منگل": "منگل",
                "بدھ": "بدھ",
                "جمعرات": "جمعرات",
                "جمعہ": "جمعہ",
                "ہفتہ": "ہفتہ",
                "اسلامی کوئز (Islamic Quiz)": "اسلامی کوئز:",
                "اگلا سوال (Next Question)": "اگلا سوال",
                "اللہ کے 99 نام (99 Names of Allah - Asma-ul-Husna)": "اللہ کے 99 نام (اسمائے حسنیٰ):",
                "نبی اکرم (صلی اللہ علیہ و سلم) کے القاب (Names & Titles of the Prophet ﷺ)": "نبی اکرم (صلی اللہ علیہ و سلم) کے القاب:",
                "اوقاتِ نماز (Prayer Times)": "اوقاتِ نماز:",
                "اپنا شہر درج کریں (Enter your City)": "اپنا شہر درج کریں:",
                "مثلاً: لاہور, پاکستان": "مثلاً: لاہور، پاکستان",
                "طریقہ حساب (Calculation Method)": "طریقہ حساب:",
                "اوقاتِ نماز حاصل کریں": "اوقاتِ نماز حاصل کریں",
                "قبلہ کی سمت (Qibla Direction)": "قبلہ کی سمت:",
                "براہ کرم مقام کی اجازت دیں۔ (Please allow location access.)": "براہ کرم مقام کی اجازت دیں۔",
                "ماخذ اور کتابیات (Sources & Bibliography)": "ماخذ اور کتابیات:",
                "تاریخِ ولادت (Gregorian Birth Date)": "تاریخِ ولادت (عیسوی):",
                "تاریخِ وفات (Gregorian Death Date)": "تاریخِ وفات (عیسوی):",
                "تھیم (Theme)": "تھیم:",
                "روشنی (Light)": "روشنی",
                "تاریک (Dark)": "تاریک",
                "فونٹ سائز (Font Size)": "فونٹ سائز:",
                "زبان (Language)": "زبان:",
                "محفوظ کریں (Save Changes)": "محفوظ کریں",
                "واقعہ کی تفصیل (Event Details)": "واقعہ کی تفصیل",
                "حوالہ (Source)": "حوالہ:",
                "بند کریں (Close)": "بند کریں",
                "کیلنڈر ایونٹ کی تفصیل (Calendar Event Details)": "کیلنڈر ایونٹ کی تفصیل",
                "تاریخ کنورٹر (Date Converter)": "تاریخ کنورٹر",
                "عیسوی تاریخ (Gregorian Date)": "عیسوی تاریخ:",
                "عیسوی سے ہجری (Gregorian to Hijri)": "عیسوی سے ہجری",
                "ہجری سال (Hijri Year)": "ہجری سال:",
                "ہجری ماہ (Hijri Month)": "ہجری ماہ",
                "ہجری دن (Hijri Day)": "ہجری دن",
                "ہجری سے عیسوی (Hijri to Gregorian)": "ہجری سے عیسوی",
                "سیرتِ نبوی کے اہم واقعات (Key Events from Seerah)": "سیرتِ نبوی کے اہم واقعات:",
                "سال (Years)": "سال",
                "ماہ (Months)": "ماہ",
                "دن (Days)": "دن",
                "گھنٹے (Hours)": "گھنٹے",
                "منٹ (Minutes)": "منٹ",
                "سیکنڈ (Seconds)": "سیکنڈ",
                "کل دن": "کل دن",
                "کل ماہ": "کل ماہ",
                "ڈیٹا کامیابی سے بحال ہو گیا ہے! (Data restored successfully!)": "ڈیٹا کامیابی سے بحال ہو گیا ہے!",
                "درآمد شدہ فائل میں درست تاریخیں موجود نہیں ہیں۔ (Imported file does not contain valid dates.)": "درآمد شدہ فائل میں درست تاریخیں موجود نہیں ہیں۔",
                "فائل پڑھنے میں خرابی پیش آئی۔ یہ ایک درست JSON فائل نہیں ہے۔ (Error reading file. It might not be a valid JSON.)": "فائل پڑھنے میں خرابی پیش آئی۔ یہ ایک درست JSON فائل نہیں ہے۔",
                "فائل پڑھنے میں خرابی پیش آئی۔ (Error reading file.)": "فائل پڑھنے میں خرابی پیش آئی۔",
                "آج کے دن سیرت میں کوئی واقعہ واقعہ نہیں مل سکا (No specific event found in Seerah for today).": "آج کے دن سیرت میں کوئی واقعہ واقعہ نہیں مل سکا",
                "براہ کرم تاریخ درج کریں۔": "براہ کرم تاریخ درج کریں۔",
                "براہ کرم تمام ہجری تاریخ درج کریں۔": "براہ کرم تمام ہجری تاریخ درج کریں۔",
                "اوقاتِ نماز حاصل کرنے میں خرابی:": "اوقاتِ نماز حاصل کرنے میں خرابی:",
                "مقام کی اجازت درکار ہے۔": "مقام کی اجازت درکار ہے۔",
                "مقام دستیاب نہیں ہے۔": "مقام دستیاب نہیں ہے۔",
                "آپ کا براؤزر جغرافیائی محل وقوع کی حمایت نہیں کرتا ہے۔ (Your browser does not support geolocation.)": "آپ کا براؤزر جغرافیائی محل وقوع کی حمایت نہیں کرتا ہے۔",
                "شہر کے نام سے اوقات نماز حاصل کرنے کے لیے ایک جغرافیائی لوکیشن سروس کی ضرورت ہے۔ فی الحال آپ کے موجودہ مقام کا استعمال کیا جائے گا۔ (Getting prayer times by city name requires a geocoding service. Your current location will be used for now.)": "شہر کے نام سے اوقات نماز حاصل کرنے کے لیے ایک جغرافیائی لوکیشن سروس کی ضرورت ہے۔ فی الحال آپ کے موجودہ مقام کا استعمال کیا جائے گا۔",
                "قبلہ کی سمت: ": "قبلہ کی سمت: ",
                "(شمال سے)": "(شمال سے)",
                "Muharram": "محرم",
                "Safar": "صفر",
                "Rabi' al-Awwal": "ربیع الاول",
                "Rabi' al-Thani": "ربیع الثانی",
                "Jumada al-Ula": "جمادی الاول",
                "Jumada al-Akhira": "جمادی الثانی",
                "Rajab": "رجب",
                "Sha'ban": "شعبان",
                "Ramadan": "رمضان",
                "Shawwal": "شوال",
                "Dhul-Qadah": "ذوالقعدہ",
                "Dhul-Hijjah": "ذوالحجہ",
                "لاگ ان/رجسٹر": "لاگ ان/رجسٹر",
                "لاگ ان": "لاگ ان",
                "رجسٹر": "رجسٹر",
                "یوزرنیم": "یوزرنیم",
                "پاس ورڈ": "پاس ورڈ",
                "ایڈمن لاگ ان": "ایڈمن لاگ ان",
                "لاگ ان کریں": "لاگ ان کریں",
                "ای میل": "ای میل",
                "پاس ورڈ کی تصدیق کریں": "پاس ورڈ کی تصدیق کریں",
                "رجسٹر کریں": "رجسٹر کریں",
                "لاگ آؤٹ": "لاگ آؤٹ",
                "ایڈمن ڈیش بورڈ": "ایڈمن ڈیش بورڈ",
                "ٹیبل منتخب کریں": "ٹیبل منتخب کریں",
                "احادیث": "احادیث",
                "قرآنی آیات": "قرآنی آیات",
                "روزانہ کی دعائیں": "روزانہ کی دعائیں",
                "کوئز سوالات": "کوئز سوالات",
                "اسلامی کیلنڈر کے واقعات": "اسلامی کیلنڈر کے واقعات",
                "صارفین": "صارفین",
                "ایڈمنز": "ایڈمنز",
                "نیا ریکارڈ شامل کریں": "نیا ریکارڈ شامل کریں",
                "منسوخ کریں": "منسوخ کریں",
                "شامل کریں": "شامل کریں",
                "ترمیم کریں": "ترمیم کریں",
                "حذف کریں": "حذف کریں",
                "ریکارڈ شامل کریں": "ریکارڈ شامل کریں",
                "ریکورد کو اپ ڈیٹ کریں": "ریکورد کو اپ ڈیٹ کریں",
                "آپ کو اس صفحے تک رسائی حاصل نہیں ہے۔": "آپ کو اس صفحے تک رسائی حاصل نہیں ہے۔",
                "پسندیدہ آئٹمز": "پسندیدہ آئٹمز",
                "میری ذاتی ذکر/دعائیں": "میری ذاتی ذکر/دعائیں",
                "محفوظ کردہ اوقاتِ نماز کی جگہیں": "محفوظ کردہ اوقاتِ نماز کی جگہیں",
                "نیا ذکر/دعا شامل کریں": "نیا ذکر/دعا شامل کریں",
                "نیا مقام شامل کریں": "نیا مقام شامل کریں",
                "کوئی پسندیدہ آئٹم نہیں": "کوئی پسندیدہ آئٹم نہیں",
                "کوئی ذاتی ذکر/دعا شامل نہیں کی گئی۔": "کوئی ذاتی ذکر/دعا شامل نہیں کی گئی۔",
                "کوئی محفوظ کردہ جگہ نہیں۔": "کوئی محفوظ کردہ جگہ نہیں۔",
                "عربی متن": "عربی متن",
                "انگریزی ترجمہ": "انگریزی ترجمہ",
                "اردو ترجمہ": "اردو ترجمہ",
                "روزانہ کا ہدف": "روزانہ کا ہدف",
                "مقام کا نام": "مقام کا نام",
                "عرض بلد": "عرض بلد",
                "طول بلد": "طول بلد",
                "قرآن کی تلاوت": "قرآن کی تلاوت",
                "یوزر ڈیش بورڈ": "یوزر ڈیش بورڈ",
                "پاس ورڈ دوبارہ سیٹ کریں": "پاس ورڈ دوبارہ سیٹ کریں",
                "نئے پاس ورڈ کی تصدیق کریں": "نئے پاس ورڈ کی تصدیق کریں",
                "پاس ورڈ اپ ڈیٹ کریں": "پاس ورڈ اپ ڈیٹ کریں",
                "کیا آپ واقعی اس ریکارڈ کو حذف کرنا چاہتے ہیں؟": "کیا آپ واقعی اس ریکارڈ کو حذف کرنا چاہتے ہیں؟",
                "کیا آپ واقعی اس ذکر/دعا کو حذف کرنا چاہتے ہیں؟": "کیا آپ واقعی اس ذکر/دعا کو حذف کرنا چاہتے ہیں؟",
                "کیا آپ واقعی اس مقام کو حذف کرنا چاہتے ہیں؟": "کیا آپ واقعی اس مقام کو حذف کرنا چاہتے ہیں؟",
                "کوئی ریکارڈ نہیں ملا۔": "کوئی ریکارڈ نہیں ملا۔",
                "عمل": "عمل",
            },
            en: {
                "Prophet Muhammad (صلی اللہ علیہ و سلم) Islamic Hub": "Prophet Muhammad (PBUH) Islamic Hub",
                "ہوم": "Home",
                "تمام احادیث": "All Hadiths",
                "تمام قرآنی آیات": "All Quran Verses",
                "اہم تاریخیں": "Important Dates",
                "Remaining": "Remaining",
                "سیرت کے واقعات": "Seerah Events",
                "حدیثِ مبارکہ": "Hadith",
                "قرآنی آیت": "Quranic Verse",
                "دعا و ذکر": "Dua & Zikr",
                "اسلامی کیلنڈر": "Islamic Calendar",
                "اسلامی کوئز": "Islamic Quiz",
                "اسمائے حسنیٰ": "Asma-ul-Husna",
                "نبی اکرم کے القاب": "Prophet's Titles",
                "اوقاتِ نماز": "Prayer Times",
                "تاریخ کنورٹر": "Date Converter",
                "ترتیبات": "Settings",
                "بیک اپ": "Backup",
                "بحال کریں": "Restore",
                "ولادت کا وقت (Birth Countdown):": "Time Since Birth:",
                "وفات کا وقت (Death Countdown):": "Time Since Death:",
                "اگلی ولادت کی سالگرہ (Next Mawlid)": "Next Birth Anniversary (Mawlid):",
                "وفات کی اگلی سالگرہ (Next Death Anniversary)": "Next Death Anniversary:",
                "آج سیرت میں (On This Day in Seerah)": "On This Day in Seerah:",
                "آج کی حدیث (Hadith of the Day)": "Hadith of the Day:",
                "آج کی قرآنی آیت (Quranic Verse of the Day)": "Quranic Verse of the Day:",
                "روزانہ کی دعا اور ذکر (Daily Dua & Zikr)": "Daily Dua & Zikr:",
                "آج کی دعا (Dua of the Day)": "Dua of the Day:",
                "ذکر کاؤنٹر (Zikr Counter)": "Zikr Counter:",
                "ری سیٹ کریں (Reset)": "Reset",
                "اسلامی کیلنڈر (Islamic Calendar)": "Islamic Calendar:",
                "اتوار": "Sunday",
                "پیر": "Monday",
                "منگل": "Tuesday",
                "بدھ": "Wednesday",
                "جمعرات": "Thursday",
                "جمعہ": "Friday",
                "ہفتہ": "Saturday",
                "اسلامی کوئز (Islamic Quiz)": "Islamic Quiz:",
                "اگلا سوال (Next Question)": "Next Question",
                "اللہ کے 99 نام (99 Names of Allah - Asma-ul-Husna)": "99 Names of Allah (Asma-ul-Husna):",
                "نبی اکرم (صلی اللہ علیہ و سلم) کے القاب (Names & Titles of the Prophet ﷺ)": "Names & Titles of the Prophet (PBUH):",
                "اوقاتِ نماز (Prayer Times)": "Prayer Times:",
                "اپنا شہر درج کریں (Enter your City)": "Enter your City:",
                "مثلاً: لاہور, پاکستان": "e.g., Lahore, Pakistan",
                "طریقہ حساب (Calculation Method)": "Calculation Method:",
                "اوقاتِ نماز حاصل کریں": "Get Prayer Times",
                "قبلہ کی سمت (Qibla Direction)": "Qibla Direction:",
                "براہ کرم مقام کی اجازت دیں۔ (Please allow location access.)": "Please allow location access.",
                "ماخذ اور کتابیات (Sources & Bibliography)": "Sources & Bibliography:",
                "تاریخِ ولادت (Gregorian Birth Date)": "Gregorian Birth Date:",
                "تاریخِ وفات (Gregorian Death Date)": "Gregorian Death Date:",
                "تھیم (Theme)": "Theme:",
                "روشنی (Light)": "Light",
                "تاریک (Dark)": "Dark",
                "فونٹ سائز (Font Size)": "Font Size:",
                "زبان (Language)": "Language:",
                "محفوظ کریں (Save Changes)": "Save Changes",
                "واقعہ کی تفصیل (Event Details)": "Event Details",
                "حوالہ (Source)": "Source:",
                "بند کریں (Close)": "Close",
                "کیلنڈر ایونٹ کی تفصیل (Calendar Event Details)": "Calendar Event Details",
                "تاریخ کنورٹر (Date Converter)": "Date Converter",
                "عیسوی تاریخ (Gregorian Date)": "Gregorian Date:",
                "عیسوی سے ہجری (Gregorian to Hijri)": "Gregorian to Hijri",
                "ہجری سال (Hijri Year)": "Hijri Year:",
                "ہجری ماہ (Hijri Month)": "Hijri Month:",
                "ہجری دن (Hijri Day)": "Hijri Day:",
                "ہجری سے عیسوی (Hijri to Gregorian)": "Hijri to Gregorian",
                "سیرتِ نبوی کے اہم واقعات (Key Events from Seerah)": "Key Events from Seerah:",
                "سال (Years)": "years",
                "ماہ (Months)": "months",
                "دن (Days)": "days",
                "گھنٹے (Hours)": "hours",
                "منٹ (Minutes)": "minutes",
                "سیکنڈ (Seconds)": "seconds",
                "کل دن": "Total Days:",
                "کل ماہ": "Total Months:",
                "ڈیٹا کامیابی سے بحال ہو گیا ہے! (Data restored successfully!)": "Data restored successfully!",
                "درآمد شدہ فائل میں درست تاریخیں موجود نہیں ہیں۔ (Imported file does not contain valid dates.)": "Imported file does not contain valid dates.",
                "فائل پڑھنے میں خرابی پیش آئی۔ یہ ایک درست JSON فائل نہیں ہے۔ (Error reading file. It might not be a valid JSON.)": "Error reading file. It might not be a valid JSON.",
                "فائل پڑھنے میں خرابی پیش آئی۔ (Error reading file.)": "Error reading file.",
                "آج کے دن سیرت میں کوئی واقعہ واقعہ نہیں مل سکا (No specific event found in Seerah for today).": "No specific event found in Seerah for today.",
                "براہ کرم تاریخ درج کریں۔": "Please enter a date.",
                "براہ کرم تمام ہجری تاریخ درج کریں۔": "Please enter full Hijri date.",
                "اوقاتِ نماز حاصل کرنے میں خرابی:": "Error getting prayer times:",
                "مقام کی اجازت درکار ہے۔": "Location permission required.",
                "مقام دستیاب نہیں ہے۔": "Location not available.",
                "آپ کا براؤزر جغرافیائی محل وقوع کی حمایت نہیں کرتا ہے۔ (Your browser does not support geolocation.)": "Your browser does not support geolocation.",
                "شہر کے نام سے اوقات نماز حاصل کرنے کے لیے ایک جغرافیائی لوکیشن سروس کی ضرورت ہے۔ فی الحال آپ کے موجودہ مقام کا استعمال کیا جائے گا۔ (Getting prayer times by city name requires a geocoding service. Your current location will be used for now.)": "Getting prayer times by city name requires a geocoding service. Your current location will be used for now.",
                "قبلہ کی سمت: ": "Qibla Direction: ",
                "(شمال سے)": " from North",
                "Muharram": "Muharram",
                "Safar": "Safar",
                "Rabi' al-Awwal": "Rabi' al-Awwal",
                "Rabi' al-Thani": "Rabi' al-Thani",
                "Jumada al-Ula": "Jumada al-Ula",
                "Jumada al-Akhira": "Jumada al-Akhira",
                "Rajab": "Rajab",
                "Sha'ban": "Sha'ban",
                "Ramadan": "Ramadan",
                "Shawwal": "Shawwal",
                "Dhul-Qadah": "Dhul-Qadah",
                "Dhul-Hijjah": "Dhul-Hijjah",
                "لاگ ان/رجسٹر": "Login/Register",
                "لاگ ان": "Login",
                "رجسٹر": "Register",
                "یوزرنیم": "Username",
                "پاس ورڈ": "Password",
                "ایڈمن لاگ ان": "Admin Login",
                "لاگ ان کریں": "Login",
                "ای میل": "Email",
                "پاس ورڈ کی تصدیق کریں": "Confirm Password",
                "رجسٹر کریں": "Register",
                "لاگ آؤٹ": "Logout",
                "ایڈمن ڈیش بورڈ": "Admin Dashboard",
                "ٹیبل منتخب کریں": "Select Table",
                "احادیث": "Hadiths",
                "قرآنی آیات": "Quran Verses",
                "روزانہ کی دعائیں": "Daily Duas",
                "کوئز سوالات": "Quiz Questions",
                "اسلامی کیلنڈر کے واقعات": "Islamic Calendar Events",
                "صارفین": "Users",
                "ایڈمنز": "Admins",
                "نیا ریکارڈ شامل کریں": "Add New Record",
                "منسوخ کریں": "Cancel",
                "شامل کریں": "Add",
                "ترمیم کریں": "Edit",
                "حذف کریں": "Delete",
                "ریکورد کو اپ ڈیٹ کریں": "Update Record",
                "آپ کو اس صفحے تک رسائی حاصل نہیں ہے۔": "You do not have access to this page.",
                "پسندیدہ آئٹمز": "Favorite Items",
                "میری ذاتی ذکر/دعائیں": "My Personal Zikr/Duas",
                "محفوظ کردہ اوقاتِ نماز کی جگہیں": "Saved Prayer Locations",
                "نیا ذکر/دعا شامل کریں": "Add New Zikr/Dua",
                "نیا مقام شامل کریں": "Add New Location",
                "کوئی پسندیدہ آئٹم نہیں": "No favorite items added yet.",
                "کوئی ذاتی ذکر/دعا شامل نہیں کی گئی۔": "No personal zikr/dua added yet.",
                "کوئی محفوظ کردہ جگہ نہیں۔": "No saved locations yet.",
                "عربی متن": "Arabic Text",
                "انگریزی ترجمہ": "English Translation",
                "اردو ترجمہ": "Urdu Translation",
                "روزانہ کا ہدف": "Daily Target",
                "مقام کا نام": "Location Name",
                "عرض بلد": "Latitude",
                "طول بلد": "Longitude",
                "قرآن کی تلاوت": "Quran Recitations",
                "یوزر ڈیش بورڈ": "User Dashboard",
                "پاس ورڈ دوبارہ سیٹ کریں": "Reset Password",
                "نئے پاس ورڈ کی تصدیق کریں": "Confirm New Password",
                "پاس ورڈ اپ ڈیٹ کریں": "Update Password",
                "کیا آپ واقعی اس ریکارڈ کو حذف کرنا چاہتے ہیں؟": "Are you sure you want to delete this record?",
                "کیا آپ واقعی اس ذکر/دعا کو حذف کرنا چاہتے ہیں؟": "Are you sure you want to delete this zikr/dua?",
                "کیا آپ واقعی اس مقام کو حذف کرنا چاہتے ہیں؟": "Are you sure you want to delete this location?",
                "کوئی ریکارڈ نہیں ملا۔": "No records found.",
                "عمل": "Actions",
            }
        };

        function translatePage() {
            const elements = document.querySelectorAll('[data-translate-key]');
            elements.forEach(el => {
                const key = el.getAttribute('data-translate-key');
                if (translations[currentLanguage] && translations[currentLanguage][key]) {
                    el.textContent = translations[currentLanguage][key];
                }
            });
            const placeholders = document.querySelectorAll('[data-translate-key-placeholder]');
            placeholders.forEach(el => {
                const key = el.getAttribute('data-translate-key-placeholder');
                if (translations[currentLanguage] && translations[currentLanguage][key]) {
                    el.placeholder = translations[currentLanguage][key];
                }
            });
            const sourceSpan = document.getElementById('modalEventSource');
            if (sourceSpan && sourceSpan.parentElement && sourceSpan.parentElement.querySelector('#modal-source-label')) {
                document.querySelector('#modal-source-label').textContent = translations[currentLanguage]["حوالہ (Source)"] + " ";
            }
            hijriMonthsEn.forEach((monthEn, index) => {
                const option = document.querySelector(`#hijriMonthInput option[value="${index + 1}"]`);
                if (option) {
                    option.textContent = currentLanguage === 'ur' ? hijriMonths[index] + ' (' + monthEn + ')' : translations[currentLanguage][monthEn] || monthEn;
                }
            });
            const dayHeaders = document.querySelectorAll('.calendar-day-header');
            gregorianDaysOfWeek.forEach((dayNameUr, index) => {
                if (dayHeaders[index]) {
                    dayHeaders[index].textContent = translations[currentLanguage][dayNameUr];
                }
            });
            displayHadithOfTheDay();
            populateAsmaUlHusna();
            populateProphetNames();
            displayQuranVerseOfTheDay();
            displayDuaOfTheDay();
            populateCalendar();
            loadQuizQuestion(false);
            const urlParams = new URLSearchParams(window.location.search);
            const page = urlParams.get('page');
            if (page === 'admin_dashboard' && <?php echo json_encode(isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin'); ?>) {
                loadAdminCrudTable();
            } else if (page === 'user_dashboard' && <?php echo json_encode(isset($_SESSION['user_id']) && $_SESSION['role'] === 'user'); ?>) {
                renderUserDashboard();
            }
        }

        function changeFontSize(change) {
            currentFontSize += change;
            document.body.style.fontSize = `${currentFontSize}px`;
            document.querySelectorAll('.countdown-display, .event-info, .hadith-text, .asma-item, .prophet-name-item, .qibla-display, .quiz-question, .quiz-options button, #quranVerseDisplay .verse-translation, #duaDisplay .dua-translation').forEach(el => {
                el.style.fontSize = `${currentFontSize * 0.9}px`;
            });
            document.querySelectorAll('.total-info, #quranVerseDisplay .verse-transliteration, #duaDisplay .verse-transliteration').forEach(el => {
                el.style.fontSize = `${currentFontSize * 0.75}px`;
            });
            document.querySelectorAll('#quranVerseDisplay .verse-arabic, #duaDisplay .dua-arabic').forEach(el => {
                el.style.fontSize = `${currentFontSize * 1.5}px`;
            });
            document.querySelectorAll('.tasbih-count').forEach(el => {
                el.style.fontSize = `${currentFontSize * 2}px`;
            });
            document.querySelectorAll('.tasbih-button').forEach(el => {
                el.style.fontSize = `${currentFontSize * 1}px`;
            });
            document.querySelectorAll('.calendar-day').forEach(el => {
                el.style.fontSize = `${currentFontSize * 0.7}px`;
                const gregorianSpan = el.querySelector('.gregorian');
                if (gregorianSpan) {
                    gregorianSpan.style.fontSize = `${currentFontSize * 0.6}px`;
                }
            });
            saveData();
        }

        function setTheme(mode) {
            currentTheme = mode;
            document.body.classList.toggle('dark-mode', mode === 'dark');
            document.querySelector('.navbar').classList.toggle('dark-mode', mode === 'dark');
            document.querySelectorAll('.container-card').forEach(card => card.classList.toggle('dark-mode', mode === 'dark'));
            if (mode === 'dark') {
                document.getElementById('darkMode').checked = true;
            } else {
                document.getElementById('lightMode').checked = true;
            }
            saveData();
        }
        document.getElementById('lightMode').addEventListener('change', () => setTheme('light'));
        document.getElementById('darkMode').addEventListener('change', () => setTheme('dark'));
        document.getElementById('languageSelect').addEventListener('change', (e) => {
            currentLanguage = e.target.value;
            translatePage();
            saveData();
        });

        function formatTimeDifference(ms, isCountdown = false) {
            const absMs = Math.abs(ms);
            const totalSeconds = Math.floor(absMs / 1000);
            const totalMinutes = Math.floor(totalSeconds / 60);
            const totalHours = Math.floor(totalMinutes / 60);
            const totalDays = Math.floor(totalHours / 24);
            const hours = totalHours % 24;
            const minutes = totalMinutes % 60;
            const seconds = totalSeconds % 60;
            const sign = isCountdown ? (translations[currentLanguage]["Remaining"] || "Remaining:") + " " : "";
            if (isCountdown) {
                const remainingDaysInYear = totalDays % 365.25;
                const months = Math.floor(remainingDaysInYear / 30.44);
                const days = Math.floor(remainingDaysInYear % 30.44);
                return `${sign}${months} ${translations[currentLanguage]["ماہ (Months)"]}
                ${days} ${translations[currentLanguage]["دن (Days)"]}
                ${hours} ${translations[currentLanguage]["گھنٹے (Hours)"]}
                ${minutes} ${translations[currentLanguage]["منٹ (Minutes)"]}
                ${seconds} ${translations[currentLanguage]["سیکنڈ (Seconds)"]}`;
            } else {
                const years = Math.floor(totalDays / 365.25);
                const remainingDaysAfterYears = totalDays % 365.25;
                const months = Math.floor(remainingDaysAfterYears / 30.44);
                const days = Math.floor(remainingDaysAfterYears % 30.44);
                return `${sign}${years} ${translations[currentLanguage]["سال (Years)"]}
                ${months} ${translations[currentLanguage]["ماہ (Months)"]}
                ${days} ${translations[currentLanguage]["دن (Days)"]}
                ${hours} ${translations[currentLanguage]["گھنٹے (Hours)"]}
                ${minutes} ${translations[currentLanguage]["منٹ (Minutes)"]}
                ${seconds} ${translations[currentLanguage]["سیکنڈ (Seconds)"]}`;
            }
        }

        function calculateTotalDaysMonths(ms) {
            if (ms < 0) return `${translations[currentLanguage]["کل دن"]}: N/A, ${translations[currentLanguage]["کل ماہ"]}: N/A`;
            const totalDays = Math.floor(ms / (1000 * 60 * 60 * 24));
            const totalMonths = Math.floor(totalDays / 30.44);
            return `${translations[currentLanguage]["کل دن"]}: ${totalDays} ${translations[currentLanguage]["دن (Days)"]}
                    ${translations[currentLanguage]["کل ماہ"]}: ${totalMonths} ${translations[currentLanguage]["ماہ (Months)"]}`;
        }

        function updateUpcomingAnniversaries() {
            const today = new Date();
            const todayHijri = gregorianToHijri(today);
            let mawlidYear = todayHijri.year;
            let mawlidDate = hijriToGregorian(mawlidYear, MAWLID_MONTH, MAWLID_DAY);
            if (mawlidDate.getTime() < today.getTime()) {
                mawlidYear++;
                mawlidDate = hijriToGregorian(mawlidYear, MAWLID_MONTH, MAWLID_DAY);
            }
            const timeToMawlid = mawlidDate.getTime() - today.getTime();
            document.getElementById("nextMawlidCountdown").innerHTML = formatTimeDifference(timeToMawlid, true);
            let deathYear = todayHijri.year;
            let deathDate = hijriToGregorian(deathYear, DEATH_ANNIVERSARY_MONTH, DEATH_ANNIVERSARY_DAY);
            if (deathDate.getTime() < today.getTime()) {
                deathYear++;
                deathDate = hijriToGregorian(deathYear, DEATH_ANNIVERSARY_MONTH, DEATH_ANNIVERSARY_DAY);
            }
            const timeToDeath = deathDate.getTime() - today.getTime();
            document.getElementById("nextDeathCountdown").innerHTML = formatTimeDifference(timeToDeath, true);
        }

        function displaySeerahEventToday() {
            const today = new Date();
            const todayHijri = gregorianToHijri(today);
            const seerahEventTodayElement = document.getElementById("seerahEventToday");
            let found = false;
            let eventToday = null;
            allSeerahEvents.forEach(event => {
                const eventGregorianDate = new Date(event.gregorian_date);
                const eventHijri = gregorianToHijri(eventGregorianDate);
                if (eventHijri.month === todayHijri.month && eventHijri.day === todayHijri.day) {
                    seerahEventTodayElement.innerHTML = `<strong>${currentLanguage === 'ur' ? event.title_ur : event.title_en}</strong><br>${currentLanguage === 'ur' ? event.description_ur : event.description_en}`;
                    eventToday = event;
                    found = true;
                }
            });
            if (!found) {
                seerahEventTodayElement.textContent = translations[currentLanguage]["آج کے دن سیرت میں کوئی واقعہ واقعہ نہیں مل سکا (No specific event found in Seerah for today)."];
            }
            if (seerahEventTodayElement.nextElementSibling) {
                updateFavoriteButton('seerah_event', eventToday ? eventToday.id : null, seerahEventTodayElement.nextElementSibling.querySelector('.favorite-btn'));
            }
        }

        function displayHadithOfTheDay() {
            const hadithElement = document.getElementById("currentHadith");
            if (!hadithElement) {
                return;
            }
            if (allHadiths.length === 0) return;
            const today = new Date();
            const dayOfYear = Math.floor((today - new Date(today.getFullYear(), 0, 0)) / 1000 / 60 / 60 / 24);
            const hadithIndex = dayOfYear % allHadiths.length;
            const hadith = allHadiths[hadithIndex];
            document.getElementById("currentHadith").innerHTML = currentLanguage === 'ur' ? hadith.hadith_ur : hadith.hadith_en;
            document.getElementById("hadithSource").innerHTML = currentLanguage === 'ur' ? `(ماخذ: ${hadith.source_ur})` : `(Source: ${hadith.source_en})`;
            updateFavoriteButton('hadith', hadith.id, document.querySelector('#hadithOfTheDay .favorite-btn'));
        }

        function displayQuranVerseOfTheDay() {
            const quranVerseDisplay = document.getElementById("quranVerseDisplay");
            if (!quranVerseDisplay) {
                return;
            }
            if (allQuranVerses.length === 0) {
                quranVerseDisplay.querySelector('.verse-arabic').textContent = '';
                quranVerseDisplay.querySelector('.verse-translation').textContent = 'No Quran verse available.';
                quranVerseDisplay.querySelector('.verse-transliteration').textContent = '';
                quranVerseDisplay.querySelector('.verse-source').textContent = '';
                quranVerseDisplay.querySelector('.audio-player').style.display = 'none';
                return;
            }
            const today = new Date();
            const dayOfYear = Math.floor((today - new Date(today.getFullYear(), 0, 0)) / 1000 / 60 / 60 / 24);
            const verseIndex = dayOfYear % allQuranVerses.length;
            const verse = allQuranVerses[verseIndex];
            quranVerseDisplay.querySelector('.verse-arabic').textContent = verse.arabic_text;
            quranVerseDisplay.querySelector('.verse-transliteration').textContent = verse.transliteration;
            quranVerseDisplay.querySelector('.verse-translation').textContent = currentLanguage === 'ur' ? verse.translation_ur : verse.translation_en;
            quranVerseDisplay.querySelector('.verse-source').textContent = currentLanguage === 'ur' ? `(سورہ: ${verse.surah_number}, آیت: ${verse.verse_number})` : `(Surah: ${verse.surah_number}, Verse: ${verse.verse_number})`;
            const audioPlayer = quranVerseDisplay.querySelector('.audio-player');
            audioPlayer.src = verse.audio_url || '';
            audioPlayer.load();
            updateFavoriteButton('quran_verse', verse.id, document.querySelector('#quranVerseOfTheDay .favorite-btn'));
        }

        function displayDuaOfTheDay() {
            const duaDisplay = document.getElementById("duaDisplay");
            if (!duaDisplay) {
                return;
            }
            if (allDailyDuas.length === 0) {
                duaDisplay.querySelector('.dua-arabic').textContent = '';
                duaDisplay.querySelector('.dua-translation').textContent = 'No Dua available.';
                duaDisplay.querySelector('.dua-transliteration').textContent = '';
                duaDisplay.querySelector('.dua-source').textContent = '';
                return;
            }
            const today = new Date();
            const dayOfYear = Math.floor((today - new Date(today.getFullYear(), 0, 0)) / 1000 / 60 / 60 / 24);
            const duaIndex = dayOfYear % allDailyDuas.length;
            const dua = allDailyDuas[duaIndex];
            duaDisplay.querySelector('.dua-arabic').textContent = dua.arabic_text;
            duaDisplay.querySelector('.dua-transliteration').textContent = dua.transliteration;
            duaDisplay.querySelector('.dua-translation').textContent = currentLanguage === 'ur' ? dua.translation_ur : dua.translation_en;
            duaDisplay.querySelector('.dua-source').textContent = currentLanguage === 'ur' ? `(عنوان: ${dua.dua_title_ur})` : `(Title: ${dua.dua_title_en})`;
            updateFavoriteButton('dua', dua.id, document.querySelector('#dailyDuaAndZikr .favorite-btn'));
        }

        function incrementTasbih() {
            tasbihCount++;
            document.getElementById('tasbihCount').textContent = tasbihCount;
            localStorage.setItem('tasbihCount', tasbihCount);
        }

        function resetTasbih() {
            tasbihCount = 0;
            document.getElementById('tasbihCount').textContent = tasbihCount;
            localStorage.setItem('tasbihCount', tasbihCount);
        }

        function populateAsmaUlHusna() {
            const asmaList = document.querySelector('.asma-list');
            if (!asmaList) {
                return;
            }
            asmaList.innerHTML = '';
            allAsmaUlHusna.forEach(name => {
                const div = document.createElement('div');
                div.className = 'asma-item d-flex justify-content-between align-items-center';
                div.innerHTML = `
            <div>
                <strong>${name.arabic_name} (${name.transliteration})</strong><br>
                ${currentLanguage === 'ur' ? name.meaning_ur : name.meaning_en}
            </div>
        `;
                if (isLoggedInUser()) {
                    const favBtn = document.createElement('button');
                    favBtn.className = 'favorite-btn';
                    favBtn.setAttribute('data-item-type', 'asma_ul_husna');
                    favBtn.setAttribute('data-item-id', name.id);
                    favBtn.innerHTML = '<i class="far fa-star"></i>';
                    favBtn.onclick = () => toggleFavorite(favBtn);
                    updateFavoriteButton('asma_ul_husna', name.id, favBtn);
                    div.appendChild(favBtn);
                }
                asmaList.appendChild(div);
            });
        }

        function populateProphetNames() {
            const prophetNamesList = document.querySelector('.prophet-names-list');
            if (!prophetNamesList) {
                return;
            }
            prophetNamesList.innerHTML = '';
            allProphetNames.forEach(name => {
                const div = document.createElement('div');
                div.className = 'prophet-name-item d-flex justify-content-between align-items-center';
                div.innerHTML = `
            <div>
                <strong>${name.arabic_name} (${name.transliteration})</strong><br>
                ${currentLanguage === 'ur' ? name.meaning_ur : name.meaning_en}
            </div>
        `;
                if (isLoggedInUser()) {
                    const favBtn = document.createElement('button');
                    favBtn.className = 'favorite-btn';
                    favBtn.setAttribute('data-item-type', 'prophet_name');
                    favBtn.setAttribute('data-item-id', name.id);
                    favBtn.innerHTML = '<i class="far fa-star"></i>';
                    favBtn.onclick = () => toggleFavorite(favBtn);
                    updateFavoriteButton('prophet_name', name.id, favBtn);
                    div.appendChild(favBtn);
                }
                prophetNamesList.appendChild(div);
            });
        }

        function populateTimeline() {
            const timelineDiv = document.getElementById('prophetTimeline');
            if (!timelineDiv) {
                return;
            }
            timelineDiv.innerHTML = '';
            allSeerahEvents.sort((a, b) => new Date(a.gregorian_date_iso) - new Date(b.gregorian_date_iso));
            allSeerahEvents.forEach(event => {
                const eventDiv = document.createElement('div');
                eventDiv.className = 'timeline-event';
                const eventGregorianDate = new Date(event.gregorian_date_iso);
                eventDiv.innerHTML = `
            <div class="timeline-event-content">
                <strong>${currentLanguage === 'ur' ? event.title_ur : event.title_en}</strong><br>
                ${eventGregorianDate.getFullYear()} ${currentLanguage === 'ur' ? 'عیسوی' : 'AD'}
            </div>
        `;
                eventDiv.onclick = () => showEventDetail(event);
                timelineDiv.appendChild(eventDiv);
            });
        }

        function showEventDetail(event) {
            document.getElementById('modalEventTitle').textContent = currentLanguage === 'ur' ? event.title_ur : event.title_en;
            const gregorianDateFormatted = new Date(event.gregorian_date_iso).toLocaleDateString(currentLanguage === 'ur' ? 'ur-PK' : 'en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            document.getElementById('modalEventGregorianDate').textContent = `Gregorian: ${gregorianDateFormatted}`;
            document.getElementById('modalEventHijriDate').textContent = `Hijri: ${event.hijri_date}`;
            document.getElementById('modalEventDescription').textContent = currentLanguage === 'ur' ? event.description_ur : event.description_en;
            document.getElementById('modalEventSource').textContent = event.source;
            const eventDetailModal = new bootstrap.Modal(document.getElementById('eventDetailModal'));
            eventDetailModal.show();
        }

        function showCalendarEventDetail(event) {
            document.getElementById('modalCalendarEventTitle').textContent = currentLanguage === 'ur' ? event.event_title_ur : event.event_title_en;
            const hijriMonthName = currentLanguage === 'ur' ? hijriMonths[event.hijri_month - 1] : hijriMonthsEn[event.hijri_month - 1];
            document.getElementById('modalCalendarEventHijriDate').textContent = `Hijri: ${event.hijri_day} ${hijriMonthName}`;
            document.getElementById('modalCalendarEventDescription').innerHTML = currentLanguage === 'ur' ? event.description_ur : event.description_en;
            const calendarEventDetailModal = new bootstrap.Modal(document.getElementById('calendarEventDetailModal'));
            calendarEventDetailModal.show();
        }

        function gregorianToHijri(gDate) {
            let g_y = gDate.getFullYear();
            let g_m = gDate.getMonth() + 1;
            let g_d = gDate.getDate();
            let jd = Math.floor((1461 * (g_y + 4800 + Math.floor((g_m - 14) / 12))) / 4) +
                Math.floor((367 * (g_m - 2 - 12 * (Math.floor((g_m - 14) / 12)))) / 12) -
                Math.floor((3 * Math.floor((g_y + 4900 + Math.floor((g_m - 14) / 12)) / 100)) / 4) +
                g_d - 32075;
            let l = jd - 1948440 + 10632;
            let n = Math.floor((l - 1) / 10631);
            l = l - 10631 * n + 354;
            let j = (Math.floor((10985 - l) / 5316) * Math.floor((50 * l) / 17719)) +
                (Math.floor(l / 5670) * Math.floor((43 * l) / 15238));
            l = l - Math.floor((30 - j) / 15) * Math.floor((17719 * j) / 50) -
                Math.floor(j / 16) * Math.floor((15238 * j) / 43) + 29;
            let m = Math.floor((24 * l) / 709);
            let d = l - Math.floor((709 * m) / 24);
            let y = 30 * n + j - 30;
            return {
                year: y,
                month: m,
                day: d
            };
        }

        function hijriToGregorian(hYear, hMonth, hDay) {
            let jd = Math.floor((11 * hYear + 3) / 30) + (354 * hYear) + (30 * hMonth) - Math.floor((hMonth - 1) / 2) + hDay + 1948440 - 32045;
            let l = jd + 68569;
            let n = Math.floor((4 * l) / 146097);
            l = l - Math.floor((146097 * n + 3) / 4);
            let i = Math.floor((4000 * (l + 1)) / 1461001);
            l = l - Math.floor((1461 * i) / 4) + 31;
            let j = Math.floor((80 * l) / 2447);
            let d = l - Math.floor((2447 * j) / 80);
            l = Math.floor(j / 11);
            let m = j + 2 - (12 * l);
            let y = 100 * (n - 49) + i + l;
            return new Date(y, m - 1, d);
        }

        function convertGregorianToHijri() {
            const gregorianDateStr = document.getElementById('gregorianToHijriInput').value;
            if (gregorianDateStr) {
                const gDate = new Date(gregorianDateStr + 'T00:00:00Z');
                const hDate = gregorianToHijri(gDate);
                const hijriMonthName = currentLanguage === 'ur' ? hijriMonths[hDate.month - 1] : hijriMonthsEn[hDate.month - 1];
                document.getElementById('convertedHijriDate').textContent = `${hDate.day} ${hijriMonthName}, ${hDate.year} ہجری`;
            } else {
                document.getElementById('convertedHijriDate').textContent = translations[currentLanguage]["براہ کرم تاریخ درج کریں۔"];
            }
        }

        function convertHijriToGregorian() {
            const hijriYear = parseInt(document.getElementById('hijriYearInput').value);
            const hijriMonth = parseInt(document.getElementById('hijriMonthInput').value);
            const hijriDay = parseInt(document.getElementById('hijriDayInput').value);
            if (hijriYear && hijriMonth && hijriDay) {
                const gDate = hijriToGregorian(hijriYear, hijriMonth, hijriDay);
                document.getElementById('convertedGregorianDate').textContent = `Gregorian: ${gDate.toLocaleDateString(currentLanguage === 'ur' ? 'ur-PK' : 'en-US')}`;
            } else {
                document.getElementById('convertedGregorianDate').textContent = translations[currentLanguage]["براہ کرم تمام ہجری تاریخ درج کریں۔"];
            }
        }
        let userLocation = null;
        let map = null;
        let marker = null;
        let qiblaLayer = null;

        function getPrayerTimes() {
            const prayerLocationInput = document.getElementById('prayerLocation');
            const calculationMethodSelect = document.getElementById('calculationMethod');
            if (!prayerLocationInput || !calculationMethodSelect) {
                return;
            }
            if (!navigator.geolocation) {
                alert(translations[currentLanguage]["آپ کا براؤزر جغرافیائی محل وقوع کی حمایت نہیں کرتا ہے۔ (Your browser does not support geolocation.)"]);
                return;
            }
            const cityInput = prayerLocationInput.value;
            if (cityInput) {
                console.warn(translations[currentLanguage]["شہر کے نام سے اوقات نماز حاصل کرنے کے لیے ایک جغرافیائی لوکیشن سروس کی ضرورت ہے۔ فی الحال آپ کے موجودہ مقام کا استعمال کیا جائے گا۔ (Getting prayer times by city name requires a geocoding service. Your current location will be used for now.)"]);
            }
            navigator.geolocation.getCurrentPosition(
                async (position) => {
                        userLocation = {
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude
                        };
                        localStorage.setItem('userLatitude', userLocation.latitude);
                        localStorage.setItem('userLongitude', userLocation.longitude);
                        localStorage.setItem('prayerCalculationMethod', calculationMethodSelect.value);
                        const date = new Date();
                        const params = adhan.CalculationMethod[calculationMethodSelect.value]();
                        const coordinates = new adhan.Coordinates(userLocation.latitude, userLocation.longitude);
                        const prayerTimes = new adhan.PrayerTimes(coordinates, date, params);
                        const times = {
                            Fajr: prayerTimes.fajr.toLocaleTimeString(currentLanguage === 'ur' ? 'ur-PK' : 'en-US', {
                                hour: '2-digit',
                                minute: '2-digit'
                            }),
                            Sunrise: prayerTimes.sunrise.toLocaleTimeString(currentLanguage === 'ur' ? 'ur-PK' : 'en-US', {
                                hour: '2-digit',
                                minute: '2-digit'
                            }),
                            Dhuhr: prayerTimes.dhuhr.toLocaleTimeString(currentLanguage === 'ur' ? 'ur-PK' : 'en-US', {
                                hour: '2-digit',
                                minute: '2-digit'
                            }),
                            Asr: prayerTimes.asr.toLocaleTimeString(currentLanguage === 'ur' ? 'ur-PK' : 'en-US', {
                                hour: '2-digit',
                                minute: '2-digit'
                            }),
                            Maghrib: prayerTimes.maghrib.toLocaleTimeString(currentLanguage === 'ur' ? 'ur-PK' : 'en-US', {
                                hour: '2-digit',
                                minute: '2-digit'
                            }),
                            Isha: prayerTimes.isha.toLocaleTimeString(currentLanguage === 'ur' ? 'ur-PK' : 'en-US', {
                                hour: '2-digit',
                                minute: '2-digit'
                            }),
                        };
                        let prayerHtml = '';
                        for (const time in times) {
                            prayerHtml += `<div><strong>${time}:</strong> ${times[time]}</div>`;
                        }
                        document.getElementById('prayerTimesDisplay').innerHTML = prayerHtml;
                        updateQiblaDirection(userLocation);
                    },
                    (error) => {
                        const prayerTimesDisplay = document.getElementById('prayerTimesDisplay');
                        if (prayerTimesDisplay) {
                            prayerTimesDisplay.innerHTML = `${translations[currentLanguage]["اوقاتِ نماز حاصل کرنے میں خرابی:"]} ${error.message}`;
                        }
                        const qiblaInfo = document.getElementById('qiblaInfo');
                        if (qiblaInfo) {
                            qiblaInfo.textContent = translations[currentLanguage]["مقام کی اجازت درکار ہے۔"];
                        }
                        console.error("Geolocation Error:", error);
                    }, {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
            );
        }

        function initializeQiblaMap() {
            const mapContainer = document.getElementById('qiblaMap');
            if (!mapContainer) {
                return;
            }
            if (map) {
                map.remove();
            }
            map = L.map('qiblaMap').setView([0, 0], 2);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            marker = L.marker([0, 0]).addTo(map);
            qiblaLayer = L.layerGroup().addTo(map);
        }

        function updateQiblaDirection(location) {
            const qiblaArrow = document.getElementById('qiblaArrow');
            const qiblaInfo = document.getElementById('qiblaInfo');
            if (!qiblaArrow || !qiblaInfo) {
                return;
            }
            if (!location || typeof adhan === 'undefined') {
                qiblaInfo.textContent = translations[currentLanguage]["مقام دستیاب نہیں ہے۔"];
                return;
            }
            const qiblaAngle = adhan.Qibla(new adhan.Coordinates(location.latitude, location.longitude));
            document.getElementById('qiblaArrow').style.transform = `rotate(${qiblaAngle}deg)`;
            document.getElementById('qiblaInfo').textContent = `${translations[currentLanguage]["قبلہ کی سمت: "]} ${qiblaAngle.toFixed(2)}° ${translations[currentLanguage]["(شمال سے)"]}`;
            if (map && marker) {
                map.setView([location.latitude, location.longitude], 10);
                marker.setLatLng([location.latitude, location.longitude]);
                qiblaLayer.clearLayers();
                const kaabaLat = 21.4225;
                const kaabaLon = 39.8262;
                const line = L.polyline([
                    [location.latitude, location.longitude],
                    [kaabaLat, kaabaLon]
                ], {
                    color: 'red',
                    weight: 3,
                    opacity: 0.7
                }).addTo(qiblaLayer);
            }
        }

        function exportData() {
            const data = {
                prophetMuhammadBirthDateGregorian: prophetMuhammadBirthDateGregorian ? prophetMuhammadBirthDateGregorian.toISOString() : null,
                prophetMuhammadDeathDateGregorian: prophetMuhammadDeathDateGregorian ? prophetMuhammadDeathDateGregorian.toISOString() : null,
                theme: currentTheme,
                fontSize: currentFontSize,
                language: currentLanguage,
                userLatitude: localStorage.getItem('userLatitude'),
                userLongitude: localStorage.getItem('userLongitude'),
                prayerCalculationMethod: localStorage.getItem('prayerCalculationMethod'),
                tasbihCount: localStorage.getItem('tasbihCount'),
            };
            const dataStr = JSON.stringify(data, null, 2);
            const blob = new Blob([dataStr], {
                type: 'application/json'
            });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'prophet_islamic_hub_data.json';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }

        function importData(event) {
            const file = event.target.files[0];
            if (!file) {
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                try {
                    const importedData = JSON.parse(e.target.result);
                    if (importedData.prophetMuhammadBirthDateGregorian) {
                        prophetMuhammadBirthDateGregorian = new Date(importedData.prophetMuhammadBirthDateGregorian);
                    }
                    if (importedData.prophetMuhammadDeathDateGregorian) {
                        prophetMuhammadDeathDateGregorian = new Date(importedData.prophetMuhammadDeathDateGregorian);
                    }
                    if (importedData.theme) {
                        setTheme(importedData.theme);
                    }
                    if (importedData.fontSize) {
                        currentFontSize = importedData.fontSize;
                        changeFontSize(0);
                    }
                    if (importedData.language) {
                        currentLanguage = importedData.language;
                        document.getElementById('languageSelect').value = currentLanguage;
                    }
                    if (importedData.userLatitude && importedData.userLongitude) {
                        localStorage.setItem('userLatitude', importedData.userLatitude);
                        localStorage.setItem('userLongitude', importedData.userLongitude);
                    }
                    if (importedData.prayerCalculationMethod) {
                        localStorage.setItem('prayerCalculationMethod', importedData.prayerCalculationMethod);
                        document.getElementById('calculationMethod').value = importedData.prayerCalculationMethod;
                    }
                    if (importedData.tasbihCount !== undefined) {
                        tasbihCount = parseInt(importedData.tasbihCount);
                        document.getElementById('tasbihCount').textContent = tasbihCount;
                        localStorage.setItem('tasbihCount', tasbihCount);
                    }
                    saveData();
                    populateSettingsModal();
                    translatePage();
                    updateCountdown();
                    getPrayerTimes();
                    alert(translations[currentLanguage]["ڈیٹا کامیابی سے بحال ہو گیا ہے! (Data restored successfully!)"]);
                } catch (error) {
                    alert(translations[currentLanguage]["فائل پڑھنے میں خرابی پیش آئی۔ یہ ایک درست JSON فائل نہیں ہے۔ (Error reading file. It might not be a valid JSON.)"]);
                    console.error('Import error:', error);
                }
            };
            reader.onerror = function() {
                alert(translations[currentLanguage]["فائل پڑھنے میں خرابی پیش آئی۔ (Error reading file.)"]);
            };
            reader.readAsText(file);
            event.target.value = '';
        }

        function saveData() {
            const data = {
                prophetMuhammadBirthDateGregorian: prophetMuhammadBirthDateGregorian ? prophetMuhammadBirthDateGregorian.toISOString() : null,
                prophetMuhammadDeathDateGregorian: prophetMuhammadDeathDateGregorian ? prophetMuhammadDeathDateGregorian.toISOString() : null,
                theme: currentTheme,
                fontSize: currentFontSize,
                language: currentLanguage,
                userLatitude: localStorage.getItem('userLatitude'),
                userLongitude: localStorage.getItem('userLongitude'),
                prayerCalculationMethod: localStorage.getItem('prayerCalculationMethod'),
                tasbihCount: localStorage.getItem('tasbihCount'),
            };
            localStorage.setItem(APP_DATA_KEY, JSON.stringify(data));
        }

        function updateCountdown() {
            const countdownBirthElement = document.getElementById("countdownBirth");
            if (!countdownBirthElement) {
                return;
            }
            const now = Date.now();
            if (prophetMuhammadBirthDateGregorian) {
                const birthTimeDifference = now - prophetMuhammadBirthDateGregorian.getTime();
                document.getElementById("countdownBirth").innerHTML = formatTimeDifference(birthTimeDifference);
                document.getElementById("totalDaysMonthsBirth").innerHTML = calculateTotalDaysMonths(birthTimeDifference);
            }
            if (prophetMuhammadDeathDateGregorian) {
                const deathTimeDifference = now - prophetMuhammadDeathDateGregorian.getTime();
                document.getElementById("countdownDeath").innerHTML = formatTimeDifference(deathTimeDifference);
                document.getElementById("totalDaysMonthsDeath").innerHTML = calculateTotalDaysMonths(deathTimeDifference);
            }
            updateUpcomingAnniversaries();
            displaySeerahEventToday();
        }

        function getPrayerTimes() {
            const prayerLocationInput = document.getElementById('prayerLocation');
            const calculationMethodSelect = document.getElementById('calculationMethod');
            if (!prayerLocationInput || !calculationMethodSelect) {
                return;
            }
            if (!navigator.geolocation) {
                alert(translations[currentLanguage]["آپ کا براؤزر جغرافیائی محل وقوع کی حمایت نہیں کرتا ہے۔ (Your browser does not support geolocation.)"]);
                return;
            }
            const cityInput = prayerLocationInput.value;
            if (cityInput) {
                console.warn(translations[currentLanguage]["شہر کے نام سے اوقات نماز حاصل کرنے کے لیے ایک جغرافیائی لوکیشن سروس کی ضرورت ہے۔ فی الحال آپ کے موجودہ مقام کا استعمال کیا جائے گا۔ (Getting prayer times by city name requires a geocoding service. Your current location will be used for now.)"]);
            }
            navigator.geolocation.getCurrentPosition(
                async (position) => {
                        userLocation = {
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude
                        };
                        localStorage.setItem('userLatitude', userLocation.latitude);
                        localStorage.setItem('userLongitude', userLocation.longitude);
                        localStorage.setItem('prayerCalculationMethod', calculationMethodSelect.value);
                        const date = new Date();
                        const params = adhan.CalculationMethod[calculationMethodSelect.value]();
                        const coordinates = new adhan.Coordinates(userLocation.latitude, userLocation.longitude);
                        const prayerTimes = new adhan.PrayerTimes(coordinates, date, params);
                        const times = {
                            Fajr: prayerTimes.fajr.toLocaleTimeString(currentLanguage === 'ur' ? 'ur-PK' : 'en-US', {
                                hour: '2-digit',
                                minute: '2-digit'
                            }),
                            Sunrise: prayerTimes.sunrise.toLocaleTimeString(currentLanguage === 'ur' ? 'ur-PK' : 'en-US', {
                                hour: '2-digit',
                                minute: '2-digit'
                            }),
                            Dhuhr: prayerTimes.dhuhr.toLocaleTimeString(currentLanguage === 'ur' ? 'ur-PK' : 'en-US', {
                                hour: '2-digit',
                                minute: '2-digit'
                            }),
                            Asr: prayerTimes.asr.toLocaleTimeString(currentLanguage === 'ur' ? 'ur-PK' : 'en-US', {
                                hour: '2-digit',
                                minute: '2-digit'
                            }),
                            Maghrib: prayerTimes.maghrib.toLocaleTimeString(currentLanguage === 'ur' ? 'ur-PK' : 'en-US', {
                                hour: '2-digit',
                                minute: '2-digit'
                            }),
                            Isha: prayerTimes.isha.toLocaleTimeString(currentLanguage === 'ur' ? 'ur-PK' : 'en-US', {
                                hour: '2-digit',
                                minute: '2-digit'
                            }),
                        };
                        let prayerHtml = '';
                        for (const time in times) {
                            prayerHtml += `<div><strong>${time}:</strong> ${times[time]}</div>`;
                        }
                        document.getElementById('prayerTimesDisplay').innerHTML = prayerHtml;
                        updateQiblaDirection(userLocation);
                    },
                    (error) => {
                        const prayerTimesDisplay = document.getElementById('prayerTimesDisplay');
                        if (prayerTimesDisplay) {
                            prayerTimesDisplay.innerHTML = `${translations[currentLanguage]["اوقاتِ نماز حاصل کرنے میں خرابی:"]} ${error.message}`;
                        }
                        const qiblaInfo = document.getElementById('qiblaInfo');
                        if (qiblaInfo) {
                            qiblaInfo.textContent = translations[currentLanguage]["مقام کی اجازت درکار ہے۔"];
                        }
                        console.error("Geolocation Error:", error);
                    }, {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
            );
        }

        function populateCalendar() {
            const calendarGrid = document.getElementById('calendarGrid');
            if (!calendarGrid) {
                return;
            }
            calendarGrid.innerHTML = '';
            const dayHeaders = currentLanguage === 'ur' ? gregorianDaysOfWeek : gregorianDaysOfWeekEn;
            dayHeaders.forEach(day => {
                const headerDiv = document.createElement('div');
                headerDiv.className = 'calendar-day-header';
                headerDiv.textContent = translations[currentLanguage][day];
                calendarGrid.appendChild(headerDiv);
            });
            const todayGregorian = new Date();
            const todayHijri = getHijriDate(todayGregorian);
            let displayHijriMonth = currentHijriCalendarMonth || todayHijri.month;
            let displayHijriYear = currentHijriCalendarYear || todayHijri.year;
            const currentHijriMonthYearElement = document.getElementById('currentHijriMonthYear');
            if (currentHijriMonthYearElement) {
                currentHijriMonthYearElement.textContent =
                    `${currentLanguage === 'ur' ? hijriMonths[displayHijriMonth - 1] : translations[currentLanguage][hijriMonthsEn[displayHijriMonth - 1]]} ${displayHijriYear} ہجری`;
            }
            let firstDayOfMonthGregorian = hijriToGregorian(displayHijriYear, displayHijriMonth, 1);
            let firstDayOfWeek = firstDayOfMonthGregorian.getDay();
            let daysInMonth = (displayHijriMonth % 2 !== 0 || displayHijriMonth === 12) ? 30 : 29;
            for (let i = 0; i < firstDayOfWeek; i++) {
                const emptyDiv = document.createElement('div');
                emptyDiv.className = 'calendar-day empty';
                calendarGrid.appendChild(emptyDiv);
            }
            for (let day = 1; day <= daysInMonth; day++) {
                const dayDiv = document.createElement('div');
                dayDiv.className = 'calendar-day';
                const hijriDaySpan = document.createElement('span');
                hijriDaySpan.textContent = day;
                dayDiv.appendChild(hijriDaySpan);
                const approxGregorian = hijriToGregorian(displayHijriYear, displayHijriMonth, day);
                const gregorianSpan = document.createElement('span');
                gregorianSpan.className = 'gregorian';
                gregorianSpan.textContent = approxGregorian.getDate();
                dayDiv.appendChild(gregorianSpan);
                if (day === todayHijri.day && displayHijriMonth === todayHijri.month && displayHijriYear === todayHijri.year) {
                    dayDiv.classList.add('today');
                }
                const eventsForThisDay = allCalendarEvents.filter(event =>
                    parseInt(event.hijri_day) === day && parseInt(event.hijri_month) === displayHijriMonth
                );
                if (eventsForThisDay.length > 0) {
                    const eventDot = document.createElement('div');
                    eventDot.className = 'event-dot';
                    dayDiv.appendChild(eventDot);
                    dayDiv.classList.add('highlighted');
                    dayDiv.onclick = () => {
                        let combinedDescription = '';
                        eventsForThisDay.forEach(e => {
                            combinedDescription += `<strong>${currentLanguage === 'ur' ? e.event_title_ur : e.event_title_en}</strong><br>`;
                            if (e.description_ur || e.description_en) {
                                combinedDescription += `<p>${currentLanguage === 'ur' ? e.description_ur : e.description_en}</p>`;
                            }
                        });
                        showCalendarEventDetail({
                            event_title_ur: `${day} ${hijriMonths[displayHijriMonth - 1]}`,
                            event_title_en: `${day} ${hijriMonthsEn[displayHijriMonth - 1]}`,
                            hijri_day: day,
                            hijri_month: displayHijriMonth,
                            description_ur: combinedDescription,
                            description_en: combinedDescription
                        });
                    };
                }
                calendarGrid.appendChild(dayDiv);
            }
        }

        function loadQuizQuestion() {
            const quizQuestionElement = document.getElementById('quizQuestion');
            if (!quizQuestionElement) {
                return;
            }
            if (allQuizQuestions.length === 0) {
                quizQuestionElement.textContent = "No quiz questions available.";
                document.getElementById('quizOptions').innerHTML = "";
                document.getElementById('quizFeedback').textContent = "";
                document.getElementById('nextQuizQuestionBtn').style.display = 'none';
                return;
            }
            const randomIndex = Math.floor(Math.random() * allQuizQuestions.length);
            currentQuizQuestion = allQuizQuestions[randomIndex];
            quizQuestionElement.textContent = currentLanguage === 'ur' ? currentQuizQuestion.question_ur : currentQuizQuestion.question_en;
            const optionsDiv = document.getElementById('quizOptions');
            optionsDiv.innerHTML = '';
            document.getElementById('quizFeedback').textContent = '';
            document.getElementById('nextQuizQuestionBtn').style.display = 'none';
            const options = currentLanguage === 'ur' ? currentQuizQuestion.options_ur : currentQuizQuestion.options_en;
            options.forEach((option, index) => {
                const button = document.createElement('button');
                button.textContent = option;
                button.onclick = () => checkAnswer(index);
                optionsDiv.appendChild(button);
            });
        }

        function loadData() {
            const storedData = localStorage.getItem(APP_DATA_KEY);
            if (storedData) {
                try {
                    const data = JSON.parse(storedData);
                    prophetMuhammadBirthDateGregorian = data.prophetMuhammadBirthDateGregorian ? new Date(data.prophetMuhammadBirthDateGregorian) : defaultBirthDateGregorian;
                    prophetMuhammadDeathDateGregorian = data.prophetMuhammadDeathDateGregorian ? new Date(data.prophetMuhammadDeathDateGregorian) : defaultDeathDateGregorian;
                    currentTheme = data.theme || 'light';
                    currentFontSize = data.fontSize || 16;
                    currentLanguage = data.language || 'ur';
                    if (data.userLatitude && data.userLongitude) {
                        localStorage.setItem('userLatitude', data.userLatitude);
                        localStorage.setItem('userLongitude', data.userLongitude);
                    }
                    if (data.prayerCalculationMethod) {
                        localStorage.setItem('prayerCalculationMethod', data.prayerCalculationMethod);
                    }
                    if (data.tasbihCount !== undefined) {
                        tasbihCount = parseInt(data.tasbihCount);
                    } else {
                        tasbihCount = 0;
                    }
                } catch (e) {
                    console.error("Error parsing stored data, using defaults:", e);
                    resetToDefaults();
                }
            } else {
                resetToDefaults();
            }
            setTheme(currentTheme);
            changeFontSize(0);
            const languageSelect = document.getElementById('languageSelect');
            if (languageSelect) {
                languageSelect.value = currentLanguage;
            }
            const tasbihCountElement = document.getElementById('tasbihCount');
            if (tasbihCountElement) {
                tasbihCountElement.textContent = tasbihCount;
            }
            const savedLat = localStorage.getItem('userLatitude');
            const savedLon = localStorage.getItem('userLongitude');
            const savedCalcMethod = localStorage.getItem('prayerCalculationMethod');
            if (savedLat && savedLon && savedCalcMethod) {
                const calculationMethodElement = document.getElementById('calculationMethod');
                if (calculationMethodElement) {
                    calculationMethodElement.value = savedCalcMethod;
                }
                userLocation = {
                    latitude: parseFloat(savedLat),
                    longitude: parseFloat(savedLon)
                };
                getPrayerTimes();
            }
            populateSettingsModal();
            translatePage();
        }

        function resetToDefaults() {
            prophetMuhammadBirthDateGregorian = defaultBirthDateGregorian;
            prophetMuhammadDeathDateGregorian = defaultDeathDateGregorian;
            currentTheme = 'light';
            currentFontSize = 16;
            currentLanguage = 'ur';
            localStorage.removeItem('userLatitude');
            localStorage.removeItem('userLongitude');
            localStorage.removeItem('prayerCalculationMethod');
            localStorage.setItem('tasbihCount', 0);
            tasbihCount = 0;
        }

        function populateSettingsModal() {
            const birthDateInput = document.getElementById('birthDateInput');
            const deathDateInput = document.getElementById('deathDateInput');
            if (prophetMuhammadBirthDateGregorian) {
                birthDateInput.value = prophetMuhammadBirthDateGregorian.toISOString().split('T')[0];
            }
            if (deathDateInput) {
                deathDateInput.value = prophetMuhammadDeathDateGregorian.toISOString().split('T')[0];
            }
        }

        function shareContent(elementId, title) {
            const text = document.getElementById(elementId).innerText;
            if (navigator.share) {
                navigator.share({
                    title: title,
                    text: text + '\n\n' + window.location.href,
                    url: window.location.href,
                }).then(() => {
                    console.log('Shared successfully');
                }).catch((error) => {
                    console.error('Error sharing:', error);
                });
            } else {
                alert(`You can copy this ${title}:\n\n${text}\n\nVisit: ${window.location.href}`);
            }
        }

        function getHijriDate(date) {
            return gregorianToHijri(date);
        }

        function changeMonth(delta) {
            let currentMonth = currentHijriCalendarMonth;
            let currentYear = currentHijriCalendarYear;
            if (currentMonth === null || currentYear === null) {
                const todayHijri = getHijriDate(new Date());
                currentMonth = todayHijri.month;
                currentYear = todayHijri.year;
            }
            currentMonth += delta;
            if (currentMonth > 12) {
                currentMonth = 1;
                currentYear++;
            } else if (currentMonth < 1) {
                currentMonth = 12;
                currentYear--;
            }
            currentHijriCalendarMonth = currentMonth;
            currentHijriCalendarYear = currentYear;
            populateCalendar();
        }

        function checkAnswer(selectedIndex) {
            const optionsButtons = document.querySelectorAll('#quizOptions button');
            optionsButtons.forEach((button, index) => {
                button.disabled = true;
                if (index === currentQuizQuestion.correct_answer_index) {
                    button.classList.add('correct');
                } else if (index === selectedIndex) {
                    button.classList.add('incorrect');
                }
            });
            const feedbackDiv = document.getElementById('quizFeedback');
            if (selectedIndex === currentQuizQuestion.correct_answer_index) {
                feedbackDiv.textContent = currentLanguage === 'ur' ? "صحیح جواب! " : "Correct answer! ";
            } else {
                feedbackDiv.textContent = currentLanguage === 'ur' ? "غلط جواب۔ صحیح جواب ہے: " : "Incorrect answer. The correct answer is: ";
                feedbackDiv.textContent += currentLanguage === 'ur' ? currentQuizQuestion.options_ur[currentQuizQuestion.correct_answer_index] : currentQuizQuestion.options_en[currentQuizQuestion.correct_answer_index];
            }
            feedbackDiv.innerHTML += `<br><strong>${currentLanguage === 'ur' ? "وضاحت: " : "Explanation: "}</strong>${currentLanguage === 'ur' ? currentQuizQuestion.explanation_ur : currentQuizQuestion.explanation_en}`;
            document.getElementById('nextQuizQuestionBtn').style.display = 'block';
        }

        function isLoggedInUser() {
            return <?php echo json_encode(isset($_SESSION['user_id']) && $_SESSION['role'] === 'user'); ?>;
        }

        function updateFavoriteButton(itemType, itemId, buttonElement) {
            if (!buttonElement || itemId === null || !isLoggedInUser()) {
                if (buttonElement) buttonElement.style.display = 'none';
                return;
            }
            buttonElement.style.display = 'inline-block';
            const isFavorited = userFavorites.some(fav => fav.item_type === itemType && parseInt(fav.item_id) === itemId);
            if (isFavorited) {
                buttonElement.innerHTML = '<i class="fas fa-star"></i>';
                buttonElement.classList.add('favorited');
            } else {
                buttonElement.innerHTML = '<i class="far fa-star"></i>';
                buttonElement.classList.remove('favorited');
            }
            buttonElement.setAttribute('data-item-id', itemId);
            buttonElement.setAttribute('data-item-type', itemType);
        }
        async function toggleFavorite(buttonElement) {
            const itemType = buttonElement.getAttribute('data-item-type');
            const itemId = parseInt(buttonElement.getAttribute('data-item-id'));
            const isFavorited = buttonElement.classList.contains('favorited');
            const action = isFavorited ? 'remove_favorite' : 'add_favorite';
            const response = await fetch(`?api=${action}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    item_type: itemType,
                    item_id: itemId
                }),
            });
            const result = await response.json();
            if (result.success) {
                await fetchUserData();
                updateFavoriteButton(itemType, itemId, buttonElement);
            } else {
                alert(`Error: ${result.message}`);
            }
        }
        async function fetchInitialData() {
            try {
                const response = await fetch('?api=get_daily_content');
                const data = await response.json();
                allHadiths = data.all_hadiths || (data.hadith_of_the_day ? [data.hadith_of_the_day] : []);
                allQuranVerses = data.all_quran_verses || (data.quran_verse_of_the_day ? [data.quran_verse_of_the_day] : []);
                allDailyDuas = data.all_daily_duas || (data.dua_of_the_day ? [data.dua_of_the_day] : []);
                allQuizQuestions = data.all_quiz_questions || (data.quiz_question_of_the_day ? [data.quiz_question_of_the_day] : []);
                allSeerahEvents = data.seerah_events.map(event => ({
                    ...event,
                    sortDate: new Date(event.gregorian_date_iso)
                }));
                allAsmaUlHusna = data.asma_ul_husna;
                allProphetNames = data.prophet_names;
                const calendarResponse = await fetch('?api=get_calendar_events');
                allCalendarEvents = await calendarResponse.json();
                if (isLoggedInUser()) {
                    await fetchUserData();
                }
                displayHadithOfTheDay();
                displayQuranVerseOfTheDay();
                displayDuaOfTheDay();
                populateAsmaUlHusna();
                populateProphetNames();
                populateTimeline();
                loadQuizQuestion();
                populateCalendar();
            } catch (error) {
                console.error('Error fetching initial data:', error);
                alert('ڈیٹا لوڈ کرنے میں خرابی پیش آئی۔ (Error loading initial data.)');
            }
        }
        async function fetchUserData() {
            const response = await fetch('?api=get_user_data');
            const result = await response.json();
            if (result.success) {
                userFavorites = result.data.favorites;
                userPrayerLocations = result.data.prayer_locations;
                userDailyZikr = result.data.daily_zikr;
                if (window.location.search.includes('user_dashboard')) {
                    renderUserDashboard();
                }
            } else {
                console.error('Failed to fetch user data:', result.message);
            }
        }
        async function login(username, password, isAdmin = false) {
            const response = await fetch('index.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'login',
                    username: username,
                    password: password,
                    is_admin: isAdmin ? 'true' : 'false'
                })
            });
            const result = await response.json();
            const messageElement = isAdmin ? document.getElementById('loginMessage') : document.getElementById('loginMessage');
            messageElement.style.display = 'block';
            if (result.success) {
                messageElement.classList.remove('alert-danger');
                messageElement.classList.add('alert-success');
                messageElement.textContent = result.message;
                setTimeout(() => {
                    const authModal = bootstrap.Modal.getInstance(document.getElementById('authModal'));
                    authModal.hide();
                    location.reload();
                }, 1000);
            } else {
                messageElement.classList.remove('alert-success');
                messageElement.classList.add('alert-danger');
                messageElement.textContent = result.message;
            }
        }
        async function register(username, email, password, confirmPassword) {
            if (password !== confirmPassword) {
                const messageElement = document.getElementById('registerMessage');
                messageElement.style.display = 'block';
                messageElement.classList.remove('alert-success');
                messageElement.classList.add('alert-danger');
                messageElement.textContent = 'Passwords do not match.';
                return;
            }
            const response = await fetch('index.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'register_user',
                    username: username,
                    email: email,
                    password: password
                })
            });
            const result = await response.json();
            const messageElement = document.getElementById('registerMessage');
            messageElement.style.display = 'block';
            if (result.success) {
                messageElement.classList.remove('alert-danger');
                messageElement.classList.add('alert-success');
                messageElement.textContent = result.message;
                document.getElementById('registerForm').reset();
                setTimeout(() => {
                    new bootstrap.Tab(document.getElementById('login-tab')).show();
                }, 1500);
            } else {
                messageElement.classList.remove('alert-success');
                messageElement.classList.add('alert-danger');
                messageElement.textContent = result.message;
            }
        }
        async function logout() {
            const response = await fetch('index.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'logout'
                })
            });
            const result = await response.json();
            if (result.success) {
                location.reload();
            } else {
                alert('Logout failed.');
            }
        }
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const username = document.getElementById('loginUsername').value;
            const password = document.getElementById('loginPassword').value;
            const isAdmin = document.getElementById('isAdminLogin').checked;
            login(username, password, isAdmin);
        });
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const username = document.getElementById('registerUsername').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            register(username, email, password, confirmPassword);
        });
        const adminCrudTableConfig = {
            hadiths: {
                fields: {
                    id: {
                        type: 'text',
                        label_ur: 'ID',
                        label_en: 'ID',
                        readonly: true
                    },
                    hadith_ur: {
                        type: 'textarea',
                        label_ur: 'حدیث (اردو)',
                        label_en: 'Hadith (Urdu)',
                        required: true
                    },
                    hadith_en: {
                        type: 'textarea',
                        label_ur: 'حدیث (انگریزی)',
                        label_en: 'Hadith (English)',
                        required: true
                    },
                    source_ur: {
                        type: 'text',
                        label_ur: 'ماخذ (اردو)',
                        label_en: 'Source (Urdu)',
                        required: true
                    },
                    source_en: {
                        type: 'text',
                        label_ur: 'ماخذ (انگریزی)',
                        label_en: 'Source (English)',
                        required: true
                    }
                },
                displayOrder: ['id', 'hadith_ur', 'hadith_en', 'source_ur', 'source_en']
            },
            quran_verses: {
                fields: {
                    id: {
                        type: 'text',
                        label_ur: 'ID',
                        label_en: 'ID',
                        readonly: true
                    },
                    surah_number: {
                        type: 'number',
                        label_ur: 'سورہ نمبر',
                        label_en: 'Surah Number',
                        required: true
                    },
                    verse_number: {
                        type: 'number',
                        label_ur: 'آیت نمبر',
                        label_en: 'Verse Number',
                        required: true
                    },
                    arabic_text: {
                        type: 'textarea',
                        label_ur: 'عربی متن',
                        label_en: 'Arabic Text',
                        required: true
                    },
                    transliteration: {
                        type: 'textarea',
                        label_ur: 'ٹرانسلیٹریشن',
                        label_en: 'Transliteration'
                    },
                    translation_ur: {
                        type: 'textarea',
                        label_ur: 'ترجمہ (اردو)',
                        label_en: 'Translation (Urdu)',
                        required: true
                    },
                    translation_en: {
                        type: 'textarea',
                        label_ur: 'ترجمہ (انگریزی)',
                        label_en: 'Translation (English)',
                        required: true
                    },
                    audio_url: {
                        type: 'url',
                        label_ur: 'آڈیو URL',
                        label_en: 'Audio URL'
                    }
                },
                displayOrder: ['id', 'surah_number', 'verse_number', 'arabic_text', 'translation_ur', 'audio_url']
            },
            daily_duas: {
                fields: {
                    id: {
                        type: 'text',
                        label_ur: 'ID',
                        label_en: 'ID',
                        readonly: true
                    },
                    dua_title_ur: {
                        type: 'text',
                        label_ur: 'دعا کا عنوان (اردو)',
                        label_en: 'Dua Title (Urdu)',
                        required: true
                    },
                    dua_title_en: {
                        type: 'text',
                        label_ur: 'دعا کا عنوان (انگریزی)',
                        label_en: 'Dua Title (English)',
                        required: true
                    },
                    arabic_text: {
                        type: 'textarea',
                        label_ur: 'عربی متن',
                        label_en: 'Arabic Text',
                        required: true
                    },
                    transliteration: {
                        type: 'textarea',
                        label_ur: 'ٹرانسلیٹریشن',
                        label_en: 'Transliteration'
                    },
                    translation_ur: {
                        type: 'textarea',
                        label_ur: 'ترجمہ (اردو)',
                        label_en: 'Translation (Urdu)',
                        required: true
                    },
                    translation_en: {
                        type: 'textarea',
                        label_ur: 'ترجمہ (انگریزی)',
                        label_en: 'Translation (English)',
                        required: true
                    }
                },
                displayOrder: ['id', 'dua_title_ur', 'arabic_text', 'translation_ur']
            },
            quiz_questions: {
                fields: {
                    id: {
                        type: 'text',
                        label_ur: 'ID',
                        label_en: 'ID',
                        readonly: true
                    },
                    question_ur: {
                        type: 'textarea',
                        label_ur: 'سوال (اردو)',
                        label_en: 'Question (Urdu)',
                        required: true
                    },
                    question_en: {
                        type: 'textarea',
                        label_ur: 'سوال (انگریزی)',
                        label_en: 'Question (English)',
                        required: true
                    },
                    options_ur: {
                        type: 'json_array',
                        label_ur: 'آپشنز (اردو) (کاما سے جدا کریں)',
                        label_en: 'Options (Urdu) (Comma-separated)',
                        required: true
                    },
                    options_en: {
                        type: 'json_array',
                        label_ur: 'آپشنز (انگریزی) (کاما سے جدا کریں)',
                        label_en: 'Options (English) (Comma-separated)',
                        required: true
                    },
                    correct_answer_index: {
                        type: 'number',
                        label_ur: 'صحیح جواب کا انڈیکس (0 سے شروع)',
                        label_en: 'Correct Answer Index (0-based)',
                        required: true,
                        min: 0
                    },
                    explanation_ur: {
                        type: 'textarea',
                        label_ur: 'وضاحت (اردو)',
                        label_en: 'Explanation (Urdu)'
                    },
                    explanation_en: {
                        type: 'textarea',
                        label_ur: 'وضاحت (انگریزی)',
                        label_en: 'Explanation (English)'
                    }
                },
                displayOrder: ['id', 'question_ur', 'options_ur', 'correct_answer_index']
            },
            seerah_events: {
                fields: {
                    id: {
                        type: 'text',
                        label_ur: 'ID',
                        label_en: 'ID',
                        readonly: true
                    },
                    title_ur: {
                        type: 'text',
                        label_ur: 'عنوان (اردو)',
                        label_en: 'Title (Urdu)',
                        required: true
                    },
                    title_en: {
                        type: 'text',
                        label_ur: 'عنوان (انگریزی)',
                        label_en: 'Title (English)',
                        required: true
                    },
                    gregorian_date: {
                        type: 'date',
                        label_ur: 'عیسوی تاریخ',
                        label_en: 'Gregorian Date',
                        required: true
                    },
                    hijri_date: {
                        type: 'text',
                        label_ur: 'ہجری تاریخ',
                        label_en: 'Hijri Date',
                        required: true
                    },
                    description_ur: {
                        type: 'textarea',
                        label_ur: 'تفصیل (اردو)',
                        label_en: 'Description (Urdu)'
                    },
                    description_en: {
                        type: 'textarea',
                        label_ur: 'تفصیل (انگریزی)',
                        label_en: 'Description (English)'
                    },
                    source: {
                        type: 'text',
                        label_ur: 'ماخذ',
                        label_en: 'Source'
                    }
                },
                displayOrder: ['id', 'title_ur', 'gregorian_date', 'hijri_date']
            },
            asma_ul_husna: {
                fields: {
                    id: {
                        type: 'text',
                        label_ur: 'ID',
                        label_en: 'ID',
                        readonly: true
                    },
                    arabic_name: {
                        type: 'text',
                        label_ur: 'عربی نام',
                        label_en: 'Arabic Name',
                        required: true
                    },
                    transliteration: {
                        type: 'text',
                        label_ur: 'ٹرانسلیٹریشن',
                        label_en: 'Transliteration'
                    },
                    meaning_ur: {
                        type: 'textarea',
                        label_ur: 'معنی (اردو)',
                        label_en: 'Meaning (Urdu)',
                        required: true
                    },
                    meaning_en: {
                        type: 'textarea',
                        label_ur: 'معنی (انگریزی)',
                        label_en: 'Meaning (English)',
                        required: true
                    }
                },
                displayOrder: ['id', 'arabic_name', 'meaning_ur']
            },
            prophet_names: {
                fields: {
                    id: {
                        type: 'text',
                        label_ur: 'ID',
                        label_en: 'ID',
                        readonly: true
                    },
                    arabic_name: {
                        type: 'text',
                        label_ur: 'عربی نام',
                        label_en: 'Arabic Name',
                        required: true
                    },
                    transliteration: {
                        type: 'text',
                        label_ur: 'ٹرانسلیٹریشن',
                        label_en: 'Transliteration'
                    },
                    meaning_ur: {
                        type: 'textarea',
                        label_ur: 'معنی (اردو)',
                        label_en: 'Meaning (Urdu)',
                        required: true
                    },
                    meaning_en: {
                        type: 'textarea',
                        label_ur: 'معنی (انگریزی)',
                        label_en: 'Meaning (English)',
                        required: true
                    }
                },
                displayOrder: ['id', 'arabic_name', 'meaning_ur']
            },
            islamic_calendar_events: {
                fields: {
                    id: {
                        type: 'text',
                        label_ur: 'ID',
                        label_en: 'ID',
                        readonly: true
                    },
                    hijri_day: {
                        type: 'number',
                        label_ur: 'ہجری دن',
                        label_en: 'Hijri Day',
                        required: true
                    },
                    hijri_month: {
                        type: 'number',
                        label_ur: 'ہجری ماہ',
                        label_en: 'Hijri Month',
                        required: true
                    },
                    event_title_ur: {
                        type: 'text',
                        label_ur: 'واقعہ کا عنوان (اردو)',
                        label_en: 'Event Title (Urdu)',
                        required: true
                    },
                    event_title_en: {
                        type: 'text',
                        label_ur: 'واقعہ کا عنوان (انگریزی)',
                        label_en: 'Event Title (English)',
                        required: true
                    },
                    description_ur: {
                        type: 'textarea',
                        label_ur: 'تفصیل (اردو)',
                        label_en: 'Description (Urdu)'
                    },
                    description_en: {
                        type: 'textarea',
                        label_ur: 'تفصیل (انگریزی)',
                        label_en: 'Description (English)'
                    }
                },
                displayOrder: ['id', 'hijri_day', 'hijri_month', 'event_title_ur']
            },
            users: {
                fields: {
                    id: {
                        type: 'text',
                        label_ur: 'ID',
                        label_en: 'ID',
                        readonly: true
                    },
                    username: {
                        type: 'text',
                        label_ur: 'یوزرنیم',
                        label_en: 'Username',
                        required: true
                    },
                    email: {
                        type: 'email',
                        label_ur: 'ای میل',
                        label_en: 'Email',
                        required: true
                    },
                    password_hash: {
                        type: 'password_reset',
                        label_ur: 'پاس ورڈ دوبارہ سیٹ کریں',
                        label_en: 'Reset Password',
                    },
                    created_at: {
                        type: 'text',
                        label_ur: 'بنانے کی تاریخ',
                        label_en: 'Created At',
                        readonly: true
                    },
                    last_login: {
                        type: 'text',
                        label_ur: 'آخری لاگ ان',
                        label_en: 'Last Login',
                        readonly: true
                    },
                    settings: {
                        type: 'textarea',
                        label_ur: 'ترتیبات (JSON)',
                        label_en: 'Settings (JSON)',
                        optional: true
                    }
                },
                displayOrder: ['id', 'username', 'email', 'created_at']
            },
            admins: {
                fields: {
                    id: {
                        type: 'text',
                        label_ur: 'ID',
                        label_en: 'ID',
                        readonly: true
                    },
                    username: {
                        type: 'text',
                        label_ur: 'یوزرنیم',
                        label_en: 'Username',
                        required: true
                    },
                    email: {
                        type: 'email',
                        label_ur: 'ای میل',
                        label_en: 'Email',
                        required: true
                    },
                    password_hash: {
                        type: 'password_reset',
                        label_ur: 'پاس ورڈ دوبارہ سیٹ کریں',
                        label_en: 'Reset Password',
                    },
                    created_at: {
                        type: 'text',
                        label_ur: 'بنانے کی تاریخ',
                        label_en: 'Created At',
                        readonly: true
                    }
                },
                displayOrder: ['id', 'username', 'email', 'created_at']
            },
            quran_recitations: {
                fields: {
                    id: {
                        type: 'text',
                        label_ur: 'ID',
                        label_en: 'ID',
                        readonly: true
                    },
                    surah_number: {
                        type: 'number',
                        label_ur: 'سورہ نمبر',
                        label_en: 'Surah Number',
                        required: true
                    },
                    verse_number: {
                        type: 'number',
                        label_ur: 'آیت نمبر',
                        label_en: 'Verse Number',
                        required: true
                    },
                    reciter_name: {
                        type: 'text',
                        label_ur: 'قاری کا نام',
                        label_en: 'Reciter Name',
                        required: true
                    },
                    audio_url: {
                        type: 'url',
                        label_ur: 'آڈیو URL',
                        label_en: 'Audio URL',
                        required: true
                    }
                },
                displayOrder: ['id', 'surah_number', 'verse_number', 'reciter_name', 'audio_url']
            }
        };
        async function fetchAdminData(table) {
            const response = await fetch(`?api=crud&action=read&table=${table}`);
            if (!response.ok) {
                const errorData = await response.json();
                alert('Error fetching data: ' + errorData.message);
                return [];
            }
            const data = await response.json();
            return data.data || [];
        }

        function loadAdminCrudTable() {
            const tableName = document.getElementById('adminCrudTableSelect').value;
            fetch('?api=crud', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        action: 'read',
                        table: tableName
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.data.length > 0) {
                        const headers = Object.keys(data.data[0]);
                        let headerHtml = '<tr>';
                        headers.forEach(header => {
                            headerHtml += `<th>${header}</th>`;
                        });
                        headerHtml += '<th data-translate-key="عمل">Actions</th></tr>';
                        document.getElementById('adminCrudTableHeader').innerHTML = headerHtml;
                        let bodyHtml = '';
                        data.data.forEach(row => {
                            bodyHtml += '<tr>';
                            headers.forEach(header => {
                                let cellValue = row[header];
                                if (typeof cellValue === 'object' && cellValue !== null) {
                                    cellValue = JSON.stringify(cellValue);
                                }
                                bodyHtml += `<td>${cellValue}</td>`;
                            });
                            bodyHtml += `
                <td class="admin-crud-actions">
                    <button class="btn btn-sm btn-warning" onclick="openAdminCrudModal('update', ${row.id})" 
                        data-translate-key="ترمیم کریں">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteAdminCrudRecord('${tableName}', ${row.id})" 
                        data-translate-key="حذف کریں">Delete</button>
                </td>`;
                            bodyHtml += '</tr>';
                        });
                        document.getElementById('adminCrudTableBody').innerHTML = bodyHtml;
                        translatePage();
                    } else {
                        document.getElementById('adminCrudTableHeader').innerHTML = '';
                        document.getElementById('adminCrudTableBody').innerHTML =
                            `<tr><td colspan="${headers ? headers.length + 1 : 1}">${translations[currentLanguage]["کوئی ریکارڈ نہیں ملا۔"]}</td></tr>`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('adminCrudTableHeader').innerHTML = '';
                    document.getElementById('adminCrudTableBody').innerHTML =
                        `<tr><td colspan="1">Error loading data</td></tr>`;
                });
        }

        function deleteAdminCrudRecord(tableName, id) {
            if (confirm(translations[currentLanguage]["کیا آپ واقعی اس ریکارڈ کو حذف کرنا چاہتے ہیں؟"])) {
                fetch('?api=crud', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            action: 'delete',
                            table: tableName,
                            id: id
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Record deleted successfully');
                            loadAdminCrudTable();
                        } else {
                            alert('Error deleting record: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error deleting record');
                    });
            }
        }

        function openAdminCrudModal(action, id = null) {
            const tableName = document.getElementById('adminCrudTableSelect').value;
            const modal = new bootstrap.Modal(document.getElementById('adminCrudModal'));
            const modalTitle = document.getElementById('adminCrudModalLabel');
            const submitBtn = document.getElementById('crudSubmitBtn');
            if (action === 'create') {
                modalTitle.textContent = translations[currentLanguage]["نیا ریکارڈ شامل کریں"];
                submitBtn.textContent = translations[currentLanguage]["شامل کریں"];
            } else {
                modalTitle.textContent = translations[currentLanguage]["ریکورد کو اپ ڈیٹ کریں"];
                submitBtn.textContent = translations[currentLanguage]["ریکورد کو اپ ڈیٹ کریں"];
            }
            document.getElementById('crudFormFields').innerHTML = '';
            if (action === 'update' && id) {
                fetch('?api=crud', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            action: 'read',
                            table: tableName,
                            where: 'id = ?',
                            params: [id]
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success && data.data.length > 0) {
                            const record = data.data[0];
                            buildCrudForm(tableName, record);
                            document.getElementById('crudItemId').value = id;
                            document.getElementById('crudTableName').value = tableName;
                            modal.show();
                        } else {
                            alert('Record not found');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error fetching record data');
                    });
            } else {
                buildCrudForm(tableName);
                document.getElementById('crudItemId').value = '';
                document.getElementById('crudTableName').value = tableName;
                modal.show();
            }
        }

        function buildCrudForm(tableName, record = null) {
            const formFieldsDiv = document.getElementById('crudFormFields');
            formFieldsDiv.innerHTML = '';
            const config = adminCrudTableConfig[tableName];
            const action = record ? 'update' : 'create';
            if (!config) return;
            const itemData = record || {};
            for (const key in config.fields) {
                const field = config.fields[key];
                if (action === 'create' && key === 'id') {
                    continue;
                }
                const labelText = field[`label_${currentLanguage}`] || field.label_en || key;
                let inputHtml = '';
                const elementId = `crud_form_${key}`;
                const commonAttrs = `class="form-control bg-secondary text-white border-0" id="${elementId}" name="${key}" ${field.required ? 'required' : ''} ${field.readonly ? 'readonly' : ''}`;
                if (field.type === 'textarea') {
                    inputHtml = `<textarea ${commonAttrs}>${itemData[key] || ''}</textarea>`;
                } else if (field.type === 'json_array') {
                    const value = Array.isArray(itemData[key]) ? itemData[key].join(', ') : (itemData[key] || '');
                    inputHtml = `<input type="text" ${commonAttrs} value="${value}">`;
                } else if (field.type === 'password_reset') {
                    if (action === 'update') {
                        inputHtml = `<input type="password" class="form-control bg-secondary text-white border-0" name="password" placeholder="${translations[currentLanguage]["پاس ورڈ دوبارہ سیٹ کریں"] || 'Enter new password (optional)'}">`;
                    } else {
                        continue;
                    }
                } else {
                    inputHtml = `<input type="${field.type || 'text'}" ${commonAttrs} value="${itemData[key] || ''}" ${field.min ? `min="${field.min}"` : ''}>`;
                }
                const formGroup = document.createElement('div');
                formGroup.className = 'admin-crud-form-group';
                formGroup.innerHTML = `<label for="${elementId}">${labelText}:</label>${inputHtml}`;
                formFieldsDiv.appendChild(formGroup);
            }
            if (action === 'create' && (tableName === 'users' || tableName === 'admins')) {
                const passGroup = document.createElement('div');
                passGroup.className = 'admin-crud-form-group';
                passGroup.innerHTML = `<label for="crud_form_password">Password:</label><input type="password" class="form-control bg-secondary text-white border-0" id="crud_form_password" name="password" required>`;
                formFieldsDiv.appendChild(passGroup);
            }
        }

        function renderCrudForm(container, fieldsConfig, itemData) {
            for (const key in fieldsConfig) {
                const field = fieldsConfig[key];
                const labelText = field[`label_${currentLanguage}`] || field.label_en || key;
                let inputHtml = '';
                const commonAttrs = `class="form-control bg-secondary text-white border-0" id="${key}" name="${key}" ${field.required ? 'required' : ''} ${field.readonly ? 'readonly' : ''}`;
                if (field.type === 'textarea') {
                    inputHtml = `<textarea ${commonAttrs}>${itemData[key] || ''}</textarea>`;
                } else if (field.type === 'json_array') {
                    const value = Array.isArray(itemData[key]) ? itemData[key].join(', ') : (itemData[key] || '');
                    inputHtml = `<input type="text" ${commonAttrs} value="${value}">`;
                } else if (field.type === 'password_reset') {
                    inputHtml = `
                        <input type="password" ${commonAttrs.replace('required', '')} placeholder="${translations[currentLanguage]["نئے پاس ورڈ کی تصدیق کریں"]}" id="${key}_new">
                        <input type="password" class="form-control bg-secondary text-white border-0 mt-2" placeholder="${translations[currentLanguage]["نئے پاس ورڈ کی تصدیق کریں"]}" id="${key}_confirm">
                    `;
                } else {
                    inputHtml = `<input type="${field.type}" ${commonAttrs} value="${itemData[key] || ''}" ${field.min ? `min="${field.min}"` : ''}>`;
                }
                const formGroup = document.createElement('div');
                formGroup.className = 'admin-crud-form-group';
                formGroup.innerHTML = `<label for="${key}">${labelText}:</label>${inputHtml}`;
                container.appendChild(formGroup);
            }
        }
        document.getElementById('adminCrudForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const tableName = document.getElementById('crudTableName').value;
            const id = document.getElementById('crudItemId').value;
            const action = id ? 'update' : 'create';
            const formData = {};
            const inputs = document.querySelectorAll('#adminCrudForm input, #adminCrudForm textarea, #adminCrudForm select');
            inputs.forEach(input => {
                if (input.name && input.name !== 'crudTableName' && input.name !== 'crudItemId') {
                    if (input.type === 'checkbox') {
                        formData[input.name] = input.checked;
                    } else if (input.type === 'number') {
                        formData[input.name] = parseFloat(input.value) || 0;
                    } else if (input.type === 'text' && input.name.endsWith('_json')) {
                        try {
                            formData[input.name.replace('_json', '')] = JSON.parse(input.value);
                        } catch (e) {
                            console.error('Error parsing JSON:', e);
                            formData[input.name.replace('_json', '')] = input.value;
                        }
                    } else {
                        formData[input.name] = input.value;
                    }
                }
            });
            const requestData = {
                action: action,
                table: tableName,
                fields: formData
            };
            if (action === 'update') {
                requestData.id = id;
            }
            fetch('?api=crud', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(requestData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(action === 'create' ? 'Record created successfully' : 'Record updated successfully');
                        document.getElementById('adminCrudModal').querySelector('.btn-close').click();
                        loadAdminCrudTable();
                    } else {
                        alert('Error: ' + (data.message || 'Operation failed'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error performing operation');
                });
        });
        async function deleteAdminCrudItem(table, id) {
            if (!confirm(translations[currentLanguage]["کیا آپ واقعی اس ریکارڈ کو حذف کرنا چاہتے ہیں؟"])) {
                return;
            }
            const response = await fetch(`?api=crud`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'delete',
                    table: table,
                    id: id
                }),
            });
            const result = await response.json();
            if (result.success) {
                alert(result.message);
                loadAdminCrudTable();
                fetchInitialData();
            } else {
                alert('Error deleting record: ' + result.message);
            }
        }

        function displayCrudMessage(element, message, success) {
            element.textContent = message;
            element.classList.remove('alert-success', 'alert-danger');
            element.classList.add(success ? 'alert-success' : 'alert-danger');
            element.style.display = 'block';
        }
        async function renderUserDashboard() {
            await fetchUserData();
            const favList = document.getElementById('userFavoritesList');
            favList.innerHTML = '';
            if (userFavorites.length === 0) {
                favList.innerHTML = `<li>${translations[currentLanguage]["کوئی پسندیدہ آئٹم نہیں"]}</li>`;
            } else {
                userFavorites.forEach(fav => {
                    const listItem = document.createElement('li');
                    let itemText = '';
                    switch (fav.item_type) {
                        case 'hadith':
                            const hadith = allHadiths.find(h => h.id === parseInt(fav.item_id));
                            itemText = hadith ? (currentLanguage === 'ur' ? hadith.hadith_ur.substring(0, 50) + '...' : hadith.hadith_en.substring(0, 50) + '...') : 'Hadith Not Found';
                            break;
                        case 'quran_verse':
                            const quranVerse = allQuranVerses.find(v => v.id === parseInt(fav.item_id));
                            itemText = quranVerse ? (currentLanguage === 'ur' ? `سورہ: ${quranVerse.surah_number}, آیت: ${quranVerse.verse_number}` : `Surah: ${quranVerse.surah_number}, Verse: ${quranVerse.verse_number}`) : 'Verse Not Found';
                            break;
                        case 'dua':
                            const dua = allDailyDuas.find(d => d.id === parseInt(fav.item_id));
                            itemText = dua ? (currentLanguage === 'ur' ? dua.dua_title_ur : dua.dua_title_en) : 'Dua Not Found';
                            break;
                        case 'asma_ul_husna':
                            const asma = allAsmaUlHusna.find(a => a.id === parseInt(fav.item_id));
                            itemText = asma ? `${asma.arabic_name} (${asma.transliteration})` : 'Name Not Found';
                            break;
                        case 'prophet_name':
                            const prophetName = allProphetNames.find(p => p.id === parseInt(fav.item_id));
                            itemText = prophetName ? `${prophetName.arabic_name} (${prophetName.transliteration})` : 'Name Not Found';
                            break;
                        case 'seerah_event':
                            const seerahEvent = allSeerahEvents.find(s => s.id === parseInt(fav.item_id));
                            itemText = seerahEvent ? (currentLanguage === 'ur' ? seerahEvent.title_ur : seerahEvent.title_en) : 'Event Not Found';
                            break;
                        default:
                            itemText = 'Unknown Item';
                    }
                    listItem.innerHTML = `<span>${itemText}</span> <button class="btn btn-danger btn-sm" onclick="removeFavorite('${fav.item_type}', ${fav.item_id})">${translations[currentLanguage]["حذف کریں"]}</button>`;
                    favList.appendChild(listItem);
                });
            }
            const zikrList = document.getElementById('userZikrList');
            zikrList.innerHTML = '';
            if (userDailyZikr.length === 0) {
                zikrList.innerHTML = `<li>${translations[currentLanguage]["کوئی ذاتی ذکر/دعا شامل نہیں کی گئی۔"]}</li>`;
            } else {
                userDailyZikr.forEach(zikr => {
                    const listItem = document.createElement('li');
                    listItem.innerHTML = `<span>${currentLanguage === 'ur' ? zikr.zikr_text_urdu : zikr.zikr_text_english} (Target: ${zikr.daily_target})</span> <button class="btn btn-danger btn-sm" onclick="removeUserZikr(${zikr.id})">${translations[currentLanguage]["حذف کریں"]}</button>`;
                    zikrList.appendChild(listItem);
                });
            }
            const prayerLocationsList = document.getElementById('userPrayerLocationsList');
            prayerLocationsList.innerHTML = '';
            if (userPrayerLocations.length === 0) {
                prayerLocationsList.innerHTML = `<li>${translations[currentLanguage]["کوئی محفوظ کردہ جگہ نہیں۔"]}</li>`;
            } else {
                userPrayerLocations.forEach(loc => {
                    const listItem = document.createElement('li');
                    listItem.innerHTML = `<span>${loc.location_name} (Lat: ${loc.latitude.toFixed(2)}, Lon: ${loc.longitude.toFixed(2)})</span> <button class="btn btn-danger btn-sm" onclick="removeUserPrayerLocation(${loc.id})">${translations[currentLanguage]["حذف کریں"]}</button>`;
                    prayerLocationsList.appendChild(listItem);
                });
            }
        }
        document.getElementById('addZikrForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const zikrArabic = document.getElementById('zikrArabic').value;
            const zikrEnglish = document.getElementById('zikrEnglish').value;
            const zikrUrdu = document.getElementById('zikrUrdu').value;
            const zikrTarget = parseInt(document.getElementById('zikrTarget').value);
            const response = await fetch('?api=add_user_zikr', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    zikr_text_arabic: zikrArabic,
                    zikr_text_english: zikrEnglish,
                    zikr_text_urdu: zikrUrdu,
                    daily_target: zikrTarget
                }),
            });
            const result = await response.json();
            displayCrudMessage(document.getElementById('addZikrMessage'), result.message, result.success);
            if (result.success) {
                document.getElementById('addZikrForm').reset();
                setTimeout(() => {
                    const addZikrModal = bootstrap.Modal.getInstance(document.getElementById('addZikrModal'));
                    addZikrModal.hide();
                    renderUserDashboard();
                }, 1000);
            }
        });
        async function removeUserZikr(zikrId) {
            if (!confirm(translations[currentLanguage]["کیا آپ واقعی اس ذکر/دعا کو حذف کرنا چاہتے ہیں؟"])) {
                return;
            }
            const response = await fetch('?api=delete_user_zikr', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    zikr_id: zikrId
                }),
            });
            const result = await response.json();
            if (result.success) {
                alert(result.message);
                renderUserDashboard();
            } else {
                alert(`Error: ${result.message}`);
            }
        }
        document.getElementById('addLocationForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const locationName = document.getElementById('locationName').value;
            const latitude = parseFloat(document.getElementById('locationLatitude').value);
            const longitude = parseFloat(document.getElementById('locationLongitude').value);
            const calculationMethod = document.getElementById('locationCalculationMethod').value;
            const response = await fetch('?api=add_user_prayer_location', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    location_name: locationName,
                    latitude: latitude,
                    longitude: longitude,
                    calculation_method: calculationMethod
                }),
            });
            const result = await response.json();
            displayCrudMessage(document.getElementById('addLocationMessage'), result.message, result.success);
            if (result.success) {
                document.getElementById('addLocationForm').reset();
                setTimeout(() => {
                    const addLocationModal = bootstrap.Modal.getInstance(document.getElementById('addLocationModal'));
                    addLocationModal.hide();
                    renderUserDashboard();
                }, 1000);
            }
        });
        async function removeUserPrayerLocation(locationId) {
            if (!confirm(translations[currentLanguage]["کیا آپ واقعی اس مقام کو حذف کرنا چاہتے ہیں؟"])) {
                return;
            }
            const response = await fetch('?api=delete_user_prayer_location', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    location_id: locationId
                }),
            });
            const result = await response.json();
            if (result.success) {
                alert(result.message);
                renderUserDashboard();
            } else {
                alert(`Error: ${result.message}`);
            }
        }
        document.addEventListener('DOMContentLoaded', async () => {
            loadData();
            document.getElementById('dateSettingsForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const birthDateInput = document.getElementById('birthDateInput').value;
                const deathDateInput = document.getElementById('deathDateInput').value;
                if (birthDateInput) {
                    prophetMuhammadBirthDateGregorian = new Date(birthDateInput + 'T00:00:00Z');
                }
                if (deathDateInput) {
                    prophetMuhammadDeathDateGregorian = new Date(deathDateInput + 'T00:00:00Z');
                }
                saveData();
                updateCountdown();
                const modal = bootstrap.Modal.getInstance(document.getElementById('settingsModal'));
                modal.hide();
            });
            await fetchInitialData();
            setInterval(updateCountdown, 1000);
            const prayerTimesSection = document.getElementById('prayerTimesSection');
            if (prayerTimesSection) {
                const savedLat = localStorage.getItem('userLatitude');
                const savedLon = localStorage.getItem('userLongitude');
                const savedCalcMethod = localStorage.getItem('prayerCalculationMethod');
                if (savedLat && savedLon && savedCalcMethod) {
                    document.getElementById('calculationMethod').value = savedCalcMethod;
                    userLocation = {
                        latitude: parseFloat(savedLat),
                        longitude: parseFloat(savedLon)
                    };
                    getPrayerTimes();
                } else {
                    getPrayerTimes();
                }
            }
            initializeQiblaMap();
            if (userLocation) {
                updateQiblaDirection(userLocation);
            } else {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            updateQiblaDirection({
                                latitude: position.coords.latitude,
                                longitude: position.coords.longitude
                            });
                        },
                        (error) => {
                            console.warn("Geolocation for Qibla failed:", error);
                            document.getElementById('qiblaInfo').textContent = translations[currentLanguage]["مقام کی اجازت درکار ہے۔"];
                        }
                    );
                }
            }
            const urlParams = new URLSearchParams(window.location.search);
            const page = urlParams.get('page');
            if (page === 'admin_dashboard' && <?php echo json_encode(isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin'); ?>) {
                loadAdminCrudTable();
                document.getElementById('adminCrudTableSelect').addEventListener('change', loadAdminCrudTable);
            } else if (page === 'user_dashboard' && <?php echo json_encode(isset($_SESSION['user_id']) && $_SESSION['role'] === 'user'); ?>) {
                renderUserDashboard();
            }
        });
        document.querySelectorAll('*').forEach(el => el.setAttribute('dir', 'auto'));
    </script>
    <script type="module">
        import {
            Workbox
        } from 'https://storage.googleapis.com/workbox-cdn/releases/7.0.0/workbox-window.prod.mjs';
        const swUrl = './sw.js';
        const wb = new Workbox(swUrl);
        wb.addEventListener('waiting', () => {
            console.log('A new service worker is waiting to activate.');
            wb.messageSW({
                type: 'SKIP_WAITING'
            });
        });
        wb.addEventListener('controlling', () => {
            console.log('The new service worker is now in control. Reloading page for updates...');
            window.location.reload();
        });
        wb.register();
    </script>
</body>

</html>