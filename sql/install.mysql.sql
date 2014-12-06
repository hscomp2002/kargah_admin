CREATE TABLE IF NOT EXISTS `#__kargah_data` (
`id` int(11) NOT NULL COMMENT 'hidden',
  `name` varchar(200) COLLATE utf8_persian_ci NOT NULL COMMENT 'نام گروه',
  `toz` mediumtext COLLATE utf8_persian_ci NOT NULL COMMENT 'توضیحات',
  `pic` varchar(100) COLLATE utf8_persian_ci NOT NULL COMMENT 'تصویر',
  `tarikh` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'تاریخ برگزاری',
  `en` int(1) NOT NULL COMMENT 'یک یعنی قابل رزرو و صفر یعنی غیر فعال و منفی یک یعنی پیشنهادی',
  `ghimat` int(11) NOT NULL DEFAULT '0',
  `pishnehad` varchar(200) COLLATE utf8_persian_ci NOT NULL COMMENT 'پیشنهاد دهنده'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
ALTER TABLE `#__kargah_data`
 ADD PRIMARY KEY (`id`);
ALTER TABLE `#__kargah_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'hidden',AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__kargah_reserve` (
`id` int(11) NOT NULL COMMENT 'hidden',
  `tarikh` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'تاریخ',
  `fname` varchar(100) COLLATE utf8_persian_ci NOT NULL COMMENT 'نام',
  `lname` varchar(200) COLLATE utf8_persian_ci NOT NULL COMMENT 'نام خانوادگی',
  `mob` varchar(20) COLLATE utf8_persian_ci NOT NULL COMMENT 'موبایل',
  `tell` varchar(20) COLLATE utf8_persian_ci NOT NULL COMMENT 'تلفن ثابت',
  `address` mediumtext COLLATE utf8_persian_ci NOT NULL COMMENT 'پست الکترونیک',
  `pardakht` varchar(2000) COLLATE utf8_persian_ci NOT NULL DEFAULT '-1' COMMENT 'منفی یک یعنی رزرو موقت ، صفر یعنی رزرو قطعی ناموفق و ی هر عددی بزرگتر از صفر یعنی رزرو قطعی موفق',
  `kargah_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

ALTER TABLE `#__kargah_reserve`
 ADD PRIMARY KEY (`id`);
ALTER TABLE `#__kargah_reserve`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'hidden',AUTO_INCREMENT=16;
