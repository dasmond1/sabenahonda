<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $title;?> | Portal Lambarona Sakti</title>

  <!--Favicon-->
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/'); ?>img/favicon.png">

  <!-- Bootstrap core CSS -->
  <link href="<?= base_url('vendor/'); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <!-- Custom styles for this template -->
  <link href="<?= base_url('vendor/'); ?>costum-css/the-big-picture.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
  
  <!-- font digital -->
  <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>


    <script>
    function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('time').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
    }
    </script>

    <script type="text/javascript">
    function loadiklan()
    {
        $('#iklan').load('https://portal.hondalambarona.id/display/loadiklan').fadeIn("slow");
    };
    function loadfooter()
    {
        $('#footer').load('https://portal.hondalambarona.id/display/loadfooter').fadeIn("slow");
    };

    var autoLoad = setInterval(
    function ()
    {
        $('#iklan').load('https://portal.hondalambarona.id/display/loadiklan').fadeIn("slow");
    }, 60000); 

    var autoLoad1 = setInterval(
    function ()
    {
        $('#footer').load('https://portal.hondalambarona.id/display/loadfooter').fadeIn("slow");
    }, 300000); 
    
    
    
    function start() {
    startTime();
    loadiklan();
    loadfooter();
    }
    </script>

</head>

<body onload="start()">


<?php
$urlimage = base_url('assets/img/logo-white.png');
?>
  <!-- Navigation -->
  <nav class="navbar navbar-default-sm navbar-dark bg-danger" >
    <div class="navbar-nav">
        <h3 class="text-white" style="font-weight: 900;">PT. LAMBARONA SAKTI</h3>
    </div>
    <div class="navbar-nav mx-auto ">
       <h5 class="text-white"><?= longdate_indo(date("Y-m-d")); ?></h5> 
    </div>
    <div class="navbar-nav ml-auto">
        <h2><div class="text-white" id="time" style="font-family: 'Orbitron', sans-serif;"></div></h2>
    </div>
  </nav>

  <!-- Page Content -->
  <section>
    <div class="container-fluid p-0">
      <div class="row mx-auto my-1">
        <!-- Section Live TV -->
        <div class="col-sm-7 ">
          <div class="card">
            <iframe height="497" src="<?=$displayvid['iframe_url'].'?autoplay=1&controls=0&modestbranding=0';?>" frameborder="0" allowfullscreen></iframe>
          </div>
        </div>
        <!-- Section IKLAN -->
        <div class="col-sm-5 d-flex justify-content-lg-center">
          <div class="card-transparent">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel"  data-interval="10000">
              <div class="carousel-inner" id="iklan">
              </div>   
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row mx-auto pt-1 pl-4">
        <div class="col-sm">
          <div class="card-transparent">
              <div class="content mt-1">
                      <h5><i class="fas fa-mosque"></i> Jadwal Sholat<span class="small"> <i>Banda Aceh dan Sekitarnya</i></span></h5>
                <div class="row">
                      <div class="col-sm-2">
                        <h5><i class="fas fa-moon"></i> Shubuh : <blink style="font-family: 'Orbitron', sans-serif;">05:07</blink></h5>
                      </div>
                      <div class="col-sm-2">
                        <h5><i class="fas fa-sun"></i> Dhuha : <blink style="font-family: 'Orbitron', sans-serif;">06:24</blink></h5>
                      </div>
                      <div class="col-sm-2">
                        <h5><i class="fas fa-sun"></i> Dzuhur : <blink style="font-family: 'Orbitron', sans-serif;">12:25</blink></h5>
                      </div>
                      <div class="col-sm-2">
                        <h5><i class="fas fa-sun"></i> Ashar : <blink style="font-family: 'Orbitron', sans-serif;">15:43</blink></h5>
                      </div>
                      <div class="col-sm-2">
                        <h5><i class="fas fa-moon"></i> Magrib : <blink style="font-family: 'Orbitron', sans-serif;">18:24</blink></h5>
                      </div>
                      <div class="col-sm-2">
                        <h5><i class="fas fa-moon"></i> Isya : <blink style="font-family: 'Orbitron', sans-serif;">19:34</blink></h5>
                      </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="footer fixed-bottom bg-dark">
    <div class="container-fluid p-2 text-muted" id="footer"></div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="<?= base_url('vendor/'); ?>jquery/jquery.min.js"></script>
  <script src="<?= base_url('vendor/'); ?>bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>