<?php
session_start();
include ("db.php");

if(isset($_POST['guardaMarca'])){
   
    $nombre = $_POST['nombre'];
    

    $query = "INSERT INTO marcas(nombre)
              VALUES ('$nombre')";

       
        if($conn->query($query)==TRUE){
            $_SESSION['message'] = 'Marca '.$nombre.' Agregada Exitosamente';
            $_SESSION['message_type'] = 'info';
            header("Location: formMarcas.php");
        }else{
            echo "Error de Conexion";
        }

}