<div class="container-fluid" id="container-wrapper">
	<div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">EDIT NILAI</h6>
        <a href="format/format_koas.xlsx" class="m-0 float-right btn btn-danger btn-sm">DOWNLOAD FILE EXCEL</a>
      </div>
      <div class="card-body">  
      <form action="" method="post" enctype="multipart/form-data">                
        <div class="form-group">
          <label for="select2Multiple">SILAKAN PILIH FILE EXCEL LIST NAMA</label>
          <input type="file" name="list" class="form-control">
        </div>
        <button type="submit" name="upload" class="btn btn-primary">UPLOAD</button>
    </form>
      </div>
    </div>
  </div>

  <?php
    if (isset($_POST['upload'])) { 
        $nama_file_baru = 'koas.xlsx';
        if(is_file('upload/'.$nama_file_baru)) // Jika file tersebut ada
          unlink('upload/'.$nama_file_baru); // Hapus file tersebut
          $tipe_file = $_FILES['list']['type']; // Ambil tipe file yang akan diupload
          $tmp_file = $_FILES['list']['tmp_name'];

          if($tipe_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
            move_uploaded_file($tmp_file, 'upload/'.$nama_file_baru);
            require_once 'export/PHPExcel/PHPExcel.php';
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load('upload/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true); ?>
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-body"> 
                  <form method='post' action=''>
                  <table class="table align-items-center table-flush table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th>No</th>
                      <th>NIM</th>
                      <th>NAMA UPLOAD</th>
                      <th>NAMA DATABASE</th>
                    </tr>
                  </thead>
                  <tbody>


              <?php 
              $no = 0;
              $numrow = 1;
              $kosong = 0;
              foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
                // Ambil data pada excel sesuai Kolom
                $nim = $row['A']; // Ambil data NIS
                $nama = $row['B']; // Ambil data nama
                
                // Cek jika semua data tidak diisi
                if(empty($nim) && empty($nama))
                  continue; 
                if($numrow > 1){
                  // Validasi apakah semua data telah diisi
                  $nim_td = ( ! empty($nim))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
                  $nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah\

                  
                  // Jika salah satu data ada yang kosong
                  if(empty($nis) or empty($nama) or empty($periode)){
                    $kosong++; // Tambah 1 variabel $kosong
                  }

                  $nama_koas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_koas WHERE nim = '$nim'"));
                  
                  echo "<tr>";
                  echo "<td>".$no."</td>";
                  echo "<td".$nim_td.">".$nim."</td>";
                  echo "<td".$nama_td.">".$nama."</td>";
                  echo "<td".$nama_td.">".$nama_koas['nama']."</td>";
                  echo "</tr>";
                }
                
                $numrow++; // Tambah 1 setiap kali looping
                $no++;
              }
              echo "</tabody>";
              echo "</table>";
              
              // Cek apakah variabel kosong lebih dari 1
              // Jika lebih dari 1, berarti ada data yang masih kosong
              echo "<hr>";
                
                // Buat sebuah tombol untuk mengimport data ke database
                echo "<button type='submit' name='import' class='m-0 float-right btn btn-info btn-sm'><span class='fas fa-cloud-download-alt'></span> Download</button>";
              echo "</form>";
              echo "</div>";
            }else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
              // Munculkan pesan validasi
              echo "<div class='panel-footer>";
              echo "<div class='alert alert-danger'>
              Hanya File Excel 2007 (.xlsx) yang diperbolehkan
              </div></div>";
            }
             } ?>
   
  </div>
</div>
</div>


<?php
  if (isset($_POST['import'])){ // Jika user mengklik tombol Import
    $nama_file_baru = 'koas.xlsx';

    mysqli_query($koneksi, "TRUNCATE ipt_temp_koas");
    
    // Load librari PHPExcel nya
    require_once 'export/PHPExcel/PHPExcel.php';
    
    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load('upload/'.$nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
    
    $numrow = 1;
    foreach($sheet as $row){
      // Ambil data pada excel sesuai Kolom
      $nim = $row['A']; // Ambil data NIS
      $nama = $row['B']; // Ambil data nama
      
      // Cek jika semua data tidak diisi
      if(empty($nim) && empty($nama))
        continue; 
      if($numrow > 1){
        $save = mysqli_query($koneksi, "INSERT INTO ipt_temp_koas(nim, nama) VALUES('$nim', '$nama')");
      }
      
      $numrow++; 
    }
    $link = "export/nilai_stase.php"; ?>
        <script language="javascript">document.location="<?php echo "$link"; ?>";</script>
    <?php
  }
?>