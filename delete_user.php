<?php
session_start();
include('bd.php');

// Verificar si se ha recibido el parámetro 'id'
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Convertir el id a un número entero

    // Comprobar la conexión
    if ($conn->connect_error) {
        die('Error de conexión: ' . $conn->connect_error);
    }

    // Consulta SQL para eliminar el usuario por ID
    $query = "DELETE FROM usuarios WHERE id_usuario = ?";
    $stmt = $conn->prepare($query);

    // Verificar si la consulta fue exitosa
    if ($stmt) {
        // Vincular el parámetro y ejecutar
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            // Verificar si el registro se eliminó correctamente
            if ($stmt->affected_rows > 0) {
                $_SESSION['message'] = 'El usuario con ID ' . $id . ' fue eliminado';
                $_SESSION['message_type'] = 'success'; // Cambiado a 'success'
            } else {
                $_SESSION['message'] = 'No se encontró el usuario con ID ' . $id;
                $_SESSION['message_type'] = 'warning';
            }
        } else {
            $_SESSION['message'] = 'Error al eliminar el registro: ' . $stmt->error;
            $_SESSION['message_type'] = 'danger';
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = 'Error en realizar la consulta: ' . $conn->error;
        $_SESSION['message_type'] = 'danger';
    }
} else {
    $_SESSION['message'] = 'ID de usuario no proporcionado o no válido';
    $_SESSION['message_type'] = 'warning';
}

// Redirigir a la página de control de usuarios
header('Location: control_usuarios.php');
exit();
?>
