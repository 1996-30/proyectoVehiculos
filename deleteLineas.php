<?php
include("db.php");
session_start();


if(isset($_GET['id_linea'])){
    $id = $_GET['id_linea'];

    $query = "DELETE FROM linea WHERE id_linea = $id";
    $result = mysqli_query($conn,$query);

    if(!$result){
        die("Consulta Fallida");
    }

    $_SESSION['message'] = 'Registro No. '  .$id = $_GET['id_linea'].  ' Eliminado Exitosamente';
    $_SESSION['message_type'] = 'danger';

    header("Location: formLineas.php");

}

?>
