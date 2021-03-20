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
      <section class="content col-md-7 mx-auto">

          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                  <h2 class="card-title">Management Kode Warna</h2>
              </div>
              <div class="card-header">
                    <?php
                    $message = $this->session->flashdata('message');
                    if (isset($message)) {
                    echo $message;
                    $this->session->unset_userdata('message');
                    }
                    ?>
                  <button class="btn btn-primary" data-toggle="modal" data-target="#addMenuModal">Add New</button>
              </div>
              <div class="card-body">
                  <table class="table table-striped" id="dataTableUser">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Kode</th>
                              <th>Nama Warna</th>
                              <th>Aksi</th>                              
                          </tr>
                      </thead>
                      <tbody>
                            <? $i = 1; ?>
                            <?php foreach ($warna as $wrn) : ?>                                
                          <tr>
                              <td scope="row"><?= $i; ?></td>
                              <td><?= $wrn['kode']; ?></td> 
                              <td><?= $wrn['nama']; ?></td>                       
                              <td>
                              <button type="submit" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="<?= $wrn['id']; ?>"><i class="fas fa-trash"></i> Delete</button>
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

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal Add -->
  <div class="modal fade" id="addMenuModal" tabindex="-1" aria-labelledby="menuModal" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="menuModal">Tambah Warna</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="<?= base_url('administrator/managekodewarna'); ?>" method="POST">
                        <div class="form-group">
                        <label for="role_id">Kode Warna</label>
                                <input type="text" class="form-control" name="kodewarna">
                        </div>
                        <div class="form-group">
                          <label for="menu_id">Nama Warna</label>
                                <input type="text" class="form-control" name="namawarna">
                        </div>                    
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <input type="submit" class="btn btn-primary" value="Submit" name="Submit">
                  </form>
              </div>
          </div>
      </div>
  </div>

  <!-- Modal Delete -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="menuModal" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
          <form action="<?= base_url('administrator/delete'); ?>" method="POST">
            <div class="modal-header">
              <h4 class="modal-title">Do you want to delete this data ?</h4>
              <input type="hidden" name="id" id="post-id">
              <input type="hidden" name="where" value="warna">
              <input type="hidden" name="function" value="managekodewarna">
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-success" value="Close" data-dismiss="modal">
              <input type="submit" class="btn btn-danger" name="submit" value="Yes Delete">
            </div>
          </form>
          </div>
      </div>
  </div>
