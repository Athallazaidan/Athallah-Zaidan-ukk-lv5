<?php

include 'fungsi.php';

// Cek login
requireLogin();

// Cek akses superadmin
if (!isAdmin()) {
    echo "Anda tidak memiliki akses ke halaman ini.";
    exit();
}

// Proses simpan data user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $fullname = $_POST['nama_lengkap'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['level'];

    $stmt = $koneksi->prepare("INSERT INTO tbl_user (username, nama_lengkap, password, level) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $fullname, $password, $role);
    $stmt->execute();

    header("Location: users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form User</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div>
        <h2>Tambah User</h2>
        <form method="post">
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Full Name</label>
            <input type="text" name="nama_lengkap" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Role</label>
            <select name="level" required>
                <option value="admin">Admin</option>
                <option value="petugas">petugas</option>
            </select>

            <div style="display: flex; gap: 10px; align-items: center;">
                <button type="submit">Simpan</button>
                <a href="users.php">Batal</a>
            </div>
        </form>
    </div>
</body>

</html>
