
Database name="shoppingcart"


CREATE TABLE IF NOT EXISTS `product` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`product_name` varchar(200) NOT NULL,
	`product-price` varchar(50) NOT NULL,
	`product_image` varchar(255) NOT NULL,
	`product_code` varchar(20) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `product`(`product_name`, `product-price`, `product_image`, `product_code`)
 VALUES ("LEBRON WITNESS",6666.50,"imgs/lebron-witness.jpg","CD5007-101 "),
 ("LEBRON SOLDIER",5666.50,"imgs/lebron-soldier.jpg","BQ5595-007"),
("LEBRON WITNESS V WHITE",5866.50,"imgs/lebron-witness-v-white.jpg","BQ5595-006"),
("NIKE LEBRON XVII LOW",4866.50,"imgs/lebron-xvii-low.jpg","CD5007-101"),
("NIKE LEBRON XVII (PS)",4896.50,"imgs/lebron-xvii-ps.jpg","BQ5595-006"),
("ULTRABOOST",6866.50,"imgs/ultraboost.jpg","BQ5595-009"),
("KYRIE LOW",6850.00,"imgs/kyrie-low-4.jpg","BQ5595-010"),
("LEBRON WITNESS WHITE",6866.50,"imgs/lebron-witness-v-white.jpg","BQ5595-010")

CREATE TABLE IF NOT EXISTS `cart` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`product_name` varchar(200) NOT NULL,
	`price` varchar(50) NOT NULL,
	`product_image` varchar(255) NOT NULL,
	`quantity` 	int(100) NOT NULL,
	`total_price` varchar(100) NOT NULL,
	`product_code` 	varchar(10) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);