<?php
// Incluir el archivo de configuración de la base de datos
require_once '../config/Database.php';

// Crear una nueva conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Configuración de los parámetros del script
$horaInicio = "08:00:00"; // Hora de inicio del día laboral
$horaFin = "18:00:00"; // Hora de fin del día laboral
$duracionBloque = 60; // Duración de cada bloque de tiempo en minutos
$fechaInicio = "2024-11-24"; // Fecha de inicio del intervalo de generación
$fechaFin = "2024-12-30"; // Fecha de fin del intervalo de generación
$estado = "disponible"; // Estado inicial de los bloques generados (puede ajustarse según los requerimientos)

// Consultar la lista de personal desde la base de datos
$queryPersonal = "SELECT id_personal FROM personal";
$stmtPersonal = $db->prepare($queryPersonal);
$stmtPersonal->execute();
$personal = $stmtPersonal->fetchAll(PDO::FETCH_ASSOC);

if (!$personal) {
    die("No se encontró personal en la base de datos."); // Termina el script si no hay personal registrado
}

// Función para generar bloques de tiempo dentro de un rango de horas
function generarBloques($horaInicio, $horaFin, $duracionBloque) {
    $bloques = [];
    $horaActual = strtotime($horaInicio); // Convertir la hora de inicio a formato timestamp
    $horaLimite = strtotime($horaFin); // Convertir la hora de fin a formato timestamp

    // Crear bloques mientras la hora actual esté dentro del rango permitido
    while ($horaActual < $horaLimite) {
        $inicio = date("H:i:s", $horaActual); // Formato de inicio del bloque
        $horaActual = strtotime("+{$duracionBloque} minutes", $horaActual); // Sumar duración del bloque
        $fin = date("H:i:s", $horaActual); // Formato de fin del bloque

        if ($horaActual <= $horaLimite) {
            $bloques[] = ['inicio' => $inicio, 'fin' => $fin]; // Agregar bloque al arreglo
        }
    }

    return $bloques; // Devolver los bloques generados
}

// Crear un rango de fechas usando DatePeriod
$intervaloFechas = new DatePeriod(
    new DateTime($fechaInicio), // Fecha inicial
    new DateInterval('P1D'), // Incremento de 1 día
    new DateTime($fechaFin . ' +1 day') // Fecha final (incluye el día final)
);

try {
    $db->beginTransaction(); // Iniciar una transacción para asegurar la consistencia de los datos

    // Iterar sobre cada miembro del personal
    foreach ($personal as $persona) {
        $idPersonal = $persona['id_personal'];

        // Iterar sobre cada fecha en el rango definido
        foreach ($intervaloFechas as $fecha) {
            $fechaActual = $fecha->format("Y-m-d"); // Convertir la fecha al formato YYYY-MM-DD
            $bloques = generarBloques($horaInicio, $horaFin, $duracionBloque); // Generar bloques para el día actual

            // Insertar cada bloque generado en la base de datos
            foreach ($bloques as $bloque) {
                $queryInsert = "
                    INSERT INTO disponibilidad (id_personal, fecha, hora_inicio, hora_fin, estado)
                    VALUES (:id_personal, :fecha, :hora_inicio, :hora_fin, :estado)";
                $stmtInsert = $db->prepare($queryInsert);

                // Vincular parámetros al query
                $stmtInsert->bindParam(':id_personal', $idPersonal, PDO::PARAM_INT);
                $stmtInsert->bindParam(':fecha', $fechaActual, PDO::PARAM_STR);
                $stmtInsert->bindParam(':hora_inicio', $bloque['inicio'], PDO::PARAM_STR);
                $stmtInsert->bindParam(':hora_fin', $bloque['fin'], PDO::PARAM_STR);
                $stmtInsert->bindParam(':estado', $estado, PDO::PARAM_STR);

                $stmtInsert->execute(); // Ejecutar el query
            }
        }
    }

    $db->commit(); // Confirmar la transacción
    echo "Bloques de disponibilidad generados exitosamente."; // Mensaje de éxito
} catch (Exception $e) {
    $db->rollBack(); // Revertir la transacción en caso de error
    echo "Error al generar bloques de disponibilidad: " . $e->getMessage(); // Mensaje de error
}
?>
