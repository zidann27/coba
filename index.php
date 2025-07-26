
<?php include 'config/db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Berita Hari Ini</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Berita Terbaru</h1>
    <a href="upload.php">+ Tambah Berita</a>
    <hr>
    <?php
    $result = $conn->query("SELECT * FROM berita ORDER BY tanggal DESC");
    while ($row = $result->fetch_assoc()) {
        echo "<div class='berita'>";
        echo "<h2>{$row['judul']}</h2>";
        echo "<img src='uploads/{$row['gambar']}' width='300'><br>";
        echo "<p>{$row['isi']}</p>";
        echo "<small>Diposting: {$row['tanggal']}</small>";
        echo "<hr></div>";
    }
    ?>
</body>
</html>
