ALTER TABLE `users` 
ADD is_admin tinyint(1) DEFAULT 0 AFTER `email`;