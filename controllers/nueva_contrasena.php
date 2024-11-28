<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../vendor/autoload.php';
require_once '../config/Database.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /views/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = $_SESSION['usuario_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        echo "Las contraseñas no coinciden";
        exit();
    }

    try {
        $db = new Database();
        $connection = $db->getConnection();

        $sql = "SELECT password, email FROM usuarios WHERE id_usuario = :usuario_id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo "Usuario no encontrado";
            exit();
        }

        if (!password_verify($current_password, $user['password'])) {
            echo "La contraseña actual es incorrecta";
            exit();
        }

        $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

        $update_sql = "UPDATE usuarios SET password = :new_password WHERE id_usuario = :usuario_id";
        $update_stmt = $connection->prepare($update_sql);
        $update_stmt->bindParam(':new_password', $new_password_hashed, PDO::PARAM_STR);
        $update_stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);

        if ($update_stmt->execute()) {
            $mail = new PHPMailer(true);

            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'talpihosclinic@gmail.com'; // Dirección de correo electrónico
                $mail->Password = 'xtogjorlypqnpmuq'; // Contraseña de aplicación
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Remitente y destinatario
                $mail->setFrom('tucorreo@tudominio.com', 'Hospital');
                $mail->addAddress($user['email']); // Usar el correo del usuario

                // Contenido del mensaje
                $mail->isHTML(true);
                $mail->Subject = 'Contraseña restablecida exitosamente';
                $mail->Body = 'Hola, <br><br>Tu contraseña ha sido restablecida exitosamente. Si no realizaste este cambio, por favor contacta a soporte.<br><br>Gracias.';

                // Enviar correo
                $mail->send();

                // Redirigir al login
                header("Location: ../views/login.php");
                exit();
            } catch (Exception $e) {
                echo "El correo no pudo ser enviado. Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "No se pudo actualizar la contraseña";
        }
    } catch (PDOException $e) {
        echo "Error en la base de datos: " . $e->getMessage();
    }
}
?>






