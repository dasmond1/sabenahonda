<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
    <br>
    <form action="<?= base_url('fetadia/index'); ?>" method="POST">
        <p><label for="tt">Colok Kode TT dulu sayang</label></p>
        <small>Misal : tt13355988</small>
        <br>
        <br>
        <input type="text" name="text" required>
        <br>
        <br>
        <input type="submit" name="search" value="Enter Sayang">
        <br>
        <br>
    </form>
    </center>

    <?php if($result): ?>
    <center>
    <table width="100%" border="1">
        <tr>
            <th>Judul</th>
            <th>Tahun</th>
            <th>Genre</th>
            <th>Aksi</th>
        </tr>
        <tr>
            <td><?= $result['Title']; ?></td>
            <td><?= $result['Year']; ?></td>
            <td><?= $result['Genre']; ?></td>
            <td><a href="<?= base_url('fetadia/nonton/'); ?><?= $result['imdbID']; ?>" target="_blank">Nonton Skuy !!</a></td>
             
        </tr>
    </table>
    </center>
    <?php else: ?>
    <center>
    <p>No Data</p>
    </center>
    <?php endif; ?>
</body>
</html>