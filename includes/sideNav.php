<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-rgb(22, 110, 47); elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link justify-content-center text-align-center link-offset-2 link-underline link-underline-opacity-0" style="background-color: rgba(18, 91, 38, 1);" >
        <img src="resources/images/lgulallo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">&nbsp;LGU LAL-LO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background-color: rgb(22, 110, 47);">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php
                $user_id = $_SESSION[$session_user_id];

                // Prepare and execute the query
                $stmt = $pdo->prepare("SELECT image_filename FROM user WHERE user_id = :user_id");
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();

                // Fetch the result
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $imagePath = "./resources/profile/" . $row['image_filename'];
                $defaultImagePath = "./resources/profile/user.png";

                if (file_exists($imagePath)) {
                    ?>
                    <img src="<?= $imagePath ?>" class="img-size-10 mr-1 img-circle" style="width:40px; height: 40px;" alt="<?= $imagePath ?>">
                    <?php
                } else {
                    ?>
                    <img src="<?= $defaultImagePath ?>" class="img-size-10 mr-1 img-circle" style="width:40px; height: 40px;" alt="User Image">
                <?php
                }
                ?>
            </div>
            <div class="info text-uppercase">
                <a href="#" class="d-block"><?php echo $_SESSION[$session_fname];?>&nbsp; <?php echo $_SESSION[$session_lname];?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="index.php" class="nav-link <?= $page == 'Home' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link <?= $page == 'Dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-bullhorn"></i>
                        <p>Announcements</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="status.php" class="nav-link <?= $page == 'Status' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Application Status</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="scholarships.php" class="nav-link <?= $page == 'Scholarships' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-graduation-cap"></i>
                        <p>
                            Scholarships
                            <?php
                            $qry = $pdo->query("SELECT count(*) as cnt FROM scholarship WHERE (dt_created + interval 3 DAY >= now())");
                            $result = $qry->fetch(PDO::FETCH_ASSOC);
                            if ($result['cnt'] > 0) {
                            ?>
                                <span class="badge badge-danger"><?= $result['cnt'] ?></span>
                            <?php } ?>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="application.php" class="nav-link <?= $page == 'Applications' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-address-book"></i>
                        <p>My Applications</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="feedback.php" class="nav-link <?= $page == 'Feedback' ? 'active' : '' ?>">
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
