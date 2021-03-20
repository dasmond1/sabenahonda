<style>
    @page {
    size: A4 landscape;
    margin-left: 1px;
    margin-right: 1px;
    margin-top: 1px;
    margin-bottom: 1px;
    border: none;
    background: none;
    }
</style>
<page>
    <div id="content-wrapper" style="font-size:9pt;">
        <div class="container-fluid">
        <!-- DataTables -->
            <div class="card mb-3 mt-1 ml-1 mr-1">
                <center>
                <b>
                <h4>Laporan Penjualan Lambarona Sakti</h4>
                <p style="line-height: 0.5;"><?php echo $subtitle ?></p>
                </b>
                <hr>
                </center>
                
                <table class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>No Faktur</th>
                        <th>Tanggal</th>
                        <th>No Mesin</th>
                        <th>No Rangka</th>
                        <th>Nama</th>
                        <th>Jenis Penjualan</th>
                        <th>Sale By</th>
                        </tr>
                    </thead>
                    <tbody
                        <?php $no=1; ?>
                        <?php foreach ($datafilter as $row): ?>
                        <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row->no_so; ?></td>
                        <td><?php echo $row->tanggal_mohon; ?></td>
                        <td><?php echo $row->no_mesin; ?></td>
                        <td><?php echo $row->no_rangka; ?></td>
                        <td><?php echo $row->nama; ?></td>
                        <td><?php echo $row->jenis_penjualan; ?></td>
                        <td><?php echo $row->sale_by; ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</page>

</body>
<script type="text/javascript">
window.print();
</script>
