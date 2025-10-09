<?php
require './includes/check_session.php';

$page = 'Scholarships';
require './includes/partial.head.php';
?>


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center" style="background-color:rgb(22, 110, 47);">
            <img class="animation__shake" src="../resources/images/lgulallo.png" alt="Logo" height="100" width="100">
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
                            <h1 class="m-0">Scholarships</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="dashboard.php">Home</a>
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

            <?php
            // include Add Modal Scholarship
            include_once './components/addModal_scholarship.php';
            // include Edit Modal Scholarship
            include_once './components/editModal_scholarship.php';
            // include Delete Modal Scholarship
            include_once './components/deleteModal_scholarship.php';
            ?>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-outline-success" data-toggle="modal" data-target="#addScholarship"><i class="fas fa-plus">ADD</i></button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="applicationTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Scholarship Type</th>
                                                <th>Amount</th>
                                                <th>Description</th>
                                                <th>Requirement</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $qry = $pdo->query("SELECT s.scholarship_id, s.scholarship_type, s.image_filename, s.amount, s.description, s.start_date, s.end_date, GROUP_CONCAT(rd.requirement_name SEPARATOR ', ') AS concatenated_value
                                            FROM scholarship AS s
                                            INNER JOIN requirement_data AS rd ON s.scholarship_id = rd.scholarship_id
                                            GROUP BY s.scholarship_id
                                            ORDER BY s.dt_created DESC;");
                                            while ($row = $qry->fetch(PDO::FETCH_ASSOC)) {
                                                $datetimeValuestart = $row['start_date'];
                                                $timestampstart = strtotime($datetimeValuestart);
                                                $startformattedDate = date('F d, Y h:i:s A', $timestampstart);

                                                $datetimeValueend = $row['end_date'];
                                                $timestampend = strtotime($datetimeValueend);
                                                $endformattedDate = date('F d, Y h:i:s A', $timestampend);
                                  
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        $imagePath = "../resources/image/" . $row['image_filename'];
                                                        $defaultImagePath = "../resources/image/default.jpg";
                                                        
                                                        if (file_exists($imagePath)) {
                                                            echo '<img src="' . $imagePath . '" alt="' . $row['image_filename'] . '" width="100" height="100">';
                                                        } else {
                                                            echo '<img src="' . $defaultImagePath . '" alt="Default Image" width="100" height="100">';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $row['scholarship_type'] ?></td>
                                                    <td>&#8369;<?php echo $row['amount'] ?></td>
                                                    <td><?php echo $row['description'] ?></td>
                                                    <td><?php echo $row['concatenated_value'] ?></td>
                                                    <td><?php echo $startformattedDate ?></td>
                                                    <td><?php echo $endformattedDate ?></td>
                                                    <td>
                                                        <button class="btn btn-outline-primary" data-toggle="modal" data-target="#editScholarship" onclick="editScholarship(`<?= $row['scholarship_id'] ?>`,`<?= $row['scholarship_type'] ?>`,`<?= $row['amount'] ?>`,`<?= $row['description'] ?>`,`<?= $row['start_date'] ?>`, `<?= $row['end_date'] ?>`,`<?= $row['image_filename'] ?>`);">
                                                            <i class="fas fa-pen"></i>
                                                        </button>

                                                    </td>

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                                <th></th>
                                                <th class="th">Scholarship Type</th>
                                                <th  class="th">Amount</th>
                                                <th class="th">Description</th>
                                                <th class="th">Requirement</th>
                                                <th class="th">Start Date</th>
                                                <th class="th">End Date</th>
                                                <th></th>

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
        <?php include_once 'includes/footer.php'; ?>
    </div>
    <!-- ./wrapper -->

    <?php require './includes/partial.script-imports.php'; ?>

    <script>

        $(document).ready(function() {

    $('table#applicationTable tfoot .th').each(function() {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search" style="width: 100px; border-radius: 5px;">');
    });

    $('#applicationTable').DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: true,
        buttons: [
            "copy",
            "csv",
            "excel",
            "pdf",
            "print",
            "colvis"
        ],
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
    }).buttons().container().appendTo('#applicationTable_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
        paging: true,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true
    });

   $(document).ready(function() {
            //Date range picker with time picker
            $('#scholarship_date_range').daterangepicker({
            startDate: moment().startOf('month'),
        endDate: moment().endOf('month'),
        minDate: moment().startOf('day'),
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [
                moment().subtract(1, 'month').startOf('month'),
                moment().subtract(1, 'month').endOf('month')
            ]
        },
        opens: 'left',
        locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            })
        });
});


        function editScholarship(id, scho_type, amount, description, start_date, end_date, image_filename) {
            $('#edit_scholarship_id').val(id)
            $('#edit_scholarship_type').val(scho_type)
            $('#edit_amount').val(amount)
            $('#edit_description').val(description)
            $("#edit-upload-img").attr("src", "../resources/image/" + image_filename);
           
            var dateRange = start_date + ' - ' + end_date;

            $('#edit_scholarship_date_range').daterangepicker({
                startDate: start_date,
                endDate: end_date,
                timePicker: true,
                locale: {
                  format: 'YYYY-MM-DD HH:mm:ss'
                }
              });

            $('#edit_scholarship_date_range').val(dateRange);
        }

        function delete_scholarship(id, image_filename) {
            $('#delete_scholarship_id').val(id)
            $('#image_filename').val(image_filename)
        }
    </script>
</body>

</html>