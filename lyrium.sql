-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2025 a las 19:20:15
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lyrium`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `tipo_persona_id` int(11) NOT NULL,
  `nombre_razon_social` varchar(200) NOT NULL,
  `documento_identidad` varchar(20) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `sexo` enum('M','F') DEFAULT NULL,
  `usuario_id_creador` int(11) DEFAULT NULL,
  `fecha_hora_creado` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id_modificador` int(11) DEFAULT NULL,
  `fecha_hora_modificado` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `tipo_persona_id`, `nombre_razon_social`, `documento_identidad`, `fecha_nacimiento`, `sexo`, `usuario_id_creador`, `fecha_hora_creado`, `usuario_id_modificador`, `fecha_hora_modificado`) VALUES
(1, 1, 'Juan Abad', '75418704', '1994-06-19', 'M', NULL, '2025-11-09 20:20:07', NULL, '2025-11-26 13:13:57'),
(3, 1, 'Vendedor 1', '75418705', '2025-11-18', 'M', NULL, '2025-11-18 22:17:50', NULL, '2025-12-06 12:08:28'),
(4, 1, 'Luis Enrique', '12345678', '2025-11-20', 'M', NULL, '2025-11-20 00:26:01', NULL, '2025-12-06 12:08:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_contactos`
--

CREATE TABLE `personas_contactos` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `direccion` text DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `usuario_id_creador` int(11) DEFAULT NULL,
  `fecha_hora_creado` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id_modificador` int(11) DEFAULT NULL,
  `fecha_hora_modificado` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_tipos`
--

CREATE TABLE `personas_tipos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas_tipos`
--

INSERT INTO `personas_tipos` (`id`, `descripcion`) VALUES
(1, 'Persona natural');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `avatar_color` varchar(20) DEFAULT '#4f46e5',
  `avatar_filename` varchar(255) DEFAULT NULL,
  `config_schedule_columnas` text DEFAULT NULL,
  `Confirmar_cambios_Estado_Realizado_por` tinyint(1) NOT NULL DEFAULT 1,
  `rol` enum('Administrador','Cliente','Vendedor') NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `avatar_url` varchar(255) DEFAULT NULL,
  `token_temporal` text DEFAULT NULL,
  `expiracion_token_temporal` datetime DEFAULT NULL,
  `usuario_id_creador` int(11) DEFAULT NULL,
  `fecha_hora_creado` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id_modificado` int(11) DEFAULT NULL,
  `fecha_hora_modificado` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `persona_id`, `username`, `password`, `correo`, `avatar_color`, `avatar_filename`, `config_schedule_columnas`, `Confirmar_cambios_Estado_Realizado_por`, `rol`, `estado`, `avatar_url`, `token_temporal`, `expiracion_token_temporal`, `usuario_id_creador`, `fecha_hora_creado`, `usuario_id_modificado`, `fecha_hora_modificado`) VALUES
(1, 1, 'NP392247', '$2y$10$Mejn27ovfd62oihCRlOFuulWJc.GjGsl5VTw8BoF9rWLaVRJeBprS', 'juanabad@gmail.com', '#fdd681', 'avatar_69345f825de233.39637464.webp', '[\"orden\",\"descripcion\",\"Referencia\",\"job\",\"frecuencia\",\"estado\",\"usuario_realizado\",\"fecha_hora_ejecucion\",\"fecha_hora_generada\",\"fecha_hora_ejecucion_inicio\",\"fecha_hora_ejecucion_fin\",\"promedio_tiempo\",\"fecha_hora_creado\",\"id\",\"acciones\"]', 0, 'Administrador', 1, NULL, '370a97eb7e1dcc7b69fa7480c7cfa1f029cabd99d3f619825294522fb84e6074', '2025-11-20 07:32:27', NULL, '2025-11-09 20:20:07', NULL, '2025-12-06 12:26:59'),
(21, 4, 'LENRIQUE', '$2y$10$x0h5InTWvj.uITmCj0WrouJIBcql./6GxvIq0PQyzrtd0K/UnLa1C', 'lenrique@gmail.com', '#84b5f5', 'avatar_692b4336151984.58407036.png', '[\"orden\",\"descripcion\",\"Referencia\",\"job\",\"frecuencia\",\"estado\",\"usuario_realizado\",\"fecha_hora_ejecucion\",\"fecha_hora_generada\",\"fecha_hora_ejecucion_inicio\",\"fecha_hora_ejecucion_fin\",\"promedio_tiempo\",\"fecha_hora_creado\",\"id\",\"acciones\"]', 1, 'Cliente', 1, NULL, NULL, NULL, NULL, '2025-11-18 19:39:33', NULL, '2025-12-06 13:18:56'),
(22, 3, 'VENDEDO', '$2y$10$cb9ttGfC4.ZugUKLQb5Eb.mMwx382BPFpFvedryb3erRLnnRSDraW', 'juancarlos@gmail.com', '#b6e78d', NULL, '[\"orden\",\"descripcion\",\"Referencia\",\"job\",\"frecuencia\",\"estado\",\"usuario_realizado\",\"fecha_hora_ejecucion\",\"fecha_hora_generada\",\"fecha_hora_ejecucion_inicio\",\"fecha_hora_ejecucion_fin\",\"promedio_tiempo\",\"fecha_hora_creado\",\"id\",\"acciones\"]', 1, 'Vendedor', 1, NULL, NULL, NULL, NULL, '2025-11-18 22:17:50', NULL, '2025-12-06 12:25:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_tokens`
--

CREATE TABLE `usuarios_tokens` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `token` varchar(500) NOT NULL,
  `fecha_emision` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_expiracion` datetime DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_personas_documento` (`documento_identidad`),
  ADD KEY `idx_personas_tipo` (`tipo_persona_id`);

--
-- Indices de la tabla `personas_contactos`
--
ALTER TABLE `personas_contactos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_contacto_persona` (`persona_id`);

--
-- Indices de la tabla `personas_tipos`
--
ALTER TABLE `personas_tipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_usuarios_username` (`username`),
  ADD UNIQUE KEY `uk_usuarios_correo` (`correo`),
  ADD KEY `idx_usuarios_persona` (`persona_id`);

--
-- Indices de la tabla `usuarios_tokens`
--
ALTER TABLE `usuarios_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_usuarios_tokens_token` (`token`),
  ADD KEY `idx_token_usuario` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personas_contactos`
--
ALTER TABLE `personas_contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas_tipos`
--
ALTER TABLE `personas_tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `usuarios_tokens`
--
ALTER TABLE `usuarios_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `fk_persona_tipo` FOREIGN KEY (`tipo_persona_id`) REFERENCES `personas_tipos` (`id`);

--
-- Filtros para la tabla `personas_contactos`
--
ALTER TABLE `personas_contactos`
  ADD CONSTRAINT `fk_contacto_persona` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
