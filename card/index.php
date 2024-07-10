<?php
require_once 'koneksi.php';
$folio = $_GET['folio'];
$query = mysqli_query($conn, "SELECT * FROM FOGUEST WHERE folio='$folio'");
$data = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" href="assets/img/favicon.png" type="image/png">

        <!--=============== REMIXICONS ===============-->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        
        <!--=============== SWIPER CSS ===============-->
        <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">

        <!--=============== CSS ===============-->
        <link rel="stylesheet" href="assets/css/styles.css">

        <!-- ========= font-awesome ========= -->
        <script src="https://kit.fontawesome.com/3595b79eb9.js" crossorigin="anonymous"></script>

        <!--========= FLIPBOOK  =========-->
        <link rel="stylesheet" type="text/css" href="assets/css/flipbook.style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
        <script src="assets/js/flipbook/flipbook.min.js"></script>

        <!-- ========== ACCORDION ========== -->
        <!-- <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script> -->
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&display=swap" rel="stylesheet"> 
        <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

        <title><?= $data['nama'] ?></title>

        <style>
            .rounded {
                border-radius: 25px; /* Menambahkan sudut bulat dengan radius 10px */
                background-color: rgba(255, 255, 255, 0.9); /* Warna latar belakang dengan transparansi */
            }
        </style>
    </head>
    <body>

    <!-- Di dalam elemen <head> -->
<script>
    function checkRoomStatus() {
        // Ganti dengan logika sesuai dengan data ruangan Anda
        const roomIsEmpty = true; // Misalnya, jika ruangan kosong, setel ke true

        const button = document.querySelector('.button3');
        if (roomIsEmpty) {
            button.classList.add('disabled');
            button.setAttribute('disabled', 'true');
        } else {
            button.classList.remove('disabled');
            button.removeAttribute('disabled');
        }
    }
