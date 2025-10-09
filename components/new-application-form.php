<?php
require './includes/user_check_session.php';

require './includes/partial.head.php';
?>
<style type="text/css">
:root {
  --primary-color: rgb(11, 78, 179);
}

*,
*::before,
*::after {
  box-sizing: border-box;
}

label {
  display: block;
  margin-bottom: 0.5rem;
}

input {
  display: block;
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #ccc;
  border-radius: 0.25rem;
}
select {
  display: block;
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #ccc;
  border-radius: 0.25rem;
}
textarea{
  display: block;
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #ccc;
  border-radius: 0.25rem;
  height: inherit;
}

.width-50 {
  width: 50%;
}

.ml-auto {
  margin-left: auto;
}

.text-center {
  text-align: center;
}

/* Progressbar */
.progressbar {
  position: relative;
  display: flex;
  justify-content: space-between;
  counter-reset: step;
  margin: 2rem 0 4rem;
}

.progressbar::before,
.progressline {
  content: "";
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  height: 10px;
  width: 100%;
  background-color: #dcdcdc;
  z-index: -1;
}

.progressline {
  background-color: var(--primary-color);
  width: 0%;
  transition: 0.3s;
}


.progress-step {
  width: 2.1875rem;
  height: 2.1875rem;
  background-color: #dcdcdc;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.progress-step::before {
  counter-increment: step;
}

.progress-step::after {
  content: attr(data-title);
  position: absolute;
  top: calc(100% + 0.5rem);
  font-size: 0.85rem;
  color: #666;
  display:flex;
}

.progress-step-active {
  background-color: var(--primary-color);
  color: #f3f3f3;
}

/* Form */

.form-step {
  display: none;
  transform-origin: top;
  animation: animate 0.5s;
}

.form-step-active {
  display: block;
}

.input-group {
  margin: 2rem 0;
}

@keyframes animate {
  from {
    transform: scale(1, 0);
    opacity: 0;
  }
  to {
    transform: scale(1, 1);
    opacity: 1;
  }
}

/* Button */
.btns-group {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1.5rem;
}

.btn1 {
  padding: 0.75rem;
  display: block;
  text-decoration: none;
  background-color: var(--primary-color);
  color: #f3f3f3;
  text-align: center;
  border-radius: 0.25rem;
  cursor: pointer;
  transition: 0.3s;
}
.btn1:hover {
  box-shadow: 0 0 0 2px #fff, 0 0 0 3px var(--primary-color);
}

.checkbox-container {
    display: flex;
    align-items: center;
    justify-content:center;
}

.checkbox-container label {
    cursor: pointer;
    display: flex;
}

.checkbox-container input[type='checkbox'] {
    cursor: pointer;
    opacity: 0;
    position: absolute;
}

.checkbox-container label::before {
    content: '';
    width: 1em;
    height: 1em;
    border-radius: .15em;
    margin-right: .5em;
    border: .05em solid black;
}

.checkbox-container label:hover::before,
.checkbox-container input[type='checkbox']:hover + label::before {
    background-color: #35E07D;
}

.checkbox-container input[type='checkbox']:focus + label::before {
    box-shadow: 0 0 20px black;
}

.checkbox-container input[type='checkbox']:disabled + label,
.checkbox-container input[type='checkbox']:disabled {
    color: #aaa;
    cursor: default;
}

.checkbox-container input[type='checkbox']:checked + label::before {
    content: '\002714';
    background-color: #27AE60;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
}

.checkbox-container input[type='checkbox']:disabled + label::before {
    background-color: #ccc;
    border-color: #999;
}

