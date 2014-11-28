CREATE TABLE IF NOT EXISTS `#__kargah_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `toz` mediumtext COLLATE utf8_persian_ci NOT NULL,
  `pic` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `tarikh` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `en` int(1) NOT NULL COMMENT 'یک یعنی قابل رزرو و صفر یعنی پیشنهادی',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB COLLATE=utf8_persian_ci;

CREATE TABLE IF NOT EXISTS `#__kargah_reserve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarikh` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fname` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `lname` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `mob` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `tell` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `address` mediumtext COLLATE utf8_persian_ci NOT NULL,
  `pardakht` int(11) NOT NULL DEFAULT '-1' COMMENT 'منفی یک یعنی رزرو موقت ، صفر یعنی رزرو قطعی ناموفق و ی هر عددی بزرگتر از صفر یعنی رزرو قطعی موفق',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB COLLATE=utf8_persian_ci;

