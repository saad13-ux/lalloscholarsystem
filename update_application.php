<?php
include 'includes/pdo_conn.php';
include 'includes/session_variables.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link href="resources/images/lgulallo.png" rel="icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>
<style type="text/css">
:root {
  --primary-color: rgb(11, 78, 179);
}

body {
  font-family: Montserrat, "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  margin: 0;
  display: grid;
  place-items: center;
  min-height: 100vh;
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
  counter-increment: step;
  content: counter(step);
}

.progress-step-active {
  background-color: var(--primary-color);
  color: #f3f3f3;
}

/* Form */
form {
  width: clamp(320px, 100%, 600px);
  margin: 0 auto;
  border: 1px solid #ccc;
  border-radius: 0.35rem;
  padding: 1.5rem;
}

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
.modal-body
{
}
.profile-image-card{
  margin: auto;
  display: table;
  background: #fff;
  padding: 30px 50px;
  box-shadow: 0px 0px 5px #ddd;
}
.profile-images{
  width: 150px;
  height: 150px;
  background: #fff;
  border-radius: 5%;
  overflow: hidden;
}
.profile-images img{
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.custom-file input[type="file"]{
  display: none;
}
.custom-file label{
  cursor: pointer;
  color: #000;
  text-align: center;
  display: table;
  margin: auto;
  margin-top: 15px;
}


</style>

<body>
<?php

$id = $_GET['scholarship_id'];
$type = $_GET['scholarship_type'];
$amount = $_GET['amount'];
$description = $_GET['description'];
$b_fname = $_GET['b_fname'];
$b_mname = $_GET['b_mname'];
$b_lname = $_GET['b_lname'];
$b_ext_name = $_GET['b_ext_name'];
$b_gender = $_GET['b_gender'];
$b_dob = $_GET['b_dob'];
$b_pob = $_GET['b_pob'];
$b_monthly_income = $_GET['b_monthly_income'];
$mobile_number = $_GET['mobile_number'];
$religion = $_GET['religion'];
$nationality = $_GET['nationality'];
$b_civil_status = $_GET['b_civil_status'];
$zipcode = $_GET['zipcode'];
?>
    <form class="form" method="post" action="actions/action.apply-scholarship.php" id="myForm" name="myForm" enctype="multipart/form-data" onsubmit="return checkForm(this);">
                    <input type="hidden" name="scholarship_id" id="scholarship_id" value="<?php echo $id; ?>"> 
                    <div class="checkbox-container">
                        
                        <div id="form">
                            <h1 class="text-center">Application Form</h1>
                            <div class="progressbar">
                                    <div class="progressline" id="progressline"></div>
                                    
                                    <div class="progress-step progress-step-active" data-title="" ><i class="fa fa-graduation-cap" aria-hidden="true"></i></div>
                                    <div class="progress-step" data-title=""><i class="fa fa-user-circle" aria-hidden="true"></i></div>   
                                    <div class="progress-step" data-title=""><i class="fa fa-id-card" aria-hidden="true"></i></div>
                                    <div class="progress-step" data-title=""><i class="fa fa-map-marker" aria-hidden="true"></i></i></div>
                                    <div class="progress-step" data-title=""><i class="fa fa-university" aria-hidden="true"></i></div>
                                    <div class="progress-step" data-title="" ><i class="fa fa-file" aria-hidden="true"></i></div>
                                    <div class="progress-step" data-title=""><i class="fa fa-flag" aria-hidden="true"></i></div>
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
                                                <input type="text" id="scholarship_type" value="<?php echo $type; ?>" disabled>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                            <label for="middle_name">Amount</label>
                                                <input type="text" id="amount" value="<?php echo $amount; ?>" disabled>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                            <label for="middle_name">Description</label>
                                                <textarea type="text" id="description" disabled><?php echo $description; ?></textarea>
                                    </div>
                                </div>
                                    <div class="btns-group">  
                                        <a href="application.php" class="btn1"><i class="fa fa-window-close" aria-hidden="true"></i> Exit</a>
                                        <a href="#" class="btn1 btn-next" >Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
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
                                        <input type="text" required name="b_fname" id="first_name" value="<?php echo $b_fname; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" required name="b_lname" id="last_name"  value="<?php echo $b_lname; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="b_mname">Middle Name</label>
                                        <input type="text" name="b_mname"  value="<?php echo $b_mname; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="b_ext_name">Extension Name</label>
                                        <select name="b_ext_name">
                                            <option value="" disabled selected>Suffix</option>
                                            <option value="Jr."  <?= $b_ext_name == 'Jr.' ? 'selected' : '' ?>>Jr.</option>
                                            <option value="Sr." <?= $b_ext_name == 'Sr.' ? 'selected' : '' ?>>Sr.</option>
                                            <option value="II" <?= $b_ext_name == 'II.' ? 'selected' : '' ?>>II</option>
                                            <option value="III" <?= $b_ext_name == 'III.' ? 'selected' : '' ?>>III</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="b_gender">Sex</label>
                                            <select required id="gender" name="b_gender">
                                                <option value="" disabled selected>Suffix</option>
                                                <option value="Male" <?= $b_gender == 'Male' ? 'selected' : '' ?>>Male</option>
                                                <option value="Female" <?= $b_gender == 'Female' ? 'selected' : '' ?>>Female</option>
                                            </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="dob">Date of Birth</label>
                                            <input required type="date" id="dob" name="b_dob" value="<?php echo $b_dob; ?>">
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
                                            <input required type="text" id="b_pob" name="b_pob" value="<?php echo $b_pob; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="b_monthly_income">Family Monthly Income</label>
                                            <input required type="number"  id="b_monthly_income" name="b_monthly_income"  value="<?php echo $b_monthly_income; ?>" maxlength="7">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="mobile_number">Mobile Number</label>
                                            <input required type="number" id="mobile_number" name="mobile_number" value="<?php echo $mobile_number; ?>"  maxlength="11">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="religion">Religion</label>
                                            <input required type="text" required id="religion" name="religion"  value="<?php echo $religion; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="nationality">Nationality</label>
                                            <input required type="text" id="nationality" name="nationality" value="<?php echo $nationality; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="civil_status">Civil Status</label>
                                        <select required name="b_civil_status" id="civil_status">
                                          <option value="" disabled selected>-- SELECT ---</option>
                                          <option value="Single" <?= $b_civil_status == 'Single' ? 'selected' : '' ?>>Single</option>
                                          <option value="Married" <?= $b_civil_status == 'Married' ? 'selected' : '' ?>>Married</option>
                                          <option value="Annulled" <?= $b_civil_status == 'Annulled' ? 'selected' : '' ?>>Annulled</option>
                                          <option value="Divorced" <?=$b_civil_status == 'Divorced' ? 'selected' : '' ?>>Divorced</option>
                                          <option value="Widowed" <?=$b_civil_status == 'Widowed' ? 'selected' : '' ?>>Widowed</option>
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
                                            <input required type="number"  id="zipcode" name="zipcode" value="<?php echo $zipcode ?>" >
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="barangay">Barangay</label>
                                        <select required id="barangay" name="barangay" placeholder="Barangay">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="municipality">Municipality</label>
                                        <select required id="municipality" name="municipality" placeholder="Municipality">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="province">Province</label>
                                        <select required id="province" name="province" placeholder="Province">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="region">Region</label>
                                        <select required id="region" name="region" placeholder="Region">
                                            <option value=""></option>
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
                                    <h3 class="text-center">Academic Details</h3>
                                    <hr>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="schoolname">School Name</label>
                                            <input required type="text"  name="school_name" id="school_name" >
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="yearlevel">School Year</label>
                                            <input  required type="text" name="school_year" id="school_year">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="yearlevel">Year Level</label>
                                        <select required name="year_level"  id="year_level">
                                                    <option value="" disabled selected>-- SELECT --</option>
                                                    <option value="1st Year">1st</option>
                                                    <option value="2nd Year">2nd</option>
                                                    <option value="3rd Year">3rd</option>
                                                    <option value="4th Year">4th</option>
                                                    <option value="5th Year">5th</option>
                                                    <option value="6th Year">6th</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="semester">Semester</label>
                                        <select required name="semester" id="semester">
                                                    <option value="" disabled selected>-- SELECT --</option>
                                                    <option value="1st Semester">1st</option>
                                                    <option value="2nd Semester">2nd</option>
                                                    <option value="3rd Semester">3rd</option>
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
                                                <input required type="text" id="family_first_name" name="first_name[]" placeholder="First name">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="family_middle_name">Middle name</label>
                                                <input type="text" id="family_middle_name" name="middle_name[]" placeholder="Middle name">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="family_last_name">Last name</label>
                                                <input required type="text" id="family_last_name" name="last_name[]" placeholder="Last name">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="family_relationship">Relationship</label>
                                                <input type="text" id="family_relationship" name="relationship[]" placeholder="Relationship">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="family_gender">Sex</label>
                                                <select required name="gender[]" id="family_gender">
                                                    <option value="" selected disabled>--SELECT--</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="family_dob">Date of Birth</label>
                                                <input required type="date" id="family_dob" name="dob[]">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="family_civil_status">Civil Status</label>
                                                <select required name="civil_status[]" id="civil_status">
                                                    <option value="" selected disabled>--SELECT--</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Divorced">Divorced</option>
                                                    <option value="Widowed">Widowed</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="family_hea">Highest Educational Attainment</label>
                                                <input required type="text" id="family_hea" name="highest_education[]" placeholder="Highest Educational Attainment">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="family_skill_occupation">Skill/Occupation</label>
                                                <input required type="text" id="family_skill_occupation" name="skill_occupation[]" placeholder="Skill/Occupation">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="family_monthly_income">Est. Monthly Income</label>
                                                <input required type="number" id="family_monthly_income" name="est_monthly_income[]" placeholder="Estimate Monthly Income" maxlength="7">
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
                                <button type="submit" class="btn1 btn-next" name="apply_scholarship" onclick="return checkForm(this);">Submit <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
    </form>
  </body>
<script src="resources/js/sweetalert.js"></script>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
$("#fileupload").change(function(event) {
    var x = URL.createObjectURL(event.target.files[0]);
    $("#upload-img").attr("src", x);
    console.log(event);
  });
  
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
      background: 'rgb(22, 110, 47)'
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
      background: 'rgb(22, 110, 47)'
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




$(document).ready(function() {
      var scholarship_id = <?php echo json_encode($id); ?>;

      $("#additional_requirements").load("components/View_Additional_Requirements.php", {
        scholarship_id: scholarship_id
      });
});

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


</script>                                    
</html>