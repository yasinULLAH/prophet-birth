-- Admin Table
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP,
    settings JSON
);

-- Prayer Locations Table (for users to save specific locations)
CREATE TABLE user_prayer_locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    location_name VARCHAR(255) NOT NULL,
    latitude DECIMAL(10, 8) NOT NULL,
    longitude DECIMAL(11, 8) NOT NULL,
    calculation_method VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- User Dua/Zikr Preferences
CREATE TABLE user_daily_zikr (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    zikr_text_arabic TEXT NOT NULL,
    zikr_text_english TEXT,
    zikr_text_urdu TEXT,
    daily_target INT DEFAULT 33,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- User Hadith/Quran Favorites
CREATE TABLE user_favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    item_type ENUM('hadith', 'quran_verse', 'dua', 'asma_ul_husna', 'prophet_name', 'seerah_event') NOT NULL,
    item_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Quran Audio Recitations Table
CREATE TABLE quran_recitations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    surah_number INT NOT NULL,
    verse_number INT NOT NULL,
    reciter_name VARCHAR(255) NOT NULL,
    audio_url VARCHAR(500) NOT NULL,
    UNIQUE (surah_number, verse_number, reciter_name)
);

-- Hadiths Table
CREATE TABLE hadiths (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hadith_ur TEXT NOT NULL,
    hadith_en TEXT NOT NULL,
    source_ur VARCHAR(255),
    source_en VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Quran Verses Table
CREATE TABLE quran_verses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    surah_number INT NOT NULL,
    verse_number INT NOT NULL,
    arabic_text TEXT NOT NULL,
    transliteration TEXT,
    translation_ur TEXT,
    translation_en TEXT,
    audio_url VARCHAR(500)
);

-- Daily Duas Table
CREATE TABLE daily_duas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dua_title_ur VARCHAR(255) NOT NULL,
    dua_title_en VARCHAR(255) NOT NULL,
    arabic_text TEXT NOT NULL,
    transliteration TEXT,
    translation_ur TEXT,
    translation_en TEXT
);

-- Quiz Questions Table
CREATE TABLE quiz_questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_ur TEXT NOT NULL,
    question_en TEXT NOT NULL,
    options_ur JSON NOT NULL,
    options_en JSON NOT NULL,
    correct_answer_index INT NOT NULL,
    explanation_ur TEXT,
    explanation_en TEXT
);

-- Seerah Events Table
CREATE TABLE seerah_events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title_ur VARCHAR(255) NOT NULL,
    title_en VARCHAR(255) NOT NULL,
    gregorian_date DATE,
    hijri_date VARCHAR(255),
    description_ur TEXT,
    description_en TEXT,
    source VARCHAR(255)
);

-- Asma Ul Husna Table
CREATE TABLE asma_ul_husna (
    id INT AUTO_INCREMENT PRIMARY KEY,
    arabic_name VARCHAR(255) NOT NULL,
    transliteration VARCHAR(255),
    meaning_ur VARCHAR(255),
    meaning_en VARCHAR(255)
);

-- Prophet Names Table
CREATE TABLE prophet_names (
    id INT AUTO_INCREMENT PRIMARY KEY,
    arabic_name VARCHAR(255) NOT NULL,
    transliteration VARCHAR(255),
    meaning_ur VARCHAR(255),
    meaning_en VARCHAR(255)
);

-- Islamic Calendar Events Table
CREATE TABLE islamic_calendar_events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hijri_day INT NOT NULL,
    hijri_month INT NOT NULL,
    event_title_ur VARCHAR(255) NOT NULL,
    event_title_en VARCHAR(255) NOT NULL,
    description_ur TEXT,
    description_en TEXT
);

/*
  Sample Data for Tables 
  (Please populate with real, diverse data)
*/

-- Sample Admins
INSERT INTO admins (username, password_hash, email) VALUES
('admin', '$2y$10$FicS8tSulaWAS1T6sshtzO0OKacp.0FH6BFxU5KpA.qroJx1YnlxW', 'yasin.admin@example.com'); -- password: adminpass

-- Sample Users
INSERT INTO users (username, password_hash, email, settings) VALUES
('ali_hussain', '$2y$10$fWnK6lC9tX4eZ7q2FmY4vO8Jg.L9vR1b0.R6oQ3J2fX5zG0V4I6S', 'ali.hussain@example.com', '{"theme": "dark", "language": "ur", "fontSize": 18}'),
('fatima_khan', '$2y$10$fWnK6lC9tX4eZ7q2FmY4vO8Jg.L9vR1b0.R6oQ3J2fX5zG0V4I6S', 'fatima.khan@example.com', '{"theme": "light", "language": "en", "fontSize": 16}'); -- password for both: userpass

