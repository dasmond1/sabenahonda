<style>
    @page {
    size: A4 potrait;
    margin-left: 1px;
    margin-right: 1px;
    margin-top: 1px;
    margin-bottom: 1px;
    border: none;
    background: none;
    }
    div.c {
    line-height: 0.44cm;
    margin-left: 8.7cm;
    margin-top:10.20cm;
    font-size: 9.5px;
    font-family: Tahoma, sans-serif;
    }
</style>
<body>
<page>
    <div id="content-wrapper" style="font-size:9pt;">
        <div class="container-fluid">
                      
            <div class="c">
                <b><?= $blangkokuning['nama']; ?></b> <br>
                <?= $blangkokuning['alamat']." DESA ".$blangkokuning['desa']." KEC. ".$blangkokuning['kecamatan']." - ".$blangkokuning['kota']; ?><br>
                <?= $blangkokuning['no_ktp']; ?> <br>
                +<?= $blangkokuning['no_telepon']; ?>
                <br>
                <br>
                <br>
                HONDA<br>
                <?= $blangkokuning['kode_unit']; ?> <br>
                SEPEDA MOTOR <br>
                SOLO <br>
                <?= $blangkokuning['tahun']; ?> <br>
                <?= $this->modelStaff->getDetailUnit($blangkokuning['kode_unit'])->silinder; ?> CC <br>
                <?= $blangkokuning['no_rangka']; ?> <br>
                <?= $blangkokuning['no_mesin']; ?> <br>
                <?= $this->modelStaff->getWarna($blangkokuning['warna'])->nama; ?> <br>
                BENSIN <br>
                HITAM <br>
                <?= date("Y"); ?>

            </div>
        </div>
    </div>
</page>

</body>
<script type="text/javascript">
window.print();
</script>
