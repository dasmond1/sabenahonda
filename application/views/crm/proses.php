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
    <!-- Default box -->
    <!-- Row Proses Kirim -->
    <div class="row">
        <!-- Kirim WA -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fab fa-whatsapp"></i> Kirim Ke Whatsapp</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url(); ?>crm/proseskirim" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pilih Template</label>
                                <div class="input-group">
                                    <select class="form-control select2bs4" style="width: 100%;" data-placeholder="Pilih Template" name="template" required>
                                        <option></option>
                                        <?php foreach ($template as $key) : ?>                                
                                        <option value="<?= $key['id']; ?>"><?= $key['nama_template']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pilih Grup Konsumen</label>
                                <div class="input-group">
                                    <select class="form-control select2bs4" style="width: 100%;" data-placeholder="Pilih Grup" name="grup" required>
                                        <option></option>
                                        <?php foreach ($grup as $key) : ?>                                
                                        <option value="<?= $key['nama_group']; ?>"><?= $key['nama_group']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pilih Server</label>
                                <div class="input-group">
                                    <select class="form-control select2bs4" style="width: 100%;" data-placeholder="Pilih Server">
                                        <option selected>Server 1 - 0852 9601 1998</option>
                                        <option>Server 2 - Percobaan</option>
                                        <option>Server 3 - Percobaan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <button class="btn btn-primary" type="submit" name="whatsapp">Kirim</button>
                    </form>
                </div>
                <!-- /.card-footer-->
            </div>
        </div>
        <!-- Kirim SMS -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-envelope"></i> Kirim Ke SMS</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url(); ?>crm/proseskirim" method="POST">
                    <input type="hidden" name="provider" value="sms">
                    <div class="row">                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pilih Template</label>
                                <div class="input-group">
                                    <select class="form-control select2bs4" style="width: 100%;" data-placeholder="Pilih Template" name="template" required>
                                        <option></option>
                                        <?php foreach ($template_sms as $key) : ?>                                
                                        <option value="<?= $key['id']; ?>"><?= $key['nama_template']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pilih Grup Konsumen</label>
                                <div class="input-group">
                                    <select class="form-control select2bs4" style="width: 100%;" data-placeholder="Pilih Grup" name="template" required>
                                        <option></option>
                                        <?php foreach ($grup as $key) : ?>                                
                                        <option value="<?= $key['nama_group']; ?>"><?= $key['nama_group']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pilih Android / Smartphone</label>
                                <div class="input-group">
                                    <select class="form-control select2bs4" style="width: 100%;" data-placeholder="Pilih Perangkat" name="template" required>
                                        <option></option>
                                        <?php foreach ($template_sms as $key) : ?>                                
                                        <option value="<?= $key['id']; ?>"><?= $key['nama_template']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit" name="sms">Kirim</button>
                    </form>
                </div>
                <!-- /.card-footer-->
            </div>
        </div>
    </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->