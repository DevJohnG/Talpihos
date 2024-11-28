CREATE DATABASE IF NOT EXISTS `hospital` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `hospital`;

-- Dumping structure for table hospital.areas_medicas
CREATE TABLE IF NOT EXISTS `areas_medicas` (
  `id_area_medica` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_area_medica` varchar(50) DEFAULT NULL,
  `descripcion_areaMedica` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_area_medica`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table hospital.cargos
CREATE TABLE IF NOT EXISTS `cargos` (
  `id_cargo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cargo` varchar(100) NOT NULL,
  `descripcion_cargo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

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

-- Data exporting was unselected.

-- Dumping structure for table hospital.ciudades
CREATE TABLE IF NOT EXISTS `ciudades` (
  `id_ciudad` int(11) NOT NULL AUTO_INCREMENT,
  `ciudad` varchar(50) DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ciudad`),
  KEY `id_pais` (`id_pais`),
  CONSTRAINT `ciudades_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id_pais`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table hospital.corregimientos
CREATE TABLE IF NOT EXISTS `corregimientos` (
  `id_corregimiento` int(11) NOT NULL AUTO_INCREMENT,
  `corregimiento` varchar(50) DEFAULT NULL,
  `id_distrito` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_corregimiento`),
  KEY `id_distrito` (`id_distrito`),
  CONSTRAINT `corregimientos_ibfk_1` FOREIGN KEY (`id_distrito`) REFERENCES `distritos` (`id_distrito`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

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

-- Data exporting was unselected.

-- Dumping structure for table hospital.departamentos
CREATE TABLE IF NOT EXISTS `departamentos` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_departamento` varchar(50) DEFAULT NULL,
  `descripcion_departamento` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table hospital.diagnosticos
CREATE TABLE IF NOT EXISTS `diagnosticos` (
  `id_diagnostico` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id_diagnostico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

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

-- Data exporting was unselected.

-- Dumping structure for table hospital.distritos
CREATE TABLE IF NOT EXISTS `distritos` (
  `id_distrito` int(11) NOT NULL AUTO_INCREMENT,
  `distrito` varchar(50) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_distrito`),
  KEY `id_ciudad` (`id_ciudad`),
  CONSTRAINT `distritos_ibfk_1` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudades` (`id_ciudad`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

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

-- Data exporting was unselected.

-- Dumping structure for table hospital.formas_depago
CREATE TABLE IF NOT EXISTS `formas_depago` (
  `id_formaDePago` int(11) NOT NULL AUTO_INCREMENT,
  `forma_DePago` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_formaDePago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table hospital.historialclinico
CREATE TABLE IF NOT EXISTS `historialclinico` (
  `id_historial` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `id_paciente` int(11) NOT NULL,
  PRIMARY KEY (`id_historial`),
  KEY `id_paciente` (`id_paciente`),
  CONSTRAINT `historialclinico_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table hospital.jornadas_laborales
CREATE TABLE IF NOT EXISTS `jornadas_laborales` (
  `id_jornada_laboral` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_jornada` varchar(20) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_jornada_laboral`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table hospital.medicamentos
CREATE TABLE IF NOT EXISTS `medicamentos` (
  `id_medicamento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_medicamento` varchar(100) NOT NULL,
  `dosis` varchar(50) DEFAULT NULL,
  `instrucciones` text DEFAULT NULL,
  PRIMARY KEY (`id_medicamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

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

-- Data exporting was unselected.

-- Dumping structure for table hospital.paises
CREATE TABLE IF NOT EXISTS `paises` (
  `id_pais` int(11) NOT NULL AUTO_INCREMENT,
  `pais` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table hospital.permisos
CREATE TABLE IF NOT EXISTS `permisos` (
  `id_permiso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_permiso` varchar(100) DEFAULT NULL,
  `tipo_permiso` enum('lectura','escritura','eliminacion','creacion','actualizacion','acceso_completo') DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_permiso`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

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

-- Data exporting was unselected.

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table hospital.recetas
CREATE TABLE IF NOT EXISTS `recetas` (
  `id_receta` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `id_historial` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_receta`),
  KEY `id_historial` (`id_historial`),
  CONSTRAINT `recetas_ibfk_1` FOREIGN KEY (`id_historial`) REFERENCES `historialclinico` (`id_historial`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

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

-- Data exporting was unselected.

-- Dumping structure for table hospital.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(100) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table hospital.roles_permisos
CREATE TABLE IF NOT EXISTS `roles_permisos` (
  `id_rol` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  PRIMARY KEY (`id_rol`,`id_permiso`),
  KEY `id_permiso` (`id_permiso`),
  CONSTRAINT `roles_permisos_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`),
  CONSTRAINT `roles_permisos_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table hospital.seguros
CREATE TABLE IF NOT EXISTS `seguros` (
  `id_seguro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_seguro` varchar(100) DEFAULT NULL,
  `tipo_seguro` enum('social','privado') DEFAULT NULL,
  `numero_poliza` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_seguro`),
  UNIQUE KEY `numero_poliza` (`numero_poliza`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

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

-- Data exporting was unselected.

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

-- Data exporting was unselected.

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

-- Data exporting was unselected.

-- Dumping structure for table hospital.sub_especialidades
CREATE TABLE IF NOT EXISTS `sub_especialidades` (
  `id_subEspecialidad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_subEspecialidad` varchar(100) DEFAULT NULL,
  `descripcion_subEspecialidad` varchar(100) DEFAULT NULL,
  `id_area_medica` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_subEspecialidad`),
  KEY `id_area_medica` (`id_area_medica`),
  CONSTRAINT `sub_especialidades_ibfk_1` FOREIGN KEY (`id_area_medica`) REFERENCES `areas_medicas` (`id_area_medica`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table hospital.tiposdesangre
CREATE TABLE IF NOT EXISTS `tiposdesangre` (
  `id_tipo_sangre` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_sangre` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_sangre`),
  UNIQUE KEY `tipo_sangre` (`tipo_sangre`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table hospital.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `cedula` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `username` (`username`),
  KEY `cedula` (`cedula`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `persona` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table hospital.usuarios_roles
CREATE TABLE IF NOT EXISTS `usuarios_roles` (
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`,`id_rol`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuarios_roles_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `usuarios_roles_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

message.txt
22 KB


CREATE TABLE disponibilidad (
    id_disponibilidad INT AUTO_INCREMENT PRIMARY KEY,
    id_personal INT NOT NULL, -- Médico
    fecha DATE NOT NULL, -- Día de trabajo
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
    ON DELETE SET NULL;

ALTER TABLE `usuarios`
ADD COLUMN `email` varchar(100) DEFAULT NULL AFTER `cedula`,
ADD UNIQUE KEY `email` (`email`);