<?php 
include("db.php");
session_start();

if(isset($_GET['id_cliente'])){
    $id = $_GET['id_cliente'];
    $query = "SELECT * FROM cliente WHERE id_cliente=$id";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result)==1)
    {
        $row = mysqli_fetch_array($result);
        $nombre =$row['nombre'];
        $dpi =$row['DPI'];
        $nit =$row['NIT'];
        $email =$row['email'];
    }
}

if(isset($_POST['update'])){
    $id = $_GET['id_cliente'];
    $nombre = $_POST['nombre'];
    $dpi = $_POST['DPI'];
    $nit = $_POST['NIT'];
    $email = $_POST['email'];
    

    $query ="UPDATE cliente SET nombre = '$nombre', DPI='$dpi', NIT='$nit', email = '$email' WHERE id_cliente= $id";
    print_r($query);
    mysqli_query($conn, $query);

    $_SESSION['message'] = 'Cliente No. ('.$id.') Nombre: '.$nombre.' Actualizado Exitosamente';
     $_SESSION['message_type'] = 'success';
    
     header("Location: formClientes.php");
       
}

?>

<?php include("header.php")?>

<div class="container p-4 ">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <!-- AQUI VA EL CARD -->
            <div class="car card-body">
            <form action="updateClientes.php?id_cliente=<?php echo $_GET['id_cliente'] ;  ?>" method="POST">
                <h2>Actualizar ó Corregir Datos del Cliente</h1>
                <div class="form-group">
                    <label for="">Nombre del Cliente</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Actualizar Nombre del Cliente" value="<?php echo $nombre ?>">
                    <br>
                    <label for="">DPI</label>
                    <input type="text" name="DPI" class="form-control" placeholder="Actualizar DPI" value="<?php echo $dpi ?>">
                    <br>
                    <label for="">NIT</label>
                    <input type="text" name="NIT" class="form-control" placeholder="Actualizar NIT" value="<?php echo $nit ?>">
                    <br>
                    <label for="">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" placeholder="Actualizar Correo Electrónico" value="<?php echo $email ?>">
                </div>
                
               <button class="btn btn-success" name="update">Actualizar</button>
            </form>

         </div>
        </div>
        </div>
    </div>
