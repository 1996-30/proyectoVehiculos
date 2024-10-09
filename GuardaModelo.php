<?php
session_start();
include ("db.php");

if(isset($_POST['guardaModelo'])){
   
    $nombre = $_POST['nombre'];
    

    $query = "INSERT INTO modelo(nombre)
              VALUES ('$nombre')";

       
        if($conn->query($query)==TRUE){
            $_SESSION['message'] = 'Modelo '.$nombre.' Agregada Exitosamente';
            $_SESSION['message_type'] = 'info';
            header("Location: formModelos.php");
        }else{
            echo "Error de Conexion";
        }

}