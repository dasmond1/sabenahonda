

    <style>
        body {
            background: rgb(204,204,204);
            margin: 0;
            font-size: 13pt;
            font-family: "Times New Roman", Times, serif;
        }
        page {
            background: white;
            display: block;
            margin: 7mm auto;
            
        }
        page[size="A4"] {  
            border: 1px solid black;
            margin-top: 7mm;
            margin-bottom: 5mm;
            padding-left: 5mm;
            padding-right: 5mm;

        }
        
        @media print {
            body{
                width: 21cm;
                height: 29.7cm;
                margin: 7mm auto;
                font-size: 13pt;
                font-family: "Times New Roman", Times, serif;
                
                
                /* change the margins as you want them to be. */
        }
        .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
        float: left!important;
        }
        .col-sm-12 {
        width: 100%;
        }
        .col-sm-11 {
        width: 91.66666666666666%;
        }
        .col-sm-10 {
        width: 83.33333333333334%;
        }
        .col-sm-9 {
        width: 75%;
        }
        .col-sm-8 {
        width: 66.66666666666666%;
        }
        .col-sm-7 {
        width: 58.333333333333336%;
        }
        .col-sm-6 {
        width: 50%;
        }
        .col-sm-5 {
        width: 41.66666666666667%;
        }
        .col-sm-4 {
        width: 33.33333333333333%;
        }
        .col-sm-3 {
        width: 25%;
        }
        .col-sm-2 {
        width: 16.666666666666664%;
        }
        .col-sm-1 {
        width: 8.333333333333332%;
        }
                   
        }
        
    </style>

