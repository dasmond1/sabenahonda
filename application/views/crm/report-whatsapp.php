<?php
if (isset($_GET['tanggal'])) {
    $tanggal = $_GET['tanggal'];
    
} else {
    $tanggal = date("Y-m-d");
    
}     
?>
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
              <div class="card-header">
                  <h3 class="card-title">Laporan Whatsapp</h3>            
              </div>
              <div class="card-header">
                <?php
                    $message = $this->session->flashdata('message');
                    if (isset($message)) {
                    echo $message;
                    $this->session->unset_userdata('message');
                    }
                ?>
                <div class="row">
                    <div class="col-sm d-flex flex-row">
                        <a href="exportexcel/<?= $tanggal; ?>" class="btn btn-primary mr-2"><i class="fas fa-file-excel"></i> Export Excel</a> 
                        <a href="retrysend/<?= $tanggal; ?>" class="btn btn-secondary"><i class="fas fa-undo"></i> Kirim Ulang</a>
                        <a href="chatwa" class="btn btn-success ml-2"><i class="fab fa-whatsapp"></i> Inbox</a>
                    </div>
                    <div class="col-sm d-flex flex-row-reverse">
                        <form method="GET">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" class="form-control" name="tanggal" value="<?= $tanggal; ?>" required>
                            <input type="submit" class="btn btn-primary btn-sm ml-2" value="Lihat">
                        </div>
                        </form>
                        
                    </div>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-striped" id="dataTableUser" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">No Mesin</th>
                            <th scope="col">No Telepon</th>
                            <th scope="col">Pesan</th>
                            <th scope="col">Type</th>
                            <th scope="col">Sender</th>
                            <th scope="col">Status</th>                  
                        </tr>
                    </thead>
                    <tbody>
                    <?php $chat = $this->modelCrm->getChat($tanggal); ?>
                    <?php $i = 1; ?>
                        <?php foreach ($chat as $key) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= shortdate_indo($key['tanggal']); ?></td>
                            <td><?= $key['no_mesin']; ?></td>
                            <td><?= $key['untuk']; ?></td>
                            <td><?= mb_strimwidth($key['pesan'], 0, 100, "..."); ?></td>
                            <td><?= $key['type']; ?></td>
                            <td><?= $key['sender']; ?></td>
                            <?php if ($key['status'] == "Outbox") : ?>
                                <td><span class="badge badge-primary">On Prosses</span></td>
                            <?php elseif ($key['status'] == "Terkirim") : ?>
                                <td><span class="badge badge-success">Success</span></td>
                            <?php elseif ($key['status'] == "waiting") : ?>
                                <td><span class="badge badge-secondary">Waiting..</span></td>
                            <?php elseif ($key['status'] == "Gagal") : ?>
                                <td><span class="badge badge-danger">Gagal</span></td>
                            <?php elseif ($key['status'] == "Nomer Tidak Valid") : ?>
                                <td><span class="badge badge-warning">Tidak Terdaftar</span></td>
                            <?php else : ?>
                                <td><span class="badge badge-danger">Invalid Data</span></td>
                            <?php endif; ?>
                            
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <?php
                    $gagal = $this->modelCrm->numsGagal($tanggal);
                    $success = $this->modelCrm->numsTerkirim($tanggal);
                    $notregister = $this->modelCrm->numsNotRegister($tanggal);
                    $waiting = $this->modelCrm->numswaiting($tanggal);
                ?>
                    <span class="badge badge-secondary">Waiting : <?= $waiting; ?> Pesan</span> 
                    <span class="badge badge-success">Success : <?= $success; ?> Pesan</span> 
                    <span class="badge badge-warning">Tidak Terdaftar : <?= $notregister; ?> Pesan</span> 
                    <span class="badge badge-danger">Gagal / Invalid: <?= $gagal; ?> Pesan</span>
              </div>
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->