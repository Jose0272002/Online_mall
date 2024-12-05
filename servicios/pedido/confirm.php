<?php
session_start();
$response = new stdClass();
print_r($_SESSION);
include_once('../conexion.php');
$codusu = $_SESSION['codusu'];
$sql = "update pedido set estado=2
    where codusu=$codusu and estado=1";
$result = mysqli_query($con, $sql);
if ($result) {
    $response->state = true;
} else {
    $response->state = false;
    $response->details = 'No se pudo al actualizar el pedido';
}
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
