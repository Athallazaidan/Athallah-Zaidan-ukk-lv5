<?php

include 'fungsi.php';

// Cek login
requireLogin();
// Handle Delete jika ada parameter delete_id
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $koneksi->query("DELETE FROM tbl_barang WHERE id_barang = $id");
    header("Location: barang.php");
    exit();
}

// Ambil semua data barang
$items = $koneksi->query("SELECT * FROM tbl_barang")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Barang</title>
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

        <div style="display: flex; justify-content: space-between; margin: 20px 0;">
            <h2>Daftar Barang</h2>
            <a href="form_barang.php">+ Tambah Barang</a>
        </div>

        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>kode barang</th>
                    <th>nama</th>
                    <th>Stok</th>
                    <th>satuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= $item['kode_barang'] ?></td>
                        <td><?= $item['nama_barang'] ?></td>
                        <td><?= $item['jumlah_tersedia'] ?></td>
                        <td><?= $item['satuan'] ?></td>
                        
                        <td>
                            <a href="form_barang.php?id=<?= $item['id_barang'] ?>">Edit</a> |
                           
                            <a href="barang.php?delete_id=<?= $item['id_barang'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>