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
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-dice-one"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><b>KPB 1</b> <span class="small">(Konsumen 2 Bulan Yang Lalu)</span></span>
                <span class="info-box-number"><?= $reminderkpb1." Data"; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-dice-two"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><b>KPB 2</b> <span class="small">(Konsumen 4 Bulan Yang Lalu)</span></span>
                <span class="info-box-number"><?= $reminderkpb2." Data"; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-dice-three"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><b>KPB 3</b> <span class="small">(Konsumen 8 Bulan Yang Lalu)</span></span>
                <span class="info-box-number"><?= $reminderkpb3." Data"; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-dice-four"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><b>KPB 4</b> <span class="small">(Konsumen 1 Tahun Yang Lalu)</span></span>
                <span class="info-box-number"><?= $reminderkpb4." Data"; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <hr>

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-2">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">SMS Masuk</span>
                <span class="info-box-number">--No Data--</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="fas fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">SMS Terkirim</span>
                <span class="info-box-number">--No Data--</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger">
              <span class="info-box-icon"><i class="fab fa-whatsapp"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Whatsapp Masuk</span>
                <span class="info-box-number"><?= $wa_masuk." Pesan"; ?></span>
                <a href="chatwa"><span class="btn btn-warning btn-xs">Lihat Inbox</span></a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="fab fa-whatsapp"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Whatsapp Terkirim</span>
                <span class="info-box-number"><?= $wa_terkirim." Pesan"; ?></span>
                <a href="reportwa"><span class="btn btn-warning btn-xs">Lihat Report</span></a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-5">
            <div class="card">
              <div class="card-header bg-primary">
                <h3 class="card-title">Janji Booking Servis</h3>
              </div>
              <div class="card-header">
                <div class="alert alert-warning"><i class="fas fa-book"></i> Link Booking : <b>https://hondalambarona.id/booking</b> atau <b>cutt.ly/bookinglmb</b></div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="chatTable">
                    <thead>
                    <tr>
                      <th>#</th>                      
                      <th>Nama</th>
                      <th>Jadwal Kedatangan</th>
                      <th>Detail :</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>                        
                        <?php $i = 1; ?>
                        <?php foreach ($booking as $key) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $key['nama']; ?></td>
                            <td><?= date_indo($key['booking_date'])." | ".$key['booking_time']; ?></td>
                            <td>
                                <p class="small my-n1">Tipe Motor : <?= $key['tipe_motor']; ?> </p>
                                <p class="small my-n1">KM Terakhir : <?= $key['last_km']; ?> </p>
                                <p class="small my-n1">Keluhan : <?= $key['keluhan']; ?> </p>
                                <p class="small my-n1">NO WA : <?= $key['no_whatsapp']; ?> </p>                            
                            </td>
                            <td><a href="<?= base_url('crm/remiderbooking/'); ?><?= $key['id']; ?>" onclick="return confirm('Yakin ingin Reminder <?= $key['nama']; ?> ?')" class="btn-reminder btn btn-success btn-sm"><i class="fab fa-whatsapp"></i></a></td>
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
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-5">
            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header bg-navy">
                <h3 class="card-title">Konsumen Berkelahiran Hari ini : <?= date_indo(date('Y-m-d')); ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTableUser">
                    <thead>
                    <tr>
                      <th>#</th>                      
                      <th>Nama</th>
                      <th>Tanggal Lahir</th>
                      <th>Umur</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>                        
                        <?php $i = 1; ?>
                        <?php foreach ($lahirtoday as $key) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $key['nama']; ?></td>
                            <td><?= mediumdate_indo($key['tanggal_lahir']); ?></td>
                            <td><?= umur($key['tanggal_lahir']); ?> Tahun</td>
                            <td><button type="submit" class="ultahModal btn btn-warning btn-xs" data-toggle="modal" data-target="#ultahModal" data-id="<?= $key['no_mesin']; ?>" data-nama="<?= $key['nama']; ?>" data-umur="<?= umur($key['tanggal_lahir'])." Tahun";?>"><i class="fas fa-pen"></i> Ucapkan</button></td>
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

  <div class="modal fade" id="ultahModal" tabindex="-1" aria-labelledby="menuModal" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
          <form action="<?= base_url('crm/kirimultah'); ?>" method="POST">
            <div class="modal-header">
              <h4 class="modal-title">Ucapkan Ultah</h4>
              <input type="hidden" name="id" id="post-id">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Yang Ke</label>
                            <input type="text" class="form-control" name="nama" id="post-umur" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama</label>
                            <textarea type="text" class="form-control" name="nama" id="post-nama"></textarea>
                        </div>
                    </div>
                </div>
            
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-danger" name="submit" value="Close" data-dismiss="modal">
              <input type="submit" class="btn btn-primary" name="submit" value="Ucapkan">
            </div>
          </form>
          </div>
      </div>
  </div>
 