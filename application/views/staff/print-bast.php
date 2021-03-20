<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print BAST UNIT</title>

    <style>
        body {
            background: rgb(204,204,204);
        }
        page {
            background: white;
            display: block;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
        }
        page[size="A4"] {  
            width: 21cm;
            height: 16.5cm;
            margin: 0 auto;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
        }
        div.content {
            margin-left: 24px;
            margin-right: 18px;
        }
        div.footer {
          bottom: 0;
          margin-left:22px;
          font-size:7pt;
          }
         @media print {
          div.footer {
          margin-left:22px;
          font-size:7pt;
          }
          
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
            margin-bottom: 55px;
        }
        div.head {            ;
            padding-left: 380px;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 9pt;
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
          <h3><u>SURAT PENGANTAR GUDANG</u></h3>
        </center>

        <div class="content">
          <div class="row">
               <div class="col-12 head">
                    ACEH BESAR
               </div>
               <div class="col-12 head">
                    Kepada Yth,
               </div>
               <div class="col-12 head">
                    <b><?= $output['nama']; ?></b>
               </div>
               <div class="col-12 head">
                    <?= $output['alamat']; ?>
               </div>
               <div class="col-12 head">
                    <?= $output['kecamatan']; ?> - <?= $output['kota']; ?>
               </div>
          </div>
        </div>

        <div class="content-table">
          <p>Harap di terima dengan baik <b>1 (Satu)</b> unit Sepeda Motor Honda</p>
          <table style="border:none;">
               <thead>
               <tr>
                    <td style="border:none;">Berdasarkan Invoice Nomor</td>
                    <td style="border:none;">:</td>
                    <td style="border:none;"><?= $output['no_so']; ?></td>
               </tr>
               <tr>
                    <td style="border:none;">Tanggal</td>
                    <td style="border:none;">:</td>
                    <td style="border:none;"><?= date_indo($output['tanggal_mohon']); ?></td>
               </tr>
            </thead>
          </table>
        </div>
        <div class="content-table">
        <table style="width:100%;">
            <thead>
                <tr>
                    <td><center><b>No</b></center></td>
                    <td><center><b>Tipe</b></center></td>
                    <td><center><b>Warna</b></center></td>
                    <td><center><b>No Rangka</b></center></td>
                    <td><center><b>No Mesin</b></center></td>
                </tr>
            </thead>
            <tbody>
                    <td><center>1</td>
                    <td><center><?= $output['tipe']; ?></center></td>
                    <td><center><?= $output['warna']; ?></center></td>
                    <td><center><?= $output['no_rangka']; ?></center></td>
                    <td><center><?= $output['no_mesin']; ?></center></td>
            </tbody>
        </table>
        </div>

        <center>
        
            <h4><u>RINCIAN KELENGKAPAN UNIT</u></h4>
        
        </center>
        
        <div class="content-table">
        <table style="width:100%;">
            <thead>
               <tr>
                    <td><center><b>No.</b></center></td>
                    <td><center><b>Tipe</b></center></td>
                    <td><center><b>SPB</b></center></td>
                    <td><center><b>Buku Servis</b></center></td>
                    <td><center><b>Manual Book</b></center></td>
                    <td><center><b>Tools Kit</b></center></td>
                    <td><center><b>Battery</b></center></td>
                    <td><center><b>Helmet</b></center></td>
                    <td><center><b>Spion</b></center></td>
               </tr>
            </thead>
            <tbody>
                <tr>
                    <td><center>1</center></td>
                    <td><center><?= $output['tipe']; ?></center></td>
                    <td><center>1</center></td>
                    <td><center>1</center></td>
                    <td><center>1</center></td>
                    <td><center>1</center></td>
                    <td><center>1</center></td>
                    <td><center>1</center></td>
                    <td><center>1</center></td>
                </tr>
                <tr>
                    <td><b>Grand Total</b></td>
                    <td><center></center></td>
                    <td ><center>1</center></td>
                    <td><center>1</center></td>
                    <td><center>1</center></td>
                    <td><center>1</center></td>
                    <td><center>1</center></td>
                    <td><center>1</center></td>
                    <td><center>1</center></td>
                </tr>
                <tr>
                    <td><b>Satuan</b></td>
                    <td style="border:none;"><center></center></td>
                    <td style="border:none;"><center></center></td>
                    <td><center>Rangkap</center></td>
                    <td><center>Rangkap</center></td>
                    <td><center>Set</center></td>
                    <td><center>Set</center></td>
                    <td><center>Set</center></td>
                    <td><center>Set</center></td>
                </tr>
            </tbody>
        </table>
        </div>
        <div class="content-table" style="border: 1px; border-style: dotted; margin-top: 2px; padding-bottom: 55px;">
          Catatan :
          
        </div>
        <div class="content-table-center">
        <table style="width:100%; border: none;">
            <tbody>
                <tr>
                    <td style="border: none;"><center><b>Yang Menerima</b></center></td>
                    <td style="border: none;"> </td>
                    <td style="border: none;"><center><b>Yang Mengantar</b></center></td>
                    <td style="border: none;"> </td>
                    <td style="border: none;"><center><b>Hormat Kami</b></center></td>
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
                    <td style="border: none;"><center>____________________<br>&nbsp;</center></td>
                    <td style="border: none;"> </td>
                    <td style="border: none;"><center><u>WAHYUDI MARTOYOSO</u><br>SO.Head</center></td>
                </tr>
            </tbody>
        </table>
        </div>
        <div class="footer">
          <span>Printed By PT. Lambarona Sakti - Aceh Besar</span>
        </div>
    </page>
    
</body>
<footer>
    <script>window.print();</script>
</footer>
</html>