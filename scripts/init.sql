USE laptop;

-- 1. Create laptop_users table
CREATE TABLE IF NOT EXISTS laptop_users (
    laptop_user_id    INT          NOT NULL AUTO_INCREMENT,
    email_address     VARCHAR(255) NOT NULL UNIQUE,
    password          VARCHAR(64)  NOT NULL,
    pronouns          VARCHAR(60)  NOT NULL,
    first_name        VARCHAR(60)  NOT NULL,
    last_name         VARCHAR(60)  NOT NULL,
    phone_number      VARCHAR(60)  NOT NULL,
    date_time_created TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    date_time_updated TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (laptop_user_id)
);

INSERT INTO laptop_users (email_address, password, pronouns, first_name, last_name, phone_number) VALUES
('john117@laptops.com', SHA2('spartan117', 256), 'He/Him', 'Master', 'Chief', '343-117-2892'),
('donkeykong@laptops.com', SHA2('king0fthejungle', 256), 'He/Him', 'Donkey', 'Kong', '501-245-2255'),
('samusaran@laptops.com', SHA2('metro1dlady', 256), 'She/Her', 'Samus', 'Aran', '454-102-0000'),
('pabal@laptops.com', SHA2('ilikeicecre4m', 256), 'He/Him', 'Pabal', 'Ahmed', '973-123-4567');

-- 2. Create laptop_types table FIRST (required for foreign key)
CREATE TABLE IF NOT EXISTS laptop_types (
    laptop_type_id      INT          NOT NULL,
    laptop_type_name    VARCHAR(255) NOT NULL,
    laptop_type_code    VARCHAR(255) NOT NULL UNIQUE,
    laptop_ShelfNumber  INT          NOT NULL,
    date_time_created   TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    date_time_updated   TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (laptop_type_id)
);

INSERT INTO laptop_types (laptop_type_id, laptop_type_name, laptop_type_code, laptop_ShelfNumber) VALUES
(1, 'Apple Laptop', 'APPLE', 1),
(2, '2-in-1 Laptop', '2IN1', 2),
(3, 'Chromebook', 'CHROME', 3);

-- 3. Create laptops table
CREATE TABLE IF NOT EXISTS laptops (
    laptop_id          INT            NOT NULL,
    laptop_code        VARCHAR(10)    NOT NULL,
    laptop_name        VARCHAR(255)   NOT NULL,
    laptop_description TEXT           NOT NULL,
    ram                INT            NOT NULL,
    storage_capacity   INT            NOT NULL,
    inch_dimension     INT            NOT NULL,
    laptop_type_id     INT            DEFAULT NULL,
    laptop_buy_price   DECIMAL(10, 2) NOT NULL,
    laptop_sell_price  DECIMAL(10, 2) NOT NULL,
    date_time_created  TIMESTAMP      DEFAULT CURRENT_TIMESTAMP,
    date_time_updated  TIMESTAMP      DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (laptop_id),
    FOREIGN KEY (laptop_type_id) REFERENCES laptop_types(laptop_type_id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

INSERT INTO laptops (laptop_id, laptop_code, laptop_name, laptop_description, ram, storage_capacity, inch_dimension, laptop_type_id, laptop_buy_price, laptop_sell_price) VALUES
(1, 'MACPRO', 'MacBook Pro 2025', 'The latest MacBook Pro with M3 chip and improved battery life.', 16, 512, 14, 1, 1999.99, 2499.99),
(2, 'LENYOGA', 'Lenovo Yoga 2025', 'A versatile 2-in-1 laptop with a flexible hinge and touchscreen.', 16, 256, 13, 2, 1099.99, 1399.99),
(3, 'DELLCHROME', 'Dell Chromebook 2025', 'A lightweight and affordable Chromebook for everyday tasks.', 8, 128, 11, 3, 299.99, 399.99);