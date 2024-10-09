<?php
include("db.php");
session_start();


if(isset($_GET['id_tipo'])){
    $id = $_GET['id_tipo'];

    $cSql = "DELETE FROM tipo_vehiculo WHERE id_tipo = $id";
    $tipoV = mysqli_query($conn,$cSql);

    if(!$tipoV){
        die("Consulta Fallida");
    }

    $_SESSION['message'] = 'Registro No. '  .$id = $_GET['id_tipo'].  ' Eliminado Exitosamente';
    $_SESSION['message_type'] = 'danger';

    header("Location: formTiposV.php");

}

?>