input[type=file]::file-selector-button {
margin-right: 20px;
border: none;
background: #084cdf;
padding: 1px;
border-radius: 10px;
color: #fff;
cursor: pointer;
transition: background .2s ease-in-out;
}
input[type=file]::file-selector-button:hover {
background: #0d45a5;
}
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center" style="background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('resources/images/lgulallo.png') no-repeat;
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
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"></h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Scholarship</li>
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
                                <form action="actions/action.apply-scholarship.php" method="post" enctype="multipart/form-data" id="myForm" name="myForm" onsubmit="return checkForm(this);">
                                    <input type="hidden" name="scholarship_id" id="scholarship_id">
                                    <div class="checkbox-container">
                                            <div class="col-md-6 mb-3">
                                                <input class="form-check-input" type="checkbox" name="type" value="new" id="new_checkbox">
                                                <label class="form-check-label" for="new_checkbox">NEW APPLICANT</label>
                                            </div>
                                            &nbsp;&nbsp;
                                            <div class="col-md-6 mb-3">
                                                <input class="form-check-input" type="checkbox" name="type" value="old" id="old_checkbox">
                                                <label class="form-check-label" for="old_checkbox">OLD APPLICANT</label>
                                        
                                            </div>
                                    </div>
                                        <div id="form">
                                            <h1 class="text-center">Application Form</h1>
                                            <div class="progressbar">
                                                    <div class="progressline" id="progressline"></div>
                                                    
                                                    <div class="progress-step progress-step-active" ><i class="fa fa-graduation-cap" aria-hidden="true"></i></div>
                                                    <div class="progress-step" ><i class="fa fa-user-circle" aria-hidden="true"></i></div>
                                                    <div class="progress-step"><i class="fa fa-id-card" aria-hidden="true"></i></div>
                                                    <div class="progress-step"><i class="fa fa-map-marker" aria-hidden="true"></i></i></div>
                                                    <div class="progress-step"><i class="fa fa-university" aria-hidden="true"></i></div>
                                                    <div class="progress-step"><i class="fa fa-file" aria-hidden="true"></i></div>
                                                    <div class="progress-step"><i class="fa fa-flag" aria-hidden="true"></i></div>
                                                </div>

                                            <div class="form-step form-step-active" >
                                                <div class="input-group">
                                                    <div class="col-md-12 mb-3">
                                                    <hr>
                                                    <h3 class="text-center">Scholarship Information</h3>
                                                    <hr>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                            <label for="first_name">Scholarship type</label>
                                                                <input type="text" id="scholarship_type" disabled>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                            <label for="middle_name">Amount</label>
                                                                <input type="text" id="amount" disabled>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                            <label for="middle_name">Description</label>
                                                                <textarea type="text" id="description" disabled></textarea>
                                                    </div>
                                                </div>
                                                    <div class="">
                                                        <a href="#" class="btn1 btn-next width-50 ml-auto" >Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                                    </div>
                                            </div>
                                            <div class="form-step" >
                                                <div class="input-group">  
                                                    <div class="col-md-12 mb-3">
                                                    <hr>
                                                    <h3 class="text-center">Personal Information</h3>
                                                    <hr>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="first_name">First Name</label>
                                                        <input type="text" name="first_name" id="first_name" value="<?= $_SESSION[$session_fname] ?? '' ?>" placeholder="Please Enter">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="last_name">Last Name</label>
                                                        <input type="text" name="last_name" id="last_name" value="<?= $_SESSION[$session_lname] ?? '' ?>" placeholder="Please Enter">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="middle_name">Middle Name</label>
                                                        <input type="text" name="middle_name" value="<?= $_SESSION[$session_mname] ?? '' ?>" placeholder="Please Enter">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="ext_name">Extension Name</label>
                                                        <select name="ext_name">
                                                            <option value="" disabled selected>Suffix</option>
                                                            <option value="Jr." <?= $_SESSION[$session_prefix . 'ext_name'] == 'Jr.' ? 'selected' : '' ?>>Jr.</option>
                                                            <option value="Sr." <?= $_SESSION[$session_prefix . 'ext_name'] == 'Sr.' ? 'selected' : '' ?>>Sr.</option>
                                                            <option value="II" <?= $_SESSION[$session_prefix . 'ext_name'] == 'II.' ? 'selected' : '' ?>>II</option>
                                                            <option value="III" <?= $_SESSION[$session_prefix . 'ext_name'] == 'III.' ? 'selected' : '' ?>>III</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="b_gender">Sex</label>
                                                            <select id="b_gender" id="gender" name="b_gender">
                                                                <option value="" disabled selected>Suffix</option>
                                                                <option value="Male" <?= $_SESSION[$session_prefix . 'gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                                                <option value="Female" <?= $_SESSION[$session_prefix . 'gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                                            </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="dob">Date of Birth</label>
                                                            <input type="date" id="dob" name="b_dob" value="<?= $_SESSION[$session_prefix . 'dob'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                    <div class="btns-group">
                                                        <a href="#" class="btn1 btn-prev"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</a>
                                                        <a href="#" class="btn1 btn-next">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                                    </div>
                                            </div>
                                            <div class="form-step" >
                                                <div class="input-group">
                                                <div class="col-md-12 mb-3">
                                                    <hr>
                                                    <h3 class="text-center">Personal Information</h3>
                                                    <hr>
                                                </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="dob">Place of Birth</label>
                                                            <input  type="text" id="b_pob" name="b_pob" placeholder="Place of Birth">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="b_monthly_income">Family Monthly Income</label>
                                                            <input type="text"  id="b_monthly_income" name="b_monthly_income"  placeholder="Family Monthly Income">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="mobile_number">Mobile Number</label>
                                                            <input  type="text" id="mobile_number" name="mobile_number" value="<?= $_SESSION[$session_prefix . 'mobile_no'] ?? '' ?>" placehodler="Mobile Number">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="religion">Religion</label>
                                                            <input type="text"  value="<?= $_SESSION[$session_prefix . 'religion'] ?? '' ?>" id="religion" name="religion"  placeholder="Religion">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="nationality">Nationality</label>
                                                            <input  type="text" id="nationality" name="nationality" value="<?= $_SESSION[$session_prefix . 'nationality'] ?? '' ?>" placehodler="Nationality">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="civil_status">Civil Status</label>
                                                            <select id="civil_status" name="civil_status">
                                                                <option selected disabled value="">-- SELECT ---</option>
                                                                <option value="Single" <?= $_SESSION[$session_prefix . 'civil_status'] == 'Single' ? 'selected' : '' ?>>Single</option>
                                                                <option value="Married" <?= $_SESSION[$session_prefix . 'civil_status'] == 'Married' ? 'selected' : '' ?>>Married</option>
                                                                <option value="Annulled" <?= $_SESSION[$session_prefix . 'civil_status'] == 'Annulled' ? 'selected' : '' ?>>Annulled</option>
                                                                <option value="Divorced" <?= $_SESSION[$session_prefix . 'civil_status'] == 'Divorced' ? 'selected' : '' ?>>Divorced</option>
                                                                <option value="Widowed" <?= $_SESSION[$session_prefix . 'civil_status'] == 'Widowed' ? 'selected' : '' ?>>Widowed</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="btns-group">
                                                <a href="#" class="btn1 btn-prev"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</a>
                                                <a href="#" class="btn1 btn-next">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="form-step" >
                                                <div class="input-group">
                                                    <div class="col-md-12 mb-3">
                                                    <hr>
                                                    <h3 class="text-center">Address</h3>
                                                    <hr>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="zipcode">Zipcode</label>
                                                            <input type="number"  id="zipcode" name="zipcode" placeholder="Zip Code" >
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="barangay">Barangay</label>
                                                        <select id="barangay" name="barangay" placeholder="Barangay">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="municipality">Municipality</label>
                                                        <select id="municipality" name="municipality" placeholder="Municipality">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="province">Province</label>
                                                        <select id="province" name="province" placeholder="Province">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="region">Region</label>
                                                        <select  id="region" name="region" placeholder="Region">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="btns-group">
                                                <a href="#" class="btn1 btn-prev"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</a>
                                                <a href="#" class="btn1 btn-next">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="form-step">
                                                <div class="input-group">
                                                    <div class="col-md-12 mb-3">
                                                    <hr>
                                                    <h3 class="text-center">School Details</h3>
                                                    <hr>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="schoolname">School Name</label>
                                                            <input type="text"  name="school_name" id="school_name" >
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="yearlevel">School Year</label>
                                                            <input  type="text" name="school_year" id="school_year">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="yearlevel">Year Level</label>
                                                        <select  name="year_level"  id="year_level">
                                                                    <option value="" disabled selected>-- SELECT --</option>
                                                                    <option value="1st">1st</option>
                                                                    <option value="2nd">2nd</option>
                                                                    <option value="3rd">3rd</option>
                                                                    <option value="4th">4th</option>
                                                                    <option value="5th">5th</option>
                                                                    <option value="6th">6th</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="semester">Semester</label>
                                                        <select  name="semester" id="semester">
                                                                    <option value="" disabled selected>-- SELECT --</option>
                                                                    <option value="1st">1st</option>
                                                                    <option value="2nd">2nd</option>
                                                                    <option value="3rd">3rd</option>
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="btns-group">
                                                <a href="#" class="btn1 btn-prev"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</a>
                                                <a href="#" class="btn1 btn-next">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="form-step">
                                                <div class="input-group">
                                                <div class="col-md-12 mb-3">
                                                <hr>
                                                <h3 class="text-center">Requirements</h3>
                                                <hr>
                                                </div>
                                                    <div class="row" id="additional_requirements">
                                                    </div>
                                                </div>
                                                <div class="btns-group">
                                                <a href="#" class="btn1 btn-prev"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</a>
                                                <a href="#" class="btn1 btn-next">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="form-step">
                                                <div class="input-group"> 
                                                    <div class="col-md-12 mb-3">
                                                    <hr>
                                                    <h3 class="text-center">Family Background</h3>
                                                    <hr>
                                                    </div>         
                                                    <div id="family-composition">
                                                        <div class="family_composition_group row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="family_first_name">First name</label>
                                                                <input type="text" id="family_first_name" name="first_name[]" placeholder="First name">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="family_middle_name">Middle name</label>
                                                                <input type="text" id="family_middle_name" name="middle_name[]" placeholder="Middle name">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="family_last_name">Last name</label>
                                                                <input type="text" id="family_last_name" name="last_name[]" placeholder="Last name">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="family_relationship">Relationship</label>
                                                                <input type="text" id="family_relationship" name="relationship[]" placeholder="Relationship">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="family_gender">Sex</label>
                                                                <select name="gender[]" id="family_gender">
                                                                    <option value="" selected disabled>--SELECT--</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="family_dob">Date of Birth</label>
                                                                <input type="date" id="family_dob" name="dob[]">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="family_civil_status">Civil Status</label>
                                                                <select name="civil_status[]" id="civil_status">
                                                                    <option value="" selected disabled>--SELECT--</option>
                                                                    <option value="Single">Single</option>
                                                                    <option value="Married">Married</option>
                                                                    <option value="Divorced">Divorced</option>
                                                                    <option value="Widowed">Widowed</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="family_hea">Highest Educational Attainment</label>
                                                                <input type="text" id="family_hea" name="highest_education[]" placeholder="Highest Educational Attainment">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="family_skill_occupation">Skill/Occupation</label>
                                                                <input type="text" id="family_skill_occupation" name="skill_occupation[]" placeholder="Skill/Occupation">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="family_monthly_income">Est. Monthly Income</label>
                                                                <input type="number" id="family_monthly_income" name="est_monthly_income[]" placeholder="Estimate Monthly Income">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <button type="button" class="btn btn-success" id="add_family_member"><i class="fa fa-user-plus" aria-hidden="true"></i> ADD</button>
                                                    </div>
                                                </div>
                                                
                                                <div class="btns-group">
                                                <a href="#" class="btn1 btn-prev"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</a>
                                                <button type="submit" class="btn1"  name="apply_scholarship" onclick="return checkForm(this);">Submit <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                        </div>
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
    <script type="text/javascript">

const prevBtns = document.querySelectorAll(".btn-prev");
const nextBtns = document.querySelectorAll(".btn-next");
const progressline = document.getElementById("progressline");
const formSteps = document.querySelectorAll(".form-step");
const progressSteps = document.querySelectorAll(".progress-step");

let formStepsNum = 0;

nextBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum++;
    updateFormSteps();
    updateProgressbar();
  });
});

prevBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum--;
    updateFormSteps();
    updateProgressbar();
  });
});

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

  progressline.style.width =
    ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
}

$(document).ready(function() {

$("#form").hide();
// Handle checkbox change event

$("#new_checkbox, #old_checkbox").change(function() {
  var isNewApplicantChecked = $("#new_checkbox").is(":checked");
  var isOldApplicantChecked = $("#old_checkbox").is(":checked");

  if (isNewApplicantChecked) {
    // Hide the "Old Applicant Form" and show the "New Applicant Form"
    $("#form").show();
  } else if (isOldApplicantChecked) {
    // Hide the "New Applicant Form" and show the "Old Applicant Form"
    
    $("#form").show();

  }
  
  // Hide the question and checkboxes when one is selected
  if (isNewApplicantChecked || isOldApplicantChecked) {
    $(".checkbox-container").hide();
  } else {
    $(".checkbox-container").show();
  }
});
});

function applyScholarship(scholarship_id, scholarship_type, amount, description) {
    $("#scholarship_id").val(scholarship_id)
    $("#scholarship_type").val(scholarship_type)
    $("#amount").val(amount)
    $("#description").val(description)
    $("#additional_requirements").load("components/View_Additional_Requirements.php", {
     scholarship_id: scholarship_id
});
}

