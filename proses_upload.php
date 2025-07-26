<?php
include 'config/db.php';

$judul = $_POST['judul'];
$isi   = $_POST['isi'];

$gambar = $_FILES['gambar']['name'];
$tmp    = $_FILES['gambar']['tmp_name'];
$path   = "uploads/" . $gambar;

// Buat folder uploads jika belum ada
if (!file_exists("uploads")) {
    mkdir("uploads", 0777, true);
}

// Validasi ekstensi file
$ext = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));
$allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

if (!in_array($ext, $allowed)) {
    die("Ekstensi file tidak diperbolehkan.");
}

// Upload file
if (move_uploaded_file($tmp, $path)) {
    $sql = "INSERT INTO berita (judul, isi, gambar) VALUES ('$judul', '$isi', '$gambar')";
    if ($conn->query($sql) === TRUE) {
        echo "Berhasil diupload. <a href='index.php'>Lihat Berita</a>";
    } else {
        echo "Gagal menyimpan ke database.";
    }
} else {
    echo "Gagal upload gambar.";
}
?>
