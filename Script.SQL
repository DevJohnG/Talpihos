CREATE DATABASE Hospital;

USE Hospital;


CREATE TABLE Paises(
    id_pais INT AUTO_INCREMENT PRIMARY KEY,
    pais VARCHAR(50)
);

CREATE TABLE Ciudades(
    id_ciudad INT AUTO_INCREMENT PRIMARY KEY,
    ciudad VARCHAR(50),

    /* FOREIGN KEYS */
    id_pais INT,
    FOREIGN KEY (id_pais) REFERENCES Paises(id_pais) ON DELETE CASCADE
);

CREATE TABLE Distritos(
    id_distrito INT AUTO_INCREMENT PRIMARY KEY,
    distrito VARCHAR(50),

    /* FOREIGN KEYS */
    id_ciudad INT,
    FOREIGN KEY (id_ciudad) REFERENCES Ciudades(id_ciudad) ON DELETE CASCADE
);

CREATE TABLE Corregimientos(
    id_corregimiento INT AUTO_INCREMENT PRIMARY KEY,
    corregimiento VARCHAR(50),

    /* FOREIGN KEYS */
    id_distrito INT,
    FOREIGN KEY (id_distrito) REFERENCES Distritos(id_distrito) ON DELETE CASCADE
);

CREATE TABLE Edificios ( 
    id_edificio INT AUTO_INCREMENT PRIMARY KEY,
    nombre_edificio VARCHAR(100),
    
    /* FOREIGN KEYS*/
    id_corregimiento INT,
    FOREIGN KEY (id_corregimiento) REFERENCES Corregimientos(id_corregimiento)
);

CREATE TABLE Direcciones (
    id_direccion INT AUTO_INCREMENT PRIMARY KEY,
    calle VARCHAR(100),
    noCasa VARCHAR(100),

    /* FOREIGN KEYS */
    id_corregimiento INT,
    id_edificio INT, /* Si corresponde */
    FOREIGN KEY (id_corregimiento) REFERENCES Corregimientos(id_corregimiento) ON DELETE SET NULL,
    FOREIGN KEY (id_edificio) REFERENCES Edificios(id_edificio)

);

CREATE TABLE Departamentos(
    id_departamento INT AUTO_INCREMENT PRIMARY KEY,
    nombre_departamento VARCHAR(50),
    descripcion_departamento VARCHAR(100)
);


CREATE TABLE Cargos (
    id_cargo INT AUTO_INCREMENT PRIMARY KEY,
    nombre_cargo VARCHAR(100) NOT NULL,
    descripcion_cargo VARCHAR(200)
);

CREATE TABLE Cargos_Departamentos(
    id INT AUTO_INCREMENT PRIMARY KEY,

    /* FOREIGN KEYS */
    id_departamento INT,
    id_cargo INT,
    FOREIGN KEY (id_departamento) REFERENCES Departamentos(id_departamento) ON DELETE CASCADE,
    FOREIGN KEY (id_cargo) REFERENCES Cargos(id_cargo) ON DELETE CASCADE
);

CREATE TABLE Jornadas_Laborales(
    id_jornada_laboral INT AUTO_INCREMENT PRIMARY KEY,
    nombre_jornada VARCHAR(20), -- diurno, nocturno, mixto
    descripcion VARCHAR(50)    
);

CREATE TABLE Sub_Especialidades(
    id_subEspecialidad INT AUTO_INCREMENT PRIMARY KEY,
    nombre_subEspecialidad VARCHAR(100), -- Ej: cardiología intervencionista
    descripcion_subEspecialidad VARCHAR(100)
);

CREATE TABLE Areas_Medicas(
    id_area_medica INT AUTO_INCREMENT PRIMARY KEY,
    nombre_area_medica VARCHAR(50),
    descripcion_areaMedica VARCHAR(50)
);

CREATE TABLE Especialidades (
    id_especialidad INT AUTO_INCREMENT PRIMARY KEY,
    nombre_especialidad VARCHAR(100) NOT NULL, -- Ej: cardiología
    descripcion_especialidad VARCHAR(200),
    

    /* FOREIGN KEYS */
    id_subEspecialidad INT,
    id_area_medica INT,
    FOREIGN KEY (id_area_medica) REFERENCES Areas_Medicas(id_area_medica) ON DELETE SET NULL,
    FOREIGN KEY (id_subEspecialidad) REFERENCES Sub_Especialidades(id_subEspecialidad) ON DELETE SET NULL

);

