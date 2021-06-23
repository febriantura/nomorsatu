<?php
	$host	=	"localhost";
	$user	=	"restu";
	$pass	=	"restu2211";
	$data	=	"profesi_data";

	$koneksi	=	mysqli_connect($host, $user, $pass, $data);
	if (!$koneksi) {
		die("Koneksi salah : ".mysqli_connect_error());
	}
?>
