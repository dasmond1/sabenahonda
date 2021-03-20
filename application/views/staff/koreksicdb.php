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
                  <h3 class="card-title">Kelengkapan Data Konsumen</h3>
              </div>
              <div class="card-header">
              <label for="Header">Koreksi By File</label>
                <form class="form-inline" action="importcdb" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" class="form-control-file" name="file">
                    </div>
                    <div class="col-sm d-flex flex-row-reverse">
                        <button type="submit" name="submit" class="btn btn-primary btn-sm mb-2"><i class="fas fa-upload"></i> Upload</button>
                    </div>
                </form>
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
                      <th>#</th>
                      <th>No Faktur</th>
                      <th>No Mesin</th>
                      <th>Nama</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                          <?php foreach ($detail_cdb as $dtl_cdb) : ?>
                          <tr>
                              <td><?= $i; ?></td>
                              <td><?= $dtl_cdb['no_so']; ?></td>
                              <td><?= $dtl_cdb['no_mesin']; ?></td>
                              <td><?= $dtl_cdb['nama']; ?></td>
                              <td><button type="submit" class="updateCDB btn btn-warning btn-sm" data-toggle="modal" data-target="#updateModal" data-id="<?= $dtl_cdb['no_mesin']; ?>" data-nama="<?= $dtl_cdb['nama']; ?>"><i class="fas fa-pen"></i> Koreksi</button></td>
                          </tr>
                          <?php $i++; ?>
                          <?php endforeach; ?>
                    </tbody>
                  </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  Data Harus di lengkapi agar bisa mencetak Blangko Samsat
              </div>
              <!-- /.card-footer-->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal Update -->
  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="menuModal" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
          <form action="<?= base_url('staff/koreksicdb'); ?>" method="POST">
            <div class="modal-header">
              <h4 class="modal-title">Update Data Konsumen</h4>
              <input type="hidden" name="where" value="konsumen">
              <input type="hidden" name="function" value="koreksicdb">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama</label>
                            <input type="text" class="form-control" name="nama" id="post-nama">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">No Mesin</label>
                            <input type="text" class="form-control" name="no_mesin" id="post-id" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                             <label for="exampleFormControlInput1">Kode Unit</label>
                             <select class="form-control select2bs4" style="width: 100%;" data-placeholder="Pilih Kode Unit" name="kode_unit" required>
                                <option></option>
                                <?php foreach ($kodeunit as $kdu) : ?>                                
                                <option value="<?= $kdu['kode_unit']; ?>"><?= $kdu['kode_unit']." - ".$kdu['nama']; ?></option>
                                <?php endforeach; ?>
                             </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">No KTP</label>
                            <input type="text" class="form-control" name="no_ktp" id="no_ktp" placeholder="11171....." required>
                        </div>                    
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">No Telepon</label>
                            <input type="text" class="form-control" name="no_telepon" placeholder="081269..." required>
                        </div>                   
                    </div>
                </div>                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tanggal Lahir</label>
                            <input type="text" class="form-control-plaintext" id="tanggal_lahir" name="tanggal_lahir" placeholder="Data Not Found" style="pointer-events: none;" required>
                        </div>  
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Jenis Kelamin</label>
                            <input type="hidden" class="form-control-plaintext" id="jenis_kelamin" name="jenis_kelamin" placeholder="Data Not Found" style="pointer-events: none;" required>
                            <input type="text" class="form-control-plaintext" id="jk" placeholder="Data Not Found" style="pointer-events: none;" required>
                        </div>
                    </div>
                </div>                
                <div class="form-group">
                <label for="exampleFormControlInput1">Alamat</label>
                    <input type="text" class="form-control" name="alamat" required>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Provinsi</label>
                                <select class="form-control select2bs4" style="width: 100%;" data-placeholder="Pilih Provinsi" id="provinsiSEL" name="provinsi" required>
                                    <option></option>
                                    <?php foreach ($provinsi as $prov) : ?>                                
                                    <option value="<?= $prov['id']; ?>"><?= $prov['id']; ?> - <?= $prov['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                        </div>      
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Kota / Kab</label>
                                <select class="form-control select2bs4" style="width: 100%;" data-placeholder="Pilih Kota" id="kotaSEL" name="kota" required>
                                       
                                </select>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Kecamatan</label>
                            <select class="form-control select2bs4" style="width: 100%;" data-placeholder="Pilih Kecamatan" id="kecamatanSEL" name="kecamatan" required>
                                
                            </select>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Desa</label>
                            <select class="form-control select2bs4" style="width: 100%;" data-placeholder="Pilih Desa" id="keluarahanSEL" name="desa" required>
                                 
                            </select>
                        </div>
                    </div>
                </div>         
            </div>
            <div class="modal-footer">
              <button class="btn btn-danger" value="Close" data-dismiss="modal"> Close</button>
              <input type="submit" class="btn btn-success" name="submit" value="Update">
            </div>
          </form>
          </div>
      </div>
  </div>