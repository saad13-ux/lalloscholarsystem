<?php

header("location: ../payroll_report.php");
if (isset($_POST['filter_report'])) {
    $dates = explode(" - ", $_POST['date_range']);

    $params = array();
    $params['start_date'] = date("Y-m-d", strtotime($dates[0]));
    $params['end_date'] = date("Y-m-d", strtotime($dates[1]));

    if ($params['start_date'] != '' && $params['end_date'] != '') {
        header("location: ../payroll_report.php?start_date=" . $params['start_date'] . "&end_date=" . $params['end_date']);
    }
}elseif (isset($_POST['reset'])) {
	header("location: ../payroll_report.php");
}
