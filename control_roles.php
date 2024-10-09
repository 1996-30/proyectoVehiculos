<?php
include("bd.php");
session_start();
include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Control de Roles</title>
</head>
<body>
    <div class="container mt-5">

        <!-- Alertas -->
        <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-<?= htmlspecialchars($_SESSION['message_type']) ?> alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php session_unset(); ?>
        <?php } ?>
        <!-- Fin de alertas -->

        <h1>Control de Roles</h1>
        <a href="create_roles.php" class="btn btn-primary mb-3">Agregar Roles</a>

        <!-- Tabla para mostrar los roles -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verificar la conexión
                if ($conn->connect_error) {
                    die("Error de conexión: " . $conn->connect_error);
                }

                // Obtener los roles
                $result = $conn->query("SELECT * FROM roles");
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id_rol']); ?></td>
                        <td><?= htmlspecialchars($row['nombre']); ?></td>
                        <td>
                            <a href="update_roles.php?id=<?= $row['id_rol']; ?>" class="btn btn-warning">Actualizar</a>
                            <a href="delete_roles.php?id=<?= $row['id_rol']; ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='3'>Error al obtener roles: " . $conn->error . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
