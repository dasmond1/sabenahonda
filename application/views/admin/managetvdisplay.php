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
        <div class="row">
        <div class="col-md-8 mx-auto">
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Manage Video Player And Footer Text</h3>
              </div>
              <div class="card-body">
                    <?php
                    $message = $this->session->flashdata('message');
                    if (isset($message)) {
                    echo $message;
                    $this->session->unset_userdata('message');
                    }
                    ?>
                  <form action="<?= base_url('display/updateframevideo'); ?>" method="POST">
                  <div class="row">
                    <div class="col-md-6">
                        <label for="iframe_name">Iframe Name</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="iframe_name" value="<?= $displayvid['iframe_name']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="iframe_url">Iframe URL</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="iframe_url" value="<?= $displayvid['iframe_url']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="iframe_url">Footer Text Information</label>
                        <div class="form-group">
                            <textarea type="text" class="form-control" name="footer_text" rows="5" required><?= $displayvid['footer_text']; ?></textarea>
                        </div>
                    </div>
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="Update">  
                </form>
              </div>
              <!-- /.card-footer-->
          </div>
          <!-- /.card -->
        </div>
        </div>
        

        <div class="row">
        <div class="col-md-6">
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Tambah Iklan TV</h3>
              </div>
              <div class="card-body">
                    <?php
                    $message = $this->session->flashdata('message1');
                    if (isset($message)) {
                    echo $message;
                    $this->session->unset_userdata('message1');
                    }
                    ?>
                <form action="<?= base_url('display/insertiklan'); ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <label for="image_name">Image Name</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="image_name" required>
                        </div>
                    </div>
                    <div class="col-md-6">                    
                            <div class="form-group">
                                <label>Profile Photo</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control-file" name="file" >
                                    <p><span class="small"> Makismal 2MB dan Ukuran 763px X 700px</span></p>
                                </div>
                            </div>
                        </div>
                  </div>
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              <input type="submit" class="btn btn-primary" value="Upload">  
              </form>
              </div>
              <!-- /.card-footer-->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">List Iklan TV</h3>
              </div>
                <div class="card-body">
                    <?php
                    $message = $this->session->flashdata('message2');
                    if (isset($message)) {
                    echo $message;
                    $this->session->unset_userdata('message2');
                    }
                    ?>
                    <table class="table table-striped" id="dataTableUser" width="100%">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Nama Iklan</th>
                              <th>Preview</th>
                              <th>Aksi</th>                         
                          </tr>
                      </thead>
                      <tbody>
                            <? $i = 1; ?>
                            <?php foreach ($iklan as $key) : ?>                                
                          <tr>
                              <td scope="row"><?= $i; ?></td>
                              <td><?= $key['image_name']; ?></td> 
                              <td><a href="<?= base_url('vendor/slide/').$key['image_url']; ?>" data-lightbox="img-1"><img class="profile-user-img img-fluid" width="10px" src="<?= base_url('vendor/slide/').$key['image_url']; ?>"></a></td>                   
                              <td>
                              <button type="submit" class="delete btn btn-primary btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="<?= $key['id']; ?>"><i class="fas fa-trash"></i> Delete</button>
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
        </div>
        </div>

      </section>
      <!-- /.content -->
      
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal Delete -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="menuModal" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
          <form action="<?= base_url('display/delete'); ?>" method="POST">
            <div class="modal-header">
              <h4 class="modal-title">Do you want to delete this data ?</h4>
              <input type="hidden" name="id" id="post-id">
              <input type="hidden" name="where" value="display_image">
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-success" name="submit" value="Close" data-dismiss="modal">
              <input type="submit" class="btn btn-danger" name="submit" value="Yes Delete">
            </div>
          </form>
          </div>
      </div>
  </div>