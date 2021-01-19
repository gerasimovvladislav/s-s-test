# Задача №1

Имеется база со следующими таблицами:
```
CREATE TABLE `users` (
    `id`            INT(11) NOT NULL AUTO_INCREMENT,
    `name`          VARCHAR(255) DEFAULT NULL,
    `gender`        INT(11) NOT NULL COMMENT '0 – не указан, 1 - мужчина, 2 - женщина.',
    `birth_date`    INT(11) NOT NULL COMMENT 'Дата в unixtime.',
    PRIMARY KEY (`id`)
);
CREATE TABLE `phone_numbers` (
    `id`        INT(11) NOT NULL AUTO_INCREMENT,
    `user_id`   INT(11) NOT NULL,
    `phone`     VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (`id`)
);
```
Оптимизируйте структуру таблиц и напишите запрос, возвращающий имена и количества телефонных номеров девушек в возрасте от 18 до 22 лет.

**Решение:**
```
CREATE TABLE `users` (
    `id`            INT(11) NOT NULL AUTO_INCREMENT,
    `name`          VARCHAR(255) DEFAULT NULL,
    `gender`        TINYINT(11) DEFAULT 0 COMMENT '0 – не указан, 1 - мужчина, 2 - женщина.',
    `birth_date`    INT(11) NOT NULL COMMENT 'Дата в unixtime.',
    PRIMARY KEY (`id`)
);
CREATE TABLE `phone_numbers` (
    `id`        INT(11) NOT NULL AUTO_INCREMENT,
    `user_id`   INT(11) NOT NULL,
    `phone`     VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (`id`),
    INDEX (`user_id`),
    FOREIGN KEY (`user_id`) REFERENCES users(`id`)
);

INSERT INTO `users` SET `id`=11, `name` = "test_name_1", `gender` = 1, `birth_date` = UNIX_TIMESTAMP('1994-08-01');
INSERT INTO `users` SET `id`=12, `name` = "test_name_2", `gender` = 0, `birth_date` = UNIX_TIMESTAMP('1994-04-23');
INSERT INTO `users` SET `id`=13, `name` = "test_name_3", `gender` = 2, `birth_date` = UNIX_TIMESTAMP('1991-02-11');
INSERT INTO `users` SET `id`=14, `name` = "test_name_4", `gender` = 2, `birth_date` = UNIX_TIMESTAMP('2002-08-01');
INSERT INTO `users` SET `id`=15, `name` = "test_name_5", `gender` = 1, `birth_date` = UNIX_TIMESTAMP('2000-09-08');
INSERT INTO `users` SET `id`=16, `name` = "test_name_6", `gender` = 2, `birth_date` = UNIX_TIMESTAMP('2000-08-19');

INSERT INTO `phone_numbers` SET `user_id`=12,`phone`='+7-999-666-13-12';
INSERT INTO `phone_numbers` SET `user_id`=13,`phone`='+7-999-666-13-13';
INSERT INTO `phone_numbers` SET `user_id`=13,`phone`='+7-999-666-00-13';
INSERT INTO `phone_numbers` SET `user_id`=14,`phone`='+7-999-666-13-14';
INSERT INTO `phone_numbers` SET `user_id`=15,`phone`='+7-999-666-13-15';
INSERT INTO `phone_numbers` SET `user_id`=16,`phone`='+7-999-666-13-16';
INSERT INTO `phone_numbers` SET `user_id`=16,`phone`='+7-999-666-22-16';
INSERT INTO `phone_numbers` SET `user_id`=16,`phone`='+7-999-666-33-16';

SELECT 
    `u`.`name`, count(`pn`.`id`) `countPhones`
FROM `users` `u`
LEFT JOIN `phone_numbers` `pn`
ON `pn`.`user_id` = `u`.`id`
WHERE YEAR(CURDATE()) - YEAR(FROM_UNIXTIME(`u`.`birth_date`)) BETWEEN 18 AND 22
AND `u`.`gender` = 2
GROUP BY `u`.`id`;

Вывод:
name	        countPhones
test_name_4	    1
test_name_6	    3

```