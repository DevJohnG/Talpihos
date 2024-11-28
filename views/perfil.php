<?php
session_start();

// Verificar si el usuario está autenticado y es un paciente
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'Paciente') {
    header("Location: /views/login.php");
    exit();
}

$current_userId = $_SESSION['usuario_id'];
if (!isset($_SESSION['id_paciente'])) {
  die("No se encontró el ID del paciente en la sesión.");
}

// Obtener el id del paciente de la sesión
$id_paciente = $_SESSION['id_paciente'];


// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'Hospital');
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$query_historial = "
    SELECT h.id_historial, h.descripcion, h.fecha
    FROM historialclinico h
    WHERE h.id_paciente = ?
    ORDER BY h.fecha DESC";

$stmt_historial = $conexion->prepare($query_historial);
$stmt_historial->bind_param('i', $id_paciente);
$stmt_historial->execute();
$result_historial = $stmt_historial->get_result();



// Consultar información del paciente (persona, tipo de sangre)
$query_paciente = "
    SELECT 
        p.cedula AS cedula_persona, 
        p.nombre AS nombre_persona, 
        p.apellido AS apellido_persona, 
        p.fecha_nacimiento, 
        p.genero, 
        p.nacionalidad,
        ts.tipo_sangre
    FROM pacientes pac
    INNER JOIN persona p ON pac.cedula = p.cedula
    LEFT JOIN tiposdesangre ts ON pac.id_tipo_sangre = ts.id_tipo_sangre
    WHERE pac.id_paciente = ?
";

$stmt_paciente = $conexion->prepare($query_paciente);
$stmt_paciente->bind_param('i', $id_paciente); // Usar ID del paciente
$stmt_paciente->execute();
$result_paciente = $stmt_paciente->get_result();

// Si se encuentra un paciente con ese ID
if ($result_paciente->num_rows > 0) {
    $paciente = $result_paciente->fetch_assoc();
} else {
    echo "No se encontró información para este paciente.";
    exit;
}

// Manejar solicitudes POST para obtener especialidad de un personal
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_personal'])) {
    $id_personal = intval($_POST['id_personal']);

    $query = "
        SELECT e.nombre_especialidad 
        FROM personal p
        INNER JOIN especialidades e ON p.id_especialidad = e.id_especialidad
        WHERE p.id_personal = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $id_personal);
    $stmt->execute();
    $stmt->bind_result($especialidad);
    $stmt->fetch();
    $stmt->close();

    // Respuesta en formato JSON
    echo json_encode(['especialidad' => $especialidad]);
    exit;
}
echo $_SESSION['id_paciente'];
// Consultar doctores
$query_doctores = "
    SELECT p.id_personal, pr.nombre, pr.apellido
    FROM personal p
    INNER JOIN persona pr ON p.cedula = pr.cedula
";
$stmt_doctores = $conexion->prepare($query_doctores);
$stmt_doctores->execute();
$result_doctores = $stmt_doctores->get_result();

// Consultar citas pendientes del paciente
$query_citas = "
    SELECT d.fecha, d.hora_inicio, d.hora_fin, descripcion, c.estado
    FROM citas c
    INNER JOIN disponibilidad d ON c.id_disponibilidad = d.id_disponibilidad
    WHERE c.id_paciente = ? AND c.estado = 'programada'
    ORDER BY d.fecha ASC

";
$stmt_citas = $conexion->prepare($query_citas);
$stmt_citas->bind_param('i', $_SESSION['id_paciente']); 
$stmt_citas->execute();
$result_citas = $stmt_citas->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<script>
    <img src="../image/logo2.png" alt="Logo" class="logo">
