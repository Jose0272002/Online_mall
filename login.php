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
<?php include("components/header.php");?>
    <div class="main-content">
        <div class="content-page">
            <form action="servicios/login.php" method="post">
                <h3>Iniciar sesión</h3>
                <input type="email" name="emausu" placeholder="Correo">
                <input type="password" name="pasusu" placeholder="Contraseña">
                <?php
                if (isset($_GET['e'])) {
                    switch ($_GET['e']) {
                        case 1:
                            echo '<p>Error de conexión.</p>';
                            break;
                        case 2:
                            echo '<p>Email inválido.</p>';
                            break;
                        case 3:
                            echo '<p>Contraseña incorrecta.</p>';
                            break;
                        default:
                            break;
                    }
                }
                ?>
                <button type="submit">Ingresar</button>
            </form>
        </div>
    </div>
<?php include("components/footer.php"); ?>
<script src="js/main-scripts.js"></script>
</body>

</html>