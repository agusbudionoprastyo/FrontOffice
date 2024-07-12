<?php
// Include file PHP QR Code
include 'phpqrcode/qrlib.php';

// Pastikan folio ada dalam POST request
if (!isset($_POST['folio'])) {
    die('Folio tidak tersedia.');
}

// Ambil nilai 'folio' dari permintaan POST
$folio = $_POST['folio'];

// Data yang akan disematkan di QR Code (contoh URL atau teks)
$data = 'https://example.com/' . $folio;

// Teks tambahan yang ingin Anda cetak di bawah QR Code
$additional_text = 'Ini adalah teks tambahan';

// Nama file tempat menyimpan QR Code (dalam format PNG)
$filename = 'qrcode_with_text.png';

// Konfigurasi QR Code (Ukuran, Level Error Correction, dll)
$size = 5;  // Ukuran pixel per modul QR Code
$level = 'H'; // Level error correction (L, M, Q, H)

// Membuat QR Code
QRcode::png($data, $filename, $level, $size);

// Membuat gambar baru dengan teks tambahan di bawah QR Code
$image = imagecreatefrompng($filename);

if (!$image) {
    die('Gagal membuat gambar dari QR Code.');
}

// Warna teks (hitam)
$text_color = imagecolorallocate($image, 0, 0, 0);

// Font untuk teks tambahan (misalnya Arial)
$font = 'assets/fonts/nunito-v9-latin-regular.ttf'; // Sesuaikan dengan path font yang sesuai di sistem Anda

// Periksa apakah font tersedia
if (!file_exists($font)) {
    die('File font tidak ditemukan.');
}

// Ukuran font teks tambahan
$font_size = 8;

// Koordinat untuk teks tambahan (dibuat agar berada di bawah QR Code)
$text_x = ($size * 4) + 10; // Sesuaikan dengan jarak yang diinginkan dari QR Code
$text_y = $size * 4 + 40; // Sesuaikan dengan jarak yang diinginkan dari QR Code

// Menambahkan teks tambahan ke gambar
imagettftext($image, $font_size, 0, $text_x, $text_y, $text_color, $font, $additional_text);

// Menyimpan gambar yang telah diubah dengan teks tambahan
if (!imagepng($image, $filename)) {
    die('Gagal menyimpan gambar QR Code.');
}

// Hapus gambar sementara dari memori
imagedestroy($image);

// Hapus file QR Code setelah dicetak (opsional)
unlink($filename);
?>