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
                <th>REGCARD</th>
                <th>NAME</th>
                <th>FOLIO</th>
                <th>ROOM</th>
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

 <!-- jQuery -->
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    // Event listener untuk SSE
    var eventSource = new EventSource('sse-server.php');
    eventSource.onmessage = function(event) {
        var data = JSON.parse(event.data);
        updateTable(data);
    };

    // Function untuk memperbarui tabel
    function updateTable(data) {
        var tableBody = document.getElementById('guestTableBody');
        tableBody.innerHTML = '';
        data.forEach(function(row) {
            var newRow = `
                <tr>
                    <td>${renderButtons(row.at_regform, row.folio)}</td>
                    <td>${row.fname}</td>
                    <td><a href="https://ecard.dafam.cloud/?folio=${row.folio}" target="_blank">${row.folio}</a></td>
                    <td>${row.room}</td>
                    <td>${row.roomtype}</td>
                    <td>${renderRoomStatus(row.foliostatus)}</td>
                    <td>${row.dateci}</td>
                    <td>${row.dateco}</td>
                    <td>${row.birthday}</td>
                    <td>${row.resv_phone}</td>
                    <td>${row.resv_email}</td>
                    <td>${renderGuestBill(row.g_signature_path, row.at_guestfolio)}</td>
                    <td>${renderCLVoucher(row.at_ota_voucher)}</td>
                    <td>${renderStatus(row.status)}</td>
                    <td>${row.datecreate}</td>
                </tr>
            `;
            tableBody.insertAdjacentHTML('beforeend', newRow);
        });
    }

    // Function untuk menampilkan tombol berdasarkan kondisi
    function renderButtons(at_regform, folio) {
        var buttons = '';
        if (!at_regform) {
            buttons += `<button class="btn btn-sm btn-default mb-md-0 mb-1" data-toggle="modal" data-target="#deviceModal" data-id="${folio}"><i class="fa-solid fa-paper-plane fa-xl" style="color: #f82b85;"></i></button>`;
        } else {
            buttons += `<a class="btn btn-sm btn-default mb-md-0 mb-1" href="${at_regform}" target="_blank"><i class="fa-solid fa-file-pdf fa-xl" style="color: #B5120C;"></i></a>`;
        }
        if (!folio) {
            buttons += `<a class="btn btn-sm btn-default mb-md-0 mb-1" href="regform_edit.php?folio=${folio}"><i class="fa-regular fa-pen-to-square fa-xl"></i></a>`;
        }
        if (!row.rc_signature_path) {
            buttons += `<a class="btn btn-sm btn-default mb-md-0 mb-1">unsigned <i class="fa-solid fa-circle-exclamation" style="color: #FFD43B;"></i></a>`;
        } else {
            buttons += `<a class="btn btn-sm btn-default mb-md-0 mb-1">signed <i class="fa-solid fa-circle-check" style="color: #63E6BE;"></i></a>`;
        }
        return buttons;
    }

    // Function untuk menampilkan status ruangan
    function renderRoomStatus(foliostatus) {
        switch (foliostatus) {
            case 'I': return '<span style="color: #36BA98;">inHouse</span>';
            case 'O': return '<span style="color: #C80036;">CheckOut</span>';
            case 'C': return '<span style="color: #1679AB;">Confirm</span>';
            case 'G': return '<span style="color: #102C57;">Guarantee</span>';
            case 'T': return '<span style="color: #43919B;">Tentative</span>';
            default: return '<span class="text-muted">Cancel</span>';
        }
    }

    // Function untuk menampilkan tombol Guest Bill
    function renderGuestBill(g_signature_path, at_guestfolio) {
        var buttons = '';
        if (!g_signature_path && at_guestfolio) {
            buttons += `<button class="btn btn-sm btn-default mb-md-0 mb-1" data-toggle="modal" data-target="#deviceModal2" data-id="${folio}">
                <i class="fa-solid fa-paper-plane fa-xl" style="color: #f82b85;"></i>
            </button>`;
        }
        if (at_guestfolio) {
            buttons += `<a class="btn btn-sm btn-default mb-md-0 mb-1" href="${at_guestfolio}" target="_blank"><i class="fa-solid fa-file-pdf fa-xl" style="color: #B5120C;"></i></a>`;
        }
        if (!at_guestfolio) {
            buttons += `<a class="btn btn-sm btn-light rounded-pill mb-md-0 mb-1" href="guestfolio.php?folio=${folio}">
                <i class="fa-solid fa-cloud-arrow-up fa-xl" style="color: #0f97ff;"></i> upload
            </a>`;
        }
        if (!g_signature_path && at_guestfolio) {
            buttons += `<a class="btn btn-sm btn-default mb-md-0 mb-1">unsigned <i class="fa-solid fa-circle-exclamation" style="color: #FFD43B;"></i></a>`;
        }
        if (g_signature_path) {
            buttons += `<a class="btn btn-sm btn-default mb-md-0 mb-1">signed <i class="fa-solid fa-circle-check" style="color: #63E6BE;"></i></a>`;
        }
        return buttons;
    }

    // Function untuk menampilkan tombol CL / Voucher
    function renderCLVoucher(at_ota_voucher) {
        var buttons = '';
        if (at_ota_voucher) {
            buttons += `<a class="btn btn-sm btn-default mb-md-0 mb-1" href="${at_ota_voucher}" target="_blank"><i class="fa-solid fa-file-pdf fa-xl" style="color: #B5120C;"></i></a>`;
        } else {
            buttons += `<a class="btn btn-sm btn-light rounded-pill mb-md-0 mb-1" href="Voucher.php?folio=${folio}"><i class="fa-solid fa-cloud-arrow-up fa-xl" style="color: #0f97ff;"></i> upload</a>`;
        }
        return buttons;
    }

    // Function untuk menampilkan status
    function renderStatus(status) {
        switch (status) {
            case 'I': return '<span style="color: #36BA98;">CheckIn</span>';
            case 'O': return '<span style="color: #C80036;">CheckOut</span>';
            case 'D': return '<span style="color: #E4E6EB;">DNB</span>';
            default: return '<span class="text-muted">Delete</span>';
        }
    }
    </script>

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