<?php
include './includes/pdo_conn.php';
include './includes/session_variables.php';

$page = 'Scholarships';

require './includes/partial.head.php';
?>

<style>

    :root {
  --primary-color: #198754;
  --primary-light: #e9f7ef;
  --primary-dark: #146c43;
  --text-dark: #343a40;
  --text-light: #6c757d;
  --border-color: #dee2e6;
  --bg-light: #f8f9fa;
  --shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
  --transition: all 0.3s ease;
}
    
/* Preloader */
.preloader {
  background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
}

/* Breadcrumb */
.breadcrumb {
  background-color: transparent;
  padding: 0;
  margin-bottom: 0;
}

.breadcrumb-item a {
  color: var(--primary-color);
  text-decoration: none;
  transition: var(--transition);
}

.breadcrumb-item a:hover {
  color: var(--primary-dark);
  text-decoration: underline;
}

.remaining-time {
    font-size: 0.85rem;
    font-weight: 600;
}

</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="resources/images/lgulallo.png" alt="Logo" height="100" width="100" >
        </div>

        <?php
        // include Top Navigation Bar
        include_once 'includes/topNav.php';
        // include Side Navihation Bar
        include_once 'includes/sideNav.php';
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Available Scholarships</h1>
                            <p class="text-muted">Browse and apply for available scholarship opportunities</p>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="index.php" class="link-offset-2 link-underline link-underline-opacity-0">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Scholarships</li>
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
                    <!-- Filter and Search Section -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" id="scholarshipSearch" class="form-control" placeholder="Search scholarships...">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" id="sortScholarships">
                                    <option value="newest">Sort by: Newest First</option>
                                    <option value="oldest">Sort by: Oldest First</option>
                                    <option value="amount_high">Sort by: Highest Amount</option>
                                    <option value="amount_low">Sort by: Lowest Amount</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Scholarship Cards -->
                    <div class="row" id="scholarshipContainer">
                        <?php
                        $sql = "SELECT s.scholarship_id, s.scholarship_type, s.image_filename, s.amount, s.description, s.start_date, s.end_date, GROUP_CONCAT(rd.requirement_name SEPARATOR ', ') AS concatenated_value
                                            FROM scholarship AS s
                                            INNER JOIN requirement_data AS rd ON s.scholarship_id = rd.scholarship_id
                                            WHERE s.end_date >= NOW()
                                            GROUP BY s.scholarship_id
                                            ORDER BY s.scholarship_id DESC; ";
                         $result = $pdo->query($sql);
                         
                         if ($result->rowCount() > 0) {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                $timestamp = strtotime($row['end_date']);
                                $formattedDate = date('F d, Y h:i:s A', $timestamp);

                                $imagePath = "./resources/image/" . $row['image_filename'];
                                $defaultImagePath = "./resources/image/default.jpg";
                
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4 scholarship-card" data-id="<?php echo $row['scholarship_id']; ?>" data-amount="<?php echo $row['amount']; ?>">
                            <div class="card scholarship-card h-100 shadow-sm">
                                <div class="card-image-container position-relative overflow-hidden">
                                    <?php  if (file_exists($imagePath)) { ?>
                                        <img class="card-img-top" src="<?= $imagePath ?>" alt="Scholarship Image" height="200">
                                    <?php }else{?>
                                        <img class="card-img-top" src="<?= $defaultImagePath ?>" alt="Scholarship Image" height="200">
                                    <?php } ?>
                                    <div class="card-overlay d-flex align-items-center justify-content-center">
                                        <div class="text-center text-white">
                                            <h5><?php echo $row['scholarship_type']; ?></h5>
                                            <h4 class="font-weight-bold">&#8369;<?php echo number_format($row['amount']); ?></h4>
                                        </div>
                                    </div>
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge bg-success">Active</span>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-2"><?php echo $row['scholarship_type']; ?></h5>
                                    <div class="mb-2">
                                        <span class="text-primary font-weight-bold">&#8369;<?php echo number_format($row['amount']); ?></span>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="description-truncate">
                                            <p class="card-text text-muted"><?php echo substr($row['description'], 0, 100); ?>...</p>
                                        </div>
                                        <a href="#" class="text-primary read-more-toggle" data-description="<?php echo htmlspecialchars($row['description']); ?>">Read more</a>
                                    </div>
                                    
                                    <div class="requirements-section mb-3">
                                        <h6 class="font-weight-bold">Requirements:</h6>
                                        <ul class="list-unstyled mb-0">
                                            <?php
                                            $concatenatedValues = explode(',', $row['concatenated_value']);
                                            $displayCount = 3; // Show only first 3 requirements initially
                                            $count = 0;
                                            foreach ($concatenatedValues as $value) {
                                                if ($count < $displayCount) {
                                                    echo "<li class='mb-1'><i class='fas fa-check-circle text-success mr-2'></i>$value</li>";
                                                }
                                                $count++;
                                            }
                                            if (count($concatenatedValues) > $displayCount) {
                                                echo "<li><a href='#' class='text-primary show-all-reqs' data-requirements='".htmlspecialchars(implode(', ', $concatenatedValues))."'>Show all " . count($concatenatedValues) . " requirements</a></li>";
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    
                                   <!-- Deadline Section -->
<div class="deadline-section mb-3">
    <div class="d-flex justify-content-between align-items-center">
        <span class="text-muted">Deadline:</span>
        <span class="font-weight-bold"><?php echo date('M d, Y', $timestamp); ?></span>
    </div>
    
    <!-- Add this new line for remaining time -->
    <div class="text-center mt-1 mb-2">
       <small class="text-warning font-weight-bold remaining-time" id="remainingTime<?php echo $row['scholarship_id']; ?>"></small>
    </div>
    
    <div class="progress mt-2" style="height: 5px;">
        <?php
        $startDate = strtotime($row['start_date']);
        $endDate = strtotime($row['end_date']);
        $currentDate = time();
        $totalDuration = $endDate - $startDate;
        $elapsedDuration = $currentDate - $startDate;
        $percentage = ($elapsedDuration / $totalDuration) * 100;
        $percentage = min(100, max(0, $percentage)); // Ensure between 0-100
        ?>
        <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $percentage; ?>%" 
             aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="text-center mt-1">
        <small class="text-muted" id="countdown<?php echo $row['scholarship_id']; ?>"></small>
    </div>
</div>
                                    
                                    <div class="mt-auto">
                                        <?php 
                                        // Safely get user_id from session using your defined session variables
                                        $userId = null;
                                        $hasSubmitted = false;

                                        // Check if session variables are defined and exist in $_SESSION
                                        if (isset($session_user_id) && isset($_SESSION[$session_user_id])) {
                                            $userId = $_SESSION[$session_user_id];
                                        }

                                        if ($userId) {
                                            $submissionSql = "SELECT * FROM user_application WHERE user_id = :userId AND scholarship_id = :scholarshipId";
                                            $submissionStmt = $pdo->prepare($submissionSql);
                                            $submissionStmt->bindParam(':userId', $userId);
                                            $submissionStmt->bindParam(':scholarshipId', $row['scholarship_id']);
                                            $submissionStmt->execute();
                                            
                                            if ($submissionStmt->fetch(PDO::FETCH_ASSOC)) {
                                                $hasSubmitted = true;
                                            }
                                        }
                                        ?>
                                        
                                        <div class="d-flex justify-content-between align-items-center">
                                            <?php if (!$hasSubmitted) { ?>
                                                <a href="appllication-scholarship.php?
                                                scholarship_id=<?= $row['scholarship_id'] ?>&
                                                scholarship_type=<?= urlencode($row['scholarship_type']) ?>&
                                                amount=<?= $row['amount'] ?>&
                                                description=<?= urlencode($row['description']) ?>"
                                                class="btn btn-primary btn-block">
                                                    <i class='fas fa-paper-plane mr-2'></i> Apply Now
                                                </a>
                                            <?php } else { ?>
                                                <button class="btn btn-success btn-block" disabled>
                                                    <i class='fas fa-check-circle mr-2'></i> Application Submitted
                                                </button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                       <script>
    // Countdown timer for scholarship <?php echo $row['scholarship_id']; ?>
    document.addEventListener('DOMContentLoaded', function() {
        var timestamp<?php echo $row['scholarship_id']; ?> = <?php echo strtotime($formattedDate); ?> * 1000;
        var endDate<?php echo $row['scholarship_id']; ?> = new Date(timestamp<?php echo $row['scholarship_id']; ?>);

        function updateCountdown<?php echo $row['scholarship_id']; ?>() {
            var now = new Date();
            var timeDifference = endDate<?php echo $row['scholarship_id']; ?> - now;

            if (timeDifference < 0) {
                document.getElementById("countdown<?php echo $row['scholarship_id']; ?>").textContent = "Application Closed";
                document.getElementById("remainingTime<?php echo $row['scholarship_id']; ?>").textContent = "Time's up!";
                return;
            }

            var days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
            var hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);
            
            // Format for countdown (compact)
            var countdownText = "";
            if (days > 0) {
                countdownText = days + "d " + hours + "h " + minutes + "m left";
            } else if (hours > 0) {
                countdownText = hours + "h " + minutes + "m left";
            } else {
                countdownText = minutes + "m left";
            }
            
            // Format for remaining time (detailed)
            var remainingTimeText = "";
            if (days > 0) {
                remainingTimeText = days + " days, " + hours + " hours remaining";
            } else if (hours > 0) {
                remainingTimeText = hours + " hours, " + minutes + " minutes remaining";
            } else if (minutes > 0) {
                remainingTimeText = minutes + " minutes, " + seconds + " seconds remaining";
            } else {
                remainingTimeText = seconds + " seconds remaining";
            }
            
            document.getElementById("countdown<?php echo $row['scholarship_id']; ?>").textContent = countdownText;
            document.getElementById("remainingTime<?php echo $row['scholarship_id']; ?>").textContent = remainingTimeText;
        }

        updateCountdown<?php echo $row['scholarship_id']; ?>();
        setInterval(updateCountdown<?php echo $row['scholarship_id']; ?>, 1000); // Update every second for more accuracy
    });
</script>
                        <?php 
                            }
                        } else {
                            echo '<div class="col-12 text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-graduation-cap fa-4x text-muted mb-3"></i>
                                        <h3 class="text-muted">No Scholarships Available</h3>
                                        <p class="text-muted">There are currently no active scholarships. Please check back later.</p>
                                    </div>
                                  </div>';
                        }
                        ?>
                    </div>
                    
                   
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php include_once 'includes/footer.php'; ?>
    </div>
    <!-- ./wrapper -->

    <!-- Description Modal -->
    <div class="modal fade" id="descriptionModal" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="descriptionModalLabel">Scholarship Description</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalDescriptionContent">
                    <!-- Description content will be inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Requirements Modal -->
    <div class="modal fade" id="requirementsModal" tabindex="-1" role="dialog" aria-labelledby="requirementsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="requirementsModalLabel">All Requirements</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalRequirementsContent">
                    <!-- Requirements content will be inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php require './includes/partial.script-imports.php'; ?>
    
    <style>
        .scholarship-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #e0e0e0;
        }
        
        .scholarship-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        
        .card-image-container {
            height: 200px;
            overflow: hidden;
        }
        
        .card-image-container img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .scholarship-card:hover .card-image-container img {
            transform: scale(1.05);
        }
        
        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.7);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .scholarship-card:hover .card-overlay {
            opacity: 1;
        }
        
        .description-truncate {
            max-height: 60px;
            overflow: hidden;
        }
        
        .empty-state {
            padding: 3rem 1rem;
        }
        
        .requirements-section ul li {
            padding: 2px 0;
        }
        
        .progress {
            background-color: #e9ecef;
        }
    </style>
    
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();
            
            // Read more functionality for descriptions
            $('.read-more-toggle').click(function(e) {
                e.preventDefault();
                var description = $(this).data('description');
                $('#modalDescriptionContent').html('<p>' + description + '</p>');
                $('#descriptionModal').modal('show');
            });
            
            // Show all requirements
            $('.show-all-reqs').click(function(e) {
                e.preventDefault();
                var requirements = $(this).data('requirements').split(', ');
                var requirementsHtml = '<ul class="list-unstyled">';
                requirements.forEach(function(req) {
                    requirementsHtml += '<li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>' + req + '</li>';
                });
                requirementsHtml += '</ul>';
                $('#modalRequirementsContent').html(requirementsHtml);
                $('#requirementsModal').modal('show');
            });
            
            // Search functionality
            $('#scholarshipSearch').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('.scholarship-card').filter(function() {
                    $(this).closest('.col-lg-4').toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            
            // Sort functionality
            $('#sortScholarships').on('change', function() {
                var container = $('#scholarshipContainer');
                var items = container.find('.scholarship-card').closest('.col-lg-4');
                
                items.sort(function(a, b) {
                    var aId = $(a).data('id');
                    var aAmount = $(a).data('amount');
                    var bId = $(b).data('id');
                    var bAmount = $(b).data('amount');
                    
                    switch($(this).val()) {
                        case 'newest':
                            return bId - aId;
                        case 'oldest':
                            return aId - bId;
                        case 'amount_high':
                            return bAmount - aAmount;
                        case 'amount_low':
                            return aAmount - bAmount;
                        default:
                            return 0;
                    }
                }.bind(this));
                
                container.html(items);
            });
            
        });
    </script>
                            
</body>

</html>