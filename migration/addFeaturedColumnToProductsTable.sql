ALTER TABLE `products`
ADD featured tinyint(1) DEFAULT 0 AFTER `image_url`;