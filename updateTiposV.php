<?php 
include("db.php");
session_start();




if(isset($_GET['id_tipo'])){
    $id = $_GET['id_tipo'];
    $cSql = "SELECT * FROM tipo_vehiculo WHERE id_tipo=$id";
    $tiposV = mysqli_query($conn, $cSql);

    if(mysqli_num_rows($tiposV)==1)
    {
        $row = mysqli_fetch_array($tiposV);
        $nombre =$row['nombre'];
    
        
        
          
      
    }
}

if(isset($_POST['update'])){
    $id = $_GET['id_tipo'];
    $nombre = $_POST['nombre'];
    

    $query ="UPDATE tipo_vehiculo SET nombre ='$nombre' WHERE id_tipo= $id";
    mysqli_query($conn, $query);

    $_SESSION['message'] = 'Registro  Actualizado Exitosamente';
     $_SESSION['message_type'] = 'success';
    
     header("Location: formTiposV.php");
       
}

?>


<?php include("header.php")?>

<div class="container p-4 ">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <!-- AQUI VA EL CARD -->
            <div class="car card-body">
            <form action="updateTiposV.php?id_tipo=<?php echo $_GET['id_tipo'] ;  ?>" method="POST">
                <div class="form-group">
                    <input type="text" name="nombre" class="form-control" placeholder="Actualizar Tipo Auto" value="<?php echo $nombre ?>">
                </div>
                
               <button class="btn btn-success" name="update">Actualizar</button>
               <button class="btn btn-danger" >Cancelar</button>
            </form>

         </div>
        </div>
        </div>
    </div>