CREATE TABLE Persona(
    id_persona INT AUTO_INCREMENT PRIMARY KEY,
    cedula  VARCHAR(50) UNIQUE NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    genero VARCHAR(25) NOT NULL,
    nacionalidad VARCHAR(100) NOT NULL
    
);

CREATE TABLE Personal (
    id_personal INT AUTO_INCREMENT PRIMARY KEY,
        
    /* FOREIGN KEYS */
    id_persona INT NOT NULL,
    id_especialidad INT,
    id_cargo INT,
    id_direccion INT,
    id_jornada_laboral INT,
    FOREIGN KEY (id_especialidad) REFERENCES Especialidades(id_especialidad) ON DELETE SET NULL,
    FOREIGN KEY (id_cargo) REFERENCES Cargos(id_cargo) ON DELETE SET NULL,
    FOREIGN KEY (id_direccion) REFERENCES Direcciones(id_direccion) ON DELETE SET NULL,
    FOREIGN KEY (id_persona) REFERENCES Persona(id_persona) ON DELETE CASCADE,
    FOREIGN KEY (id_jornada_laboral) REFERENCES Jornadas_Laborales(id_jornada_laboral) ON DELETE SET NULL
);


CREATE TABLE TiposDeSangre (
    id_tipo_sangre INT AUTO_INCREMENT PRIMARY KEY,
    tipo_sangre VARCHAR(10) UNIQUE -- Ej: 'A+', 'O-', etc.
);

CREATE TABLE Pacientes (
    id_paciente INT AUTO_INCREMENT PRIMARY KEY,

    /* FOREIGN KEYS */
    id_direccion INT,
    id_persona INT NOT NULL,
    id_tipo_sangre INT,
    FOREIGN KEY (id_persona) REFERENCES Persona(id_persona) ON DELETE CASCADE,
    FOREIGN KEY (id_direccion) REFERENCES Direcciones(id_direccion) ON DELETE SET NULL,
    FOREIGN KEY (id_tipo_sangre) REFERENCES TiposDeSangre(id_tipo_sangre) ON DELETE SET NULL
);


CREATE TABLE Seguros (
    id_seguro INT AUTO_INCREMENT PRIMARY KEY,
    nombre_seguro VARCHAR(100), 
    tipo_seguro ENUM('social', 'privado'), -- pueden ser mas idk
    numero_poliza VARCHAR(100) UNIQUE,
    
    /* FOREIGN KEYS */
    id_paciente INT, 
    FOREIGN KEY (id_paciente) REFERENCES Pacientes(id_paciente) ON DELETE CASCADE
);


CREATE TABLE Permisos (
    id_permiso INT AUTO_INCREMENT PRIMARY KEY,
    nombre_permiso VARCHAR(100),
    tipo_permiso ENUM('lectura', 'escritura', 'eliminacion', 'creacion', 'actualizacion', 'acceso_completo'),
    descripcion VARCHAR(255)
);

CREATE TABLE Diagnosticos (
    id_diagnostico INT AUTO_INCREMENT PRIMARY KEY,
    descripcion TEXT NOT NULL
);


CREATE TABLE EventosMedicos (
    id_evento_medico INT AUTO_INCREMENT PRIMARY KEY,
    fecha_evento DATETIME,
    descripcion TEXT,
    tipo VARCHAR(50), -- registrar eventos de un paciente: examenes, cirugias, medicamentos administrados, etc 

    
    /* FOREIGN KEYS */
    id_paciente INT,
    id_personal INT,
    FOREIGN KEY (id_paciente) REFERENCES Pacientes(id_paciente) ON DELETE CASCADE,
    FOREIGN KEY (id_personal) REFERENCES Personal(id_personal) ON DELETE SET NULL
);


CREATE TABLE HistorialClinico (
    id_historial INT AUTO_INCREMENT PRIMARY KEY,
    descripcion TEXT,
    fecha DATE,
    
    /* FOREIGN KEYS */
    id_paciente INT NOT NULL,
    id_personal INT,
    id_diagnostico INT,
    id_evento_medico INT,
    
    FOREIGN KEY (id_evento_medico) REFERENCES EventosMedicos(id_evento_medico) ON DELETE SET NULL,
    FOREIGN KEY (id_personal) REFERENCES Personal(id_personal) ON DELETE SET NULL,
    FOREIGN KEY (id_paciente) REFERENCES Pacientes(id_paciente) ON DELETE CASCADE,
    FOREIGN KEY (id_diagnostico) REFERENCES Diagnosticos(id_diagnostico) ON DELETE SET NULL
);


