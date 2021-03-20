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
      <section class="content col-md-5 mx-auto">

          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Set Your New Password</h3>
              </div>
              <div class="content">
                    <?php
                    $message = $this->session->flashdata('message');
                    if (isset($message)) {
                    echo $message;
                    $this->session->unset_userdata('message');
                    }
                    ?>
              </div>
              <div class="card-body">
                <form action="<?= base_url('auth/changepassword'); ?>" method="POST">
                    <div class="form-group">
                        <label for="username">Password Lama</label>
                        <input type="password" class="form-control" name="passwordlama" id="passwordlama">
                        <input type="checkbox" onclick="myFunction()">Show Password
                    </div>
                    <div class="form-group">
                        <label for="passwordbaru">Password Baru</label>
                        <input type="password" class="form-control" name="passwordbaru" id="passwordbaru">
                        <input type="checkbox" onclick="myFunction1()">Show Password
                    </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
              <!-- /.card-footer-->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->