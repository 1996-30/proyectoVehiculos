<?php 
include("db.php");
session_start();



if(isset($_GET['id_linea'])){
    $id = $_GET['id_linea'];
    $marcas = "SELECT linea.id_linea, marcas.nombre as marca, linea.marca_id as idmarca, 
    linea.nombre as lineaNom FROM linea  
    INNER JOIN marcas ON linea.marca_id=marcas.id_marca 
    WHERE linea.id_linea=$id";
    echo $marcas;
    $resultado = mysqli_query($conn,$marcas);

    if(mysqli_num_rows($resultado)==1)
    {
        $row = mysqli_fetch_array($resultado);
        $nombre =$row['marca'];
        $id_marca = $row['marcas'];       
      
        
          
      
    }
}

if(isset($_POST['update'])){
    $id = $_GET['id_linea'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['id_marca'];
  
    

    $query ="UPDATE linea SET nombre = '$nombre', marca_id = '$marca'   WHERE id_linea= $id";
    mysqli_query($conn, $query);

    $_SESSION['message'] = 'Registro  Actualizado Exitosamente';
     $_SESSION['message_type'] = 'success';
    
     header("Location: formLineas.php");
       
}

?>


<?php include("header.php")?>

<div class="container p-4 ">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <!-- AQUI VA EL CARD -->
            <div class="car card-body">
            <form action="updateLineas.php?id_linea=<?php echo $_GET['id_linea'] ;  ?>" method="POST">
                <div class="form-group">
                    <input type="text" name="nombre" class="form-control" placeholder="Actualizar Linea" value="<?php echo $nombre ?>">
                </div>
               <br>   
               <div>
                <label for="Marcas" class="form-control">Seleccione Marca:</label><br>
                    <select name="id_marca" id="marcas" class="form-control">
                    <option value=""></option>
                    <?php while($row = $resultado->fetch_assoc()){ ?>
                        <option value="<?php echo $row['idmarca']; ?>"><?php echo $row['marca']; ?></option>
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
