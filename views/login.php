<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="icon" href="/image/favicon-32x32.png" type="image/png" sizes="32x32">
    <link rel="icon" href="/image/favicon-16x16.png" type="image/png" sizes="16x16">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            background-image: url('../image/blurhospital.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        header {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: #fff;
            font-shadow: 0 1px 1px rgba(0, 0, 0, 0.1)
            padding: 1rem 0;
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.4);    
            margin-bottom: 5px;
        }

        section {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .header-sep{
            display:flex;
            justify-content:space-between;
        }

        .logo {
        height: 50px;
        margin-right: 15px;
        }

        h4{
            cursor: pointer;
        }

        header:hover {
color: #fff;
background: linear-gradient(135deg, #2980b9, #3498db);
text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.4);}

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .login-container {
            justify-content: center;
            align-items: center;
            background-color: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 320px;
            text-align: center;
        }
        
        h2 {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        .input-group {
            margin-bottom: 1.5rem;
        }
        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #34495e;
            font-weight: 300;
        }
        .input-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .input-group input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }
        button {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .login-btn {
            background-color: #3498db;
            color: white;
            margin-bottom: 1rem;
        }
        .login-btn:hover {
            background-color: #2980b9;
        }
        .pre-register-btn {
            background-color: white;
            color: #3498db;
            border: 2px solid #3498db;
        }
        .pre-register-btn:hover {
            background-color: #3498db;
            color: white;
        }
        .forgot-password {
            text-align: center;
            margin-top: 1rem;
        }
        .forgot-password a {
            color: #7f8c8d;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }
        .forgot-password a:hover {
            color: #34495e;
        }
        .imgLogo{
            border-radius: 80px
        }

        .banner{
            width: 100%;
        }

        .bannerimg{
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: box-shadow 0.3s ease, transform 0.2s ease;
            transform: translateY(-3px);
        }

        .bannerimg:hover{
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        .bannerimg:active{
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            transform: translateY(0px);
        }

    </style>
</head>
<body>

<header>
<div class="container">
    <div class="header-content">
        <img src="../image/logo2.png" alt="Logo" class="logo">
        <h4>Conócenos</h4>
        <h4>Contáctanos</h4>
        <h4>Urgencias</h4>
        <h4>Farmacia</h4>
    </div>
</div>
</header>

<br>

<section>
    <div class="login-container">
        <h2 style="">Iniciar Sesión</h2>
        <img class="imgLogo" src="../image/logo.png" alt="Logo" style="width: 100%;">
        
        <form method="POST" action="../controllers=LoginController&action=login">
            <div class="input-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-btn">Iniciar Sesión</button>
            <button type="button" class="pre-register-btn" onclick="window.location.href='pre_registro.php'">Pre-registro</button>
        </form>
        
        <div class="forgot-password">
            <a href="reset_password.php">¿Olvidaste tu contraseña?</a>
        </div>
    </div>

    </section>

    <br>
    <?php require 'templates/footer.php'; ?>

</body>

</body>
</html>

