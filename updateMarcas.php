<?php 
include("db.php");
session_start();




if(isset($_GET['id_marca'])){
    $id = $_GET['id_marca'];
    $query = "SELECT * FROM marcas WHERE id_marca=$id";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result)==1)
    {
        $row = mysqli_fetch_array($result);
        $nombre =$row['nombre'];
    
        
        
          
      
    }
}

if(isset($_POST['update'])){
    $id = $_GET['id_marca'];
    $nombre = $_POST['nombre'];
    

    $query ="UPDATE marcas SET nombre = '$nombre' WHERE id_marca= $id";
    mysqli_query($conn, $query);

    $_SESSION['message'] = 'Registro  Actualizado Exitosamente';
     $_SESSION['message_type'] = 'success';
    
     header("Location: formMarcas.php");
       
}

?>


<?php include("header.php")?>

<div class="container p-4 ">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <!-- AQUI VA EL CARD -->
            <div class="car card-body">
            <form action="updateMarcas.php?id_marca=<?php echo $_GET['id_marca'] ;  ?>" method="POST">
                <div class="form-group">
                    <input type="text" name="nombre" class="form-control" placeholder="Actualizar Marca" value="<?php echo $nombre ?>">
                </div>
                
               <button class="btn btn-success" name="update">Actualizar</button>
            </form>

         </div>
        </div>
        </div>
    </div>
