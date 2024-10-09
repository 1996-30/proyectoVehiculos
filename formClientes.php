<?php 
include("db.php");
session_start();
?>

<?php 
include("header.php")
?>

 <div class="container p-4">
    <div class="row">
        <div class="col-md-3">
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
            <form action="GuardaCliente.php" method="POST">
                <div class="form-group">
                    <h5>Registro Clientes:</h5>
                </div>
                <br><!-- Este es un salto de linea -->
                <div class="form-group">
                    <label>Cliente:</label>
                    <input type="text" name="nombre"  class="form-control" placeholder="Nombre del Cliente"></text>
                    <br>
                    <label for="">DPI:</label>
                    <input type="text" name="dpi"  class="form-control" placeholder="DPI"></text>
                    <br>
                    <label for="">NIT:</label>
                    <input type="text" name="nit"  class="form-control" placeholder="NIT"></text>
                    <br>
                    <label for="">Correo Electrónico:</label>
                    <input type="email" name="email"  class="form-control" placeholder="Correo Electrónico"></text>

                </div>
                <br>
                <input type="submit" class="btn btn-info btn-block" name="guardaCliente" value="Guardar">
                 <input type="submit" class="btn btn-danger btn-block"  value="Cancelar"> 
            </form>

         </div>
        </div>
           <!-- contenido de la columna 8 tabla de datos -->
        <div class="col-md-9">
            <table class="table table-bordered">
                <thead>
                <tr>
                <th>Codigo</th> 
                <th>cliente</th>
                <th>DPI</th>
                <th>NIT</th>
                <th>Correo Electrónico</th>
                <th>Acciones</th>

                </tr>
                </thead>
                <tbody>
                    <?php

                        $query = "SELECT * FROM cliente";
                        $result_task = mysqli_query($conn,$query);

                        while($row = mysqli_fetch_array($result_task))  {               ?>
                        <tr>
                            <td><?php echo $row['id_cliente']?></td>
                            <td><?php echo $row['nombre']?></td>
                            <td><?php echo $row['DPI']?></td>
                            <td><?php echo $row['NIT']?></td>
                            <td><?php echo $row['email']?></td>
                            
                            <td>
                                <a href="updateClientes.php?id_cliente=<?php echo $row['id_cliente']; ?>" class="btn btn-success">Actualizar</a>
                                <a href="deleteClientes.php?id_cliente=<?php echo $row['id_cliente']; ?>" class="btn btn-danger">Eliminar</a>
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