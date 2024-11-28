<?php

session_start();


if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'Doctor') {
    header("Location: /views/login.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard del Doctor</title>
    <style>
        :root {
            --primary-color: #4a90e2;
            --secondary-color: #f5f5f5;
            --text-color: #333;
            --border-color: #ddd;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--secondary-color);
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background-color: var(--primary-color);
            color: white;
            padding: 1rem 0;
            margin-bottom: 2rem;
        }
        h1 {
            text-align: center;
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.4);
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        .dashboard-item {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .dashboard-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .dashboard-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
            fill: var(--primary-color);
        }
        .dashboard-title {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }
        .dashboard-button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .dashboard-button:hover {
            background-color: #3a7bc8;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropbtn {
            background-color: #fff;
            color: #3498db;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .dropbtn:hover {
            background-color: #ecf0f1;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            z-index: 1;
            right: 0;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            color: #3498db;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ecf0f1;
        }
        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <div class="header-content" style="display: flex; align-items: center;">
            <h1 style="flex-grow: 1;">PANEL DE DOCTOR</h1>
            <div class="dropdown" style="margin-left: auto;">
                <button class="dropbtn">Menu ▼</button>
                <div class="dropdown-content">
                    <a href="../index.php?action=logout">Cerrar Sesión</a>
                    <a href="cambiar_contrasena.php">Cambiar Contraseña</a>
                </div>
            </div>
        </div>
    </div>
</header>

    <main class="container">
        

            <div class="dashboard-item">
                <svg class="dashboard-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                <h2 class="dashboard-title">Realizar Historial Médico</h2>
                <a href="historial_clinico.php" class="dashboard-button">Ir al formulario</a>
            </div>

<br>

            <div class="dashboard-item">
                <svg class="dashboard-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <h2 class="dashboard-title">Buscar Historial Médico</h2>
                <a href="mostrar_historial.php" class="dashboard-button">Ir a búsqueda</a>
            </div>
        </div>
    </main>
</body>
</html>