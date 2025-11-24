<?php

include 'koneksi.php';
include 'fungsi.php';

// Cek login
requireLogin();

// Ambil data transaksi digabung dengan data barang
$transaksi = $koneksi->query("SELECT * FROM tbl_transaksi")->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div>
        <nav style="display: flex; gap: 15px;">
            <a href="index.php">🏠Home</a>
            <a href="barang.php">📦Barang</a>
            <a href="transaksi.php">📝Transaksi</a>
            <?php if (isAdmin()): ?>
                <a href="users.php">👥Users</a>
            <?php endif; ?>
            <a href="logout.php" style="color: red;">🚪Logout</a>
        </nav>


        <h2 style="margin: 20px 0;">Riwayat Transaksi</h2>

        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>waktu</th>
                    
                    <th>jenis</th>
                    <th>jumlah</th>

                    <th>keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transaksi as $t) : ?>
                    <tr>
                        <td><?= $t['tgl_transaksi'] ?></td>
                        <td><?= $t['jenis_transaksi'] ?></td>
                        <td><?= $t['jumlah'] ?></td>
                        <td><?= $t['keterangan'] ?></td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>