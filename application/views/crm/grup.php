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
        <div class="row">
            <div class="col-md-12">
                <?php
                    $message = $this->session->flashdata('message');
                    if (isset($message)) {
                    echo $message;
                    $this->session->unset_userdata('message');
                    }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Group By No Mesin</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url(); ?>crm/addByNomesin" method="POST">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Nama Group</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nama_group" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label>No Mesin</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="no_mesin"></textarea>                                        
                                    </div>                                    
                                <div class="card bg-danger mt-2">
                                    <ol class="pt-3">
                                        <li>Pisahkan dengan Enter</li>
                                        <li>Mohon data di seleksi sendiri menggunakan excel.</li>
                                        <li>Hindari double data Nomor Mesin. Karena akan menjadi spam whatsapp</li>
                                    </ol>
                                </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" name="submit" value="Simpan">
                        </form>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Group By Tanggal Penjualan</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url(); ?>crm/addByTanggalJual" method="POST">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Nama Group</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nama_group" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                        <input type="submit" class="btn btn-primary" name="submit" value="Simpan">
                        </form>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Group By Tanggal Lahir</h3>
                    </div>
                    <div class="card-body">
                    <form action="<?= base_url(); ?>crm/addByTanggalLahir" method="POST">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Nama Group</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nama_group" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Dari Tanggal Lahir</label>
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
                                <label>Hingga Tanggal Lahir</label>
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
                        <input type="submit" class="btn btn-primary" name="submit" value="Simpan">
                        </form>
                    </div>
                    <!-- /.card-footer-->
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List group</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="dataTableUser" width="100%">
                            <thead>
                            <tr>
                            <th>#</th>
                            <th>Nama Grup</th>
                            <th>Jumlah Anggota</th>
                            <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($grup as $key) : ?>
                                    <?php $nosin = explode(",", $key['anggota']); ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $key['nama_group']; ?></td>
                                    <td><?= count($nosin)." User"; ?></td>
                                    <td><button type="submit" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="<?= $key['id']; ?>"><i class="fas fa-trash"></i> Delete</button></td>
                                </tr>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
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
          <form action="<?= base_url('crm/delete'); ?>" method="POST">
            <div class="modal-header">
              <h4 class="modal-title">Dou you want to delete this data ?</h4>
              <input type="hidden" name="id" id="post-id">
              <input type="hidden" name="where" value="grup_konsumen">
              <input type="hidden" name="function" value="grouping">
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-success" name="submit" value="Close" data-dismiss="modal">
              <input type="submit" class="btn btn-danger" name="submit" value="Yes Delete">
            </div>
          </form>
          </div>
      </div>
  </div>