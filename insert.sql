-- Insertar los países (en este caso, solo Panamá)
INSERT INTO Paises (pais) VALUES ('Panamá');

-- Insertar las ciudades de Panamá
INSERT INTO Ciudades (ciudad, id_pais) VALUES ('Ciudad de Panamá', 1);
INSERT INTO Ciudades (ciudad, id_pais) VALUES ('Colón', 1);
INSERT INTO Ciudades (ciudad, id_pais) VALUES ('David', 1);
INSERT INTO Ciudades (ciudad, id_pais) VALUES ('Santiago', 1);
INSERT INTO Ciudades (ciudad, id_pais) VALUES ('Chitré', 1);
INSERT INTO Ciudades (ciudad, id_pais) VALUES ('La Chorrera', 1);
INSERT INTO Ciudades (ciudad, id_pais) VALUES ('Penonomé', 1);
INSERT INTO Ciudades (ciudad, id_pais) VALUES ('Las Tablas', 1);
INSERT INTO Ciudades (ciudad, id_pais) VALUES ('Aguadulce', 1);
INSERT INTO Ciudades (ciudad, id_pais) VALUES ('Changuinola', 1);
INSERT INTO Ciudades (ciudad, id_pais) VALUES ('Puerto Armuelles', 1);
INSERT INTO Ciudades (ciudad, id_pais) VALUES ('Sona', 1);
INSERT INTO Ciudades (ciudad, id_pais) VALUES ('Almirante', 1);
---------------------------------------------------

-- Insertar distritos en Panamá
INSERT INTO Distritos (distrito, id_ciudad) VALUES ('Panamá', 1);
INSERT INTO Distritos (distrito, id_ciudad) VALUES ('Colón', 2);
INSERT INTO Distritos (distrito, id_ciudad) VALUES ('Chiriquí', 3);
INSERT INTO Distritos (distrito, id_ciudad) VALUES ('Veraguas', 4);
INSERT INTO Distritos (distrito, id_ciudad) VALUES ('Herrera', 5);
INSERT INTO Distritos (distrito, id_ciudad) VALUES ('Los Santos', 6);
INSERT INTO Distritos (distrito, id_ciudad) VALUES ('Coclé', 7);
INSERT INTO Distritos (distrito, id_ciudad) VALUES ('Bocas del Toro', 8);
INSERT INTO Distritos (distrito, id_ciudad) VALUES ('Darién', 9);
INSERT INTO Distritos (distrito, id_ciudad) VALUES ('San Miguelito', 1);

-- Insertar corregimientos en los distritos (ejemplos)
INSERT INTO Corregimientos (corregimiento, id_distrito) VALUES ('San Felipe', 1);
INSERT INTO Corregimientos (corregimiento, id_distrito) VALUES ('Bella Vista', 1);
INSERT INTO Corregimientos (corregimiento, id_distrito) VALUES ('Coclé', 7);
INSERT INTO Corregimientos (corregimiento, id_distrito) VALUES ('La Chorrera', 1);
INSERT INTO Corregimientos (corregimiento, id_distrito) VALUES ('David', 3);
INSERT INTO Corregimientos (corregimiento, id_distrito) VALUES ('Colon', 2);
INSERT INTO Corregimientos (corregimiento, id_distrito) VALUES ('Chitré', 5);
INSERT INTO Corregimientos (corregimiento, id_distrito) VALUES ('Las Tablas', 6);
INSERT INTO Corregimientos (corregimiento, id_distrito) VALUES ('La Palma', 9);
INSERT INTO Corregimientos (corregimiento, id_distrito) VALUES ('Changuinola', 8);



-- Insertar direcciones en los corregimientos y edificios
INSERT INTO Direcciones (calle, noCasa, id_corregimiento, id_edificio) VALUES ('Calle 50', 'Apt. 101', 1, 1);
INSERT INTO Direcciones (calle, noCasa, id_corregimiento, id_edificio) VALUES ('Avenida Balboa', 'No. 5', 1, 2);
INSERT INTO Direcciones (calle, noCasa, id_corregimiento, id_edificio) VALUES ('Calle 5 de Mayo', 'Casa 7', 1, 3);
INSERT INTO Direcciones (calle, noCasa, id_corregimiento, id_edificio) VALUES ('Calle Central', 'Casa 15', 3, NULL);
INSERT INTO Direcciones (calle, noCasa, id_corregimiento, id_edificio) VALUES ('Avenida Santa Rosa', 'Casa 20', 5, 6);
INSERT INTO Direcciones (calle, noCasa, id_corregimiento, id_edificio) VALUES ('Calle Chiriquí', 'Casa 9', 3, NULL);
INSERT INTO Direcciones (calle, noCasa, id_corregimiento, id_edificio) VALUES ('Calle del Mar', 'Casa 12', 9, 7);

