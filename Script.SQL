-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping database structure for hospital
CREATE DATABASE IF NOT EXISTS `hospital` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `hospital`;

-- Dumping structure for table hospital.areas_medicas
CREATE TABLE IF NOT EXISTS `areas_medicas` (
  `id_area_medica` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_area_medica` varchar(50) DEFAULT NULL,
  `descripcion_areaMedica` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_area_medica`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.areas_medicas: ~4 rows (approximately)
INSERT INTO `areas_medicas` (`id_area_medica`, `nombre_area_medica`, `descripcion_areaMedica`) VALUES
	(13, 'Medicina Interna', 'Atención integral del adulto y enfermedades intern'),
	(14, 'Cirugía', 'Procedimientos quirúrgicos en diversas especialida'),
	(15, 'Pediatría', 'Atención médica a niños y adolescentes.'),
	(16, 'Ginecología y Obstetricia', 'Cuidado de la salud de la mujer, embarazo y parto.');

-- Dumping structure for table hospital.cargos
CREATE TABLE IF NOT EXISTS `cargos` (
  `id_cargo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cargo` varchar(100) NOT NULL,
  `descripcion_cargo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.cargos: ~7 rows (approximately)
INSERT INTO `cargos` (`id_cargo`, `nombre_cargo`, `descripcion_cargo`) VALUES
	(8, 'Médico General', 'Profesional de la salud que diagnostica y trata enfermedades en pacientes.'),
	(9, 'Pediatra', 'Médico especializado en el tratamiento de niños y adolescentes.'),
	(10, 'Ginecólogo', 'Médico especializado en salud reproductiva femenina y embarazo.'),
	(11, 'Cirujano', 'Médico especializado en realizar procedimientos quirúrgicos.'),
	(12, 'Enfermero', 'Profesional de la salud que asiste a los médicos y cuida de los pacientes.'),
	(13, 'Radiólogo', 'Médico especializado en la interpretación de imágenes médicas.'),
	(14, 'Oncólogo', 'Médico especializado en el tratamiento del cáncer.');

-- Dumping structure for table hospital.cargos_departamentos
CREATE TABLE IF NOT EXISTS `cargos_departamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_departamento` int(11) DEFAULT NULL,
  `id_cargo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_departamento` (`id_departamento`),
  KEY `id_cargo` (`id_cargo`),
  CONSTRAINT `cargos_departamentos_ibfk_1` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id_departamento`) ON DELETE CASCADE,
  CONSTRAINT `cargos_departamentos_ibfk_2` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id_cargo`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.cargos_departamentos: ~0 rows (approximately)

-- Dumping structure for table hospital.citas
CREATE TABLE IF NOT EXISTS `citas` (
  `id_cita` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` enum('programada','cancelada','completada') NOT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_personal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cita`),
  KEY `id_paciente` (`id_paciente`),
  KEY `id_personal` (`id_personal`),
  CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE CASCADE,
  CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`id_personal`) REFERENCES `personal` (`id_personal`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.citas: ~0 rows (approximately)

-- Dumping structure for table hospital.ciudades
CREATE TABLE IF NOT EXISTS `ciudades` (
  `id_ciudad` int(11) NOT NULL AUTO_INCREMENT,
  `ciudad` varchar(50) DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ciudad`),
  KEY `id_pais` (`id_pais`),
  CONSTRAINT `ciudades_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id_pais`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.ciudades: ~0 rows (approximately)

