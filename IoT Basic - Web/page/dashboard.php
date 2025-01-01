<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-6 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><span id="temperature">-</span> <sup style="font-size: 20px">C</sup></h3>

              <p>Temperature</p>
            </div>
            <div class="icon">
              <i class="fas fa-thermometer "></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><span id="status">-</span><sup style="font-size: 20px">On</sup></h3>

              <p>Status</p>
            </div>
            <div class="icon">
              <i class="fas fa-tint"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-md-12">
          <!-- Buttons with Icons -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Wadah</h3>
            </div>
            <div class="card-body row">
              <div class="col-md-6">
                <button type="button" class="btn btn-primary btn-block" onclick="publishControlNyala()"><i class="fa fa-lightbulb"></i>Servo Nyala</button>

              </div>
              <div class="col-md-6">
                <button type="button" class="btn btn-secondary  btn-block" onclick="publishControlMati()"><i class="fa fa-lightbulb"></i>Servo Mati</button>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>

      </div>
      <!-- /.row -->

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>


<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>

<script>
  const clientId = Math.random().toString(16).substr(2, 8);

  const host = 'wss://petfeeder.cloud.shiftr.io:443';

  const options = {
    keepalive: 30,
    clientId: clientId,
    protocolId: 'MQTT',
    protocolVersion: 4,
    clean: true,
    username: 'petfeeder',
    password: '2BV7aBDzdnEsfSMF',
    reconnectPeriod: 1000,
    connectTimeout: 30 * 1000
  }

  console.log('menghubungkan ke broker');
  const client = mqtt.connect(host, options)

  client.on('connect', () => {
    console.log('Terhubung:' + clientId);
    document.getElementById("koneksi").innerHTML = "Terhubung";
    document.getElementById("koneksi").style.color = "blue";
    client.subscribe("petfeeder/#");
  })

  client.on('message', function(topic, payload) {
    if (topic === "petfeeder/12345678/temperature") {
      document.getElementById("temperature").innerHTML = payload;
    } else if (topic === "petfeeder/12345678/status") {
      document.getElementById("status").innerHTML = payload;
    }
  })

  function publishControlNyala() {
    client.publish("petfeeder/12345678/control", "nyala", {
      qos: 1,
      retain: true
    });
  }

  function publishControlMati() {
    client.publish("petfeeder/12345678/control", "mati", {
      qos: 1,
      retain: true
    });
  }
</script>