CREATE TABLE Servicios (
    id_servicio INT AUTO_INCREMENT PRIMARY KEY,
    nombre_servicio VARCHAR(50) UNIQUE,
    precio FLOAT,

    /* FOREIGN KEYS */
    id_especialidad INT,
    FOREIGN KEY (id_especialidad) REFERENCES Especialidades (id_especialidad) ON DELETE SET NULL
);

CREATE TABLE Servicios_Prestados(
    id_servicioPrestado INT AUTO_INCREMENT PRIMARY KEY,
    descripcion TEXT,

    /* FOREIGN KEYS */
    id_servicio INT,
    id_paciente INT,
    FOREIGN KEY (id_servicio) REFERENCES Servicios(id_servicio) ON DELETE SET NULL,
    FOREIGN KEY (id_paciente) REFERENCES Pacientes(id_paciente) ON DELETE CASCADE
);

CREATE TABLE Citas (
    id_cita INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(100),
    estado ENUM('programada', 'cancelada', 'completada') NOT NULL,

    /* FOREIGN KEYS */
    id_paciente INT,
    id_personal INT,
    FOREIGN KEY (id_paciente) REFERENCES Pacientes (id_paciente) ON DELETE CASCADE,
    FOREIGN KEY (id_personal) REFERENCES Personal (id_personal) ON DELETE SET NULL
);

CREATE TABLE Recetas(
    id_receta INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(100),

    /* FOREIGN KEYS */
    id_historial INT,
    FOREIGN KEY (id_historial) REFERENCES HistorialClinico(id_historial) ON DELETE CASCADE

);

CREATE TABLE Medicamentos (
    id_medicamento INT AUTO_INCREMENT PRIMARY KEY,
    nombre_medicamento VARCHAR(100) NOT NULL,
    dosis VARCHAR(50),
    instrucciones TEXT
);

CREATE TABLE Recetas_Medicamentos (
    id_receta INT,
    id_medicamento INT,
    cantidad INT NOT NULL,
    PRIMARY KEY (id_receta, id_medicamento),

    FOREIGN KEY (id_receta) REFERENCES Recetas(id_receta) ON DELETE CASCADE,
    FOREIGN KEY (id_medicamento) REFERENCES Medicamentos(id_medicamento) ON DELETE CASCADE
);


CREATE TABLE Formas_dePago(
    id_formaDePago INT AUTO_INCREMENT PRIMARY KEY,
    forma_DePago VARCHAR(25)

);

CREATE TABLE Pagos(
    id_pago INT AUTO_INCREMENT PRIMARY KEY,
    descripcion_pago TEXT,
    fecha_pago DATETIME DEFAULT CURRENT_TIMESTAMP,
    monto_pago DECIMAL(10, 2),
    estado ENUM('exitoso', 'pendiente', 'fallido') DEFAULT 'pendiente',


    /* FOREIGN KEYS */
    id_paciente INT,
    id_cita INT,
    id_forma_de_pago INT,
    FOREIGN KEY (id_forma_de_pago) REFERENCES Formas_dePago(id_formaDePago),
    FOREIGN KEY (id_paciente) REFERENCES Pacientes(id_paciente) ON DELETE SET NULL,
    FOREIGN KEY (id_cita) REFERENCES Citas(id_cita) ON DELETE SET NULL
);



/* Sistema */

CREATE TABLE Usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    id_persona INT, -- Vincula el usuario con el empleado
    FOREIGN KEY (id_persona) REFERENCES persona(id_persona)
);

CREATE TABLE Roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(100),
    descripcion VARCHAR(255)
);

CREATE TABLE roles_permisos (
    id_rol INT,
    id_permiso INT,
    PRIMARY KEY (id_rol, id_permiso),
    FOREIGN KEY (id_rol) REFERENCES Roles(id_rol),
    FOREIGN KEY (id_permiso) REFERENCES Permisos(id_permiso)
);

-- Relación usuario-rol
CREATE TABLE usuarios_roles (
    id_usuario INT,
    id_rol INT,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario),
    FOREIGN KEY (id_rol) REFERENCES Roles(id_rol),
    PRIMARY KEY (id_usuario, id_rol)
);

CREATE TABLE PreRegistro (
    id_pre_registro INT AUTO_INCREMENT PRIMARY KEY,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('pendiente', 'aprobado', 'rechazado') NOT NULL DEFAULT 'pendiente',
    observaciones TEXT,
    
    -- Documentos requeridos
    foto_cedula VARCHAR(255),
    foto_poliza VARCHAR(255), 

    
    /* FOREIGN KEYS */
    id_usuario INT, 
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario) ON DELETE CASCADE
);



