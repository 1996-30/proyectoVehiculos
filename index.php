<?php 
session_start(); // Asegúrate de que esto esté al inicio del archivo
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/car.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Reserva Vehiculos</title>
</head>
<body>
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="img/img2.jpg" alt="login form" class="img-fluid" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

               <!-- alert conf. -->
               <?php 
               if(isset($_SESSION['message'])) { ?>
                    <div class="alert alert-<?= htmlspecialchars($_SESSION['message_type'])?> alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['message'])?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div> 
            <?php 
            if(isset($_SESSION['redirect']) && $_SESSION['redirect']==true) { ?>
                    <script>
                        setTimeout(function(){
                            window.location.href = "control_usuarios.php";
                        }, 2000);
                    </script>     
            <?php } session_unset(); } ?>
                <!-- end alert conf. -->

               <!-- Formulario de inicio de sesión -->
                <form class="login-form" action="login.php" method="POST">
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <span class="h1 fw-bold mb-0" id="title">CARS</span>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="text" id="nombre" class="form-control form-control-lg" name="nombre" placeholder="Ingrese su nombre" required />
                  </div>
                  <div class="form-outline mb-4">
                    <input type="password" id="contraseña" class="form-control form-control-lg" name="contraseña" placeholder="Ingrese su contraseña" required />
                  </div>
                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Ingresar</button>
                  </div>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">¿No tienes una cuenta? <a href="create.php" style="color: #393f81;">Registrate Aqui</a></p>
                 </form>
                
                <!-- Redes Sociales -->
                <div class="text-center">
                  <p>Síguenos en:</p>
                  <a href="https://facebook.com" class="btn btn-outline-primary btn-sm" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                  </a>
                  <a href="https://twitter.com" class="btn btn-outline-info btn-sm" target="_blank">
                    <i class="fab fa-twitter"></i>
                  </a>
                  <a href="https://instagram.com" class="btn btn-outline-danger btn-sm" target="_blank">
                    <i class="fab fa-instagram"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
