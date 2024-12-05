<?php
include('../conexion.php'); 

$response = new stdClass(); 

if (empty($_POST['text'])) {
    $response->error = 'El término de búsqueda está vacío.';
    echo json_encode($response);
    exit();
}

$text = $_POST['text'];

// Se escapa correctamente el texto de búsqueda para evitar inyección SQL 
$text = "%" . mysqli_real_escape_string($con, $text) . "%";

$sql = "SELECT * FROM producto WHERE estado=1 AND nompro LIKE ? OR despro LIKE ?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    $response->error = 'Error en la consulta: ' . $con->error;
    echo json_encode($response);
    exit();
}

$stmt->bind_param("ss", $text, $text);

$stmt->execute();
$result = $stmt->get_result();

$datos = [];
while ($row = $result->fetch_assoc()) {
    $obj = new stdClass();
    $obj->codpro = $row['codpro'];
    $obj->nompro = $row['nompro'];
    $obj->despro = $row['despro'];
    $obj->prepro = $row['prepro'];
    $obj->Img_prod = $row['Img_prod'];

    $datos[] = $obj;
}

if (empty($datos)) {
    $response->message = 'No se encontraron productos que coincidan con tu búsqueda.';
} else {
    $response->datos = $datos;
}

$stmt->close();
mysqli_close($con);

header('Content-Type: application/json');
echo json_encode($response);
?>
