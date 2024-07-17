<?php
// Set header untuk SSE
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

// Contoh koneksi ke database
require_once '../helper/connection.php';

// Query untuk mengambil data terbaru dari database
$sql = "SELECT * FROM FOGUEST ORDER BY datecreate DESC LIMIT 10"; // Misalnya ambil 10 data terbaru
$result = mysqli_query($connection, $sql);

// Mulai mengirimkan data sebagai SSE
while ($row = mysqli_fetch_array($result)) {
    $data = json_encode($row); // Mengubah data menjadi format JSON
    echo "data: $data\n\n"; // Mengirim data sebagai pesan SSE
    ob_flush(); // Memastikan pesan SSE segera dikirim ke klien
    flush();
}