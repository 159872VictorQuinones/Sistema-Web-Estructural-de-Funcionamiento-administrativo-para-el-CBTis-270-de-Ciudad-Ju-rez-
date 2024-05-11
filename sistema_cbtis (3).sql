-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-03-2024 a las 20:46:02
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_cbtis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `start` datetime NOT NULL,
  `textColor` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`ID`, `title`, `descripcion`, `start`, `textColor`, `color`) VALUES
(2, 'EVENTO ESCOLAR 2', 'Descripcion corta del evento', '2024-03-21 11:00:00', '#fff', '#1a1a1a'),
(4, 'EVENTO DEPORTIVO', '343', '2024-03-06 10:30:00', '#fff', '#ff8080'),
(5, 'title123', 'desc', '2024-03-15 10:30:00', '#fff', '#e6e6e6'),
(6, 'POSADA223', 'posada del cbtis 270 a las 12:35', '2024-03-08 15:30:00', '#fff', '#440e0e'),
(7, 'EVENTO ESCOLAR', 'DESCRUOCUIB123', '2024-03-22 13:35:00', '#fff', '#cee996'),
(8, 'Evento 100editada', 'descr', '2024-03-14 10:30:00', '#fff', '#ff0a0a'),
(9, '123', '123123', '2024-03-01 10:30:00', '#fff', '#000000'),
(10, 'titulo 2', 'descr', '2024-03-29 14:30:00', '#fff', '#00d5ff');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `ID` int(11) NOT NULL,
  `imageBannerPath` varchar(255) NOT NULL,
  `imagePath1` varchar(255) NOT NULL,
  `imagePath2` varchar(255) NOT NULL,
  `imagePath3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`ID`, `imageBannerPath`, `imagePath1`, `imagePath2`, `imagePath3`) VALUES
(1, './assets/img/imagen_banner_65fc91efd4a03_img3.jpg', './assets/img/imagen_1_65f9d9222a412_img4.jpg', './assets/img/imagen_2_65f9d9222ba5b_img1.jpg', './assets/img/imagen_3_65f9d9222d0e0_img3.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `ID` int(11) NOT NULL,
  `no_serie` varchar(100) NOT NULL,
  `producto` varchar(200) NOT NULL,
  `marca` varchar(200) NOT NULL,
  `modelo` varchar(200) NOT NULL,
  `descripcion` varchar(450) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `unidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`ID`, `no_serie`, `producto`, `marca`, `modelo`, `descripcion`, `cantidad`, `user_id`, `unidad`) VALUES
(8, '34234', 'asd', 'asd', 'asd', 'asd', 1, 1, 'asd'),
(13, '123423', '234', '234', '234', '234', 234234, 1, '423'),
(21, '345', '345', '45', '345', '345', 345, 1, '345'),
(24, '99988887122', 'Producto 123edit', 'MARCAedit', 'MODELO2edit', 'descripcion larga qw eqwe qw eqweqwe qwe .....', 101, 3, 'PIEZASedit');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisicion`
--

CREATE TABLE `requisicion` (
  `ID` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `departamento` varchar(255) NOT NULL,
  `materiales` varchar(400) NOT NULL,
  `no_prioridad` int(11) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `unidad` varchar(255) NOT NULL,
  `importe` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `requisicion`
--

INSERT INTO `requisicion` (`ID`, `fecha`, `departamento`, `materiales`, `no_prioridad`, `descripcion`, `cantidad`, `unidad`, `importe`, `user_id`) VALUES
(6, '2024-03-07', 'Control escolar', 'dasdas', 123, 'desc', 1, '212', 122123, 1),
(11, '2024-03-28', 'Recursos Humanos', 'asdasdasdasddqwqdqwdqwdwdqw asd asd asdasd sdasdasd', 12, 'LASDJASJDASJDJ MSADJAJSDJASD AJSDJASJDDJA', 1, '1', 10000, 1),
(13, '2024-03-17', 'Recursos Humanos', '123123', 1, '12312', 123, '123', 123123, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`ID`, `Nombre`) VALUES
(1, 'Director'),
(2, 'Informática'),
(3, 'Usuario Común'),
(4, 'Subdirección académica'),
(5, 'Subdirección administrativa'),
(6, 'Servicios escolares'),
(7, 'Servicios docentes'),
(8, 'Planeación'),
(9, 'Vinculación'),
(10, 'Mantenimiento'),
(11, 'Orientación'),
(12, 'Prefectura'),
(13, 'Recursos humanos'),
(14, 'Recursos financieros'),
(15, 'Profesor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tipo_usuario_ID` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `email`, `password`, `tipo_usuario_ID`) VALUES
(1, 'admin@cbtis.com', 'admin', 1),
(2, 'informatica@cbtis.com', 'informatica', 2),
(3, 'mantenimiento@cbtis.com', 'mantenimiento', 10),
(4, 'profesor@cbtis.com', 'profesor', 15);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_idblkrestric` (`user_id`);

--
-- Indices de la tabla `requisicion`
--
ALTER TABLE `requisicion`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userid` (`user_id`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tipo_usuario_ID` (`tipo_usuario_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `requisicion`
--
ALTER TABLE `requisicion`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `user_idblkrestric` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`ID`);

--
-- Filtros para la tabla `requisicion`
--
ALTER TABLE `requisicion`
  ADD CONSTRAINT `userid` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`ID`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`tipo_usuario_ID`) REFERENCES `tipo_usuario` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
