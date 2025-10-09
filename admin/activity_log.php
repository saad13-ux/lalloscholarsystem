<?php
require './includes/check_session.php';

$page = 'Logs';
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
  border-radius: 12px;
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
  border-radius: 12px 12px 0 0 !important;
  padding: 20px;
}

.card-header h5 {
  margin: 0;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 10px;
}

.table {
  border-collapse: separate;
  border-spacing: 0;
  margin: 0;
}

.table thead th {
  background: linear-gradient(135deg, #f8f9fa, #e9ecef);
  border-bottom: 2px solid #dee2e6;
  font-weight: 700;
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
  transition: var(--transition);
}

.table-hover tbody tr:hover {
  background-color: rgba(52, 152, 219, 0.08);
  transform: translateY(-1px);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.btn {
  border-radius: 8px;
  font-weight: 500;
  transition: var(--transition);
  padding: 8px 16px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  border: none;
}

.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.btn-outline-primary {
  border: 2px solid #3498db;
  color: #3498db;
  background: transparent;
}

.btn-outline-primary:hover {
  background: #3498db;
  color: white;
  border-color: #3498db;
}

.preloader {
  background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('../resources/images/lallol.jpg') no-repeat;
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
}

.preloader img {
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% { transform: scale(1); opacity: 1; }
  50% { transform: scale(1.05); opacity: 0.8; }
  100% { transform: scale(1); opacity: 1; }
}

.table-responsive {
  border-radius: 10px;
  overflow: hidden;
}

.table-responsive::-webkit-scrollbar {
  height: 8px;
  width: 8px;
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

.dataTables_empty {
  padding: 60px 20px !important;
  text-align: center;
  color: #6c757d;
  font-style: italic;
  background: #f8f9fa;
}

.dataTables_empty:before {
  content: "📊";
  font-size: 3rem;
  display: block;
  margin-bottom: 15px;
  opacity: 0.5;
}

.buttons-columnVisibility.active {
  background: linear-gradient(135deg, #27ae60, #219653) !important;
  color: white !important;
  border-color: #27ae60 !important;
}

.buttons-columnVisibility.active:hover {
  background: linear-gradient(135deg, #219653, #1e8449) !important;
  color: white !important;
}

@media (max-width: 768px) {
  .table thead th,
  .table tbody td {
    padding: 10px 8px;
    font-size: 0.9rem;
  }
  
  .card-header {
    padding: 15px;
  }
  
  .card-header h5 {
    font-size: 1.1rem;
  }
}

.dataTables_wrapper .dataTables_filter input {
  border-radius: 8px;
  padding: 8px 12px;
  border: 2px solid #e9ecef;
  transition: var(--transition);
}

.dataTables_wrapper .dataTables_filter input:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
}

.dataTables_wrapper .dataTables_length select {
  border-radius: 8px;
  padding: 8;
  border: 2px solid #e9ecef;
}

.dt-buttons .btn {
  margin: 2px;
  border-radius: 8px;
}

.table tfoot th {
  background: #f8f9fa;
  font-weight: 600;
  padding: 12px;
}

/* DataTables custom layout - FIXED */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_paginate {
  margin: 10px 0;
}

.dataTables_wrapper .dt-buttons {
  margin-bottom: 10px;
}

.dataTables_wrapper .dt-buttons .btn {
  background: white;
  border: 1px solid #dee2e6;
  color: #495057;
  margin: 0 2px;
  font-size: 0.875rem;
}

.dataTables_wrapper .dt-buttons .btn:hover {
  background: #f8f9fa;
  border-color: #6c757d;
}

/* FIX: Ensure DataTables length text is visible */
.dataTables_wrapper .dataTables_length {
  color: #495057 !important;
}

.dataTables_wrapper .dataTables_length label {
  display: flex;
  align-items: center;
  gap: 8px;
  margin: 0;
  color: #495057 !important;
  font-weight: normal !important;
}

.dataTables_wrapper .dataTables_filter label {
  display: flex;
  align-items: center;
  gap: 8px;
  margin: 0;
  color: #495057 !important;
  font-weight: normal !important;
}

/* Ensure proper text visibility */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info {
  color: #495057 !important;
  font-size: 14px;
}

/* Fix for the "Show entries" text specifically */
.dataTables_wrapper .dataTables_length .dataTables_info {
  color: #495057 !important;
}

/* Ensure the length dropdown is properly styled */
.dataTables_wrapper select {
  color: #495057 !important;
  background-color: white !important;
}
</style>

<script>
$(document).ready(function(){
  function updateColumnVisibilityColors(){
    $('.buttons-columnVisibility').each(function(){
      if ($(this).hasClass('active')) {
        $(this).css({
          'background-color':'#198754',
          'color':'#fff'
        });
      } else {
        $(this).css({
          'background-color':'',
          'color':''
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
                            <h1 class="m-0">Activity Logs</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="dashboard.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Logs</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-history mr-2"></i>
                                        <h5 class="mb-0">Activity Logs</h5>
                                    </div>
                                   
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="applicationTable" class="table table-bordered table-hover w-100">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Activity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 <?php

                                                $qry = $pdo->query("SELECT * FROM activity_logs GROUP BY activity_id ORDER BY activity_id DESC");

                                                while ($row = $qry->fetch(PDO::FETCH_ASSOC)) {
                                                    $timestamp = strtotime($row['timestamp']);
                                                    $formattedDate = date('F d, Y h:i:s A', $timestamp);
                                                ?>
                                                    <tr>
                                                        <td class="font-weight-bold text-primary"><?= $formattedDate ?></td>
                                                        <td class="text-success"><?= $row['activity'] ?></td>
                                                    </tr>
                                                <?php 
                                            }
                                        ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="th"></th>
                                                    <th class="th"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include_once 'includes/footer.php'; ?>
    </div>
    <!-- ./wrapper -->

    <?php require './includes/partial.script-imports.php'; ?>
    <script>
$(document).ready(function() {
    $('#applicationTable').DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: true,
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>><"row"<"col-sm-12"B>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        buttons: [
            {
                extend: 'copy',
                text: '<i class="fas fa-copy"></i> Copy',
                className: 'btn btn-light btn-sm'
            },
            {
                extend: 'csv',
                text: '<i class="fas fa-file-csv"></i> CSV',
                className: 'btn btn-light btn-sm'
            },
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i> Excel',
                className: 'btn btn-light btn-sm'
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                className: 'btn btn-light btn-sm'
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i> Print',
                className: 'btn btn-light btn-sm'
            },
            {
                extend: 'colvis',
                text: '<i class="fas fa-columns"></i> Column visibility',
                className: 'btn btn-light btn-sm'
            }
        ],
        language: {
            lengthMenu: "Show _MENU_ entries",
            search: "Search:",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "Showing 0 to 0 of 0 entries",
            infoFiltered: "(filtered from _MAX_ total entries)",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            }
        },
        initComplete: function() {
            this.api().columns().every(function() {
                var column = this;
                $('input', this.footer()).on('keyup change clear', function() {
                    if (column.search() !== this.value) {
                        column.search(this.value).draw();
                    }
                });
            });
        }
    });

    $('#example2').DataTable({
        paging: true,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true
    });
});

function refreshTable() {
    location.reload();
}
    </script>
</body>
</html>