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
                  <h3 class="card-title">Inbox Whatsapp</h3>      
              </div>
              <div class="card-header">
                    <div class="alert alert-warning">Inbox hanya untuk di tampilkan saja, tidak dapat di balas.</div>                
              </div>
              <div class="card-body">
                <table class="table table-striped" id="chatTable" width="100%">
                    <thead>
                        <tr>                            
                            <th scope="col">Pesan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                        <?php foreach ($inbox as $key) : ?>
                            <?php $chat = $this->modelCrm->getPesan($key['dari']); ?>
                        <tr>                            
                            <td id="balas">
                            <div class="direct-chat-msg">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-left">From +<?= $key['dari']; ?></span>
                                    </div>
                                   <?php foreach ($chat as $pesan) : ?>                                
                                    <img class="direct-chat-img" src="<?= base_url('assets/img/user-photo/'); ?>default.png" alt="message user image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text bg-success">
                                    <?= $pesan['pesan']; ?>
                                    
                                    <span class="direct-chat-timestamp small float-right text-white"><?= $pesan['timestamp']; ?></span>
                                    </div>
                                <!-- /.direct-chat-text -->
                                </div>
                            <?php endforeach; ?>
                            </td>                     
                        </tr>
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