<div class="container-fluid" id="container-wrapper">
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">CEK NILAI KOAS</h6>
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
        <button type="submit" name="cari" class="btn btn-primary">Cek Nilai Koas</button>
    </form>
      </div>
    </div>
    <?php
    if (isset($_POST['cari'])) {
        $nim_ = $_POST['nim'];
        $koas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_koas WHERE nim = '$nim_'"));
        ?>
        <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">NILAI KOAS</h6>
      </div>
      <div class="card-body">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-3 col-form-label">NIM KOAS</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" value="<?php echo "$koas[nim]"; ?>" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-3 col-form-label">NAMA KOAS</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" value="<?php echo "$koas[nama]"; ?>" readonly>
          </div>
        </div>
      </div>
      <div class="card-body">                  
        <table class="table align-items-center table-flush table-hover">
            <thead class="thead-light">
              <tr>
                <th>NO</th>
                <th>STASE</th>
                <th>NILAI HURUF</th>
                <th>NILAI ANGKA</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    $q_nilai = mysqli_query($koneksi, "SELECT * FROM dt_stase");
                    while ($d_nilai = mysqli_fetch_array($q_nilai)) {
                  ?>
                  <tr>
                    <td><?php echo "$no"; ?></td>
                    <td><?php echo "$d_nilai[nama_stase]"; ?></td>
                    <?php
                      $nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ipt_nilai_akhir WHERE id_stase = '$d_nilai[id_stase]' AND nim = '$nim_'"));
                      if (!$nilai) { ?> 
                          <td><center> - </center></td>
                          <td><center> - </center></td>
                      <?php }else{ ?> 
                          <td><center><?php echo "$nilai[nilai_angka]" ?></center></td>
                          <td><center><?php echo "$nilai[nilai_huruf]"; ?></center></td>
                      <?php } ?> 
                  </tr>
              <?php $no++; } ?>
            </tbody>
          </table>
      </div>
  <?php } ?>
  </div>
</div>