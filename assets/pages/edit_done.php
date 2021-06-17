<div class="container-fluid" id="container-wrapper">
  <div class="col-lg-12">
    <?php
    if(@$_GET['a']== sha1(md5("done"))){ 
          $id =  base64_decode($_GET['id']);
          $na = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ipt_nilai_akhir WHERE id_nilai_akhir = '$id'"));
           $koas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_koas WHERE nim = '$na[nim]'"));
        ?>
        <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">HASIL EDIT  NILAI AKHIR</h6>
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
                    $q_nilai = mysqli_query($koneksi, "SELECT * FROM ipt_nilai_akhir WHERE id_nilai_akhir = '$id'");
                    while ($d_nilai = mysqli_fetch_array($q_nilai)) {
                      $stase = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_stase WHERE id_stase = '$na[id_stase]'"));

                  ?>
                  <tr>
                    <td><?php echo "$no"; ?></td>
                    <td><?php echo "$stase[nama_stase]"; ?></td>
                    <td><center><?php echo "$d_nilai[nilai_angka]" ?></center></td>
                    <td><center><?php echo "$d_nilai[nilai_huruf]"; ?></center></td>
                  </tr>
              <?php $no++; } ?>
            </tbody>
          </table>
      </div>
  <?php } ?>
  </div>
</div>
</div>