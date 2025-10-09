<?php
require __DIR__ . '/includes/check_session.php';
require realpath(__DIR__ . '/../includes/config.php');

$page = 'Announcements';
require './includes/partial.head.php';
?>
<style>
:root {
  --primary-color: #3498db;
  --secondary-color: #2c3e50;
  --success-color: #27ae60;
  --warning-color: #f39c12;
  --danger-color: #e74c3c;
  --light-color: #ecf0f1;
  --dark-color: #2c3e50;
  --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  --hover-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
  --transition: all 0.3s ease;
}

.card {
  border-radius: 10px;
  box-shadow: var(--card-shadow);
  border: none;
  transition: var(--transition);
}

.card:hover {
  box-shadow: var(--hover-shadow);
}

.card-header {
  background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
  color: white;
  border-radius: 10px 10px 0 0 !important;
  padding: 15px 20px;
}

.card-header h5 {
  margin: 0;
  font-weight: 600;
  display: flex;
  align-items: center;
}

.card-header h5 i {
  margin-right: 8px;
}

/* ENHANCED BULK BUTTONS - More Noticeable */
.bulk-action-buttons {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  align-items: center;
}

.bulk-btn {
  padding: 10px 20px;
  font-weight: 600;
  border: none;
  border-radius: 8px;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 8px;
  min-width: 160px;
  justify-content: center;
  color: white;
}

.bulk-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.bulk-btn-primary {
  background: #3498db;
}

.bulk-btn-primary:hover {
  background: #2980b9;
}

.bulk-btn-success {
  background: #27ae60;
}

.bulk-btn-success:hover {
  background: #219653;
}

/* Selection counter badge */
.selection-badge {
  background: linear-gradient(135deg, #e74c3c, #c0392b);
  color: white;
  padding: 8px 16px;
  border-radius: 20px;
  font-weight: 600;
  font-size: 0.9rem;
  display: flex;
  align-items: center;
  gap: 6px;
  box-shadow: 0 2px 8px rgba(231, 76, 60, 0.3);
}

.table {
  border-collapse: separate;
  border-spacing: 0;
}

.table thead th {
  background-color: #f8f9fa;
  border-bottom: 2px solid #dee2e6;
  font-weight: 600;
  color: var(--dark-color);
  padding: 12px 15px;
  position: sticky;
  top: 0;
}

.table tbody td {
  padding: 12px 15px;
  vertical-align: middle;
  border-bottom: 1px solid #e9ecef;
  transition: var(--transition);
}

.table-hover tbody tr:hover {
  background-color: rgba(52, 152, 219, 0.05);
  transform: translateY(-1px);
}

.btn {
  border-radius: 6px;
  font-weight: 500;
  transition: var(--transition);
  padding: 6px 12px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 5px;
}

.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.btn-sm {
  padding: 5px 10px;
  font-size: 0.875rem;
}

.btn-group .btn {
  margin: 2px;
}

.filter-section {
  background-color: #f8f9fa;
  border-radius: 8px;
  padding: 15px;
  margin-bottom: 20px;
  border-left: 4px solid var(--primary-color);
}

.filter-section label {
  font-weight: 600;
  color: var(--dark-color);
  margin-bottom: 5px;
}

/* Checkbox styling */
.table input[type="checkbox"] {
  width: 18px;
  height: 18px;
  cursor: pointer;
}

/* Status badges */
.badge {
  font-size: 0.75rem;
  padding: 5px 10px;
  border-radius: 50px;
  font-weight: 500;
}

/* Modal enhancements */
.modal-content {
  border-radius: 10px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.modal-header {
  background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
  color: white;
  border-radius: 10px 10px 0 0;
}

.modal-header .close {
  color: white;
  opacity: 0.8;
}

.modal-header .close:hover {
  opacity: 1;
}

/* COLUMN VISIBILITY BUTTON STYLING - GREEN (#27ae60) */
.buttons-columnVisibility.active,
.buttons-columnVisibility.btn-success {
  background: linear-gradient(135deg, #27ae60, #219653) !important;
  color: white !important;
  border-color: #27ae60 !important;
}

.buttons-columnVisibility.active:hover,
.buttons-columnVisibility.btn-success:hover {
  background: linear-gradient(135deg, #219653, #1e8449) !important;
  color: white !important;
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(39, 174, 96, 0.3);
}

/* Ensure DataTables doesn't override our colors in dropdown */
.dt-button-collection .buttons-columnVisibility.active {
  background: #27ae60 !important;
  color: white !important;
  border-color: #27ae60 !important;
}

.dt-button-collection .buttons-columnVisibility.active:hover {
  background: #219653 !important;
  color: white !important;
}

/* Bulk Announce Modal specific styling */
#BulkAnnounceModal .modal-dialog {
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  min-height: calc(100vh - 2rem) !important;
  margin: 0 auto !important;
  padding: 1rem;
}

#BulkAnnounceModal .modal-content {
  width: min(1200px, 96vw) !important;
  max-width: 1200px !important;
  margin: auto !important;
  border-radius: 10px;
}

@media (max-width: 1199.98px) {
  #BulkAnnounceModal .modal-content {
    width: 80vw !important;
    max-width: 80vw !important;
  }
}

#BulkAnnounceModal .modal-body textarea { 
  min-height: 140px; 
}

