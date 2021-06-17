<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>Input Nilai Program Profesi FK UMS</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>
                  <form class="user" method="post">
                    <div class="form-group">
                      <input type="text" name="usernamena" class="form-control" placeholder="Masukan Username">
                    </div>
                    <div class="form-group">
                      <input type="password" name="passwordna" class="form-control" placeholder="Password">
                    </div>
                    <hr>
                    <div class="form-group">
                      <input type="submit" name="login" class="btn btn-primary btn-block">
                    </div>
                  </form>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>

</html>

<?php
  if (isset($_POST['login'])){
      require "koneksi.php";
      $username = $_POST['usernamena'];
      $passw = $_POST['passwordna'];
      $password = sha1(md5($passw));
      $query = mysqli_query($koneksi, "SELECT * FROM ipt_user WHERE username = '$username' AND password = '$password'");
      $ada = mysqli_num_rows($query);
      $e =mysqli_fetch_array($query);
      if ($ada > 0){
        session_start();
        $_SESSION['ipt_username'] = $username;
        $_SESSION['ipt_password'] = $password;
        $_SESSION['ipt_nama'] = $e['nama'];
        $_SESSION['ipt_level'] = $e['level'];


        header("Location:index.php");
      }else{
        $q_koas = mysqli_query($koneksi, "SELECT * FROM dt_login WHERE user = '$username' AND pass = '$passw'");
        $a = mysqli_num_rows($q_koas);
        $b = mysqli_fetch_array($q_koas);
        if ($b > 0){
          session_start();
          $_SESSION['ipt_username'] = $username;
          $_SESSION['ipt_password'] = $password;
          $_SESSION['ipt_nama'] = $b['id'];

          $_SESSION['ipt_level'] = $b['level'];


          header("Location:index.php");
        }else{
          echo "<script>alert('Username dan Password Salah, silakan di ulangi')</script>";
      }
    }
  }
?>