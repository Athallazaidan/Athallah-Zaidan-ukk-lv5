<?php

include 'fungsi.php';

// Cek login
requireLogin();


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

        

        
    </div>
</body>

</html>