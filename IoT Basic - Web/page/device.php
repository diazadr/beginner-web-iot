<?php

if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $sql_show_edit = "SELECT * FROM devices WHERE serial_number = '$id' LIMIT 1";
  $result_show_edit = mysqli_query($conn, $sql_show_edit);
  $data = mysqli_fetch_assoc($result_show_edit);
}

if (isset($_POST['old_id'])) {
  $old_id = $_POST['old_id'];
  $serial_number = $_POST['serial_number'];
  $jenis_controller = $_POST['jenis_controller'];
  $lokasi = $_POST['lokasi'];
  $aktif = $_POST['aktif'];

  $sql_edit = "UPDATE devices SET serial_number = '$serial_number', jenis_controller = '$jenis_controller', lokasi = '$lokasi', aktif = '$aktif' WHERE serial_number = '$old_id'";
  mysqli_query($conn, $sql_edit);
  
} else  if (isset($_POST['serial_number'])) {
  $serial_number = $_POST['serial_number'];
  $jenis_controller = $_POST['jenis_controller'];
  $lokasi = $_POST['lokasi'];

  $sql_insert = "INSERT INTO devices (serial_number, jenis_controller, lokasi) VALUES ('$serial_number','$jenis_controller', '$lokasi')";
  mysqli_query($conn, $sql_insert);
}

$sql = "SELECT * FROM devices";

$result = mysqli_query($conn, $sql);
?>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Perangkat</h1>
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
              <h3 class="card-title">Daftar Perangkat</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Serial Number</th>
                    <th>Jenis Controller</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                      <td><?php echo $row['serial_number'] ?></td>
                      <td><?php echo $row['jenis_controller'] ?></td>
                      <td><?php echo $row['lokasi'] ?></td>
                      <td><?php echo $row['aktif'] ?></td>
                      <td><a href="?page=device&edit=<?php echo $row['serial_number'] ?>"><i class="fas fa-edit"></i></a></td>
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
                <form method="post" action="?page=device">
                  <div class="card-body">
                    <div class="form-group">
                      <label>Serial Number</label>
                      <input type="text" class="form-control" name="serial_number" placeholder="Tidak Boleh Ada Yang Sama">
                    </div>
                    <div class="form-group">
                      <label>Jenis Controller</label>
                      <input type="text" class="form-control" name="jenis_controller">
                    </div>
                    <div class="form-group">
                      <label>Lokasi</label>
                      <input type="text" class="form-control" name="lokasi">
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
                <form method="post" action="?page=device">
                  <div class="card-body">
                    <div class="form-group">
                      <label>Serial Number</label>
                      <input type="hidden" name="old_id" value="<?php echo $_GET['edit'] ?>">
                      <input type="text" class="form-control" name="serial_number" value="<?php echo $_GET['edit'] ?>" placeholder="Tidak Boleh Ada Yang Sama">
                    </div>
                    <div class="form-group">
                      <label>Jenis Controller</label>
                      <input type="text" class="form-control" name="jenis_controller" value="<?php echo $data['jenis_controller'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Lokasi</label>
                      <input type="text" class="form-control" name="lokasi" value="<?php echo $data['lokasi'] ?>" class="form-control">
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