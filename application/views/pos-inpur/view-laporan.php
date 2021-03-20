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
      <section class="content col-lg-6 mx-auto">

          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">View Laporan Penjualan</h3>
              </div>
              <div class="card-body">
                <form role="form" method="POST" action="<?php echo base_url(); ?>posinpur/filter" target="_blank">
                    <div class="row center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Dari Tanggal Penjualan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                        <input type="date" class="form-control" name="tanggalawal" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Hingga Tanggal Penjualan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                        <input type="date" class="form-control" name="tanggalakhir" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <input type="hidden" name="nilaifilter" value="1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
              <!-- /.card-footer-->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->