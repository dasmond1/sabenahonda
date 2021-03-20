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
            <form role="form" method="POST" action="savePenjualan">
                <input type="hidden" class="form-control" name="sale_by" value="<?= $user['honda_id']; ?>" required>  
                <input type="hidden" class="form-control" name="urutan" value="<?= $urutan; ?>" required>  
                <p class="lead">A. Detail Penjualan</p>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
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
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>No Tanda Terima</label>
                            <input type="text" class="form-control-plaintext" name="no_tt" value="<?= $no_tt; ?>" readonly required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>No Register PLAT</label>
                            <input type="text" class="form-control" name="register_plat" maxlength="8" required>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>No PLAT Sementara</label>
                            <input type="text" class="form-control" name="plat_sementara" value="BL-" required>
                        </div>
                    </div>
                </div>
                <p class="lead">B. Tentukan Identitas Kendaraan</p>
                <hr>
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
                <p class="lead">C. Identitas Konsumen</p>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Nama Konsumen</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>No KTP</label>
                            <input type="text" class="form-control" name="no_ktp" maxlength="16" placeholder="Maksimal 16 Digit" required>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" class="form-control" name="no_telepon" placeholder="0812....." maxlength="15" required>
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
                    <div class="col-sm-2 bg-warning rounded-lg">
                        <div class="form-group ">
                            <label>Nominal Bayar</label>
                            <input type="text" class="form-control" name="nominal" id="rupiah" required>    
                        </div>
                    </div>
                </div>
                <p class="lead">D. Alamat Konsumen</p>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamat" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
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
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Kota / Kab</label>
                                <select class="form-control select2bs4" style="width: 100%;" data-placeholder="Pilih Kota" id="kotaSEL" name="kota" required>
                                       
                                </select>
                        </div>   
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Kecamatan</label>
                                <select class="form-control select2bs4" style="width: 100%;" data-placeholder="Pilih Kecamatan" id="kecamatanSEL" name="kecamatan" required>
                                    
                                </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Desa</label>
                            <select class="form-control select2bs4" style="width: 100%;" data-placeholder="Pilih Desa" id="keluarahanSEL" name="desa" required>
                                 
                            </select>   
                        </div>
                    </div>
                </div>
                    
        </div>
        <!-- /.card-body -->
        <div class="card-footer">            
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

