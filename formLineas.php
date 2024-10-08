<?php 
include("db.php");
session_start();

$marcas ="SELECT id_marca, nombre FROM marcas";
$result = mysqli_query($conn, $marcas);


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
            <form action="GuardaLinea.php" method="POST">
                <div class="form-group">
                    <h5>Registro Lineas de Vehiculos:</h5>
                </div>
                <br><!-- Este es un salto de linea -->
                <div class="form-group">
                    <input type="text" name="nombre"  class="form-control" placeholder="Ingrese Linea de Vehiculo"></text>
                </div>
                <br>
                <div>
                <label for="Marcas" class="form-control">Seleccione Marca:</label><br>
                    <select name="id_marca" id="marcas" class="form-control">
                    <option value=""></option>
                    <?php while($row = $result->fetch_assoc()){ ?>
                        <option value="<?php echo $row['id_marca']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php } ?>
                    </select>
                </div>
                <br>
                <input type="submit" class="btn btn-info btn-block" name="guardaLinea" value="Guardar">
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
                <th>Linea Vehiculos</th>
                <th>Marca</th>
                <th>Acciones</th>

                </tr>
                </thead>
                <tbody>
                    <?php

                        $query = "SELECT id_linea, linea.nombre as nombre, marca_id, marcas.nombre AS marca FROM linea 
                        INNER JOIN marcas ON linea.marca_id=marcas.id_marca
                        ORDER BY marca";
                        $result_task = mysqli_query($conn,$query);

                        while($row = mysqli_fetch_array($result_task))  {               ?>
                        <tr>
                            <td><?php echo $row['id_linea']?></td>
                            <td><?php echo $row['nombre']?></td>
                            <td><?php echo $row['marca']?></td>
                    
                            
                            <td>
                                <a href="updateLineas.php?id_linea=<?php echo $row['id_linea']; ?>" class="btn btn-success">Actualizar</a>
                                <a href="deleteLineas.php?id_linea=<?php echo $row['id_linea']; ?>" class="btn btn-danger">Eliminar</a>
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