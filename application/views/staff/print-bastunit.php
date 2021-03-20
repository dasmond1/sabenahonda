<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print BAST</title>

    <style>
        body {
            background: rgb(204,204,204);
        }
        page {
            background: white;
            display: block;
        }
        page[size="A4"] {  
            width: 21cm;
            height: 29.5cm;
            margin: 0 auto;
        }
        div.content {
            margin-left: 24px;
            margin-right: 18px;
        }
        div.content-table {
            margin-left: 35px;
            margin-right: 35px;
        }
        div.content-table-center {
            margin-left: 35px;
            margin-right: 35px;
        }
        div.a {
            line-height: 80%;
            margin-left: 55px;
            margin-right: 55px;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
        h2 {
            line-height: 90%;
            margin-bottom: -13px;
        }
        
    </style>

</head>
<body>
    <page size="A4">
        <center>
        <img src="<?php echo base_url('assets/img/'); ?>header.png" width="98%" style="margin-top: 5px;">
        <br>

        <div class="a">
            <h2>Berita Acara Serah Terima (BAST)</h2>
            <p style="font-size: 18px;"><u>No : <?= $output['no_surat']; ?></u></p>
        </div>

        <!-- Penjumlahan Unit -->
        <?php foreach ($data as $key) : ?>
            <?php $nosin = explode(",", $key['no_mesin']); ?>
                <?php foreach ($nosin as $ns) : ?>
                <?php $jmlh = count($nosin); ?>
                <?php endforeach; ?>
        <?php endforeach; ?>
        
        </center>
        <div class="content">
        <p>Pada Hari ini Tanggal <?= date_indo($output['tanggal_mutasi']); ?> telah di lakukan serah terima <b><?= $jmlh; ?> Unit</b> Sepeda Motor Honda, Dari :</p>
        </div>
        
        <div class="a">
        <center>
            <h2>PT. Lambarona Sakti</h2>
            <p>JL. Banda Aceh - Medan. KM 8,5 Lambaro Kec. Ingin Jaya - Aceh Besar</p>
            
            <p><b>Kepada :</b></p>
           
            <?php if($output['tujuan'] == "On Pos Lamno") :  ?>
            <h2>Pos Penjualan Lambarona - Lamno</h2>
            <?php elseif($output['tujuan'] == "On Pos Inpur") :  ?>
            <h2>Pos Penjualan Lambarona - Indrapuri</h2>
            <?php else : ?>
            <h2><?= $output['tujuan']; ?></h2>
            <?php endif; ?>
            <p><?= $output['alamat_tujuan'] ?></p>
        </center>
        </div>
        
        <div class="content">
        <p>Dengan Rincian Sebagai Berikut:</p>
        </div>
        
        <div class="content-table">
        <table style="width:100%">
            <thead>
                <tr>
                    <td><center><b>No</b></center></td>
                    <td><center><b>Kode Unit</b></center></td>
                    <td><center><b>Warna</b></center></td>
                    <td><center><b>No Mesin</b></center></td>
                    <td><center><b>No Rangka</b></center></td>
                    <td><center><b>No SPG</b></center></td>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($data as $key) : ?>
                    <?php $nosin = explode(",", $key['no_mesin']); ?>
                        <?php foreach ($nosin as $ns) : ?>
                        <?php $detail = $this->modelStaff->getDetailbast($ns); ?>
                        
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?php echo $detail['kode_unit']; ?></td>
                            <td><?php echo $detail['warna']; ?></td>
                            <td><?= $ns; ?></td>
                            <td><?php echo $detail['no_rangka']; ?></td>
                            <td><?php echo $detail['no_spg']; ?></td>                            
                        </tr>                
                <?php $i++; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        
        <div class="content">
        <p>Masing-masing unit di lengkapi dengan:</p>
        </div>
        
        <div class="content-table">
        <table style="width:100%; border: none;">
            <tbody>
                <tr>
                    <td style="border: none;"><input type="checkbox"> 1 (satu) Pcs AKI</td>
                    <td style="border: none;"><input type="checkbox"> 1 (satu) Pcs Helm</td>
                    <td style="border: none;"><input type="checkbox"> 1 (satu) Pasang Spion</td>
                </tr>
                <tr>
                    <td style="border: none;"><input type="checkbox"> 1 (satu) Set Kunci Kontak</td>
                    <td style="border: none;"><input type="checkbox"> 1 (satu) Paket Tool Set</td>
                    <td style="border: none;"><input type="checkbox"> 1 (satu) Buku Servis + Manual Book</td>
                </tr>
                <tr>
                    <td style="border: none;"><p style="font-size: 12px;">*) Centang jika kelengkapan unit benar tersedia</p></td>
                </tr>
            </tbody>
        </table>
        </div>
        
        <div class="content">
        <p>Sepeda Motor tersebut di serahkan dalam kondisi 100% baik seteleh di periksa oleh PDI-MAN kami dan di periksa oleh pihak penerima unit yang telah di rincikan di atas. BAST ini di anggap sah jika pihak pengirim dan penerima telah setuju dan menandatangani BAST ini.</p>
        </div>
        
        <br>
        
        <div class="content-table-center">
        <table style="width:100%; border: none;">
            <tbody>
                <tr>
                    <td style="border: none;"><center><b>Pihak Penerima</b></center></td>
                    <td style="border: none;"> </td>
                    <td style="border: none;"><center><b>Yang Mengantar</b></center></td>
                    <td style="border: none;"> </td>
                    <td style="border: none;"><center><b>Diketahui Oleh</b></center></td>
                </tr>
                <tr>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                </tr>
                <tr>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                </tr>
                <tr>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                </tr>
                <tr>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                </tr>
                <tr>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                </tr>
                <tr>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                </tr>
                <tr>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                </tr>
                <tr>
                    <td style="border: none;"><center>____________________<br>&nbsp;</center></td>
                    <td style="border: none;"> </td>
                    <td style="border: none;"><center><u><?php echo $output['supir']; ?></u><br>&nbsp;</center></td>
                    <td style="border: none;"> </td>
                    <td style="border: none;"><center><u>WAHYUDI MARTOYOSO</u><br>SO.Head</center></td>
                </tr>
            </tbody>
        </table>
        </div>
    </page>
    
</body>
<footer>
    <script>window.print();</script>
</footer>
</html>