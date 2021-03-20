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
                  <h3 class="card-title">Terima Stok</h3>
              </div>
              <div class="card-body">
              <?php
                        $message = $this->session->flashdata('message');
                        if (isset($message)) {
                        echo $message;
                        $this->session->unset_userdata('message');
                        }
                    ?>
                    <table class="table table-striped" id="dataTableUser" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">No BAST</th>
                                <th scope="col">No Mesin</th>
                                <th scope="col">Driver</th>
                                <th scope="col">Waktu Inbound</th>
                                <th scope="col">Aksi</th>                 
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($inbound as $key) : ?>
                                <?php $nosin = str_replace(",", "<br>",$key['no_mesin']); ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $key['no_surat']; ?></td>
                                <td><?= $nosin; ?></td>
                                <td><?= $key['supir']; ?></td>
                                <td><?= shortdate_indo($key['tanggal_mutasi'])." - ".$key['jam_mutasi']; ?></td>
                                <td><a href="<?= base_url('posinpur/terima_inbound/').$key['id']; ?>"  onclick="return confirm('Yakin Ingin Proses Penerimaan?')" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Terima</a></td>                               
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->