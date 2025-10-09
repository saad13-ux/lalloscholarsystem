<?php
require __DIR__ . '/includes/check_session.php';
require realpath(__DIR__ . '/../includes/config.php');

$page = 'General Announcements';
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
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
  transform: translateY(-2px);
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
  background: linear-gradient(135deg, var(--success-color), #2ecc71);
  border: none;
}

.btn-primary {
  background: linear-gradient(135deg, var(--primary-color), #2980b9);
  border: none;
}

.btn-outline-primary {
  color: var(--primary-color);
  border-color: var(--primary-color);
}

.btn-outline-primary:hover {
  background-color: var(--primary-color);
  border-color: var(--primary-color);
  color: white;
}

.btn-outline-danger {
  color: var(--danger-color);
  border-color: var(--danger-color);
}

.btn-outline-danger:hover {
  background-color: var(--danger-color);
  border-color: var(--danger-color);
  color: white;
}

.modal-content {
  border-radius: 10px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
  border: none;
}

.modal-header {
  background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
  color: white;
  border-radius: 10px 10px 0 0;
  padding: 15px 20px;
}

.modal-header h5 {
  margin: 0;
  font-weight: 600;
}

.modal-body textarea {
  min-height: 140px;
  border-radius: 6px;
  resize: vertical;
}

.modal-footer {
  gap: .5rem;
  border-top: 1px solid #e9ecef;
  padding: 15px 20px;
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

/* Status indicators */
.status-indicator {
  display: inline-flex;
  align-items: center;
  gap: 5px;
}

.status-indicator.active {
  color: var(--success-color);
}

.status-indicator.expired {
  color: var(--danger-color);
}

/* Announcement card styling */
.announcement-card {
  border-left: 4px solid var(--primary-color);
  transition: all 0.3s ease;
}

.announcement-card.expired {
  border-left-color: var(--danger-color);
  opacity: 0.7;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .action-buttons {
    flex-direction: column;
    gap: 5px;
  }
  
  .action-buttons .btn {
    max-width: 100%;
  }
  
  .modal-footer {
    flex-direction: column-reverse;
  }
  
  .modal-footer .btn {
    width: 100%;
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
  content: "📢";
  font-size: 2rem;
  display: block;
  margin-bottom: 10px;
}

/* Message column styling */
.message-cell {
  max-width: 300px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.message-cell:hover {
  white-space: normal;
  overflow: visible;
  position: relative;
  z-index: 10;
  background: white;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
  border-radius: 4px;
  padding: 8px;
}
</style>

<script>
$(document).ready(function() {
  // Initialize DataTable with enhanced options
  var table = $('#announcementTable').DataTable({
    responsive: true,
    lengthChange: true,
    autoWidth: false,
    pageLength: 10,
    order: [[2, 'desc']], // Default sort by date posted
    language: {
      search: "Search announcements:",
      lengthMenu: "Show _MENU_ announcements",
      info: "Showing _START_ to _END_ of _TOTAL_ announcements",
      infoEmpty: "No announcements available",
      infoFiltered: "(filtered from _MAX_ total announcements)",
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
    columnDefs: [
      {
        targets: 1, // Message column
        render: function(data, type, row) {
          if (type === 'display' && data.length > 100) {
            return '<div class="message-cell" title="' + data + '">' + data.substr(0, 100) + '...</div>';
          }
          return data;
        }
      }
    ]
  });

  // Apply custom styling to buttons after table initialization
  table.buttons().container().appendTo('#announcementTable_wrapper .col-md-6:eq(0)');
  
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

// Fill Edit Announcement Modal
function editAnnouncement(id, title, message, expires) {
  document.getElementById('edit_id').value = id;
  document.getElementById('edit_title').value = title;
  document.getElementById('edit_message').value = message;
  document.getElementById('edit_expires').value = expires;
  
  // Show the edit modal
  $('#EditAnnounceModal').modal('show');
}

// Check for expired announcements and update UI
function checkExpiredAnnouncements() {
  $('tbody tr').each(function() {
    const expiresCell = $(this).find('td:eq(3)');
    const expiresText = expiresCell.text().trim();
    
    if (expiresText !== '-' && expiresText !== '') {
      const expireDate = new Date(expiresText);
      const today = new Date();
      
      if (expireDate < today) {
        $(this).addClass('table-danger');
        expiresCell.append(' <span class="badge badge-danger">Expired</span>');
      }
    }
  });
}

// Initialize when document is ready
$(document).ready(function() {
  checkExpiredAnnouncements();
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
            <h1 class="m-0">General Announcements</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">General Announcements</li>
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
                  <i class="fas fa-bullhorn"></i>
                  <h5 class="mb-0 ml-2">Announcements List</h5>
                </div>
                <div>
                  <button class="btn btn-success" data-toggle="modal" data-target="#AddAnnounceModal">
                    <i class="fas fa-plus"></i> New Announcement
                  </button>
                </div>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table id="announcementTable" class="table table-bordered table-hover w-100">
                    <thead class="thead-light">
                      <tr>
                        <th>Title</th>
                        <th>Message</th>
                        <th>Posted On</th>
                        <th>Expires On</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $stmt = $pdo->query("SELECT * FROM general_announcements ORDER BY created_at DESC");
                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $title = htmlspecialchars($row['title']);
                        $message = nl2br(htmlspecialchars($row['message']));
                        $created = date("M d, Y", strtotime($row['created_at']));
                        $expires = $row['expires_at'] ? date("M d, Y", strtotime($row['expires_at'])) : '-';
                        
                        // Check if announcement is expired
                        $isExpired = false;
                        if ($row['expires_at']) {
                          $expireDate = new DateTime($row['expires_at']);
                          $today = new DateTime();
                          $isExpired = $expireDate < $today;
                        }
                      ?>
                      <tr class="<?= $isExpired ? 'table-danger' : '' ?>">
                        <td class="font-weight-bold"><?= $title ?></td>
                        <td><?= $message ?></td>
                        <td><?= $created ?></td>
                        <td>
                          <?= $expires ?>
                          <?php if ($isExpired): ?>
                            <span class="badge badge-danger ml-1">Expired</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-primary" 
                                    onclick="editAnnouncement('<?= $row['id'] ?>','<?= addslashes($title) ?>','<?= addslashes($row['message']) ?>','<?= $row['expires_at'] ?>')">
                              <i class="fas fa-edit"></i> Edit
                            </button>
                            <a href="delete_announcement.php?id=<?= $row['id'] ?>" class="btn btn-outline-danger" 
                               onclick="return confirm('Are you sure you want to delete this announcement?')">
                              <i class="fas fa-trash"></i> Delete
                            </a>
                          </div>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Title</th>
                        <th>Message</th>
                        <th>Posted On</th>
                        <th>Expires On</th>
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

<!-- Add Announcement Modal -->
<div class="modal fade" id="AddAnnounceModal" tabindex="-1" role="dialog" aria-labelledby="AddAnnounceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <form method="POST" action="save_announcement.php">
        <div class="modal-header">
          <h5 class="modal-title" id="AddAnnounceModalLabel">Create New Announcement</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="add_title">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="add_title" name="title" required placeholder="Enter announcement title">
          </div>
          <div class="form-group">
            <label for="add_message">Message <span class="text-danger">*</span></label>
            <textarea class="form-control" id="add_message" name="message" rows="5" required placeholder="Enter announcement message"></textarea>
          </div>
          <div class="form-group">
            <label for="add_expires">Expiry Date (optional)</label>
            <input type="date" class="form-control" id="add_expires" name="expires_at">
            <small class="form-text text-muted">Leave empty if the announcement doesn't expire</small>
          </div>
        </div>
        <div class="modal-footer flex-wrap">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="save_announcement" class="btn btn-success">Post Announcement</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Announcement Modal -->
<div class="modal fade" id="EditAnnounceModal" tabindex="-1" role="dialog" aria-labelledby="EditAnnounceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <form method="POST" action="update_announcement.php">
        <div class="modal-header">
          <h5 class="modal-title" id="EditAnnounceModalLabel">Edit Announcement</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="edit_id">
          <div class="form-group">
            <label for="edit_title">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="title" id="edit_title" required>
          </div>
          <div class="form-group">
            <label for="edit_message">Message <span class="text-danger">*</span></label>
            <textarea class="form-control" name="message" id="edit_message" rows="5" required></textarea>
          </div>
          <div class="form-group">
            <label for="edit_expires">Expiry Date (optional)</label>
            <input type="date" class="form-control" name="expires_at" id="edit_expires">
            <small class="form-text text-muted">Leave empty if the announcement doesn't expire</small>
          </div>
        </div>
        <div class="modal-footer flex-wrap">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="update_announcement" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>