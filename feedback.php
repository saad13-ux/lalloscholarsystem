<?php
require './includes/user_check_session.php';

$page = 'Feedback';
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
                            <h1 class="m-0">Feedback</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="index.php">Home</a>
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
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col col-md-6 offset-md-3 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3>
                                        Send a Feedback
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <form action="actions/action.send-feedback.php" method="POST">
                                    <input type="hidden" name="redirect" value="feedback">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input required readonly type="text" class="form-control" name="name" value="<?= $_SESSION[$session_fname] . ' ' . $_SESSION[$session_lname] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input required readonly type="text" class="form-control" name="email" value="<?= $_SESSION[$session_email] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="subject">Subject</label>
                                            <input required type="text" class="form-control" name="subject" placeholder="What is this about...">
                                        </div>
                                        <div class="form-group">
                                            <label for="body">Body</label>
                                            <textarea required type="text" class="form-control" name="body" rows="5" placeholder="Tell us what you think..."></textarea>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary" name="send_feedback"><i class='fa fa-paper-plane' aria-hidden='true'></i> Send Feedback</button>
                                    </div>
                                </form>
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

    <?php require './includes/partial.script-imports.php' ?>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        function editScholarship(id, scho_type, amount, description) {
            $('#scholarship_id').val(id)
            $('#scholarship_type').val(scho_type)
            $('#amount').val(amount)
            $('#description').val(description)
        }

        function delete_scholarship(id) {
            $('#delete_scholarship_id').val(id)
        }
    </script>
</body>

</html>