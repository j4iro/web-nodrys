CREATE DATABASE db_tesis_en;

CREATE TABLE categories
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(100) NULL,
    created_at DATETIME,
    updated_at DATETIME
);

INSERT INTO categories VALUES (NULL, 'Vegetariano',NULL,CURTIME(),CURTIME()),
                       (NULL, 'Tradicional',NULL,CURTIME(),CURTIME()),
                       (NULL, 'Comida Rápida',NULL,CURTIME(),CURTIME());


CREATE TABLE districts(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(200) NOT NULL,
    description TEXT NULL,
    created_at DATETIME,
    updated_at DATETIME
);

INSERT INTO districts VALUES (NULL, 'Lince',NULL,CURTIME(),CURTIME()),
                       (NULL, 'Cercado de Lima',NULL,CURTIME(),CURTIME()),
                       (NULL, 'Miraflores',NULL,CURTIME(),CURTIME()),
                       (NULL, 'Lima',NULL,CURTIME(),CURTIME());


CREATE TABLE users
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    role VARCHAR(20) NULL,
    name VARCHAR(100) NOT  NULL,
    surname VARCHAR(200) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    `password`  VARCHAR(255) NOT NULL,
    telephone VARCHAR(20) NULL,
    address TEXT NULL,
    image TEXT NULL,
    points INT  NULL,
    state BIT  NULL,
    district_id INT NULL,
    created_at DATETIME,
    updated_at DATETIME,
    remember_token  varchar(255),

    CONSTRAINT fk_users_districts FOREIGN KEY(district_id) REFERENCES districts(id)
)ENGINE=InnoDB;

INSERT into users values
(NULL,'user','Jairo','Lachira','jairo@jairo.com','jairo','958051400','Jr Candamo 8562',NULL,0,1,2,CURTIME(),CURTIME(),NULL),
(NULL,'user','Smith','Alama','smith@smith.com','smith','958085711','Jr Torres 250',NULL,0,1,1,CURTIME(),CURTIME(),NULL);

CREATE TABLE restaurants(
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT NOT NULL,
    district_id INT NOT NULL,
    name VARCHAR(200) NOT NULL,
    slogan TEXT NULL,
    address TEXT NOT NULL,
    assessment INT NULL,
    points INT NULL,
    image TEXT NULL,
    created_at DATETIME,
    updated_at DATETIME,
    CONSTRAINT fk_restaurants_categories  FOREIGN KEY(category_id) REFERENCES categories(id),
    CONSTRAINT fk_restaurants_districts  FOREIGN KEY(district_id) REFERENCES districts(id)
);

INSERT INTO restaurants VALUES 
(NULL, 1,1,'El buen tomate',NULL,'Manuel Candamo 852',50,100,'el_buen_tomate.jpg',CURTIME(),CURTIME()),
(NULL, 1,1,'Embarcadero 41',NULL,'Juan de Miller 741',50,100,'embarcadero41.jpg',CURTIME(),CURTIME());

CREATE TABLE cards(
    card_id INT PRIMARY KEY AUTO_INCREMENT,
    num_card VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    `month` INT NOT NULL,
    `year` INT NOT NULL,
    cvc INT NOT NULL,
    owner VARCHAR(200) NOT NULL,
    country CHAR(3) NOT NULL,
    cod_postal INT NOT NULL,
    created_at DATETIME,
    updated_at DATETIME,

    CONSTRAINT fk_cards_users FOREIGN KEY(user_id) REFERENCES users(id)
);

CREATE TABLE orders(
    id INT PRIMARY KEY AUTO_INCREMENT,
    restaurant_id INT NOT NULL,
    user_id INT  NOT NULL,
    `date` DATE NOT NULL,
    `hour` TIME NOT  NULL,
    n_people INT NOT NULL,
    oca_special TEXT NULL,
    cod_promo CHAR(10) NULL,
    state INT NOT NULL,
    total NUMERIC(20,2) NOT NULL,
    created_at DATETIME,
    updated_at DATETIME,

    CONSTRAINT fk_orders_restaurants FOREIGN KEY(restaurant_id) REFERENCES restaurants(id),
    CONSTRAINT fk_orders_users FOREIGN KEY(user_id) REFERENCES users(id)
)
ENGINE=InnoDB;

CREATE TABLE favorites(
    favorite_id INT NOT NULL,
    user_id INT NOT NULL,
    restaurant_id INT NOT NULL,
    state BIT NOT NULL,
    created_at DATETIME,
    updated_at DATETIME,

    CONSTRAINT fk_favorites_users  FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_favorites_restaurant FOREIGN KEY(restaurant_id) REFERENCES restaurants(id)
);

CREATE TABLE dishes
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    restaurant_id INT NOT NULL,
    name TEXT NOT NULL,
    description TEXT NOT NULL,
    price NUMERIC(20,2) NOT NULL,
    `time` INT NOT NULL,
    image TEXT NOT NULL,
    created_at DATETIME,
    updated_at DATETIME,
    type VARCHAR(20) NOT NULL,
    CONSTRAINT fk_dishes_restaurants FOREIGN KEY(restaurant_id) REFERENCES restaurants(id)
);

ALTER TABLE dishes ADD COLUMN type VARCHAR(20) NOT NULL;

INSERT INTO dishes VALUES 
(NULL, 1,'Arroz con pollo','Pollo traido de las granjas recien fresco',10,5,'arroz_pollo.jpg',CURTIME(),CURTIME(),'second'),
(NULL, 1,'Chancho al cilindro','Chanchito criado por los dioses',50,15,'chancho_cilindro.jpg',CURTIME(),CURTIME(),'second');

INSERT INTO dishes VALUES 
(NULL, 2,'Arroz con pato','Pato traido de las granjas recien fresco',15,5,'arroz_pato.jpg',CURTIME(),CURTIME(),'second'),
(NULL, 2,'Cuy al cilindro','Cuy criado por los dioses',25,15,'cuy_asado.jpg',CURTIME(),CURTIME(),'second');

CREATE TABLE menus
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    dish_id INT NOT NULL,
    `date` DATE NOT NULL,
    created_at DATETIME,
    updated_at DATETIME,
    
    CONSTRAINT fk_menus_dishes FOREIGN KEY(dish_id) REFERENCES dishes(id)
);

CREATE TABLE details_orders
(
    detail_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    dish_id INT NOT NULL,
    created_at DATETIME,
    updated_at DATETIME,

    CONSTRAINT fk_details_orders FOREIGN KEY(order_id) REFERENCES orders(id),
    CONSTRAINT fk_details_dishes FOREIGN KEY(dish_id) REFERENCES dishes(id)
)
ENGINE=InnoDB;