</script>

        <header class="header" id="header">
            <nav class="nav container">
                <div class="nav__logo">
                    <svg id="logo-svg" viewBox="0 0 174.756 29.041" width="1000pt" height="166.18pt" xmlns="http://www.w3.org/2000/svg" class="logo-svg">
                <g transform="matrix(0.01743599958717823, 0, 0, -0.017454000189900398, 0, 29.14856910705567)" fill="#000000" stroke="none" style="">
                    <path d="M80 1652 c-22 -12 -44 -35 -57 -62 l-23 -44 0 -658 c0 -362 2 -658 5 -658 3 0 23 9 43 19 51 26 98 75 130 136 l27 50 5 498 c5 479 6 499 24 513 16 12 96 14 461 14 415 0 443 -1 458 -18 15 -17 17 -74 17 -608 0 -494 -2 -593 -14 -610 -14 -18 -31 -19 -375 -22 l-360 -3 122 123 c276 276 420 536 421 753 0 135 -52 218 -168 271 -53 24 -75 28 -166 30 -96 2 -100 2 -39 -6 123 -15 209 -71 245 -156 19 -45 18 -158 -2 -225 -75 -257 -391 -569 -752 -744 -80 -38 -82 -40 -82 -75 0 -57 18 -104 51 -136 l30 -29 597 -3 c670 -3 644 -6 683 70 18 36 19 67 19 760 0 806 3 767 -69 815 l-34 23 -581 0 c-543 0 -584 -1 -616 -18z"/>
                    <path d="M3070 1463 c-7 -16 -75 -174 -152 -352 -172 -401 -169 -396 -210 -412 l-33 -13 58 -4 c31 -1 83 -2 115 0 56 3 57 3 27 16 -57 25 -58 47 -9 165 l37 87 159 -2 159 -3 35 -80 c19 -44 36 -92 36 -107 1 -33 -18 -58 -43 -58 -11 0 -19 -4 -19 -10 0 -6 52 -10 135 -10 74 0 135 2 135 6 0 3 -13 9 -28 15 -38 13 -44 25 -222 437 -84 193 -156 352 -160 352 -4 0 -13 -12 -20 -27z m58 -306 c34 -79 62 -146 62 -150 0 -4 -59 -7 -131 -7 -121 0 -131 1 -125 18 24 63 122 282 127 282 3 0 33 -64 67 -143z"/>
                    <path d="M4497 1419 c-19 -41 -91 -208 -162 -372 -70 -164 -137 -309 -147 -323 -11 -13 -28 -24 -39 -24 -10 0 -19 -4 -19 -10 0 -6 42 -10 106 -10 67 0 103 4 99 10 -3 6 -13 10 -20 10 -8 0 -22 11 -31 25 -18 28 -13 51 37 163 l28 62 156 0 156 0 35 -77 c46 -101 51 -128 29 -153 -10 -11 -24 -20 -31 -20 -7 0 -16 -4 -19 -10 -4 -6 42 -10 129 -10 84 0 136 4 136 10 0 6 -8 10 -18 10 -11 0 -27 9 -36 19 -10 11 -90 185 -178 388 -88 202 -164 372 -169 377 -5 6 -22 -20 -42 -65z m76 -264 l65 -150 -63 -3 c-35 -2 -95 -2 -133 0 l-69 3 65 153 c36 83 66 151 68 150 1 -2 31 -70 67 -153z"/>
                    <path d="M7139 1443 c-12 -27 -84 -194 -161 -373 -77 -179 -147 -333 -156 -344 -9 -10 -28 -23 -42 -29 -23 -11 -19 -12 33 -15 31 -2 83 -2 115 0 l57 3 -37 17 c-33 15 -38 21 -38 51 0 18 15 69 34 113 l35 79 159 3 159 2 37 -87 c49 -118 48 -140 -9 -165 -29 -12 -27 -13 43 -16 39 -2 105 -2 145 0 l72 3 -40 20 c-39 20 -41 23 -205 403 -90 210 -168 382 -173 382 -4 0 -17 -21 -28 -47z m65 -282 c32 -73 60 -139 63 -147 4 -12 -18 -14 -130 -14 l-135 0 66 154 c37 85 70 151 73 148 3 -4 31 -67 63 -141z"/>
                    <path d="M1883 1454 c4 -4 17 -12 29 -18 42 -21 47 -62 47 -366 0 -315 -5 -345 -54 -370 -28 -14 -16 -15 174 -18 271 -3 349 17 448 115 154 154 125 474 -54 593 -90 59 -150 70 -386 70 -116 0 -207 -3 -204 -6z m366 -44 c81 -14 130 -39 175 -91 53 -63 71 -125 71 -249 0 -127 -18 -188 -76 -254 -53 -60 -122 -86 -227 -86 -93 0 -111 10 -123 71 -10 52 -12 603 -2 612 10 10 110 8 182 -3z"/>
                    <path d="M3574 1445 c11 -8 23 -15 26 -15 4 0 12 -11 18 -25 16 -36 17 -634 1 -669 -7 -14 -26 -31 -43 -38 -30 -12 -28 -13 42 -16 40 -1 103 -2 140 0 63 3 65 4 39 16 -46 20 -57 63 -57 227 l0 145 68 -1 c88 0 133 -16 152 -54 15 -29 15 -27 20 70 3 55 3 104 1 108 -2 5 -12 -5 -22 -22 -25 -41 -54 -51 -145 -51 l-75 0 3 148 3 147 80 3 c44 2 114 0 155 -3 67 -6 77 -10 108 -41 46 -46 56 -44 48 12 -3 26 -6 53 -6 60 0 12 -52 14 -287 14 -255 -1 -286 -2 -269 -15z"/>
                    <path d="M5003 1454 c4 -4 17 -12 29 -18 42 -21 47 -62 47 -366 0 -315 -5 -345 -54 -370 l-30 -15 52 -3 c29 -2 78 -2 110 0 53 3 56 4 33 15 -55 24 -55 24 -57 332 -3 247 -1 282 11 256 7 -16 71 -163 141 -325 70 -162 131 -299 135 -303 4 -4 11 -2 17 5 5 7 68 148 139 313 149 347 138 348 132 -5 -3 -231 -7 -251 -56 -273 -25 -11 -21 -12 41 -15 37 -2 97 -2 135 0 l67 3 -31 17 c-17 10 -35 25 -40 35 -5 10 -10 151 -12 313 -4 331 1 364 53 390 30 15 29 15 -49 18 -44 2 -82 -1 -87 -5 -4 -4 -67 -147 -140 -317 -130 -300 -133 -308 -146 -280 -8 16 -69 157 -137 314 l-123 285 -94 3 c-51 1 -90 0 -86 -4z"/>
                    <path d="M6074 1445 c11 -8 23 -15 26 -15 24 0 30 -67 30 -360 0 -328 -3 -355 -47 -366 -70 -18 7 -24 297 -24 l320 0 0 65 c0 64 -12 85 -25 44 -4 -11 -21 -29 -38 -40 -28 -17 -52 -19 -188 -19 -139 0 -159 2 -180 19 l-24 19 -3 295 c-3 324 1 357 53 377 14 5 25 12 25 15 0 3 -60 5 -132 5 -119 -1 -131 -2 -114 -15z"/>
                    <path d="M7633 1454 c4 -4 17 -12 29 -18 44 -22 49 -68 46 -386 -3 -317 -5 -330 -56 -353 -26 -11 -24 -12 25 -15 29 -2 78 -2 110 0 l58 3 -30 15 c-53 27 -56 43 -53 336 l3 267 264 -326 c145 -180 269 -327 277 -327 12 0 14 59 14 355 0 387 4 415 55 435 14 5 25 12 25 15 0 3 -48 5 -107 5 l-108 0 33 -20 c18 -11 37 -32 42 -46 6 -16 9 -131 8 -286 l-3 -259 -245 305 -245 306 -74 0 c-41 0 -71 -3 -68 -6z"/>
                    <path d="M8473 1454 c4 -4 17 -12 29 -18 44 -22 49 -68 46 -386 -3 -317 -5 -330 -56 -353 -46 -20 363 -22 442 -2 113 29 200 97 242 190 84 183 33 407 -113 505 -90 59 -150 70 -386 70 -116 0 -207 -3 -204 -6z m366 -44 c81 -14 130 -39 175 -91 53 -63 71 -125 71 -249 0 -135 -20 -196 -84 -260 -58 -58 -118 -80 -221 -80 -89 0 -107 10 -120 65 -11 45 -14 608 -3 618 10 10 110 8 182 -3z"/>
                    <path d="M872 707 c-70 -136 -164 -260 -291 -385 l-104 -103 84 3 84 3 53 70 c70 94 164 281 202 405 18 56 30 103 28 105 -1 2 -27 -42 -56 -98z"/>
                    <path d="M9540 330 c0 -121 1 -130 19 -130 11 0 21 6 24 13 4 10 7 10 18 0 29 -28 83 -13 104 28 34 65 2 139 -59 139 -17 0 -37 -5 -44 -12 -9 -9 -12 0 -12 40 0 49 -2 52 -25 52 l-25 0 0 -130z m108 -2 c26 -26 8 -88 -25 -88 -23 0 -38 46 -25 75 13 27 31 32 50 13z"/>
                    <path d="M9827 453 c-4 -3 -7 -62 -7 -130 l0 -123 30 0 c28 0 30 3 30 35 0 44 10 44 34 0 16 -29 25 -35 53 -35 38 0 37 5 -11 69 -27 37 -27 37 18 89 l19 22 -34 0 c-28 0 -38 -6 -54 -32 l-20 -33 -3 73 c-3 68 -4 72 -26 72 -12 0 -26 -3 -29 -7z"/>
                    <path d="M1923 443 c-22 -4 -23 -8 -23 -124 l0 -119 30 0 c29 0 30 2 30 45 0 44 0 45 34 45 70 0 109 73 64 123 -24 28 -85 41 -135 30z m94 -59 c8 -22 -9 -48 -36 -52 -18 -3 -21 1 -21 32 0 32 3 36 25 36 15 0 28 -7 32 -16z"/>
                    <path d="M2617 443 l-28 -4 3 -117 3 -117 45 -3 c96 -7 159 34 167 110 4 49 -10 82 -47 109 -26 20 -95 30 -143 22z m113 -63 c25 -25 26 -80 3 -109 -10 -11 -33 -24 -50 -27 l-33 -6 0 81 0 81 30 0 c17 0 39 -9 50 -20z"/>
                    <path d="M4293 443 c-22 -4 -23 -8 -23 -124 l0 -119 25 0 c23 0 25 4 25 45 0 44 0 45 34 45 94 0 122 119 35 149 -32 11 -55 12 -96 4z m92 -63 c9 -27 -11 -50 -41 -50 -21 0 -24 5 -24 35 0 32 2 35 29 35 21 0 32 -6 36 -20z"/>
                    <path d="M4563 443 c-22 -4 -23 -8 -23 -124 l0 -119 30 0 c29 0 30 1 30 50 0 37 4 50 14 50 18 0 28 -14 41 -60 8 -28 16 -36 39 -38 27 -3 28 -2 21 30 -4 18 -13 45 -20 60 -8 18 -10 30 -4 34 6 3 14 17 19 30 25 64 -48 106 -147 87z m92 -73 c0 -20 -6 -26 -27 -28 -25 -3 -28 0 -28 28 0 28 3 31 28 28 21 -2 27 -8 27 -28z"/>
                    <path d="M4890 443 c-32 -12 -70 -58 -76 -91 -4 -19 -1 -51 5 -72 16 -53 52 -80 108 -80 38 0 50 5 79 34 31 31 34 40 34 90 0 47 -4 61 -27 86 -28 31 -88 47 -123 33z m80 -62 c5 -11 10 -40 10 -65 0 -37 -4 -48 -25 -62 -30 -20 -58 -11 -73 22 -28 60 -3 124 48 124 19 0 33 -7 40 -19z"/>
                    <path d="M5173 443 c-22 -4 -23 -8 -23 -124 l0 -119 24 0 c22 0 25 5 28 42 3 41 5 43 40 49 21 3 47 14 58 24 26 24 27 85 2 108 -19 18 -91 29 -129 20z m92 -63 c8 -27 -12 -52 -39 -48 -16 2 -22 11 -24 36 -3 30 -1 32 27 32 21 0 32 -6 36 -20z"/>
                    <path d="M5713 443 c-22 -4 -23 -8 -23 -124 l0 -119 25 0 c23 0 25 3 25 50 0 33 4 50 13 50 23 0 35 -15 46 -57 11 -39 15 -43 42 -43 24 0 30 3 25 16 -3 9 -9 28 -12 42 -4 15 -13 34 -20 43 -11 13 -10 18 6 32 25 21 26 69 2 90 -19 18 -91 29 -129 20z m90 -55 c8 -22 -13 -48 -38 -48 -21 0 -25 5 -25 30 0 26 3 30 29 30 16 0 31 -6 34 -12z"/>
                    <path d="M7193 443 c-22 -4 -23 -8 -23 -125 l0 -121 68 5 c37 3 77 11 89 18 70 44 71 170 1 206 -31 16 -101 25 -135 17z m107 -63 c43 -43 14 -129 -45 -133 l-30 -2 -3 78 -3 77 31 0 c17 0 39 -9 50 -20z"/>
                    <path d="M7533 430 c-41 -25 -53 -48 -53 -104 0 -58 17 -94 51 -112 110 -56 218 57 163 171 -16 35 -65 65 -106 65 -12 0 -37 -9 -55 -20z m101 -52 c24 -33 20 -82 -8 -115 -24 -27 -26 -27 -52 -13 -37 20 -49 68 -30 115 12 29 20 35 45 35 20 0 35 -8 45 -22z"/>
                    <path d="M8435 441 c-33 -14 -47 -37 -43 -73 3 -28 10 -37 50 -58 50 -26 62 -54 29 -65 -10 -3 -30 -1 -45 5 -35 13 -33 14 -38 -14 -6 -30 6 -36 68 -36 34 0 51 6 69 25 45 44 32 86 -37 121 -57 29 -58 49 -2 49 29 0 41 5 47 19 4 10 5 21 3 23 -9 10 -82 12 -101 4z"/>
                    <path d="M2170 420 c0 -16 7 -20 30 -20 l30 0 0 -100 0 -100 30 0 30 0 0 100 0 100 30 0 c23 0 30 4 30 20 0 19 -7 20 -90 20 -83 0 -90 -1 -90 -20z"/>
                    <path d="M2955 428 c-17 -53 -65 -214 -65 -220 0 -4 11 -8 26 -8 19 0 28 7 35 30 9 25 16 30 44 30 28 0 35 -5 44 -30 8 -24 16 -30 39 -30 l30 0 -37 120 -36 120 -38 0 c-21 0 -39 -5 -42 -12z m64 -110 c1 -5 -11 -8 -25 -8 -20 0 -25 4 -20 16 3 9 9 28 13 42 l6 27 13 -35 c7 -19 13 -38 13 -42z"/>
                    <path d="M3208 320 c3 -120 3 -120 28 -120 22 0 24 4 24 50 l0 50 45 0 c38 0 45 3 45 20 0 17 -7 20 -45 20 -43 0 -45 1 -45 30 0 29 2 30 45 30 38 0 45 3 45 20 0 18 -7 20 -72 20 l-73 0 3 -120z"/>
                    <path d="M3496 423 c-17 -60 -59 -200 -63 -210 -4 -9 5 -13 25 -13 26 0 31 5 37 30 6 27 11 30 45 30 34 0 38 -3 44 -30 5 -26 10 -30 36 -30 25 0 30 3 26 18 -35 111 -66 215 -66 218 0 2 -18 4 -39 4 -29 0 -41 -5 -45 -17z m64 -100 c0 -7 -11 -13 -24 -13 -22 0 -23 1 -12 41 l11 41 12 -28 c7 -16 12 -35 13 -41z"/>
                    <path d="M3756 363 c-3 -42 -6 -96 -6 -120 0 -39 2 -43 25 -43 25 0 25 1 25 88 1 95 7 94 35 -10 15 -60 20 -68 41 -68 21 0 26 9 46 78 l23 77 7 -40 c4 -22 7 -59 7 -82 1 -39 3 -43 26 -43 24 0 25 3 25 59 0 32 -3 86 -6 120 l-7 61 -36 0 -37 0 -19 -70 c-11 -38 -22 -70 -25 -70 -3 0 -14 32 -24 70 l-18 70 -37 0 -38 0 -7 -77z"/>
                    <path d="M5420 320 l0 -120 80 0 c79 0 80 0 80 25 0 23 -3 25 -50 25 -46 0 -50 2 -50 24 0 22 5 25 43 28 35 2 43 7 45 26 3 20 -1 22 -42 22 -42 0 -46 2 -46 25 0 23 4 25 45 25 38 0 45 3 45 20 0 18 -7 20 -75 20 l-75 0 0 -120z"/>
                    <path d="M5950 420 c0 -16 7 -20 35 -20 l35 0 0 -100 c0 -100 0 -100 25 -100 24 0 24 1 27 98 l3 97 33 3 c24 2 32 8 32 23 0 17 -8 19 -95 19 -88 0 -95 -1 -95 -20z"/>
                    <path d="M6232 433 c2 -5 18 -36 36 -70 24 -46 32 -75 32 -113 0 -49 1 -50 30 -50 30 0 30 0 30 56 0 46 6 66 35 115 19 33 35 62 35 65 0 2 -13 4 -29 4 -24 0 -31 -7 -49 -47 l-21 -48 -20 48 c-18 42 -24 47 -51 47 -18 0 -30 -3 -28 -7z"/>
                    <path d="M6680 320 l0 -120 25 0 25 0 0 120 0 120 -25 0 -25 0 0 -120z"/>
                    <path d="M6850 320 l0 -120 25 0 c25 0 25 1 25 83 l0 82 46 -82 c41 -75 48 -83 75 -83 l29 0 0 120 0 120 -25 0 c-24 0 -25 -2 -25 -77 l-1 -78 -40 78 c-39 73 -43 77 -75 77 l-34 0 0 -120z"/>
                    <path d="M7810 320 l0 -121 28 3 27 3 -2 85 -2 85 47 -87 c41 -78 50 -88 75 -88 l27 0 0 120 0 120 -26 0 -26 0 4 -74 c2 -41 1 -72 -2 -70 -3 3 -21 36 -40 72 -33 63 -37 67 -72 70 l-38 3 0 -121z"/>
                    <path d="M8130 320 l0 -120 80 0 c79 0 80 0 80 25 0 23 -3 25 -50 25 -46 0 -50 2 -50 24 0 22 5 25 43 28 35 2 43 7 45 26 3 20 -1 22 -42 22 -42 0 -46 2 -46 25 0 23 4 25 45 25 38 0 45 3 45 20 0 18 -7 20 -75 20 l-75 0 0 -120z"/>
                    <path d="M8660 320 l0 -120 25 0 25 0 0 120 0 120 -25 0 -25 0 0 -120z"/>
                    <path d="M8846 326 c-20 -63 -36 -117 -36 -120 0 -3 13 -6 29 -6 24 0 29 5 35 31 5 28 9 30 43 27 30 -2 38 -8 43 -28 5 -20 13 -26 39 -28 29 -3 33 -1 27 15 -4 9 -21 64 -39 120 l-31 103 -37 0 -38 0 -35 -114z m93 -8 c1 -5 -10 -8 -23 -8 -23 0 -24 1 -13 42 l10 42 13 -34 c7 -19 13 -38 13 -42z"/>
                    <path d="M9260 420 c0 -16 7 -20 30 -20 l30 0 0 -100 0 -100 30 0 30 0 0 100 0 100 30 0 c23 0 30 4 30 20 0 19 -7 20 -90 20 -83 0 -90 -1 -90 -20z"/>
                </g>
                </svg>
                </div>

                 <div class="nav__toggle">Dark mode<i class="fa-solid fa-toggle-off fa-xl change-theme" id="theme-button"></i>
                </div>
            </nav>
        </header>

        <main class="main">
            <!--==================== HOME ====================-->
            <section class="home" id="home">
                <img src="assets/img/frame-atas.svg" alt="" class="home__img">   

                <div class="home__container container grid">
                    <div class="home__data">
                        <span class="home__data-subtitle"><?= !empty($data['pesan']) ? $data['pesan'] : 'Selamat Datang' ?></span>
                        <h1 class="home__data-title"><?= isset($data['jenkel']) ? (($data['jenkel'] == 'Laki-laki') ? 'Mr. ' : 'Mrs. ') : 'di Hotel Dafam Semarang' ?><b><?= $data['fname'] ?></b></h1>
                        <div id="container" class="button"><i class="fa-solid fa-file-pdf"></i> Hotel Directory</div>
                        <div id="canting" class="button"><i class="fa-solid fa-file-pdf"></i> F&B Menu </div>
                    </div>

                    <div class="home__social">
                    <p class="home__social-link">
                    <?php if (!empty($data['room'])): ?>
                        <i class="fa-solid fa-bed"></i><span> <?= $data['room'] ?></span>
                    <?php endif; ?>
                        </p>
                        <p class="home__social-link">
                            <i class="fa-solid fa-wifi"></i><span> dafamsemarang</span> 
                        </p>
                        <p class="home__social-link">
                            <i class="fa-solid fa-key"></i><span> krasansare</span> 
                        </p>
                        
                    </div>
                    
                    <div class="home__info">
                        <div>
                            <span class="home__info-title">6 Best places to visit in semarang</span>
                            <a href="#discover" class="button button--flex button--link home__info-button">
                                More <i class="ri-arrow-right-line"></i>
                            </a>
                        </div>

                        <div class="home__info-overlay">
                            <img src="assets/img/Candi-Gedong-Songo2.png" alt="" class="home__info-img">
                        </div>
                    </div>
                </div>
            </section>
            <!--==================== ABOUT ====================-->
            <section class="about section" id="about">
                <div class="about__container container grid">
                    <div class="about__data">
                        <h2 class="section__title about__title">Salam hangat dari<br><b>Hotel Dafam Semarang</b></h2>
                        <p class="about__description">
                            Kami berharap semoga selama kunjungan di Hotel Dafam Semarang 
                            dapat berkesan dan menyenangkan serta diberi kesehatan senantiasa. 
                            Apabila membutuhkan bantuan mohon dapat menghubungi kami, 
                            Call operator 🅾. Atau melalui whatsapp, 
                            Staff kami akan selalu siap membantu.          
                        </p>
                    </div>
                </div>
                </section>


            <section class="about section" id="canting">
                <div class="about__container container grid">
                        <div class="about__data">
                            <h3 class="section__title about__title"><b>Order Now!</b></h3>
                            <p class="about__description">Mau room service food & beverage?<br>sekarang bisa pakai aplikasi <b><canting>cantingfood!</canting></b>
                            </p>
                        </div>
        
                    <div class="about__img">
                        <div class="about__img-overlay">
                            <img src="assets/img/canting2.png" alt="" class="about__img-one">
                            <?php if (!empty($data['room'])): ?>
                                <a href="https://cantingfood.my.id/#/menu/dafam-<?= $data['room'] ?>" class="button3">Open App</a>
                            <?php else: ?>
                                <button onclick="showAlert()" class="button3">Open App</button>
                            <?php endif; ?>
                        </div>
                        <div class="about__img-overlay">
                            <img src="assets/img/canting1.png" alt="" class="about__img-two">
                        </div>
                    </div>
                </div>
            </section>
            
            <!--==================== DISCOVER ====================-->
            <section class="discover section" id="discover">
                <!-- <h2 class="section__title">Discover the most <br> attractive places</h2>  -->
                <h1 class="section__title">Travel is more than just<br>the journey or the destination,<br>it’s the experience.</h1>
                <div class="discover__container container swiper-container">
                    <div class="swiper-wrapper">

                        <!--==================== DISCOVER 1 ====================-->
                        <div class="discover__card swiper-slide">
                            <img src="assets/img/Candi-Gedong-Songo.jpg" alt="" class="discover__img">
                            <div class="discover__data">
                                <a href="https://www.google.com/maps/place/Gedong+Songo+Temple/@-7.2101516,110.3420223,17z/data=!3m1!4b1!4m6!3m5!1s0x2e70874ef3f95a73:0x5331ed5ca2e4242a!8m2!3d-7.2101516!4d110.3420223!16s%2Fm%2F051_nv4?entry=ttu">
                                <h2 class="discover__title"><i class="fa-solid fa-map-location-dot"></i> Gedong Songo</h2></a>
                                <span class="discover__description">Hindu cultural heritage temple complex located in Candi village, Bandungan District</span>
                            </div>
                        </div>

                        <!--==================== DISCOVER 2 ====================-->
                        <div class="discover__card swiper-slide">
                            <img src="assets/img/sampookong.jpg" alt="" class="discover__img">
                            <div class="discover__data">
                                <a href="https://www.google.com/maps/place/Wisata+Sam+Poo+Kong/@-6.9962947,110.3954251,17z/data=!3m1!4b1!4m6!3m5!1s0x2e708b46faaaaaab:0xef7fe551fe13bd76!8m2!3d-6.9963!4d110.398!16s%2Fm%2F0hzppmc?entry=ttu">
                                <h2 class="discover__title"><i class="fa-solid fa-map-location-dot"></i> Sam Poo Kong</h2></a>
                                <span class="discover__description">Famous historical landmarks.</span>
                            </div>
                        </div>

                        <!--==================== DISCOVER 3 ====================-->
                        <div class="discover__card swiper-slide">
                            <img src="assets/img/majt.jpg" alt="" class="discover__img">
                            <div class="discover__data">
                                <a href="https://www.google.com/maps/place/Masjid+Agung+Jawa+Tengah+(MAJT)/@-6.9962024,110.3568002,13z/data=!4m10!1m2!2m1!1smajt!3m6!1s0x2e708cb76c98241f:0x6afb73af24d41bf9!8m2!3d-6.9834607!4d110.4451271!15sCgRtYWp0WgYiBG1hanSSAQZtb3NxdWXgAQA!16s%2Fm%2F0j3g6x1?entry=ttu">
                                <h2 class="discover__title"><i class="fa-solid fa-map-location-dot"></i> Masjid Agung Jawa Tengah</h2></a>
                                <span class="discover__description">The mosque complex covers 10 hectares (25 acres)</span>
                            </div>
                        </div>

                        <!--==================== DISCOVER 4 ====================-->
                        <div class="discover__card swiper-slide">
                            <img src="assets/img/lawangsewu.jpg" alt="" class="discover__img">
                            <div class="discover__data">
                                <a href="https://www.google.com/maps/place/Lawang+Sewu/@-6.9839838,110.4095893,18z/data=!3m1!4b1!4m6!3m5!1s0x2e708b4f19af0393:0x11304de4230ded0d!8m2!3d-6.9840907!4d110.4108019!16s%2Fm%2F0hr1j_3?entry=ttu">
                                <h2 class="discover__title"><i class="fa-solid fa-map-location-dot"></i> Lawang Sewu</h2></a>
                                <span class="discover__description">Museum & Heritage gallery</span>
                            </div>
                        </div>

                        <!--==================== DISCOVER 5 ====================-->
                        <div class="discover__card swiper-slide">
                            <img src="assets/img/gereja-blenduk.jpg" alt="" class="discover__img">
                            <div class="discover__data">
                                <a href="https://www.google.com/maps/place/Protestant+Church+in+Western+Indonesia+Immanuel+Semarang/@-6.9683435,110.4249018,17z/data=!3m1!4b1!4m6!3m5!1s0x2e70f34349b8e345:0x8fd1c780aa92f074!8m2!3d-6.9683488!4d110.4274767!16s%2Fm%2F0cm6szl?entry=ttu">
                                <h2 class="discover__title"><i class="fa-solid fa-map-location-dot"></i> Gereja Blenduk</h2></a>
                                <span class="discover__description">Blenduk Church, at 32 Letjen Suprapto Street in the old town of Semarang.</span>
                            </div>
                        </div>

                        <!--==================== DISCOVER 6 ====================-->
                        <div class="discover__card swiper-slide">
                            <img src="assets/img/kota-lama.jpg" alt="" class="discover__img">
                            <div class="discover__data">
                                <a href="https://www.google.com/maps/place/Old+Town+Semarang/@-6.9682959,110.4258618,17z/data=!3m1!4b1!4m6!3m5!1s0x2e70f35649aa5e89:0x36af9cb064c11968!8m2!3d-6.9683012!4d110.4284367!16s%2Fg%2F112yf_64x?entry=ttu">
                                <h2 class="discover__title"><i class="fa-solid fa-map-location-dot"></i> Kota Lama Semarang</h2></a>
                                <span class="discover__description">is an area in Semarang which became a trading center in the 19-20 centuries</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!--==================== EXPERIENCE ====================-->
            <section class="experience section" id="wanderlust">
                <h2 class="section__title">Get an additional 10% off<br> every time you stay with us. <br>Ar+otel wanderlust</h2>
                
                <div class="experience__container container grid">
                    <div class="experience__content grid">
                        <div class="experience__data">
                            <h2 class="experience__number">SILVER</h2>
                            <span class="experience__description">No Minimum Night<br>or Spend</span>
                        </div>

                        <div class="experience__data">
                            <h2 class="experience__number">GOLD</h2>
                            <span class="experience__description">Minimum 5 Nights or  <br> Spend IDR 5,000,000</span>
                        </div>

                        <div class="experience__data">
                            <h2 class="experience__number">BLACK</h2>
                            <span class="experience__description">Minimum 15 Nights or <br> Spend IDR 15,000,000</span>
                        </div>
                    </div>
                    
                    
                    <div class="experience__img grid">
                        <div class="experience__overlay">
                            <img src="assets/img/wanderlust.png" alt="" class="experience__img-one">
                        </div>
                        <div class="experience__overlay">
                            <a href="https://www.jointoday.co/register/artotj7jo73" class="button2">REGISTER NOW!</a>
                        </div>
                    </div>
                </div>
            </section>

            <!--==================== VIDEO ====================-->
            <section class="video section">
                <!-- <h2 class="section__title">Company Profile</h2> -->

                <div class="video__container container">
                    <h3 class="video__description"><b>Find out more with our video.
                </h3>

                    <div class="video__content">
                        <video id="video-file">
                            <source src="assets/video/companyprofile.mp4" type="video/mp4">
                        </video>

                        <!-- <button class="button button--flex video__button" id="video-button">
                            <i class="ri-play-line video__button-icon" id="video-icon"></i>
                        </button> -->
                    </div>
                </div>
            </section>
            
            <!--==================== SPONSORS ====================-->
            <section class="sponsor section">
                <div class="sponsor__container container grid">
                    <div class="sponsor__content">
                        <img src="assets/img/Logo_DAFAM.png" alt="" class="sponsor__img">
                    </div>
                    <div class="sponsor__content">
                        <img src="assets/img/no_food.png" alt="" class="sponsor__img">
                    </div>
                    <div class="sponsor__content">
                        <img src="assets/img/cantinglogo.png" alt="" class="sponsor__img">
                    </div>
                    <div class="sponsor__content">
                        <img src="assets/img/Logo_ARTOTEL.png" alt="" class="sponsor__img">
                    </div>
                </div>
            </section>

        </main>

        <!--==================== FOOTER ====================-->
        <footer class="footer section">
            <div class="footer__container container grid">
                <div class="footer__content grid">

                    <div class="footer__data">
                        <h3 class="footer__title"></h3>
                        <p class="footer__description">You choose the <br> destination, 
                            we offer you the <br> experience.
                        </p>
                        <div>
                            <a href="https://www.facebook.com/dafamsemarang" target="_blank" class="footer__social">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                            <a href="https://www.instagram.com/dafamsemarang" target="_blank" class="footer__social">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="https://www.youtube.com/@dafamsemarangofficial" target="_blank" class="footer__social">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        </div>
                       
                    <!-- </div> -->

                    <hr class="tebal"></hr>

                     <!--==================== ACCORDION ====================-->
                     
        <!-- <div class="footer__data"> -->
            <!-- <h3 class="footer__subtitle"></h3> -->

            <div class="accordion">

                <div class="accordion-item" id="question1">
                  <a class="accordion-link" href="#question1">
                    <div class="flex">
                      <h3>Dafam Semarang</h3>
                    </div>
                    <i class="icon ion-md-arrow-forward"></i>
                    <i class="icon ion-md-arrow-down"></i>
                  </a>
                  <div class="answer">
                    <p><a href="https://www.google.com/maps/place/Hotel+Dafam+Semarang/@-6.981186,110.4120498,17.5z/data=!4m9!3m8!1s0x2e708b4d0808faa9:0x1c54882d293f1937!5m2!4m1!1i2!8m2!3d-6.979702!4d110.4119873!16s%2Fg%2F1pty11fv5?entry=ttu">
                    Jl. Imam Bonjol No.188, Sekayu, Kec. Semarang Tengah, Kota Semarang, Jawa Tengah 50132</a></p>
                    <p><a href="tel:0243554111"><i class="fa-solid fa-square-phone-flip"></i> 0243554111</a></p>
                    <p><a href="https://wa.me/6289524580971?text=Hi%20Dafam"><i class="fa-brands fa-whatsapp"></i> 6289524580971</a></p>
                    <p><a href="https://www.instagram.com/dafamsemarang/"><i class="fa-brands fa-instagram"></i> dafamsemarang</a></p>
                    <div id="semarang"><p><i class="fa-regular fa-file-pdf"></i></i> Company Profile</p>
                    </div>
                  </div>
                </div>

                <div class="accordion-item" id="question2">
                  <a class="accordion-link" href="#question2">
                    <div class="flex">
                      <h3>Dafam Cilacap</h3>
                    </div>
                    <i class="icon ion-md-arrow-forward"></i>
                    <i class="icon ion-md-arrow-down"></i>
                  </a>
                  <div class="answer">
                    <p><a href="https://www.google.com/maps/place/Hotel+Dafam+Cilacap/@-7.7320947,109.0123965,17z/data=!3m1!4b1!4m10!3m9!1s0x2e65128cd255fa6b:0x24a8d819181b726a!5m3!1s2023-10-19!4m1!1i2!8m2!3d-7.7321!4d109.0149714!16s%2Fg%2F1tdj8134?entry=ttu">Dr. Wahidin Sudiro Husodo No.5-15,Dafam Cilacap, Sidakaya, Kec. Cilacap Sel., Kabupaten Cilacap, Jawa Tengah 53211</a></p>
                    <p><a href="tel:0282520097"><i class="fa-solid fa-square-phone-flip"></i> 0282520097</a></p>
                    <p><a href="https://wa.me/628112002555?text=Hi%20Dafam"><i class="fa-brands fa-whatsapp"></i> 628112002555</a></p>
                    <p><a href="https://www.instagram.com/dafamcilacap/"><i class="fa-brands fa-instagram"></i> dafamcilacap</a></p>
                    <div id="cilacap"><p><i class="fa-regular fa-file-pdf"></i></i> Company Profile</p>
                    </div>
                </div>
              </div>            

                <div class="accordion-item" id="question3">
                  <a class="accordion-link" href="#question3">
                    <div class="flex">
                      <h3>Dafam Pekanbaru</h3>
                    </div>
                    <i class="icon ion-md-arrow-forward"></i>
                    <i class="icon ion-md-arrow-down"></i>
                  </a>
                  <div class="answer">
                    <p><a href="https://www.google.com/maps/place/Hotel+Dafam+Pekanbaru/@0.5305126,101.450927,17z/data=!3m1!4b1!4m10!3m9!1s0x31d5ac15b4ed8061:0xe9cd203696530035!5m3!1s2023-10-19!4m1!1i2!8m2!3d0.5305072!4d101.4535019!16s%2Fg%2F12hlxvh_k?entry=ttu">Sultan Syarif Qasim No.Kav. 150, Kota Tinggi, Kec. Pekanbaru Kota, Kota Pekanbaru, Riau 28155</a></p>
                    <p><a href="tel:0761851177"><i class="fa-solid fa-square-phone-flip"></i> 0761851177</a></p>
                    <p><a href="https://wa.me/6282385985858?text=Hi%20Dafam"><i class="fa-brands fa-whatsapp"></i> 6282385985858</a></p>
                    <p><a href="https://www.instagram.com/dafampekanbaru/"><i class="fa-brands fa-instagram"></i> dafampekanbaru</a></p>
                    <div id="pekanbaru"><p><i class="fa-regular fa-file-pdf"></i></i> Company Profile</p>
                    </div>
                    </div>
                </div>

                <div class="accordion-item" id="question4">
                  <a class="accordion-link" href="#question4">
                    <div>
                      <h3>Dafam Pekalongan</h3>
                    </div>
                    <i class="icon ion-md-arrow-forward"></i>
                    <i class="icon ion-md-arrow-down"></i>
                  </a>
                  <div class="answer">
                    <p><a href="https://www.google.com/maps/place/Hotel+Dafam+Pekalongan/@-6.9015655,109.6617434,17z/data=!3m1!4b1!4m10!3m9!1s0x2e7026a019263459:0x96af3db0a4decfc5!5m3!1s2023-10-19!4m1!1i2!8m2!3d-6.9015708!4d109.6643183!16s%2Fg%2F1hc75pq2s?entry=ttu">Urip Sumoharjo No.53 Medono, Podosugih, Kec. Pekalongan Bar., Kota Pekalongan, Jawa Tengah 51111</a></p>
                    <p><a href="tel:02854411555"><i class="fa-solid fa-square-phone-flip"></i> 02854411555</a></p>
                    <p><a href="https://wa.me/6285226999088?text=Hi%20Dafam"><i class="fa-brands fa-whatsapp"></i> 6285226999088</a></p>
                    <p><a href="https://www.instagram.com/hotel_dafam_pekalongan/"><i class="fa-brands fa-instagram"></i> hotel_dafam_pekalongan</a></p>
                    <div id="pekalongan"><p><i class="fa-regular fa-file-pdf"></i></i> Company Profile</p>
                    </div>
                    </div>
                </div>

              <div class="accordion-item" id="question5">
                <a class="accordion-link" href="#question5">
                  <div>
                    <h3>Marlin</h3>
                  </div>
                  <i class="icon ion-md-arrow-forward"></i>
                  <i class="icon ion-md-arrow-down"></i>
                </a>
                <div class="answer">
                  <p><a href="https://www.google.com/maps/place/Hotel+Marlin+Pekalongan/@-6.891711,109.6163613,17z/data=!3m1!4b1!4m10!3m9!1s0x2e7027066b97ae25:0xce2f0a7853f3346d!5m3!1s2023-10-19!4m1!1i2!8m2!3d-6.8917164!4d109.6212322!16s%2Fg%2F11xbt1jb7?entry=ttu">Raya Wiradesa No.25, Mayangan, Kec. Wiradesa, Kabupaten Pekalongan, Jawa Tengah 51152</p></a>
                  <p><a href="tel:02854414555"><i class="fa-solid fa-square-phone-flip"></i> 02854414555</a></p>
                    <p><a href="https://wa.me/628156549781?text=Hi%20Dafam"><i class="fa-brands fa-whatsapp"></i> 628156549781</a></p>
                    <p><a href="https://www.instagram.com/hotelmarlinpekalongan/"><i class="fa-brands fa-instagram"></i> hotelmarlinpekalongan</a></p>
                    <div id="marlin"><p><i class="fa-regular fa-file-pdf"></i></i> Company Profile</p>
                    </div>
                    </div>
                </div>

             </div>   
            </div>

                    <div class="footer__data">
                        <h3 class="footer__subtitle"></h3>
                        <ul>
                            <li class="footer__item">
                                <a href="" class="footer__link"></a>
                            </li>
                            <li class="footer__item">
                                <a href="" class="footer__link"></a>
                            </li>
                            <li class="footer__item">
                                <a href="" class="footer__link"></a>
                            </li>
                        </ul>
                    </div>
    
                    <div class="footer__data">
                        <h3 class="footer__subtitle"></h3>
                        <ul>
                            <li class="footer__item">
                                <a href="" class="footer__link"></a>
                            </li>
                            <li class="footer__item">
                                <a href="" class="footer__link"></a>
                            </li>
                            <li class="footer__item">
                                <a href="" class="footer__link"></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="footer__rights">
                    <p class="footer__copy">&#169; Dafam.</p>
                </div>
        </footer>

         <!--========== SCROLL UP ==========-->
        <a href="#" class="scrollup" id="scroll-up">
            <i class="ri-arrow-up-line scrollup__icon"></i>
        </a>

        <!--========== whatsapp ==========-->
        <a href="https://wa.me/6289524580971?text=Hi%20Hotel%20Dafam,%20saya%20<?=$data['nama']?>%20dari%20kamar%20<?=$data['room']?>" class="whatsapp" id="whatsapp">
        <i class="ri-whatsapp-fill whatsapp__icon"></i>
        </a>

        <!--=============== SCROLL REVEAL===============-->
        <script src="assets/js/scrollreveal.min.js"></script>
        
        <!--=============== SWIPER JS ===============-->
        <script src="assets/js/swiper-bundle.min.js"></script>

        <!--=============== MAIN JS ===============-->
        <script src="assets/js/main.js"></script>

        <!--=============== sweetalert2 ==============-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        function showAlert() {
            Swal.fire({
                title: 'Oops',
                text: 'Silakan scan qr untuk room service, Please scan qr for room service',
                icon: 'info',
                backdrop: 'rgba(0,0,0,0.4)',
                showConfirmButton: false,
                customClass: {
                popup: 'rounded' // Menambahkan kelas CSS untuk sudut bulat
            }
            });
        }
    </script>
    </body>
</html>