-- Sample Hadiths
INSERT INTO hadiths (hadith_ur, hadith_en, source_ur, source_en) VALUES
('نبی اکرم صلی اللہ علیہ وسلم نے فرمایا: "اعمال کا دار و مدار نیتوں پر ہے، اور ہر شخص کو وہی ملے گا جو اس نے نیت کی ہو۔"', 'The Prophet Muhammad (PBUH) said: "Deeds are by intentions, and every person will have what he intended."', 'صحیح بخاری، کتاب بد ء الوحی', 'Sahih Bukhari, Book of Revelation'),
('رسول اللہ صلی اللہ علیہ وسلم نے فرمایا: "قیامت کے دن سب سے پہلے جس چیز کا حساب لیا جائے گا وہ نماز ہے۔"', 'The Messenger of Allah (PBUH) said: "The first thing for which a person will be brought to account on the Day of Resurrection will be his Salah (prayer)."', 'سنن الترمذی، کتاب الصلاۃ', 'Sunan At-Tirmidhi, Book of Prayer'),
('نبی اکرم صلی اللہ علیہ وسلم نے فرمایا: "جو شخص اللہ اور یوم آخرت پر ایمان رکھتا ہو، اسے چاہیے کہ اچھی بات کہے یا خاموش رہے۔"', 'The Prophet Muhammad (PBUH) said: "Whoever believes in Allah and the Last Day, let him speak good or remain silent."', 'صحیح مسلم، کتاب الإیمان', 'Sahih Muslim, Book of Faith'),
('رسول اللہ صلی اللہ علیہ وسلم نے فرمایا: "کسی عربی کو عجمی پر، اور نہ کسی عجمی کو عربی پر، نہ کسی سفید کو سیاہ پر، اور نہ کسی سیاہ کو سفید پر کوئی فضیلت حاصل ہے، مگر تقویٰ کے ذریعے۔"', 'The Messenger of Allah (PBUH) said: "There is no superiority for an Arab over a non-Arab, nor for a non-Arab over an Arab; nor for a white person over a black person, nor for a black person over a white person, except by taqwa (piety and righteousness)."', 'مسند احمد', 'Musnad Ahmad');

-- Sample Quran Verses
INSERT INTO quran_verses (surah_number, verse_number, arabic_text, transliteration, translation_ur, translation_en, audio_url) VALUES
(2, 255, 'اللَّهُ لَا إِلَٰهَ إِلَّا هُوَ الْحَيُّ الْقَيُّومُ ۚ لَا تَأْخُذُهُ سِنَةٌ وَلَا نَوْمٌ ۚ لَهُ مَا فِي السَّمَاوَاتِ وَمَا فِي الْأَرْضِ ۗ مَنْ ذَا الَّذِي يَشْفَعُ عِنْدَهُ إِلَّا بِإِذْنِهِ ۚ يَعْلَمُ مَا بَيْنَ أَيْدِيهِمْ وَمَا خَلْفَهُمْ ۖ وَلَا يُحِيطُونَ بِشَيْءٍ مِنْ عِلْمِهِ إِلَّا بِمَا شَاءَ ۚ وَسِعَ كُرْسِيُّهُ السَّمَاوَاتِ وَالْأَرْضَ ۖ وَلَا يَئُودُهُ حِفْظُهُمَا ۚ وَهُوَ الْعَلِيُّ الْعَظِيمُ', 'Allahu la ilaha illa Huwal-Haiyul-Qaiyum; la ta’khuzuhu sinatunw-wa la nawm; lahu ma fis-samawati wa ma fil-ard; man zal-lazee yashfa’u Indahuu illa bi-iznih; ya’lamu ma baina aideehim wa ma khalfahum; wa la yuheetoona bishai’im-min ‘ilmihee illa bima shaa’; wasi’a Kursiyuhus-samawati wal-ard; wa la ya’ooduhu hifzuhumaa; wa Huwal-Aliyul-Azeem', 'اللہ وہ ہے جس کے سوا کوئی معبود نہیں، وہ زندہ ہے، قائم رکھنے والا ہے۔ اسے نہ اونگھ آتی ہے نہ نیند۔ آسمانوں اور زمین میں جو کچھ ہے سب اسی کا ہے۔ کون ہے جو اس کی اجازت کے بغیر اس کے حضور سفارش کر سکے؟ وہ جانتا ہے جو ان کے سامنے ہے اور جو ان کے پیچھے ہے، اور وہ اس کے علم میں سے کسی چیز پر احاطہ نہیں کر سکتے مگر جتنا وہ چاہے۔ اس کی کرسی آسمانوں اور زمین پر وسیع ہے، اور اسے ان دونوں کی حفاظت تھکاتی نہیں، اور وہی سب سے بلند، سب سے عظیم ہے۔', 'Allah - there is no deity except Him, the Ever-Living, the Sustainer of existence. Neither drowsiness overtakes Him nor sleep. To Him belongs whatever is in the heavens and whatever is on the earth. Who is it that can intercede with Him except by His permission? He knows what is before them and what will be after them, and they encompass not a thing of His knowledge except for what He wills. His Kursi extends over the heavens and the earth, and their preservation tires Him not. And He is the Most High, the Most Great.', 'https://audio.quran.com/ar.alafasy/002255.mp3'),
(112, 1, 'قُلْ هُوَ اللَّهُ أَحَدٌ', 'Qul huwa Allahu Ahad', 'کہو وہ اللہ ایک ہے۔', 'Say, "He is Allah, [who is] One."', 'https://audio.quran.com/ar.alafasy/112001.mp3'),
(1, 1, 'بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ', 'Bismi Allahi ar-Rahmani ar-Raheem', 'شروع اللہ کے نام سے جو بڑا مہربان نہایت رحم والا ہے۔', 'In the name of Allah, the Entirely Merciful, the Especially Merciful.', 'https://audio.quran.com/ar.alafasy/001001.mp3'),
(99, 7, 'فَمَنْ يَعْمَلْ مِثْقَالَ ذَرَّةٍ خَيْرًا يَرَهُ', 'Faman ya’mal mithqala zarratin khayran yarah', 'پس جس نے ذرہ برابر بھی نیکی کی ہوگی وہ اسے دیکھ لے گا۔', 'So whoever does an atom\'s weight of good will see it,', 'https://audio.quran.com/ar.alafasy/099007.mp3');

