<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Card</title>
    <link rel="icon" href="images/icon/drawable-hdpi/icon.png" type="image/x-icon">
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" type="text/css" href="sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://kit.fontawesome.com/3595b79eb9.js" crossorigin="anonymous"></script>

    <script>

    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('service-worker.js')
            .then(registration => {
            console.log('Service Worker registered with scope:', registration.scope);

            navigator.serviceWorker.addEventListener('message', event => {
                if (event.data.type === 'update') {
                alert(event.data.message);
                }
            });
            })
            .catch(error => {
            console.error('Service Worker registration failed:', error);
            });
    }

    function notifyServiceWorkerToUpdateCache() {
        if (navigator.serviceWorker.controller) {
            navigator.serviceWorker.controller.postMessage({ type: 'clearCache' });
        }
    }
    </script>

</head>

<body>
    <form id="imageForm"> 
        <img src="images/logo.png" alt="logo" class="logo">
        <input type="hidden" id="device_id"/>
        <input type="hidden" id="roomType"/>
        <input type="hidden" id="pdfFile"/>

        <div class="input-group">
            <div class="input-wrapper">
                <input type="text" id="text5" placeholder="NAME" disabled/>
                <input type="text" id="text9" placeholder="PHONE NUMBER"/>
            </div>
        </div>

        <div class="input-group">
            <div class="input-wrapper">
                <label for="text1"><h3>ROOM</h3></label>
                <input type="text" id="text1" placeholder="***" disabled/>
                <label for="text2"><h3>FOLIO</h3></label>
                <input type="text" id="text2" placeholder="*****" disabled/>
            </div>
        </div>      

        <div class="input-group">
            <div class="input-wrapper">
                <label for="text3"><h3>CHECKIN</h3></label>
                <input type="date" id="text3" disabled/>
                <label for="text4"><h3>CHECKOUT</h3></label>
                <input type="date" id="text4" disabled/>
            </div>
        </div>

        <div class="input-group">
            <div class="input-wrapper">
                <label for="text6"><h3>GENDER</h3></label>
                <input type="text" id="text6" placeholder="**" disabled/>
                <label for="text7"><h3>BIRTH OF DATE</h3></label>
                <input type="text" id="text7" placeholder="**/**/****" disabled/>
            </div>
        </div>

        <div class="input-group">
            <div class="input-wrapper">
                <label for="text8"><h3>ADDRESS</h3></label>
                <textarea id="text8" class="input-address" placeholder="Jl." disabled></textarea>
            </div>
        </div>

        <div class="input-group">
            <div class="input-wrapper">
                <label for="email"><h3>EMAIL</h3></label>
                <input type="text" id="email" placeholder="dafam@mail.com"/>
            </div>
        </div>
        
        <div id="message"></div>
        <div id="signature-pad">
            <label><h3>SIGNATURE</h3></label>
            <canvas></canvas>
            <div class="input-group">
                <div class="input-wrapper">
                    <button type="button" class="undoClear" data-action="clear"><i class="fa-solid fa-eraser"></i></button>
                    <button type="button" data-action="undo"><i class="fa-solid fa-rotate-left"></i></button>
                    <button type="button" id="save-btn" class="cyan">SUBMIT</button>
                </div>
            </div>
        </div>
    </form>

    <script src="sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="js/signature_pad.umd.js"></script>
    <script src="js/app.js"></script>
    <script src="js/axios.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>