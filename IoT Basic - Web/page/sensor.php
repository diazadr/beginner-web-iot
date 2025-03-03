<?php
$sql = "SELECT * FROM sensor";

$result = mysqli_query($conn, $sql);
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Sensor</h1>
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
                <h3 class="card-title">Riwayat Sensor</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Jenis Sensor</th>
                    <th>Data Sensor</th>
                    <th>Waktu</th>
                    <th>Serial Number</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['jenis_sensor'] ?></td>
                    <td><?php echo $row['data_sensor'] ?></td>
                    <td><?php echo $row['waktu'] ?></td>
                    <td><?php echo $row['serial_number'] ?></td>
                  </tr>
                    <?php } ?>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
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