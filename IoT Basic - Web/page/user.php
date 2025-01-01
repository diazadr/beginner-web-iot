<?php

if($_SESSION['role'] != "admin"){
echo "<script>location.href='index.php'</script>";
}

if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $sql_show_edit = "SELECT * FROM user WHERE username = '$id' LIMIT 1";
  $result_show_edit = mysqli_query($conn, $sql_show_edit);
  $data = mysqli_fetch_assoc($result_show_edit);
}

if (isset($_POST['old_id'])) {
  $old_id = $_POST['old_id'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $nama_lengkap = $_POST['nama_lengkap'];
  $hak_akses = $_POST['hak_akses'];
  $aktif = $_POST['aktif'];

  if($_POST['password'] == ""){
    $sql_edit = "UPDATE user SET username = '$username', nama_lengkap = '$nama_lengkap', hak_akses = '$hak_akses', aktif = '$aktif' WHERE username = '$old_id'";
  } else {
    $sql_edit = "UPDATE user SET username = '$username', password = '$password', nama_lengkap = '$nama_lengkap', hak_akses = '$hak_akses', aktif = '$aktif' WHERE username = '$old_id'";
  }

  mysqli_query($conn, $sql_edit);
  
} else  if (isset($_POST['username'])) {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $nama_lengkap = $_POST['nama_lengkap'];
  $hak_akses = $_POST['hak_akses'];

  $sql_insert = "INSERT INTO user (username, password, nama_lengkap, hak_akses) VALUES ('$username','$password', '$nama_lengkap', '$hak_akses')";
  mysqli_query($conn, $sql_insert);
}

$sql = "SELECT * FROM user";

$result = mysqli_query($conn, $sql);
?>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Pengguna</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Pengguna</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Username</th>
                    <th>Jenis Controller</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                      <td><?php echo $row['username'] ?></td>
                      <td><?php echo $row['nama_lengkap'] ?></td>
                      <td><?php echo $row['hak_akses'] ?></td>
                      <td><?php echo $row['aktif'] ?></td>
                      <td><a href="?page=user&edit=<?php echo $row['username'] ?>"><i class="fas fa-edit"></i></a></td>
                    </tr>
                  <?php } ?>
                  </tfoot>
              </table>
            </div>
          </div>
            <!-- /.card-body -->
            <?php if (!isset($_GET['edit'])) { ?>
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Tambah Data</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="?page=user">
                  <div class="card-body">
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control" name="username" placeholder="Tidak Boleh Ada Yang Sama">
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                      <label>Nama Lengkap</label>
                      <input type="text" class="form-control" name="nama_lengkap">
                    </div>
                    <div class="form-group">
                      <label>Hak Akses</label>
                      <select class="form-control" name="hak_akses">
                          <option value="user">User</option>
                          <option value="admin">Admin</option>
                      </select>
                    </div>
                  </div>
                  
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            <?php } else { ?>
              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title">Ubah Data</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="?page=user">
                  <div class="card-body">
                    <div class="form-group">
                      <label>Username</label>
                      <input type="hidden" name="old_id" value="<?php echo $_GET['edit'] ?>">
                      <input type="text" class="form-control" name="username" value="<?php echo $_GET['edit'] ?>" placeholder="Tidak Boleh Ada Yang Sama">
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                    </div>
                    <div class="form-group">
                      <label>Nama Lengkap</label>
                      <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $data['nama_lengkap'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Hak Akses</label>
                      <select class="form-control" name="hak_akses">
                        <?php if ($data['hak_akses'] == "user") { ?>
                          <option value="user">User</option>
                          <option value="admin">Admin</option>
                          <?php } else { ?>
                          <option value="admin">Admin</option>
                          <option value="user">User</option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Aktif</label>
                      <select class="form-control" name="aktif">
                        <?php if ($data['aktif'] == "Ya") { ?>
                          <option value="Ya">Ya</option>
                          <option value="Tidak">Tidak/option>
                          <?php } else { ?>
                          <option value="Tidak">Tidak</option>
                          <option value="Ya">Ya</option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            <?php } ?>

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>