-- Insertar departamentos en un hospital
INSERT INTO Departamentos (nombre_departamento, descripcion_departamento) VALUES ('Emergencias', 'Atención médica urgente y especializada para pacientes críticos.');
INSERT INTO Departamentos (nombre_departamento, descripcion_departamento) VALUES ('Pediatría', 'Cuidado médico y tratamiento de enfermedades en niños y adolescentes.');
INSERT INTO Departamentos (nombre_departamento, descripcion_departamento) VALUES ('Ginecología y Obstetricia', 'Cuidado de la salud reproductiva de las mujeres, incluyendo el embarazo.');
INSERT INTO Departamentos (nombre_departamento, descripcion_departamento) VALUES ('Cirugía', 'Realización de procedimientos quirúrgicos para tratar diversas condiciones.');
INSERT INTO Departamentos (nombre_departamento, descripcion_departamento) VALUES ('Medicina Interna', 'Diagnóstico y tratamiento de enfermedades en adultos.');
INSERT INTO Departamentos (nombre_departamento, descripcion_departamento) VALUES ('Radiología', 'Uso de imágenes médicas para el diagnóstico y tratamiento de enfermedades.');
INSERT INTO Departamentos (nombre_departamento, descripcion_departamento) VALUES ('Oncología', 'Diagnóstico y tratamiento del cáncer.');

-- Insertar cargos en un hospital
INSERT INTO Cargos (nombre_cargo, descripcion_cargo) VALUES ('Médico General', 'Profesional de la salud que diagnostica y trata enfermedades en pacientes.');
INSERT INTO Cargos (nombre_cargo, descripcion_cargo) VALUES ('Pediatra', 'Médico especializado en el tratamiento de niños y adolescentes.');
INSERT INTO Cargos (nombre_cargo, descripcion_cargo) VALUES ('Ginecólogo', 'Médico especializado en salud reproductiva femenina y embarazo.');
INSERT INTO Cargos (nombre_cargo, descripcion_cargo) VALUES ('Cirujano', 'Médico especializado en realizar procedimientos quirúrgicos.');
INSERT INTO Cargos (nombre_cargo, descripcion_cargo) VALUES ('Enfermero', 'Profesional de la salud que asiste a los médicos y cuida de los pacientes.');
INSERT INTO Cargos (nombre_cargo, descripcion_cargo) VALUES ('Radiólogo', 'Médico especializado en la interpretación de imágenes médicas.');
INSERT INTO Cargos (nombre_cargo, descripcion_cargo) VALUES ('Oncólogo', 'Médico especializado en el tratamiento del cáncer.');

-- Insertar asociaciones de cargos y departamentos
INSERT INTO Cargos_Departamentos (id_departamento, id_cargo) VALUES (1, 1); -- Emergencias - Médico General
INSERT INTO Cargos_Departamentos (id_departamento, id_cargo) VALUES (1, 5); -- Emergencias - Enfermero
INSERT INTO Cargos_Departamentos (id_departamento, id_cargo) VALUES (2, 2); -- Pediatría - Pediatra
INSERT INTO Cargos_Departamentos (id_departamento, id_cargo) VALUES (2, 5); -- Pediatría - Enfermero
INSERT INTO Cargos_Departamentos (id_departamento, id_cargo) VALUES (3, 3); -- Ginecología - Ginecólogo
INSERT INTO Cargos_Departamentos (id_departamento, id_cargo) VALUES (3, 5); -- Ginecología - Enfermero
INSERT INTO Cargos_Departamentos (id_departamento, id_cargo) VALUES (4, 4); -- Cirugía - Cirujano
INSERT INTO Cargos_Departamentos (id_departamento, id_cargo) VALUES (4, 5); -- Cirugía - Enfermero
INSERT INTO Cargos_Departamentos (id_departamento, id_cargo) VALUES (5, 1); -- Medicina Interna - Médico General
INSERT INTO Cargos_Departamentos (id_departamento, id_cargo) VALUES (6, 6); -- Radiología - Radiólogo
INSERT INTO Cargos_Departamentos (id_departamento, id_cargo) VALUES (7, 7); -- Oncología - Oncólogo

