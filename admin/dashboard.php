<?php
require './includes/check_session.php';
$page = "Dashboard";
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
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="dashboard.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Dashboard</li>
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
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <?php
                                    $result = $pdo->query('SELECT user_id FROM user')->rowCount();
                                    ?>
                                    <h3><?= $result; ?></h3>                                    
                                    <p>Accounts</p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fa fa-users"></i>
                                </div>
                                <a href="account.php" class="small-box-footer">More info
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <?php
                                    $result = $pdo->query('SELECT feedback_id FROM feedback')->rowCount();
                                    ?>
                                    <h3><?= $result; ?></h3>
                                    <p>Feedback</p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fa fa-comment"></i>
                                </div>
                                <a href="feedback.php" class="small-box-footer">More info
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <?php
                                    $result = $pdo->query('SELECT application_id FROM user_application')->rowCount();
                                    ?>
                                    <h3><?= $result; ?></h3>
                                    <p>Application</p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fa fa-address-book"></i>
                                </div>
                                <a href="application.php" class="small-box-footer">More info
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <?php
                                    $result = $pdo->query('SELECT scholarship_id FROM scholarship')->rowCount();
                                    ?>
                                    <h3><?= $result; ?></h3>
                                    <p>Scholarships</p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fa fa-graduation-cap"></i>
                                </div>
                                <a href="scholarships.php" class="small-box-footer">More info
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <?php
                                    $result = $pdo->query('SELECT application_id FROM user_application WHERE approved = 1')->rowCount();
                                    ?>
                                    <h3><?= $result; ?></h3>
                                    <p>Approved Applicant</p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fa fa-user-check"></i>
                                </div>
                                <a href="reports.php" class="small-box-footer">More info
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <?php
                                    $result = $pdo->query('SELECT application_id FROM user_application WHERE approved = 2')->rowCount();
                                    ?>
                                    <h3><?= $result; ?></h3>
                                    <p>Declined Applicant</p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fa fa-user-times"></i>
                                </div>
                                <a href="decline.php" class="small-box-footer">More info
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <?php
                                    $result = $pdo->query('SELECT application_id FROM user_application WHERE approved = 0')->rowCount();
                                    ?>
                                    <h3><?= $result; ?></h3>
                                    <p>Submitted Applicant</p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fa fa-user"></i>
                                </div>
                                <a href="pending.php" class="small-box-footer">More info
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                                <div class="inner">
                                    <?php
                                    $result = $pdo->query('SELECT application_id FROM user_application WHERE approved = 3')->rowCount();
                                    ?>
                                    <h3><?= $result; ?></h3>
                                    <p>Pending Applicant</p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fa fa-list"></i>
                                </div>
                                <a href="ongoing.php" class="small-box-footer">More info
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>



                        </div>
                        
                    <div class="container-fluid">
                    <?php
                            // Assuming you have already established a database connection ($pdo)

                            $result = $pdo->query('SELECT scholarship_type  
                                                FROM user_application
                                                INNER JOIN scholarship ON user_application.scholarship_id=scholarship.scholarship_id 
                                                GROUP BY scholarship_type');

                            $scholarshipTypes = $result->fetchAll(PDO::FETCH_COLUMN);
                            ?>
                            <!-- Add filter elements -->
                            <label for="filter">Filter by:</label>
                            <select id="filter">
                            <option value="all"  disabled selected >Please Select</option>
                                <?php
                                foreach ($scholarshipTypes as $type) {
                                    echo '<option value="' . htmlspecialchars($type) . '">' . htmlspecialchars($type) . '</option>';
                                }
                                ?>
                                </select>
                            
                        <div class="row">
                        
                        <!-- Row for 3 Summary Charts -->
<div class="col-md-4">
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header bg-primary text-white fw-bold">
            TOTAL SCHOLARSHIP PROGRAM APPLICANTS
        </div>
        <div class="card-body d-flex justify-content-center align-items-center" style="min-height: 300px;">
            <canvas id="pie-chart"></canvas>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header bg-info text-white fw-bold">
            TOTAL SCHOLARSHIP SEX
        </div>
        <div class="card-body d-flex justify-content-center align-items-center" style="min-height: 300px;">
            <canvas id="doughnut_chart"></canvas>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header bg-success text-white fw-bold">
            TOTAL APPLICATION STATUS
        </div>
        <div class="card-body d-flex justify-content-center align-items-center" style="min-height: 300px;">
            <canvas id="pie_chart"></canvas>
        </div>
    </div>
</div>

<!-- Bar Chart -->
<div class="col-md-12">
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header bg-secondary text-white fw-bold">
            NO. OF SCHOLARS BY BARANGAY (Approved)
        </div>
        <div class="card-body">
            <div class="chart-container" style="height:500px;">
                <canvas id="bar_chart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Approved Applicants Per Scholarship Type -->
<div class="col-md-12">
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header bg-dark text-white fw-bold d-flex justify-content-between align-items-center">
            LIST OF APPROVED APPLICANTS
            <span class="badge bg-warning text-dark">
                <?php
                $totalStmt = $pdo->query("SELECT COUNT(*) AS total FROM user_application WHERE approved = 1");
                $total = $totalStmt->fetch(PDO::FETCH_ASSOC);
                echo "Total Beneficiaries: " . number_format($total['total']);
                ?>
            </span>
        </div>
        <div class="card-body" style="max-height: 500px; overflow-y: auto;">
            <?php
            $stmt = $pdo->query("
                SELECT s.scholarship_type, a.b_fname, a.b_lname, a.school_name, a.year_level, a.school_year, a.semester, a.barangay
                FROM user_application a
                INNER JOIN scholarship s ON a.scholarship_id = s.scholarship_id
                WHERE a.approved = 1
                ORDER BY s.scholarship_type, a.b_lname
            ");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $grouped = [];
            foreach ($results as $row) {
                $grouped[$row['scholarship_type']][] = $row;
            }

            if (!empty($grouped)) {
                foreach ($grouped as $type => $applicants) {
                    echo "<h5 class='mt-3 text-primary fw-bold'>" . htmlspecialchars($type) . " <span class='badge bg-success'>" . count($applicants) . "</span></h5>";
                    echo "<div class='table-responsive'>";
                    echo "<table class='table table-sm table-hover align-middle'>";
                    echo "<thead class='table-light'><tr>
                            <th>Name</th>
                            <th>School</th>
                            <th>Year Level</th>
                            <th>School Year</th>
                            <th>Semester</th>
                            <th>Barangay</th>
                          </tr></thead><tbody>";
                    foreach ($applicants as $app) {
                        echo "<tr>
                                <td><i class='bi bi-person-badge text-secondary me-2'></i>" . htmlspecialchars($app['b_lname'] . ', ' . $app['b_fname']) . "</td>
                                <td>" . htmlspecialchars($app['school_name']) . "</td>
                                <td>" . htmlspecialchars($app['year_level']) . "</td>
                                <td>" . htmlspecialchars($app['school_year']) . "</td>
                                <td>" . htmlspecialchars($app['semester']) . "</td>
                                <td>" . htmlspecialchars($app['barangay']) . "</td>
                              </tr>";
                    }
                    echo "</tbody></table></div>";
                }
            } else {
                echo "<p class='text-muted'>No approved applicants yet.</p>";
            }
            ?>
        </div>
    </div>
</div>





                        
                        </div>
                    </div>
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
</body>
<script>
$(document).ready(function(){

    // keep chart instances globally so we can destroy them before redraw
    var graph1, graph2, graph3, graph4;

    function updateCharts(filterValue) {
        makechart(filterValue);
        makechartgender(filterValue);
        makechartprogram(filterValue);
        makechartbarangay(filterValue);
    }

    // =============================
    // 1. TOTAL APPLICATION STATUS
    // =============================
    function makechart(filterValue) {
        $.ajax({
            url: "data.php",
            method: "POST",
            data: { action: 'fetch', filter: filterValue },
            dataType: "JSON",
            success: function (data) {
                var approved = [], total = [], color = [];

                for (var count = 0; count < data.length; count++) {
                    approved.push(data[count].approved);
                    total.push(data[count].total);
                    color.push(data[count].color);
                }

                var chart_data = {
                    labels: approved,
                    datasets: [{ label: 'Applicant', backgroundColor: color, data: total }]
                };

                if (graph1) graph1.destroy(); // ✅ clear old chart
                var ctx = document.getElementById("pie_chart").getContext("2d");
                graph1 = new Chart(ctx, { type: "pie", data: chart_data });
            }
        });
    }

    // =============================
    // 2. TOTAL SCHOLARSHIP GENDER
    // =============================
    function makechartgender(filterValue) {
        $.ajax({
            url: "data.php",
            method: "POST",
            data: { action: 'fetch2', filter: filterValue },
            dataType: "JSON",
            success: function (data) {
                var gender = [], total = [], color = [];

                for (var count = 0; count < data.length; count++) {
                    gender.push(data[count].gender);
                    total.push(data[count].total);
                    color.push(data[count].color);
                }

                var chart_data = {
                    labels: gender,
                    datasets: [{ label: 'Gender', backgroundColor: color, data: total }]
                };

                if (graph2) graph2.destroy(); // ✅ clear old chart
                var ctx = document.getElementById("doughnut_chart").getContext("2d");
                graph2 = new Chart(ctx, { type: "doughnut", data: chart_data });
            }
        });
    }

    // =============================
    // 3. TOTAL SCHOLARSHIP PROGRAM
    // =============================
    function makechartprogram(filterValue) {
        $.ajax({
            url: "data.php",
            method: "POST",
            data: { action: 'fetch4', filter: filterValue },
            dataType: "JSON",
            success: function (data) {
                var type = [], total = [], color = [];

                for (var count = 0; count < data.length; count++) {
                    type.push(data[count].type);
                    total.push(data[count].total);
                    color.push(data[count].color);
                }

                var chart_data = {
                    labels: type,
                    datasets: [{ label: 'Type', backgroundColor: color, data: total }]
                };

                if (graph3) graph3.destroy(); // ✅ clear old chart
                var ctx = document.getElementById("pie-chart").getContext("2d");
                graph3 = new Chart(ctx, { type: "pie", data: chart_data });
            }
        });
    }

    
    // =============================
    // 4. NO. OF SCHOLARS BY BARANGAY
    // =============================
   

    function makechartbarangay(filterValue) {
    $.ajax({
        url: "data.php",
        method: "POST",
        data: { action: 'fetch3', filter: filterValue },
        dataType: "JSON",
        success: function (data) {
            // Get unique barangays and scholarship types
            var barangays = [...new Set(data.map(d => d.barangay))];
            var scholarshipTypes = [...new Set(data.map(d => d.scholarship_type))];

            // Define a fixed color palette
            var colorPalette = ['#FF6384','#36A2EB','#FFCE56','#4BC0C0','#9966FF','#FF9F40'];

            // Preprocess data into a dictionary for faster lookup
            var dataDict = {};
            data.forEach(item => {
                if (!dataDict[item.barangay]) dataDict[item.barangay] = {};
                dataDict[item.barangay][item.scholarship_type] = item.total;
            });

            // Build datasets
            var datasets = scholarshipTypes.map((type, index) => {
                return {
                    label: type,
                    backgroundColor: colorPalette[index % colorPalette.length],
                    data: barangays.map(bar => dataDict[bar]?.[type] || 0)
                };
            });

            var chart_data = {
                labels: barangays,
                datasets: datasets
            };

            var options = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: { stacked: true, ticks: { autoSkip: false, maxRotation: 45, minRotation: 0 } },
                    y: { stacked: true, beginAtZero: true, ticks: { stepSize: 1 } }
                },
                plugins: {
                    legend: { display: true },
                    tooltip: { enabled: true }
                }
            };

            if (graph4) graph4.destroy();
            var ctx = document.getElementById("bar_chart").getContext("2d");
            graph4 = new Chart(ctx, { type: "bar", data: chart_data, options: options });
        }
    });
}



    // =============================
    // INIT
    // =============================
    updateCharts('all');

    $('#filter').on('change', function() {
        var selectedFilter = $(this).val();
        updateCharts(selectedFilter);
    });
});
</script>


</html>