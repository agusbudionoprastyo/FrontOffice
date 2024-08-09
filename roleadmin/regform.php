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
        <div class="col-auto">
            <button type="button" class="btn btn-dark rounded-pill" onclick="printSelectedQRCode();"><i class="fa-solid fa-print fa-xl"></i> PRINT LABEL</button>
        </div>  
        <div class="col-auto">
            <button type="button" class="btn btn-primary rounded-pill" onclick="syncData();"><i class="fa-solid fa-rotate fa-beat-fade"></i> SYNC DATA</button>
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
                        <tbody>
                            <?php
                            // // Default SQL query
                            // $sql = "SELECT * FROM FOGUEST";

                            // // Check if start date is provided
                            // if (isset($_GET['start_date']) && !empty($_GET['start_date'])) {
                            //     $start_date = $_GET['start_date'];
                            //     $sql .= " WHERE dateci = '$start_date'";
                            // }

                            // // Check if end date is provided
                            // if (isset($_GET['end_date']) && !empty($_GET['end_date'])) {
                            //     $end_date = $_GET['end_date'];
                            //     // Add WHERE clause or append to existing one
                            //     $sql .= isset($start_date) ? " AND dateco = '$end_date'" : " WHERE dateco = '$end_date'";
                            // }

                            // // Check if create date is provided
                            // if (isset($_GET['datecreate']) && !empty($_GET['datecreate']) && empty($_GET['start_date']) && empty($_GET['end_date'])) {
                            //     $datecreate = $_GET['datecreate'];
                            //     $sql .= " WHERE datecreate = '$datecreate'";
                            // }

                            // // Add ORDER BY clause
                            // $sql .= " ORDER BY folio DESC";
                            
                            // Default SQL query
                            $sql = "SELECT * FROM FOGUEST WHERE foliostatus NOT IN ('X', 'O')";

                            // Array untuk parameter query
                            $params = [];
                            $types = '';

                            // Check if start date is provided
                            if (isset($_GET['start_date']) && !empty($_GET['start_date'])) {
                                $start_date = $_GET['start_date'];
                                $sql .= " AND dateci = ?";
                                $params[] = $start_date;
                                $types .= 's';
                            }

                            // Check if end date is provided
                            if (isset($_GET['end_date']) && !empty($_GET['end_date'])) {
                                $end_date = $_GET['end_date'];
                                $sql .= " AND dateco = ?";
                                $params[] = $end_date;
                                $types .= 's';
                            }

                            // Check if create date is provided
                            if (isset($_GET['datecreate']) && !empty($_GET['datecreate']) && empty($_GET['start_date']) && empty($_GET['end_date'])) {
                                $datecreate = $_GET['datecreate'];
                                $sql .= " AND datecreate = ?";
                                $params[] = $datecreate;
                                $types .= 's';
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
                                            <button class="btn btn-sm btn-default mb-md-0 mb-1" data-toggle="modal" data-target="#deviceModal" data-id="<?php echo $row['folio']; ?>"><i class="fa-solid fa-paper-plane fa-xl" style="color: #f82b85;"></i></button>
                                        <?php endif; ?>
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
                                    <td>
                                        <?php if (!empty($row['room'])): ?>
                                          <input type="checkbox" class="btn rowCheckbox" name="selectedRows[]" id="selectedRows"
                                          value="<?php echo $row['folio']; ?>"
                                            data-room="<?php echo htmlspecialchars($row['room']); ?>"
                                              data-folio="<?php echo htmlspecialchars($row['folio']); ?>">
                                              <button type="button" class="btn btn-default rounded-pill" onclick="printRow(this)"><i class="fa-solid fa-print fa-xl"></i></button>
                                          <?php endif; ?>
                                          
                                        <?php echo $row['room']; ?>  
                                    </td>
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
                                        <?php if ((empty($row['g_signature_path'])) && ($row['at_guestfolio'])): ?>
                                            <button class="btn btn-sm btn-default mb-md-0 mb-1" data-toggle="modal" data-target="#deviceModal2" data-id="<?php echo $row['folio']; ?>">
                                                <i class="fa-solid fa-paper-plane fa-xl" style="color: #f82b85;"></i>
                                            </button>
                                        <?php endif; ?>
                                        <?php if ($row['at_guestfolio']): ?>
                                            <a class="btn btn-sm btn-default mb-md-0 mb-1" href="<?php echo $row['at_guestfolio']; ?>" target="_blank"><i class="fa-solid fa-file-pdf fa-xl" style="color: #B5120C;"></i></a>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- Bootstrap Datepicker JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script type="text/javascript" src="../assets/js/qrCode/qrcode.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcode-generator/1.4.4/qrcode.min.js" integrity="sha512-ZDSPMa/JM1D+7kdg2x3BsruQ6T/JpJo3jWDWkCZsP+5yVyp1KfESqLI+7RqB5k24F7p2cV7i2YHh/890y6P6Sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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