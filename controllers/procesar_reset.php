<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../vendor/autoload.php';
require_once '../config/Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];

    // Conexión a la base de datos
    $db = new Database();
    $conn = $db->getConnection();

    try {
        // Verificar si el usuario existe y obtener sus datos
        $query = $conn->prepare("SELECT email, username FROM usuarios WHERE username = :username OR cedula = :username");
        $query->bindParam(':username', $username);
        $query->execute();

        if ($query->rowCount() > 0) {
            $user = $query->fetch(PDO::FETCH_ASSOC);

            // Verificar si el correo existe
            if (empty($user['email']) || !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
                die("No se encontró un correo electrónico válido para este usuario.");
            }

            // Generar nueva contraseña temporal
            $newPassword = bin2hex(random_bytes(4)); 
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

            // Actualizar la contraseña en la base de datos
            $update = $conn->prepare("UPDATE usuarios SET password = :password WHERE username = :username OR cedula = :username");
            $update->bindParam(':password', $hashedPassword);
            $update->bindParam(':username', $username);
            $update->execute();

            // Configuración y envío de correo electrónico
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'talpihosclinic@gmail.com';
            $mail->Password = 'xtogjorlypqnpmuq'; // Cambiar por una contraseña de aplicación válida
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Detalles del correo
            $mail->setFrom('tu_correo@gmail.com', 'Sistema de Recuperación');
            $mail->addAddress($user['email']); 
            $mail->Subject = 'Restablecimiento de Contraseña';
            $mail->Body = "Hola {$user['username']},\n\nTu nueva contraseña temporal es: {$newPassword}\n\nPor favor, cambia esta contraseña al iniciar sesión.\n\nSaludos,\nEl Equipo.";

            if ($mail->send()) {
                echo "Se ha enviado un correo con tu nueva contraseña.";
            } else {
                echo "Error al enviar el correo: " . $mail->ErrorInfo;
            }
        } else {
            echo "El usuario no existe.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

