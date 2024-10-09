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
            <form action="GuardaTipoV.php" method="POST">
                <div class="form-group">
                    <h5>Registro Tipos de Vehiculos:</h5>
                </div>
                <br><!-- Este es un salto de linea -->
                <div class="form-group">
                    <input type="text" name="nombre"  class="form-control" placeholder="Ingrese Tipo Vehiculo"></text>
                </div>
                <br>
                <input type="submit" class="btn btn-info btn-block" name="guardaTipoV" value="Guardar">
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
                <th>Tipo Vehiculo</th>
                <th>Acciones</th>

                </tr>
                </thead>
                <tbody>
                    <?php

                        $query = "SELECT * FROM tipo_vehiculo";
                        $resultado = mysqli_query($conn,$query);

                        while($row = mysqli_fetch_array($resultado))  {               ?>
                        <tr>
                            <td><?php echo $row['id_tipo']?></td>
                            <td><?php echo $row['nombre']?></td>
                            
                            <td>
                                <a href="updateTiposv.php?id_tipo=<?php echo $row['id_tipo']; ?>" class="btn btn-success">Actualizar</a>
                                <a href="deleteTiposV.php?id_tipo=<?php echo $row['id_tipo']; ?>" class="btn btn-danger">Eliminar</a>
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