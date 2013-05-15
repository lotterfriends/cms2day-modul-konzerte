CREATE TABLE `modul_konzerte` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `datum` date NOT NULL,
  `titel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `titel_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fotos_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ort` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lokalitaet` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zusatzinfo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC AUTO_INCREMENT=44 ;