<?php
// Koneksi ke database
$databaseFile = 'godgame.txt';

if (isset($_POST['create'])) {
    // Proses untuk create username dan password
    $username = $_POST['username'];
    $password = $_POST['password'];
    file_put_contents($databaseFile, "$username:$password\n", FILE_APPEND);
} elseif (isset($_POST['delete'])) {
    // Menampilkan form untuk konfirmasi penghapusan
    echo '<form action="process.php" method="post">';
    echo '<input type="hidden" name="usernameToDelete" value="' . $_POST['username'] . '">';
    echo '<button type="submit" name="confirmDelete">Confirm Delete</button>';
    echo '</form>';
} elseif (isset($_POST['confirmDelete'])) {
    // Proses untuk menghapus username dan password
    $usernameToDelete = $_POST['usernameToDelete'];
    $data = file($databaseFile);
    $out = array();
    foreach ($data as $line) {
        if (strpos($line, $usernameToDelete . ':') !== 0) {
            $out[] = $line;
        }
    }
    file_put_contents($databaseFile, $out);
} elseif (isset($_POST['check'])) {
    // Proses untuk check username dan password
    $usernameToCheck = $_POST['username'];
    $passwordToCheck = $_POST['password'];
    $data = file($databaseFile);
    $match = false;
    foreach ($data as $line) {
        list($username, $password) = explode(':', $line, 2);
        if ($username === $usernameToCheck && $password === $passwordToCheck . "\n") {
            $match = true;
            break;
        }
    }
    if ($match) {
        echo "User Found";
    } else {
        echo "User Not Found";
    }
} elseif (isset($_POST['random'])) {
    // Proses untuk membuat random manual
    // ...
}

// Redirect kembali ke halaman utama
header("Location: index.html");
exit();
?>