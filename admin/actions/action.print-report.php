<?php

// Include the FPDF library
require_once '../../vendor/autoload.php';
require '../../includes/pdo_conn.php';
require '../../includes/functions.php';

require '../includes/admin_query_set.php';
require '../includes/session_variables.php';

// Set the timezone to Philippines
date_default_timezone_set('Asia/Manila');

if (isset($_POST['print_report'])) {

    $username_admin = $_SESSION[$session_username];
    $activity_log = "$username_admin printed payroll report";
    $log_params = ['activity' => $activity_log, 'timestamp' => date('Y-m-d H:i:s')];
    $log_sql = createInsertSql('activity_logs', $log_params);
    $log_query = $pdo->prepare($log_sql);
    $log_query->execute($log_params);

    // --- Build base SQL
    $sql = "SELECT a.application_id, 
                   a.b_fname, a.b_mname, a.b_lname, 
                   s.amount, 
                   a.barangay,
                   s.scholarship_type
            FROM user_application as a 
            INNER JOIN scholarship as s 
                ON s.scholarship_id = a.scholarship_id 
            WHERE a.approved = 1 
              AND a.claim_date IS NOT NULL";

    $params = [];

    // --- Date filter
    if (!empty($_POST['start_date']) && !empty($_POST['end_date'])) {
        $sql .= " AND a.claim_date BETWEEN :start_date AND :end_date";
        $params['start_date'] = $_POST['start_date'];
        $params['end_date']   = $_POST['end_date'];
    }

    // --- Scholarship type filter
    if (!empty($_POST['scholarship_type'])) {
        $sql .= " AND s.scholarship_type = :scholarship_type";
        $params['scholarship_type'] = $_POST['scholarship_type'];
        $selected_scholarship_type = $_POST['scholarship_type'];
    } else {
        $selected_scholarship_type = "Scholarship Program";
    }

    // --- Barangay filter (optional)
    if (!empty($_POST['barangay'])) {
        $sql .= " AND a.barangay = :barangay";
        $params['barangay'] = $_POST['barangay'];
        $selected_barangay = $_POST['barangay'];
    } else {
        $selected_barangay = null;
    }

    // --- Semester filter (optional)
    if (!empty($_POST['semester'])) {
        $sql .= " AND a.semester = :semester";
        $params['semester'] = $_POST['semester'];
        $selected_semester = $_POST['semester'];
    } else {
        $selected_semester = null;
    }

    $sql .= " ORDER BY a.barangay ASC, a.b_fname ASC";

    $qry = $pdo->prepare($sql);
    $qry->execute($params);

    // --- PDF Starts Here ---
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

   $logo_left  = __DIR__ . '/../../resources/images/lgulallo.png';
$logo_right = __DIR__ . '/../../resources/images/evenbrighter.png';


    // Header with logos - adjusted positioning and size
    $pdf->SetFont('Arial', 'B', 12);
    
    // Left logo - moved closer to center and made larger
    if (file_exists($logo_left)) {
        $pdf->Image($logo_left, 80, 12, 25);
    } else {
        // Fallback if logo not found
        error_log("Left logo not found: " . $logo_left);
    }
    
    // Right logo - moved closer to center and made larger
    if (file_exists($logo_right)) {
        $pdf->Image($logo_right, 185, 12, 35);
    } else {
        // Fallback if logo not found
        error_log("Right logo not found: " . $logo_right);
    }
    
    // Center aligned text - adjusted positioning
    $pdf->SetY(15);
    $pdf->Cell(0, 8, "REPUBLIC OF THE PHILIPPINES", 0, 1, 'C');
    $pdf->Cell(0, 8, "PROVINCE OF CAGAYAN", 0, 1, 'C');
    $pdf->Cell(0, 8, "Municipality of Lal-lo", 0, 1, 'C');

    // Add some space
    $pdf->Ln(10);

    // Report title based on filters
    $pdf->SetFont('Arial', 'B', 14);
    
    if ($selected_barangay) {
        $report_title = "LIST OF QUALIFIED BENEFICIARIES OF THE " . strtoupper($selected_scholarship_type) . " OF " . strtoupper($selected_barangay);
    } else {
        $report_title = "LIST OF QUALIFIED BENEFICIARIES OF THE " . strtoupper($selected_scholarship_type);
    }
    
    $pdf->Cell(0, 10, $report_title, 0, 1, 'C');

    // Academic Year - dynamic based on current date
    $current_year = date('Y');
    $next_year = $current_year + 1;
    $academic_year = "$current_year-$next_year";
    $pdf->SetFont('Arial', 'B', 12);
    
    // Display semester if selected, otherwise just academic year
    if ($selected_semester) {
        $pdf->Cell(0, 10, "Academic Year: $academic_year | Semester: " . strtoupper($selected_semester), 0, 1, 'C');
    } else {
        $pdf->Cell(0, 10, "Academic Year: $academic_year", 0, 1, 'C');
    }

    // Date Range (optional)
    $pdf->SetFont('Arial', '', 10);
    if (!empty($_POST['start_date']) && !empty($_POST['end_date'])) {
        $pdf->Cell(0, 8, "Date Range: {$_POST['start_date']} to {$_POST['end_date']}", 0, 1, 'C');
    }

    // Add some space before table
    $pdf->Ln(10);

    // Table setup
    $pdf->SetFont('Arial', '', 11);
    $x = 15;
    $y = $pdf->GetY();

    $column_widths = array(20, 70, 40, 40, 20, 70);

    // Table headers
    $pdf->SetXY($x, $y);
    $pdf->Cell($column_widths[0], 16, "NO.", 1, 0, 'C');
    $pdf->Cell($column_widths[1], 8, "NAME", 1, 0, 'C');
    $pdf->SetXY($x + 20, $y + 8);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell($column_widths[1], 8, "(Last Name, First Name, M.I.)", 1, 0, 'C');
    $pdf->SetFont('Arial', '', 11);
    $pdf->SetXY($x + 90, $y);
    $pdf->Cell($column_widths[2], 16, "BARANGAY", 1, 0, 'C');
    $pdf->Cell($column_widths[3], 16, "AMOUNT", 1, 0, 'C');
    $pdf->Cell($column_widths[4], 16, "NO.", 1, 0, 'C');
    $pdf->Cell($column_widths[5], 16, "RECEIVED BY (SIGNATURE)", 1, 1, 'C');

    $y += 16;

    // Table rows
    $i = 1;
    $total_amount = 0;
    while ($row = $qry->fetch(PDO::FETCH_ASSOC)) {
        // Format name as "Last Name, First Name M.I."
        $name = $row['b_mname'] != '' 
              ? $row['b_lname'] . ', ' . $row['b_fname'] . ' ' . substr($row['b_mname'], 0, 1) . '.'
              : $row['b_lname'] . ', ' . $row['b_fname'];

        $pdf->SetXY($x, $y);
        $pdf->Cell($column_widths[0], 10, $i, 1, 0, 'C');
        $pdf->Cell($column_widths[1], 10, $name, 1, 0, 'L');
        $pdf->Cell($column_widths[2], 10, $row["barangay"], 1, 0, 'L');
        $pdf->Cell($column_widths[3], 10, number_format($row["amount"], 2), 1, 0, 'R');
        $pdf->Cell($column_widths[4], 10, $i, 1, 0, 'C');
        $pdf->Cell($column_widths[5], 10, "", 1, 0, 'C');
        $y += 10;

        $total_amount += $row["amount"];
        $i++;
    }

    // Total row
    $pdf->SetXY($x, $y);
    $pdf->Cell($column_widths[0] + $column_widths[1] + $column_widths[2], 10, "TOTAL", 1, 0, 'R');
    $pdf->Cell($column_widths[3], 10, number_format($total_amount, 2), 1, 0, 'R');
    $pdf->Cell($column_widths[4] + $column_widths[5], 10, "", 1, 0, 'C');

    $filename = "Beneficiaries_List_" . date('Y-m-d_H-i-s') . '.pdf';
    $pdf->Output('D', $filename);

} else {
    header('location: ../payroll_report.php');
}