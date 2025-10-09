<?php
include 'includes/pdo_conn.php';
include 'includes/session_variables.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Helper function to get session values safely
function getSessionValue($session_var_name, $default = '') {
    return isset($_SESSION[$session_var_name]) ? $_SESSION[$session_var_name] : $default;
}

// Check if user is logged in
if (!isset($_SESSION[$session_user_id])) {
    // Redirect to login if not authenticated
    header("Location: login.php");
    exit();
}

// Get scholarship details from URL
$id = $_GET['scholarship_id'] ?? '';
$type = $_GET['scholarship_type'] ?? '';
$amount = $_GET['amount'] ?? '';
$description = $_GET['description'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scholarship Registration</title>
    <link href="resources/images/logo1.webp" rel="icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
    :root {
      --primary-color: #0b4eb3;
      --secondary-color: #f0f7ff;
    }

    body {
      font-family: 'Montserrat', sans-serif;
      background: #f7f9fc;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      padding: 20px;
    }

    .card-form {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      padding: 2rem;
      width: 100%;
      max-width: 700px;
    }

    h1, h3 {
      color: var(--primary-color);
    }

    .applicant-container {
      display: flex;
      justify-content: center;
      gap: 1rem;
      margin-bottom: 2rem;
      flex-wrap: wrap;
    }

    .option-card {
      flex: 1 1 180px;
      max-width: 220px;
      background: #fff;
      border: 2px solid #ccc;
      border-radius: 15px;
      padding: 1rem;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .option-card:hover {
      border-color: var(--primary-color);
      background: var(--secondary-color);
      transform: translateY(-3px);
    }

    .option-card input[type="radio"] {
      display: none;
    }

    .option-card label {
      display: flex;
      flex-direction: column;
      align-items: center;
      font-weight: 600;
      color: #333;
      cursor: pointer;
      margin: 0;
    }

    .option-card i {
      font-size: 3rem;
      margin-bottom: 0.5rem;
      color: var(--primary-color);
    }

    .option-card input[type="radio"]:checked + label {
      border-color: var(--primary-color);
      background: var(--secondary-color);
      box-shadow: 0 0 12px rgba(11,78,179,0.3);
    }

    .progressbar {
      display: flex;
      justify-content: space-between;
      position: relative;
      margin: 2rem 0;
      counter-reset: step;
    }

    .progressbar::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 0;
      width: 100%;
      height: 6px;
      background-color: #dcdcdc;
      transform: translateY(-50%);
      z-index: -1;
      border-radius: 3px;
    }

    .progressline {
      height: 6px;
      background: var(--primary-color);
      width: 0;
      position: absolute;
      top: 50%;
      left: 0;
      transform: translateY(-50%);
      border-radius: 3px;
      transition: width 0.3s ease;
    }

    .progress-step {
      width: 2.5rem;
      height: 2.5rem;
      background: #dcdcdc;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 2;
      position: relative;
      font-size: 1rem;
      color: #fff;
    }

    .progress-step-active {
      background: var(--primary-color);
    }

    .form-step {
      display: none;
      animation: fadeIn 0.5s ease;
    }

    .form-step-active {
      display: block;
    }

    @keyframes fadeIn {
      from {opacity:0; transform: translateY(-10px);}
      to {opacity:1; transform: translateY(0);}
    }

    input, select, textarea {
      width: 100%;
      padding: 0.7rem;
      border-radius: 10px;
      border: 1px solid #ccc;
      margin-bottom: 1rem;
      outline: none;
      transition: 0.3s;
    }

    input:focus, select:focus, textarea:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 5px rgba(11,78,179,0.3);
    }

    .btn-primary {
      background: var(--primary-color);
      border: none;
      color: #fff;
      padding: 0.7rem 1.5rem;
      border-radius: 10px;
      transition: 0.3s;
      cursor: pointer;
    }

    .btn-primary:hover {
      background: #084cdf;
    }

    .btn-secondary {
      background: #6c757d;
      border: none;
      color: #fff;
      padding: 0.7rem 1.5rem;
      border-radius: 10px;
      transition: 0.3s;
      cursor: pointer;
    }

    .btn-secondary:hover {
      background: #5a6268;
    }

    .btns-group {
      display: flex;
      justify-content: space-between;
      gap: 1rem;
      flex-wrap: wrap;
      margin-top: 1.5rem;
    }

    .family-composition-group {
      border: 1px solid #ddd;
      padding: 1.5rem;
      border-radius: 10px;
      margin-bottom: 1.5rem;
      background: #f9f9f9;
      position: relative;
    }

    .family-composition-group:first-child {
      border-color: var(--primary-color);
      background: var(--secondary-color);
    }

    .family-composition-group:first-child::before {
      content: "Primary Family Member";
      position: absolute;
      top: -10px;
      left: 15px;
      background: var(--primary-color);
      color: white;
      padding: 2px 10px;
      border-radius: 5px;
      font-size: 0.8rem;
    }

    .remove-family-member {
      background: #dc3545;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 0.5rem 1rem;
      cursor: pointer;
      margin-top: 0.5rem;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
      gap: 0.3rem;
    }

    .remove-family-member:hover {
      background: #c82333;
    }

    #add_family_member {
      margin-top: 0.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .form-row {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .form-col {
      flex: 1 1 calc(50% - 1rem);
      min-width: 200px;
    }

    .form-col-full {
      flex: 1 1 100%;
    }

    .section-divider {
      border-top: 1px solid #ddd;
      margin: 1.5rem 0;
    }

    .requirement-item {
      margin-bottom: 1rem;
      padding: 1rem;
      border: 1px solid #ddd;
      border-radius: 10px;
      background: #f9f9f9;
    }

    .requirement-item label {
      font-weight: 600;
      margin-bottom: 0.5rem;
      display: block;
    }

    .file-input {
      position: relative;
      overflow: hidden;
    }

    .file-input input[type="file"] {
      position: absolute;
      left: 0;
      top: 0;
      opacity: 0;
      width: 100%;
      height: 100%;
      cursor: pointer;
    }

    .file-input-label {
      display: block;
      padding: 0.7rem;
      background: #f8f9fa;
      border: 1px dashed #ccc;
      border-radius: 10px;
      text-align: center;
      cursor: pointer;
      transition: 0.3s;
    }

    .file-input-label:hover {
      background: #e9ecef;
    }

    @media (max-width: 768px) {
      .form-col {
        flex: 1 1 100%;
      }
      
      .card-form {
        padding: 1rem;
      }
    }
    </style>
</head>

<body>
    <div class="card-form">
        <form class="form" method="post" action="actions/action.apply-scholarship.php" id="myForm" name="myForm" enctype="multipart/form-data" onsubmit="return checkForm(this);">
            <input type="hidden" name="scholarship_id" id="scholarship_id" value="<?php echo htmlspecialchars($id); ?>"> 
            
            <h1 class="text-center">Scholarship Application</h1>
            
            <div class="applicant-container">
                <div class="option-card">
                    <input type="radio" name="type" value="new" id="new_checkbox">
                    <label for="new_checkbox">
                        <i class="fa fa-user-plus"></i>
                        <span>New Applicant</span>
                    </label>
                </div>

                <div class="option-card">
                    <input type="radio" name="type" value="old" id="old_checkbox">
                    <label for="old_checkbox">
                        <i class="fa fa-user-check"></i>
                        <span>Old Applicant</span>
                    </label>
                </div>
            </div>

            <div id="form">
                <div class="progressbar">
                    <div class="progressline" id="progressline"></div>
                    
                    <div class="progress-step progress-step-active" data-title=""><i class="fa fa-graduation-cap" aria-hidden="true"></i></div>
                    <div class="progress-step" data-title=""><i class="fa fa-user-circle" aria-hidden="true"></i></div>   
                    <div class="progress-step" data-title=""><i class="fa fa-id-card" aria-hidden="true"></i></div>
                    <div class="progress-step" data-title=""><i class="fa fa-map-marker-alt" aria-hidden="true"></i></div>
                    <div class="progress-step" data-title=""><i class="fa fa-university" aria-hidden="true"></i></div>
                    <div class="progress-step" data-title=""><i class="fa fa-file" aria-hidden="true"></i></div>
                    <div class="progress-step" data-title=""><i class="fa fa-flag" aria-hidden="true"></i></div>
                </div>

                <!-- Step 1: Scholarship Information -->
                <div class="form-step form-step-active">
                    <h3>Scholarship Information</h3>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="scholarship_type">Scholarship Type</label>
                            <input type="text" id="scholarship_type" value="<?php echo htmlspecialchars($type); ?>" disabled>
                        </div>
                        <div class="form-col">
                            <label for="amount">Amount</label>
                            <input type="text" id="amount" value="<?php echo htmlspecialchars($amount); ?>" disabled>
                        </div>
                    </div>
                    <div class="form-col-full">
                        <label for="description">Description</label>
                        <textarea id="description" disabled><?php echo htmlspecialchars($description); ?></textarea>
                    </div>
                    
                    <div class="btns-group">  
                        <a href="scholarships.php" class="btn-secondary"><i class="fa fa-window-close" aria-hidden="true"></i> Exit</a>
                        <button type="button" class="btn-primary btn-next">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                    </div>
                </div>
                
                <!-- Step 2: Personal Information -->
                <div class="form-step">
                    <h3>Personal Information</h3>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="first_name">First Name</label>
                            <input type="text" required name="b_fname" id="first_name" value="<?php echo htmlspecialchars(getSessionValue($session_fname)); ?>" placeholder="Please Enter">
                        </div>
                        <div class="form-col">
                            <label for="last_name">Last Name</label>
                            <input type="text" required name="b_lname" id="last_name" value="<?php echo htmlspecialchars(getSessionValue($session_lname)); ?>" placeholder="Please Enter">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="b_mname">Middle Name</label>
                            <input type="text" name="b_mname" value="<?php echo htmlspecialchars(getSessionValue($session_mname)); ?>" placeholder="Please Enter">
                        </div>
                        <div class="form-col">
                            <label for="b_ext_name">Extension Name</label>
                            <select name="b_ext_name">
                                <option value="" disabled selected>Suffix</option>
                                <option value="Jr." <?php echo (getSessionValue($session_ext_name) == 'Jr.') ? 'selected' : ''; ?>>Jr.</option>
                                <option value="Sr." <?php echo (getSessionValue($session_ext_name) == 'Sr.') ? 'selected' : ''; ?>>Sr.</option>
                                <option value="II" <?php echo (getSessionValue($session_ext_name) == 'II') ? 'selected' : ''; ?>>II</option>
                                <option value="III" <?php echo (getSessionValue($session_ext_name) == 'III') ? 'selected' : ''; ?>>III</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="b_gender">Sex</label>
                            <select required id="gender" name="b_gender">
                                <option value="" disabled selected>-- SELECT --</option>
                                <option value="Male" <?php echo (getSessionValue($session_gender) == 'Male') ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo (getSessionValue($session_gender) == 'Female') ? 'selected' : ''; ?>>Female</option>
                            </select>
                        </div>
                        <div class="form-col">
                            <label for="dob">Date of Birth</label>
                            <input required type="date" id="dob" name="b_dob" value="<?php echo htmlspecialchars(getSessionValue($session_dob)); ?>">
                        </div>
                    </div>
                    
                    <div class="btns-group">
                        <button type="button" class="btn-secondary btn-prev"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</button>
                        <button type="button" class="btn-primary btn-next">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                    </div>
                </div>
                
                <!-- Step 3: Additional Personal Information -->
                <div class="form-step">
                    <h3>Personal Information</h3>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="b_pob">Place of Birth</label>
                            <input required type="text" id="b_pob" name="b_pob" placeholder="Place of Birth" value="<?php echo htmlspecialchars(getSessionValue($session_pob)); ?>" required>
                        </div>
                        <div class="form-col">
                            <label for="b_monthly_income">Family Monthly Income</label>
                            <input required type="number" id="b_monthly_income" name="b_monthly_income" placeholder="Family Monthly Income" value="<?php echo htmlspecialchars(getSessionValue($session_monthly_income)); ?>" maxlength="7">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="mobile_number">Mobile Number</label>
                            <input required type="number" id="mobile_number" name="mobile_number" value="<?php echo htmlspecialchars(getSessionValue($session_mobile)); ?>" placeholder="Mobile Number" maxlength="11">
                        </div>
                        <div class="form-col">
                            <label for="religion">Religion</label>
                            <input required type="text" id="religion" name="religion" value="<?php echo htmlspecialchars(getSessionValue($session_religion)); ?>" placeholder="Religion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="nationality">Nationality</label>
                            <input required type="text" id="nationality" name="nationality" value="<?php echo htmlspecialchars(getSessionValue($session_nationality)); ?>" placeholder="Nationality">
                        </div>
                        <div class="form-col">
                            <label for="civil_status">Civil Status</label>
                            <select required name="b_civil_status" id="civil_status">
                                <option value="" disabled selected>-- SELECT --</option>
                                <option value="Single" <?php echo (getSessionValue($session_civil_status) == 'Single') ? 'selected' : ''; ?>>Single</option>
                                <option value="Married" <?php echo (getSessionValue($session_civil_status) == 'Married') ? 'selected' : ''; ?>>Married</option>
                                <option value="Annulled" <?php echo (getSessionValue($session_civil_status) == 'Annulled') ? 'selected' : ''; ?>>Annulled</option>
                                <option value="Divorced" <?php echo (getSessionValue($session_civil_status) == 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
                                <option value="Widowed" <?php echo (getSessionValue($session_civil_status) == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="btns-group">
                        <button type="button" class="btn-secondary btn-prev"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</button>
                        <button type="button" class="btn-primary btn-next">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                    </div>
                </div>
                
                <!-- Step 4: Address -->
                <div class="form-step">
                    <h3>Address</h3>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="zipcode">Zipcode</label>
                            <input required type="number" id="zipcode" name="zipcode" value="3509" readonly>
                        </div>
                        <div class="form-col">
                            <label for="barangay">Barangay</label>
                            <select required id="barangay" name="barangay">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="municipality">Municipality</label>
                            <select required id="municipality" name="municipality">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-col">
                            <label for="province">Province</label>
                            <select required id="province" name="province">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col-full">
                            <label for="region">Region</label>
                            <select required id="region" name="region">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="btns-group">
                        <button type="button" class="btn-secondary btn-prev"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</button>
                        <button type="button" class="btn-primary btn-next">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                    </div>
                </div>
                
                <!-- Step 5: Academic Details -->
                <div class="form-step">
                    <h3>Academic Details</h3>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="school_name">School Name</label>
                            <input required type="text" name="school_name" id="school_name" value="<?php echo htmlspecialchars(getSessionValue($session_school_name)); ?>">
                        </div>
                        <div class="form-col">
                            <label for="school_year">School Year</label>
                            <input required type="text" name="school_year" id="school_year" value="<?php echo htmlspecialchars(getSessionValue($session_school_year)); ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="year_level">Year Level</label>
                            <select required name="year_level" id="year_level">
                                <option value="" disabled selected>-- SELECT --</option>
                                <option value="1st Year" <?php echo (getSessionValue($session_year_level) == '1st Year') ? 'selected' : ''; ?>>1st</option>
                                <option value="2nd Year" <?php echo (getSessionValue($session_year_level) == '2nd Year') ? 'selected' : ''; ?>>2nd</option>
                                <option value="3rd Year" <?php echo (getSessionValue($session_year_level) == '3rd Year') ? 'selected' : ''; ?>>3rd</option>
                                <option value="4th Year" <?php echo (getSessionValue($session_year_level) == '4th Year') ? 'selected' : ''; ?>>4th</option>
                                <option value="5th Year" <?php echo (getSessionValue($session_year_level) == '5th Year') ? 'selected' : ''; ?>>5th</option>
                                <option value="6th Year" <?php echo (getSessionValue($session_year_level) == '6th Year') ? 'selected' : ''; ?>>6th</option>
                            </select>
                        </div>
                        <div class="form-col">
                            <label for="semester">Semester</label>
                            <select required name="semester" id="semester">
                                <option value="" disabled selected>-- SELECT --</option>
                                <option value="1st Semester" <?php echo (getSessionValue($session_semester) == '1st Semester') ? 'selected' : ''; ?>>1st</option>
                                <option value="2nd Semester" <?php echo (getSessionValue($session_semester) == '2nd Semester') ? 'selected' : ''; ?>>2nd</option>
                                <option value="3rd Semester" <?php echo (getSessionValue($session_semester) == '3rd Semester') ? 'selected' : ''; ?>>3rd</option>
                            </select> 
                        </div>
                    </div>
                    
                    <div class="btns-group">
                        <button type="button" class="btn-secondary btn-prev"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</button>
                        <button type="button" class="btn-primary btn-next">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                    </div>
                </div>
                
                <!-- Step 6: Requirements -->
                <div class="form-step">
                    <h3>Requirements</h3>
                    <div id="additional_requirements">
                        <!-- Requirements will be loaded here -->
                    </div>
                    
                    <div class="btns-group">
                        <button type="button" class="btn-secondary btn-prev"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</button>
                        <button type="button" class="btn-primary btn-next">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                    </div>
                </div>
                
                <!-- Step 7: Family Background -->
                <div class="form-step">
                    <h3>Family Background</h3>
                    <div id="family-composition">
                        <div class="family-composition-group">
                            <div class="form-row">
                                <div class="form-col">
                                    <label for="family_first_name">First name</label>
                                    <input required type="text" id="family_first_name" name="first_name[]" placeholder="First name">
                                </div>
                                <div class="form-col">
                                    <label for="family_middle_name">Middle name</label>
                                    <input type="text" id="family_middle_name" name="middle_name[]" placeholder="Middle name">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-col">
                                    <label for="family_last_name">Last name</label>
                                    <input required type="text" id="family_last_name" name="last_name[]" placeholder="Last name">
                                </div>
                                <div class="form-col">
                                    <label for="family_relationship">Relationship</label>
                                    <select required id="family_relationship" name="relationship[]">
                                        <option value="" selected disabled>--SELECT RELATIONSHIP--</option>
                                        <option value="Father">Father</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Brother">Brother</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Grandfather">Grandfather</option>
                                        <option value="Grandmother">Grandmother</option>
                                        <option value="Uncle">Uncle</option>
                                        <option value="Aunt">Aunt</option>
                                        <option value="Cousin">Cousin</option>
                                        <option value="Spouse">Spouse</option>
                                        <option value="Son">Son</option>
                                        <option value="Daughter">Daughter</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-col">
                                    <label for="family_gender">Sex</label>
                                    <select required name="gender[]" id="family_gender">
                                        <option value="" selected disabled>--SELECT--</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-col">
                                    <label for="family_dob">Date of Birth</label>
                                    <input required type="date" id="family_dob" name="dob[]">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-col">
                                    <label for="family_civil_status">Civil Status</label>
                                    <select required name="civil_status[]" id="family_civil_status">
                                        <option value="" selected disabled>--SELECT--</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Widowed">Widowed</option>
                                    </select>
                                </div>
                                <div class="form-col">
                                    <label for="family_hea">Highest Educational Attainment</label>
                                    <select required name="highest_education[]" id="family_hea">
                                        <option value="" selected disabled>--SELECT EDUCATION--</option>
                                        <option value="No Formal Education">No Formal Education</option>
                                        <option value="Elementary Level">Elementary Level</option>
                                        <option value="Elementary Graduate">Elementary Graduate</option>
                                        <option value="High School Level">High School Level</option>
                                        <option value="High School Graduate">High School Graduate</option>
                                         <option value="Senior High School Graduate">Senior High School Graduate</option>
                                        <option value="Vocational/Trade Course">Vocational/Trade Course</option>
                                        <option value="College Level">College Level</option>
                                        <option value="College Graduate">College Graduate</option>
                                        <option value="Post Graduate">Post Graduate</option>
                                        <option value="Master's Degree">Master's Degree</option>
                                        <option value="Doctorate Degree">Doctorate Degree</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-col">
                                    <label for="family_skill_occupation">Skill/Occupation</label>
                                    <input required type="text" id="family_skill_occupation" name="skill_occupation[]" placeholder="Skill/Occupation">
                                </div>
                                <div class="form-col">
                                    <label for="family_monthly_income">Est. Monthly Income</label>
                                    <input required type="number" id="family_monthly_income" name="est_monthly_income[]" placeholder="Estimate Monthly Income" maxlength="7">
                                </div>
                            </div>
                            <!-- Remove button is not shown for the first family member -->
                        </div>
                    </div>
                    
                    <div>
                        <button type="button" class="btn-primary" id="add_family_member"><i class="fa fa-user-plus" aria-hidden="true"></i> ADD FAMILY MEMBER</button>
                    </div>
                    
                    <div class="btns-group">
                        <button type="button" class="btn-secondary btn-prev"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</button>
                        <button type="submit" class="btn-primary" name="apply_scholarship" onclick="return checkForm(this);">Submit <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="resources/js/sweetalert.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <script type="text/javascript">
    $(document).ready(function() {
        // Initialize form
        $("#form").hide();
        
        // Handle applicant selection
        $("#new_checkbox, #old_checkbox").change(function() {
            if ($("#new_checkbox").is(":checked") || $("#old_checkbox").is(":checked")) {
                $("#form").show();
                $(".applicant-container").hide();
            } else {
                $(".applicant-container").show();
            }
        });

        // Load requirements
        var scholarship_id = <?php echo json_encode($id); ?>;
        $("#additional_requirements").load("components/View_Additional_Requirements.php", {
            scholarship_id: scholarship_id
        });

        // Address loading
        $('#zipcode').on('keyup', function() {
            var zipcode = $(this).val();
            $.ajax({
                method: "POST",
                url: "ajax.php",
                data: "zipp=" + zipcode,
                success: function(html) {
                    $('#barangay').html(html);
                }
            });
        });

        $('#zipcode').on('keyup', function() {
            var zipcode = $(this).val();
            $.ajax({
                method: "POST",
                url: "ajax.php",
                data: "zip=" + zipcode,
                success: function(html) {
                    $('#municipality').html(html);
                }
            });
        });

        $('#zipcode').on('keyup', function() {
            var zipcode = $(this).val();
            $.ajax({
                method: "POST",
                url: "ajax.php",
                data: "zip1=" + zipcode,
                success: function(html) {
                    $('#province').html(html);
                }
            });
        });

        $('#zipcode').on('keyup', function() {
            var zipcode = $(this).val();
            $.ajax({
                method: "POST",
                url: "ajax.php",
                data: "zip2=" + zipcode,
                success: function(html) {
                    $('#region').html(html);
                }
            });
        });

        // Address dropdowns
        $('#region').change(function() {
            loadProvince($(this).find(':selected').val())
        });
        $('#province').change(function() {
            loadMunicipality($(this).find(':selected').val())
        });
        $('#municipality').change(function() {
            loadBarangay($(this).find(':selected').val())
        });

        // Load initial address data
        var zipcode = $("#zipcode").val();
        if (zipcode) {
            $.post("ajax.php", { zipp: zipcode }, function(html) {
                $('#barangay').html(html);
            });
            $.post("ajax.php", { zip: zipcode }, function(html) {
                $('#municipality').html(html);
            });
            $.post("ajax.php", { zip1: zipcode }, function(html) {
                $('#province').html(html);
            });
            $.post("ajax.php", { zip2: zipcode }, function(html) {
                $('#region').html(html);
            });
        }

        // Family member addition
        $("#add_family_member").on("click", function() {
            var newFamilyGroup = `
            <div class="family-composition-group">
                <div class="form-row">
                    <div class="form-col">
                        <label>First name</label>
                        <input required type="text" name="first_name[]" placeholder="First name">
                    </div>
                    <div class="form-col">
                        <label>Middle name</label>
                        <input type="text" name="middle_name[]" placeholder="Middle name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Last name</label>
                        <input required type="text" name="last_name[]" placeholder="Last name">
                    </div>
                    <div class="form-col">
                        <label>Relationship</label>
                        <select required name="relationship[]">
                            <option value="" selected disabled>--SELECT RELATIONSHIP--</option>
                            <option value="Father">Father</option>
                            <option value="Mother">Mother</option>
                            <option value="Brother">Brother</option>
                            <option value="Sister">Sister</option>
                            <option value="Grandfather">Grandfather</option>
                            <option value="Grandmother">Grandmother</option>
                            <option value="Uncle">Uncle</option>
                            <option value="Aunt">Aunt</option>
                            <option value="Cousin">Cousin</option>
                            <option value="Spouse">Spouse</option>
                            <option value="Son">Son</option>
                            <option value="Daughter">Daughter</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Sex</label>
                        <select required name="gender[]">
                            <option value="" selected disabled>--SELECT--</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-col">
                        <label>Date of Birth</label>
                        <input required type="date" name="dob[]">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Civil Status</label>
                        <select required name="civil_status[]">
                            <option value="" selected disabled>--SELECT--</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </div>
                    <div class="form-col">
                        <label>Highest Educational Attainment</label>
                        <select required name="highest_education[]">
                            <option value="" selected disabled>--SELECT EDUCATION--</option>
                            <option value="No Formal Education">No Formal Education</option>
                            <option value="Elementary Level">Elementary Level</option>
                            <option value="Elementary Graduate">Elementary Graduate</option>
                            <option value="High School Level">High School Level</option>
                            <option value="High School Graduate">High School Graduate</option>
                            <option value="Senior High School Graduate">Senior High School Graduate</option>
                            <option value="Vocational/Trade Course">Vocational/Trade Course</option>
                            <option value="College Level">College Level</option>
                            <option value="College Graduate">College Graduate</option>
                            <option value="Post Graduate">Post Graduate</option>
                            <option value="Master's Degree">Master's Degree</option>
                            <option value="Doctorate Degree">Doctorate Degree</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Skill/Occupation</label>
                        <input required type="text" name="skill_occupation[]" placeholder="Skill/Occupation">
                    </div>
                    <div class="form-col">
                        <label>Est. Monthly Income</label>
                        <input required type="number" name="est_monthly_income[]" placeholder="Estimate Monthly Income" maxlength="7">
                    </div>
                </div>
                <button type="button" class="remove-family-member"><i class="fa fa-trash" aria-hidden="true"></i> Remove</button>
            </div>
            `;
            $("#family-composition").append(newFamilyGroup);
        });

        // Remove family member
        $(document).on("click", ".remove-family-member", function() {
            $(this).closest(".family-composition-group").remove();
        });

        // Multi-step form functionality
        const prevBtns = document.querySelectorAll(".btn-prev");
        const nextBtns = document.querySelectorAll(".btn-next");
        const progress = document.getElementById("progressline");
        const formSteps = document.querySelectorAll(".form-step");
        const progressSteps = document.querySelectorAll(".progress-step");

        let formStepsNum = 0;

        nextBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                if (validateInputs()) {
                    formStepsNum++;
                    updateFormSteps();
                    updateProgressbar();
                    showSuccessMessage();
                } else {
                    showErrorToast();
                }
            });
        });

        prevBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                formStepsNum--;
                updateFormSteps();
                updateProgressbar();
            });
        });

        function validateInputs() {
            const formStep = formSteps[formStepsNum];
            const inputs = formStep.querySelectorAll("input, select, textarea");

            for (let i = 0; i < inputs.length; i++) {
                if (inputs[i].hasAttribute("required") && !inputs[i].value) {
                    return false;
                }
            }

            return true;
        }

        function showSuccessMessage() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                customClass: {
                    content: 'text-center',
                    heightAuto: 'custom-toast-height',
                    background: '#2b547e'
                }
            });

            Toast.fire({
                icon: 'success',
                title: 'You can proceed to the next step.',
                showConfirmButton: false,
                timer: 3000
            });
        }

        function showErrorToast() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                customClass: {
                    content: 'text-center',
                    heightAuto: 'custom-toast-height',
                    background: '#2b547e'
                }
            });

            Toast.fire({
                icon: 'error',
                title: 'Please fill in all required fields.'
            });
        }

        function updateFormSteps() {
            formSteps.forEach((formStep) => {
                formStep.classList.contains("form-step-active") &&
                formStep.classList.remove("form-step-active");
            });

            formSteps[formStepsNum].classList.add("form-step-active");
        }

        function updateProgressbar() {
            progressSteps.forEach((progressStep, idx) => {
                if (idx < formStepsNum + 1) {
                    progressStep.classList.add("progress-step-active");
                } else {
                    progressStep.classList.remove("progress-step-active");
                }
            });

            const progressActive = document.querySelectorAll(".progress-step-active");

            progress.style.width =
                ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
        }

        // Address loading functions
        function loadRegion() {
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: "get=region"
            }).done(function(result) {
                $(result).each(function() {
                    $("#region").append($(result));
                })
            });
        }

        function loadProvince(regionId) {
            $("#province").children().remove()
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: "get=province&regionId=" + regionId
            }).done(function(result) {
                $("#province").append($(result));
            });
        }

        function loadMunicipality(provinceId) {
            $("#municipality").children().remove()
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: "get=municipality&provinceId=" + provinceId
            }).done(function(result) {
                $("#municipality").append($(result));
            });
        }

        function loadBarangay(municipalityId) {
            $("#barangay").children().remove()
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: "get=barangay&municipalityId=" + municipalityId
            }).done(function(result) {
                $("#barangay").append($(result));
            });
        }

        loadRegion();
    });
    </script>
</body>
</html>