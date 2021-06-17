<div class="container-fluid" id="container-wrapper">
	<div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">EDIT NILAI</h6>
      </div>
      <div class="card-body">  
      <form action="" method="post">                
        <div class="form-group">
          <label for="select2Multiple">NIM dan NAMA KOAS</label>
          <select class="select2 form-control" name="nim">
            <option value=""></option>
            <?php 
                $q_koas = mysqli_query($koneksi, "SELECT DISTINCT nim FROM ipt_nilai");
                while ($d_koas = mysqli_fetch_array($q_koas)) {
                $nama_koas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_koas WHERE nim = '$d_koas[nim]'"));
                    echo "<option value=$d_koas[nim]>$d_koas[nim] - $nama_koas[nama]</option>";
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
        <button type="submit" name="cari" class="btn btn-primary">Cari Koas</button>
    </form>
      </div>
    </div>
  </div>
    <?php
    if (isset($_POST['cari'])) {
        $nim_ = $_POST['nim'];
        $id_stase = $_POST['stase']; 
        $cek = mysqli_query($koneksi, "SELECT * FROM ipt_nilai_akhir WHERE nim = '$nim_' AND id_stase = '$id_stase'");
        $ada = mysqli_num_rows($cek);
        if ($ada > 0){
            $koas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_koas WHERE nim = '$nim_'"));
            $stase = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_stase WHERE id_stase = '$id_stase'"));
            echo "<script>alert('Stase $stase[nama_stase] pada Koas $koas[nama] sudah terinput nilai akhir, tidak dapat di edit')</script>";
        }else{
        ?>
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-body">                  
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th>No</th>
                <th>NIM</th>
                <th>NAMA</th>
                <th>STASE</th>
                <th>UJIAN</th>
                <th>NILAI</th>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    $q_nilai = mysqli_query($koneksi, "SELECT * FROM ipt_nilai WHERE nim = '$nim_' and id_stase = '$id_stase'");
                    while ($d_nilai = mysqli_fetch_array($q_nilai)) {
                        $nama_koas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_koas WHERE nim = '$d_nilai[nim]'"));
                        $nama_stase = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_stase WHERE id_stase = '$d_nilai[id_stase]'"));
                        $nama_ujian = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ipt_ujian WHERE id_ujian = '$d_nilai[id_ujian]'"));
                ?>
              <tr>
                <td><?php echo "$no"; ?></td>
                <td><?php echo "$d_nilai[nim]"; ?></td>
                <td><?php echo "$nama_koas[nama]"; ?></td>
                <td><?php echo "$nama_stase[nama_stase]"; ?></td>
                <td><?php echo "$nama_ujian[nama_ujian]"; ?></td>

                <form action="" method="post">
                    <td>
                        <input type="number" name="nilai" value="<?php echo "$d_nilai[nilai]"; ?>">
                        <input type="hidden" name="id" value="<?php echo "$d_nilai[id_nilai]"; ?>">
                    </td>
                    <td>
                        <input type="submit" name="simpan" class="btn btn-info" value="Edit Nilai">
                    </td>
                </form>

              </tr>
          <?php $no++; } ?>
            </tbody>
          </table>
      </div>
  <?php }} ?>
  </div>
</div>
</div>
<?php
  if (isset($_POST['simpan'])){
        $id = $_POST['id'];
        $nilai = $_POST['nilai'];
        mysqli_query($koneksi, "UPDATE ipt_nilai SET nilai = '$nilai' WHERE id_nilai = '$id'");
        $link = "index.php?pages=".sha1(md5("edit_nilai")); ?>
          <script language="javascript">document.location="<?php echo "$link"; ?>";</script>
          <?php
    }
?>