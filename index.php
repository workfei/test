INSERT INTO `teacher` SET `name`='朱老师',`age` = 60,`status` = 1
DELETE FROM	`teacher` WHERE	`id` = 5
UPDATE `teacher` SET `name` = '灭绝师太', `age` = 12 WHERE `id` = 6
SELECT	* FROM	`teacher` WHERE	`age` < 20