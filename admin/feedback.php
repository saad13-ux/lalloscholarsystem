<?php
require './includes/check_session.php';

$remove_badge_sql = "UPDATE feedback SET badge_notified_admin=1 WHERE badge_notified_admin=0;";
$remove_badge_result = $pdo->query($remove_badge_sql);

$remove_notif_sql = "UPDATE admin_notification SET status=1 WHERE type=3;";
$remove_notif_result = $pdo->query($remove_notif_sql);

$page = 'Feedback';

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

/* Status badges */
.badge {
  font-size: 0.75rem;
  padding: 6px 12px;
  border-radius: 50px;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}

.badge-primary {
  background: linear-gradient(135deg, #3498db, #2980b9);
}

.badge-success {
  background: linear-gradient(135deg, #27ae60, #219653);
}

/* Action buttons */
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

.btn-outline-danger {
  border: 2px solid #e74c3c;
  color: #e74c3c;
  background: transparent;
}

.btn-outline-danger:hover {
  background: #e74c3c;
  color: white;
  border-color: #e74c3c;
}

.btn-outline-success {
  border: 2px solid #27ae60;
  color: #27ae60;
  background: transparent;
}

.btn-outline-success:hover {
  background: #27ae60;
  color: white;
  border-color: #27ae60;
}

/* Action buttons container */
.action-buttons {
  display: flex;
  gap: 8px;
  justify-content: center;
  flex-wrap: wrap;
}

.action-buttons .btn {
  min-width: 44px;
  height: 44px;
  border-radius: 10px;
}

/* Preloader */
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

/* Table responsive improvements */
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

/* Empty state styling */
.dataTables_empty {
  padding: 60px 20px !important;
  text-align: center;
  color: #6c757d;
  font-style: italic;
  background: #f8f9fa;
}

.dataTables_empty:before {
  content: "💬";
  font-size: 3rem;
  display: block;
  margin-bottom: 15px;
  opacity: 0.5;
}

/* Filter section */
.filter-section {
  background: linear-gradient(135deg, #f8f9fa, #e9ecef);
  border-radius: 10px;
  padding: 20px;
  margin-bottom: 25px;
  border-left: 4px solid var(--primary-color);
}

/* Column visibility button styling */
.buttons-columnVisibility.active {
  background: linear-gradient(135deg, #27ae60, #219653) !important;
  color: white !important;
  border-color: #27ae60 !important;
}

.buttons-columnVisibility.active:hover {
  background: linear-gradient(135deg, #219653, #1e8449) !important;
  color: white !important;
}

/* Status indicator for unread feedback */
.status-indicator {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: #e74c3c;
  display: inline-block;
  margin-right: 8px;
  animation: pulse 2s infinite;
}

.unread-row {
  background: linear-gradient(90deg, rgba(52, 152, 219, 0.05) 0%, transparent 100%);
  border-left: 4px solid #3498db;
}

/* Loading animation */
.loading {
  position: relative;
  overflow: hidden;
}

.loading::after {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
  animation: loading 1.5s infinite;
}

@keyframes loading {
  0% { left: -100%; }
  100% { left: 100%; }
}

/* Custom checkbox */
.custom-checkbox {
  width: 20px;
  height: 20px;
  cursor: pointer;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .action-buttons {
    flex-direction: column;
    gap: 5px;
  }
  
  .action-buttons .btn {
    width: 100%;
    justify-content: center;
  }
  
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

/* Hover effects for table rows */
.table tbody tr {
  transition: all 0.3s ease;
  cursor: pointer;
}

.table tbody tr:hover {
  background: linear-gradient(90deg, rgba(52, 152, 219, 0.08) 0%, transparent 100%);
}

/* Custom badge animations */
.badge {
  position: relative;
  overflow: hidden;
}

.badge::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
  transition: left 0.5s;
}

.badge:hover::before {
  left: 100%;
}

/* Footer styling */
.table tfoot th {
  background: #f8f9fa;
  font-weight: 600;
  padding: 12px;
}

/* DataTables customizations */
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
  padding: 6px;
  border: 2px solid #e9ecef;
}

/* Button group styling */
.dt-buttons .btn {
  margin: 2px;
  border-radius: 8px;
}

/* Success message */
.alert-success {
  border-radius: 10px;
  border: none;
  background: linear-gradient(135deg, #d4edda, #c3e6cb);
  color: #155724;
  border-left: 4px solid #28a745;
}

/* Modal enhancements */
.modal-content {
  border-radius: 12px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  border: none;
}

.modal-header {
  background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
  color: white;
  border-radius: 12px 12px 0 0;
  padding: 20px;
}

.modal-header .close {
  color: white;
  opacity: 0.8;
  text-shadow: none;
}

.modal-header .close:hover {
  opacity: 1;
  transform: scale(1.1);
}

.modal-body {
  padding: 25px;
}

.modal-footer {
  border-top: 1px solid #e9ecef;
  padding: 20px;
}
</style>

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
                            <h1 class="m-0">Feedback</h1>
                            <p class="text-muted mb-0">Manage and respond to user feedback</p>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="dashboard.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Feedback</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <?php
            // include View Modal Feedback
            include_once './components/viewModal_feedback.php';
            // include Delete Modal Feedback
            include_once './components/deleteModal_feedback.php';
            // include View Modal Feedback
            include_once './components/Reply.php';
            ?>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <?php
                                    $total_feedback = $pdo->query("SELECT COUNT(*) as total FROM feedback")->fetch(PDO::FETCH_ASSOC)['total'];
                                    ?>
                                    <h3><?= $total_feedback ?></h3>
                                    <p>Total Feedback</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-comments"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <?php
                                    $unread_feedback = $pdo->query("SELECT COUNT(*) as unread FROM feedback WHERE status = 0")->fetch(PDO::FETCH_ASSOC)['unread'];
                                    ?>
                                    <h3><?= $unread_feedback ?></h3>
                                    <p>Unread Messages</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <?php
                                    $read_feedback = $pdo->query("SELECT COUNT(*) as read_count FROM feedback WHERE status = 1")->fetch(PDO::FETCH_ASSOC)['read_count'];
                                    ?>
                                    <h3><?= $read_feedback ?></h3>
                                    <p>Read Messages</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-envelope-open"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-primary">
                            
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-comments mr-2"></i>
                                        <h5 class="mb-0">User Feedback</h5>
                                    </div>
                                    
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="applicationTable" class="table table-bordered table-hover w-100">
                                            <thead>
                                                <tr>
                                                    <th width="50px">Status</th>
                                                    <th>User</th>
                                                    <th>Email</th>
                                                    <th>Date Submitted</th>
                                                    <th>Date Read</th>
                                                    <th width="150px">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                $stmt = $pdo->query("SELECT * FROM feedback ORDER BY status ASC, dt_created DESC");
                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    $status_class = $row['status'] == 0 ? 'unread-row' : '';
                                                ?>
                                                    <tr class="<?= $status_class ?>">
                                                        <td class="text-center">
                                                            <?php if ($row['status'] == 0): ?>
                                                                <span class="status-indicator"></span>
                                                                <span class="badge badge-primary" data-toggle="tooltip" title="Unread Message">
                                                                    <i class="fa fa-envelope"></i>
                                                                </span>
                                                            <?php else: ?>
                                                                <span class="badge badge-success" data-toggle="tooltip" title="Read Message">
                                                                    <i class="fa fa-envelope-open"></i>
                                                                </span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="font-weight-bold"><?= htmlspecialchars($row['name']) ?></td>
                                                        <td><?= htmlspecialchars($row['email']) ?></td>
                                                        <td>
                                                            <span class="text-primary font-weight-bold">
                                                                <?= date('M d, Y', strtotime($row['dt_created'])) ?>
                                                            </span>
                                                            <br>
                                                            <small class="text-muted">
                                                                <?= date('h:i A', strtotime($row['dt_created'])) ?>
                                                            </small>
                                                        </td>
                                                        <td>
                                                            <?php if ($row['status'] && $row['dt_updated']): ?>
                                                                <span class="text-success font-weight-bold">
                                                                    <?= date('M d, Y', strtotime($row['dt_updated'])) ?>
                                                                </span>
                                                                <br>
                                                                <small class="text-muted">
                                                                    <?= date('h:i A', strtotime($row['dt_updated'])) ?>
                                                                </small>
                                                            <?php else: ?>
                                                                <span class="text-muted font-italic">Not read yet</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <div class="action-buttons">
                                                                <button class="btn btn-outline-primary btn-sm" 
                                                                        data-toggle="modal" 
                                                                        data-target="#ReadFeedback" 
                                                                        onclick="markFeedbackRead(<?= $row['feedback_id'] ?>, '<?= addslashes($row['email']) ?>', '<?= addslashes($row['subject']) ?>', '<?= addslashes($row['body']) ?>')"
                                                                        data-toggle="tooltip" 
                                                                        title="View Message">
                                                                    <i class="far fa-eye"></i>
                                                                </button>
                                                                <button class="btn btn-outline-success btn-sm" 
                                                                        data-toggle="modal" 
                                                                        data-target="#replyFeedback" 
                                                                        onclick="replyMessage(<?= $row['feedback_id'] ?>, '<?= addslashes($row['email']) ?>', '<?= addslashes($row['name']) ?>')"
                                                                        data-toggle="tooltip" 
                                                                        title="Reply to User">
                                                                    <i class="far fa-comment-dots"></i>
                                                                </button>
                                                                <button class="btn btn-outline-danger btn-sm" 
                                                                        data-toggle="modal" 
                                                                        data-target="#deleteFeedback" 
                                                                        onclick="delete_feedback(<?= $row['feedback_id'] ?>, '<?= addslashes($row['email']) ?>')"
                                                                        data-toggle="tooltip" 
                                                                        title="Delete Feedback">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>User</th>
                                                    <th>Email</th>
                                                    <th>Date Submitted</th>
                                                    <th>Date Read</th>
                                                    <th>Actions</th>
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
        // Initialize DataTable with enhanced features
        var table = $('#applicationTable').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            pageLength: 25,
            order: [[0, 'asc']], // Sort by status (unread first)
            language: {
                search: "Search feedback:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ feedback entries",
                infoEmpty: "No feedback available",
                infoFiltered: "(filtered from _MAX_ total entries)",
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
            initComplete: function() {
                this.api().buttons().container().appendTo('#applicationTable_wrapper .col-md-6:eq(0)');
                updateColumnVisibilityColors();
            }
        });

        // Update column visibility colors
        function updateColumnVisibilityColors() {
            $('.buttons-columnVisibility').each(function(){
                if ($(this).hasClass('active')) {
                    $(this).css({
                        'background': 'linear-gradient(135deg, #27ae60, #219653)',
                        'color': '#fff',
                        'border-color': '#27ae60'
                    });
                } else {
                    $(this).css({
                        'background': '',
                        'color': '',
                        'border-color': ''
                    });
                }
            });
        }

        // Update colors when column visibility changes
        table.on('column-visibility', function() {
            setTimeout(updateColumnVisibilityColors, 100);
        });

        // Update on button click
        $(document).on('click', '.buttons-columnVisibility', function() {
            setTimeout(updateColumnVisibilityColors, 100);
        });

        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Auto-refresh colors every 200ms (fallback)
        setInterval(updateColumnVisibilityColors, 200);
    });

    function refreshTable() {
        $('.btn-outline-primary').prop('disabled', true).addClass('loading');
        setTimeout(function() {
            location.reload();
        }, 1000);
    }

    function replyMessage(id, email, name) {
        $("#replyfeedback_id").val(id);
        $("#mail").val(email);
        $("#username").val(name);
        
        // Show success message
        showAlert(`Preparing to reply to ${name}`, 'info');
    }

    function markFeedbackRead(id, email, subject, body) {
        $("#feedback_id").val(id);
        $("#mail_read").val(email);
        $("#subject").html(subject ? subject : '<em>No Subject</em>');
        $("#body").html(body ? body : '<em>No message content</em>');
        
        // Mark as read in background
        $.post('mark_feedback_read.php', { feedback_id: id }, function(response) {
            if (response.success) {
                // Update the row appearance
                $(`tr:has(button[onclick*="${id}"])`).removeClass('unread-row');
                showAlert('Feedback marked as read', 'success');
            }
        });
    }

    function delete_feedback(id, email) {
        $('#delete_feedback_id').val(id);
        $("#mail_del").val(email);
    }

    function showAlert(message, type) {
        // Remove existing alerts
        $('.custom-alert').remove();
        
        const alertClass = {
            'success': 'alert-success',
            'error': 'alert-danger',
            'warning': 'alert-warning',
            'info': 'alert-info'
        }[type] || 'alert-info';

        const icon = {
            'success': 'fa-check-circle',
            'error': 'fa-exclamation-circle',
            'warning': 'fa-exclamation-triangle',
            'info': 'fa-info-circle'
        }[type] || 'fa-info-circle';

        const alert = $(`
            <div class="alert ${alertClass} alert-dismissible custom-alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
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

    // Add smooth scrolling to top when paginating
    $('#applicationTable').on('page.dt', function() {
        $('html, body').animate({
            scrollTop: $('.dataTables_wrapper').offset().top - 20
        }, 500);
    });
    </script>
</body>
</html>