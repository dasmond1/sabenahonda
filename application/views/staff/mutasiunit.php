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
                  <h3 class="card-title">Mutasi Unit Keluar Dealer</h3>
              </div>
              <div class="card-body">
                <?php
                $message = $this->session->flashdata('message');
                if (isset($message)) {
                echo $message;
                $this->session->unset_userdata('message');
                }
                ?>
                <form role="form" method="POST">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Tentukan Nomor Mesin</label>
                                <div class="input-group">
                                    <select class="form-control select2bs4" multiple="multiple" style="width: 100%;" data-placeholder="Pilih No Mesin" id="nomesin" name="nomesin[]" required>
                                    <option></option>
                                    <?php foreach ($stok as $stk) : ?>                                
                                    <option value="<?= $stk['no_mesin']; ?>"><?= $stk['no_mesin']; ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Tujuan Transfer Unit</label>
                                <div class="input-group">
                                    <select class="form-control" data-placeholder="Pilih Tujuan Transfer" name="tujuanX" onchange="changeFunc();" id="selectBox" required>
                                    <option>Pilih Tujuan</option>
                                    <option value="On Pos Inpur">Pos Indrapuri</option>
                                    <option value="On Pos Lamno">Pos Lamno</option>
                                    <option value="pameran">Pameran</option>
                                    <option value="other">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4" id="textboxes" style="display: none;">
                            <div class="form-group">
                                <label>Tujuan Lainnya</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="tujuan1" placeholder="Contoh : PT. CAPELLA DINAMIKA NUSANTARA (PEUNAYONG)">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Alamat Tujuan</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="alamat_tujuan" placeholder="Contoh : Jl. Banda Aceh - Medan ....">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Supir / Pengirim</label>
                                <select class="form-control select2bs4" style="width: 100%;" data-placeholder="Pilih Driver" name="driver" required>
                                    <option></option>
                                    <?php foreach ($driver as $supir) : ?>
                                        <?php if ($supir['honda_id'] == "0") : ?>
                                        <option value="" disabled><?= $supir['nama']; ?> - <?= $supir['nama']; ?></option>
                                        <?php else : ?>
                                        <option value="<?= $supir['nama']; ?>"><?= $supir['nama']; ?></option>
                                        <?php endif; ?>
                                <?php endforeach; ?>
                                </select>
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                </form>
              </div>
              <!-- /.card-footer-->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->