<?php
session_start();
if (!isset($_SESSION['codusu'])) {
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sometype+Mono&family=Urbanist:ital,wght@1,300&display=swap" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php include("components/header.php"); ?>
    <div class="main-content">
        <div class="content-page">
            <h3>Mi Carrito</h3>
            <div class="body-pedidos" id="space-list">
            </div>

            <?php include("servicios/compra/pasarela.php"); ?>
            <span class="total" id="total"></span>
            <span class="total">€</span>
        </div>

    </div>
    <script src="js/main-scripts.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                url: 'servicios/pedido/get_porprocesar.php',
                type: 'POST',
                data: {},
                success: function(data) {
                    console.log(data);
                    let total = 0;
                    let html = '';
                    for (let i = 0; i < data.datos.length; i++) {
                        html += '<div class="item-pedido">' +
                            '<div class="pedido-img">' +
                            '<img src="images/products/' + data.datos[i].Img_prod + '" alt="">' +
                            '</div>' +
                            '<div class="pedido-detalle">' +
                            '<h2>' + data.datos[i].nompro.toUpperCase() + '</h2>' +
                            '<p><b>Precio :</b> ' + data.datos[i].prepro * data.datos[i].cantidad  + '€</p>' +
                            '<p><b>Precio por articulo:</b> ' + data.datos[i].prepro  + '€</p>' +
                            '<p><b>Fecha:</b>' + data.datos[i].fecped + '</p>' +
                            '<p><b>Estado:</b>' + data.datos[i].estadotext + '</p>' +
                            '<p><b>Cantidad:'+data.datos[i].cantidad+'</b></p>'+
                            '<button class="btn-borrar" onclick="delete_product(' + data.datos[i].codped +
                            ')">Eliminar</button>' +
                            '</div>' +
                            '</div>';
                        if (data.datos[i].estado == 1) {
                            total += parseFloat(data.datos[i].prepro * data.datos[i].cantidad)
                        }

                    }
                    document.getElementById('total').innerHTML = total.toFixed(2);
                    document.getElementById('space-list').innerHTML = html;
                },
                error: function(err) {
                    console.error("Error fetching data:", err.responseText);
                }
            });
        });

        function delete_product(codped) {
            $.ajax({
                url: 'servicios/pedido/borrar.php',
                type: 'POST',
                data: {
                    codped: codped
                },
                success: function(data) {
                    console.log(data);
                    if (data.state) {
                        window.location.reload();
                    } else {
                        alert(data.details)
                    }
                },
                error: function(err) {
                    console.error("Error fetching data:", err.responseText);
                }
            });
        }
    </script>
</body>
<?php include("components/footer.php"); ?>

</html>