-- Dumping structure for table hospital.corregimientos
CREATE TABLE IF NOT EXISTS `corregimientos` (
  `id_corregimiento` int(11) NOT NULL AUTO_INCREMENT,
  `corregimiento` varchar(50) DEFAULT NULL,
  `id_distrito` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_corregimiento`),
  KEY `id_distrito` (`id_distrito`),
  CONSTRAINT `corregimientos_ibfk_1` FOREIGN KEY (`id_distrito`) REFERENCES `distritos` (`id_distrito`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.corregimientos: ~0 rows (approximately)

-- Dumping structure for table hospital.correos
CREATE TABLE IF NOT EXISTS `correos` (
  `id_correo` int(11) NOT NULL AUTO_INCREMENT,
  `correo_electronico` varchar(100) DEFAULT NULL,
  `cedula` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_correo`),
  UNIQUE KEY `correo_electronico` (`correo_electronico`),
  KEY `cedula` (`cedula`),
  CONSTRAINT `correos_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `persona` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.correos: ~0 rows (approximately)

-- Dumping structure for table hospital.departamentos
CREATE TABLE IF NOT EXISTS `departamentos` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_departamento` varchar(50) DEFAULT NULL,
  `descripcion_departamento` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.departamentos: ~7 rows (approximately)
INSERT INTO `departamentos` (`id_departamento`, `nombre_departamento`, `descripcion_departamento`) VALUES
	(8, 'Emergencias', 'Atención médica urgente y especializada para pacientes críticos.'),
	(9, 'Pediatría', 'Cuidado médico y tratamiento de enfermedades en niños y adolescentes.'),
	(10, 'Ginecología y Obstetricia', 'Cuidado de la salud reproductiva de las mujeres, incluyendo el embarazo.'),
	(11, 'Cirugía', 'Realización de procedimientos quirúrgicos para tratar diversas condiciones.'),
	(12, 'Medicina Interna', 'Diagnóstico y tratamiento de enfermedades en adultos.'),
	(13, 'Radiología', 'Uso de imágenes médicas para el diagnóstico y tratamiento de enfermedades.'),
	(14, 'Oncología', 'Diagnóstico y tratamiento del cáncer.');

