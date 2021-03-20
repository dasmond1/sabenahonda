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
      <section class="content col-md-12">

          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Management Submenu</h3>
              </div>
              <div class="card-header">
                  <button class="btn btn-primary" data-toggle="modal" data-target="#addMenuModal">Add New</button>
              </div>
              <div class="card-body">
                  <table class="table table-striped" id="dataTableUser">
                      <thead>
                          <tr>
                              <th scope="col">No</th>
                              <th scope="col">Parent Menu</th>
                              <th scope="col">Submenu</th>
                              <th scope="col">URL</th>
                              <th scope="col">Font Awesome</th>
                              <th scope="col">Status</th>
                              <th scope="col">Aksi</th>                              
                          </tr>
                      </thead>
                      <tbody>
                      <?php $i = 1; ?>
                          <?php foreach ($getsubmenu as $sbm) : ?>
                          <tr>
                              <th scope="row"><?= $i; ?></th>
                              <td><?= $sbm['menu']; ?></td>
                              <td><?= $sbm['title']; ?></td>
                              <td><?= $sbm['url']; ?></td>
                              <td><i class="<?= $sbm['icon']; ?>"></i> <?= $sbm['icon']; ?></td>
                              <?php if ($sbm['is_active'] == 1){
                                    echo '<td><span class="badge badge-primary">Aktif</span></td>';
                                } else {
                                    echo '<td><span class="badge badge-danger">Suspend</span></td>';
                                }
                                ?>
                              <td><button type="submit" class="status btn btn-primary btn-sm" data-toggle="modal" data-target="#statusModal" data-id="<?= $sbm['id']; ?>"><i class="fas fa-user"></i> Change Status</button> <button type="submit" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="<?= $sbm['id']; ?>"><i class="fas fa-trash"></i> Delete</button></td>
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
  <div class="modal fade" id="addMenuModal" tabindex="-1" aria-labelledby="menuModal" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="menuModal">Add Sub Menu</h5>
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
                  <form action="<?= base_url('administrator/managesubmenu'); ?>" method="POST">
                      <div class="form-group">
                          <label for="username">Parent Menu / Role</label>
                          <select class="form-control" id="menu_id" name="menu_id">
                              <option value="">--Pilih Parent Menu--</option>
                              <?php foreach ($parent as $pr) : ?>
                              <option value="<?= $pr['id']; ?>"><?= $pr['id']; ?> - <?= $pr['menu']; ?></option>
                              <?php endforeach; ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="username">Sub Menu</label>
                          <input type="text" class="form-control" id="title" name="title">
                      </div>
                      <div class="form-group">
                          <label for="username">Url</label>
                          <input type="text" class="form-control" id="url" name="url">
                      </div>
                      <div class="form-group">
                          <label for="username">Icon</label>
                          <input type="text" class="form-control" id="icon" name="icon">
                      </div>
                      <div class="form-group">
                          <div class="form-check">
                              <input type="checkbox" class="form-check-input" id="status" name="status" value="1"
                                  checked>
                              <label class="form-check-label" for="status">Aktif ?</label>
                          </div>
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
              <input type="hidden" name="where" value="user_sub_menu">
              <input type="hidden" name="function" value="managesubmenu">
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
          <form action="<?= base_url('administrator/changeActive'); ?>" method="POST">
            <div class="modal-header">
              <h4 class="modal-title">Dou you want to change status this data ?</h4>
              <input type="hidden" name="id" id="post-id">
              <input type="hidden" name="where" value="user_sub_menu">
              <input type="hidden" name="function" value="managesubmenu">
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-success" name="submit" value="Close" data-dismiss="modal">
              <input type="submit" class="btn btn-danger" name="submit" value="Yes Change">
            </div>
          </form>
          </div>
      </div>
  </div>