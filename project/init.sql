CREATE TABLE `users` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(48) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created` DATETIME DEFAULT NOW(),  
  PRIMARY KEY (`id`),
  CONSTRAINT uc_users_email UNIQUE (`email`)
) ENGINE=InnoDB;


CREATE TABLE `articles` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(64) NOT NULL,
  `body` TEXT NOT NULL,
  `created` DATETIME DEFAULT NOW(),  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


INSERT INTO `users` (`name`, `password`, `email`) VALUES
('admin', '$2y$12$AQ5eHaYZtYOZPDgFShojhOU.MQsqxItC1fv8td/.nsZB0OQca8YGG' ,'admin@admin.admin');