-- Insertar jornadas laborales
INSERT INTO Jornadas_Laborales (nombre_jornada, descripcion) VALUES ('Diurno', 'Jornada laboral de día.');
INSERT INTO Jornadas_Laborales (nombre_jornada, descripcion) VALUES ('Nocturno', 'Jornada laboral de noche.');
INSERT INTO Jornadas_Laborales (nombre_jornada, descripcion) VALUES ('Mixto', 'Jornada laboral combinada de día y noche.');


-- Insertar subespecialidades
INSERT INTO Sub_Especialidades (nombre_subEspecialidad, descripcion_subEspecialidad) VALUES ('Cardiología Intervencionista', 'Procedimientos invasivos para tratar enfermedades cardíacas.');
INSERT INTO Sub_Especialidades (nombre_subEspecialidad, descripcion_subEspecialidad) VALUES ('Neurocirugía', 'Cirugía en el sistema nervioso.');
INSERT INTO Sub_Especialidades (nombre_subEspecialidad, descripcion_subEspecialidad) VALUES ('Gastroenterología', 'Diagnóstico y tratamiento de enfermedades del sistema digestivo.');
INSERT INTO Sub_Especialidades (nombre_subEspecialidad, descripcion_subEspecialidad) VALUES ('Endocrinología', 'Tratamiento de trastornos hormonales y metabólicos.');
INSERT INTO Sub_Especialidades (nombre_subEspecialidad, descripcion_subEspecialidad) VALUES ('Oncología Médica', 'Tratamiento del cáncer mediante medicamentos y terapias sistémicas.');

-- Insertar áreas médicas
INSERT INTO Areas_Medicas (nombre_area_medica, descripcion_areaMedica) VALUES ('Medicina Interna', 'Atención integral del adulto y enfermedades internas.');
INSERT INTO Areas_Medicas (nombre_area_medica, descripcion_areaMedica) VALUES ('Cirugía', 'Procedimientos quirúrgicos en diversas especialidades.');
INSERT INTO Areas_Medicas (nombre_area_medica, descripcion_areaMedica) VALUES ('Pediatría', 'Atención médica a niños y adolescentes.');
INSERT INTO Areas_Medicas (nombre_area_medica, descripcion_areaMedica) VALUES ('Ginecología y Obstetricia', 'Cuidado de la salud de la mujer, embarazo y parto.');

-- Insertar especialidades
INSERT INTO Especialidades (nombre_especialidad, descripcion_especialidad, id_subEspecialidad, id_area_medica) VALUES ('Cardiología', 'Especialidad que trata las enfermedades del corazón y sistema circulatorio.', 1, 1);
INSERT INTO Especialidades (nombre_especialidad, descripcion_especialidad, id_subEspecialidad, id_area_medica) VALUES ('Neurociencia', 'Estudio y tratamiento de los trastornos del sistema nervioso.', 2, 1);
INSERT INTO Especialidades (nombre_especialidad, descripcion_especialidad, id_subEspecialidad, id_area_medica) VALUES ('Gastroenterología', 'Diagnóstico y tratamiento de trastornos del sistema digestivo.', 3, 1);
INSERT INTO Especialidades (nombre_especialidad, descripcion_especialidad, id_subEspecialidad, id_area_medica) VALUES ('Endocrinología', 'Diagnóstico y tratamiento de enfermedades endocrinas.', 4, 1);
INSERT INTO Especialidades (nombre_especialidad, descripcion_especialidad, id_subEspecialidad, id_area_medica) VALUES ('Oncología', 'Diagnóstico y tratamiento del cáncer.', 5, 1);
INSERT INTO Especialidades (nombre_especialidad, descripcion_especialidad, id_subEspecialidad, id_area_medica) VALUES ('Cirugía General', 'Práctica de realizar operaciones quirúrgicas en diferentes áreas.', NULL, 2);
INSERT INTO Especialidades (nombre_especialidad, descripcion_especialidad, id_subEspecialidad, id_area_medica) VALUES ('Pediatría General', 'Cuidado médico integral para niños.', NULL, 3);
INSERT INTO Especialidades (nombre_especialidad, descripcion_especialidad, id_subEspecialidad, id_area_medica) VALUES ('Ginecología', 'Atención médica especializada para la salud de la mujer.', NULL, 4);

