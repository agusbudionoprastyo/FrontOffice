<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';
?>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap Datepicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker3.min.css" integrity="sha512-aQb0/doxDGrw/OC7drNaJQkIKFu6eSWnVMAwPN64p6sZKeJ4QCDYL42Rumw2ZtL8DB9f66q4CnLIUnAw28dEbg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Custom CSS -->
<style>
#search-input {
    width: 300px; /* Sesuaikan lebar sesuai kebutuhan */
    margin-right: 0; /* Jarak dari tepi kanan halaman */
    margin-top: 0; /* Jarak dari bagian atas halaman */
    /* Tambahkan gaya tambahan sesuai kebutuhan */
}

/* Custom datepicker input */
.custom-search-input {
    width: 150px; /* Adjust width as needed */
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
/* Custom datepicker container */
.datepicker-container {
    position: relative;
    display: inline-block;
}

/* Custom datepicker input */
.custom-datepicker-input {
    width: 150px; /* Adjust width as needed */
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

/* Custom datepicker button */
.custom-datepicker-button {
    position: absolute;
    top: .18rem;
    right: .5rem;
    padding: 0.175rem 0.55rem;
    border-top-right-radius: 0.25rem;
    border-bottom-right-radius: 0.25rem;
}

/* Custom datepicker button icon */
.custom-datepicker-button i {
    vertical-align: middle;
}

.button-spacing {
    margin-bottom: 10px;
}

/* Sembunyikan teks "Clear" */
.datepicker{
    font-size: 12px;
}

#table-2 th:nth-child(1),
#table-2 td:nth-child(1) {
min-width: 200px; /* Kolom REGCARD */
}

#table-2 th:nth-child(2),
#table-2 td:nth-child(2) {
min-width: 150px; /* Kolom GUESTBILL */
}

#table-2 th:nth-child(3),
#table-2 td:nth-child(3) {
min-width: 150px; /* Kolom CL / VOUCHER */
}

#table-2 th:nth-child(4),
#table-2 td:nth-child(4) {
min-width: 250px; /* Kolom NAME */
}

.dataTables_wrapper .dataTables_filter {
    display: none;
}

