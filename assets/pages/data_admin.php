<div class="container-fluid" id="container-wrapper">
	<div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">DATA ADMIN</h6>
          <a class="m-0 float-right btn btn-primary btn-sm" href="index.php?pages=<?php echo sha1(md5("data_admin_a")); ?>">Tambah User</i></a>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Password</th>
                <th>Level</th>
                <th>Lokasi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            	<?php
            		$no = 1;
            		$q_admin = mysqli_query($koneksi, "SELECT * FROM ipt_user");
            		while ($d_admin = mysqli_fetch_array($q_admin)) {
            	?>
              <tr>
                <td><?php echo "$no"; ?></td>
                <td><?php echo "$d_admin[nama]"; ?></td>
                <td><?php echo "$d_admin[username]"; ?></td>
                <td><?php echo "$d_admin[password]"; ?></td>
                <td><?php echo "$d_admin[level]"; ?></td>
                <td><?php echo "$d_admin[lokasi]"; ?></td>
                <?php
                  if ($d_admin['level'] == 'superadmin') {
                    echo "<td></td>";
                  }else{
                    echo "<td>";
                    echo "<a href='index.php?pages=".sha1(md5("data_admin_a"))."&a=".sha1(md5("edit"))."&id=".base64_encode("$d_admin[id_user]")."' title='Edit' class='btn btn-success'>Edit</a>"; 
                    echo "</td>";
                  }
                ?>
              </tr>
          <?php $no++; } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>