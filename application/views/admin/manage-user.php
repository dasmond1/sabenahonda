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
                  <h3 class="card-title">Management User</h3>
              </div>
              <div class="card-header">
                    <?php
                    $message = $this->session->flashdata('message');
                    if (isset($message)) {
                    echo $message;
                    $this->session->unset_userdata('message');
                    }
                    ?>
                  <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">Add New</button>
              </div>
              <div class="card-body">
                  <table class="table table-striped" id="dataTableUser">
                      <thead>
                          <tr>
                              <th scope="col">No</th>
                              <th scope="col">Profil Pic</th>
                              <th scope="col">Nama</th>
                              <th scope="col">Username</th>
                              <th scope="col">HondaID / Inisial</th>
                              <th scope="col">Role</th>
                              <th scope="col">Status</th>
                              <th scope="col">Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $i = 1; ?>
                          <?php foreach ($get_user as $usr) : ?>
                          <tr>
                              <th scope="row"><?= $i; ?></th>
                              <td><a href="<?= base_url('assets/img/user-photo/');?><?= $usr['profil_picture']; ?>" data-lightbox="img-1"><img src="<?= base_url('assets/img/user-photo/');?><?= $usr['profil_picture']; ?>"
                                      class="img-thumbnail" width="50px"></a></td>
                              <td><?= $usr['nama']; ?></td>
                              <td><?= $usr['username']; ?></td>
                              <td><?= $usr['honda_id']; ?> (<?= $usr['inisial']; ?>)</td>
                              <td><?= $usr['menu_id']; ?> - <?= $usr['menu']; ?></td>
                              <?php if ($usr['status'] == 1){
                        echo '<td><span class="badge badge-primary">Aktif</span></td>';
                    } else {
                        echo '<td><span class="badge badge-danger">Suspend</span></td>';
                    }
                    ?>
                              <td><button type="submit" class="status btn btn-primary btn-sm" data-toggle="modal" data-target="#statusModal" data-id="<?= $usr['id']; ?>"><i class="fas fa-user"></i> Change Status</button> <button type="submit" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="<?= $usr['id']; ?>"><i class="fas fa-trash"></i> Delete</button></td>
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
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
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
                  <form action="<?= base_url('administrator/manageuser'); ?>" method="POST">
                      <div class="form-group">
                          <label for="username">Username</label>
                          <input type="text" class="form-control" id="username" name="username">
                      </div>
                      <div class="form-group">
                          <label for="password">Password</label>
                          <input type="text" class="form-control" id="password" name="password">
                      </div>
                      <div class="form-group">
                          <label for="username">Nama</label>
                          <input type="text" class="form-control" id="nama" name="nama">
                      </div>
                      <div class="form-group">
                          <label for="honda_id">Honda ID</label>
                          <input type="text" class="form-control" id="honda_id" name="honda_id" value="0">
                      </div>
                      <div class="form-group">
                          <label for="inisial">Inisial</label>
                          <input type="text" class="form-control" id="inisial" name="inisial">
                      </div>
                      <div class="form-group">
                          <label for="username">Role</label>
                          <select class="form-control" id="role" name="menu_id">
                              <option value="">--Pilih Role--</option>
                              <?php foreach ($role as $rl) : ?>
                              <option value="<?= $rl['id']; ?>"><?= $rl['id']; ?> - <?= $rl['menu']; ?></option>
                              <?php endforeach; ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="username">Status</label>
                          <select class="form-control" id="status" name="status">
                              <option value="1">Aktif</option>
                              <option value="0">Suspend</option>
                          </select>
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
              <input type="hidden" name="where" value="admin">
              <input type="hidden" name="function" value="manageuser">
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-success" name="submit" value="Close" data-dismiss="modal">
              <input type="submit" class="btn btn-danger" name="submit" value="Yes Delete">
            </div>
          </form>
          </div>
      </div>
  </div>
  <!-- Modal Status -->
  <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="menuModal" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
          <form action="<?= base_url('administrator/changeStatus'); ?>" method="POST">
            <div class="modal-header">
              <h4 class="modal-title">Dou you want to change status this data ?</h4>
              <input type="hidden" name="id" id="post-id">
              <input type="hidden" name="where" value="admin">
              <input type="hidden" name="function" value="manageuser">
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-success" name="submit" value="Close" data-dismiss="modal">
              <input type="submit" class="btn btn-danger" name="submit" value="Yes Change">
            </div>
          </form>
          </div>
      </div>
  </div>