</head>
<body>
    
    <page size="A4" class="mt-5">
        <!-- header -->
        <div class="row pt-1">
            <div class="col-sm-4">
            <img src="<?= base_url('assets/img/'); ?>header-kwitansi.png" height="40" class="ml-1 mt-1 d-inline-block align-center" alt="">
            </div>
            <div class="col-sm-6 text-center">
            <h3 class="mr-3"><strong>KWITANSI SEMENTARA</strong></h3>
            <p class="mr-3 mt-n3"><?= $detail['no_tt']; ?></p>
            </div>
            <div class="col-sm-2">                
                <div class="input-group mt-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Lembar ASLI</b></span>
                    </div>  
                </div>             
            </div>
        </div>
        <hr class="mt-n2">
        <!-- end header -->
        <!-- row1 -->
        <div class="row">
            <div class="col-sm-2">
                <p><b>Terima Dari</b></p>
            </div>
            <div class="col-sm-10">
                <p>: <?= $detail['jenis_penjualan']." QQ "."<b>".$detail['nama']."</b>"; ?></p>
                <hr class="mt-n3">
            </div>
        </div>
        <!-- end row1 -->
        <!-- row2 -->
        <div class="row">
            <div class="col-sm-2">
                <p><b>Uang Sebanyak</b></p>
            </div>
            <div class="col-sm-10">
                <p>: <?= terbilang($detail['nominal'])." Rupiah"; ?></p>
                <hr class="mt-n3">
            </div>
        </div>
        <!-- end row2 -->
        <!-- row3 -->
        <div class="row">
            <div class="col-sm-2">
                <p><b>Untuk Pembayaran</b></p>
            </div>
            <div class="col-sm-10">
                <p>: 1 (Satu) Unit Sepeda Motor Honda.</p>
                <hr class="mt-n3">
                <div class="row">
                    <div class="col-sm-2">
                        <p><b>No Mesin</b></p>                        
                    </div>
                    <div class="col-sm-4">
                        <p>: <?= $detail['no_mesin']; ?></p>                        
                    </div> 

                    <div class="col-sm-2">
                        <p><b>No Rangka</b></p>                        
                    </div>
                    <div class="col-sm-4">
                        <p>: <?= $unit['no_rangka']; ?></p>                        
                    </div>       
                </div>
                <div class="row mt-n3">
                    <div class="col-sm-2">
                        <p><b>Kode Unit</b></p>
                        
                    </div>
                    <div class="col-sm-4">
                        <p>: <?= $unit['kode_unit']; ?></p>                        
                    </div> 
                    <div class="col-sm-2">
                        <p><b>Warna - Tahun</b></p>                        
                    </div>
                    <?php 
                        $id = $unit['warna'];
                        $warna = $this->modelInpur->getWarna($id);
                    ?>
                    <div class="col-sm-4">
                       <p>: <?= $warna['kode']."-".$warna['nama']." - ".$unit['tahun']; ?></p>
                    </div>       
                </div>
            </div>
        </div>
        <!-- end row3 -->
        <div class="row">
            <div class="col-sm-4 my-auto">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Terbilang Rp.</b></span>
                    </div>
                    <input type="text" class="form-control" value="<?= rupiah($detail['nominal']); ?>">
                </div>
            </div>
            <div class="col-sm-8 ml-auto text-right">
                <p class="pb-5">Indrapuri, <?= date_indo($detail['tanggal']); ?></p>
                <p>_______________________</p>
            </div>
        </div>
    </page>
    <hr class="mt-5 mb-5">
    <page size="A4">
        <!-- header -->
        <div class="row pt-1">
            <div class="col-sm-4">
            <img src="<?= base_url('assets/img/'); ?>header-kwitansi.png" height="40" class="ml-1 mt-1 d-inline-block align-center" alt="">
            </div>
            <div class="col-sm-6 text-center">
            <h3 class="mr-3"><strong>KWITANSI SEMENTARA</strong></h3>
            <p class="mr-3 mt-n3"><?= $detail['no_tt']; ?></p>
            </div>
            <div class="col-sm-2">                
                <div class="input-group mt-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Copy Dealer</b></span>
                    </div>  
                </div>             
            </div>
        </div>
        <hr class="mt-n2">
        <!-- end header -->
        <!-- row1 -->
        <div class="row">
            <div class="col-sm-2">
                <p><b>Terima Dari</b></p>
            </div>
            <div class="col-sm-10">
                <p>: <?= $detail['jenis_penjualan']." QQ "."<b>".$detail['nama']."</b>"; ?></p>
                <hr class="mt-n3">
            </div>
        </div>
        <!-- end row1 -->
        <!-- row2 -->
        <div class="row">
            <div class="col-sm-2">
                <p><b>Uang Sebanyak</b></p>
            </div>
            <div class="col-sm-10">
                <p>: <?= terbilang($detail['nominal'])." Rupiah"; ?></p>
                <hr class="mt-n3">
            </div>
        </div>
        <!-- end row2 -->
        <!-- row3 -->
        <div class="row">
            <div class="col-sm-2">
                <p><b>Untuk Pembayaran</b></p>
            </div>
            <div class="col-sm-10">
                <p>: 1 (Satu) Unit Sepeda Motor Honda.</p>
                <hr class="mt-n3">
                <div class="row">
                    <div class="col-sm-2">
                        <p><b>No Mesin</b></p>                        
                    </div>
                    <div class="col-sm-4">
                        <p>: <?= $detail['no_mesin']; ?></p>                        
                    </div> 

                    <div class="col-sm-2">
                        <p><b>No Rangka</b></p>                        
                    </div>
                    <div class="col-sm-4">
                        <p>: <?= $unit['no_rangka']; ?></p>                        
                    </div>       
                </div>
                <div class="row mt-n3">
                    <div class="col-sm-2">
                        <p><b>Kode Unit</b></p>
                        
                    </div>
                    <div class="col-sm-4">
                        <p>: <?= $unit['kode_unit']; ?></p>                        
                    </div> 
                    <div class="col-sm-2">
                        <p><b>Warna - Tahun</b></p>                        
                    </div>
                    <?php 
                        $id = $unit['warna'];
                        $warna = $this->modelInpur->getWarna($id);
                    ?>
                    <div class="col-sm-4">
                       <p>: <?= $warna['kode']."-".$warna['nama']." - ".$unit['tahun']; ?></p>
                    </div>       
                </div>
            </div>
        </div>
        <!-- end row3 -->
        <div class="row">
            <div class="col-sm-4 my-auto">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Terbilang Rp.</b></span>
                    </div>
                    <input type="text" class="form-control" value="<?= rupiah($detail['nominal']); ?>">
                </div>
            </div>
            <div class="col-sm-8 ml-auto text-right">
                <p class="pb-5">Indrapuri, <?= date_indo($detail['tanggal']); ?></p>
                <p>_______________________</p>
            </div>
        </div>
    </page>
    <hr class="mt-5 mb-5">
    <page size="A4">
        <!-- header -->
        <div class="row pt-1">
            <div class="col-sm-4">
            <img src="<?= base_url('assets/img/'); ?>header-kwitansi.png" height="40" class="ml-1 mt-1 d-inline-block align-center" alt="">
            </div>
            <div class="col-sm-6 text-center">
            <h3 class="mr-3"><strong>KWITANSI SEMENTARA</strong></h3>
            <p class="mr-3 mt-n3"><?= $detail['no_tt']; ?></p>
            </div>
            <div class="col-sm-2">                
                <div class="input-group mt-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Copy Pos Dealer</b></span>
                    </div>  
                </div>             
            </div>
        </div>
        <hr class="mt-n2">
        <!-- end header -->
        <!-- row1 -->
        <div class="row">
            <div class="col-sm-2">
                <p><b>Terima Dari</b></p>
            </div>
            <div class="col-sm-10">
                <p>: <?= $detail['jenis_penjualan']." QQ "."<b>".$detail['nama']."</b>"; ?></p>
                <hr class="mt-n3">
            </div>
        </div>
        <!-- end row1 -->
        <!-- row2 -->
        <div class="row">
            <div class="col-sm-2">
                <p><b>Uang Sebanyak</b></p>
            </div>
            <div class="col-sm-10">
                <p>: <?= terbilang($detail['nominal'])." Rupiah"; ?></p>
                <hr class="mt-n3">
            </div>
        </div>
        <!-- end row2 -->
        <!-- row3 -->
        <div class="row">
            <div class="col-sm-2">
                <p><b>Untuk Pembayaran</b></p>
            </div>
            <div class="col-sm-10">
                <p>: 1 (Satu) Unit Sepeda Motor Honda.</p>
                <hr class="mt-n3">
                <div class="row">
                    <div class="col-sm-2">
                        <p><b>No Mesin</b></p>                        
                    </div>
                    <div class="col-sm-4">
                        <p>: <?= $detail['no_mesin']; ?></p>                        
                    </div> 

                    <div class="col-sm-2">
                        <p><b>No Rangka</b></p>                        
                    </div>
                    <div class="col-sm-4">
                        <p>: <?= $unit['no_rangka']; ?></p>                        
                    </div>       
                </div>
                <div class="row mt-n3">
                    <div class="col-sm-2">
                        <p><b>Kode Unit</b></p>
                        
                    </div>
                    <div class="col-sm-4">
                        <p>: <?= $unit['kode_unit']; ?></p>                        
                    </div> 
                    <div class="col-sm-2">
                        <p><b>Warna - Tahun</b></p>                        
                    </div>
                    <?php 
                        $id = $unit['warna'];
                        $warna = $this->modelInpur->getWarna($id);
                    ?>
                    <div class="col-sm-4">
                       <p>: <?= $warna['kode']."-".$warna['nama']." - ".$unit['tahun']; ?></p>
                    </div>       
                </div>
            </div>
        </div>
        <!-- end row3 -->
        <div class="row">
            <div class="col-sm-4 my-auto">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Terbilang Rp.</b></span>
                    </div>
                    <input type="text" class="form-control" value="<?= rupiah($detail['nominal']); ?>">
                </div>
            </div>
            <div class="col-sm-8 ml-auto text-right">
                <p class="pb-5">Indrapuri, <?= date_indo($detail['tanggal']); ?></p>
                <p>_______________________</p>
            </div>
        </div>
    </page>
    
   
    
</body>
<footer>
    <script>window.print();</script>
</footer>
</html>