</style>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <b><i class="fa-solid fa-fire"></i> FrontOffice <i class="fa-solid fa-folder-open"></i> Regcard Guestfolio</b>
    <a href="#" onclick="syncData(); return false;" class="btn btn-dark rounded-pill"><i class= "fa-solid fa-rotate fa-beat-fade"></i> SYNC DATA</a>
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
            <label for="datecreate" class="btn btn-info rounded-pill custom-datepicker-button"><i class="fa-solid fa-calendar-days"></i></label>        
        </div>

        <div class="col-auto">
            <input type="text" class="rounded-pill custom-search-input" aria-describedby="basic-addon2" id="search-input" placeholder="Search...">
        </div>

        <div class="col-auto">
            <button type="button" class="btn btn-danger rounded-pill" id="reset-filter"><i class="fa-solid fa-filter-circle-xmark"></i></button>
        </div>

        </div>
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
                                <th>GUESTBILL</th>
                                <th>CL / VOUCHER</th>
                                <th>NAME</th>
                                <th>FOLIO</th>
                                <th>ROOM STATUS</th>
                                <th>ROOM</th>
                                <th>ROOMTYPE</th>
                                <th>CHECKIN</th>
                                <th>CHECKOUT</th>
                                <th>DATEOFBIRTH</th>
                                <th>PHONE</th>
                                <th>EMAIL</th>
                                <th>STATUS</th>
                                <th>DATECREATE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Default SQL query
                            $sql = "SELECT * FROM FOGUEST";

                            // Check if start date is provided
                            if (isset($_GET['start_date']) && !empty($_GET['start_date'])) {
                                $start_date = $_GET['start_date'];
                                $sql .= " WHERE dateci = '$start_date'";
                            }

                            // Check if end date is provided
                            if (isset($_GET['end_date']) && !empty($_GET['end_date'])) {
                                $end_date = $_GET['end_date'];
                                // Add WHERE clause or append to existing one
                                $sql .= isset($start_date) ? " AND dateco = '$end_date'" : " WHERE dateco = '$end_date'";
                            }

                            // Check if create date is provided
                            if (isset($_GET['datecreate']) && !empty($_GET['datecreate']) && empty($_GET['start_date']) && empty($_GET['end_date'])) {
                                $datecreate = $_GET['datecreate'];
                                $sql .= " WHERE datecreate = '$datecreate'";
                            }

                            // Add ORDER BY clause
                            $sql .= " ORDER BY folio DESC";

                            // Perform the query
                            $result = mysqli_query($connection, $sql);

                            // Check if the query was successful
                            if (!$result) {
                                die("Query failed: " . mysqli_error($connection));
                            }

                            // Loop through the results and display them in the table
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php if (empty($row['at_regform'])): ?>
                                            <button class="btn btn-sm btn-default mb-md-0 mb-1" data-toggle="modal" data-target="#deviceModal" data-id="<?php echo $row['folio']; ?>">
                                                <i class="fa-solid fa-paper-plane fa-xl" style="color: #f82b85;"></i>
                                            </button>
                                        <?php endif; ?>
                                        <?php if ($row['at_regform']): ?>
                                            <a class="btn btn-sm btn-default mb-md-0 mb-1" href="<?php echo $row['at_regform']; ?>" target="_blank"><i class="fa-solid fa-file-pdf fa-xl"></i></a>                                
                                        <?php endif; ?>
                                        <?php if (empty($row['room'])): ?>
                                            <a class="btn btn-sm btn-default mb-md-0 mb-1" href="regform_edit.php?folio=<?php echo $row['folio']; ?>"><i class="fa-regular fa-pen-to-square fa-xl"></i></a>
                                        <?php endif; ?>
                                        <?php if (empty($row['rc_signature_path'])): ?>
                                            <a class="btn btn-sm btn-default mb-md-0 mb-1">unsigned <i class="fa-solid fa-circle-exclamation" style="color: #FFD43B;"></i></a>
                                        <?php endif; ?>
                                        <?php if ($row['rc_signature_path']): ?>
                                            <a class="btn btn-sm btn-default mb-md-0 mb-1">signed <i class="fa-solid fa-circle-check" style="color: #63E6BE;"></i></a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ((empty($row['g_signature_path'])) && ($row['at_guestfolio'])): ?>
                                            <button class="btn btn-sm btn-default mb-md-0 mb-1" data-toggle="modal" data-target="#deviceModal2" data-id="<?php echo $row['folio']; ?>">
                                                <i class="fa-solid fa-paper-plane fa-xl" style="color: #f82b85;"></i>
                                            </button>
                                        <?php endif; ?>
                                        <?php if ($row['at_guestfolio']): ?>
                                            <a class="btn btn-sm btn-default mb-md-0 mb-1" href="<?php echo $row['at_guestfolio']; ?>" target="_blank"><i class="fa-solid fa-file-pdf fa-xl"></i></a>
                                        <?php endif; ?>
                                        <?php if (empty($row['at_guestfolio'])): ?>
                                        <a class="btn btn-sm btn-light rounded-pill mb-md-0 mb-1" href="guestfolio.php?folio=<?php echo $row['folio']; ?>"><i class="fa-solid fa-cloud-arrow-up fa-xl" style="color: #0f97ff;"></i> upload</a>
                                        <?php endif; ?>
                                        <?php if ((empty($row['g_signature_path'])) && ($row['at_guestfolio'])): ?>
                                            <a class="btn btn-sm btn-default mb-md-0 mb-1">unsigned <i class="fa-solid fa-circle-exclamation" style="color: #FFD43B;"></i></a>
                                        <?php endif; ?>
                                        <?php if ($row['g_signature_path']): ?>
                                            <a class="btn btn-sm btn-default mb-md-0 mb-1">signed <i class="fa-solid fa-circle-check" style="color: #63E6BE;"></i></a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($row['at_ota_voucher']): ?>
                                            <a class="btn btn-sm btn-default mb-md-0 mb-1" href="<?php echo $row['at_ota_voucher']; ?>" target="_blank"><i class="fa-solid fa-file-zipper fa-xl"></i></a>
                                            <a class="btn btn-sm btn-default mb-md-0 mb-1">uploaded <i class="fa-solid fa-circle-check" style="color: #63E6BE;"></i></a>
                                        <?php endif; ?>
                                        <?php if (empty($row['at_ota_voucher'])): ?>
                                        <a class="btn btn-sm btn-light rounded-pill mb-md-0 mb-1" href="ota_voucher.php?folio=<?php echo $row['folio']; ?>"><i class="fa-solid fa-cloud-arrow-up fa-xl" style="color: #f82b85;"></i> upload</a>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $row['fname']; ?></td>
                                    <td><?php echo $row['folio']; ?></td>
                                    <td>
                                        <?php $foliostatus = trim($row['foliostatus']); ?>
                                        <?php if ($foliostatus == 'I'): ?>
                                            <span style="color: #15F5BA;">inHouse</span>
                                        <?php elseif ($foliostatus == 'O'): ?>
                                            <span style="color: #FF3EA5;">CheckOut</span>
                                        <?php elseif ($foliostatus == 'C'): ?>
                                            <span style="color: #15F5BA;">Confirm</span>
                                        <?php elseif ($foliostatus == 'G'): ?>
                                            <span style="color: #FF204E;">Guarantee</span>
                                        <?php elseif ($foliostatus == 'T'): ?>
                                            <span style="color: #43919B;">Tentative</span>
                                        <?php else: ?>
                                            <span class="text-muted">Unknown Status</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $row['room']; ?></td>
                                    <td><?php echo $row['roomtype']; ?></td>
                                    <td><?php echo $row['dateci']; ?></td>
                                    <td><?php echo $row['dateco']; ?></td>
                                    <td><?php echo $row['birthday']; ?></td>
                                    <td><?php echo $row['resv_phone']; ?></td>
                                    <td><?php echo $row['resv_email']; ?></td>
                                    <td>
                                        <?php if ($row['status'] === '0'): ?>
                                            <a class="btn btn-sm btn-default mb-md-0 mb-1">unchecked <i class="fa-solid fa-circle-question" style="color: #ff0000;"></i></a>
                                        <?php endif; ?>
                                        <?php if ($row['status'] === '1'): ?>
                                            <a class="btn btn-sm btn-default mb-md-0 mb-1">checked <i class="fa-solid fa-circle-check" style="color: #63E6BE;"></i></a>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $row['datecreate']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
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

