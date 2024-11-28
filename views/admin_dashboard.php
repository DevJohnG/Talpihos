<?php

session_start();


if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'SuperUsuario') {
    header("Location: /views/login.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PANEL DE ADMINISTRACIÓN</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Estilos generales */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background-image: url('../image/blurhospital.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin
        }

        .logo {
        height: 100px;
        margin-right: 15px;
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: #fff;
            padding: 1rem 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
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
        h1 {
            font-size: 1.5rem;
        }
        .logout-btn {
            background-color: #fff;
            color: #3498db;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background-color: #ecf0f1;
        }

        /* Main content */
        main {
            padding: 2rem 0;
        }
        .dashboard-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .dashboard-title {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        .dashboard-description {
            color: #666;
            margin-bottom: 1.5rem;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }
        .dashboard-item {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 5px;
            padding: 1rem;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        .dashboard-item:hover {
            background-color: #e9ecef;
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .dashboard-item-icon {
            width: 24px;
            height: 24px;
            margin-right: 0.5rem;
        }

        /* Footer */
        footer {
            background-color: #34495e;
            color: #ecf0f1;
            text-align: center;
            padding: 1rem 0;
            bottom: 0;
            width: 100%;
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
            box-shadow: 0px 8px 16px rgba(0,0,0,0.1);
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

        .dropbtn i {
    font-size: 20px;  /* Tamaño del ícono */
        }


        
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
            }
            .logout-btn {
                margin-top: 1rem;
            }
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            
        }
    </style>
</head>
<body>
<header>
<div class="container">
    <div class="header-content">
        <img src="../image/logo2.png" alt="Logo" class="logo">
        <h1>PANEL DE ADMINISTRACIÓN</h1>
        <div class="dropdown">

            <button class="dropbtn">
                <i class="fas fa-bars"></i>
            </button>
            <div class="dropdown-content">
                <a href="../index.php?action=logout">Cerrar Sesión</a>
                <a href="cambiar_contrasena.php">Cambiar Contraseña</a>
            </div>
        </div>
    </div>
</div>
</header>

    <main>
    <div class="container">
            <div class="dashboard-card">
                <h2 class="dashboard-title">Bienvenido</h2>
                <p class="dashboard-description">Selecciona una opción para gestionar</p>
                <div class="dashboard-grid">
                    <a href="agregar-departamento.php" class="dashboard-item">
                        <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        Gestionar Departamentos 
                    </a>
                    <a href="agregar-areaMedica.php" class="dashboard-item">
                        <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        Gestionar Área Médica
                    </a>
                    <a href="agregar_subespecialidad.php" class="dashboard-item">
                        <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="7"></circle>
                            <polyline points="8.21 13.89 7 23 12 2 7 23 15.79 13.88"></polyline>
                        </svg>
                        Gestionar Sub Especialidad
                    </a>
                    <a href="agregar-especialidad.php" class="dashboard-item">
                        <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="7"></circle>
                            <polyline points="8.21 13.89 7 23 12 2 7 23 15.79 13.88"></polyline>
                        </svg>
                        Registrar Especialidad
                    </a>
                    <a href="gestionar_especialidad.php" class="dashboard-item">
                      <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="12" cy="12" r="10"></circle>
                     <path d="M12 6l1.09 3.26L16 10l-2.91 0.74L12 14l-1.09-3.26L8 10l2.91-0.74L12 6z"></path>
                      </svg>
                     Gestionar Especialidad
                    </a>
                    <a href="nuevo_rol.php" class="dashboard-item">
                        <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <line x1="20" y1="8" x2="20" y2="14"></line>
                            <line x1="23" y1="11" x2="17" y2="11"></line>
                        </svg>
                        Agregar Roles
                    </a><a href="gestionar_roles.php" class="dashboard-item">
                    <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                       <circle cx="12" cy="5" r="3"></circle>
                    <circle cx="6" cy="17" r="3"></circle>
                 <circle cx="18" cy="17" r="3"></circle>
                   <path d="M12 8v4"></path>
                     <path d="M6 14l6-2"></path>
                  <path d="M18 14l-6-2"></path>
                    </svg>
                   Gestionar Roles
                    </a>
                    <a href="nuevo_usuario.php" class="dashboard-item">
                        <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        Registrar Usuarios
                    </a>
                    <a href="gestionar_usuarios.php" class="dashboard-item">
    <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="8" cy="8" r="4"></circle>
        <circle cx="16" cy="8" r="4"></circle>
        <path d="M4 18c0-2 4-4 8-4s8 2 8 4"></path>
    </svg>
    Gestionar Usuarios
</a>                          
                    <a href="registro_personas.php" class="dashboard-item">
                        <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                            <path d="M9 14h6"></path>
                            <path d="M9 18h6"></path>
                            <path d="M12 10h.01"></path>
                        </svg>
                        Registrar Personas
                    </a>
                    <a href="gestionar_personas.php" class="dashboard-item">
                        <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                            <path d="M9 14h6"></path>
                            <path d="M9 18h6"></path>
                            <path d="M12 10h.01"></path>
                        </svg>
                        Gestionar Personas
                    </a>
                    
                    <a href="registro_paciente.php" class="dashboard-item">
                        <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                        </svg>
                        Registrar Pacientes
                    </a>
                    <a href="gestion_pacientes.php" class="dashboard-item">
                       <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2a4 4 0 0 1 4 4v12a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4V6a4 4 0 0 1 4-4h4z"></path>
                            <path d="M8 6h8"></path>
                           <path d="M8 18h8"></path>
                       </svg>
                          Gestionar Pacientes
                    </a>
                    <a href="registrar_personal.php" class="dashboard-item">
                        <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        Agregar Personal
                    </a>
                    <a href="gestion_personal.php" class="dashboard-item">
                     <svg class="dashboard-item-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="12" cy="7" r="4"></circle>
                     <path d="M12 14c4 0 6 2 6 6H6c0-4 2-6 6-6z"></path>
                      </svg>
                      Gestionar Personal
                    </a>

                    <a href="vista_preregistro.php" class="dashboard-item">
                        <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="12" y1="18" x2="12" y2="12"></line>
                            <line x1="9" y1="15" x2="15" y2="15"></line>
                        </svg>
                        Pre-registros
                    </a>

                </div>
            </div>
        </div>
    </main>

    <?php require 'templates/footer.php'; ?>
</body>
</html>