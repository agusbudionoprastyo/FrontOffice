<?php
require_once '../helper/connection.php';
require __DIR__ . '/../vendor/autoload.php';

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

try {
    $connector = new WindowsPrintConnector("Q300 Printer");
    $printer = new Printer($connector);

    // Set ukuran kertas (contoh untuk ukuran 50mm x 25mm)
    $printer->initialize();
    $printer->setPrintWidth(384);  // 50mm dihitung dalam titik (dot), biasanya 1 mm = 8 titik
    $printer->setPageFormat(50, 25);

    // Cetak teks
    $printer->text("Hello, ESC/POS Printer!\n");

    // Jangan lupa untuk memotong kertas (opsional)
    $printer->cut();

    // Operasi cleaning untuk membersihkan buffer dan memastikan pencetakan selesai
    $printer->close();
} catch (Exception $e) {
    echo "Printing failed: " . $e->getMessage() . "\n";
}
?>
