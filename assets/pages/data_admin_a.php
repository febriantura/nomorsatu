<div class="container-fluid" id="container-wrapper">
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">TAMBAH USER</h6>
      </div>
      <?php
      if(@$_GET['a']== sha1(md5("edit"))){ 
          $id =  base64_decode($_GET['id']);
          $e_user = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ipt_user WHERE id_user = '$id'")); ?>
      <div class="card-body">                  
        <form action="" method="post">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama User</label>
            <div class="col-sm-9">
              <input type="text" name="nama" class="form-control" value="<?php echo "$e_user[nama]"; ?>">
              <input type="hidden" name="id" class="form-control" value="<?php echo "$id"; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-9">
              <input type="text" name="username" class="form-control" value="<?php echo "$e_user[username]"; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
              <input type="password" name="password" class="form-control" value="<?php echo "$e_user[password]"; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Level</label>
            <div class="col-sm-9">
              <select class="form-control" name="level">
                <option value="admin" <?php if ($e_user['level'] == 'admin') { echo "selected"; } ?>>Admin</option>
                <option value="adminprofesi" <?php if ($e_user['level'] == 'adminprofesi') { echo "selected"; } ?>>Tim Profesi</option>
                <option value="adminrs" <?php if ($e_user['level'] == 'adminrs') { echo "selected"; } ?>>Admin Rumah Sakit</option>
                <option value="koas" <?php if ($e_user['level'] == 'koas') { echo "selected"; } ?>>Koas</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Lokasi</label>
            <div class="col-sm-9">
              <select class="form-control" name="lokasi">
                <option value="fkums" <?php if ($e_user['lokasi'] == 'fkums') { echo "selected"; } ?>>FK UMS</option>
                <option value="ponorogo" <?php if ($e_user['lokasi'] == 'ponorogo') { echo "selected"; } ?>>Admin Ponorogo</option>
                <option value="sukoharjo" <?php if ($e_user['lokasi'] == 'sukoharjo') { echo "selected"; } ?>>Admin Sukoharjo</option>
                <option value="magetan" <?php if ($e_user['lokasi'] == 'magetan') { echo "selected"; } ?>>Admin Magetan</option>
                <option value="karanganyar" <?php if ($e_user['lokasi'] == 'karanganyar') { echo "selected"; } ?>>Admin Karanganyar</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary" name="edit">Edit</button>
              <a class="m-0 btn btn-danger" href="index.php?pages=<?php echo sha1(md5("data_admin")); ?>">Batal</i></a>
            </div>
          </div>
        </form>
      </div>
      <?php
      }else{
      ?>
      <div class="card-body">                  
        <form action="" method="post">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama User</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" placeholder="Nama User" name="nama">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" placeholder="user" name="username">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" placeholder="pass" name="password">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Level</label>
            <div class="col-sm-9">
              <select class="select2 form-control" name="level">
                <option value=""></option>
                <option value="admin">Admin</option>
                <option value="adminprofesi">Tim Profesi</option>
                <option value="adminrs">Admin Rumah Sakit</option>
                <option value="Koas">Koas</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Lokasi</label>
            <div class="col-sm-9">
              <select class="select2 form-control" name="lokasi">
                <option value=""></option>
                <option value="fkums">FK UMS</option>
                <option value="ponorogo">Admin Ponorogo</option>
                <option value="sukoharjo">Admin Sukoharjo</option>
                <option value="magetan">Admin Magetan</option>
                <option value="karanganyar">Admin Karanganyar</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
              <a class="m-0 btn btn-danger" href="index.php?pages=<?php echo sha1(md5("data_admin")); ?>">Batal</i></a>
            </div>
          </div>
        </form>
      </div>
      <?php
      }
      ?>
  </div>
</div>
</div>

<?php
    if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = sha1(md5($_POST['password']));
    $level = $_POST['level'];
    $lokasi = $_POST['lokasi'];

    $cariid = mysqli_query($koneksi, "SELECT max(id_user) FROM ipt_user") or die(mysqli_error());
    $dataid = mysqli_fetch_array($cariid);
    if ($dataid) {
      $nilai = $dataid[0];
      $id = (int) $nilai;
      $id = $id + 1;
      $idotomatis = $id;
    }else{
      $idotomatis = 1;
    }

    $insert_user = mysqli_query($koneksi, "INSERT INTO ipt_user(id_user, username, password, level, nama, lokasi) VALUES('$idotomatis','$username', '$password', '$level', '$nama', '$lokasi')");
    if ($insert_user) {
      $link = "index.php?pages=".sha1(md5("data_admin")); ?>
          <script language="javascript">document.location="<?php echo "$link"; ?>";</script>
      <?php 
    }else{
      echo "<script>alert('SIMPAN GAGAL')</script>";
      $link = "index.php?pages=".sha1(md5("data_user_a")); ?>
          <script language="javascript">document.location="<?php echo "$link"; ?>";</script>
      <?php 
    }
  }elseif (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $level = $_POST['level'];
    $pword = $_POST['password'];
    $d_user = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ipt_user WHERE id_user = '$id'")); 
    if ($d_user['password'] == $pword) {
        $password = $pword;
    }else{
        $password = sha1(md5($pword));
    }

    $update_user = mysqli_query($koneksi, "UPDATE ipt_user SET nama = '$nama', username = '$username', password = '$password', level = '$level' WHERE id_user = '$id'");
    if ($update_user) {
      $link = "index.php?pages=".sha1(md5("data_admin")); ?>
         <script language="javascript">document.location="<?php echo "$link"; ?>";</script>
      <?php 
    }else{
      echo "<script>alert('EDIT GAGAL')</script>";
      $link = "index.php?pages=".sha1(md5("data_admin")); ?>
          <script language="javascript">document.location="<?php echo "$link"; ?>";</script>
      <?php 
    }
  }
?>