#BulkAnnounceModal .modal-footer { 
  gap: .5rem; 
}

@media (max-width: 575.98px) {
  #BulkAnnounceModal .modal-footer { 
    flex-direction: column-reverse; 
  }
  #BulkAnnounceModal .modal-footer .btn { 
    width: 100%; 
  }
}

/* Table responsive improvements */
.table-responsive {
  border-radius: 8px;
  overflow: hidden;
}

.table-responsive::-webkit-scrollbar {
  height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb {
  background: var(--primary-color);
  border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
  background: var(--secondary-color);
}

/* Action buttons container */
.action-buttons {
  display: flex;
  flex-wrap: wrap;
  gap: 5px;
  justify-content: center;
}

.action-buttons .btn {
  flex: 1;
  min-width: 120px;
  text-align: center;
  white-space: nowrap;
}

/* Preloader enhancements */
.preloader {
  background: linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.7)), url('../resources/images/lallol.jpg') no-repeat;
  background-size: cover;
  background-position: center;
}

.preloader img {
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); }
}

/* Empty state styling */
.dataTables_empty {
  padding: 40px !important;
  text-align: center;
  color: #6c757d;
  font-style: italic;
}

.dataTables_empty:before {
  content: "📋";
  font-size: 2rem;
  display: block;
  margin-bottom: 10px;
}

/* Selection feedback */
tr.selected {
  background-color: rgba(52, 152, 219, 0.1) !important;
  position: relative;
}

tr.selected::after {
  content: "✓";
  position: absolute;
  left: 5px;
  top: 50%;
  transform: translateY(-50%);
  color: var(--success-color);
  font-weight: bold;
  font-size: 16px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .action-buttons {
    flex-direction: column;
  }
  
  .action-buttons .btn {
    max-width: 100%;
  }
  
  .btn-group {
    flex-direction: column;
    width: 100%;
  }
  
  .btn-group .btn {
    margin-bottom: 5px;
    border-radius: 6px !important;
  }
  
  .card-header .d-flex {
    flex-direction: column;
    gap: 15px;
  }
  
  .card-header .d-flex > div {
    width: 100%;
  }
  
  .bulk-action-buttons {
    flex-direction: column;
    width: 100%;
  }
  
  .bulk-btn {
    width: 100%;
    min-width: auto;
  }
}

/* Loading state */
.loading {
  opacity: 0.7;
  pointer-events: none;
}

