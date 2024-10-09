<?php
session_start();
include('bd.php');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Consulta para obtener el rol específico
$query = "SELECT * FROM roles WHERE id_rol = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $roles = $result->fetch_assoc();
} else {
    echo "Rol no encontrado.";
    exit;
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];

    // Consulta para actualizar el rol
    $stmt = $conn->prepare("UPDATE roles SET nombre = ? WHERE id_rol = ?");
    $stmt->bind_param("si", $name,$id); // Asegúrate de incluir el ID aquí

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Registro actualizado con éxito';
        $_SESSION['message_type'] = 'success';
        header("Location: control_roles.php");
        exit;
    } else {
        echo "Error al actualizar: " . $stmt->error;
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
    <title>Actualizar Roles</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Actualizar Rol</h1>
        <form action="update_roles.php?id=<?php echo $id; ?>" method="POST">
            <div class="mb-3">
                <label for="name">Nombre</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($roles['nombre']); ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
