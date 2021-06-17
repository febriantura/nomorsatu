<?php

// Bagian Home
if (@$_GET['pages']==''){
    	include "assets/pages/dashboard.php";
}
elseif ($_GET['pages']=='dashboard'){
	include "assets/pages/dashboard.php";
}
elseif ($_GET['pages']==sha1(md5("data_admin"))){
	include "assets/pages/data_admin.php";
}
elseif ($_GET['pages']==sha1(md5("data_admin_a"))){
	include "assets/pages/data_admin_a.php";
}
elseif ($_GET['pages']==sha1(md5("input_nilai"))){
	include "assets/pages/input_nilai.php";
}
elseif ($_GET['pages']==sha1(md5("edit_nilai"))){
	include "assets/pages/edit_nilai.php";
}
elseif ($_GET['pages']==sha1(md5("cek_nilai"))){
	include "assets/pages/cek_nilai.php";
}
elseif ($_GET['pages']==sha1(md5("input_nilai_akhir"))){
	include "assets/pages/input_nilai_akhir.php";
}
elseif ($_GET['pages']==sha1(md5("edit_nilai_akhir"))){
	include "assets/pages/edit_nilai_akhir.php";
}
elseif ($_GET['pages']==sha1(md5("edit_done"))){
	include "assets/pages/edit_done.php";
}
elseif ($_GET['pages']==sha1(md5("nilai_akhir"))){
	include "assets/pages/nilai_akhir.php";
}
elseif ($_GET['pages']==sha1(md5("export_nilai"))){
	include "assets/pages/export_nilai.php";
}
elseif ($_GET['pages']==sha1(md5("rekap_nilai"))){
	include "assets/pages/rekap_nilai.php";
}
elseif ($_GET['pages']==sha1(md5("input_nilai2"))){
	include "assets/pages/input_nilai2.php";
}
elseif ($_GET['pages']==sha1(md5("input_nilai2_a"))){
	include "assets/pages/input_nilai2_a.php";
}
else
{
	include "assets/pages/404.php";	
}
?>