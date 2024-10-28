
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Paciente</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f0f4f8;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background-color: #3498db;
            color: #fff;
            padding: 20px 0;
            margin-bottom: 20px;
        }
        h1 {
            text-align: center;
        }
        .patient-info {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .patient-info h2 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .tabs {
            display: flex;
            margin-bottom: 20px;
        }
        .tab-button {
            background-color: #ecf0f1;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            flex-grow: 1;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .tab-button:hover {
            background-color: #d5dbdb;
        }
        .tab-button.active {
            background-color: #3498db;
            color: #fff;
        }
        .tab-content {
            display: none;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #2980b9;
        }
        @media (max-width: 768px) {
            .tabs {
                flex-direction: column;
            }
            .tab-button {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Panel de Paciente</h1>
        </div>
    </header>

    <div class="container">
        <div class="patient-info">
        <h2>Información del Paciente</h2>
            <p><strong>Nombre:</strong> <?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario'; ?></p>
            <p><strong>Tipo de Sangre:</strong> O+</p>
        </div>

        <div class="tabs">
            <button class="tab-button active" onclick="openTab(event, 'agendar-cita')">Agendar Cita</button>
            <button class="tab-button" onclick="openTab(event, 'historial-medico')">Historial Médico</button>
            <button class="tab-button" onclick="openTab(event, 'recetas-medicas')">Recetas Médicas</button>
        </div>

        <div id="agendar-cita" class="tab-content active">
            <h2>Agendar Cita</h2>
            <form>
                <div class="form-group">
                    <label for="fecha-cita">Fecha:</label>
                    <input type="date" id="fecha-cita" name="fecha-cita" required>
                </div>
                <div class="form-group">
                    <label for="especialidad">Especialidad:</label>
                    <select id="especialidad" name="especialidad" required>
                        <option value="">Seleccione una especialidad</option>
                        <option value="medicina-general">Medicina General</option>
                        <option value="cardiologia">Cardiología</option>
                        <option value="dermatologia">Dermatología</option>
                        <option value="pediatria">Pediatría</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="motivo">Motivo de la consulta:</label>
                    <input type="text" id="motivo" name="motivo" required>
                </div>
                <button type="submit">Agendar Cita</button>
            </form>
        </div>

        <div id="historial-medico" class="tab-content">
            <h2>Historial Médico</h2>
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Diagnóstico</th>
                        <th>Tratamiento</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2023-05-15</td>
                        <td>Gripe estacional</td>
                        <td>Reposo y medicación sintomática</td>
                    </tr>
                    <tr>
                        <td>2023-02-10</td>
                        <td>Esguince de tobillo</td>
                        <td>Vendaje y fisioterapia</td>
                    </tr>
                    <tr>
                        <td>2022-11-20</td>
                        <td>Control anual</td>
                        <td>Sin novedad, exámenes normales</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="recetas-medicas" class="tab-content">
            <h2>Recetas Médicas</h2>
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Medicamento</th>
                        <th>Dosis</th>
                        <th>Duración</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2023-05-15</td>
                        <td>Paracetamol</td>
                        <td>500mg cada 8 horas</td>
                        <td>5 días</td>
                    </tr>
                    <tr>
                        <td>2023-02-10</td>
                        <td>Ibuprofeno</td>
                        <td>400mg cada 12 horas</td>
                        <td>7 días</td>
                    </tr>
                    <tr>
                        <td>2022-11-20</td>
                        <td>Vitamina D</td>
                        <td>1000 UI diarias</td>
                        <td>3 meses</td>
                    </tr>
                </tbody>
            </table>
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
</body>
</html>

