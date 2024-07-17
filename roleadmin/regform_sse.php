<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';
?>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap Datepicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker3.min.css" integrity="sha512-aQb0/doxDGrw/OC7drNaJQkIKFu6eSWnVMAwPN64p6sZKeJ4QCDYL42Rumw2ZtL8DB9f66q4CnLIUnAw28dEbg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <b><i class="fa-solid fa-fire"></i> FrontOffice <i class="fa-solid fa-folder-open"></i> Regcard Guestfolio</b>
  </div>

  <!-- Date Filter -->
  <form id="filter" method="GET">
    <!-- Your existing date filter HTML -->
  </form>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-striped w-100" id="table-2">
              <thead>
                <!-- Your table header rows -->
              </thead>
              <tbody id="table-body">
                <!-- Table body rows will be updated dynamically -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require_once '../layout/_bottom.php';
?>

<!-- Modal -->
<!-- Your existing modals -->

<!-- Bootstrap Datepicker JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcode-generator/1.4.4/qrcode.min.js" integrity="sha512-ZDSPMa/JM1D+7kdg2x3BsruQ6T/JpJo3jWDWkCZsP+5yVyp1KfESqLI+7RqB5k24F7p2cV7i2YHh/890y6P6Sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  // Function to handle SSE
  function handleSSE(event) {
    const data = JSON.parse(event.data); // Assuming server sends JSON data

    // Update the table body with new data
    $('#table-body').append(`
      <tr>
        <td>${getRegcardButtons(data)}</td>
        <td>${data.fname}</td>
        <td><a class="btn btn-default" href="https://ecard.dafam.cloud/?folio=${data.folio}" target="_blank">${data.folio}</a></td>
        <td>${getRoomInfo(data)}</td>
        <td>${data.roomtype}</td>
        <td>${getFoliostatus(data)}</td>
        <td>${data.dateci}</td>
        <td>${data.dateco}</td>
        <td>${data.birthday}</td>
        <td>${data.resv_phone}</td>
        <td>${data.resv_email}</td>
        <td>${getGuestbillButtons(data)}</td>
        <td>${getOtaVoucherButtons(data)}</td>
        <td>${getStatus(data)}</td>
        <td>${data.datecreate}</td>
      </tr>
    `);
  }

  // Function to establish SSE connection
  function initSSE() {
    const eventSource = new EventSource('sse-server.php'); // Replace with your SSE server endpoint

    eventSource.onmessage = handleSSE;
    eventSource.onerror = function(error) {
      console.error('SSE Error:', error);
      eventSource.close();
    };
  }

  // Initialize SSE connection when document is ready
  $(document).ready(function() {
    initSSE();
  });

  // Your existing JavaScript functions (printSelectedQRCode(), syncData(), printRow(), etc.)
</script>

<?php
if (isset($_SESSION['info'])):
  if ($_SESSION['info']['status'] == 'success') {
?>
    <script>
      iziToast.success({
        title: 'Sukses',
        message: `<?= $_SESSION['info']['message'] ?>`,
        position: 'topCenter',
        timeout: 5000
      });
    </script>
<?php
  } else {
?>
    <script>
      iziToast.error({
        title: 'Gagal',
        message: `<?= $_SESSION['info']['message'] ?>`,
        timeout: 5000,
        position: 'topCenter'
      });
    </script>
<?php
  }
  unset($_SESSION['info']);
endif;
?>

<script src="../assets/js/page/modules-datatables.js"></script>
