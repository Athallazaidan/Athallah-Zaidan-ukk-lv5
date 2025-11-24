<?php

include 'fungsi.php';

// Cek login
requireLogin();

$id = $_GET['id'] ?? null;
$data = null;

// Jika ada ID, ambil data barang untuk diedit
if ($id) {
    $data = $koneksi->query("SELECT * FROM tbl_barang WHERE id_barang = $id")->fetch_assoc();
}

// Proses simpan data (Tambah/Edit)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_barang = $_POST['kode_barang'];
    $nama = $_POST['nama_barang'];
    $jumlah_tersedia = $_POST['jumlah_tersedia'];
    $satuan = $_POST['satuan'];

    if ($id && $data) {
        // Update data barang
        $stmt = $koneksi->prepare("UPDATE tbl_barang SET kode_barang=?, nama_barang=?, jumlah_tersedia=?, satuan=? WHERE id_barang=?");
        $stmt->bind_param("ssisi", $kode_barang, $nama, $jumlah_tersedia, $satuan, $id);
    } else {
        // Insert data barang baru
        $stmt = $koneksi->prepare("INSERT INTO tbl_barang (kode_barang, nama_barang, jumlah_tersedia, satuan) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $kode_barang, $nama, $jumlah_tersedia, $satuan);
    }

    $stmt->execute();
    header("Location: barang.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Barang</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div>
        <h2><?= $id ? 'Edit' : 'Tambah' ?> Barang</h2>
        <form method="post">
            <label>kode barang</label>
            <input type="text" name="kode_barang" value="<?= $data['kode_barang'] ?? '' ?>" required>
            
            <label>nama</label>
            <input type="text" name="nama_barang" value="<?= $data['nama_barang'] ?? '' ?>" required>

            
            <label>jumlah_tersedia</label>
            <input type="number" name="jumlah_tersedia" value="<?= $data['jumlah_tersedia'] ?? '' ?>" required>

            <label>satuan</label>
            <input type="text" name="satuan" value="<?= $data['satuan'] ?? '' ?>" required>

            <div style="display: flex; gap: 10px; align-items: center;">
                <button type="submit">Simpan</button>
                <a href="barang.php">Batal</a>
            </div>
        </form>
    </div>
</body>

</html>