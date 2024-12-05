<?php
session_start();
$response = new stdClass();

include_once('../conexion.php');
$codusu = (isset($_SESSION['codusu'])) ? $_SESSION['codusu'] : 0;
$codpro = $_POST['codpro'];
$cantidad = $_POST['cantidad'];
$fecped = date("Y-m-d H:i:s");
$codped =

    $sql = "INSERT INTO `pedido`(`codped`, `codusu`, `fecped`, `estado`) 
VALUES ($codusu+''+UNIX_TIMESTAMP(NOW()),'$codusu','$fecped','2')";
$result = mysqli_query($con, $sql);

if ($result) {
    $sql = "SELECT codped FROM pedido WHERE codusu = $codusu ORDER BY fecped DESC LIMIT 1";

    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $codped = $row['codped'];
    $sql_producto = "INSERT INTO pedido_producto (codped, codpro, cantidad) VALUES ('$codped', '$codpro', '$cantidad')";
    $result_producto = mysqli_query($con, $sql_producto);

    if ($result_producto) {
        $response->state = true;
    } else {
        $response->state = false;
        $response->details = 'No se pudo agregar el producto al pedido';
    }
} else {
    $response->state = false;
    $response->details = 'No se pudo crear el pedido';
}

mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