<script>
$(document).ready(function(){
    $('#deviceModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var recipientId = button.data('id'); // Ekstrak info dari atribut data-id
        var modal = $(this);
        modal.find('.modal-body form').attr('action', 'regform_sign_update.php');
        modal.find('.modal-body form').append('<input type="hidden" name="regform_id" value="' + recipientId + '">');
    });

    // Event listener untuk tombol kedua
    $('#deviceModal2').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var recipientId = button.data('id'); // Ekstrak info dari atribut data-id
        var modal = $(this);
        modal.find('.modal-body form').attr('action', 'guestfolio_sign_update.php');
        modal.find('.modal-body form').append('<input type="hidden" name="guestfolio_id" value="' + recipientId + '">');
    });
});
</script>

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

<!-- Initialize Datepicker -->
<script>
    $(document).ready(function(){
        $('.custom-datepicker-input').datepicker({
            format: 'yyyy-mm-dd', // Format Tanggal (YYYY-MM-DD)
            autoclose: true,
            todayHighlight: true,
            clearBtn: true // Tampilkan tombol hapus
        });

        // Ketika nilai input berubah, serahkan formulir
        $('.custom-datepicker-input').on('change', function() {
            $('#filter').submit();
        });

        // Hapus inisialisasi DataTable sebelumnya
        if ($.fn.DataTable.isDataTable('#table-2')) {
            $('#table-2').DataTable().destroy();
        }

        // Inisialisasi DataTables
        var table = $('#table-2').DataTable({
                // Pengaturan-pengaturan DataTables lainnya
            });
                // Event listener untuk tombol "Enter" pada #search-input
        $('#search-input').keypress(function(event) {
            if (event.which === 13) {
                // Ambil nilai pencarian dari #search-input
                var searchText = $(this).val();

                // Lakukan pencarian pada tabel
                table.search(searchText).draw();
            }
        });

        // Handler untuk tombol reset filter
        $('#reset-filter').click(function() {
            $('.custom-datepicker-input').datepicker('setDate', null); // Mengatur tanggal datepicker ke null
            $('#filter').submit(); 
        });
    });
</script>


<!-- Page Specific JS File -->
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

<script>
// JavaScript
function showLoading() {
    document.getElementById('loading-overlay').style.display = 'block';
}

function hideLoading() {
    document.getElementById('loading-overlay').style.display = 'none';
}

function syncData() {
    showLoading();

    $.ajax({
        url: 'https://103.236.201.34:3000/replicate', // Ganti dengan URL sesuai dengan endpoint server Anda
        method: 'GET',
        success: function(response) {
            console.log('Response from server:', response);
            hideLoading();
            location.reload(); // Reload halaman setelah iziToast ditutup (opsional)
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            hideLoading();
        }
    });
};

</script>

<script src="../assets/js/page/modules-datatables.js"></script>