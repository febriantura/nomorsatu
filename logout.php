<?php
	session_start();
	unset($_SESSION['ipt_username']);
  	unset($_SESSION['ipt_password']);
  	unset($_SESSION['ipt_nama']);
  	unset($_SESSION['ipt_level']);
	header("Location:login.php");
?>