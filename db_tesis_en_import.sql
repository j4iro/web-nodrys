-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-04-2019 a las 17:57:40
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tesis_en`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cards`
--

CREATE TABLE `cards` (
  `card_id` int(11) NOT NULL,
  `num_card` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `cvc` int(11) NOT NULL,
  `owner` varchar(200) NOT NULL,
  `country` char(3) NOT NULL,
  `cod_postal` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cards`
--

INSERT INTO `cards` (`card_id`, `num_card`, `user_id`, `month`, `year`, `cvc`, `owner`, `country`, `cod_postal`, `created_at`, `updated_at`) VALUES
(6, '968574589632541', 4, 2, 2022, 523, 'José Lachira Peralta', 'col', 523, '2019-04-01 16:26:59', '2019-04-01 16:26:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Vegetariano', NULL, '2019-03-18 11:36:23', '2019-03-18 11:36:23'),
(2, 'Tradicional', NULL, '2019-03-18 11:36:23', '2019-03-18 11:36:23'),
(3, 'Comida Rápida', NULL, '2019-03-18 11:36:23', '2019-03-18 11:36:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `details_orders`
--

CREATE TABLE `details_orders` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `details_orders`
--

INSERT INTO `details_orders` (`detail_id`, `order_id`, `dish_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2019-04-01 16:26:59', '2019-04-01 16:26:59'),
(2, 1, 4, '2019-04-01 16:27:00', '2019-04-01 16:27:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dishes`
--

CREATE TABLE `dishes` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `time` int(11) NOT NULL,
  `image` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dishes`
--

INSERT INTO `dishes` (`id`, `restaurant_id`, `name`, `description`, `price`, `time`, `image`, `created_at`, `updated_at`, `type`) VALUES
(1, 1, 'Arroz con pollo', 'Pollo traido de las granjas recien fresco', '10.00', 5, 'arroz_pollo.jpg', '2019-03-18 11:36:25', '2019-03-18 11:36:25', 'segundo'),
(2, 1, 'Chancho al cilindro', 'Chanchito criado por los dioses', '50.00', 15, 'chancho_cilindro.jpg', '2019-03-18 11:36:25', '2019-03-18 11:36:25', 'segundo'),
(3, 2, 'Arroz con pato', 'Pato traido de las granjas recien fresco', '15.00', 5, 'arroz_pato.jpg', '2019-03-18 11:36:26', '2019-03-18 11:36:26', 'segundo'),
(4, 2, 'Cuy asado', 'Cuy criado por los dioses', '25.00', 15, 'cuy_asado.jpg', '2019-03-18 11:36:26', '2019-03-18 11:36:26', 'segundo'),
(11, 1, 'Pachamanca', 'Plato típico de huancavelica', '12.00', 11, '1553973736Pachamanca-a-la-olla.jpg', '2019-03-30 19:22:16', '2019-03-30 19:22:16', 'segundo'),
(12, 2, 'Ceviche', 'Plato tipico de piura', '20.00', 15, '1553978205ceviche-piura.jpg', '2019-03-30 20:36:45', '2019-03-30 20:36:45', 'entrada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `districts`
--

INSERT INTO `districts` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Lince', NULL, '2019-03-18 11:36:24', '2019-03-18 11:36:24'),
(2, 'Cercado de Lima', NULL, '2019-03-18 11:36:24', '2019-03-18 11:36:24'),
(3, 'Miraflores', NULL, '2019-03-18 11:36:24', '2019-03-18 11:36:24'),
(4, 'Lima', NULL, '2019-03-18 11:36:24', '2019-03-18 11:36:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorites`
--

CREATE TABLE `favorites` (
  `favorite_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `state` bit(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `n_people` int(11) NOT NULL,
  `oca_special` text,
  `cod_promo` char(10) DEFAULT NULL,
  `state` varchar(20) NOT NULL,
  `total` decimal(20,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `restaurant_id`, `user_id`, `date`, `hour`, `n_people`, `oca_special`, `cod_promo`, `state`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2019-04-01', '16:26:59', 2, 'aniversario', NULL, 'pendiente', '45.30', '2019-04-01 16:26:59', '2019-04-01 16:26:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `slogan` text,
  `address` text NOT NULL,
  `assessment` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `image` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `restaurants`
--

INSERT INTO `restaurants` (`id`, `category_id`, `district_id`, `name`, `slogan`, `address`, `assessment`, `points`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'El buen tomate', NULL, 'Manuel Candamo 852', 50, 100, 'el_buen_tomate.jpg', '2019-03-18 11:36:24', '2019-03-18 11:36:24'),
(2, 1, 1, 'Embarcadero 41', NULL, 'Juan de Miller 741', 50, 100, 'embarcadero41.jpg', '2019-03-18 11:36:24', '2019-03-18 11:36:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(200) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `address` text,
  `image` text,
  `points` int(11) DEFAULT NULL,
  `state` bit(1) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `surname`, `email`, `password`, `telephone`, `address`, `image`, `points`, `state`, `district_id`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'user', 'Jairo', 'Lachira', 'jairo@jairo.com', 'jairo', '958051400', 'Jr Candamo 8562', NULL, 0, b'1', 2, '2019-03-18 11:36:24', '2019-03-18 11:36:24', NULL),
(2, 'user', 'Smith', 'Alama', 'smith@smith.com', 'smith', '958085711', 'Jr Torres 250', NULL, 0, b'1', 1, '2019-03-18 11:36:24', '2019-03-18 11:36:24', NULL),
(3, NULL, 'Ricardo', NULL, 'ricardo@admin.com', '$2y$10$nhQbtc2A1wTkMYXH4zIMgeG1p/mhzZRIEDf8aoZXIPv11CKRkaJm2', NULL, NULL, NULL, 0, b'1', NULL, '2019-03-18 17:03:45', '2019-03-18 17:03:45', 'Vi7cuSRnWk1jBV719h7BAMHWMmD3FD3lc5SohJZCVhT8PjuPPjJY8wgYkVkP'),
(4, 'user', 'Jose', 'Alama Sanchez', 'jose@jose.com', '$2y$10$EDJfw2wup.i6Hsj9uWdKRufCzgWw7t/bcD1b2xEs4JJohQSgiz/4u', '958051877', 'Jr Enrique Barrón 1038', '1553012913yo.jpg', 0, b'1', NULL, '2019-03-19 03:09:49', '2019-03-19 16:28:33', '8NhOWLxxNSrIOcThf2cx3oHt72gprGZ1uknBAVqfX2LA6Tu82aCtFG0GdVPZ');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `fk_cards_users` (`user_id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `details_orders`
--
ALTER TABLE `details_orders`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `fk_details_orders` (`order_id`),
  ADD KEY `fk_details_dishes` (`dish_id`);

--
-- Indices de la tabla `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dishes_restaurants` (`restaurant_id`);

--
-- Indices de la tabla `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `favorites`
--
ALTER TABLE `favorites`
  ADD KEY `fk_favorites_users` (`user_id`),
  ADD KEY `fk_favorites_restaurant` (`restaurant_id`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_menus_dishes` (`dish_id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_restaurants` (`restaurant_id`),
  ADD KEY `fk_orders_users` (`user_id`);

--
-- Indices de la tabla `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_restaurants_categories` (`category_id`),
  ADD KEY `fk_restaurants_districts` (`district_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_users_districts` (`district_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cards`
--
ALTER TABLE `cards`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `details_orders`
--
ALTER TABLE `details_orders`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `fk_cards_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `details_orders`
--
ALTER TABLE `details_orders`
  ADD CONSTRAINT `fk_details_dishes` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`id`),
  ADD CONSTRAINT `fk_details_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Filtros para la tabla `dishes`
--
ALTER TABLE `dishes`
  ADD CONSTRAINT `fk_dishes_restaurants` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`);

--
-- Filtros para la tabla `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `fk_favorites_restaurant` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`),
  ADD CONSTRAINT `fk_favorites_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `fk_menus_dishes` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`id`);

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_restaurants` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`),
  ADD CONSTRAINT `fk_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `fk_restaurants_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_restaurants_districts` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_districts` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
