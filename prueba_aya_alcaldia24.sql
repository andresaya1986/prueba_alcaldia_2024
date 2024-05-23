-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-05-2024 a las 16:32:25
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
-- Base de datos: `prueba_aya_alcaldia24`
--

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `actualizar_contraseña_por_nombre` (`userName` VARCHAR(255), `newPassword` VARCHAR(255)) RETURNS VARCHAR(255) CHARSET utf8mb4 COLLATE utf8mb4_general_ci DETERMINISTIC BEGIN
    DECLARE mensaje VARCHAR(255);
    
    UPDATE usuarios
    SET password = newPassword
    WHERE nombre = userName;
    
    IF ROW_COUNT() > 0 THEN
        SET mensaje = 'Contraseña actualizada correctamente.';
    ELSE
        SET mensaje = 'Usuario no encontrado.';
    END IF;
    
    RETURN mensaje;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `obtenerNombrePorId` (`idparam` INT) RETURNS VARCHAR(100) CHARSET utf8mb4 COLLATE utf8mb4_general_ci  BEGIN
    DECLARE nombreret VARCHAR(100);
    
    SELECT nombre INTO nombreret
    FROM usuarios
    WHERE id = idparam;

    RETURN nombreret;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `obtener_nombre_por_correo` (`email` VARCHAR(255)) RETURNS VARCHAR(255) CHARSET utf8mb4 COLLATE utf8mb4_general_ci DETERMINISTIC BEGIN
    DECLARE nombreret VARCHAR(255);
    
    SELECT nombre INTO nombreret
    FROM usuarios
    WHERE correo = email
    LIMIT 1;
    
    RETURN nombreret;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `password`) VALUES
(1, 'Jaime Aya', 'jaimeandresaya@gmail.com', 'nuevaContraseña123'),
(2, 'Andres Aya', 'jaimeandresayaluna@outlook.com', '25ad123*@'),
(3, 'Ricardo Restrepo', 'ricrestrepo@gmail.com', 'rr2024*#2598'),
(10, 'Jaime Luna', 'jaimeandreaya@gmail.com', '$2y$10$lX5UJlNlmDsv/Jv9DOt1L.mhoIMuuUWWnbmhX3y6JSWU4IgIKDiNS'),
(35, 'Jaime Luna', 'jaya@asylummarketing.com', '$2y$10$ItPoT.fzrGJUHzNgj7/XM.KHDIlANzHtkAu8K7IpFmmMni/8HbsyK');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
