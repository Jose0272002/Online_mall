<?php
// Incluye la conexión a la base de datos
include('conexion.php');

// Obtiene los datos del formulario
$emausu = trim($_POST['emausu']);
$pasusu = $_POST['pasusu'];

// Valida que los campos no estén vacíos
if (empty($emausu) || empty($pasusu)) {
    header('Location:../login.php?e=1'); // Error: campos vacíos
    exit();
}

// Valida que el email tenga un formato correcto
if (!filter_var($emausu, FILTER_VALIDATE_EMAIL)) {
    header('Location:../login.php?e=2'); // Error: email inválido
    exit();
}

// Consulta parametrizada para buscar el usuario
$sql = "SELECT * FROM usuario WHERE emausu = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $emausu);
$stmt->execute();
$result = $stmt->get_result();

// Verifica si el usuario existe
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verifica la contraseña usando password_verify
    
    if (password_verify($pasusu, $row['pasusu'])) {
        // Inicia sesión y guarda los datos del usuario
        session_start();
        $_SESSION['codusu'] = $row['codusu'];
        $_SESSION['emausu'] = $row['emausu'];
        $_SESSION['nomusu'] = $row['nomusu'];

        // Redirige al inicio
        header('Location:../');
        exit();
    } else {
        // Contraseña incorrecta
        header('Location:../login.php?e=3');
        exit();
    }
} else {
    // Usuario no encontrado
    header('Location:../login.php?e=2');
    exit();
}
?>
