<?require_once '../../config/Database.php';

$database = new Database();
$db = $database->getConnection();

$id_personal = $_GET['id_personal'];
$fecha = $_GET['fecha'];

$stmt = $db->prepare("
    SELECT * 
    FROM disponibilidad 
    WHERE id_personal = ? AND fecha = ? AND estado = 'disponible'
");
$stmt->execute([$id_personal, $fecha]);

$disponibilidad = $stmt->fetchAll(PDO::FETCH_ASSOC);

http_response_code(200);
echo json_encode($disponibilidad);