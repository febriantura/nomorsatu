<?php 
if ($_SESSION['ipt_level'] == "superadmin") { ?>
<div class="container-fluid" id="container-wrapper">
  <div class="row">
    <div class="col-lg-12 mb-4">
      <!-- Simple Tables -->
      <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">NILAI TERAKHIR DIINPUT</h6>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th>NO</th>
                <th>NIM</th>
                <th>NAMA</th>
                <th>STASE</th>
                <th>RUMAH SAKIT</th>
                <th>UJIAN</th>
                <th>NILAI</th>
              </tr>
            </thead>
            <tbody>
                  <?php
                    $no = 1;
                    $q_nilai = mysqli_query($koneksi, "SELECT * FROM ipt_nilai ORDER BY id_nilai DESC LIMIT 50");
                    while ($d_nilai = mysqli_fetch_array($q_nilai)) {
                        $nama_koas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_koas WHERE nim = '$d_nilai[nim]'"));
                        $nama_stase = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_stase WHERE id_stase = '$d_nilai[id_stase]'"));
                        $nama_ujian = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ipt_ujian WHERE id_ujian = '$d_nilai[id_ujian]'"));
                        $nama_rs = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_rs WHERE id_rs = '$d_nilai[id_rs]'"));
                ?>
              <tr>
                <td><?php echo "$no"; ?></td>
                <td><?php echo "$d_nilai[nim]"; ?></td>
                <td><?php echo "$nama_koas[nama]"; ?></td>
                <td><?php echo "$nama_stase[nama_stase]"; ?></td>
                <td><?php echo "$nama_rs[nama_rs]"; ?></td>
                <td><?php echo "$nama_ujian[nama_ujian]"; ?></td>
                <td><?php echo "$d_nilai[nilai]"; ?></td>
              </tr>
          <?php $no++; } ?>
            </tbody>
          </table>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>
  </div>
</div>
<?php
}elseif ($_SESSION['ipt_level'] == "koas") { ?>
<div class="container-fluid" id="container-wrapper">
  <div class="row">
    <div class="col-lg-12 mb-4">
      <!-- Simple Tables -->
      <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">NILAI STASE</h6>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th>NO</th>
                <th>STASE</th>
                <th>NILAI ANGKA</th>
                <th>NILAI HURUF</th>
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
                      $nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ipt_nilai_akhir WHERE id_stase = '$d_nilai[id_stase]' AND nim = '$nama_'"));
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
        <div class="card-footer"></div>
      </div>
    </div>
  </div>
</div>
<?php }else{ ?>
  <div class="container-fluid" id="container-wrapper">
  <div class="row">
    <div class="col-lg-12 mb-4">
      <!-- Simple Tables -->
      <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">NILAI TERAKHIR DIINPUT</h6>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th>NO</th>
                <th>NIM</th>
                <th>NAMA</th>
                <th>STASE</th>
                <th>RUMAH SAKIT</th>
                <th>UJIAN</th>
                <th>NILAI</th>
              </tr>
            </thead>
            <tbody>
                  <?php
                    $lokasi = $_SESSION['ipt_lokasi'];
                    $no = 1;
                    $q_nilai = mysqli_query($koneksi, "SELECT a.nim, a.id_stase, a.id_ujian, a.id_rs, a.nilai, a.keterangan, b.status, b.lokasi FROM ipt_status as b INNER JOIN ipt_nilai as a ON a.id_nilai=b.id_nilai WHERE b.lokasi = '$lokasi' AND b.status = 0");
                    while ($d_nilai = mysqli_fetch_array($q_nilai)) {
                        $nama_koas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_koas WHERE nim = '$d_nilai[nim]'"));
                        $nama_stase = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_stase WHERE id_stase = '$d_nilai[id_stase]'"));
                        $nama_ujian = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ipt_ujian WHERE id_ujian = '$d_nilai[id_ujian]'"));
                        $nama_rs = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_rs WHERE id_rs = '$d_nilai[id_rs]'"));
                ?>
              <tr>
                <td><?php echo "$no"; ?></td>
                <td><?php echo "$d_nilai[nim]"; ?></td>
                <td><?php echo "$nama_koas[nama]"; ?></td>
                <td><?php echo "$nama_stase[nama_stase]"; ?></td>
                <td><?php echo "$nama_rs[nama_rs]"; ?></td>
                <td><?php echo "$nama_ujian[nama_ujian]"; ?></td>
                <td><?php echo "$d_nilai[nilai]"; ?></td>
              </tr>
          <?php $no++; } ?>
            </tbody>
          </table>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>
  </div>
</div>
<?php } ?>