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
            <div class="col-md-4">
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Template Whatsapp</h3>
                </div>
                <div class="card-body">
                    <?php
                        $message = $this->session->flashdata('message');
                        if (isset($message)) {
                        echo $message;
                        $this->session->unset_userdata('message');
                        }
                    ?>
                    <form role="form" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Nama Template</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nama_template" placeholder="EX : KEMERDEKAAN 2020">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label>File Gambar <span class="small">Max : 2 MB (JPG/JPEG/PNG)</span></label>
                                    <div class="input-group">
                                        <input type="file" class="form-control-file" name="file" accept="image/x-png,image/jpg,image/jpeg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Isi Pesan</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="pesan" rows="7"></textarea>                                        
                                    </div>                                    
                                </div>
                                <div class="card bg-warning">
                                    <span class="small mt-3">
                                        <ol>
                                            <li><b>#nama</b> = Untuk Penyebutan Nama Konsumen</li>
                                            <li><b>#sapa</b> = Untuk Penyapaan Berdasarkan Jenis Kelamin</li>
                                            <li><b>#nosin</b> = Untuk Pemanggilan Ulang Nomor Mesin</li>
                                            <li><b>#dealer</b> = Untuk Penyebutan Nama Dealer</li>
                                            <li><b>#salam</b> = Untuk Penyebutan Salam SATUHati</li>
                                            <li><b>#sender</b> = Untuk Penyebutan Nama Pengirim</li>
                                            <li>Apit Teks dengan underscore (_Blablabla_): untuk mencetak miring.</li>
                                            <li>Apit Teks bintang (*Blablabla*): untuk mencetak teks tebal.</li>
                                            <li>Apit Teks gelombang (~Blablabla~): untuk mencetak teks tercoret.</li>
                                        </ol>
                                    </span>
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
          <!-- /.card -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Template</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="dataTableUser">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Template</th>
                                <th>Type</th>
                                <th>Pesan</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($template as $key) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $key['nama_template']; ?></td>
                                    <td><?= $key['tipe']; ?></td>
                                    <td><?= mb_strimwidth(urldecode($key['pesan']), 0, 100, "..."); ?></td>
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
            <!-- /.card -->
        </div>
        <!-- End Row -->
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
              <input type="hidden" name="where" value="template">
              <input type="hidden" name="function" value="createtemplatewa">
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-success" name="submit" value="Close" data-dismiss="modal">
              <input type="submit" class="btn btn-danger" name="submit" value="Yes Delete">
            </div>
          </form>
          </div>
      </div>
  </div>