-- Sample Daily Duas
INSERT INTO daily_duas (dua_title_ur, dua_title_en, arabic_text, transliteration, translation_ur, translation_en) VALUES
('صبح کی دعا', 'Morning Dua', 'اللّهُمَّ بِكَ أَصْبَحْنَا وَبِكَ أَمْسَيْنَا وَبِكَ نَحْيَا وَبِكَ نَمُوتُ وَإِلَيْكَ النُّشُورُ', 'Allahumma bika asbahna wa bika amsaina, wa bika nahya, wa bika namoot, wa ilaykan nushoor', 'اے اللہ! ہم نے تیری ہی توفیق سے صبح کی اور تیری ہی توفیق سے شام کی، اور تیری ہی توفیق سے ہم جیتے ہیں اور مرتے ہیں، اور تیری ہی طرف لوٹنا ہے۔', 'O Allah, by You we enter the morning and by You we enter the evening, by You we live and by You we die, and to You is the resurrection.'),
('شام کی دعا', 'Evening Dua', 'اللَّهُمَّ أَمْسَيْنَا وَأَمْسَى الْمُلْكُ لِلَّهِ وَالْحَمْدُ لِلَّهِ لاَ إِلَهَ إِلاَّ اللَّهُ وَحْدَهُ لاَ شَرِيكَ لَهُ، لَهُ الْمُلْكُ وَلَهُ الْحَمْدُ وَهُوَ عَلَى كُلِّ شَيْءٍ قَدِيرٌ', 'Allahumma amsaina wa amsal-mulku lillahi wal-hamdu lillahi, la ilaha illallah wahdahu la shareeka lah, lahul-mulku wa lahul-hamdu wa huwa ‘ala kulli shai’in qadeer', 'اے اللہ! ہم نے شام کی اور شام اللہ ہی کے لیے ہے، تمام تعریفیں اللہ ہی کے لیے ہیں، اللہ کے سوا کوئی معبود نہیں، وہ اکیلا ہے، اس کا کوئی شریک نہیں، اسی کی بادشاہی ہے اور اسی کے لیے تمام تعریفیں ہیں اور وہ ہر چیز پر قادر ہے۔', 'O Allah, we have entered the evening, and the dominion belongs to Allah, and all praise is due to Allah. There is no deity except Allah, alone, without any partners. To Him belongs the dominion, and to Him belongs all praise, and He is over all things competent.'),
('نکاح کی دعا', 'Dua for Marriage', 'بَارَكَ اللَّهُ لَكَ وَبَارَكَ عَلَيْكَ وَجَمَعَ بَيْنَكُمَا فِي خَيْرٍ', 'Barakallahu lakuma wa baraka alaikuma wa jama’a bainakuma fi khair', 'اللہ آپ دونوں کے لیے برکت فرمائے اور آپ دونوں پر برکت نازل فرمائے اور آپ دونوں کو بھلائی میں جمع کرے۔', 'May Allah bless you both, and may He bless upon you, and may He combine you both in goodness.'),
('مسجد میں داخل ہونے کی دعا', 'Dua upon entering the Mosque', 'اللَّهُمَّ افْتَحْ لِي أَبْوَابَ رَحْمَتِكَ', 'Allahumma iftah li abwaba rahmatik', 'اے اللہ، میرے لیے اپنی رحمت کے دروازے کھول دے۔', 'O Allah, open the gates of Your Mercy for me.');

