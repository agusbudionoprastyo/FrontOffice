<?php
// Set header untuk SSE
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

// Buat koneksi ke database atau include file koneksi
require_once '../helper/connection.php';

// Query awal untuk mendapatkan data
$sql = "SELECT * FROM FOGUEST ORDER BY folio DESC";

// Function untuk mengirim data ke client
function sendSSE($id, $data) {
    echo "id: $id\n";
    echo "data: $data\n\n";
    ob_flush();
    flush();
}

// Loop untuk mengirim data secara berkala
while (true) {
    // Eksekusi query
    $result = mysqli_query($connection, $sql);

    // Jika query berhasil
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Kirim data ke client dalam format JSON
            sendSSE($row['folio'], json_encode($row));

            // Pause sejenak untuk simulasi polling
            sleep(1); // Sesuaikan sesuai kebutuhan, tidak perlu dalam produksi yang sebenarnya
        }
    } else {
        sendSSE(time(), json_encode(['error' => 'No data found']));
    }

    // Reset koneksi jika perlu
    if (connection_status() != CONNECTION_NORMAL) {
        break;
    }

    // Bersihkan hasil query
    mysqli_free_result($result);
}

// Tutup koneksi database
mysqli_close($connection);
?>
