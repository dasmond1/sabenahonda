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
                  <h3 class="card-title">Update Posisi / Status Unit</h3>
              </div>
              <div class="card-body">
                    <?php
                    $message = $this->session->flashdata('message');
                    if (isset($message)) {
                    echo $message;
                    $this->session->unset_userdata('message');
                    }
                    ?>
                <table class="table table-striped" id="dataTableUser" width="100%">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>No Mesin</th>
                              <th>No Rangka</th>
                              <th>Kode / Warna</th>
                              <th>Posisi</th>
                              <th>Status</th>
                              <th>Aksi</th>                              
                          </tr>
                      </thead>
                      <tbody>
                            <? $i = 1; ?>
                            <?php foreach ($unit as $key) : ?>                                
                          <tr>
                              <td scope="row"><?= $i; ?></td>
                              <td><?= $key['no_mesin']; ?></td> 
                              <td><?= $key['no_rangka']; ?></td>
                              <td><?= $key['kode_unit']." / ".$key['warna']; ?></td>
                              <td><?= $key['posisi_unit']; ?></td>                      
                              <td><?= $key['status_unit']; ?></td>                      
                              <td>
                              <button type="submit" class="updatePosisi btn btn-primary btn-sm" data-toggle="modal" data-target="#updatePosisi" data-id="<?= $key['id']; ?>" data-status="<?= $key['status_unit']; ?>" data-posisi="<?= $key['posisi_unit']; ?>"><i class="fas fa-pen"></i> Update</button>
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

  <!-- Modal Update -->
  <div class="modal fade" id="updatePosisi" tabindex="-1" aria-labelledby="menuModal" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
          <form action="<?= base_url('administrator/updateposisiunit'); ?>" method="POST">
            <div class="modal-header">
              <h4 class="modal-title">Update Posisi / Status</h4>
              <input type="hidden" name="id" id="post-id">
              <input type="hidden" name="function" value="setposisiunit">
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="username">Posisi Sebelumnya</label>
                    <input type="text" class="form-control-plaintext" id="post-posisi" placeholder="Data Not Found" style="pointer-events: none;">
                </div>
                <div class="form-group">
                    <label for="username">Posisi Terbaru di :</label>
                        <select class="form-control select2bs4" data-placeholder="Pilih Posisi Terbaru" name="posisi" required>
                            <option></option>
                            <option value="On Dealer">Dealer Pusat</option>
                            <option value="On Pos Inpur">Pos Indrapuri</option>
                            <option value="On Pos Lamno">Pos Lamno</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="username">Status Sebelumnya</label>
                    <input type="text" class="form-control-plaintext" id="post-status" placeholder="Data Not Found" style="pointer-events: none;">
                </div>
                <div class="form-group">
                    <label for="username">Status Terbaru :</label>
                        <select class="form-control select2bs4" data-placeholder="Pilih Posisi Terbaru" name="status" required>
                            <option></option>
                            <option value="RFS">RFS</option>
                            <option value="NRFS">NRFS</option>
                        </select>
                </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-success" value="Close" data-dismiss="modal">
              <input type="submit" class="btn btn-danger" name="submit" value="Update">
            </div>
          </form>
          </div>
      </div>
  </div>