<?php
require './includes/check_session.php';

$page = 'Scholarships';
require './includes/partial.head.php';
?>

<style>
:root {
  --primary-color: #3498db;
  --secondary-color: #2c3e50;
  --success-color: #27ae60;
  --warning-color: #f39c12;
  --danger-color: #e74c3c;
  --info-color: #17a2b8;
  --light-color: #ecf0f1;
  --dark-color: #2c3e50;
  --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  --hover-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
}

.card {
  border-radius: 12px;
  box-shadow: var(--card-shadow);
  border: none;
  transition: all 0.3s ease;
}

.card:hover {
  box-shadow: var(--hover-shadow);
}

.card-header {
  background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
  color: white;
  border-radius: 12px 12px 0 0 !important;
  padding: 20px;
  border-bottom: none;
}

.card-header h3 {
  margin: 0;
  font-weight: 600;
  font-size: 1.5rem;
}

.table {
  border-collapse: separate;
  border-spacing: 0;
  width: 100%;
}

.table thead th {
  background: linear-gradient(to bottom, #f8f9fa, #e9ecef);
  border-bottom: 2px solid var(--primary-color);
  font-weight: 600;
  color: var(--dark-color);
  padding: 15px 12px;
  position: sticky;
  top: 0;
  z-index: 10;
}

.table tbody td {
  padding: 15px 12px;
  vertical-align: middle;
  border-bottom: 1px solid #e9ecef;
  transition: all 0.2s ease;
}

.table-hover tbody tr:hover {
  background-color: rgba(52, 152, 219, 0.08);
  transform: translateY(-1px);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.scholarship-image {
  width: 80px;
  height: 80px;
  border-radius: 10px;
  object-fit: cover;
  border: 2px solid #e9ecef;
  transition: all 0.3s ease;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.scholarship-image:hover {
  transform: scale(1.05);
  border-color: var(--primary-color);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.amount-badge {
  color: var(--dark-color);
  padding: 6px 12px;
  border-radius: 20px;
  font-weight: 600;
  font-size: 0.9rem;
}

.btn {
  border-radius: 8px;
  font-weight: 500;
  transition: all 0.3s ease;
  padding: 8px 16px;
  border: none;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.btn-outline-success {
  background: linear-gradient(135deg, var(--success-color), #2ecc71);
  color: white;
  border: none;
  box-shadow: 0 2px 4px rgba(39, 174, 96, 0.3);
}

.btn-outline-success:hover {
  background: linear-gradient(135deg, #229954, var(--success-color));
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(39, 174, 96, 0.4);
}

.btn-outline-primary {
  background: linear-gradient(135deg, var(--primary-color), #2980b9);
  color: white;
  border: none;
  box-shadow: 0 2px 4px rgba(52, 152, 219, 0.3);
}

.btn-outline-primary:hover {
  background: linear-gradient(135deg, #2980b9, var(--primary-color));
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(52, 152, 219, 0.4);
}

.action-buttons {
  display: flex;
  gap: 8px;
  justify-content: center;
}

.requirement-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 4px;
  max-width: 300px;
}

.requirement-tag {
  color: var(--dark-color);
  padding: 4px 8px;
  border-radius: 12px;
  font-size: 0.75rem;
  font-weight: 500;
}

.date-badge {
  color: var(--dark-color);
  padding: 4px 8px;
  border-radius: 6px;
  font-size: 0.8rem;
  font-weight: 500;
}

.dataTables_wrapper .dataTables_filter input {
  border-radius: 8px;
  padding: 8px 12px;
  border: 2px solid #e9ecef;
  transition: all 0.3s ease;
}

.dataTables_wrapper .dataTables_filter input:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
}

.dataTables_wrapper .dataTables_length select {
  border-radius: 8px;
  padding: 6px;
  border: 2px solid #e9ecef;
}

.dt-buttons .btn {
  margin-right: 5px;
  margin-bottom: 5px;
  background: white;
  color: var(--dark-color);
  border: 1px solid #dee2e6;
}

.dt-buttons .btn:hover {
  background: var(--primary-color);
  color: white;
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
  .table-responsive {
    font-size: 0.875rem;
  }
  
  .scholarship-image {
    width: 60px;
    height: 60px;
  }
  
  .action-buttons {
    flex-direction: column;
    gap: 5px;
  }
  
  .btn {
    padding: 6px 12px;
    font-size: 0.875rem;
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
  font-size: 1.1rem;
}

.dataTables_empty:before {
  content: "🎓";
  font-size: 3rem;
  display: block;
  margin-bottom: 15px;
}

/* Search inputs in table footer */
tfoot input {
  width: 100% !important;
  padding: 8px;
  border-radius: 6px;
  border: 2px solid #e9ecef;
  transition: all 0.3s ease;
}

tfoot input:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
  outline: none;
}

/* Status indicators */
.status-active {
  background: linear-gradient(135deg, var(--success-color), #2ecc71);
  color: white;
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 0.8rem;
  font-weight: 500;
}

.status-upcoming {
  background: linear-gradient(135deg, var(--warning-color), #f1c40f);
  color: white;
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 0.8rem;
  font-weight: 500;
}

.status-expired {
  background: linear-gradient(135deg, var(--danger-color), #c0392b);
  color: white;
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 0.8rem;
  font-weight: 500;
}

/* Header action button */
.header-actions {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 15px;
}

.header-title {
  display: flex;
  align-items: center;
  gap: 10px;
}

.header-title i {
  font-size: 1.8rem;
  color: rgba(255, 255, 255, 0.9);
}

/* Description text truncation */
.description-cell {
  max-width: 300px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  cursor: pointer;
  transition: all 0.3s ease;
}

.description-cell:hover {
  white-space: normal;
  overflow: visible;
  background: white;
  z-index: 5;
  position: relative;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  border-radius: 6px;
  padding: 10px;
}
</style>

<script>
$(document).ready(function(){
  // Initialize DataTable with enhanced options
  var table = $('#scholarshipsTable').DataTable({
    responsive: true,
    lengthChange: true,
    autoWidth: false,
    pageLength: 10,
    order: [[0, 'desc']],
    language: {
      search: "Search scholarships:",
      lengthMenu: "Show _MENU_ scholarships",
      info: "Showing _START_ to _END_ of _TOTAL_ scholarships",
      infoEmpty: "No scholarships available",
      infoFiltered: "(filtered from _MAX_ total scholarships)",
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
        text: '<i class="fas fa-copy mr-1"></i> Copy'
      },
      {
        extend: 'csv',
        className: 'btn btn-light',
        text: '<i class="fas fa-file-csv mr-1"></i> CSV'
      },
      {
        extend: 'excel',
        className: 'btn btn-light',
        text: '<i class="fas fa-file-excel mr-1"></i> Excel'
      },
      {
        extend: 'pdf',
        className: 'btn btn-light',
        text: '<i class="fas fa-file-pdf mr-1"></i> PDF'
      },
      {
        extend: 'print',
        className: 'btn btn-light',
        text: '<i class="fas fa-print mr-1"></i> Print'
      },
      {
        extend: 'colvis',
        className: 'btn btn-light',
        text: '<i class="fas fa-columns mr-1"></i> Columns'
      }
    ],
    initComplete: function () {
      // Apply search to all footer inputs
      this.api().columns().every(function () {
        var column = this;
        var title = $(column.header()).text();
        
        if (title !== 'Image' && title !== 'Action') {
          $('input', this.footer()).on('keyup change clear', function () {
            if (column.search() !== this.value) {
              column.search(this.value).draw();
            }
          });
        }
      });
    }
  });

  // Apply custom styling to buttons after table initialization
  table.buttons().container().appendTo('#scholarshipsTable_wrapper .col-md-6:eq(0)');
  
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

  // Date range picker initialization
  $('#scholarship_date_range').daterangepicker({
    startDate: moment().startOf('month'),
    endDate: moment().endOf('month'),
    minDate: moment().startOf('day'),
    ranges: {
      'Today': [moment(), moment()],
      'Tomorrow': [moment().add(1, 'days'), moment().add(1, 'days')],
      'Next 7 Days': [moment(), moment().add(6, 'days')],
      'Next 30 Days': [moment(), moment().add(29, 'days')],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Next Month': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
    },
    opens: 'left',
    locale: {
      format: 'MM/DD/YYYY hh:mm A'
    }
  });
});

function editScholarship(id, scho_type, amount, description, image_filename, start_date, end_date) {
  $('#edit_scholarship_id').val(id)
  $('#edit_scholarship_type').val(scho_type)
  $('#edit_amount').val(amount)
  $('#edit_description').val(description)
  $('#edit-upload-img').attr("src", "../resources/image/" + image_filename);
 
  var dateRange = start_date + ' - ' + end_date;

  $('#edit_scholarship_date_range').daterangepicker({
    startDate: start_date,
    endDate: end_date,
    timePicker: true,
    locale: {
      format: 'YYYY-MM-DD HH:mm:ss'
    }
  });

  $('#edit_scholarship_date_range').val(dateRange);

  $("#edit_requirement").load("components/View_Edit_Requirements.php", {
    id: id
  });
}

function delete_scholarship(id, image_filename) {
  $('#delete_scholarship_id').val(id)
  $('#image_filename').val(image_filename)
}
</script>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../resources/images/lgulallo.png" alt="Logo" height="100" width="100">
        </div>

        <?php
        // include Top Navigation Bar
        include_once 'includes/topNav.php';
        // include Side Navigation Bar
        include_once 'includes/sideNav.php';
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><i class="fas fa-graduation-cap mr-2"></i>Scholarship</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Scholarships</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            // include Add Modal Scholarship
            include_once './components/addModal_scholarship.php';
            // include Edit Modal Scholarship
            include_once './components/editModal_scholarship.php';
            // include Delete Modal Scholarship
            include_once './components/deleteModal_scholarship.php';
            ?>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="header-actions">
                                        <div class="header-title">
                                            <i class="fas fa-graduation-cap"></i>
                                            <h3 class="card-title mb-0">Available Scholarships</h3>
                                        </div>
                                        <button class="btn btn-outline-success" data-toggle="modal" data-target="#addScholarship">
                                            <i class="fas fa-plus-circle mr-1"></i>Add New Scholarship
                                        </button>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="scholarshipsTable" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Scholarship Type</th>
                                                    <th>Amount</th>
                                                    <th>Description</th>
                                                    <th>Requirements</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $qry = $pdo->query("SELECT s.scholarship_id, s.scholarship_type, s.image_filename, s.amount, s.description, s.start_date, s.end_date, GROUP_CONCAT(rd.requirement_name SEPARATOR ', ') AS concatenated_value
                                                FROM scholarship AS s
                                                INNER JOIN requirement_data AS rd ON s.scholarship_id = rd.scholarship_id
                                                GROUP BY s.scholarship_id
                                                ORDER BY s.scholarship_id DESC;");
                                                
                                                while ($row = $qry->fetch(PDO::FETCH_ASSOC)) {
                                                    $datetimeValuestart = $row['start_date'];
                                                    $timestampstart = strtotime($datetimeValuestart);
                                                    $startformattedDate = date('F d, Y h:i A', $timestampstart);

                                                    $datetimeValueend = $row['end_date'];
                                                    $timestampend = strtotime($datetimeValueend);
                                                    $endformattedDate = date('F d, Y h:i A', $timestampend);

                                                    $imagePath = "../resources/image/" . $row['image_filename'];
                                                    $defaultImagePath = "../resources/image/default.jpg";
                                                    
                                                    // Split requirements for better display
                                                    $requirements = explode(', ', $row['concatenated_value']);
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php if (file_exists($imagePath)) { ?>
                                                                <img src="<?= $imagePath ?>" class="scholarship-image" alt="<?= $row['scholarship_type'] ?>">
                                                            <?php } else { ?> 
                                                                <img src="<?= $defaultImagePath ?>" class="scholarship-image" alt="Default Scholarship Image">
                                                            <?php } ?> 
                                                        </td>
                                                        <td><strong><?= $row['scholarship_type'] ?></strong></td>
                                                        <td>
                                                            <span class="amount-badge">
                                                                ₱<?= number_format($row['amount'], 2) ?>
                                                            </span>
                                                        </td>
                                                        <td class="description-cell" title="<?= htmlspecialchars($row['description']) ?>">
                                                            <?= strlen($row['description']) > 100 ? substr($row['description'], 0, 100) . '...' : $row['description'] ?>
                                                        </td>
                                                        <td>
                                                            <div class="requirement-tags">
                                                                <?php foreach(array_slice($requirements, 0, 3) as $req): ?>
                                                                    <span class="requirement-tag"><?= $req ?></span>
                                                                <?php endforeach; ?>
                                                                <?php if(count($requirements) > 3): ?>
                                                                    <span class="requirement-tag">+<?= count($requirements) - 3 ?> more</span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="date-badge">
                                                                <i class="far fa-calendar-alt mr-1"></i><?= $startformattedDate ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="date-badge">
                                                                <i class="far fa-calendar-check mr-1"></i><?= $endformattedDate ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="action-buttons">
                                                                <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#editScholarship" 
                                                                    onclick="editScholarship(`<?= $row['scholarship_id'] ?>`,`<?= addslashes($row['scholarship_type']) ?>`,`<?= $row['amount'] ?>`,`<?= addslashes($row['description']) ?>`,`<?= $row['image_filename'] ?>`,`<?= $row['start_date'] ?>`, `<?= $row['end_date'] ?>`);"
                                                                    title="Edit Scholarship">
                                                                    <i class="fas fa-edit"></i> Edit
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th><input type="text" placeholder="Search type" class="form-control form-control-sm" /></th>
                                                    <th><input type="text" placeholder="Search amount" class="form-control form-control-sm" /></th>
                                                    <th><input type="text" placeholder="Search description" class="form-control form-control-sm" /></th>
                                                    <th><input type="text" placeholder="Search requirements" class="form-control form-control-sm" /></th>
                                                    <th><input type="text" placeholder="Search start date" class="form-control form-control-sm" /></th>
                                                    <th><input type="text" placeholder="Search end date" class="form-control form-control-sm" /></th>
                                                    <th></th>
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
</body>
</html>