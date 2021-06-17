<?php
    if (isset($_POST['cari'])) {
        $rs = $_POST['rs'];
        $nim_ = $_POST['nim'];
        $id_stase = $_POST['stase']; 
        $cek = mysqli_query($koneksi, "SELECT * FROM ipt_nilai_akhir WHERE nim = '$nim_' AND id_stase = '$id_stase'");
        $ada = mysqli_num_rows($cek);
        if ($ada > 0){
            $koas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_koas WHERE nim = '$nim_'"));
            $stase = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_stase WHERE id_stase = '$id_stase'"));
            echo "<script>alert('Stase $stase[nama_stase] pada Koas $koas[nama] sudah terinput nilai akhir, tidak dapat di edit')</script>";
        }else{
          $koas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_koas WHERE nim = '$nim_'"));
          $stase = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_stase WHERE id_stase = '$id_stase'"));
          $rs = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_rs WHERE id_rs = '$rs'"));
        ?>
<div class="container-fluid" id="container-wrapper">
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-body">  
      <form action="" method="POST">  
      <div class="form-group">
          <input type="text" name="nim" class="form-control" value="<?php echo "$koas[nim]" ?>" readonly>
          <input type="text" class="form-control" value="<?php echo "$koas[nama]" ?>"readonly>
          <input type="text" class="form-control" value="<?php echo "$stase[nama_stase]" ?>" readonly>
          <input type="text" class="form-control" value="<?php echo "$rs[nama_rs]" ?>" readonly>
          <input type="hidden" name="rs" class="form-control" value="<?php echo "$rs[id_rs]" ?>" readonly>
          <input type="hidden" name="stase" class="form-control" value="<?php echo "$stase[id_stase]" ?>" readonly>
        </div>              
        <table class="table align-items-center">
            <thead class="thead-light">
              <tr>
                <th>NO</th>
                <th>UJIAN</th>
                <th>NILAI</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 1;

                $q_ujian = mysqli_query($koneksi, "SELECT * FROM ipt_ujian WHERE id_ujian NOT IN (SELECT id_ujian FROM ipt_nilai WHERE nim = '$nim_' AND id_stase = '$id_stase')");
                while ($d_ujian = mysqli_fetch_array($q_ujian)) {
              ?>
              <tr>
                <td><?php echo "$no"; ?></td>
                <td><?php echo "$d_ujian[nama_ujian]"; ?></td>
                <td>
                    <input type="text" class="form-control" name="nilai<?php echo "$d_ujian[id_ujian]"; ?>">
                </td>
              </tr>
          <?php $no++; } ?>
              <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="simpan" value="simpan" class="btn btn-primary"></td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
  <?php }} ?>
  </div>
</div>
</div>
<?php
  if (isset($_POST['simpan'])){
    $rs = $_POST['rs'];
    $nim = $_POST['nim'];
    $id_stase = $_POST['stase']; 
    $lokasi = $_SESSION['ipt_lokasi'];
    $q_ujian = mysqli_query($koneksi, "SELECT * FROM ipt_ujian WHERE id_ujian NOT IN (SELECT id_ujian FROM ipt_nilai WHERE nim = '$nim' AND id_stase = '$id_stase')");
      while ($d_ujian = mysqli_fetch_array($q_ujian)) {
          $nilai_ = $_POST['nilai'.$d_ujian['id_ujian']];
          $id_ujian = $d_ujian['id_ujian'];
          if ($nilai_ == "") {
            continue;
          }else{
            $cariid = mysqli_query($koneksi, "SELECT max(id_nilai) FROM ipt_nilai") or die(mysqli_error());
            $dataid = mysqli_fetch_array($cariid);
            if ($dataid) {
              $nilai = $dataid[0];
              $id = (int) $nilai;
              $id = $id + 1;
              $idotomatis = $id;
            }else{
              $idotomatis = 1;
            }
            $insert_nilai = mysqli_query($koneksi, "INSERT INTO ipt_nilai(id_nilai, nim, id_stase, id_rs, id_ujian, nilai) VALUES('$idotomatis','$nim', '$id_stase', '$rs', '$id_ujian', '$nilai_')");
            $insert_status = mysqli_query($koneksi, "INSERT INTO ipt_status(id_nilai, lokasi, status) VALUES('$idotomatis', '$lokasi', 0)");
          } 
      }
      $link = "index.php?pages=".sha1(md5("input_nilai2")); ?>
          <script language="javascript">document.location="<?php echo "$link"; ?>";</script>
      <?php
    }
?>