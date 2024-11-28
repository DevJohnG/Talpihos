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
    <title>Visualización de Historiales Médicos</title>
    <style>
     
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        input[type="text"], button {
            padding: 10px;
            font-size: 16px;
            margin-top: 10px;
            width: 100%;
            box-sizing: border-box;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #4a90e2;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f4f7f9;
        }
        
        .descripcion {
            max-width: 250px; 
            height: auto;
            white-space: pre-wrap; 
            overflow-wrap: break-word; 
            word-wrap: break-word; 
        }
    </style>
    <script>
        
        function buscarHistoriales() {
            const cedula = document.getElementById("cedula").value;

            fetch("../controllers/obtener_historiales.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "cedula=" + encodeURIComponent(cedula)
            })
            .then(response => response.json())
            .then(data => {
              
                const historialTable = document.getElementById("historialTable");
                historialTable.innerHTML = "";

                if (data.length > 0) {
                    data.forEach(historial => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${historial.id_historial}</td>
                            <td>${historial.cedula}</td>
                            <td>${historial.fecha}</td>
                            <td class="descripcion">${historial.descripcion}</td> <!-- Clase añadida aquí -->
                        `;
                        historialTable.appendChild(row);
                    });
                } else {

                    historialTable.innerHTML = "<tr><td colspan='4'>No se encontraron historiales para esta cédula.</td></tr>";
                }
            })
            .catch(error => console.error("Error:", error));
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Historiales Médicos</h1>
        <label for="cedula">Buscar por Cédula:</label>
        <input type="text" id="cedula" placeholder="Ingrese la cédula del paciente" oninput="buscarHistoriales()">

        <table>
            <thead>
                <tr>
                    <th>ID Historial</th>
                    <th>Cédula</th>
                    <th>Fecha</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody id="historialTable">
         
            </tbody>
        </table>
    </div>
</body>
</html>

