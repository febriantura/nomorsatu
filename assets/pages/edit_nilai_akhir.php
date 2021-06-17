<div class="container-fluid" id="container-wrapper">
	<div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">EDIT NILAI AKHIR</h6>
      </div>
      <div class="card-body">  
      <form action="" method="post">                
        <div class="form-group">
          <label for="select2Multiple">NIM dan NAMA KOAS</label>
          <select class="select2 form-control" name="nim">
            <option value=""></option>
            <?php 
                $q_koas = mysqli_query($koneksi, "SELECT DISTINCT nim FROM ipt_nilai_akhir");
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
    <?php
    if (isset($_POST['cari'])) {
        $nim_ = $_POST['nim'];
        $id_stase = $_POST['stase']; 
        ?>
      <div class="card-body">                  
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th>No</th>
                <th>NIM</th>
                <th>NAMA</th>
                <th>STASE</th>
                <th>NILAI HURUF</th>
                <th>NILAI ANGKA</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    $q_nilai = mysqli_query($koneksi, "SELECT * FROM ipt_nilai_akhir WHERE nim = '$nim_' and id_stase = '$id_stase'");
                    while ($d_nilai = mysqli_fetch_array($q_nilai)) {
                        $nama_koas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_koas WHERE nim = '$d_nilai[nim]'"));
                        $nama_stase = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_stase WHERE id_stase = '$d_nilai[id_stase]'"));
                ?>
              <tr>
                <td><?php echo "$no"; ?></td>
                <td><?php echo "$d_nilai[nim]"; ?></td>
                <td><?php echo "$nama_koas[nama]"; ?></td>
                <td><?php echo "$nama_stase[nama_stase]"; ?></td>

                <form action="" method="post">
                    <td>
                        <input type="number" name="nilai_angka" value="<?php echo "$d_nilai[nilai_angka]"; ?>">
                    </td>
                    <td>
                        <input type="text" name="nilai_huruf" value="<?php echo "$d_nilai[nilai_huruf]"; ?>" style="text-transform:uppercase" >
                        <input type="hidden" name="id" value="<?php echo "$d_nilai[id_nilai_akhir]"; ?>">
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
  <?php } ?>
  </div>
</div>
</div>
<?php
  if (isset($_POST['simpan'])){
        $id = $_POST['id'];
        $nilai_angka = $_POST['nilai_angka'];
        $nilai_huruf = strtoupper($_POST['nilai_huruf']);
        mysqli_query($koneksi, "UPDATE ipt_nilai_akhir SET nilai_angka = '$nilai_angka', nilai_huruf = '$nilai_huruf' WHERE id_nilai_akhir = '$id'");
        $link = "index.php?pages=".sha1(md5("edit_done"))."&a=".sha1(md5("done"))."&id=".base64_encode("$id").""; ?>
          <script language="javascript">document.location="<?php echo "$link"; ?>";</script>
          <?php
    }
?>