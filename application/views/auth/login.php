<?php
$b = time();
$hour = date("G",$b);
    if ($hour>=0 && $hour<=11)
    {
        $salamcuaca = "<i class='fas fa-sun'></i> Selamat Pagi";
       
    }
    elseif ($hour >=12 && $hour<=14)
    {
        $salamcuaca = "<i class='fas fa-sun'></i> Selamat Siang";
        
    }
    elseif ($hour >=15 && $hour<=18)
    {
        $salamcuaca = "<i class='fas fa-moon'></i> Selamat Sore";
        
    }
    elseif ($hour >=19 && $hour<=23)
    {
        $salamcuaca = "<i class='fas fa-moon'></i> Selamat Malam";
        
    }
?>

<body class="hold-transition login-page bg-dark">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= base_url(); ?>" class="text-white"><b>PORTAL </b>LMB</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <div class="ribbon-wrapper">
                    <div class="ribbon bg-danger">
                        V 2.0
                    </div>
                </div>
                <p class="login-box-msg"><?= $salamcuaca; ?></p>
                <?php
                $message = $this->session->flashdata('message');
                if (isset($message)) {
                echo '<div class="alert alert-warning" id="myalert"><i class="fas fa-exclamation-triangle"></i> ' . $message . '</div>';
                $this->session->unset_userdata('message');
                }
                ?>

                <form action="<?= base_url('auth'); ?>" method="POST">
                    <?= form_error('username', '<span class="small text-danger">', '</span>'); ?>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" id="username" name="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('password', '<span class="small text-danger">', '</span>'); ?>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-auto">
                        
                            <button type="submit" class="btn btn-primary mr-1"><i class="fas fa-sign-in-alt"></i> Sign In</button>
                        
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <div class="row mt-5">
    <h4><a href="https://sisfo.hondalambarona.id" class="text-white"><i class="fas fa-home"></i> Home</a></h4>
    </div>

    