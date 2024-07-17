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
  <div class="datepicker-container">
    <div class="form-row align-items-center mb-3">
        <div class="col-auto">
            <input type="text" class="rounded-pill custom-datepicker-input" id="start-date" name="start_date" autocomplete="off" 
                   value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>" 
                   placeholder="CheckIn">
            <label for="start-date" class="btn btn-light rounded-pill custom-datepicker-button"><i class="fa-solid fa-calendar-days"></i></label>
        </div>
        <div class="col-auto">
            <input type="text" class="rounded-pill custom-datepicker-input" id="end-date" name="end_date" autocomplete="off" 
                   value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>" 
                   placeholder="CheckOut">
            <label for="end-date" class="btn btn-light rounded-pill custom-datepicker-button"><i class="fa-solid fa-calendar-days"></i></label>        
        </div>
        <div class="col-auto">
            <input type="text" class="rounded-pill custom-datepicker-input" id="datecreate" name="datecreate" autocomplete="off" 
                   value="<?php echo isset($_GET['datecreate']) ? $_GET['datecreate'] : ''; ?>" 
                   placeholder="Date Created">
            <label for="datecreate" class="btn btn-light rounded-pill custom-datepicker-button"><i class="fa-solid fa-calendar-days"></i></label>        
        </div>

        <div class="col-auto">
            <input type="text" class="rounded-pill custom-search-input" aria-describedby="basic-addon2" id="search-input" placeholder="Search...">
        </div>

        <div class="col-auto">
            <button type="button" class="btn btn-danger rounded-pill" id="reset-filter"><i class="fa-solid fa-filter-circle-xmark"></i></button>
        </div>
  </form>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-striped w-100" id="table-2">
              <thead>
              <tr>
                <!-- <th>REGCARD</th> -->
                <th>NAME</th>
                <th>FOLIO</th>
                <th data-orderable="false"><input type="checkbox" id="selectAllCheckbox" style="display: none;"></input><label for="selectAllCheckbox"><i class="fa-solid fa-check-double" style="color: #63E6BE;"></i> ROOM</label></th>
                <th>ROOMTYPE</th>
                <th>ROOM STATUS</th>
                <th>CHECKIN</th>
                <th>CHECKOUT</th>
                <th>DATEOFBIRTH</th>
                <th>PHONE</th>
                <th>EMAIL</th>
                <th>GUESTBILL</th>
                <th>CL / VOUCHER</th>
                <th>STATUS</th>
                <th>DATECREATE</th>
            </tr>
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
<div class="modal fade" id="deviceModal" tabindex="-1" role="dialog" aria-labelledby="deviceModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deviceModalLabel"><i class="fa-solid fa-tablet"></i> Select Device</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="get">
          <div class="form-group">
            <label for="device_id"><i>pilih tablet untuk sign dokumen</i></label>
            <select name="token_id" id="device_id" class="form-control">
              <?php
              require_once '../helper/connection.php';
              $query = "SELECT token_id, device_name FROM token_device";
              $result = mysqli_query($connection, $query);
              while ($row = mysqli_fetch_assoc($result)): ?>
                <option value="<?= $row['token_id'] ?>"><?= $row['device_name'] ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">PILIH</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="deviceModal2" tabindex="-1" role="dialog" aria-labelledby="deviceModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deviceModalLabel"><i class="fa-solid fa-tablet"></i> Select Device</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="get">
          <div class="form-group">
            <label for="device_id"><i>pilih tablet untuk sign dokumen</i></label>
            <select name="token_id" id="device_id" class="form-control">
              <?php
              require_once '../helper/connection.php';
              $query = "SELECT token_id, device_name FROM token_device";
              $result = mysqli_query($connection, $query);
              while ($row = mysqli_fetch_assoc($result)): ?>
                <option value="<?= $row['token_id'] ?>"><?= $row['device_name'] ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">PILIH</button>
        </form>
      </div>
    </div>
  </div>
</div>

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
        // <td>${getRegcardButtons(data)}</td>
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
        // <td>${getGuestbillButtons(data)}</td>
        // <td>${getOtaVoucherButtons(data)}</td>
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