</script>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Paciente</title>

    <style>
        :root {
  --primary-color: #3498db;
  --secondary-color: #2c3e50;
  --background-color: #ecf0f1;
  --text-color: #333;
  --border-color: #bdc3c7;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  line-height: 1.6;
  background-color: var(--background-color);
  color: var(--text-color);
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

.logo {
        height: 100px;
        margin-right: 15px;
        }

header {   
    background: linear-gradient(135deg, #3498db, #2980b9);
  color: #fff;
  padding: 5px 0;
  margin-bottom: 30px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

header:hover {
color: #fff;
background: linear-gradient(135deg, #2980b9, #3498db);
text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.4);}

h1, h2 {
}

.patient-info {
  background-color: #fff;
  border-radius: 8px;
  padding: 20px;
  margin-bottom: 30px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.tabs {
  display: flex;
  margin-bottom: 30px;
  border-radius: 8px;
  overflow: hidden;
}

.tab-button {
  background-color: #75869d; /* Fondo inactivo   */
  color: #fff; 
  border: none;
  padding: 15px 25px;
  cursor: pointer;
  flex-grow: 1;
  font-size: 16px;
  font-weight: bold; 
  transition: background-color 0.3s, color 0.3s;
}

.tab-button:hover {
  background-color: #96c9ff; /* Fondo más llamativo al pasar el cursor */
  color: #2c3e50; /* Letras negras */
}

.tab-button.active {
  background-color: #0055af; /* Fondo activo (color principal) */
  color: #fff; /* Letras blancas para contraste */
}

.tab-content {
  display: none;
  background-color: #fff;
  border-radius: 8px;
  padding: 25px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.tab-content.active {
  display: block;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid var(--border-color);
}

th {
  background-color: #f8f9fa;
  font-weight: 600;
  color: var(--secondary-color);
}

.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  margin-bottom: 8px;
  font-weight: 600;
  color: var(--secondary-color);
}

input[type="text"], input[type="date"], select {
  width: 100%;
  padding: 12px;
  border: 1px solid var(--border-color);
  border-radius: 4px;
  font-size: 16px;
  transition: border-color 0.3s;
}

input[type="text"]:focus, input[type="date"]:focus, select:focus {
  outline: none;
  border-color: var(--primary-color);
}

button {
  background-color: var(--primary-color);
  color: #fff;
  border: none;
  padding: 12px 20px;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s;
}

button:hover {
  background-color: #2980b9;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropbtn {
  background-color: #fff;
  color: var(--primary-color);
  border: 2px solid white;
  padding: 10px 15px;
  border-radius: 5px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.dropbtn:hover {
  background-color: var(--primary-color);
  color: #fff;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #fff;
  min-width: 160px;
  box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
  z-index: 1;
  right: 0;
  border-radius: 5px;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown-content a {
  color: var(--text-color);
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  transition: background-color 0.3s;
}

.dropdown-content a:hover {
  background-color: #f1f1f1;
}

.section {
  margin-bottom: 30px;
}

.calendar-section {
  background-color: #fff;
  border-radius: 8px;
  padding: 25px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

#calendar {
  margin-top: 20px;
}

@media (max-width: 768px) {
  .tabs {
    flex-direction: column;
  }
  
  .tab-button {
    border-radius: 0;
  }
  
  .container {
    padding: 10px;
  }
  
  .patient-info, .tab-content, .calendar-section {
    padding: 15px;
  }
}
    </style>
</head>
<body style="background-image: url('../image/blurhospital.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;">
<header>
    <div class="container">
        <div class="header-content" style="display: flex; align-items: center;">
        <img src="../image/logo2.png" alt="Logo" class="logo">
            <h1 style="flex-grow: 1;">Portal de Paciente</h1>
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

    <div class="container">
        <div class="patient-info">
        <h2>Datos Personales</h2>
        <p><strong>Cédula:</strong> <?= htmlspecialchars($paciente['cedula_persona']) ?></p>
        <p><strong>Nombre:</strong> <?= htmlspecialchars($paciente['nombre_persona']) ?> <?= htmlspecialchars($paciente['apellido_persona']) ?></p>
        <p><strong>Fecha de Nacimiento:</strong> <?= htmlspecialchars($paciente['fecha_nacimiento']) ?></p>
        <p><strong>Género:</strong> <?= htmlspecialchars($paciente['genero']) ?></p>
        <p><strong>Nacionalidad:</strong> <?= htmlspecialchars($paciente['nacionalidad']) ?></p>
        <p><strong>Tipo de Sangre:</strong> <?= htmlspecialchars($paciente['tipo_sangre'] ?: 'No especificado') ?></p>
        </div>

        <div class="tabs">
    <button class="tab-button active" onclick="openTab(event, 'calendar-section')">Agendar Cita</button>
    <button class="tab-button" onclick="openTab(event, 'pending-appointments')">Citas Pendientes</button>
    <button class="tab-button" onclick="openTab(event, 'historial-clinico')">Historial Médico</button>
</div>

<div class="tab-content active" id="calendar-section">
    <div class="calendar-section">
        <h2>Agendar Nueva Cita</h2>
        <select id="id_personal" name="id_personal" required>
            <option value="">Doctor</option>
            <?php
            if ($result_doctores->num_rows > 0) {
                while ($row = $result_doctores->fetch_assoc()) {
                    echo '<option value="' . $row['id_personal'] . '">' . htmlspecialchars($row['nombre']) . ' ' . htmlspecialchars($row['apellido']) . '</option>';
                }
            } else {
                echo '<option value="">No hay doctores disponibles</option>';
            }
            ?>
        </select>
        <select id="id_especialidad" name="id_especialidad" disabled>
            <option value="">Seleccione un doctor primero</option>
        </select>

        <div id="calendar"></div>
    </div>
</div>

<div class="tab-content" id="pending-appointments">
    <div class="section">
        <h2>Citas Pendientes</h2>
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora de inicio</th>
                    <th>Hora de fin</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $result_citas->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($fila['fecha']) ?></td>
                        <td><?= htmlspecialchars($fila['hora_inicio']) ?></td>
                        <td><?= htmlspecialchars($fila['hora_fin']) ?></td>
                        <td><?= htmlspecialchars($fila['descripcion']) ?></td>
                        <td><?= htmlspecialchars($fila['estado']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="tab-content" id="historial-clinico">
    <div class="section">
        <h2>Historial Médico</h2>
        <?php if ($result_historial->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $result_historial->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($fila['id_historial']) ?></td>
                            <td><?= htmlspecialchars($fila['descripcion']) ?></td>
                            <td><?= htmlspecialchars($fila['fecha']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay historial clínico registrado para este paciente.</p>
        <?php endif; ?>
    </div>
</div>


        

    <script>
        function openTab(evt, tabName) {
            var i, tabContent, tabButtons;
            tabContent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabContent.length; i++) {
                tabContent[i].style.display = "none";
            }
            tabButtons = document.getElementsByClassName("tab-button");
            for (i = 0; i < tabButtons.length; i++) {
                tabButtons[i].className = tabButtons[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const selectDoctor = document.getElementById('id_personal');
        const calendarEl = document.getElementById('calendar');
        let calendar;

        function fetchDisponibilidad(idPersonal) {
            fetch(`../api/disponibilidad/obtener.php?id_personal=${idPersonal}`)
                .then(response => response.json())
                .then(data => {
                    calendar.removeAllEvents();
                    calendar.addEventSource(data); // Carga directamente los eventos en el calendario
                })
                .catch(error => console.error('Error al cargar la disponibilidad:', error));
        }


        // Inicializar el calendario
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'timeGridWeek,timeGridDay',
            },
            events: [],
            eventClick: function (info) {
                if (confirm(`¿Desea agendar esta cita?\n${info.event.title}\nFecha: ${info.event.start.toLocaleString()}`)) {
                    // Actualizar el estado de disponibilidad
                    fetch('../api/disponibilidad/actualizar.php', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id_disponibilidad: info.event.id, 
                            estado: 'ocupado',
                        }),
                    })
                    
                    .then(response => { 
                        if (!response.ok) {
                            throw new Error('La solicitud falló');
                        }
                        return response.json();})
                    .catch(error => console.error('Error al actualizar el estado:', error))
                    .then(data => {
                        if (data.message === "Estado de disponibilidad actualizado exitosamente.") {
                            // Crear la cita
                            console.log("datos de la cita: ",
                            {
                                descripcion: "Cita programada automatiacamente",
                                estado: 'programada',
                                id_paciente: id_paciente,
                                id_personal: Number(selectDoctor.value),
                                id_disponibilidad: Number(info.event.id),
                            }
                    
                            );
                            console.log("id_disponibilidad:", info.event.id); 
                            fetch('../api/citas/create.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    descripcion: "Cita programada",
                                    estado: 'programada', 
                                    id_paciente: id_paciente, 
                                    id_personal: Number(selectDoctor.value),
                                    id_disponibilidad: Number(info.event.id),
                                }),
                                

                            })
                            .then(response => { 
                                if (!response.ok) {
                                    throw new Error('La solicitud falló');
                                }
                                return response.json();})
                            .then(data => {
                                if (data.message === 'Cita creada exitosamente.') {
                                    alert('Cita agendada y registrada con éxito.');
                                    info.event.setProp('color', '#e74c3c'); // Cambiar color
                                    info.event.setProp('title', 'Ocupado');
                                    // Recargar la página después de registrar la cita
                                    setTimeout(() => {
                                        window.location.reload(); // Recarga la página
                                    }, 1000);
                                } else {
                                    alert('Error al registrar la cita.');
                                }
                            })
                            .catch(error => console.error('Error al crear la cita:', error));
                        } else {
                            alert('Error al actualizar la disponibilidad.');
                        }
                    })
                    .catch(error => console.error('Error al actualizar el estado:', error));
                }
            },


        });
        calendar.render();

        // Actualizar el calendario al seleccionar un doctor
        selectDoctor.addEventListener('change', function () {
            const idPersonal = this.value;
            if (idPersonal) {
                fetchDisponibilidad(idPersonal);
            } else {
                calendar.removeAllEvents(); // Limpiar el calendario si no hay doctor seleccionado
            }
        });
    });

</script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectDoctor = document.getElementById('id_personal');
            const selectEspecialidad = document.getElementById('id_especialidad');

            selectDoctor.addEventListener('change', function() {
                const idPersonal = this.value;

                if (idPersonal) {
                    fetch(window.location.href, { // Envío al mismo archivo
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `id_personal=${idPersonal}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        selectEspecialidad.innerHTML = `
                            <option value="">${data.especialidad}</option>
                        `;
                    })
                    .catch(error => console.error('Error al cargar la especialidad:', error));
                } else {
                    selectEspecialidad.innerHTML = '<option value="">Seleccione un doctor primero</option>';
                }
            });
        });
    </script>

</body>
</html>
