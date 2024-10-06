<?php
include("db.php");
session_start();


if(isset($_GET['id_marca'])){
    $id = $_GET['id_marca'];

    $query = "DELETE FROM marcas WHERE id_marca = $id";
    $result = mysqli_query($conn,$query);

    if(!$result){
        die("Consulta Fallida");
    }

    $_SESSION['message'] = 'Registro No. '  .$id = $_GET['id_marca'].  ' Eliminado Exitosamente';
    $_SESSION['message_type'] = 'danger';

    header("Location: formMarcas.php");

}

?>
