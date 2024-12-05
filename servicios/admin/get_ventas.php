<?php
include('../conexion.php');
$response = new stdClass();

session_start();
$codusu = $_SESSION["codusu"];
$datos = [];
$i = 0;

$sql = "SELECT ped.*, pro.*, usu.*, pp.* FROM pedido ped 
INNER JOIN pedido_producto pp ON pp.codped = ped.codped 
INNER JOIN producto pro ON pro.codpro = pp.codpro 
INNER JOIN usuario usu ON usu.codusu = ped.codusu 
WHERE ped.estado = 2";

$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)) {
    $obj = new stdClass();
    $obj->codpro = $row['codpro'];
    $obj->codped = $row['codped'];
    $obj->nompro = $row['nompro'];
    $obj->despro = $row['despro'];
    $obj->fecped = $row['fecped'];
    $obj->catpro = $row['catpro'];
    $obj->prepro = $row['prepro'];
    $obj->cantidad = $row['cantidad'];
    $obj->Img_prod = $row['Img_prod'];
    $obj->nomusu = $row['nomusu'];
    $datos[$i] = $obj;
    $i++;
}
$response->datos = $datos;
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
