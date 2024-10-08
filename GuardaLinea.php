<?php
session_start();
include ("db.php");

if(isset($_POST['guardaLinea'])){
   
    $nombre = $_POST['nombre'];
    $marca_id = $_POST['id_marca'];
    

    $query = "INSERT INTO linea(nombre,marca_id)
              VALUES ('$nombre','$marca_id')";

       
        if($conn->query($query)==TRUE){
            $_SESSION['message'] = 'Linea '.$nombre.' Agregada Exitosamente';
            $_SESSION['message_type'] = 'info';
            header("Location: formLineas.php");
        }else{
            echo "Error de Conexion";
        }

}