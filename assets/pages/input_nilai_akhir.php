<div class="container-fluid" id="container-wrapper">
	<div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">INPUT NILAI AKHIR</h6>
      </div>
      <div class="card-body"> 
      <form action="" method="post">                 
        <div class="form-group">
          <label for="select2Multiple">NIM dan NAMA KOAS</label>
          <select class="select2 form-control" name="nim">
            <option value=""></option>
            <?php 
                $q_koas = mysqli_query($koneksi, "SELECT * FROM dt_koas");
                while ($d_koas = mysqli_fetch_array($q_koas)) {
                    echo "<option value=$d_koas[nim]>$d_koas[nama]</option>";
                }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="select2SinglePlaceholder">STASE</label>
          <select class="select2 form-control" name="stase">
            <option value=""></option>
                <?php 
                    $q_stase = mysqli_query($koneksi, "SELECT * FROM dt_stase");
                    while ($d_stase = mysqli_fetch_array($q_stase)) {
                        echo "<option value=$d_stase[id_stase]>$d_stase[nama_stase]</option>";
                    }
                ?>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">NILAI ANGKA</label>
          <input type="number" name="nilai_angka" class="form-control" placeholder="Masukan Nilai Angka">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">NILAI HURUF</label>
          <input type="text" name="nilai_huruf" class="form-control" placeholder="Masukan Nilai Huruf" style="text-transform:uppercase" >
        </div>
        <button type="submit" name="input_nilai" class="btn btn-primary">Submit</button>
      </form>
      </div>
  </div>
</div>
</div>

<?php
    if (isset($_POST['input_nilai'])) {
    $id_stase = $_POST['stase'];
    $nim = $_POST['nim'];
    $nilai_angka = $_POST['nilai_angka'];
    $nilai_huruf = strtoupper($_POST['nilai_huruf']);
    $cek = mysqli_query($koneksi, "SELECT * FROM ipt_nilai_akhir WHERE nim = '$nim' AND id_stase = '$id_stase'");
    $ada = mysqli_num_rows($cek);
    if ($ada > 0){
        $koas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_koas WHERE nim = '$nim'"));
        $stase = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_stase WHERE id_stase = '$id_stase'"));
        echo "<script>alert('Stase $stase[nama_stase] pada Koas $koas[nama] sudah terinput')</script>";
    }else{

    $cariid = mysqli_query($koneksi, "SELECT max(id_nilai_akhir) FROM ipt_nilai_akhir") or die(mysqli_error());
    $dataid = mysqli_fetch_array($cariid);
    if ($dataid) {
      $nilai = $dataid[0];
      $id = (int) $nilai;
      $id = $id + 1;
      $idotomatis = $id;
    }else{
      $idotomatis = 1;
    }

    $insert_nilai = mysqli_query($koneksi, "INSERT INTO ipt_nilai_akhir(id_nilai_akhir, nim, id_stase, nilai_angka, nilai_huruf) VALUES('$idotomatis','$nim', '$id_stase', $nilai_angka, '$nilai_huruf')");
    if ($insert_nilai) {
      $link = "index.php?pages=".sha1(md5("input_nilai")); ?>
          <script language="javascript">document.location="<?php echo "$link"; ?>";</script>
      <?php 
    }else{
      echo "<script>alert('SIMPAN GAGAL')</script>";
      $link = "index.php?pages=".sha1(md5("input_nilai")); ?>
          <script language="javascript">document.location="<?php echo "$link"; ?>";</script>
      <?php 
    }
  }
}
?>