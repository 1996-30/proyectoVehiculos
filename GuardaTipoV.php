<?php
session_start();
include ("db.php");

if(isset($_POST['guardaTipoV'])){
   
    $nombre = $_POST['nombre'];
    

    $query = "INSERT INTO tipo_vehiculo(nombre)
              VALUES ('$nombre')";

       
        if($conn->query($query)==TRUE){
            $_SESSION['message'] = 'Tipo de Vehiculo '.$nombre.' Agregada Exitosamente';
            $_SESSION['message_type'] = 'info';
            header("Location: formTiposV.php");
        }else{
            echo "Error de Conexion";
        }

}