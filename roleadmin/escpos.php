<?php
require __DIR__ . '/../vendor/autoload.php';

use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

// Tetapkan nilai folio secara langsung sebagai string
$folio = "123456"; // Ganti dengan nilai folio yang diinginkan

if ($folio !== '') {
    try {
        // Buat koneksi ke printer virtual (file)
        $connector = new FilePrintConnector("php://stdout"); // Ganti dengan path file yang sesuai jika ingin menyimpan ke file
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