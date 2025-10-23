<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-rgb(22, 110, 47); elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link justify-content-center text-align-center link-offset-2 link-underline link-underline-opacity-0" style="background-color: rgba(18, 91, 38, 1);">
        <img src="resources/images/lgulallo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">&nbsp;LGU LAL-LO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background-color: rgb(22, 110, 47);">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php
                // Start session safely
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                // Include session variables to get the proper session variable names
                @include_once './includes/session_variables.php';

                // Safely get session values using your defined session variables with proper fallbacks
                $user_id = null;
                $fname = '';
                $lname = '';

                // Check if session variables are defined and exist in $_SESSION
                if (isset($session_user_id) && isset($_SESSION[$session_user_id])) {
                    $user_id = $_SESSION[$session_user_id];
                }
                if (isset($session_fname) && isset($_SESSION[$session_fname])) {
                    $fname = $_SESSION[$session_fname];
                }
                if (isset($session_lname) && isset($_SESSION[$session_lname])) {
                    $lname = $_SESSION[$session_lname];
                }

                // Default profile image
                $imagePath = "./resources/profile/user.png";

                if ($user_id && isset($pdo)) {
                    try {
                        $stmt = $pdo->prepare("SELECT image_filename FROM user WHERE user_id = :user_id");
                        $stmt->bindParam(':user_id', $user_id);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($row && !empty($row['image_filename'])) {
                            $tempPath = "./resources/profile/" . $row['image_filename'];
                            if (file_exists($tempPath)) {
                                $imagePath = $tempPath;
                            }
                        }
                    } catch (PDOException $e) {
                        // Silently handle database errors for profile image
                        error_log("Profile image error: " . $e->getMessage());
                    }
                }
                ?>
                <img src="<?= htmlspecialchars($imagePath) ?>" class="img-size-10 mr-1 img-circle" style="width:40px; height:40px;" alt="User Image">
            </div>

            <div class="info text-uppercase">
                <a href="#" class="d-block">
                    <?= htmlspecialchars($fname) ?> <?= htmlspecialchars($lname) ?>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="index.php" class="nav-link <?= ($page ?? '') === 'Home' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link <?= ($page ?? '') === 'Dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-bullhorn"></i>
                        <p>Announcements</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="status.php" class="nav-link <?= ($page ?? '') === 'Status' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Application Status</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="scholarships.php" class="nav-link <?= ($page ?? '') === 'Scholarships' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-graduation-cap"></i>
                        <p>
                            Scholarships
                            <?php
                            if (isset($pdo)) {
                                try {
                                    $qry = $pdo->query("SELECT COUNT(*) AS cnt FROM scholarship WHERE (dt_created + INTERVAL 3 DAY >= NOW())");
                                    $result = $qry->fetch(PDO::FETCH_ASSOC);
                                    if ($result && $result['cnt'] > 0) {
                                        echo '<span class="badge badge-danger">' . htmlspecialchars($result['cnt']) . '</span>';
                                    }
                                } catch (PDOException $e) {
                                    // Silently handle database errors for scholarship count
                                    error_log("Scholarship count error: " . $e->getMessage());
                                }
                            }
                            ?>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="application.php" class="nav-link <?= ($page ?? '') === 'Applications' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-address-book"></i>
                        <p>My Applications</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="feedback.php" class="nav-link <?= ($page ?? '') === 'Feedback' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-comment-dots"></i>
                        <p>Feedback</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>