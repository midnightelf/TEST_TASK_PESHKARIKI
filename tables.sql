# tasks
create table `tasks` (
     `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
     `username` VARCHAR(128) NOT NULL,
     `email` VARCHAR(128),
     `text` TEXT NOT NULL,
     `status` TINYINT(1) DEFAULT 1
);

# users
create table `users`
(
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(128),
    `password` VARCHAR(64)
);