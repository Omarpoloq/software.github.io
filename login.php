<!DOCTYPE html>
<html lang="en">


<?php include 'header.php' ?>
<body class="hold-transition login-page bg-black">
<div class="login-box">
  <div class="login-logo">
   <!-- <a href="#" class="text-white"><b><?php echo $_SESSION['system']['name'] ?> - Admin</b></a>-->
<img src="assets/uploads/logo-final-ADEIND-1.png" alt="" height="200" width="300">
   <a href="#" class="text-white"><b>Adeind Software</b></a>
  </div>
  <!-- /.login-logo -->
  <?php
    if (isset($_COOKIE['error_message'])) {
        echo $_COOKIE['error_message'];
        setcookie('error_message', '', time() - 3600, '/'); // Borra la cookie
    }
    ?>
  <div class="card">
    <div class="card-body login-card-body">
      <form action="validacionlogin.php" method="POST" id="login-form">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="usuario" required placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="contraseña" required placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                  Recuerdame
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


</body>
</html>

