<div class="container-fluid" id="container-wrapper">
	<div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">INPUT NILAI</h6>
      </div>
      <div class="card-body"> 
      <form action="" method="post">                 
        <div class="form-group">
          <label for="select2Single">RUMAH SAKIT</label>
          <select class="select2 form-control" name="rs">
            <option value=""></option>
                <?php 
                $lokasi = $_SESSION['ipt_lokasi'];
                  if ($lokasi == 'ponorogo') {
                    echo "<option value='RS01'>RSUD Dr. Harjono S. Ponorogo</option>";
                  }elseif ($lokasi == 'sukoharjo') {
                    echo "<option value='RS02'>RSUD Sukoharjo</option>";
                  }elseif($lokasi == 'magetan') {
                    echo "<option value='RS10'>RSUD dr. Sayidiman Magetan</option>";
                  }elseif ($lokasi == 'karanganyar') {
                    echo "<option value='RS03'>RSUD Karanganyar</option>";
                  }else{
                    $q_rs = mysqli_query($koneksi, "SELECT * FROM dt_rs");
                    while ($d_rs = mysqli_fetch_array($q_rs)) {
                        echo "<option value=$d_rs[id_rs]>$d_rs[nama_rs]</option>";
                    }
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
          <label for="select2Multiple">NIM dan NAMA KOAS</label>
          <select class="select2 form-control" name="nim">
            <option value=""></option>
            <?php 
                $q_koas = mysqli_query($koneksi, "SELECT * FROM dt_koas");
                while ($d_koas = mysqli_fetch_array($q_koas)) {
                    echo "<option value=$d_koas[nim]>$d_koas[nim] - $d_koas[nama]</option>";
                }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="select2SinglePlaceholder">JENIS UJIAN</label>
          <select class="select2 form-control" name="ujian">
            <option value=""></option>
            <?php 
                $q_ujian = mysqli_query($koneksi, "SELECT * FROM ipt_ujian");
                while ($d_ujian = mysqli_fetch_array($q_ujian)) {
                    echo "<option value=$d_ujian[id_ujian]>$d_ujian[nama_ujian]</option>";
                }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">NILAI</label>
          <input type="text" name="ket" class="form-control">
        </div>
        <button type="submit" name="input_nilai" class="btn btn-primary">Submit</button>
      </form>
      </div>
  </div>
</div>
</div>

<?php
    if (isset($_POST['input_nilai'])) {
    $id_rs = $_POST['rs'];
    $id_stase = $_POST['stase'];
    $nim = $_POST['nim'];
    $id_ujian = $_POST['ujian'];
    $ket = $_POST['ket'];

    $cek = mysqli_query($koneksi, "SELECT * FROM ipt_nilai WHERE nim = '$nim' AND id_stase = '$id_stase' AND id_ujian = '$id_ujian'");
    $ada = mysqli_num_rows($cek);
    if ($ada > 0){
        $koas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_koas WHERE nim = '$nim'"));
        $stase = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_stase WHERE id_stase = '$id_stase'"));
        $ujian = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ipt_ujian WHERE id_ujian = '$id_ujian'"));
        echo "<script>alert('Nilai $ujian[nama_ujian] - $stase[nama_stase] pada Koas $koas[nama] sudah terinput')</script>";
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

      $insert_nilai = mysqli_query($koneksi, "INSERT INTO ipt_nilai(id_nilai, nim, id_stase, id_rs, id_ujian, nilai) VALUES('$idotomatis','$nim', '$id_stase', '$id_rs', '$id_ujian', '$ket')");
      $insert_status = mysqli_query($koneksi, "INSERT INTO ipt_status(id_nilai, lokasi, status) VALUES('$idotomatis', '$lokasi', 0)");

      if ($insert_nilai && $insert_status) {
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