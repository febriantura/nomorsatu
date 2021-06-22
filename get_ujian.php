<?php 
include 'koneksi.php';
$id = $_POST['id'];

$stase = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_stase WHERE id_stase = '$id'"));
?>

	<select id="ujian">
		<?php 
		$q_ujian = mysqli_query($koneksi, "SELECT * FROM ipt_ujian WHERE kd_stase = '$stase[kd_stase]'");
		while($d = mysqli_fetch_array($q_ujian)){
			?>
			<option value="<?php echo $d['id_ujian']; ?>"><?php echo $d['nama_ujian']; ?></option>
			<?php 
		}
		?>
	</select>
