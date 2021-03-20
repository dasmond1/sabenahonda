<style>
    @page {
    size: A4 landscape;
    margin-left: 2px;
    margin-right: 2px;
    margin-top: 2px;
    margin-bottom: 2px;
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
                <h4><?php echo $title ?></h4>
                <p style="line-height: 0.5;"><?php echo $subtitle ?></p>
                </b>
                <hr>
                </center>
                
                <table class="table table-bordered table-striped" width="100%" cellspacing="10px">
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>No TT</th>
                        <th>Tanggal</th>
                        <th>No Mesin</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody
                        <?php $no=1; ?>
                        <?php $total=0; ?>
                        <?php foreach ($datafilter as $row): ?>
                        <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row->no_tt; ?></td>
                        <td><?php echo date_indo($row->tanggal); ?></td>
                        <td><?php echo $row->no_mesin; ?></td>
                        <td><?php echo $row->jenis_penjualan." QQ ".$row->nama; ?></td>
                        <td><?php echo $row->s_dealer." By Dealer"; ?></td>
                        <td><?php echo rupiah($row->nominal); ?></td>
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