-- Insertar datos en la tabla Persona
INSERT INTO Persona (cedula, nombre, apellido, fecha_nacimiento, genero, nacionalidad) VALUES ('8-123-4567', 'Juan', 'Pérez', '1985-05-15', 'Masculino', 'Panameña');
INSERT INTO Persona (cedula, nombre, apellido, fecha_nacimiento, genero, nacionalidad) VALUES ('8-234-5678', 'María', 'Gómez', '1990-03-22', 'Femenino', 'Panameña');
INSERT INTO Persona (cedula, nombre, apellido, fecha_nacimiento, genero, nacionalidad) VALUES ('8-345-6789', 'Luis', 'Martínez', '1978-07-30', 'Masculino', 'Panameña');
INSERT INTO Persona (cedula, nombre, apellido, fecha_nacimiento, genero, nacionalidad) VALUES ('8-456-7890', 'Ana', 'Rodríguez', '1995-11-11', 'Femenino', 'Panameña');
INSERT INTO Persona (cedula, nombre, apellido, fecha_nacimiento, genero, nacionalidad) VALUES ('8-567-8901', 'Carlos', 'López', '1982-01-20', 'Masculino', 'Panameña');
INSERT INTO Persona (cedula, nombre, apellido, fecha_nacimiento, genero, nacionalidad) VALUES ('8-678-9012', 'Laura', 'Fernández', '1998-12-05', 'Femenino', 'Panameña');
INSERT INTO Persona (cedula, nombre, apellido, fecha_nacimiento, genero, nacionalidad) VALUES ('8-789-0123', 'Andrés', 'Torres', '1987-06-18', 'Masculino', 'Panameña');
INSERT INTO Persona (cedula, nombre, apellido, fecha_nacimiento, genero, nacionalidad) VALUES ('8-890-1234', 'Clara', 'Sánchez', '1992-09-25', 'Femenino', 'Panameña');


-- Insertar datos en la tabla Personal
INSERT INTO Personal (id_persona, id_especialidad, id_cargo, id_direccion, id_jornada_laboral) VALUES (1, 1, 1, 1, 1); -- Juan Pérez, Cardiología, Médico, Dirección 1, Jornada Diurna
INSERT INTO Personal (id_persona, id_especialidad, id_cargo, id_direccion, id_jornada_laboral) VALUES (2, 2, 2, 2, 2); -- María Gómez, Neurociencia, Enfermera, Dirección 2, Jornada Nocturna
INSERT INTO Personal (id_persona, id_especialidad, id_cargo, id_direccion, id_jornada_laboral) VALUES (3, 3, 3, 3, 1); -- Luis Martínez, Gastroenterología, Administrador, Dirección 3, Jornada Mixta
INSERT INTO Personal (id_persona, id_especialidad, id_cargo, id_direccion, id_jornada_laboral) VALUES (4, NULL, 4, NULL, 2); -- Ana Rodríguez, Sin Especialidad, Asistente, Sin Dirección, Jornada Nocturna
INSERT INTO Personal (id_persona, id_especialidad, id_cargo, id_direccion, id_jornada_laboral) VALUES (5, 4, 5, 4, 1); -- Carlos López, Endocrinología, Jefe de Enfermería, Dirección 4, Jornada Diurna
INSERT INTO Personal (id_persona, id_especialidad, id_cargo, id_direccion, id_jornada_laboral) VALUES (6, 5, 6, 5, 2); -- Laura Fernández, Oncología, Médico Cirujano, Dirección 5, Jornada Nocturna

-- Insertar datos en la tabla TiposDeSangre
INSERT INTO TiposDeSangre (tipo_sangre) VALUES ('A+');
INSERT INTO TiposDeSangre (tipo_sangre) VALUES ('A-');
INSERT INTO TiposDeSangre (tipo_sangre) VALUES ('B+');
INSERT INTO TiposDeSangre (tipo_sangre) VALUES ('B-');
INSERT INTO TiposDeSangre (tipo_sangre) VALUES ('AB+');
INSERT INTO TiposDeSangre (tipo_sangre) VALUES ('AB-');
INSERT INTO TiposDeSangre (tipo_sangre) VALUES ('O+');
INSERT INTO TiposDeSangre (tipo_sangre) VALUES ('O-');

