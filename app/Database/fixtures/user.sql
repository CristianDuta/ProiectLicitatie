INSERT INTO `user`(`first_name`, `last_name`, `email`, `password`) VALUES
 ('Andreea', 'Barbu', 'andreea_barbu0708@yahoo.com', ''),
 ('Cristian', 'Duta', 'duta.cristian@info.uvt.ro', '');


 ALTER TABLE `user` ADD `roles` VARCHAR(255) NOT NULL AFTER `last_name`;