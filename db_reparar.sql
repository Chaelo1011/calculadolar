CREATE DATABASE IF NOT EXISTS laravel_calculadolar;
USE laravel_calculadolar;

CREATE TABLE IF NOT EXISTS category (
	id					 int(255) auto_increment not null,
	name				 varchar(100),
	description			 varchar(100),
	created_at		 	 datetime,
	updated_at			 datetime,
	CONSTRAINT pk_category PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO category VALUES(NULL, 'test', 'test_category', CURTIME(), CURTIME());


CREATE TABLE IF NOT EXISTS users (
	id					 int(255) auto_increment not null,
	name				 varchar(100),
	surname				 varchar(100),
	username			 varchar(50) unique,
	password			 varchar(100),
	email				 varchar(255),
	role				 varchar(15),
	created_at		 	 datetime,
	updated_at			 datetime,
	remember_token		 varchar(255),
	CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'Isael', 'Guilarte', 'IsaelGP', 'admin123', 'chaelo1011@gmail.com', 'admin', CURTIME(), CURTIME(), NULL);
INSERT INTO users VALUES(NULL, 'test', 'test', 'test', 'test1234', 'test@test.com', 'user', CURTIME(), CURTIME(), NULL);


CREATE TABLE IF NOT EXISTS business (
	id					 int(255) auto_increment not null,
	name				 varchar(100),
	city				 varchar(50),
	state				 varchar(50),
	address				 varchar(100),
	description		  	 varchar(100),
	rif				  	 varchar(100),
	logo_path		  	 varchar(100),
	created_at			 datetime,
	updated_at			 datetime,
	user_id				 int(255),
	CONSTRAINT pk_business PRIMARY KEY(id),
	CONSTRAINT fk_business_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDb;

INSERT INTO business VALUES(NULL, 'test_business', 'Tunapuy', 'Sucre', 'Gran Mariscal Street', 'Business test description', '12345678-0', 'path', CURTIME(), CURTIME(), 1);

CREATE TABLE IF NOT EXISTS products (
	id 						int(255) auto_increment not null,
	name		 			varchar(100),
	brand		 			varchar(100),
	measurement	 			float(5,2),
	unit_of_measurement	 	varchar(10),
	dollar_buy_price 		float(12,3),
	unit_quantity	 		float(10,2),
	unit_stock		 		float(10,2),
	profit			 		int(3),
	dollar_sale_price	 	float(12,3) not null,
	wholesale_profit	 	int(3),
	dollar_wholesale_price 	float(15,3),
	bs_day			 		float(60,2),
	bs_cash_day		 		float(60,2),
	created_at		 		datetime,
	updated_at		 		datetime,
	user_id			 		int(255),
	category_id		 		int(255),
	CONSTRAINT pk_products PRIMARY KEY(id),
	CONSTRAINT fk_products_users FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT fk_products_category FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDb;

INSERT INTO products VALUES(NULL, 'Harina', 'PAN', 1, 'KG', 18, 20, 20, 30, 1.44, 10, '1.2', '4.65', NULL, CURTIME(), CURTIME(), 1, 1);
INSERT INTO products VALUES(NULL, 'Harina de trigo', 'Robin Hood', 1, 'KG', 15, 10, 10, 30, '1.95', 10, '1.65', '4.65', NULL, CURTIME(), CURTIME(), 1, 1);


CREATE TABLE IF NOT EXISTS product_catalog (
	id 					int(255) auto_increment not null,
	image_path	 		varchar(100),
	description	 		text,
	created_at	 		datetime,
	updated_at	 		datetime,
	product_id	 		int(255),
	CONSTRAINT pk_catalog PRIMARY KEY(id),
	CONSTRAINT fk_catalog_product FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDb;

INSERT INTO product_catalog VALUES(NULL, 'path', 'Descripcion de prueba para la imagen del producto', CURTIME(), CURTIME(), 1);
INSERT INTO product_catalog VALUES(NULL, 'path1', 'Descripcion de prueba 2', CURTIME(), CURTIME(), 1);
INSERT INTO product_catalog VALUES(NULL, 'path2', 'Descripcion de la imagen 3', CURTIME(), CURTIME(), 1);
INSERT INTO product_catalog VALUES(NULL, 'path', 'Descripcion de la imagen 1 producto 2', CURTIME(), CURTIME(), 2);


CREATE TABLE IF NOT EXISTS customer(
	id 				int(255) auto_increment not null,
	idn 		 	int(15),
	name		 	varchar(50),
	surname		 	varchar(50),
	address 	 	varchar(100),
	phone_number 	int(15),
	created_at	 	datetime,
	updated_at 	 	datetime,
	business_id     int,
	CONSTRAINT pk_customer PRIMARY KEY(id),
	CONSTRAINT fk_customer_business FOREIGN KEY(business_id) REFERENCES business(id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDb;

INSERT INTO customer VALUES(NULL, 24124843, 'Pedro', 'Perez', 'Tunapuy', 41679671, CURTIME(), CURTIME());


CREATE TABLE IF NOT EXISTS invoice(
	id 				int(255) auto_increment not null,
	pay_method	 	varchar(20),
	tax			 	int(2),
	created_at	 	datetime,
	updated_at	 	datetime,
	customer_id	 	int(255),
	user_id	 	int(255),
	CONSTRAINT pk_invoice PRIMARY KEY(id),
	CONSTRAINT fk_invoice_customer FOREIGN KEY(customer_id) REFERENCES customer(id) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT fk_invoice_users FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDb;

INSERT INTO invoice VALUES(NULL, 'Efectivo', 20, CURTIME(), CURTIME(), 1, 1);


CREATE TABLE IF NOT EXISTS sale_details (
	id 				int(255) auto_increment not null,
	quantity 		float(10,2),
	discount	 	int(3),
	created_at	 	datetime,
	updated_at	 	datetime,
	product_id	 	int(255),
	invoice_id	 	int(255),
	CONSTRAINT pk_sale_details PRIMARY KEY(id),
	CONSTRAINT fk_sale_product FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT fk_sale_invoice FOREIGN KEY(invoice_id) REFERENCES invoice(id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDb;

INSERT INTO sale_details VALUES(NULL, 2, 0, CURTIME(), CURTIME(), 1, 1);