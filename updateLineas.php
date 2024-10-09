<?php 
include("db.php");
session_start();
// inicialice variables
$nombre = '';
$id_marca = ''; 

if(isset($_GET['id_linea'])){
    $id = $_GET['id_linea'];
    $marcas = "SELECT linea.id_linea, marcas.nombre as marca, linea.marca_id as idmarca, 
    linea.nombre as lineaNom FROM linea  
    INNER JOIN marcas ON linea.marca_id=marcas.id_marca 
    WHERE linea.id_linea=$id";

    $resultado = mysqli_query($conn, $marcas);

    if(mysqli_num_rows($resultado) == 1) {
        $row = mysqli_fetch_array($resultado);
        $nombre = $row['lineaNom'];
        $id_marca = $row['idmarca'];//Este es un cambio
    }
}

if(isset($_POST['update'])){
    $id = $_GET['id_linea'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['id_marca'];

    $query = "UPDATE linea SET nombre = '$nombre', marca_id = '$marca' WHERE id_linea = $id";
    mysqli_query($conn, $query);

    $_SESSION['message'] = 'Registro Actualizado Exitosamente';
    $_SESSION['message_type'] = 'success';
    
    header("Location: formLineas.php");
    exit();
}

$marcasQuery = "SELECT id_marca, nombre FROM marcas";
$marcasResult = mysqli_query($conn, $marcasQuery);

?>

<?php include("header.php")?>

<div class="container p-4 ">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="updateLineas.php?id_linea=<?php echo $_GET['id_linea'];?>" method="POST">
                    <div class="form-group">
                        <input type="text" name="nombre" class="form-control" placeholder="Actualizar Linea" value="<?php echo htmlspecialchars($nombre); ?>">
                    </div>
                    <br>
                    <div>
                        <label for="Marcas" class="form-control">Seleccione Marca:</label><br>
                        <select name="id_marca" id="marcas" class="form-control">
                            <option value=""></option>
                            <?php while($row = mysqli_fetch_assoc($marcasResult)) { ?>
                                <option value="<?php echo $row['id_marca']; ?>" <?php if($row['id_marca'] == $id_marca) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($row['nombre']); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <br>
                    <button class="btn btn-success" name="update">Actualizar</button>
                    <button class="btn btn-danger" name="cancelar">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