function addNewFields() {
        $.get("components/additional-family-composition-fields.php", function(data) {
        $("#family-composition").append(data);
    });
}
    $("#add_family_member").on("click", () => addNewFields());

    function removeParent(element) {
        $(element).parent().parent().remove();
    }


$(document).ready(function() {
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
    });

    $(document).ready(function() {
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
    });


    $(document).ready(function() {
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
    });

    $(document).ready(function() {
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
    });

    $(document).ready(function() {

$('#region').change(function() {
    loadProvince($(this).find(':selected').val())
})
$('#province').change(function() {
    loadMunicipality($(this).find(':selected').val())
})
$('#municipality').change(function() {
    loadBarangay($(this).find(':selected').val())
})


});

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


function checkForm(form) {
    var Toast = Swal.mixin({
        toast: true,
        position: "top",
        showConfirmButton: false,
        timer: 3000,
        customClass: {
    content: 'text-center',
    heightAuto: 'custom-toast-height',
    background: 'rgb(22, 110, 47)'
    // Add this line to center the text
  }
});


if (document.myForm.first_name.value=="") {
	Toast.fire({
		icon: 'warning',
		title: 'Please Provide First Name'
	    });
		document.myForm.first_name.focus();
			return false;
		}
if (document.myForm.last_name.value=="") {
	Toast.fire({
	    icon: 'warning',
		title: 'Please Provide Last Name'
		});
		document.myForm.last_name.focus();
				return false;
		}
if (document.myForm.gender.value=="") {
	Toast.fire({
		icon: 'warning',
		title: 'Please Provide Gender'
		});
		document.myForm.gender.focus();
			return false;
		}
var dob = document.myForm.dob.value;
if (dob == "") {
        Toast.fire({
        icon: 'warning',
        title: 'Please Provide Date of Birth'
        });
        document.myForm.dob.focus();
            return false;
        }

var currentDate = new Date();
var inputDate = new Date(dob);
var age = currentDate.getFullYear() - inputDate.getFullYear();

if (age < 16) {
        Toast.fire({
            icon: 'warning',
            title: 'You must be 16 years old or older'
        });
        document.myForm.dob.focus();
            return false;
        }

if (document.myForm.gender.value=="") {
	    Toast.fire({
		    icon: 'warning',
		    title: 'Please Provide Gender'
		});
		document.myForm.gender.focus();
			return false;
		}
if (document.myForm.b_pob.value=="") {
	    Toast.fire({
		    icon: 'warning',
		    title: 'Please Provide Place of Birth'
		});
		document.myForm.b_pob.focus();
			return false;
		}
if (document.myForm.b_monthly_income.value=="") {
	    Toast.fire({
		    icon: 'warning',
		    title: 'Please Provide Monthly Income'
		});
		document.myForm.b_monthly_income.focus();
			return false;
		} 
if (document.myForm.mobile_number.value=="") {
	    Toast.fire({
		    icon: 'warning',
		    title: 'Please Provide Contact Number'
		});
		document.myForm.mobile_number.focus();
			return false;
		}
if (document.myForm.religion.value=="") {
	    Toast.fire({
		    icon: 'warning',
		    title: 'Please Provide Place of Birth'
		});
		document.myForm.b_pob.focus();
			return false;
		}
if (document.myForm.nationality.value=="") {
	    Toast.fire({
		    icon: 'warning',
		    title: 'Please Provide Nationality'
		});
		document.myForm.nationality.focus();
			return false;
		} 
if (document.myForm.civil_status.value=="") {
	    Toast.fire({
		    icon: 'warning',
		    title: 'Please Provide Civil Status'
		});
		document.myForm.civil_status.focus();
			return false;
		}
if (document.myForm.zipcode.value=="") {
	    Toast.fire({
		    icon: 'warning',
		    title: 'Please Provide Zipcode'
		});
		document.myForm.zipcode.focus();
			return false;
		}
if (document.myForm.barangay.value=="") {
	    Toast.fire({
		    icon: 'warning',
		    title: 'Please Provide Barangay'
		});
		document.myForm.barangay.focus();
			return false;
		}
if (document.myForm.municipality.value=="") {
	    Toast.fire({
		    icon: 'warning',
		    title: 'Please Provide Municipality'
		});
		document.myForm.municipality.focus();
			return false;
		}
if (document.myForm.province.value=="") {
	    Toast.fire({
		    icon: 'warning',
		    title: 'Please Provide Province'
		});
		document.myForm.province.focus();
			return false;
		}
if (document.myForm.region.value=="") {
	    Toast.fire({
		    icon: 'warning',
		    title: 'Please Provide Region'
		});
		document.myForm.region.focus();
			return false;
		}
if (document.myForm.school_name.value=="") {
	    Toast.fire({
		    icon: 'warning',
		    title: 'Please Provide School Name'
		});
		document.myForm.school_name.focus();
			return false;
		}
if (document.myForm.school_year.value=="") {
	    Toast.fire({
		    icon: 'warning',
		    title: 'Please Provide School Year'
		});
		document.myForm.school_year.focus();
			return false;
		}
if (document.myForm.year_level.value=="") {
	    Toast.fire({
		    icon: 'warning',
		    title: 'Please Provide Year Level'
		});
		document.myForm.year_level.focus();
			return false;
		}
if (document.myForm.semester.value=="") {
	    Toast.fire({
		    icon: 'warning',
		    title: 'Please Provide Semester'
		});
		document.myForm.semester.focus();
			return false;
		}
if (document.myForm.file_file.value=="") {
	    Toast.fire({
		    icon: 'warning',
		    title: 'Please Provide Requirements'
		});
		document.myForm.file_file.focus();
			return false;
		}
}
</script>


    
</body>

</html>