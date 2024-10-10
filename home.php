<?php
session_start();
include("db.php");
?>

<?php 
include("header.php")
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Control de Usuarios</title>
</head>
<body>

    <div class="container mt-5">

        <!-- Alertas -->
        <?php if(isset($_SESSION['message'])) { ?>
            <div class="alert alert-<?= htmlspecialchars($_SESSION['message_type']) ?> alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php session_unset(); ?>
        <?php } ?>
        <!-- Fin de alertas -->

        <h1>Control de usuarios</h1>
        <!-- Botón para agregar usuarios -->
        <a href="create.php" class="btn btn-primary mb-3">Agregar usuario</a>
        
        <!-- Tabla para mostrar los usuarios -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Fecha Creación</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verificar la conexión
                if ($conn->connect_error) {
                    die("Error de conexión: " . $conn->connect_error);
                }

                // Consulta para obtener los usuarios junto con el nombre del rol
                $query = "
                    SELECT u.*, r.nombre AS rol_nombre 
                    FROM usuarios u 
                    JOIN roles r ON u.id_rol = r.id_rol
                ";
                $result = $conn->query($query);

                if ($result) {
                    while($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id_usuario']); ?></td>
                        <td><?= htmlspecialchars($row['nombre']); ?></td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        <td><?= htmlspecialchars($row['fecha_creacion']); ?></td>
                        <td><?= htmlspecialchars($row['rol_nombre']); ?></td>
                        <td>
                            <a href="update.php?id=<?= $row['id_usuario']; ?>" class="btn btn-warning">Actualizar</a>
                            <a href="delete.php?id=<?= $row['id_usuario']; ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='6'>Error al obtener usuarios: " . $conn->error . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
