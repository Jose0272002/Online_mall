<?php
include('../conexion.php');
$response = new stdClass();

session_start();
$codusu = $_SESSION["codusu"];
$datos = [];
$i = 0;

$sql = "SELECT ped.*, pro.*, pp.cantidad, 
        CASE WHEN ped.estado='2' THEN 'Completado' ELSE 'Pendiente de pago' END estadotxt 
        FROM pedido ped 
        INNER JOIN pedido_producto pp ON ped.codped = pp.codped 
        INNER JOIN producto pro ON pp.codpro = pro.codpro 
        WHERE ped.codusu = $codusu and ped.estado != 1";

$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)) {
    $obj = new stdClass();
    $obj->codpro = $row['codpro'];
    $obj->nompro = $row['nompro'];
    $obj->despro = $row['despro'];
    $obj->fecped = $row['fecped'];
    $obj->catpro = $row['catpro'];
    $obj->prepro = $row['prepro'];
    $obj->estado = $row['estadotxt'];
    $obj->cantidad = $row['cantidad']; 
    $obj->Img_prod = $row['Img_prod'];
    $datos[$i] = $obj;
    $i++;
}
$response->datos = $datos;
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
?>