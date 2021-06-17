<div class="container-fluid" id="container-wrapper">
	<div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">INPUT NILAI</h6>
      </div>
      <div class="card-body">  
      <form action="index.php?pages=<?php echo sha1(md5("input_nilai2_a")); ?>" method="post">                
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
        <button type="submit" name="cari" class="btn btn-primary">INPUT NILAI</button>
    </form>
      </div>
    </div>
  </div>
</div>