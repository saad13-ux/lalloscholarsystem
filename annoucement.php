<?php
include './includes/pdo_conn.php';
include './includes/session_variables.php';
if (!$_SESSION[$session_reg_complete]) {
    header('location: complete_registration.php');
    exit();
}
// echo "Logged in as " . $_SESSION['scholarship_ms.user.username'];
$page = "Dashboard";
require './includes/partial.head.php';
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

    <div class="preloader flex-column justify-content-center align-items-center" style="background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('resources/images/lallol.jpg') no-repeat;
width: 100%;
  height: 100%;
  padding: 0px;
  margin: 0px;
  background-repeat: repeat;
  background-size: cover;
  background-position: fixed;
		}">
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
                    <div class="row mb-5">
                        <div class="col-sm-6">
                            <h1 class="m-0">New Accepted Scholarship Grantees</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="#" class="link-offset-2 link-underline link-underline-opacity-0" >Home</a>
                                </li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row mb-2">
                        <?php

                        $announcement_sql = "SELECT *, concat(a.b_fname, ' ', a.b_lname) as b_name FROM user_application as a INNER JOIN scholarship as s ON a.scholarship_id = s.scholarship_id WHERE a.approved = 1 AND a.claim_date IS NOT NULL AND a.user_id== '$_SESSION[$session_user_id]'";
                        $announcement_qry = $pdo->query($announcement_sql);
                        while ($row = $announcement_qry->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <div class="col-md-6 col-sm-12">
                                <div class="card d-flex flex-row px-3 py-2">
                                    <img class="card-img-left scholar-image" width="150px" height="150px" src="./resources/files/<?= $row['id_pic_file'] ?>" alt="">
                                    <div class="card-body">
                                        <h4 class=""><?= $row['b_name'] ?></h4>
                                        <h6 class=""><?= $row['scholarship_type'] ?></h6>
                                        <p class="card-text">Amount: <?= $row['amount'] ?></p>
                                        <p class="card-text">Claim Date: <?= $row['claim_date'] ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include_once 'includes/footer.php'; ?>
    </div>
    <!-- ./wrapper -->

    <?php require './includes/partial.script-imports.php'; ?>
</body>

</html>