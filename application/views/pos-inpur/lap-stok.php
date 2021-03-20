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
                  <h3 class="card-title">Stok Unit On Pos Indrapuri</h3>
              </div>
              <div class="card-body">
              <table class="table table-striped" id="dataTableUser" width="100%">
                      <thead>
                          <tr>
                              <th scope="col">No</th>
                              <th scope="col">Kode Unit - Warna</th>
                              <th scope="col">No Mesin</th>
                              <th scope="col">No Rangka</th>
                              <th scope="col">Tahun</th>
                              <th scope="col">No DOH</th>
                              <th scope="col">No SPG</th>
                              <th scope="col">Posisi Unit</th>
                              <th scope="col">Status Unit</th>                   
                          </tr>
                      </thead>
                      <tbody>
                      <?php $i = 1; ?>
                          <?php foreach ($stok as $stk) : ?>
                          <tr>
                              <td><?= $i; ?></td>
                              <td><?= $stk['kode_unit']; ?> - <?= $stk['warna']; ?></td>
                              <td><?= $stk['no_mesin']; ?></td>
                              <td><?= $stk['no_rangka']; ?></td>
                              <td><?= $stk['tahun']; ?></td>
                              <td><?= $stk['no_doh']; ?></td>
                              <td><?= $stk['no_spg']; ?></td>
                              <td><?= $stk['posisi_unit']; ?></td>
                              <td><?= $stk['status_unit']; ?></td>
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