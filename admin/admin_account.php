<?php
require './includes/check_session.php';

$page = 'Admin';
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

.btn-success {
  background-color: var(--success-color);
  border-color: var(--success-color);
  color: white;
}

.btn-success:hover {
  background-color: #219653;
  border-color: #219653;
  color: white;
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
  content: "👥";
  font-size: 2rem;
  display: block;
  margin-bottom: 10px;
}

.profile-image {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #e9ecef;
  transition: all 0.3s ease;
}

.profile-image:hover {
  transform: scale(1.1);
  border-color: var(--primary-color);
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

  // Start interval when page loads; keeps checking
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
                            <h1 class="m-0">Admin</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="dashboard.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Admin</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            // include Add Modal Scholarship
            include_once './components/add_admin.php';
            ?>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h3 class="card-title mb-0">
                <i class="fas fa-users mr-2"></i>Admin Accounts 
            </h3>
    
        </div>
        <div>
            <button class="btn btn-success" data-toggle="modal" data-target="#addprofile">
                <i class="fas fa-plus mr-1"></i>ADD ADMIN
            </button>
        </div>
    </div>
</div>
                                
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="applicationTable" class="table table-hover display">
                                            <thead>
                                                <tr>
                                                    <th>Profile</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $qry = $pdo->query("SELECT admin_id, image_filename, username, email, CONCAT(first_name,' ',middle_name,' ',last_name) as whole_name FROM admin ORDER BY admin_id DESC");

                                                while ($row = $qry->fetch(PDO::FETCH_ASSOC)) {
                                                    $imagePath = "../resources/admin_profile/" . $row['image_filename'];
                                                    $defaultImagePath = "../resources/admin_profile/user.png";
                                                    $actualImage = (file_exists($imagePath) && !empty($row['image_filename'])) ? $imagePath : $defaultImagePath;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <center>
                                                            <img src="<?= $actualImage ?>" class="profile-image" alt="Profile" 
                                                                 onerror="this.src='<?= $defaultImagePath ?>'">
                                                        </center>
                                                    </td>
                                                    <td class="font-weight-bold"><?= htmlspecialchars($row['username']) ?></td>
                                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                                    <td><?= htmlspecialchars($row['whole_name']) ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Profile</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Name</th>
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
        // Initialize DataTable with enhanced options
        var table = $('#applicationTable').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            pageLength: 10,
            order: [[0, 'desc']],
            language: {
                search: "Search admins:",
                lengthMenu: "Show _MENU_ admins",
                info: "Showing _START_ to _END_ of _TOTAL_ admins",
                infoEmpty: "No admin accounts available",
                infoFiltered: "(filtered from _MAX_ total admins)",
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
                // Add search functionality to footer
                this.api().columns().every(function () {
                    var column = this;
                    $('input', this.footer()).on('keyup change clear', function () {
                        if (column.search() !== this.value) {
                            column.search(this.value).draw();
                        }
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

        // Profile image error handling
        $('.profile-image').on('error', function() {
            $(this).attr('src', '../resources/admin_profile/user.png');
        });
    });
    </script>
</body>
</html>