-- Sample Quiz Questions
INSERT INTO quiz_questions (question_ur, question_en, options_ur, options_en, correct_answer_index, explanation_ur, explanation_en) VALUES
('نبی اکرم صلی اللہ علیہ وسلم کی ولادت کس شہر میں ہوئی؟', 'In which city was Prophet Muhammad (PBUH) born?', '["مدینہ", "مکہ", "طائف", "جدہ"]', '["Madinah", "Makkah", "Ta\'if", "Jeddah"]', 1, 'نبی اکرم صلی اللہ علیہ وسلم کی ولادت مکہ مکرمہ میں ہوئی۔', 'Prophet Muhammad (PBUH) was born in Makkah.'),
('قرآن مجید کی پہلی وحی کس سورہ سے شروع ہوئی؟', 'Which Surah did the first revelation of the Quran begin with?', '["سورہ الفاتحہ", "سورہ البقرہ", "سورہ العلق", "سورہ النور"]', '["Al-Fatiha", "Al-Baqarah", "Al-Alaq", "An-Nur"]', 2, 'قرآن مجید کی پہلی وحی سورہ العلق کی ابتدائی آیات سے ہوئی۔', 'The first revelation of the Quran began with the first verses of Surah Al-Alaq.'),
('جنگ بدر کب ہوئی؟', 'When did the Battle of Badr take place?', '["2 ہجری", "5 ہجری", "8 ہجری", "10 ہجری"]', '["2 AH", "5 AH", "8 AH", "10 AH"]', 0, 'جنگ بدر 2 ہجری میں ہوئی، جو اسلام کی پہلی بڑی جنگ تھی۔', 'The Battle of Badr took place in 2 AH, which was the first major battle in Islam.'),
('اسلام کا دوسرا رکن کیا ہے؟', 'What is the second pillar of Islam?', '["شہادت", "نماز", "زکوٰۃ", "روزہ"]', '["Shahada (Testimony)", "Salat (Prayer)", "Zakat (Charity)", "Sawm (Fasting)"]', 1, 'اسلام کا دوسرا رکن نماز ہے جو دن میں پانچ بار فرض ہے۔', 'The second pillar of Islam is Salat (prayer), which is obligatory five times a day.');

-- Sample Seerah Events
INSERT INTO seerah_events (title_ur, title_en, gregorian_date, hijri_date, description_ur, description_en, source) VALUES
('عام الفیل (فیل کا سال) - ولادت نبی اکرم صلی اللہ علیہ وسلم', 'Year of the Elephant - Birth of Prophet Muhammad (PBUH)', '0570-04-20', '12 Rabi al-Awwal, 53 BH', 'اسی سال ابرہہ نے کعبہ کو گرانے کی کوشش کی، اور نبی اکرم صلی اللہ علیہ وسلم کی ولادت ہوئی۔', 'In this year, Abraha attempted to destroy the Kaaba, and Prophet Muhammad (PBUH) was born.', 'Ibn Hisham'),
('بعثت نبوی', 'Prophethood Begins', '0610-08-01', '17 Ramadan, 13 BH', 'غار حرا میں پہلی وحی (سورہ العلق کی ابتدائی آیات) نازل ہوئی۔', 'The first revelation (initial verses of Surah Al-Alaq) was revealed in Cave Hira.', 'Ibn Hisham'),
('ہجرت مدینہ', 'Migration to Madinah (Hijra)', '0622-09-24', '1 Rabi al-Awwal, 1 AH', 'نبی اکرم صلی اللہ علیہ وسلم اور صحابہ کرام مکہ سے مدینہ ہجرت کر گئے۔', 'Prophet Muhammad (PBUH) and his companions migrated from Makkah to Madinah.', 'Ibn Hisham'),
('غزوہ بدر', 'Battle of Badr', '0624-03-13', '17 Ramadan, 2 AH', 'مسلمانوں اور کفار مکہ کے درمیان پہلی بڑی جنگ، جس میں مسلمانوں کو فتح حاصل ہوئی۔', 'The first major battle between Muslims and the Quraish of Makkah, resulting in a Muslim victory.', 'Ibn Hisham');

