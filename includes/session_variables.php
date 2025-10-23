<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Simple session variable names that match your login system
$session_user_id = "user_id";
$session_username = "username";
$session_email = "email";
$session_fname = "first_name";
$session_mname = "middle_name";
$session_lname = "last_name";
$session_ext_name = "ext_name";
$session_gender = "gender";
$session_dob = "dob";
$session_email_verified = "email_verified";
$session_email_vcode = "email_vcode";
$session_reg_complete = "registration_complete";
$session_mobile = "mobile_no";
$session_civil_status = "civil_status";
$session_nationality = "nationality";
$session_religion = "religion";
$session_highest_education = "highest_education";

// Address-related session variables
$session_barangay = "barangay";
$session_municipality = "municipality";
$session_province = "province";
$session_region = "region";
$session_address = "address"; // Add this missing variable

// Academic session variables
$session_school_name = "school_name";
$session_school_year = "school_year";
$session_year_level = "year_level";
$session_semester = "semester";

// Other personal info
$session_pob = "pob";
$session_monthly_income = "monthly_income";
$session_skills_occupation = "skill_occupation"; // Add this missing variable
?>