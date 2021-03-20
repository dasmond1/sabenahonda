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
                  <h2 class="card-title">Management Izin Akses Menu</h2>
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
                              <th scope="col">No</th>
                              <th scope="col">Role</th>
                              <th>Hak Access</th>
                              <th>Menu</th>
                              <th scope="col">Aksi</th>                              
                          </tr>
                      </thead>
                      <tbody>
                            <? $i = 1; ?>
                            <?php foreach ($parent as $mn) : ?>
                            <?php 
                            $rolename = $this->db->get_where('user_menu', array('id'=>$mn['role_id']))->row_array();                        
                            $menuname = $this->db->get_where('user_menu', array('id'=>$mn['menu_id']))->row_array();
                            ?>                        
                          <tr>
                              <th scope="row"><?= $i; ?></th>
                              <td><?= "Role - ".$rolename['menu']; ?></td> 
                              <td><b>Bisa Akses ----></b></td> 
                              <td><?= "Menu - ".$menuname['menu']; ?></td>                       
                              <td><button type="submit" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="<?= $mn['id']; ?>"><i class="fas fa-trash"></i> Delete</button></td>
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
                  <h5 class="modal-title" id="menuModal">Add Access To User</h5>
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
                  <form action="<?= base_url('administrator/manageaccess'); ?>" method="POST">
                        <div class="form-group">
                          <label for="role_id">Role</label>
                          <select class="form-control" id="role_id" name="role_id">
                              <option value="">--Pilih Role User--</option>
                              <?php foreach ($getaccesspermit as $rl) : ?>
                              <option value="<?= $rl['id']; ?>">Role - <?= $rl['menu']; ?></option>
                              <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="menu_id">Bisa Akses ?</label>
                          <select class="form-control" id="menu_id" name="menu_id">
                              <option value="">--Pilih Hak Akses User--</option>
                              <?php foreach ($getaccesspermit as $rl) : ?>
                              <option value="<?= $rl['id']; ?>">Menu - <?= $rl['menu']; ?></option>
                              <?php endforeach; ?>
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
              <input type="hidden" name="where" value="user_access_menu">
              <input type="hidden" name="function" value="manageaccess">
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-success" name="submit" value="Close" data-dismiss="modal">
              <input type="submit" class="btn btn-danger" name="submit" value="Yes Delete">
            </div>
          </form>
          </div>
      </div>
  </div>
