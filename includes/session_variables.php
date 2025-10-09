<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Define session variable names with prefixes
$db_name = 'data_database_scholarshipedit'; // Make sure this is defined
$session_prefix = $db_name . '.user.';

// Set individual session variable names
$session_user_id = $session_prefix . "user_id";
$session_username = $session_prefix . "username";
$session_email = $session_prefix . "email";
$session_fname = $session_prefix . "first_name";
$session_mname = $session_prefix . "middle_name";
$session_lname = $session_prefix . "last_name";
$session_ext_name = $session_prefix . "ext_name";
$session_gender = $session_prefix . "gender";
$session_dob = $session_prefix . "dob";
$session_email_verified = $session_prefix . "email_verified";
$session_email_vcode = $session_prefix . "email_vcode";
$session_reg_complete = $session_prefix . "registration_complete";
$session_mobile = $session_prefix . "mobile_no";
$session_civil_status = $session_prefix . "civil_status";
$session_nationality = $session_prefix . "nationality";
$session_religion = $session_prefix . "religion";
$session_highest_education = $session_prefix . "highest_education";

// Add address-related session variables
$session_barangay = $session_prefix . "barangay";
$session_municipality = $session_prefix . "municipality";
$session_province = $session_prefix . "province";
$session_region = $session_prefix . "region";

// Academic session variables
$session_school_name = $session_prefix . "school_name";
$session_school_year = $session_prefix . "school_year";
$session_year_level = $session_prefix . "year_level";
$session_semester = $session_prefix . "semester";

// Other personal info
$session_pob = $session_prefix . "pob";
$session_monthly_income = $session_prefix . "monthly_income";
?>