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
            <label for="datecreate" class="btn btn-light rounded-pill custom-datepicker-button"><i class="fa-solid fa-calendar-days"></i></label>        
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
                                <th>STATUS</th>
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
                                        <?php if ($row['status'] === '0'): ?>
                                            <a class="btn btn-sm btn-primary mb-md-0 mb-1" href="audit_checked.php?id=<?php echo $row['id']; ?>"><i class="fa-solid fa-circle-check fa-xl"></i></a>
                                        <?php endif; ?>
                                        <?php if ($row['status'] === '1'): ?>
                                            <a class="btn btn-sm btn-secondary mb-md-0 mb-1"><i class="fa-solid fa-circle-check fa-xl"></i></a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($row['at_regform']): ?>
                                            <a class="btn btn-sm btn-default mb-md-0 mb-1" href="<?php echo $row['at_regform']; ?>" target="_blank"><i class="fa-solid fa-file-pdf fa-xl" style="color: #B5120C;"></i></a>                                
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
                                    
                                    <td><?php echo $row['fname']; ?></td>
                                    <td><a class="btn btn-default" href="https://ecard.dafam.cloud/?folio=<?php echo $row['folio']; ?>" target="_blank"><?php echo $row['folio']; ?></a></td>
                                    <td><?php echo $row['room']; ?></td>
                                    <td><?php echo $row['roomtype']; ?></td>
                                    <td>
                                        <?php $foliostatus = trim($row['foliostatus']); ?>
                                        <?php if ($foliostatus == 'I'): ?>
                                            <span style="color: #36BA98;">inHouse</span>
                                        <?php elseif ($foliostatus == 'O'): ?>
                                            <span style="color: #C80036">CheckOut</span>
                                        <?php elseif ($foliostatus == 'C'): ?>
                                            <span style="color: #1679AB;">Confirm</span>
                                        <?php elseif ($foliostatus == 'G'): ?>
                                            <span style="color: #102C57;">Guarantee</span>
                                        <?php elseif ($foliostatus == 'T'): ?>
                                            <span style="color: #43919B;">Tentative</span>
                                        <?php else: ?>
                                            <span class="text-muted">Cancel</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $row['dateci']; ?></td>
                                    <td><?php echo $row['dateco']; ?></td>
                                    <td><?php echo $row['birthday']; ?></td>
                                    <td><?php echo $row['resv_phone']; ?></td>
                                    <td><?php echo $row['resv_email']; ?></td>
                                    <td>
                                        <?php if ($row['at_guestfolio']): ?>
                                            <a class="btn btn-sm btn-default mb-md-0 mb-1" href="<?php echo $row['at_guestfolio']; ?>" target="_blank"><i class="fa-solid fa-file-pdf fa-xl" style="color: #B5120C;"></i></a>
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
<!-- Bootstrap Datepicker JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="../assets/js/qrCode/qrcode.js"></script>

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

<script src="../assets/js/page/modules-datatables.js"></script>