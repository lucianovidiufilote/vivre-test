CREATE TABLE `labyrinth_cells` (
                             `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                             `labyrinth_id` int(11) unsigned NOT NULL,
                             `x` int(11) NOT NULL,
                             `y` int(11) NOT NULL,
                             `value` varchar(1) default '0',
                             PRIMARY KEY (`id`),
                             CONSTRAINT `labyrinth_cells_fk_1` FOREIGN KEY (`labyrinth_id`) REFERENCES `labyrinths` (`id`),
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;