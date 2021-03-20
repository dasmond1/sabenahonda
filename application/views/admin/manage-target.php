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
                  <h3 class="card-title">Management Target Penjualan</h3>
              </div>              
              <div class="card-header">
                    <?php
                    $message = $this->session->flashdata('message');
                    if (isset($message)) {
                    echo $message;
                    $this->session->unset_userdata('message');
                    }
                    ?>
                  <button class="btn btn-primary" data-toggle="modal" data-target="#addTargetModal">Add New</button>
              </div>
              <div class="card-body">
                  <table class="table table-striped" id="dataTableUser">
                      <thead>
                          <tr>
                              <th scope="col">No</th>
                              <th scope="col">Bulan</th>
                              <th scope="col">Tahun</th>
                              <th scope="col">Target Penjualan</th>
                              <th scope="col">Aksi</th>                              
                          </tr>
                      </thead>
                      <tbody>
                          <?php $i = 1; ?>
                          <?php foreach ($get_target as $target) : ?>
                          <tr>
                              <th scope="row"><?= $i; ?></th>
                              <td><?= $target['bulan']; ?></td>
                              <td><?= $target['tahun']; ?></td>
                              <td><?= $target['target']; ?></td>                        
                              <td><button type="submit" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="<?= $target['id']; ?>"><i class="fas fa-trash"></i> Delete</button></td>
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

  <!-- Modal -->
  <div class="modal fade" id="addTargetModal" tabindex="-1" aria-labelledby="targetModal" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="targetModal">Add New Target</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <?php if(validation_errors()) : ?>
                  <div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <?= validation_errors(); ?>
                  </div>
                  <?php endif; ?>
                  <form action="<?= base_url('administrator/managetarget'); ?>" method="POST">
                      <div class="form-group">
                          <label for="username">Bulan</label>
                          <input type="text" class="form-control" id="bulan" name="bulan">
                      </div>
                      <div class="form-group">
                          <label for="text">Tahun</label>
                          <input type="text" class="form-control" id="tahun" name="tahun">
                      </div>
                      <div class="form-group">
                          <label for="username">Jumlah Target</label>
                          <input type="number" class="form-control" id="target" name="target">
                      </div>                      
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
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
              <h4 class="modal-title">Dou you want to delete this data ?</h4>
              <input type="hidden" name="id" id="post-id">
              <input type="hidden" name="where" value="target_penjualan">
              <input type="hidden" name="function" value="managetarget">
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-success" name="submit" value="Close" data-dismiss="modal">
              <input type="submit" class="btn btn-danger" name="submit" value="Yes Delete">
            </div>
          </form>
          </div>
      </div>
  </div>