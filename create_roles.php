<?php
include('db.php');
session_start();

if (isset($_POST['submit'])) {
    // Validar y sanitizar la entrada
    $name = trim($_POST['name']);
    
    if (empty($name)) {
        $_SESSION['message'] = 'El nombre no puede estar vacío.';
        $_SESSION['message_type'] = 'danger';
        header("Location: control_roles.php");
        exit;
    }

    // Preparar la consulta
    $stmt = $conn->prepare("INSERT INTO roles (nombre) VALUES (?)");
    if ($stmt) {
        $stmt->bind_param("s", $name); // Solo un parámetro

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $_SESSION['message'] = 'El rol fue agregado con éxito';
            $_SESSION['message_type'] = 'success';
            header("Location: control_usuarios.php");
            exit; 
        } else {
            $_SESSION['message'] = "Error al agregar el rol: " . $stmt->error; 
            $_SESSION['message_type'] = 'danger';
            header("Location: control_usuarios.php");
            exit;
        }
        
        $stmt->close();
    } else {
        $_SESSION['message'] = "Error al preparar la consulta: " . $conn->error; 
        $_SESSION['message_type'] = 'danger';
        header("Location: control_usuarios.php");
        exit;
    }
}
?>
<?php 
include("header.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Agregar Roles</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Agregar Roles nuevos</h1>
        <form action="create_roles.php" method="POST">
            <div class="mb-3">
                <label for="name">Nombre</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-success">Agregar</button>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
