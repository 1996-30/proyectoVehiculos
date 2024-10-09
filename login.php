<?php

session_start();
include("bd.php");

$name = $_POST['nombre'];
$contraseña = $_POST['contraseña'];

/* Determine los datos correctos */

$query = "SELECT * FROM usuarios WHERE nombre = ? AND contraseña = ? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $name, $contraseña);
$stmt->execute();
$result = $stmt->get_result();

$_SESSION['nombre'] = $name;

if($result->num_rows==1){
    $_SESSION['message'] = 'Acceso permitido';
    $_SESSION['message_type'] = 'success';
    $_SESSION['redirect'] = true;
}else{
    $_SESSION['message'] = 'Acceso incorrecto';
    $_SESSION['message_type'] = 'danger';
    $_SESSION['redirect'] = false;
}

$conn->close();
$stmt->close();

header("Location: index.php");
?>