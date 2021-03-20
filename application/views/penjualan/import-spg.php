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
      <section class="content col-md-6 mx-auto">

          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Import File Penerimaan Barang</h3>
              </div>
              <div class="card-body">
                    <?php
                        $message = $this->session->flashdata('message');
                        if (isset($message)) {
                        echo $message;
                        $this->session->unset_userdata('message');
                        }
                    ?>
                  <form action="<?php echo base_url('penjualan/importspg'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Upload FIle UMSL / CSV</label>
                            <div class="custom-file">
                                <input type="file" class="form-control-file" name="file" >
                            </div>
                        </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <input type="submit" class="btn btn-primary" name="import" value="Import">
                </form>
              </div>
              <!-- /.card-footer-->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->