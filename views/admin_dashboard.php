<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <style>
        /* Estilos generales */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background-color: #3498db;
            color: #fff;
            padding: 1rem 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
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
    width: 100%;
    background-color: var(--primary-color);
    color: white;
    padding: 10px 0;
    text-align: center;
    }
    footer h4 {
    margin: 5px 0;
    }

        /* Responsive design */
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
                <h1>Panel de Administración</h1>
                <a class="logout-btn" href="login.php">Cerrar Sesión</a>

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
                        Agregar Departamento
                    </a>
                    <a href="agregar-areaMedica.php" class="dashboard-item">
                        <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        Agregar Área Médica
                    </a>
                    <a href="agregar-subespecialidad.php" class="dashboard-item">
                        <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="7"></circle>
                            <polyline points="8.21 13.89 7 23 12 2 7 23 15.79 13.88"></polyline>
                        </svg>
                        Agregar Sub Especialidad
                    </a>
                    <a href="agregar-especialidad.php" class="dashboard-item">
                        <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="7"></circle>
                            <polyline points="8.21 13.89 7 23 12 2 7 23 15.79 13.88"></polyline>
                        </svg>
                        Agregar Especialidad
                    </a>
                    <a href="nuevo_rol.php" class="dashboard-item">
                        <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <line x1="20" y1="8" x2="20" y2="14"></line>
                            <line x1="23" y1="11" x2="17" y2="11"></line>
                        </svg>
                        Agregar Roles
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
                    
                    <a href="registro_paciente.php" class="dashboard-item">
                        <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                        </svg>
                        Registrar Pacientes
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
                    <a href="nuevo_usuario.php" class="dashboard-item">
                        <svg class="dashboard-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        Crear Usuarios
                    </a>
                    
                    <a href="pre_registro.php" class="dashboard-item">
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

     <?php include 'Templates/footer.php'; ?>
</body>
</html>