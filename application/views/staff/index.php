  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row justify-content-md-center">
            <div class="col-md-4" align="center">
                <form method="GET">
                <div class="form-group">
                    <label>Tentukan Tanggal</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d'); ?>" required>
                        <input type="submit" class="btn btn-primary ml-2" value="Cek">
                    </div>
                </div>
                </form>
                <p class="lead">Laporan Tanggal : <?= date_indo($tanggal_selected); ?></p>
            </div>
        </div>    
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-dollar-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Penjualan <?php echo date_indo($tanggal_selected); ?></span>
                <span class="info-box-number"><?= $todate; ?> Unit</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Penjualan Bulan <?php echo bulan($bulan); ?> <?php echo $tahun; ?></span>
                <span class="info-box-number"><?= $bulan_ini; ?> Unit</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-bullseye"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pencapaian Target <?php echo bulan($bulan); ?> <?php echo $tahun; ?></span>
                <?php
                $persen = ($bulan_ini/$target)*100;
                ?>
                 <div class="progress">
                  <div class="progress-bar" style="width: <?= round($persen); ?>%"></div>
                </div>
                <span class="progress-description">                
                  <?= round($persen); ?>% dari Target Jual : <?= $target; ?> Unit
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-bullhorn"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Info Program / Juklak</span>
                <span class="info-box-number"><marquee>Tidak ada informasi yang dapat di tampilkan</marquee></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Detail Penjualan <?php echo date_indo($tanggal_selected); ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                    <?php
                    $message = $this->session->flashdata('message');
                    if (isset($message)) {
                    echo $message;
                    $this->session->unset_userdata('message');
                    }
                    ?>
                <div class="table-responsive">
                  <table class="table m-0 table-striped">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>No Faktur</th>
                      <th>Nama</th>
                      <th>Via</th>
                      <th>Sale By</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                          <?php foreach ($detail as $dtl) : ?>
                          <tr>
                              <td><?= $i; ?></td>
                              <td><?= $dtl['no_so']; ?></td>
                              <td><?= $dtl['nama']; ?></td>
                              <td><span class='badge badge-primary'><?= $dtl['jenis_penjualan']; ?></span></td>
                              <td><?= $this->modelDashboard->getNamaAsli($dtl['sale_by'])->nama; ?></td>
                          </tr>
                          <?php $i++; ?>
                          <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->

          <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-tag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Barang Masuk <?php echo date_indo($tanggal_selected); ?></span>
                <span class="info-box-number"><?= $kiriman; ?> Unit</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="far fa-clock"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Waktu Unit Di Terima</span>
                <span class="info-box-number"><?= $jam_kirim; ?> WIB</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger">
              <span class="info-box-icon"><i class="fas fa-truck"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Via</span>
                <span class="info-box-number"><?= $pengirim; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="fas fa-motorcycle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Stok</span>
                <span class="info-box-number"><?= $stok; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <!-- /.card -->
            <div class="card bg-danger">
              <div class="card-header">
                <h3 class="card-title">Sale By Finco 1 Bulan</h3>
              </div>
              <!-- /.card-body -->
              <div class="card-footer bg-white p-0">
                <ul class="nav nav-pills flex-column">
                        <?php
                            $tanggal = $tanggal_selected;
                            $time  = strtotime($tanggal);
                            $bulan = date('m',$time);
                            $tahun  = date('Y',$time);
                         foreach ($detail_finco as $dtl_finco) : ?>                            
                            <li class="nav-item">
                            <a href="#" class="nav-link"><?= $dtl_finco['jenis_penjualan']; ?><span class="float-right text-primary"><?= $dtl_finco['jumlah']; ?> Unit</span></a></li>                                                                          
                        <?php endforeach; ?>
                </ul>
              </div>
              <!-- /.footer -->
            </div>
            <!-- /.card -->
            <div class="card bg-dark">
              <div class="card-header">
                <h3 class="card-title">Total Penjualan Sales 1 Bulanan</h3>
              </div>
              <!-- /.card-body -->
              <div class="card-footer bg-white p-0">
                <ul class="nav nav-pills flex-column">
                        <?php
                            $tanggal = $tanggal_selected;
                            $time  = strtotime($tanggal);
                            $bulan = date('m',$time);
                            $tahun  = date('Y',$time);
                         foreach ($detail_sale_by as $dtl_slb) : ?>                            
                            <li class="nav-item">
                            <a href="#" class="nav-link"><?= $this->modelDashboard->getNamaAsli($dtl_slb['sale_by'])->nama; ?><span class="float-right text-primary"><?= $dtl_slb['jumlah']; ?> Unit</span></a></li>                                                                          
                        <?php endforeach; ?>
                </ul>
              </div>
              <!-- /.footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->