<?php
session_start();
include('bd.php');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Consulta para obtener el usuario específico
$query = "SELECT * FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
} else {
    echo "Usuario no encontrado.";
    exit;
}

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
    $tipo = $_POST['id_rol'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $date = $_POST['fecha_creacion'];

    // consulta
    $stmt = $conn->prepare("UPDATE usuarios SET nombre=?, id_rol=?, contraseña=?, email=?, fecha_creacion=? WHERE id_usuario=?");
    $stmt->bind_param("sssssi", $name, $tipo, $password, $email, $date, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Registro actualizado con éxito';
        $_SESSION['message_type'] = 'success';
        header("Location: control_usuarios.php");
        exit;
    } else {
        echo "Error de conexión: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Actualizar Usuario</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Actualizar Usuario</h1>
        <form action="update.php?id=<?php echo $id; ?>" method="POST">
            <div class="mb-3">
                <label for="name">Nombre</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password">Contraseña</label>
                <input type="password" name="password" class="form-control">
                <small class="form-text text-muted">Dejar en blanco si no desea cambiar la contraseña.</small>
            </div>
            <div class="mb-3">
                <label for="email">Correo</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha_creacion">Fecha de creación</label>
                <input type="date" name="fecha_creacion" class="form-control" value="<?php echo htmlspecialchars($usuario['fecha_creacion']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_rol">Rol</label>
                <select name="id_rol" class="form-control" required>
                    <option value="" disabled>Selecciona un rol</option>
                    <?php foreach ($roles as $rol): ?>
                        <option value="<?php echo $rol['id_rol']; ?>" <?php echo ($rol['id_rol'] == $usuario['id_rol']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($rol['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
