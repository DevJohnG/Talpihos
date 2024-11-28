<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require '../config/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cedula = $_POST['cedula'] ?? null;

    if (!$cedula) {
        echo "Cédula no proporcionada.";
        exit();
    }

    try {
        $db = new Database();
        $conn = $db->getConnection();

        // Obtener datos del preregistro
        $query = "SELECT * FROM PreRegistro WHERE cedula = :cedula";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->execute();
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$registro) {
            echo "Registro no encontrado.";
            exit();
        }

        // Validar correo electrónico
        if (empty($registro['correo']) || !filter_var($registro['correo'], FILTER_VALIDATE_EMAIL)) {
            echo "Correo electrónico no válido o no proporcionado en el preregistro.";
            exit();
        }

        $correo = $registro['correo'];

        // Insertar en la tabla `persona`
        $query = "INSERT INTO persona (cedula, nombre, apellido, fecha_nacimiento, genero, nacionalidad) 
                  VALUES (:cedula, :nombre, :apellido, :fecha_nacimiento, :genero, :nacionalidad)";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            ':cedula' => $registro['cedula'],
            ':nombre' => $registro['nombre'],
            ':apellido' => $registro['apellido'],
            ':fecha_nacimiento' => $registro['fecha_nacimiento'],
            ':genero' => $registro['genero'],
            ':nacionalidad' => $registro['nacionalidad']
        ]);

        // Generar nombre de usuario y contraseña
        $username = strtolower($registro['nombre'] . '.' . $registro['apellido']);
        $password = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 10);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Recomendación: Usar hashing

        // Insertar en la tabla `usuarios`
        $query = "INSERT INTO usuarios (username, password, cedula, email) 
                  VALUES (:username, :password, :cedula, :correo)";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            ':username' => $username,
            ':password' => $hashedPassword, // Almacenar contraseña hasheada
            ':cedula' => $registro['cedula'],
            ':correo' => $correo
        ]);

        $id_usuario = $conn->lastInsertId();

        // Insertar el rol de paciente en la tabla `usuarios_roles`
        $id_rol_paciente = 16; // ID correspondiente al rol "Paciente"
        $query = "INSERT INTO usuarios_roles (id_usuario, id_rol) VALUES (:id_usuario, :id_rol)";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            ':id_usuario' => $id_usuario,
            ':id_rol' => $id_rol_paciente
        ]);

        // Insertar en la tabla `pacientes`
        $query = "INSERT INTO pacientes (cedula, id_tipo_sangre) 
                  VALUES (:cedula, :tipo_sangre)";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            ':cedula' => $registro['cedula'],
            ':tipo_sangre' => $registro['tipo_sangre'] //cambiar posiciones de los id_tipo_sangre 
        ]);//si no funciona

        // Enviar correo al usuario
        $asunto = "Solicitud Aceptada";
        $mensaje = "
        Hola {$registro['nombre']},<br><br>
        Tu solicitud ha sido aceptada. Ahora puedes iniciar sesión en el sistema.<br>
        <strong>Usuario:</strong> $username<br>
        <strong>Contraseña:</strong> $password<br><br>
        ¡Bienvenido a nuestro sistema!
        ";

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'talpihosclinic@gmail.com'; // Dirección de correo electrónico
        $mail->Password = 'xtogjorlypqnpmuq'; // Contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('tu_correo@gmail.com', 'Hospital');
        $mail->addAddress($correo);

        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;

        if ($mail->send()) {
            echo "Usuario aceptado, rol asignado y correo enviado correctamente.";
            
        } else {
            echo "Usuario aceptado, rol asignado, pero hubo un problema al enviar el correo.";
        }
    } catch (PDOException $e) {
        echo "Error al procesar el registro: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
}
?>
