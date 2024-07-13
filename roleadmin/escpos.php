<?php
require __DIR__ . '/../vendor/autoload.php';

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

// Tangkap nilai folio dari permintaan POST
$folio = $_POST['folio'] ?? '';

if ($folio != '') {
    try {
        // Buat koneksi ke printer ESC/POS
        $connector = new WindowsPrintConnector("Q300_Printer"); // Ganti dengan nama printer yang sesuai
        $printer = new Printer($connector);

        // Set ukuran kertas (contoh untuk ukuran 50mm x 25mm)
        $printer->initialize();
        $printer->setPrintWidth(384);  // 50mm dihitung dalam titik (dot), biasanya 1 mm = 8 titik
        $printer->setPageFormat(50, 25);

        // Cetak folio
        $printer->text("Folio: " . $folio . "\n");

        // Jangan lupa untuk memotong kertas (opsional)
        $printer->cut();

        // Bersihkan buffer dan tutup printer
        $printer->close();

        echo "Printing successful"; // Respon ke client bahwa pencetakan berhasil
    } catch (Exception $e) {
        // Tampilkan pesan error yang lebih detail
        echo "Printing failed: " . $e->getMessage() . "\n";
        echo "Trace: " . $e->getTraceAsString();
    }
} else {
    echo "Invalid folio"; // Respon ke client jika nilai folio tidak valid
}
?>