<?php $lokasi = $_SESSION['ipt_lokasi']; ?>
<div class="container-fluid" id="container-wrapper">
  <div class="row">
    <div class="col-lg-12 mb-4">
      <!-- Simple Tables -->
      <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">REKAPAN INPUIT NILAI</h6>
          <form action="export/rekapan.php" target="_BLANK" method="POST">
            <input type="hidden" name="lok" value="<?php echo $lokasi; ?>">
            <button type="submit" name="export" class="m-0 float-right btn btn-primary btn-sm">CETAK REKAPAN</button>
          </form>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th>NO</th>
                <th>NIM</th>
                <th>NAMA</th>
                <th>STASE</th>
                <th>RUMAH SAKIT</th>
                <th>UJIAN</th>
                <th>NILAI</th>
                 <th>KETERANGAN</th>
              </tr>
            </thead>
            <tbody>
                  <?php
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
                <td><?php echo "$d_nilai[keterangan]"; ?></td>
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