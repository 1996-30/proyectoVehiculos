<?php
include("db.php");
session_start();


if(isset($_GET['id_modelo'])){
    $id = $_GET['id_modelo'];

    $cSql = "DELETE FROM modelo WHERE id_modelo = $id";
    $modelos = mysqli_query($conn,$cSql);

    if(!$modelos){
        die("Consulta Fallida");
    }

    $_SESSION['message'] = 'Registro No. '  .$id = $_GET['id_modelo'].  ' Eliminado Exitosamente';
    $_SESSION['message_type'] = 'danger';

    header("Location: formModelos.php");

}

?>
