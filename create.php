<?php
include('db.php');
session_start();

// Consulta para obtener los roles
$queryRoles = "SELECT * FROM roles"; 
$resultRoles = $conn->query($queryRoles);
$roles = []; 
if ($resultRoles->num_rows > 0) {
    while ($rol = $resultRoles->fetch_assoc()) {
        $roles[] = $rol; 
    }
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $rol_id = $_POST['rol']; 
    $password = $_POST['password'];
    $email = $_POST['email'];
    $date = $_POST['date'];

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, id_rol, contraseña, email, fecha_creacion) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $rol_id, $password, $email, $date);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'El usuario fue agregado con éxito';
        $_SESSION['message_type'] = 'success';
        header("Location: control_usuarios.php");
        exit; 
    } else {
        echo "Error de conexión: " . $stmt->error; 
    }
    
    $stmt->close();
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
    <title>Agregar Usuario</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Agregar usuarios nuevos</h1>
        
        <form action="create.php" method="POST">
            <div class="mb-3">
                <label for="name">Nombre</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password">Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email">Correo</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="date">Fecha de creación</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="rol">Rol</label> 
                <select name="rol" class="form-control" required>
                    <option value="" disabled selected>Selecciona un rol</option>
                    <?php foreach ($roles as $rol): ?> 
                        <option value="<?php echo $rol['id_rol']; ?>"> 
                            <?php echo htmlspecialchars($rol['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-success">Agregar</button>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
