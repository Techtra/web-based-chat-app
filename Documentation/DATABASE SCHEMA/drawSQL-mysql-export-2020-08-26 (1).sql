CREATE TABLE `User`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_type_id` INT NOT NULL,
    `username` TEXT NOT NULL,
    `status_id` INT NOT NULL,
    `email` TEXT NOT NULL,
    `created_at` DATETIME NOT NULL,
    `update_at` DATETIME NOT NULL
);
ALTER TABLE
    `User` ADD INDEX `user_user_type_id_index`(`user_type_id`);
ALTER TABLE
    `User` ADD INDEX `user_status_id_index`(`status_id`);
ALTER TABLE
    `User` ADD PRIMARY KEY `user_id_primary`(`id`);
CREATE TABLE `User Type`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `Name` TEXT NOT NULL,
    `created_at` DATETIME NULL,
    `updated_at` DATETIME NOT NULL
);
ALTER TABLE
    `User Type` ADD PRIMARY KEY `user type_id_primary`(`id`);
CREATE TABLE `User Group`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `group_id` INT NULL,
    `created_at` DATETIME NULL,
    `updated_at` DATETIME NULL
);
ALTER TABLE
    `User Group` ADD PRIMARY KEY `user group_id_primary`(`id`);
ALTER TABLE
    `User Group` ADD INDEX `user group_user_id_index`(`user_id`);
ALTER TABLE
    `User Group` ADD INDEX `user group_group_id_index`(`group_id`);
CREATE TABLE `Group`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` INT NOT NULL,
    `created_at` DATETIME NULL
);
ALTER TABLE
    `Group` ADD PRIMARY KEY `group_id_primary`(`id`);
CREATE TABLE `Message`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `creator_id` INT NOT NULL,
    `message_body` LONGTEXT NOT NULL,
    `parent_message_id` INT NOT NULL,
    `created_at` DATETIME NOT NULL
);
ALTER TABLE
    `Message` ADD PRIMARY KEY `message_id_primary`(`id`);
ALTER TABLE
    `Message` ADD INDEX `message_creator_id_index`(`creator_id`);
ALTER TABLE
    `Message` ADD INDEX `message_parent_message_id_index`(`parent_message_id`);
CREATE TABLE `Message Recipient`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `recipient_id` INT NOT NULL,
    `recipient_group_id` INT NOT NULL,
    `message_id` INT NOT NULL,
    `is_read` TINYINT(1) NOT NULL
);
ALTER TABLE
    `Message Recipient` ADD PRIMARY KEY `message recipient_id_primary`(`id`);
ALTER TABLE
    `Message Recipient` ADD INDEX `message recipient_recipient_id_index`(`recipient_id`);
ALTER TABLE
    `Message Recipient` ADD INDEX `message recipient_recipient_group_id_index`(`recipient_group_id`);
ALTER TABLE
    `Message Recipient` ADD INDEX `message recipient_message_id_index`(`message_id`);
CREATE TABLE `Pins`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `pinned-id` INT NOT NULL
);
ALTER TABLE
    `Pins` ADD PRIMARY KEY `pins_id_primary`(`id`);
ALTER TABLE
    `Pins` ADD INDEX `pins_user_id_index`(`user_id`);
ALTER TABLE
    `Pins` ADD INDEX `pins_pinned_id_index`(`pinned-id`);
CREATE TABLE `Status`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `status_body` TEXT NOT NULL,
    `created_at` DATETIME NOT NULL
);
ALTER TABLE
    `Status` ADD PRIMARY KEY `status_id_primary`(`id`);
CREATE TABLE `Task`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `task_title` TEXT NULL,
    `task_body` MULTILINESTRING NOT NULL,
    `created_by_id` INT NOT NULL,
    `due_date` DATETIME NOT NULL,
    `created_at` DATETIME NOT NULL
);
ALTER TABLE
    `Task` ADD PRIMARY KEY `task_id_primary`(`id`);
ALTER TABLE
    `Task` ADD INDEX `task_created_by_id_index`(`created_by_id`);
CREATE TABLE `Task Owners`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `task_id` INT NOT NULL,
    `owner_id` INT NOT NULL
);
ALTER TABLE
    `Task Owners` ADD PRIMARY KEY `task owners_id_primary`(`id`);
ALTER TABLE
    `Task Owners` ADD INDEX `task owners_task_id_index`(`task_id`);
ALTER TABLE
    `Task Owners` ADD INDEX `task owners_owner_id_index`(`owner_id`);
CREATE TABLE `Pinned users`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `created_by_id` INT NOT NULL
);
ALTER TABLE
    `Pinned users` ADD PRIMARY KEY `pinned users_id_primary`(`id`);
ALTER TABLE
    `User Group` ADD CONSTRAINT `user group_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `User`(`id`);
ALTER TABLE
    `Message` ADD CONSTRAINT `message_creator_id_foreign` FOREIGN KEY(`creator_id`) REFERENCES `User`(`id`);
ALTER TABLE
    `Message Recipient` ADD CONSTRAINT `message recipient_recipient_id_foreign` FOREIGN KEY(`recipient_id`) REFERENCES `User`(`id`);
ALTER TABLE
    `Task` ADD CONSTRAINT `task_created_by_id_foreign` FOREIGN KEY(`created_by_id`) REFERENCES `User`(`id`);
ALTER TABLE
    `Pinned users` ADD CONSTRAINT `pinned users_created_by_id_foreign` FOREIGN KEY(`created_by_id`) REFERENCES `User`(`id`);
ALTER TABLE
    `User` ADD CONSTRAINT `user_user_type_id_foreign` FOREIGN KEY(`user_type_id`) REFERENCES `User Type`(`id`);
ALTER TABLE
    `User Group` ADD CONSTRAINT `user group_group_id_foreign` FOREIGN KEY(`group_id`) REFERENCES `Group`(`id`);
ALTER TABLE
    `Message Recipient` ADD CONSTRAINT `message recipient_message_id_foreign` FOREIGN KEY(`message_id`) REFERENCES `Message`(`id`);
ALTER TABLE
    `Pins` ADD CONSTRAINT `pins_pinned_id_foreign` FOREIGN KEY(`pinned-id`) REFERENCES `Pinned users`(`id`);
ALTER TABLE
    `User` ADD CONSTRAINT `user_status_id_foreign` FOREIGN KEY(`status_id`) REFERENCES `Status`(`id`);
ALTER TABLE
    `Task Owners` ADD CONSTRAINT `task owners_task_id_foreign` FOREIGN KEY(`task_id`) REFERENCES `Task`(`id`);
ALTER TABLE
    `Task Owners` ADD CONSTRAINT `task owners_owner_id_foreign` FOREIGN KEY(`owner_id`) REFERENCES `User`(`id`);