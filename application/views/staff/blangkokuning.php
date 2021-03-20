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
      <section class="content col-md-4 mx-auto">

          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Print blangko Kuning</h3>
              </div>
              <div class="card-body">
                    <?php
                        $message = $this->session->flashdata('message');
                        if (isset($message)) {
                        echo $message;
                        $this->session->unset_userdata('message');
                        }
                    ?>
                    <form action="<?= base_url('staff/blangkokuning'); ?>" method="POST">
                        <div class="col-md">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">No Mesin</label>
                                <input type="text" class="form-control" name="no_mesin" placeholder="JM31E ...." maxlength="13" required>
                            </div>                   
                        </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-print"></i> Print</button>
                  </form>
              </div>
              <!-- /.card-footer-->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->