-- Sample Asma Ul Husna
INSERT INTO asma_ul_husna (arabic_name, transliteration, meaning_ur, meaning_en) VALUES
('الرحمن', 'Ar-Rahman', 'بہت مہربان', 'The Most Merciful'),
('الرحيم', 'Ar-Rahim', 'نہایت رحم والا', 'The Especially Merciful'),
('الملك', 'Al-Malik', 'بادشاہ', 'The King, The Sovereign'),
('القدوس', 'Al-Quddus', 'نہایت پاک', 'The Most Holy'),
('السلام', 'As-Salam', 'سلامتی والا', 'The Giver of Peace');

-- Sample Prophet Names
INSERT INTO prophet_names (arabic_name, transliteration, meaning_ur, meaning_en) VALUES
('محمد', 'Muhammad', 'جس کی بہت تعریف کی جائے', 'The Praised One'),
('احمد', 'Ahmad', 'بہت تعریف کرنے والا', 'The Most Praiseworthy'),
('طٰہٰ', 'Taha', 'قرآن میں ایک حروفِ مقطعات، جس کے معنی اللہ ہی بہتر جانتا ہے', 'A combination of letters, its meaning is known best by Allah'),
('یس', 'Yasin', 'قرآن میں ایک حروفِ مقطعات، جس کے معنی اللہ ہی بہتر جانتا ہے', 'A combination of letters, its meaning is known best by Allah'),
('مصطفٰی', 'Mustafa', 'چنا ہوا', 'The Chosen One');

-- Sample Islamic Calendar Events
INSERT INTO islamic_calendar_events (hijri_day, hijri_month, event_title_ur, event_title_en, description_ur, description_en) VALUES
(1, 1, 'نئے ہجری سال کا آغاز', 'New Hijri Year Begins', 'محرم اسلامی سال کا پہلا مہینہ ہے۔', 'Muharram is the first month of the Islamic calendar.'),
(10, 1, 'یومِ عاشورہ', 'Day of Ashura', 'اس دن روزہ رکھا جاتا ہے، اور یہ حضرت موسیٰ علیہ السلام کی فرعون سے نجات کا دن ہے۔', 'Fasting on this day is recommended. It commemorates the salvation of Prophet Musa (AS) from Pharaoh.'),
(12, 3, 'میلاد النبی', 'Mawlid al-Nabi (Birth of Prophet Muhammad PBUH)', 'نبی اکرم صلی اللہ علیہ وسلم کی ولادت کا دن۔', 'The birthday of Prophet Muhammad (PBUH).'),
(27, 7, 'شبِ معراج', 'Laylat al-Miraj (Night Journey and Ascension)', 'نبی اکرم صلی اللہ علیہ وسلم کا مسجد حرام سے مسجد اقصیٰ اور پھر آسمانوں کی طرف سفر۔', 'The Prophet Muhammad\'s (PBUH) night journey from Masjid al-Haram to Masjid al-Aqsa and his ascension to the heavens.'),
(1, 10, 'عید الفطر', 'Eid al-Fitr', 'رمضان کے روزے مکمل ہونے پر منائی جاتی ہے۔', 'Celebrated at the end of Ramadan.'),
(10, 12, 'عید الاضحیٰ', 'Eid al-Adha', 'حج کے اختتام پر منائی جاتی ہے اور قربانی کا دن ہے۔', 'Celebrated at the end of Hajj, the day of sacrifice.');

-- Add some Quran Recitations
INSERT INTO quran_recitations (surah_number, verse_number, reciter_name, audio_url) VALUES
(1, 1, 'Mishary Alafasy', 'https://audio.quran.com/ar.alafasy/001001.mp3'),
(1, 2, 'Mishary Alafasy', 'https://audio.quran.com/ar.alafasy/001002.mp3'),
(2, 1, 'Mishary Alafasy', 'https://audio.quran.com/ar.alafasy/002001.mp3'),
(2, 2, 'Mishary Alafasy', 'https://audio.quran.com/ar.alafasy/002002.mp3');