-- Dumping structure for table hospital.diagnosticos
CREATE TABLE IF NOT EXISTS `diagnosticos` (
  `id_diagnostico` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id_diagnostico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.diagnosticos: ~0 rows (approximately)

-- Dumping structure for table hospital.direcciones
CREATE TABLE IF NOT EXISTS `direcciones` (
  `id_direccion` int(11) NOT NULL AUTO_INCREMENT,
  `calle` varchar(100) DEFAULT NULL,
  `noCasa` varchar(100) DEFAULT NULL,
  `id_corregimiento` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_direccion`),
  KEY `id_corregimiento` (`id_corregimiento`),
  CONSTRAINT `direcciones_ibfk_1` FOREIGN KEY (`id_corregimiento`) REFERENCES `corregimientos` (`id_corregimiento`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.direcciones: ~0 rows (approximately)

-- Dumping structure for table hospital.distritos
CREATE TABLE IF NOT EXISTS `distritos` (
  `id_distrito` int(11) NOT NULL AUTO_INCREMENT,
  `distrito` varchar(50) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_distrito`),
  KEY `id_ciudad` (`id_ciudad`),
  CONSTRAINT `distritos_ibfk_1` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudades` (`id_ciudad`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.distritos: ~0 rows (approximately)

-- Dumping structure for table hospital.especialidades
CREATE TABLE IF NOT EXISTS `especialidades` (
  `id_especialidad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_especialidad` varchar(100) NOT NULL,
  `descripcion_especialidad` varchar(200) DEFAULT NULL,
  `id_subEspecialidad` int(11) DEFAULT NULL,
  `id_area_medica` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_especialidad`),
  KEY `id_area_medica` (`id_area_medica`),
  KEY `id_subEspecialidad` (`id_subEspecialidad`),
  CONSTRAINT `especialidades_ibfk_1` FOREIGN KEY (`id_area_medica`) REFERENCES `areas_medicas` (`id_area_medica`) ON DELETE SET NULL,
  CONSTRAINT `especialidades_ibfk_2` FOREIGN KEY (`id_subEspecialidad`) REFERENCES `sub_especialidades` (`id_subEspecialidad`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.especialidades: ~0 rows (approximately)

-- Dumping structure for table hospital.eventosmedicos
CREATE TABLE IF NOT EXISTS `eventosmedicos` (
  `id_evento_medico` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_evento` datetime DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_personal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_evento_medico`),
  KEY `id_paciente` (`id_paciente`),
  KEY `id_personal` (`id_personal`),
  CONSTRAINT `eventosmedicos_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE CASCADE,
  CONSTRAINT `eventosmedicos_ibfk_2` FOREIGN KEY (`id_personal`) REFERENCES `personal` (`id_personal`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.eventosmedicos: ~0 rows (approximately)

-- Dumping structure for table hospital.formas_depago
CREATE TABLE IF NOT EXISTS `formas_depago` (
  `id_formaDePago` int(11) NOT NULL AUTO_INCREMENT,
  `forma_DePago` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_formaDePago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.formas_depago: ~0 rows (approximately)

-- Dumping structure for table hospital.historialclinico
CREATE TABLE IF NOT EXISTS `historialclinico` (
  `id_historial` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `id_paciente` int(11) NOT NULL,
  PRIMARY KEY (`id_historial`),
  KEY `id_paciente` (`id_paciente`),
  CONSTRAINT `historialclinico_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.historialclinico: ~1 rows (approximately)
INSERT INTO `historialclinico` (`id_historial`, `descripcion`, `fecha`, `id_paciente`) VALUES
	(5, 'ta awe', '2024-05-09', 3);

-- Dumping structure for table hospital.jornadas_laborales
CREATE TABLE IF NOT EXISTS `jornadas_laborales` (
  `id_jornada_laboral` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_jornada` varchar(20) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_jornada_laboral`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.jornadas_laborales: ~3 rows (approximately)
INSERT INTO `jornadas_laborales` (`id_jornada_laboral`, `nombre_jornada`, `descripcion`) VALUES
	(4, 'Diurno', 'Jornada laboral de día.'),
	(5, 'Nocturno', 'Jornada laboral de noche.'),
	(6, 'Mixto', 'Jornada laboral combinada de día y noche.');

-- Dumping structure for table hospital.medicamentos
CREATE TABLE IF NOT EXISTS `medicamentos` (
  `id_medicamento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_medicamento` varchar(100) NOT NULL,
  `dosis` varchar(50) DEFAULT NULL,
  `instrucciones` text DEFAULT NULL,
  PRIMARY KEY (`id_medicamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.medicamentos: ~0 rows (approximately)

-- Dumping structure for table hospital.pacientes
CREATE TABLE IF NOT EXISTS `pacientes` (
  `id_paciente` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(50) DEFAULT NULL,
  `id_tipo_sangre` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_paciente`),
  KEY `cedula` (`cedula`),
  KEY `id_tipo_sangre` (`id_tipo_sangre`),
  CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `persona` (`cedula`) ON DELETE CASCADE,
  CONSTRAINT `pacientes_ibfk_2` FOREIGN KEY (`id_tipo_sangre`) REFERENCES `tiposdesangre` (`id_tipo_sangre`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.pacientes: ~1 rows (approximately)
INSERT INTO `pacientes` (`id_paciente`, `cedula`, `id_tipo_sangre`) VALUES
	(3, '8-995-2352', NULL);

-- Dumping structure for table hospital.pagos
CREATE TABLE IF NOT EXISTS `pagos` (
  `id_pago` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_pago` text DEFAULT NULL,
  `fecha_pago` datetime DEFAULT current_timestamp(),
  `monto_pago` decimal(10,2) DEFAULT NULL,
  `estado` enum('exitoso','pendiente','fallido') DEFAULT 'pendiente',
  `id_paciente` int(11) DEFAULT NULL,
  `id_cita` int(11) DEFAULT NULL,
  `id_forma_de_pago` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pago`),
  KEY `id_forma_de_pago` (`id_forma_de_pago`),
  KEY `id_paciente` (`id_paciente`),
  KEY `id_cita` (`id_cita`),
  CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_forma_de_pago`) REFERENCES `formas_depago` (`id_formaDePago`),
  CONSTRAINT `pagos_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE SET NULL,
  CONSTRAINT `pagos_ibfk_3` FOREIGN KEY (`id_cita`) REFERENCES `citas` (`id_cita`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.pagos: ~0 rows (approximately)

-- Dumping structure for table hospital.paises
CREATE TABLE IF NOT EXISTS `paises` (
  `id_pais` int(11) NOT NULL AUTO_INCREMENT,
  `pais` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.paises: ~1 rows (approximately)
INSERT INTO `paises` (`id_pais`, `pais`) VALUES
	(2, 'Panamá');

-- Dumping structure for table hospital.permisos
CREATE TABLE IF NOT EXISTS `permisos` (
  `id_permiso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_permiso` varchar(100) DEFAULT NULL,
  `tipo_permiso` enum('lectura','escritura','eliminacion','creacion','actualizacion','acceso_completo') DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_permiso`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.permisos: ~6 rows (approximately)
INSERT INTO `permisos` (`id_permiso`, `nombre_permiso`, `tipo_permiso`, `descripcion`) VALUES
	(7, 'Acceso a Historia Clínica', 'lectura', 'Permite leer la historia clínica del paciente.'),
	(8, 'Modificar Datos del Paciente', 'escritura', 'Permite actualizar la información del paciente en el sistema.'),
	(9, 'Eliminar Registro de Paciente', 'eliminacion', 'Permite eliminar el registro de un paciente del sistema.'),
	(10, 'Crear Nuevo Paciente', 'creacion', 'Permite agregar un nuevo paciente al sistema.'),
	(11, 'Actualizar Datos de Seguro', 'actualizacion', 'Permite actualizar la información del seguro del paciente.'),
	(12, 'Acceso Completo al Sistema', 'acceso_completo', 'Permite acceso total a todas las funcionalidades del sistema.');

-- Dumping structure for table hospital.persona
CREATE TABLE IF NOT EXISTS `persona` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` varchar(25) NOT NULL,
  `nacionalidad` varchar(100) NOT NULL,
  PRIMARY KEY (`cedula`),
  UNIQUE KEY `id_persona` (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.persona: ~11 rows (approximately)
INSERT INTO `persona` (`id_persona`, `cedula`, `nombre`, `apellido`, `fecha_nacimiento`, `genero`, `nacionalidad`) VALUES
	(27, '00-000-1110', 'Doctor', 'admin', '2000-05-09', 'Masculino', 'Panameña'),
	(12, '8-123-4567', 'Juan', 'Pérez', '1985-05-15', 'Masculino', 'Panameña'),
	(13, '8-234-5678', 'María', 'Gómez', '1990-03-22', 'Femenino', 'Panameña'),
	(14, '8-345-6789', 'Luis', 'Martínez', '1978-07-30', 'Masculino', 'Panameña'),
	(15, '8-456-7890', 'Ana', 'Rodríguez', '1995-11-11', 'Femenino', 'Panameña'),
	(16, '8-567-8901', 'Carlos', 'López', '1982-01-20', 'Masculino', 'Panameña'),
	(17, '8-678-9012', 'Laura', 'Fernández', '1998-12-05', 'Femenino', 'Panameña'),
	(18, '8-789-0123', 'Andrés', 'Torres', '1987-06-18', 'Masculino', 'Panameña'),
	(19, '8-890-1234', 'Clara', 'Sánchez', '1992-09-25', 'Femenino', 'Panameña'),
	(20, '8-956-1736', 'Patrick', 'Delgado', '2000-05-09', 'Masculino', 'Panameña'),
	(26, '8-995-2352', 'Gabriela', 'Gonzalez', '2003-06-14', 'masculino', 'Panameña');

-- Dumping structure for table hospital.personal
CREATE TABLE IF NOT EXISTS `personal` (
  `id_personal` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(50) DEFAULT NULL,
  `id_especialidad` int(11) DEFAULT NULL,
  `id_cargo` int(11) DEFAULT NULL,
  `id_jornada_laboral` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_personal`),
  KEY `id_especialidad` (`id_especialidad`),
  KEY `id_cargo` (`id_cargo`),
  KEY `cedula` (`cedula`),
  KEY `id_jornada_laboral` (`id_jornada_laboral`),
  CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id_especialidad`) ON DELETE SET NULL,
  CONSTRAINT `personal_ibfk_2` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id_cargo`) ON DELETE SET NULL,
  CONSTRAINT `personal_ibfk_3` FOREIGN KEY (`cedula`) REFERENCES `persona` (`cedula`) ON DELETE CASCADE,
  CONSTRAINT `personal_ibfk_4` FOREIGN KEY (`id_jornada_laboral`) REFERENCES `jornadas_laborales` (`id_jornada_laboral`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.personal: ~0 rows (approximately)

-- Dumping structure for table hospital.preregistro
CREATE TABLE IF NOT EXISTS `preregistro` (
  `id_pre_registro` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `estado` enum('pendiente','aprobado','rechazado') NOT NULL DEFAULT 'pendiente',
  `observaciones` text DEFAULT NULL,
  `cedula` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` varchar(25) NOT NULL,
  `nacionalidad` varchar(100) NOT NULL,
  `tipo_sangre` varchar(10) NOT NULL,
  `foto_cedula_frontal` varchar(255) DEFAULT NULL,
  `foto_cedula_trasera` varchar(255) DEFAULT NULL,
  `foto_persona_con_cedula` varchar(255) DEFAULT NULL,
  `foto_poliza` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pre_registro`),
  UNIQUE KEY `cedula` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.preregistro: ~1 rows (approximately)
INSERT INTO `preregistro` (`id_pre_registro`, `fecha_registro`, `estado`, `observaciones`, `cedula`, `nombre`, `apellido`, `fecha_nacimiento`, `genero`, `nacionalidad`, `tipo_sangre`, `foto_cedula_frontal`, `foto_cedula_trasera`, `foto_persona_con_cedula`, `foto_poliza`, `correo`) VALUES
	(4, '2024-11-24 22:20:56', 'pendiente', NULL, '00-000-0000', 'Petronila', 'Gonzalez', '2000-05-09', 'femenino', 'Panameña', '11', '../uploads/Balon de oro 1.jpg', '../uploads/champions.jpg', '../uploads/copa america.jpg', NULL, 'gpgo141414@gmail.com');

-- Dumping structure for table hospital.recetas
CREATE TABLE IF NOT EXISTS `recetas` (
  `id_receta` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `id_historial` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_receta`),
  KEY `id_historial` (`id_historial`),
  CONSTRAINT `recetas_ibfk_1` FOREIGN KEY (`id_historial`) REFERENCES `historialclinico` (`id_historial`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.recetas: ~0 rows (approximately)

-- Dumping structure for table hospital.recetas_medicamentos
CREATE TABLE IF NOT EXISTS `recetas_medicamentos` (
  `id_receta` int(11) NOT NULL,
  `id_medicamento` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id_receta`,`id_medicamento`),
  KEY `id_medicamento` (`id_medicamento`),
  CONSTRAINT `recetas_medicamentos_ibfk_1` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id_receta`) ON DELETE CASCADE,
  CONSTRAINT `recetas_medicamentos_ibfk_2` FOREIGN KEY (`id_medicamento`) REFERENCES `medicamentos` (`id_medicamento`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.recetas_medicamentos: ~0 rows (approximately)

-- Dumping structure for table hospital.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(100) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.roles: ~8 rows (approximately)
INSERT INTO `roles` (`id_rol`, `nombre_rol`, `descripcion`) VALUES
	(10, 'SuperUsuario', 'Tiene acceso total al sistema, incluyendo la administración de usuarios y permisos'),
	(11, 'Administrador', 'Gestiona las operaciones del hospital, incluyendo la administración de personal y recursos'),
	(12, 'Doctor', 'Médico encargado de la atención y tratamiento de los pacientes'),
	(13, 'Enfermero', 'Responsable de la atención básica de los pacientes bajo la supervisión de los doctores'),
	(14, 'Recepcionista', 'Gestiona la recepción de pacientes y la organización de citas'),
	(15, 'Farmacéutico', 'Encargado de la distribución y control de los medicamentos'),
	(16, 'Paciente', 'Acceso limitado al sistema para revisar su historial médico y agendar citas'),
	(17, 'Técnico de laboratorio', 'Encargado de realizar análisis clínicos y entregar resultados a los doctores');

-- Dumping structure for table hospital.roles_permisos
CREATE TABLE IF NOT EXISTS `roles_permisos` (
  `id_rol` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  PRIMARY KEY (`id_rol`,`id_permiso`),
  KEY `id_permiso` (`id_permiso`),
  CONSTRAINT `roles_permisos_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`),
  CONSTRAINT `roles_permisos_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.roles_permisos: ~16 rows (approximately)
INSERT INTO `roles_permisos` (`id_rol`, `id_permiso`) VALUES
	(10, 7),
	(11, 8),
	(11, 9),
	(12, 7),
	(12, 8),
	(12, 9),
	(12, 10),
	(12, 11),
	(13, 9),
	(13, 10),
	(14, 7),
	(14, 8),
	(14, 9),
	(14, 10),
	(14, 11),
	(14, 12);

-- Dumping structure for table hospital.seguros
CREATE TABLE IF NOT EXISTS `seguros` (
  `id_seguro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_seguro` varchar(100) DEFAULT NULL,
  `tipo_seguro` enum('social','privado') DEFAULT NULL,
  `numero_poliza` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_seguro`),
  UNIQUE KEY `numero_poliza` (`numero_poliza`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.seguros: ~0 rows (approximately)

-- Dumping structure for table hospital.seguros_paciente
CREATE TABLE IF NOT EXISTS `seguros_paciente` (
  `id_seguros_paciente` int(11) NOT NULL AUTO_INCREMENT,
  `id_seguro` int(11) DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  PRIMARY KEY (`id_seguros_paciente`),
  KEY `id_seguro` (`id_seguro`),
  KEY `id_paciente` (`id_paciente`),
  CONSTRAINT `seguros_paciente_ibfk_1` FOREIGN KEY (`id_seguro`) REFERENCES `seguros` (`id_seguro`) ON DELETE CASCADE,
  CONSTRAINT `seguros_paciente_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.seguros_paciente: ~0 rows (approximately)

-- Dumping structure for table hospital.servicios
CREATE TABLE IF NOT EXISTS `servicios` (
  `id_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_servicio` varchar(50) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `id_especialidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_servicio`),
  UNIQUE KEY `nombre_servicio` (`nombre_servicio`),
  KEY `id_especialidad` (`id_especialidad`),
  CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id_especialidad`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.servicios: ~0 rows (approximately)

-- Dumping structure for table hospital.servicios_prestados
CREATE TABLE IF NOT EXISTS `servicios_prestados` (
  `id_servicioPrestado` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text DEFAULT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_servicioPrestado`),
  KEY `id_servicio` (`id_servicio`),
  KEY `id_paciente` (`id_paciente`),
  CONSTRAINT `servicios_prestados_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicio`) ON DELETE SET NULL,
  CONSTRAINT `servicios_prestados_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.servicios_prestados: ~0 rows (approximately)

-- Dumping structure for table hospital.sub_especialidades
CREATE TABLE IF NOT EXISTS `sub_especialidades` (
  `id_subEspecialidad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_subEspecialidad` varchar(100) DEFAULT NULL,
  `descripcion_subEspecialidad` varchar(100) DEFAULT NULL,
  `id_area_medica` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_subEspecialidad`),
  KEY `id_area_medica` (`id_area_medica`),
  CONSTRAINT `sub_especialidades_ibfk_1` FOREIGN KEY (`id_area_medica`) REFERENCES `areas_medicas` (`id_area_medica`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.sub_especialidades: ~5 rows (approximately)
INSERT INTO `sub_especialidades` (`id_subEspecialidad`, `nombre_subEspecialidad`, `descripcion_subEspecialidad`, `id_area_medica`) VALUES
	(34, 'Cardiología Intervencionista', 'Procedimientos invasivos para tratar enfermedades cardíacas.', NULL),
	(35, 'Neurocirugía', 'Cirugía en el sistema nervioso.', NULL),
	(36, 'Gastroenterología', 'Diagnóstico y tratamiento de enfermedades del sistema digestivo.', NULL),
	(37, 'Endocrinología', 'Tratamiento de trastornos hormonales y metabólicos.', NULL),
	(38, 'Oncología Médica', 'Tratamiento del cáncer mediante medicamentos y terapias sistémicas.', NULL);

-- Dumping structure for table hospital.tiposdesangre
CREATE TABLE IF NOT EXISTS `tiposdesangre` (
  `id_tipo_sangre` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_sangre` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_sangre`),
  UNIQUE KEY `tipo_sangre` (`tipo_sangre`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.tiposdesangre: ~8 rows (approximately)
INSERT INTO `tiposdesangre` (`id_tipo_sangre`, `tipo_sangre`) VALUES
	(9, 'A+'),
	(10, 'A-'),
	(13, 'AB+'),
	(14, 'AB-'),
	(11, 'B+'),
	(12, 'B-'),
	(15, 'O+'),
	(16, 'O-');

-- Dumping structure for table hospital.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `cedula` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `cedula` (`cedula`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `persona` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.usuarios: ~11 rows (approximately)
INSERT INTO `usuarios` (`id_usuario`, `username`, `password`, `cedula`, `email`) VALUES
	(12, 'juan.perez', 'password1', '8-123-4567', NULL),
	(13, 'maria.gomez', 'password2', '8-234-5678', NULL),
	(14, 'luis.martinez', 'password3', '8-345-6789', NULL),
	(15, 'ana.rodriguez', 'password4', '8-456-7890', NULL),
	(16, 'carlos.lopez', 'password5', '8-567-8901', NULL),
	(17, 'laura.fernandez', 'password6', '8-678-9012', NULL),
	(18, 'andres.torres', 'password7', '8-789-0123', NULL),
	(19, 'clara.sanchez', 'password8', '8-890-1234', NULL),
	(24, 'gabriela.gonzalez', '$2y$10$BOEu0hjAdXY1Cfqvj5UVRe0XivOC1HpHsN86q4kLm2wQrW52Y.A9W', '8-995-2352', 'gpgo1414@gmail.com'),
	(26, 'paatrick09', '$2y$10$OMMZ.Z7oEyfAFQ.Y5NLfcuEWvGG8KlKphVMumz4Qg25jSrR9v4wyi', '8-956-1736', 'patrickpd540@gmail.com'),
	(27, 'doctorAdmin', '$2y$10$uAUZ5W4colAaR.TbYFh27.upOvlHuVZNu4vPatsO1HM4Rse.XPCTm', '00-000-1110', 'patrickpd54000@gmail.com');

-- Dumping structure for table hospital.usuarios_roles
CREATE TABLE IF NOT EXISTS `usuarios_roles` (
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`,`id_rol`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuarios_roles_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `usuarios_roles_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table hospital.usuarios_roles: ~7 rows (approximately)
INSERT INTO `usuarios_roles` (`id_usuario`, `id_rol`) VALUES
	(12, 12),
	(13, 10),
	(14, 11),
	(15, 12),
	(24, 16),
	(26, 10),
	(27, 12);


CREATE TABLE disponibilidad (
    id_disponibilidad INT AUTO_INCREMENT PRIMARY KEY,
    id_personal INT NOT NULL, 
    fecha DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    estado ENUM('disponible', 'ocupado') DEFAULT 'disponible', 
    FOREIGN KEY (id_personal) REFERENCES personal(id_personal) ON DELETE CASCADE
);

ALTER TABLE Jornadas_Laborales
ADD COLUMN hora_inicio TIME,
ADD COLUMN hora_fin TIME;

ALTER TABLE citas ADD COLUMN id_disponibilidad INT DEFAULT NULL;
ALTER TABLE citas ADD CONSTRAINT fk_citas_disponibilidad
    FOREIGN KEY (id_disponibilidad) REFERENCES disponibilidad(id_disponibilidad)
    ON DELETE SET NULL;
/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
