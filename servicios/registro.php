<?php
include('conexion.php');

// Validar campos del formulario
$emausu = trim($_POST['emausur']);
$nomusu = trim($_POST['nomusur']);
$apusur = trim($_POST['apusur']);
$pasusu = $_POST['pasusur'];
$pasusu2 = $_POST['pasusur2'];

// Validar campos vacíos
if (empty($emausu) || empty($nomusu) || empty($apusur) || empty($pasusu) || empty($pasusu2)) {
    header('Location:../registro.php?er=1'); // Campos vacíos
    exit();
}

// Validar email
if (!filter_var($emausu, FILTER_VALIDATE_EMAIL)) {
    header('Location:../registro.php?er=2'); // Email inválido
    exit();
}

// Validar contraseñas coincidan
if ($pasusu !== $pasusu2) {
    header('Location:../registro.php?er=5'); // Contraseñas no coinciden
    exit();
}

// Validación de requisitos de contraseña (mínimo 8 caracteres, solo letras y números)
if (!preg_match('/^[a-zA-Z0-9]+$/', $pasusu) || strlen($pasusu) < 8) {
    header('Location:../registro.php?er=4'); // Contraseña no cumple requisitos
    exit();
}

// Comprobar si el email ya está registrado
$sql = "SELECT * FROM usuario WHERE emausu = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $emausu);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    header('Location:../registro.php?er=3'); // Email ya registrado
    exit();
}

// Insertar usuario en la base de datos
$hashedPassword = password_hash($pasusu, PASSWORD_DEFAULT);
$sql = "INSERT INTO usuario (nomusu, apeusu, emausu, pasusu, estado) VALUES (?, ?, ?, ?, 1)";
$stmt = $con->prepare($sql);
$stmt->bind_param('ssss', $nomusu, $apusur, $emausu, $hashedPassword);

if ($stmt->execute()) {
    $codusu = $stmt->insert_id;

    // Iniciar sesión
    session_start();
    $_SESSION['codusu'] = $codusu;
    $_SESSION['emausu'] = $emausu;
    $_SESSION['nomusu'] = $nomusu;

    header('Location:../'); // Redirigir al inicio
    exit();
} else {
    // Error de inserción en la base de datos
    header('Location:../registro.php?er=6');
    exit();
}
?>
