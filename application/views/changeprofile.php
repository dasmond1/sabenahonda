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
                  <h3 class="card-title">Set Your Profile</h3>
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
                <form action="<?= base_url('auth/changeprofile'); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" value="<?= $user['id']; ?>" name="id">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" value="<?= $user['username']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?= $user['nama']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Inisial</label>
                        <input type="text" class="form-control" name="inisial" value="<?= $user['inisial']; ?>" maxlength="3">
                    </div>
                    <div class="form-group">
                        <label for="honda_id">Honda ID</label>
                        <input type="number" class="form-control" name="honda_id" value="<?= $user['honda_id']; ?>" readonly>
                    </div>
                    <div class="row">
                        <div class="col-md-2">                    
                        <a href="<?= base_url('assets/img/user-photo/') . $user['profil_picture']; ?>" data-lightbox="img-1"><img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/img/user-photo/') . $user['profil_picture']; ?>" alt="User profile picture"></a>
                        </div>
                        <div class="col-md-10">                    
                            <div class="form-group">
                                <label>Profile Photo</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control-file" name="file" >
                                    <p><span class="small"> Makismal 2MB dan Ukuran 600px X 600px</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
              <!-- /.card-footer-->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->