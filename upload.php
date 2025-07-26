
<!DOCTYPE html>
<html>
<head>
    <title>Upload Berita</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Upload Artikel Berita</h2>
    <form action="proses_upload.php" method="post" enctype="multipart/form-data">
        <label>Judul:</label><br>
        <input type="text" name="judul" required><br><br>

        <label>Isi:</label><br>
        <textarea name="isi" rows="6" required></textarea><br><br>

        <label>Gambar:</label><br>
        <input type="file" name="gambar" accept="image/*"><br><br>

        <input type="submit" value="Upload">
    </form>
</body>
</html>