/* Success/error message styling */
.alert-message {
  position: fixed;
  top: 20px;
  right: 20px;
  z-index: 9999;
  min-width: 300px;
  animation: slideIn 0.3s ease;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

@keyframes slideIn {
  from { transform: translateX(100%); opacity: 0; }
  to { transform: translateX(0); opacity: 1; }
}

/* Custom checkbox styling for select all */
#selectAll {
  transform: scale(1.2);
}

/* Scholarship filter improvements */
#scholarshipFilter {
  border-radius: 6px;
  transition: var(--transition);
}

#scholarshipFilter:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
}

/* Bulk actions header section */
.bulk-actions-header {
  background: linear-gradient(135deg, #f8f9fa, #e9ecef);
  border-radius: 8px;
  padding: 15px;
  margin-bottom: 20px;
  border: 2px dashed #dee2e6;
  transition: all 0.3s ease;
}

.bulk-actions-header.active {
  border-color: var(--primary-color);
  background: linear-gradient(135deg, #e3f2fd, #bbdefb);
}

.bulk-actions-header .bulk-stats {
  display: flex;
  align-items: center;
  gap: 15px;
  flex-wrap: wrap;
}

/* Pulse animation for bulk buttons when items are selected */
@keyframes pulse-glow {
  0% { box-shadow: 0 0 0 0 rgba(52, 152, 219, 0.7); }
  70% { box-shadow: 0 0 0 10px rgba(52, 152, 219, 0); }
  100% { box-shadow: 0 0 0 0 rgba(52, 152, 219, 0); }
}

.bulk-btn.has-selection {
  animation: pulse-glow 2s infinite;
}
</style>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../resources/images/lgulallo.png" alt="Logo" height="100" width="100">
  </div>

  <?php
  include_once 'includes/topNav.php';
  include_once 'includes/sideNav.php';
  ?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Payroll Announcement</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Payroll Announcements</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card shadow-sm">
              <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                  <i class="fas fa-table"></i>
                  <h5 class="mb-0 ml-2">Scholarship Applications</h5>
                </div>
                <div class="bulk-action-buttons">
                  <button id="bulkRemarksBtn" class="bulk-btn bulk-btn-primary" disabled>
                    <i class="fas fa-edit"></i>
                    <span>Bulk Remarks</span>
                  </button>
                  <button id="bulkAnnounceBtn" class="bulk-btn bulk-btn-success" disabled>
                    <i class="fas fa-bullhorn"></i>
                    <span>Bulk Announce</span>
                  </button>
                </div>
              </div>
              <div class="card-body">

                <!-- Bulk Actions Header Section -->
                <div class="bulk-actions-header" id="bulkActionsHeader">
                  <div class="bulk-stats">
                    <div class="selection-badge" id="selectionBadge">
                      <i class="fas fa-check-circle"></i>
                      <span id="selectedCount">0 applications selected</span>
                    </div>
                    <div class="d-flex gap-2">
                      <button id="selectAllBtn" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-check-double"></i> Select All
                      </button>
                      <button id="clearSelection" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-times"></i> Clear Selection
                      </button>
                    </div>
                  </div>
                </div>

                <!-- Scholarship Filter -->
                <div class="filter-section">
                  <div class="row align-items-end">
                    <div class="col-md-6">
                      <label for="scholarshipFilter"><strong>Filter by Scholarship:</strong></label>
                      <select id="scholarshipFilter" class="form-control">
                        <option value="">Show All</option>
                        <?php
                        $scholars = $pdo->query("SELECT DISTINCT scholarship_type FROM scholarship ORDER BY scholarship_type");
                        while ($s = $scholars->fetch(PDO::FETCH_ASSOC)) {
                          echo "<option value='".htmlspecialchars($s['scholarship_type'])."'>".htmlspecialchars($s['scholarship_type'])."</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-6 mt-2 mt-md-0">
                      <div class="d-flex align-items-center justify-content-end">
                        <span class="text-muted mr-3">
                          <i class="fas fa-info-circle text-primary"></i>
                          Select applications to enable bulk actions
                        </span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="table-responsive">
                  <table id="applicationTable" class="table table-bordered table-hover w-100">
                    <thead class="thead-light">
                      <tr>
                        <th width="40"><input type="checkbox" id="selectAll"></th>
                        <th>Scholarship Type</th>
                        <th>Name</th>
                        <th>Barangay</th>
                        <th>Amount</th>
                        <th>Claim Date</th>
                        <th>Remarks</th>
                        <th width="200">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $qry = $pdo->query("SELECT a.application_id,
                                                 concat(a.b_fname, ' ', a.b_lname) as b_name,
                                                 DATE_FORMAT(a.claim_date, '%M %d, %Y') as date_claimed,
                                                 s.scholarship_type, s.amount, a.barangay,
                                                 a.claim_date, a.claimed, a.remarks
                                          FROM user_application as a
                                          INNER JOIN scholarship as s
                                          ON s.scholarship_id = a.scholarship_id
                                          WHERE a.approved = 1;");

                      while ($row = $qry->fetch(PDO::FETCH_ASSOC)) {
                        $remarks = htmlspecialchars($row['remarks'] ?? '', ENT_QUOTES, 'UTF-8');
                        $claimedClass = $row['claim_date'] ? 'table-success' : '';
                      ?>
                      <tr class="<?= $claimedClass ?>">
                        <td><input type="checkbox" class="row-select" value="<?= $row['application_id'] ?>"></td>
                        <td><?= htmlspecialchars($row['scholarship_type']) ?></td>
                        <td class="font-weight-bold"><?= htmlspecialchars($row['b_name']) ?></td>
                        <td><?= htmlspecialchars($row['barangay']) ?></td>
                        <td class="text-success font-weight-bold">&#8369;<?= number_format($row['amount'], 2) ?></td>
                        <td><?= htmlspecialchars($row['date_claimed']) ?></td>
                        <td class="text-muted"><?= $remarks ?: '<span class="text-muted font-italic">No remarks</span>' ?></td>
                        <td>
                          <div class="action-buttons">
                            <?php if ($row['claim_date'] == NULL) { ?>
                              <button class="btn btn-outline-success btn-sm individual-announce"
                                      data-id="<?= $row['application_id'] ?>"
                                      data-scholarship="<?= htmlspecialchars($row['scholarship_type']) ?>"
                                      data-name="<?= htmlspecialchars($row['b_name']) ?>"
                                      data-barangay="<?= htmlspecialchars($row['barangay']) ?>"
                                      data-amount="<?= $row['amount'] ?>">
                                <i class="fas fa-bullhorn"></i> Announce
                              </button>
                              <button class="btn btn-outline-primary btn-sm individual-remarks"
                                      data-id="<?= $row['application_id'] ?>"
                                      data-remarks="<?= $remarks ?>">
                                <i class="fas fa-edit"></i> Remarks
                              </button>
                            <?php } else { ?>
                              <button class="btn btn-outline-success btn-sm toggle-claim"
                                      data-id="<?= $row['application_id'] ?>"
                                      data-claimed="<?= $row['claimed'] ?>">
                                <i class="fas fa-check"></i> <?= $row['claimed'] ? 'Unclaim' : 'Set Claim' ?>
                              </button>
                            <?php } ?>
                          </div>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th>Scholarship Type</th>
                        <th>Name</th>
                        <th>Barangay</th>
                        <th>Amount</th>
                        <th>Claim Date</th>
                        <th>Remarks</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php include_once 'includes/footer.php'; ?>
</div>

<?php require './includes/partial.script-imports.php'; ?>

<script>
$(document).ready(function() {
  let table = $('#applicationTable').DataTable({
    responsive: true,
    lengthChange: true,
    autoWidth: false,
    pageLength: 25,
    language: {
      search: "Search applications:",
      lengthMenu: "Show _MENU_ applications",
      info: "Showing _START_ to _END_ of _TOTAL_ applications",
      infoEmpty: "No applications available",
      infoFiltered: "(filtered from _MAX_ total applications)",
      paginate: {
        first: "First",
        last: "Last",
        next: "Next",
        previous: "Previous"
      }
    },
    buttons: [
      {
        extend: 'copy',
        className: 'btn btn-light',
        text: '<i class="fas fa-copy"></i> Copy'
      },
      {
        extend: 'csv',
        className: 'btn btn-light',
        text: '<i class="fas fa-file-csv"></i> CSV'
      },
      {
        extend: 'excel',
        className: 'btn btn-light',
        text: '<i class="fas fa-file-excel"></i> Excel'
      },
      {
        extend: 'pdf',
        className: 'btn btn-light',
        text: '<i class="fas fa-file-pdf"></i> PDF'
      },
      {
        extend: 'print',
        className: 'btn btn-light',
        text: '<i class="fas fa-print"></i> Print'
      },
      {
        extend: 'colvis',
        className: 'btn btn-light',
        text: '<i class="fas fa-columns"></i> Columns'
      }
    ],
    dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
         '<"row"<"col-sm-12"tr>>' +
         '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
    columnDefs: [
      { orderable: false, targets: [0, 7] }
    ],
    order: [[1, 'asc'], [2, 'asc']],
    initComplete: function() {
      // Apply custom styling to buttons after table initialization
      this.api().buttons().container().appendTo('#applicationTable_wrapper .col-md-6:eq(0)');
      
      // Initialize column visibility button colors
      updateColumnVisibilityColors();
    }
  });

  // Function to update column visibility button colors
  function updateColumnVisibilityColors() {
    $('.buttons-columnVisibility').each(function(){
      var $btn = $(this);
      if ($btn.hasClass('active')) {
        $btn.addClass('btn-success').removeClass('btn-light');
      } else {
        $btn.addClass('btn-light').removeClass('btn-success');
      }
    });
  }

  // Update column visibility colors when visibility changes
  table.on('column-visibility', function() {
    setTimeout(updateColumnVisibilityColors, 100);
  });

  // Update on button click
  $(document).on('click', '.buttons-columnVisibility', function() {
    setTimeout(updateColumnVisibilityColors, 100);
  });

  // Select all checkboxes
  $('#selectAll, #selectAllBtn').on('click', function(){
    let isChecked = $('#selectAll').prop('checked');
    if (!isChecked) {
      $('#selectAll').prop('checked', true);
      $('.row-select').prop('checked', true);
    }
    updateSelectedCount();
    highlightSelectedRows();
  });

  // Individual checkbox selection
  $(document).on('change', '.row-select', function() {
    updateSelectedCount();
    highlightSelectedRows();
    
    // Update select all checkbox state
    let allChecked = $('.row-select:checked').length === $('.row-select').length;
    $('#selectAll').prop('checked', allChecked);
  });

  // Clear selection button
  $('#clearSelection').on('click', function() {
    $('.row-select, #selectAll').prop('checked', false);
    updateSelectedCount();
    highlightSelectedRows();
  });

  // Update selected count display
  function updateSelectedCount() {
    let count = $('.row-select:checked').length;
    let countText = count + ' application' + (count !== 1 ? 's' : '') + ' selected';
    $('#selectedCount').text(countText);
    
    // Update selection badge
    let selectionBadge = $('#selectionBadge');
    if (count > 0) {
      selectionBadge.show();
    } else {
      selectionBadge.hide();
    }
    
    // Enable/disable bulk buttons based on selection
    if (count > 0) {
      $('#bulkRemarksBtn, #bulkAnnounceBtn').prop('disabled', false);
      $('#bulkActionsHeader').addClass('active');
      $('.bulk-btn').addClass('has-selection');
    } else {
      $('#bulkRemarksBtn, #bulkAnnounceBtn').prop('disabled', true);
      $('#bulkActionsHeader').removeClass('active');
      $('.bulk-btn').removeClass('has-selection');
    }
  }

  // Highlight selected rows
  function highlightSelectedRows() {
    $('tbody tr').removeClass('selected');
    $('.row-select:checked').each(function() {
      $(this).closest('tr').addClass('selected');
    });
  }

  // Individual announce button handler - using your existing modal
  $(document).on('click', '.individual-announce', function() {
    let applicationId = $(this).data('id');
    let scholarshipType = $(this).data('scholarship');
    let beneficiaryName = $(this).data('name');
    let barangay = $(this).data('barangay');
    let amount = $(this).data('amount');
    
    // Use your existing announceScholar function
    announceScholar(applicationId, scholarshipType, beneficiaryName, barangay, amount);
    $('#AnnounceModal').modal('show');
  });

  // Individual remarks button handler
  $(document).on('click', '.individual-remarks', function() {
    let applicationId = $(this).data('id');
    let remarks = $(this).data('remarks');
    
    $('#remarks_application_id').val(applicationId);
    $('#remarks_text').val(remarks);
    $('#RemarksModal').modal('show');
  });

  // Bulk buttons with enhanced feedback
  $('#bulkRemarksBtn').on('click', function(){
    let ids = $('.row-select:checked').map(function(){ return this.value; }).get();
    if(ids.length === 0){ 
      showAlert('Please select at least one application.', 'warning');
      return; 
    }
    $('#remarks_application_id').val(ids.join(','));
    $('#remarks_text').val('');
    $('#RemarksModal').modal('show');
    
    // Show confirmation
    showAlert(`Opening remarks editor for ${ids.length} selected applications`, 'info');
  });

  $('#bulkAnnounceBtn').on('click', function(){
    let ids = $('.row-select:checked').map(function(){ return this.value; }).get();
    if(ids.length === 0){ 
      showAlert('Please select at least one application.', 'warning');
      return; 
    }
    $('#bulk_ids').val(ids.join(','));
    
    // Set today's date as default for bulk announce
    let today = new Date().toISOString().split('T')[0];
    $('#BulkAnnounceModal input[name="claim_date"]').val(today);
    
    $('#BulkAnnounceModal').modal('show');
    
    // Show confirmation
    showAlert(`Preparing announcement for ${ids.length} selected applications`, 'info');
  });

  // Filter by Scholarship Type
  $('#scholarshipFilter').on('change', function(){
    let val = $(this).val();
    table.column(1).search(val).draw(); // column 1 = Scholarship Type
  });

  // Toggle claim with loading state
  $(document).on('click','.toggle-claim', function(){
    let btn = $(this);
    let id = btn.data('id');
    
    // Add loading state
    btn.prop('disabled', true).addClass('loading');
    
    $.post('toggle_claim.php', {application_id:id}, function(resp){
      try {
        let data = JSON.parse(resp);
        if (data.success) {
          if (data.claimed == 1) {
            btn.removeClass('btn-outline-success').addClass('btn-outline-danger')
               .html('<i class="fas fa-times"></i> Unclaim')
               .data('claimed', 1);
            showAlert('Application marked as claimed successfully!', 'success');
          } else {
            btn.removeClass('btn-outline-danger').addClass('btn-outline-success')
               .html('<i class="fas fa-check"></i> Set Claim')
               .data('claimed', 0);
            showAlert('Application unclaimed successfully!', 'success');
          }
        } else {
          showAlert(data.message || 'An error occurred.', 'error');
        }
      } catch (e) {
        console.error(e, resp);
        showAlert('Unexpected response from server.', 'error');
      }
    }).always(function() {
      // Remove loading state
      btn.prop('disabled', false).removeClass('loading');
    });
  });

  // Show alert message
  function showAlert(message, type) {
    // Remove existing alerts
    $('.alert-message').remove();
    
    let alertClass = type === 'success' ? 'alert-success' : 
                    type === 'warning' ? 'alert-warning' : 
                    type === 'info' ? 'alert-info' : 'alert-danger';
    
    let icon = type === 'success' ? 'fa-check-circle' : 
              type === 'warning' ? 'fa-exclamation-triangle' : 
              type === 'info' ? 'fa-info-circle' : 'fa-exclamation-circle';
    
    let alert = $(`
      <div class="alert alert-dismissible ${alertClass} alert-message">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fas ${icon} mr-2"></i> ${message}
      </div>
    `);
    
    $('body').append(alert);
    
    // Auto remove after 5 seconds
    setTimeout(function() {
      alert.alert('close');
    }, 5000);
  }

  // Initialize selected count and hide selection badge initially
  updateSelectedCount();
  $('#selectionBadge').hide();
});

// Your existing announceScholar function
function announceScholar(app_id, scholarship_type, beneficiary_name, barangay, amount) {
    $("#application_id").val(app_id);
    $("#scholarship_type").val(scholarship_type);
    $("#beneficiary_name").val(beneficiary_name);
    $("#barangay").val(barangay);
    $("#amount").val(amount);
    
    // Set today's date as minimum
    const claim_date = document.getElementById("claim_date");
    claim_date.min = new Date().toISOString().split("T")[0];
    claim_date.value = new Date().toISOString().split("T")[0];
}
</script>

<!-- Your Existing Individual Announce Modal -->
<div class="modal fade" id="AnnounceModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Announce Scholar</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="actions/action.announce-scholar.php" method="post">
                <input type="hidden" name="application_id" id="application_id">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label>Scholarship Type</label>
                            <input type="text" class="form-control" name="scholarship_type" id="scholarship_type" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label>Name</label>
                            <input type="text" class="form-control" name="beneficiary_name" id="beneficiary_name" readonly>
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="form-group col-sm-12">
                            <label>Barangay</label>
                            <textarea class="form-control" name="barangay" id="barangay" readonly></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label>Amount</label>
                            <input type="number" class="form-control" name="amount" id="amount" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label>Claim Date</label>
                            <input type="date" class="form-control" name="claim_date" id="claim_date">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class='fa fa-times' aria-hidden='true'></i> Cancel</button>
                    <button type="submit" class="btn btn-primary" name="announce-scholar"><i class='fa fa-check' aria-hidden='true'></i> Post Announcement</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Remarks Modal -->
<div class="modal fade" id="RemarksModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
    <form method="POST" action="<?= BASE_URL ?>update_remarks.php" class="w-100">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Remarks</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="application_id" id="remarks_application_id">
          <div class="form-group mb-0">
            <label for="remarks_text">Remarks</label>
            <textarea class="form-control" name="remarks" id="remarks_text" rows="6" placeholder="Enter remarks here..."></textarea>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="save_remarks" class="btn btn-primary">
            <i class="fas fa-save mr-1"></i> Save Changes
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Bulk Announcement Modal -->
<div class="modal fade" id="BulkAnnounceModal" tabindex="-1" role="dialog" aria-labelledby="BulkAnnounceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <form method="POST" action="<?= BASE_URL ?>bulk_announce.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="BulkAnnounceModalLabel">Bulk Announcement</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="application_ids" id="bulk_ids">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>Claim Date</label>
              <input type="date" class="form-control" name="claim_date" required>
            </div>
            <div class="form-group col-md-8">
              <label>Remarks</label>
              <textarea class="form-control" name="remarks" rows="3" placeholder="Enter announcement remarks..."></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="bulk_announce" class="btn btn-success">
            <i class="fas fa-bullhorn mr-1"></i> Announce
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

</body>
</html>