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
                  <h3 class="card-title">History Mutasi Unit</h3>
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
                                <th scope="col">Tanggal Mutasi</th>
                                <th scope="col">No BAST</th>
                                <th scope="col">Tujuan</th>
                                <th scope="col">Driver</th>
                                <th scope="col">Aksi</th>                 
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($listmutasi as $lm) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= shortdate_indo($lm['tanggal_mutasi']); ?></td>
                                <td><?= $lm['no_surat']; ?></td>
                                <td><?= $lm['tujuan']; ?></td>
                                <td><?= $lm['supir']; ?></td>
                                <td><a href="<?= base_url('staff/printbast/'.$lm['id']); ?>" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-print"></i> Print</a> <button type="submit" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="<?= $lm['id']; ?>"><i class="fas fa-trash"></i> Delete</button></td>                               
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

  <!-- Modal Delete -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="menuModal" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
          <form action="<?= base_url('staff/deletebast'); ?>" method="POST">
            <div class="modal-header">
              <h4 class="modal-title">Yakin Mau Menghapus BAST berikut ?</h4>
              <input type="hidden" name="id" id="post-id">
              <input type="hidden" name="where" value="history_mutasi">
              <input type="hidden" name="function" value="historymutasi">
            </div>
            <div class="modal-body">
                <p class="lead text-center">Lakukan Dengan Tanggung Jawab</p>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-success" name="submit" value="Close" data-dismiss="modal">
              <input type="submit" class="btn btn-danger" name="submit" value="Yes Delete">
            </div>
          </form>
          </div>
      </div>
  </div>