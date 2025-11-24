<?php
include 'fungsi.php';

if(isLoggedIn()){
    header('Location: index.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = $koneksi->query("SELECT * FROM tbl_user WHERE username = '$username'")->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id']= $user['id_user'];
        $_SESSION['user_level']= $user['level'];
        header('Location: index.php');
        exit();
    
}
$error='login gagal';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style="margin-top: 100px;">
        <h2 style="text-align: center; margin-bottom: 15px;">LOGIN</h2>

        <?php if (isset($error)) echo "<p style='color:red; text-align:center; margin-bottom: 15px;'>$error</p>"; ?>

        <form method="post">
            <label>Username</label>
            <input type="text" name="username" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>