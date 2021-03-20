  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1><?= $title; ?></h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                          <li class="breadcrumb-item active"><?= $title; ?></li>
                      </ol>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

          <!-- Default box -->
          <div class="card">
              <div class="card-header bg-success">
                  <h3 class="card-title"><i class="fab fa-whatsapp"></i> Whatsapp Controller</h3>
              </div>
              <div class="card-body">
                    <table class="table table-bordered" id="dataTableUser" width="100%">
                        <thead>                  
                            <tr>
                                <th style="width: 10px">#</th>
                                <th class="text-center">Device Name</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Balance</th>
                                <th class="text-center">Paket</th>
                                <th class="text-center">Token</th>
                                <th class="text-center">Expired</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <? $i = 1; ?>
                            <?php foreach ($whatsapp as $key) : ?>   
                                <?php
                                $payload = array(
                                    'token' => $key['token'],
                                    'username' => $key['username'],
                                );
                                
                                $url = $key['url']."info.php";
                                $statuswa = info_wa($url, $payload);
                                
                                $url = $key['url']."battery-level.php";
                                $battery = info_wa($url, $payload);                                
                                ?>                             
                            <tr>
                              <td scope="row"><?= $i; ?></td>
                              <td><?= $statuswa['token']['id']." - ".$key['device_name']." <br>Baterai Device : ".$battery['battery_level']." %"; ?></td> 
                              <td><?= $key['username']; ?></td>
                              <td>Rp. <?= $statuswa['balance']; ?></td>
                            <td><?= $statuswa['token']['paket']; ?></td>
                            <td><?= $statuswa['token']['token']; ?></td>
                            <td><?= $statuswa['token']['expired']; ?></td>
                              <td class="text-center">
                              <a class="btn btn-danger btn-xs" title="Restart Service" href="<?= base_url('api/restart'); ?>" onclick="return confirm('Restart Service?')"><i class="fas fa-sync-alt"></i></a>
                              <a class="btn btn-warning btn-xs" title="TakeOver" href="<?= base_url('api/takeover'); ?>" onclick="return confirm('Take Over Service?')"><i class="fas fa-sync-alt"></i></a>
                              <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#qrcode"><i class="fas fa-qrcode"></i></button>
                              <a class="btn btn-success btn-xs" title="Delete Session" href="<?= base_url('api/delsession'); ?>" onclick="return confirm('Are You Sure to delete session')"><i class="fas fa-trash"></i></a>
                              </td>
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->
            <hr>
          <div class="card">
              <div class="card-header bg-warning">
                  <h3 class="card-title"><i class="fas fa-envelope"></i> SMS Controller</h3>
              </div>
              <div class="card-body">
                  Start creating your amazing application!
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal -->
<div class="modal fade" id="qrcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Scan New QrCode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <?php foreach ($whatsapp as $key) : ?>
        <?php
        $payload = array(
            'token' => $key['token'],
        );
        $url = $key['url']."qrcode.php";
        $qrcode = info_wa($url, $payload);
        echo $qrcode['message'];
        ?>
        <?php endforeach; ?>
        <br>
        <p>Jika sudah terhubung ke whatsapp, silahkan tutup dan refresh halaman.</p>
        <p>Jika beberapa kali scan tapi masih belum terhubung, silahkan klik restart.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="<?= base_url('api/restart'); ?>" class="btn btn-danger" onclick="return confirm('Restart Service?')">Restart</a>
      </div>
    </div>
  </div>
</div>