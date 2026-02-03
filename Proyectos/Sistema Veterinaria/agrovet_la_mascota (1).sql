-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2024 at 11:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agrovet_la_mascota`
--

-- --------------------------------------------------------

--
-- Table structure for table `citas`
--

CREATE TABLE `citas` (
  `id_citas` int(11) NOT NULL,
  `fecha_y_hora` varchar(45) NOT NULL,
  `paciente_asociado` varchar(45) NOT NULL,
  `motivo_de_cita` varchar(45) NOT NULL,
  `Notas_adicionales` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citas`
--

INSERT INTO `citas` (`id_citas`, `fecha_y_hora`, `paciente_asociado`, `motivo_de_cita`, `Notas_adicionales`) VALUES
(1, '03-04-2025/ 08:30', 'tuto murillo', 'vacunación ', 'N/A'),
(2, '03-04-2025/ 10:30', 'perla rivera', 'vacunación ', 'N/A'),
(3, '03-04-2025/ 02:30 pm', 'Rayas rivera', 'vacunación ', 'N/A'),
(4, '03-05-2025/ 02:30 pm', 'julio de leon', 'vacunación ', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `factura`
--

CREATE TABLE `factura` (
  `id` int(11) NOT NULL,
  `codigo_factura` varchar(45) NOT NULL,
  `fecha` varchar(10) NOT NULL,
  `cliente` varchar(20) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `DUI` varchar(20) NOT NULL,
  `cantidad` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio_U` varchar(100) NOT NULL,
  `ventas_grabadas` varchar(100) NOT NULL,
  `Total_venta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `factura`
--

INSERT INTO `factura` (`id`, `codigo_factura`, `fecha`, `cliente`, `direccion`, `DUI`, `cantidad`, `descripcion`, `precio_U`, `ventas_grabadas`, `Total_venta`) VALUES
(1, '1823', '03/04/2024', 'Miguel Osegueda', 'avenida las flores, colonia el', '098736572-2', '1', 'Alimiau', '$1.25', '$1.25', '$1.25'),
(2, '1824', '03/05/2024', 'Juan Molina', 'Avenida los almendros, pasaje ', '05456789-2', '3 ', 'quintales de maiz ', '$20.00', '$60.00', '$60.00');

-- --------------------------------------------------------

--
-- Table structure for table `historial_medico`
--

CREATE TABLE `historial_medico` (
  `id` int(11) NOT NULL,
  `registro_diagnostico` varchar(50) NOT NULL,
  `procedimientos_realizados` varchar(100) NOT NULL,
  `alergias` varchar(45) NOT NULL,
  `resultados_pruebas` varchar(100) NOT NULL,
  `Tratamientos_anteriores` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `historial_medico`
--

INSERT INTO `historial_medico` (`id`, `registro_diagnostico`, `procedimientos_realizados`, `alergias`, `resultados_pruebas`, `Tratamientos_anteriores`) VALUES
(1, 'N/A', 'desperacitacion ', 'ninguna', 'N/A', 'ninguno'),
(2, 'diabetes tipo 3', 'aplicacion de insulina', 'ninguna', 'positivo con diabetes tipo 3', 'ninguno ');

-- --------------------------------------------------------

--
-- Table structure for table `inventario_medicamentos`
--

CREATE TABLE `inventario_medicamentos` (
  `id` int(11) NOT NULL,
  `nombre_articulo` varchar(45) NOT NULL,
  `cantidad_existencia` varchar(45) NOT NULL,
  `laboratorio` varchar(45) NOT NULL,
  `fecha_vencimiento` varchar(45) NOT NULL,
  `precio_U` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventario_medicamentos`
--

INSERT INTO `inventario_medicamentos` (`id`, `nombre_articulo`, `cantidad_existencia`, `laboratorio`, `fecha_vencimiento`, `precio_U`) VALUES
(1, 'Tenanvid', '20', 'LIVISTO', '05/26', '$12.00'),
(2, 'selevit-E', '12', 'LIVISTO', '05/26', '$7.00'),
(3, 'tabletas de amoxicilina', '50', 'LIVISTO', '07/26', '$30.00'),
(4, 'Blister de Omega', '25', 'LIVISTO', '05/26', '$30.00'),
(5, 'vacuna para rabia ', '30', 'LIVISTO', '12/05/25', '$1.00');

-- --------------------------------------------------------

--
-- Table structure for table `pacientes`
--

CREATE TABLE `pacientes` (
  `id_pacientes` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Especie` varchar(45) NOT NULL,
  `Raza` varchar(45) NOT NULL,
  `Sexo` varchar(45) NOT NULL,
  `peso` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL,
  `Edad` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pacientes`
--

INSERT INTO `pacientes` (`id_pacientes`, `Nombre`, `Especie`, `Raza`, `Sexo`, `peso`, `color`, `Edad`) VALUES
(1, 'Tuto Murillo', 'felino', 'mixto', 'Masculino', '18 kg', 'blanco parchado', '5 años'),
(2, 'Perla Rivera', 'felina', 'Angora ', 'femenino ', '15 kg', 'blanco/negro/amarillo', '3 años'),
(3, 'Doggy rivera', 'canino', 'mixto', 'Masculino', '20 kg', 'beige', '3 años'),
(4, 'Julio De Leon', 'felino', 'Mixto', 'Masculino', '18 kg', 'blanco parchado', '6 años'),
(5, 'Rayas Rivera', 'mixto', 'felino ', 'Masculino', '17 kg', 'blanco parchado', '4 años');

-- --------------------------------------------------------

--
-- Table structure for table `personal`
--

CREATE TABLE `personal` (
  `id_personal` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `cargo` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `correo_electronico` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal`
--

INSERT INTO `personal` (`id_personal`, `nombre`, `apellido`, `cargo`, `telefono`, `correo_electronico`) VALUES
(1, 'Miguel', 'Martinez', 'Veterinario', 'xxxx-xxxx', 'MiguelM@gmail.com'),
(2, 'Martina', 'Gutierrez', 'secretaria', 'xxxx-xxxx', 'marina8@gmail.com'),
(3, 'Julio ', 'Medina', 'Hijo del dueño', 'xxxx-xxxx', 'julioM@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id_productos` int(11) NOT NULL,
  `codigo_producto` varchar(45) NOT NULL,
  `nombre_producto` varchar(45) NOT NULL,
  `existencias` varchar(100) NOT NULL,
  `caducidad` varchar(100) NOT NULL,
  `precio_U` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id_productos`, `codigo_producto`, `nombre_producto`, `existencias`, `caducidad`, `precio_U`) VALUES
(1, '1265341', 'don gato', '60', '12/09/2024', '$1.25'),
(2, '121239203', 'Alimiau', '60', '12/10/2024', '$1.50'),
(3, '1265342', 'pechera de cuero', '25', 'N/A', '$15.00'),
(4, '218912031', 'shampoo rinse', '20', 'N/A', '$6.00');

-- --------------------------------------------------------

--
-- Table structure for table `propietarios`
--

CREATE TABLE `propietarios` (
  `id_prop` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Apellido` varchar(40) NOT NULL,
  `Direccion` varchar(40) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `Correo_electronico` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `propietarios`
--

INSERT INTO `propietarios` (`id_prop`, `Nombre`, `Apellido`, `Direccion`, `Telefono`, `Correo_electronico`) VALUES
(1, 'fernando ', 'Murillo', 'san miguel', 'xxxx-xxxx', 'fernandomuril18@gmail.com'),
(2, 'Miguel', 'Osegueda', 'avenida no me acuerdo casa 18 ', 'xxxx-xxxx', 'miguel@gmail.com'),
(3, 'Juan', 'romano', 'Avenida mucho tiempo casa 9', 'xxxx-xxxx', 'junilloL@gmail.com'),
(4, 'Ana ', 'Martinez', 'san miguel', 'xxxx-xxxx', 'AnitaM@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `registro_de_vacunacion`
--

CREATE TABLE `registro_de_vacunacion` (
  `id_vacunacion` int(11) NOT NULL,
  `Tipo_vacuna` varchar(45) NOT NULL,
  `fecha_administracion` varchar(45) NOT NULL,
  `Prox_fecha_vacunacion` varchar(45) NOT NULL,
  `ID_Paciente` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registro_de_vacunacion`
--

INSERT INTO `registro_de_vacunacion` (`id_vacunacion`, `Tipo_vacuna`, `fecha_administracion`, `Prox_fecha_vacunacion`, `ID_Paciente`) VALUES
(1, 'Desparasitante ', '19/02/2024', '19/08/2024', '1'),
(2, 'Vitamina B12', '18/07/2024', '18/09/2024', '2'),
(3, 'Desparasitante ', '19/02/2024', '19/08/2024', '3'),
(4, 'Vitamina B12', '18/07/2024', '18/09/2024', '4'),
(5, 'Desparasitante ', '19/02/2024', '19/08/2024', '5');

-- --------------------------------------------------------

--
-- Table structure for table `tratamientos`
--

CREATE TABLE `tratamientos` (
  `id_tratamiento` int(11) NOT NULL,
  `paciente` varchar(45) NOT NULL,
  `nombre_tratamiento` varchar(45) NOT NULL,
  `costo_tratamiento` varchar(45) NOT NULL,
  `fecha_tratamiento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tratamientos`
--

INSERT INTO `tratamientos` (`id_tratamiento`, `paciente`, `nombre_tratamiento`, `costo_tratamiento`, `fecha_tratamiento`) VALUES
(1, 'tuto Murillo', 'Antiparasitario ', '$20.00', '05/06/2024'),
(2, 'perla rivera', 'esterilizacion ', '$30.00', '02/06/2026');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vista_citas`
-- (See below for the actual view)
--
CREATE TABLE `vista_citas` (
`id_citas` int(11)
,`fecha_y_hora` varchar(45)
,`paciente_asociado` varchar(45)
,`motivo_de_cita` varchar(45)
,`Notas_adicionales` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vista_pacientes`
-- (See below for the actual view)
--
CREATE TABLE `vista_pacientes` (
`id_pacientes` int(11)
,`Nombre` varchar(45)
,`Especie` varchar(45)
,`Raza` varchar(45)
,`Sexo` varchar(45)
,`peso` varchar(45)
,`color` varchar(45)
,`Edad` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vist_pac_vac`
-- (See below for the actual view)
--
CREATE TABLE `vist_pac_vac` (
`id_pacientes` int(11)
,`Nombre` varchar(45)
,`Especie` varchar(45)
,`Raza` varchar(45)
,`Sexo` varchar(45)
,`peso` varchar(45)
,`color` varchar(45)
,`Edad` varchar(50)
,`id_vacunacion` int(11)
,`Tipo_vacuna` varchar(45)
,`fecha_administracion` varchar(45)
,`Prox_fecha_vacunacion` varchar(45)
,`ID_Paciente` varchar(45)
);

-- --------------------------------------------------------

--
-- Structure for view `vista_citas`
--
DROP TABLE IF EXISTS `vista_citas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_citas`  AS SELECT `citas`.`id_citas` AS `id_citas`, `citas`.`fecha_y_hora` AS `fecha_y_hora`, `citas`.`paciente_asociado` AS `paciente_asociado`, `citas`.`motivo_de_cita` AS `motivo_de_cita`, `citas`.`Notas_adicionales` AS `Notas_adicionales` FROM `citas` ;

-- --------------------------------------------------------

--
-- Structure for view `vista_pacientes`
--
DROP TABLE IF EXISTS `vista_pacientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_pacientes`  AS SELECT `pacientes`.`id_pacientes` AS `id_pacientes`, `pacientes`.`Nombre` AS `Nombre`, `pacientes`.`Especie` AS `Especie`, `pacientes`.`Raza` AS `Raza`, `pacientes`.`Sexo` AS `Sexo`, `pacientes`.`peso` AS `peso`, `pacientes`.`color` AS `color`, `pacientes`.`Edad` AS `Edad` FROM `pacientes` ;

-- --------------------------------------------------------

--
-- Structure for view `vist_pac_vac`
--
DROP TABLE IF EXISTS `vist_pac_vac`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vist_pac_vac`  AS SELECT `pacientes`.`id_pacientes` AS `id_pacientes`, `pacientes`.`Nombre` AS `Nombre`, `pacientes`.`Especie` AS `Especie`, `pacientes`.`Raza` AS `Raza`, `pacientes`.`Sexo` AS `Sexo`, `pacientes`.`peso` AS `peso`, `pacientes`.`color` AS `color`, `pacientes`.`Edad` AS `Edad`, `registro_de_vacunacion`.`id_vacunacion` AS `id_vacunacion`, `registro_de_vacunacion`.`Tipo_vacuna` AS `Tipo_vacuna`, `registro_de_vacunacion`.`fecha_administracion` AS `fecha_administracion`, `registro_de_vacunacion`.`Prox_fecha_vacunacion` AS `Prox_fecha_vacunacion`, `registro_de_vacunacion`.`ID_Paciente` AS `ID_Paciente` FROM (`pacientes` join `registro_de_vacunacion` on(`pacientes`.`id_pacientes` = `registro_de_vacunacion`.`id_vacunacion`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_citas`);

--
-- Indexes for table `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historial_medico`
--
ALTER TABLE `historial_medico`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventario_medicamentos`
--
ALTER TABLE `inventario_medicamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_pacientes`);

--
-- Indexes for table `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id_personal`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_productos`);

--
-- Indexes for table `propietarios`
--
ALTER TABLE `propietarios`
  ADD PRIMARY KEY (`id_prop`);

--
-- Indexes for table `registro_de_vacunacion`
--
ALTER TABLE `registro_de_vacunacion`
  ADD PRIMARY KEY (`id_vacunacion`);

--
-- Indexes for table `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD PRIMARY KEY (`id_tratamiento`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `citas`
--
ALTER TABLE `citas`
  MODIFY `id_citas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `historial_medico`
--
ALTER TABLE `historial_medico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventario_medicamentos`
--
ALTER TABLE `inventario_medicamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_pacientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal`
--
ALTER TABLE `personal`
  MODIFY `id_personal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id_productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `propietarios`
--
ALTER TABLE `propietarios`
  MODIFY `id_prop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `registro_de_vacunacion`
--
ALTER TABLE `registro_de_vacunacion`
  MODIFY `id_vacunacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tratamientos`
--
ALTER TABLE `tratamientos`
  MODIFY `id_tratamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
