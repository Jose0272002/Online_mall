<?php
session_start();
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
    <?php include("components/header.php") ?>
    <div class="main-content">
        <div class="content-page">
            <div class="title-section">Ventas</div>
            <div class="products-list" id="space-list">

            </div>
        </div>
    </div>
    <script src="js/main-scripts.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                url: 'servicios/admin/get_ventas.php',
                type: 'POST',
                data: {},
                success: function(data) {
                    console.log(data);
                    html = '';
                    for (let i = 0; i < data.datos.length; i++) {
                        html += '<div class="caja-detalle">' +
                            '<div class="img">' +
                            '<img src="images/products/' + data.datos[i].Img_prod + '" alt="">' +
                            '</div>' +
                            '<div class="detalle">' +
                            '<h2>' + data.datos[i].nompro.toUpperCase() + '</h2>' +
                            '<p>Usuario: ' + data.datos[i].nomusu + '</p>' +
                            '<p> Codigo Pedido:' + data.datos[i].codped + '</p>' +
                            '<p> Fecha:' + data.datos[i].fecped + '</p>' +
                            '<p> Estado:' + data.datos[i].estado + '</p>' +
                            '<p>Descripción:' + data.datos[i].despro + '</p>' +
                            '<p>Categoría:' + data.datos[i].catpro + '</p>' +
                            '<p>Cantidad:' + data.datos[i].cantidad + '</p>' +
                            '<h4 style="color:green">Precio:' + formato_precio((data.datos[i].prepro)*data.datos[i].cantidad) + '</div>' +
                            '</div>' +
                            '</div>';
                    }
                    document.getElementById('space-list').innerHTML = html;
                },
                error: function(err) {
                    console.error("Error fetching data:", err.responseText);
                }
            });
        });

        function formato_precio(valor) {
            let svalor = valor.toString()
            let array = svalor.split(".")
            return array[0] + ".<span>" + array[1] + "€</span>";
        }
    </script>
</body>
<?php include("components/footer.php"); ?>

</html>