-- Insertar datos en la tabla Pacientes
INSERT INTO Pacientes (id_direccion, id_persona, id_tipo_sangre) VALUES (1, 1, 1); -- Paciente 1: Juan Pérez, Dirección 1, Tipo de Sangre A+
INSERT INTO Pacientes (id_direccion, id_persona, id_tipo_sangre) VALUES (2, 2, 2); -- Paciente 2: María Gómez, Dirección 2, Tipo de Sangre A-
INSERT INTO Pacientes (id_direccion, id_persona, id_tipo_sangre) VALUES (3, 3, 3); -- Paciente 3: Luis Martínez, Dirección 3, Tipo de Sangre B+
INSERT INTO Pacientes (id_direccion, id_persona, id_tipo_sangre) VALUES (NULL, 4, 4); -- Paciente 4: Ana Rodríguez, Sin Dirección, Tipo de Sangre B-
INSERT INTO Pacientes (id_direccion, id_persona, id_tipo_sangre) VALUES (4, 5, 5); -- Paciente 5: Carlos López, Dirección 4, Tipo de Sangre AB+
INSERT INTO Pacientes (id_direccion, id_persona, id_tipo_sangre) VALUES (5, 6, 6); -- Paciente 6: Laura Fernández, Dirección 5, Tipo de Sangre AB-

-- Insertar datos en la tabla Seguros
INSERT INTO Seguros (nombre_seguro, tipo_seguro, numero_poliza, id_paciente) VALUES ('Seguro Vida', 'social', 'POL123456', 1); -- Paciente 1: Juan Pérez
INSERT INTO Seguros (nombre_seguro, tipo_seguro, numero_poliza, id_paciente) VALUES ('Salud Total', 'privado', 'POL987654', 2); -- Paciente 2: María Gómez
INSERT INTO Seguros (nombre_seguro, tipo_seguro, numero_poliza, id_paciente) VALUES ('Medicina General', 'social', 'POL456789', 3); -- Paciente 3: Luis Martínez
INSERT INTO Seguros (nombre_seguro, tipo_seguro, numero_poliza, id_paciente) VALUES ('Premium Salud', 'privado', 'POL321654', 4); -- Paciente 4: Ana Rodríguez
INSERT INTO Seguros (nombre_seguro, tipo_seguro, numero_poliza, id_paciente) VALUES ('Seguro Familiar', 'social', 'POL654321', 5); -- Paciente 5: Carlos López
INSERT INTO Seguros (nombre_seguro, tipo_seguro, numero_poliza, id_paciente) VALUES ('Salud Premium', 'privado', 'POL159753', 6); -- Paciente 6: Laura Fernández


    -- Insertar datos en la tabla Permisos
    INSERT INTO Permisos (nombre_permiso, tipo_permiso, descripcion) VALUES ('Acceso a Historia Clínica', 'lectura', 'Permite leer la historia clínica del paciente.');
    INSERT INTO Permisos (nombre_permiso, tipo_permiso, descripcion) VALUES ('Modificar Datos del Paciente', 'escritura', 'Permite actualizar la información del paciente en el sistema.');
    INSERT INTO Permisos (nombre_permiso, tipo_permiso, descripcion) VALUES ('Eliminar Registro de Paciente', 'eliminacion', 'Permite eliminar el registro de un paciente del sistema.');
    INSERT INTO Permisos (nombre_permiso, tipo_permiso, descripcion) VALUES ('Crear Nuevo Paciente', 'creacion', 'Permite agregar un nuevo paciente al sistema.');
    INSERT INTO Permisos (nombre_permiso, tipo_permiso, descripcion) VALUES ('Actualizar Datos de Seguro', 'actualizacion', 'Permite actualizar la información del seguro del paciente.');
    INSERT INTO Permisos (nombre_permiso, tipo_permiso, descripcion) VALUES ('Acceso Completo al Sistema', 'acceso_completo', 'Permite acceso total a todas las funcionalidades del sistema.');




