<?php
require './includes/check_session.php';

$page = 'Decline';
require './includes/partial.head.php';

// Get all unique values for filters
$scholarshipTypes = $pdo->query("SELECT DISTINCT s.scholarship_type FROM scholarship s INNER JOIN user_application a ON s.scholarship_id = a.scholarship_id WHERE a.approved = 2 ORDER BY s.scholarship_type")->fetchAll(PDO::FETCH_COLUMN);
$barangays = $pdo->query("SELECT DISTINCT barangay FROM user_application WHERE approved = 2 AND barangay IS NOT NULL ORDER BY barangay")->fetchAll(PDO::FETCH_COLUMN);

// Get total declined applications count
$totalDeclined = $pdo->query("SELECT COUNT(*) FROM user_application WHERE approved = 2")->fetchColumn();
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
}

.card {
  border-radius: 10px;
  box-shadow: var(--card-shadow);
  border: none;
}

.card-header {
  background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
  color: white;
  border-radius: 10px 10px 0 0 !important;
  padding: 15px 20px;
}

.card-header h3 {
  margin: 0;
  font-weight: 600;
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
}

.table tbody td {
  padding: 12px 15px;
  vertical-align: middle;
  border-bottom: 1px solid #e9ecef;
}

.table-hover tbody tr:hover {
  background-color: rgba(52, 152, 219, 0.05);
  transform: translateY(-1px);
  transition: all 0.2s ease;
}

.badge {
  font-size: 0.75rem;
  padding: 5px 10px;
  border-radius: 50px;
  font-weight: 500;
}

.btn {
  border-radius: 6px;
  font-weight: 500;
  transition: all 0.2s ease;
  padding: 6px 12px;
}

.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.btn-outline-success {
  color: var(--success-color);
  border-color: var(--success-color);
}

.btn-outline-success:hover {
  background-color: var(--success-color);
  border-color: var(--success-color);
}

.filter-section {
  background-color: #f8f9fa;
  border-radius: 8px;
  padding: 15px;
  margin-bottom: 20px;
  border-left: 4px solid var(--danger-color);
}

.filter-section label {
  font-weight: 600;
  color: var(--dark-color);
  margin-bottom: 5px;
}

.dataTables_wrapper .dataTables_filter input {
  border-radius: 6px;
  padding: 6px 12px;
  border: 1px solid #ced4da;
}

.dataTables_wrapper .dataTables_length select {
  border-radius: 6px;
  padding: 6px;
  border: 1px solid #ced4da;
}

.dt-buttons .btn {
  margin-right: 5px;
  margin-bottom: 5px;
}

.status-badge {
  display: inline-flex;
  align-items: center;
  gap: 5px;
}

.status-badge i {
  font-size: 0.8rem;
}

.action-buttons {
  display: flex;
  gap: 8px;
  justify-content: center;
}

.action-buttons .btn {
  flex: 1;
  max-width: 80px;
  text-align: center;
}

/* Custom scrollbar for table */
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

/* Preloader animation */
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

/* Responsive adjustments */
@media (max-width: 768px) {
  .filter-section .d-flex {
    flex-direction: column;
  }
  
  .filter-section .d-flex > div {
    width: 100%;
    margin-bottom: 10px;
  }
  
  .action-buttons {
    flex-direction: column;
    gap: 5px;
  }
  
  .action-buttons .btn {
    max-width: 100%;
  }
}

/* Custom checkbox for column visibility */
.buttons-columnVisibility.active {
  background-color: var(--success-color) !important;
  color: white !important;
  border-color: var(--success-color) !important;
}

/* Table row animations */
.table tbody tr {
  transition: all 0.3s ease;
}

/* Empty state styling */
.dataTables_empty {
  padding: 40px !important;
  text-align: center;
  color: #6c757d;
}

.dataTables_empty:before {
  content: "❌";
  font-size: 2rem;
  display: block;
  margin-bottom: 10px;
}

