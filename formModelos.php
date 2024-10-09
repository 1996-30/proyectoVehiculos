<?php 
include("db.php");
session_start();
?>

<?php 
include("header.php")
?>

 <div class="container p-4">
    <div class="row">
        <div class="col-md-4">
        <!-- contenido de la columna 4 formulario -->
        
        <!-- alert conf -->
       
        <?php if(isset($_SESSION['message'])){ ?>
                   
                   <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                   <?= $_SESSION['message']?>
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>

            
        <?php 
        session_unset();
         }
         ?>
         <div class="car card-body">
            <form action="GuardaModelo.php" method="POST">
                <div class="form-group">
                    <h5>Registro Modelos de Vehiculos:</h5>
                </div>
                <br><!-- Este es un salto de linea -->
                <div class="form-group">
                    <input type="text" name="nombre"  class="form-control" placeholder="Ingrese Modelo Auto"></text>
                </div>
                <br>
                <input type="submit" class="btn btn-info btn-block" name="guardaModelo" value="Guardar">
                 <input type="submit" class="btn btn-danger btn-block"  value="Cancelar"> 
            </form>

         </div>
        </div>
           <!-- contenido de la columna 8 tabla de datois -->
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                <tr>
                <th>Codigo</th> 
                <th>Modelo Vehiculos</th>
                <th>Acciones</th>

                </tr>
                </thead>
                <tbody>
                    <?php

                        $cSql = "SELECT * FROM modelo";
                        $resultado = mysqli_query($conn,$cSql);

                        while($row = mysqli_fetch_array($resultado))  {               ?>
                        <tr>
                            <td><?php echo $row['id_modelo']?></td>
                            <td><?php echo $row['nombre']?></td>
                            
                            <td>
                                <a href="updateModelos.php?id_modelo=<?php echo $row['id_modelo']; ?>" class="btn btn-success">Actualizar</a>
                                <a href="deleteModelos.php?id_modelo=<?php echo $row['id_modelo']; ?>" class="btn btn-danger">Eliminar</a>
                            </td>

                        </tr>

                        <?php }?>

            </tbody>
            </table>
      
        </div>

    </div>

 </div>


    <?php 
include("footer.php");
?>    