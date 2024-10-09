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
                    <h5>Registro de Vehiculos:</h5>
                </div>
                <br><!-- Este es un salto de linea -->
                <div class="form-group">
                    <input type="text" name="marca"  class="form-control" placeholder="Ingrese la Marca del Vehiculo"></text>
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
                <th>ID</th> 
                <th>Marca</th>
                <th>Modelo</th>
                <th>Linea</th>
                <th>Tipo</th>
                <th>Matricula</th>
                <th>Status</th>
                <th>Fecha Registro</th>
                <th>Acciones</th>

                </tr>
                </thead>
                <tbody>
                    <?php

                        $query = "SELECT id_vehiculo AS id,
                                    mar.nombre AS marca,
                                    mo.nombre AS modelo,
                                    li.nombre AS linea,
                                    ti.nombre AS tipo,
                                    v.matricula AS matricula,
                                    es_v.nombre AS status,
                                    fecha_creacion AS fecha
                                    FROM vehiculos AS v LEFT JOIN marcas AS mar ON(v.id_marca=mar.id_marca)
                                    LEFT JOIN modelo AS mo ON(v.id_modelo=mo.id_modelo)
                                    LEFT JOIN linea AS li ON(v.id_linea=li.id_linea)
                                    LEFT JOIN tipo_vehiculo AS ti ON(v.id_linea=ti.id_tipo)
                                    LEFT JOIN status_v AS es_v ON(v.status=es_v.status)";

                        $result_task = mysqli_query($conn,$query);

                        while($row = mysqli_fetch_array($result_task))  {               ?>
                        <tr>
                            <td><?php echo $row['id']?></td>
                            <td><?php echo $row['marca']?></td>
                            <td><?php echo $row['modelo']?></td>
                            <td><?php echo $row['linea']?></td>
                            <td><?php echo $row['tipo']?></td>
                            <td><?php echo $row['matricula']?></td>
                            <td><?php echo $row['status']?></td>
                            <td><?php echo $row['fecha']?></td>
                                                
                            <td>
                                <a href="updateLineas.php?id_linea=<?php echo $row['id']; ?>" class="btn btn-success">Actualizar</a>
                                <a href="deleteLineas.php?id_linea=<?php echo $row['id']; ?>" class="btn btn-danger">Eliminar</a>
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