-- Insertar datos en la tabla Usuarios
INSERT INTO Usuarios (username, password, cedula) VALUES ('juan.perez', 'password1', '8-123-4567');
INSERT INTO Usuarios (username, password, cedula) VALUES ('maria.gomez', 'password2', '8-234-5678');
INSERT INTO Usuarios (username, password, cedula) VALUES ('luis.martinez', 'password3', '8-345-6789');
INSERT INTO Usuarios (username, password, cedula) VALUES ('ana.rodriguez', 'password4', '8-456-7890');
INSERT INTO Usuarios (username, password, cedula) VALUES ('carlos.lopez', 'password5', '8-567-8901');
INSERT INTO Usuarios (username, password, cedula) VALUES ('laura.fernandez', 'password6', '8-678-9012');
INSERT INTO Usuarios (username, password, cedula) VALUES ('andres.torres', 'password7', '8-789-0123');
INSERT INTO Usuarios (username, password, cedula) VALUES ('clara.sanchez', 'password8', '8-890-1234');



INSERT INTO Roles (nombre_rol, descripcion) VALUES 
('SuperUsuario', 'Tiene acceso total al sistema, incluyendo la administración de usuarios y permisos'),
('Administrador', 'Gestiona las operaciones del hospital, incluyendo la administración de personal y recursos'),
('Doctor', 'Médico encargado de la atención y tratamiento de los pacientes'),
('Enfermero', 'Responsable de la atención básica de los pacientes bajo la supervisión de los doctores'),
('Recepcionista', 'Gestiona la recepción de pacientes y la organización de citas'),
('Farmacéutico', 'Encargado de la distribución y control de los medicamentos'),
('Paciente', 'Acceso limitado al sistema para revisar su historial médico y agendar citas'),
('Técnico de laboratorio', 'Encargado de realizar análisis clínicos y entregar resultados a los doctores');

-- Doctor
INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (1, 1); -- Ver pacientes
INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (1, 2); -- Editar pacientes
INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (1, 3); -- Ver citas

-- Enfermera
INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (2, 1); -- Ver pacientes
INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (2, 3); -- Ver citas

-- Administrador
INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (3, 1); -- Ver pacientes
INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (3, 2); -- Editar pacientes
INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (3, 4); -- Editar citas
INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (3, 5); -- Gestionar usuarios
INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (3, 6); -- Ver inventario

-- Recepcionista
INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (4, 3); -- Ver citas
INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (4, 4); -- Editar citas

-- SuperUsuario
INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (5, 1); -- Ver pacientes
INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (5, 2); -- Editar pacientes
INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (5, 3); -- Ver citas
INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (5, 4); -- Editar citas
INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (5, 5); -- Gestionar usuarios
INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (5, 6); -- Ver inventario
INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (5, 7); -- Editar inventario




-- Asignar roles a usuarios existentes
INSERT INTO usuarios_roles (id_usuario, id_rol) VALUES (1, 1); -- Juan Pérez es SuperUsuario
INSERT INTO usuarios_roles (id_usuario, id_rol) VALUES (2, 2); -- María Gómez es Administrador
INSERT INTO usuarios_roles (id_usuario, id_rol) VALUES (3, 3); -- Luis Martínez es Doctor
INSERT INTO usuarios_roles (id_usuario, id_rol) VALUES (4, 4); -- Ana Rodríguez es Enfermero
INSERT INTO usuarios_roles (id_usuario, id_rol) VALUES (5, 5); -- Carlos López es Recepcionista
INSERT INTO usuarios_roles (id_usuario, id_rol) VALUES (6, 6); -- Laura Fernández es Farmacéutico
INSERT INTO usuarios_roles (id_usuario, id_rol) VALUES (7, 7); -- Andrés Torres es Paciente
INSERT INTO usuarios_roles (id_usuario, id_rol) VALUES (8, 8); -- Clara Sánchez es Técnico de laboratorio




INSERT INTO Usuarios (username, password, cedula) 
VALUES ('paatrick09', '1009', 16);

INSERT INTO Usuarios (username, password, id_persona) 
VALUES ('gabs', '1406', 17);


INSERT INTO usuarios_roles (id_usuario, id_rol) VALUES (15, 7); 
INSERT INTO usuarios_roles (id_usuario, id_rol) VALUES (11, 1);
