CREATE TABLE IF NOT EXISTS `market_retailers` (
  `retailer_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `retailer_name` VARCHAR(100) NOT NULL,
  `retailer_email` VARCHAR(120) NOT NULL,
  `retailer_phone` VARCHAR(24) NOT NULL,
  `retailer_password` VARCHAR(250) NOT NULL,
  `retailer_store` INT UNSIGNED NOT NULL,
  `retailer_admin` BOOLEAN NOT NULL DEFAULT '0',
  `retailer_active` BOOLEAN NOT NULL DEFAULT '1',
  `retailer_approved` BOOLEAN NOT NULL DEFAULT '0',
  `retailer_approved_by` INT UNSIGNED NOT NULL,
  `retailer_register` DATETIME NOT NULL,
  PRIMARY KEY (`retailer_id`),
  KEY (`retailer_store`) REFERENCES (`stores`),
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `market_stores` (
  `store_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_code` VARCHAR(12) NOT NULL,
  `store_name` VARCHAR(120) NOT NULL,
  `store_official_name` VARCHAR(120) NOT NULL,
  `store_cr` VARCHAR(12) NOT NULL,
  `store_cr_photo` VARCHAR(64) NOT NULL,
  `store_tax` VARCHAR(24) NOT NULL,
  `store_phone` VARCHAR(24) NOT NULL,
  `store_mobile` VARCHAR(24) NOT NULL,
  `store_country` INT UNSIGNED NOT NULL,
  `store_state` INT UNSIGNED NOT NULL,
  `store_city` INT UNSIGNED NOT NULL,
  `store_area` INT UNSIGNED NOT NULL,
  `store_address` VARCHAR(1024) NOT NULL,
  `store_status` INT UNSIGNED DEFAULT 1,
  `store_cerated` DATETIME NOT NULL,
  PRIMARY KEY (`store_id`),
  FOREIGN KEY (`store_admin`) REFERENCES (`retailers`),
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `market_categories` (
  `category_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` VARCHAR(1024) NOT NULL,
  PRIMARY KEY (`category_id`),
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `market_subcategories` (
  `subcategory_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `subcategory_name` VARCHAR(1024) NOT NULL,
  `subcategory_cat` VARCHAR(1024) NOT NULL,
  PRIMARY KEY (`subcategory_id`),
  FOREIGN KEY (`subcategory_cat`) REFERENCES `market_categories`(`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `market_products` (
  `product_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_code` VARCHAR(24) NOT NULL,
  `product_name` VARCHAR(1024) NOT NULL,
  `product_store` INT UNSIGNED NOT NULL,
  `product_category` INT UNSIGNED NOT NULL,
  `product_subcategory` INT UNSIGNED NOT NULL,
  `product_photo` BIGINT UNSIGNED NOT NULL,
  `product_desc` TEXT NOT NULL,
  `product_price` DECIMAL(2, 9) NOT NULL,
  `product_disc` DECIMAL(2, 9) NOT NULL
  `product_views` INT UNSIGNED NOT NULL,
  `product_show` BOOLEAN DEFAULT '1',
  `product_delete` BOOLEAN DEFAULT '0',
  `product_cerated` DATETIME NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `product_category` REFERENCES (`product_categories`),
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- photos id, file(64), create, prod_id
-- views id, client, product, time

-- -----------------------------

CREATE TABLE IF NOT EXISTS `market_orders` (
  `order_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_code` VARCHAR(12) NOT NULL,
  `order_customer` INT UNSIGNED NOT NULL,
  `order_note` VARCHAR(1024) NOT NULL,
  `order_status` TINYINT UNSIGNED NOT NULL DEFAULT '1' COMMENT '1:DRAFT, 2:CANCELED, 3:PLACED, 4:APPROVED, 5:DELIVERED',
  `order_subtotal` DECIMAL(12,2) NOT NULL,
  `order_disc` DECIMAL(6,2) NOT NULL,
  `order_totaldisc` DECIMAL(12,2) NOT NULL,
  `order_total` DECIMAL(12,2) NOT NULL,
  `order_create` DATETIME NOT NULL,
  `order_exec` DATETIME DEFAULT NULL,
  `order_approved` DATETIME DEFAULT NULL,
  `order_deliverd` DATETIME DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `order_code` REFERENCES (`order_code`),
  KEY `order_customerId` REFERENCES (`customers`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS  `market_order_items` (
  `orderItem_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `orderItem_order` INT UNSIGNED NOT NULL,
  `orderItem_product` INT UNSIGNED NOT NULL,
  `orderItem_productPrice` DECIMAL(12,2) NOT NULL COMMENT 'product price',
  `orderItem_subtotal` DECIMAL(12, 2) NOT NULL,
  `orderItem_disc` DECIMAL(6,2) NOT NULL,
  `orderItem_total` DECIMAL(12, 2) NOT NULL,
  PRIMARY KEY (`orderItem_id`),
  KEY `orderItem_orderId` REFERENCES (`orders`),
  KEY `orderItem_productId` REFERENCES (`products`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
