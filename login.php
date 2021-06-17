<!DOCTYPE html>
<html>
<head>
	<title>LOGIN INPUT NILAI</title>
	<link href="img/logo/logo3.png" rel="icon">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="assets_login/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets_login/css/style.css">

	

</head>
<body>
	<div class="container">
		<!--navbar-->
		<div class="header-area">
			  <!-- site-navbar start -->
			  <div class="navbar-area">
			  
			      <nav class="site-navbar">
			        <!-- site logo -->
   					<a href="#home" class="site-logo"><img src="assets_login/images/logo.png" width="50%"></a>

			      </nav>
			  
			  </div><!-- navbar-area end -->

		</div>
		<!--login form -->
		<div id="login" class="row col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="col-lg-6 col-md-6">
				<img class="pic-login-2" src="assets_login/images/pic-login-2.svg">
			</div>
			<form action="" method="post" class="col-lg-5 col-md-6 col-sm-12 col-12 login-form">
					<h4>LOGIN</h4>
					<div class="form-group">
						<input type="text" class="form-control form-control-lg" placeholder="Username" name="usernamena" autocomplete="off">
						<svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
						</svg>
					</div>
					<div class="form-group">
						<input type="password" class="form-control form-control-lg" placeholder="Password" name="passwordna" autocomplete="off">
						<svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-lock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path d="M2.5 9a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9z"/>
						  <path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>
						</svg>
					</div>
					<div class="login-btn">
						<button class="btn btn-primary" type="submit" name="login">Log in</button>
					</div>
			</form>
		</div>
		
	</div>
	
    <script src="assets_login/js/jquery-3.5.1.slim.min.js"></script>
	<script src="assets_login/js/popper.min.js"></script>
	<script src="assets_login/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets_login/js/login.js"></script>
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
        $_SESSION['ipt_lokasi'] = $e['lokasi'];


        header("Location:index.php");
      }else{
        $q_koas = mysqli_query($koneksi, "SELECT * FROM dt_login WHERE user = '$username' AND pass = '$passw' AND level = 'koas'");
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