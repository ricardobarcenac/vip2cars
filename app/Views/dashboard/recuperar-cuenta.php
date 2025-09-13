<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?= $titulo ?></title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="<?= $baseUrl ?>/public/plugins/fontawesome-free/css/all.min.css">
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="<?= $baseUrl ?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
      <!-- Toastr -->
      <link rel="stylesheet" href="<?= $baseUrl ?>/public/plugins/toastr/toastr.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="<?= $baseUrl ?>/public/css/adminlte.min.css">
   </head>
   <body class="hold-transition login-page" style="background-color: #1c222e">
      <div class="login-box">
         <div class="card card-outline card-danger">
            <div class="card-header text-center">
               <a href="<?= $baseUrl ?>" class="h1"><img class="w-50" src="<?= $baseUrl ?>/public/assets/images/logo.png" /></a>
            </div>
            <div class="card-body">
               <p class="login-box-msg">Ingresa una nueva contraseña para recuperar tu cuenta.</p>
               <form class="formulario" action="<?= $baseUrl ?>/grabar-recuperacion/<?= $token ?>" method="POST">
                  <span class="respuesta"></span>
                  <div class="input-group mb-3">
                     <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ingresa tu contraseña">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-lock"></span>
                        </div>
                     </div>
                  </div>
                  <div class="input-group mb-3">
                     <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena" placeholder="Ingresa la confirmación de contraseña">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-lock"></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12">
                        <button type="submit" class="btn btn-dark btn-block"><i class="fas fa-history mr-2"></i>Actualizar contraseña</button>
                     </div>
                     <!-- /.col -->
                  </div>
               </form>
               <p class="mt-3 mb-1">
                  <a href="<?= $baseUrl ?>/iniciar-sesion">Ya tengo una cuenta</a>
               </p>
            </div>
            <!-- /.login-card-body -->
         </div>
      </div>
      <!-- /.login-box -->
      <!-- jQuery -->
      <script src="<?= $baseUrl ?>/public/plugins/jquery/jquery.min.js"></script>
      <!-- Bootstrap 4 -->
      <script src="<?= $baseUrl ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- Toastr -->
      <script src="<?= $baseUrl ?>/public/plugins/toastr/toastr.min.js"></script>
      <!-- AdminLTE App -->
      <script src="<?= $baseUrl ?>/public/js/adminlte.min.js"></script>
      <script src="<?= $baseUrl ?>/public/assets/js/proceso.js"></script>
   </body>
</html>