/* Results count styling */
.results-count {
  background: linear-gradient(135deg, var(--danger-color), #c0392b);
  color: white;
  border-radius: 8px;
  padding: 12px 15px;
  margin-bottom: 15px;
  border: none;
}

.results-count i {
  margin-right: 8px;
}
</style>

<script>
$(document).ready(function(){
  function updateColumnVisibilityColors(){
    $('.buttons-columnVisibility').each(function(){
      if ($(this).hasClass('active')) {
        $(this).css({
          'background-color':'#198754',
          'color':'#fff',
          'border-color':'#198754'
        });
      } else {
        $(this).css({
          'background-color':'',
          'color':'',
          'border-color':''
        });
      }
    });
  }
  setInterval(updateColumnVisibilityColors, 200);
});
</script>

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
            <h1 class="m-0">Reports</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Declined Applications</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-times-circle mr-2"></i>Declined Applications</h3>
              </div>

              <div class="card-body">
                <!-- Results Count -->
                <div class="results-count">
                  <i class="fas fa-info-circle"></i>
                  <strong>Total Declined Applications:</strong> <?= $totalDeclined ?> records
                </div>

                <!-- Filters Section -->
                <div class="filter-section">
                  <div class="d-flex flex-column flex-md-row gap-3">
                    <div class="flex-fill">
                      <label for="scholarshipFilter"><i class="fas fa-filter mr-1"></i>Filter by Scholarship Type:</label>
                      <select id="scholarshipFilter" class="form-control">
                        <option value="">All Scholarship Types</option>
                        <?php foreach ($scholarshipTypes as $type): ?>
                          <option value="<?= htmlspecialchars($type) ?>"><?= htmlspecialchars($type) ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="flex-fill">
                      <label for="barangayFilter"><i class="fas fa-map-marker-alt mr-1"></i>Filter by Barangay:</label>
                      <select id="barangayFilter" class="form-control">
                        <option value="">All Barangays</option>
                        <?php foreach ($barangays as $barangay): ?>
                          <option value="<?= htmlspecialchars($barangay) ?>"><?= htmlspecialchars($barangay) ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="table-responsive">
                  <table id="applicationTable" class="table table-hover display">
                    <thead>
                      <tr>
                        <th>Scholarship Type</th>
                        <th>Name</th>
                        <th>School Name</th>
                        <th>Year Level</th>
                        <th>School Year</th>
                        <th>Semester</th>
                        <th>Barangay</th>
                        <th>Date Applied</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $qry = $pdo->query("SELECT a.application_id, concat(a.b_fname, ' ', a.b_lname) as b_name,  s.scholarship_type, DATE_FORMAT(a.date_applied, '%M %d, %Y') as Date_Applied, a.barangay, a.school_name, a.year_level,a.school_year,a.semester FROM user_application as a inner join scholarship as s on s.scholarship_id = a.scholarship_id WHERE a.approved = 2 ORDER by a.date_applied;");
                      while ($row = $qry->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                        <tr>
                          <td><span class="badge badge-primary"><?= $row['scholarship_type'] ?></span></td>
                          <td class="font-weight-bold"><?= $row['b_name'] ?></td>
                          <td><?= $row['school_name'] ?></td>
                          <td><span class="badge badge-info"><?= $row['year_level'] ?></span></td>
                          <td><?= $row['school_year'] ?></td>
                          <td><span class="badge badge-secondary"><?= $row['semester'] ?></span></td>
                          <td><span class="badge badge-success"><?= $row['barangay'] ?></span></td>
                          <td><?= $row['Date_Applied'] ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Scholarship Type</th>
                        <th>Name</th>
                        <th>School Name</th>
                        <th>Year Level</th>
                        <th>School Year</th>
                        <th>Semester</th>
                        <th>Barangay</th>
                        <th>Date Applied</th>
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

  <?php include './components/announcementModal.php'; ?>
  <?php include_once 'includes/footer.php'; ?>
</div>

<?php require './includes/partial.script-imports.php'; ?>
<script>
$(document).ready(function(){
  // Initialize DataTable with enhanced options
  var table = $('#applicationTable').DataTable({
    responsive: true,
    lengthChange: true,
    autoWidth: false,
    pageLength: 10,
    order: [[7, 'desc']], // Default sort by date applied (descending)
    language: {
      search: "Search declined applications:",
      lengthMenu: "Show _MENU_ applications",
      info: "Showing _START_ to _END_ of _TOTAL_ declined applications",
      infoEmpty: "No declined applications available",
      infoFiltered: "(filtered from _MAX_ total applications)",
      paginate: {
        first: "First",
        last: "Last",
        next: "Next",
        previous: "Previous"
      }
    },
    dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
         '<"row"<"col-sm-12"tr>>' +
         '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
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
    initComplete: function () {
      var api = this.api();

      // Scholarship Type Filter
      api.columns(0).every(function () {
        var column = this;
        var select = $('#scholarshipFilter');

        select.on('change', function () {
          var val = $.fn.dataTable.util.escapeRegex($(this).val());
          column.search(val ? '^' + val + '$' : '', true, false).draw();
        });
      });

      // Barangay Filter
      api.columns(6).every(function () {
        var column = this;
        var select = $('#barangayFilter');

        select.on('change', function () {
          var val = $.fn.dataTable.util.escapeRegex($(this).val());
          column.search(val ? '^' + val + '$' : '', true, false).draw();
        });
      });
    }
  });

  // Apply custom styling to buttons after table initialization
  table.buttons().container().appendTo('#applicationTable_wrapper .col-md-6:eq(0)');
  
  // Update column visibility button colors
  function updateColumnVisibilityColors() {
    $('.buttons-columnVisibility').each(function() {
      if ($(this).hasClass('active')) {
        $(this).css({
          'background-color': '#27ae60',
          'color': '#fff',
          'border-color': '#27ae60'
        });
      } else {
        $(this).css({
          'background-color': '',
          'color': '',
          'border-color': ''
        });
      }
    });
  }

  // Update button colors on page load and when column visibility changes
  updateColumnVisibilityColors();
  setInterval(updateColumnVisibilityColors, 500);
  
  // Add event listener for column visibility changes
  table.on('column-visibility', function() {
    setTimeout(updateColumnVisibilityColors, 100);
  });
});
</script>
</body>
</html>