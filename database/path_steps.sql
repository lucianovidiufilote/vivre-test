CREATE TABLE `path_steps` (
                             `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                             `path_id` int(11) unsigned NOT NULL,
                             `step` varchar(10) enum('up','down', 'left', 'right') NOT NULL,
                             PRIMARY KEY (`id`),
                             CONSTRAINT `path_id_fk_1` FOREIGN KEY (`path_id`) REFERENCES `paths` (`id`),
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;