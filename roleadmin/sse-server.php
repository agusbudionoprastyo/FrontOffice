<?php
// Set header untuk SSE
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

// Buat koneksi ke database atau include file koneksi
require_once '../helper/connection.php';

// Function untuk mengirim data ke client
function sendSSE($data) {
    echo "data: " . json_encode($data) . "\n\n";
    ob_flush();
    flush();
}

// Function untuk query data dari database
function fetchData() {
    global $connection;
    $sql = "SELECT * FROM FOGUEST ORDER BY folio DESC";
    $result = mysqli_query($connection, $sql);
    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    mysqli_free_result($result);
    return $data;
}

// Loop untuk mengirim data secara berkala
while (true) {
    $data = fetchData();
    sendSSE($data);
    sleep(1); // Pause sejenak untuk simulasi polling, bisa disesuaikan
}
?>