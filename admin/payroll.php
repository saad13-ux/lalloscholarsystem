<?php
require './includes/check_session.php';

$page = 'Payroll';
require './includes/partial.head.php';
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center" style="background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('../resources/images/lallol.jpg') no-repeat;
width: 100%;
  height: 100%;
  padding: 0px;
  margin: 0px;
  background-repeat: repeat;
  background-size: cover;
  background-position: fixed;
		}">
            <img class="animation__shake" src="../resources/images/lgulallo.png" alt="Logo" height="100" width="100" >
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
                            <h1 class="m-0">Payroll of Educational Grants</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="dashboard.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Payroll Records</li>
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
                                <div class="card-header d-flex align-items-center">
                                    <i class="fas fa-table" aria-hidden="true"></i>
                                    <h5 class="mb-0 ml-1">Approved Applications</h5>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="applicationTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Scholarship Type</th>
                                                <th>Name</th>
                                                <th>Barangay</th>
                                                <th>Amount</th>
                                                <th>Signature</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $qry = $pdo->query("SELECT a.application_id, concat(a.b_fname, ' ', a.b_lname) as b_name,  s.scholarship_type, s.amount, a.barangay, a.claim_date, a.claimed FROM user_application as a inner join scholarship as s on s.scholarship_id = a.scholarship_id WHERE a.approved = 1;");
                                            while ($row = $qry->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <tr>
                                                    <td><?= $row['scholarship_type'] ?></td>
                                                    <td><?= $row['b_name'] ?></td>
                                                    <td><?= $row['barangay'] ?></td>
                                                    <td>&#8369;<?= $row['amount'] ?></td>
                                                    <td></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
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
        <?php include './components/announcementModal.php'; ?>
        <?php include_once 'includes/footer.php'; ?>
    </div>
    <!-- ./wrapper -->

    <?php
    require './includes/partial.script-imports.php';
    ?>
    <script>
        $(function() {
            $("#applicationTable")
                .DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": [
                        "copy",
                        "csv",
                        "excel",
                        "pdf",
                        "print",
                        "colvis"
                    ]
                })
                .buttons()
                .container()
                .appendTo('#applicationTable_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });
        });
    </script>
</body>

</html>