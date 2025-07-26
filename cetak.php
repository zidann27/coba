<?php
require '../vendor/autoload.php'; // Dompdf via Composer

use Dompdf\Dompdf;

session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['users']) || $_SESSION['users']['level'] != 'client') {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
$id_user = $_SESSION['users']['id'];

// Ambil data booking
$q = mysqli_query($koneksi, "SELECT b.*, g.nama_gunung, g.jalur, u.nama_lengkap
    FROM booking b 
    JOIN gunung g ON b.id_gunung = g.id 
    JOIN users u ON b.id_user = u.id 
    WHERE b.id = '$id' AND b.id_user = '$id_user' AND b.status = 'valid'");
$data = mysqli_fetch_array($q);

if (!$data) {
    echo "Data tidak ditemukan atau belum divalidasi.";
    exit;
}

// HTML untuk PDF
$html = '
<style>
  body { font-family: sans-serif; font-size: 14px; }
  h2 { text-align: center; }
  table { width: 100%; margin-top: 20px; border-collapse: collapse; }
  td, th { padding: 8px; border: 1px solid #000; }
</style>
<h2>Bukti Booking Pendakian</h2>
<table>
  <tr><th>Nama Pengguna</th><td>' . $data['nama_lengkap'] . '</td></tr>
  <tr><th>Gunung</th><td>' . $data['nama_gunung'] . '</td></tr>
  <tr><th>Jalur</th><td>' . $data['jalur'] . '</td></tr>
  <tr><th>Tanggal Naik</th><td>' . date('d M Y', strtotime($data['tanggal_naik'])) . '</td></tr>
  <tr><th>Jumlah Hari</th><td>' . $data['jumlah_hari'] . ' hari</td></tr>
  <tr><th>Total Biaya</th><td>Rp ' . number_format($data['total_biaya']) . '</td></tr>
  <tr><th>Status</th><td><strong>Valid</strong></td></tr>
</table>
<p style="margin-top:40px;">Tanggal Cetak: ' . date('d M Y') . '</p>
';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A5', 'portrait');
$dompdf->render();
$dompdf->stream("bukti_booking_{$data['id']}.pdf", ["Attachment" => false]);
