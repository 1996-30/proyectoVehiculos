<?php
include("db.php");
session_start();


if(isset($_GET['id_cliente'])){
    $id = $_GET['id_cliente'];
    $nombre = $_GET['nombre'];

    $query = "DELETE FROM cliente WHERE id_cliente = $id";
    $result = mysqli_query($conn,$query);

    if(!$result){
        die("Consulta Fallida");
    }

    $_SESSION['message'] = 'Cliente Eliminado Exitosamente';
    $_SESSION['message_type'] = 'danger';

    header("Location: formClientes.php");

}

?>
