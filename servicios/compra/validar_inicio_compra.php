<?php
session_start();
$response = new stdClass();

if (!isset($_SESSION['codusu'])) {
    $response->state = false;
    $response->details = 'No ha iniciado sesión';
    $response->open_login = true;
} else {
    include_once('../conexion.php');
    $codusu = $_SESSION['codusu'];
    $codpro = $_POST['codpro'];
    $cantidad = $_POST['cantidad'];
    $precioProducto = $_POST['precio'];
    $total = $precioProducto * $cantidad; 
    $sql = "INSERT INTO pedido (codped,codusu, fecped, estado) 
    VALUES ($codusu+''+UNIX_TIMESTAMP(NOW()), $codusu, NOW(), 1)";
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
            $response->details = 'Producto agregado con éxito';
        } else {
            $response->state = false;
            $response->details = 'No se pudo agregar el producto al pedido';
        }
    } else {
        $response->state = false;
        $response->details = 'Error al crear el pedido';
    }

    mysqli_close($con);
}

header('Content-Type: application/json');
echo json_encode($response);
?>