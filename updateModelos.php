<?php 
include("db.php");
session_start();




if(isset($_GET['id_modelo'])){
    $id = $_GET['id_modelo'];
    $cSql = "SELECT * FROM modelo WHERE id_modelo=$id";
    $modelos = mysqli_query($conn, $cSql);

    if(mysqli_num_rows($modelos)==1)
    {
        $row = mysqli_fetch_array($modelos);
        $nombre =$row['nombre'];
    
        
        
          
      
    }
}

if(isset($_POST['update'])){
    $id = $_GET['id_modelo'];
    $nombre = $_POST['nombre'];
    

    $query ="UPDATE modelo SET nombre = '$nombre' WHERE id_modelo= $id";
    mysqli_query($conn, $query);

    $_SESSION['message'] = 'Registro  Actualizado Exitosamente';
     $_SESSION['message_type'] = 'success';
    
     header("Location: formModelos.php");
       
}

?>


<?php include("header.php")?>

<div class="container p-4 ">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <!-- AQUI VA EL CARD -->
            <div class="car card-body">
            <form action="updateModelos.php?id_modelo=<?php echo $_GET['id_modelo'] ;  ?>" method="POST">
                <div class="form-group">
                    <input type="text" name="nombre" class="form-control" placeholder="Actualizar Modelo" value="<?php echo $nombre ?>">
                </div>
                
               <button class="btn btn-success" name="update">Actualizar</button>
               <button class="btn btn-danger" >Cancelar</button>
            </form>

         </div>
        </div>
        </div>
    </div>
