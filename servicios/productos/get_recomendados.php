<?php
include('../conexion.php');
$response=new stdClass();
$datos=[];
$i=0;
$sql = 'SELECT pro.*, SUM(pp.cantidad) as total_vendidos 
        FROM producto pro 
        JOIN pedido_producto pp ON pro.codpro = pp.codpro 
        WHERE pro.estado = 1 
        GROUP BY pro.codpro 
        ORDER BY total_vendidos DESC 
        LIMIT 10 ';

$result=mysqli_query($con,$sql);

while($row=mysqli_fetch_array($result)){
    $obj=new stdClass();
    $obj->codpro=$row['codpro'];
    $obj->nompro=$row['nompro'];
    $obj->despro=$row['despro'];
    $obj->prepro=$row['prepro'];
    $obj->catpro=$row['catpro'];
    $obj->Img_prod=$row['Img_prod'];
    $datos[$i]=$obj;
    $i++;
}
$response->datos=$datos;
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);