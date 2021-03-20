
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Whatsapp.xls");
?>
 
	<center>
		<h1>REPORT WHATSAPP BROADCAST</h1>
        <h3>Tanggal Prospect : <?= date_indo($tanggal_selected); ?></h3>
	</center>
 
	<table border="1">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>No Mesin</th>
            <th>No Telepon</th>
            <th>Pesan</th>
            <th>Type</th>
            <th>Sender</th>
            <th>Status</th>                  
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($data as $key) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= date_indo($key['tanggal']); ?></td>
            <td><?= $key['no_mesin']; ?></td>
            <td><?= $key['untuk']; ?></td>
            <td><?= $key['pesan']; ?></td>
            <td><?= $key['type']; ?></td>
            <td><?= $key['sender']; ?></td>
            <td><?= $key['status']; ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
	</table>