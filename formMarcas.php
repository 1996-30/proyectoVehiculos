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
            <form action="GuardaMarca.php" method="POST">
                <div class="form-group">
                    <h5>Registro Marcas de Vehiculos:</h5>
                </div>
                <br><!-- Este es un salto de linea -->
                <div class="form-group">
                    <input type="text" name="nombre"  class="form-control" placeholder="Ingrese Marca"></text>
                </div>
                <br>
                <input type="submit" class="btn btn-info btn-block" name="guardaMarca" value="Guardar">
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
                <th>Marca Vehiculos</th>
                <th>Acciones</th>

                </tr>
                </thead>
                <tbody>
                    <?php

                        $query = "SELECT * FROM marcas";
                        $result_task = mysqli_query($conn,$query);

                        while($row = mysqli_fetch_array($result_task))  {               ?>
                        <tr>
                            <td><?php echo $row['id_marca']?></td>
                            <td><?php echo $row['nombre']?></td>
                            
                            <td>
                                <a href="updateMarcas.php?id_marca=<?php echo $row['id_marca']; ?>" class="btn btn-success">Actualizar</a>
                                <a href="deleteMarcas.php?id_marca=<?php echo $row['id_marca']; ?>" class="btn btn-danger">Eliminar</a>
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