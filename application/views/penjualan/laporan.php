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
          <h3 class="card-title">Input Laporan</h3>
        </div>
        <div class="card-body">
                <?php
                $message = $this->session->flashdata('message');
                if (isset($message)) {
                echo $message;
                $this->session->unset_userdata('message');
                }
                ?>
            <form role="form" method="POST" id="laporan">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Tanggal Penjualan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                                <input type="date" class="form-control" name="tanggal" value="<?= date("Y-m-d");?>" min="<?= date("Y-m-d", strtotime("-1 months"));?>" required>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>No Mesin</label>
                            <select class="form-control select2bs4" style="width: 100%;" data-placeholder="Pilih No Mesin" name="no_mesin" id="no_mesin" required>
                                <option></option>
                                <?php foreach ($stok as $stk) : ?>                                
                                <option value="<?= $stk['no_mesin']; ?>"><?= $stk['no_mesin']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>No Rangka</label>
                            <input type="text" class="form-control-plaintext" id="no_rangka" name="no_rangka" placeholder="Data Not Found" style="pointer-events: none;" required>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Tipe</label>
                            <input type="text" class="form-control-plaintext" id="tipe" name="tipe" placeholder="Data Not Found" style="pointer-events: none;" required>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Warna</label>
                            <input type="text" class="form-control-plaintext" id="warna" name="warna" placeholder="Data Not Found" style="pointer-events: none;" required>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="text" class="form-control-plaintext" id="tahun" name="tahun" placeholder="Data Not Found" style="pointer-events: none;" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                    <!-- text input -->
                        <div class="form-group">
                            <label>Nomor Faktur</label>
                            <div class="input-group">
                                <span class="input-group-addon col-md-8"><input type="number" class="form-control" name="nomor_faktur1" placeholder="Ex : 01" maxlength="4" required></span><span class="input-group-addon col-md-4"><input type="text" class="form-control" name="nomor_faktur2" style="pointer-events: none;" value="/<?= romawi_bulan(date('m')); ?>/<?= date('Y'); ?>" readonly></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                    <!-- text input -->
                        <div class="form-group">
                            <label>Nama Konsumen</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Jenis Penjualan</label>
                            <select class="form-control select2bs4" style="width: 100%;" data-placeholder="Pilih Jenis Penjualan" name="jenis_penjualan" required>
                            <option></option>
                                <?php foreach ($jenis as $jns) : ?>                                
                                <option value="<?= $jns['singkatan']; ?>"><?= $jns['singkatan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Sale By</label>
                            <select class="form-control select2bs4" style="width: 100%;" data-placeholder="Pilih FLP" name="sale_by" required>
                                <option></option>
                                <?php foreach ($saleby as $slb) : ?>
                                        <?php if ($slb['honda_id'] == "0") : ?>
                                        <option value="" disabled><?= $slb['inisial']; ?> - <?= $slb['nama']; ?></option>
                                        <?php else : ?>
                                        <option value="<?= $slb['honda_id']; ?>"><?= $slb['inisial']; ?> - <?= $slb['nama']; ?></option>
                                        <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Jenis Konsumen</label>
                            <select class="form-control" style="width: 100%;" name="jenis_konsumen" required>
                                    <option value="I" selected>Individu</option>
									<option value="C">Collective</option>
									<option value="G">Group</option>
									<option value="J">Join Promo</option>
                            </select>
                        </div>
                    </div>
                </div>
                    <input type="hidden" class="form-control" name="no_spg" id="no_spg" required>
                    <input type="hidden" class="form-control" name="no_doh" id="no_doh" required>  
                    <input type="hidden" class="form-control" name="created_by" value="<?= $user['nama']; ?>" required>  
        </div>
        <!-- /.card-body -->
        <div class="card-footer">            
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

      <!-- Default box -->
      <div class="card">
        <div class="card-header bg-secondary">
          <h3 class="card-title">Proses Laporan Pos (Indrapuri / Lamno)</h3>
        </div>
        <div class="card-body">
                <?php
                $message = $this->session->flashdata('message');
                if (isset($message)) {
                echo $message;
                $this->session->unset_userdata('message');
                }
                ?>
            
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

