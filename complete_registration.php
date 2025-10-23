<?php
include 'includes/pdo_conn.php';
include 'includes/session_variables.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Complete Registration</title>
    <link href="resources/images/lgulallo.png" rel="icon">

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
      --success-color: #28a745;
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

    h1 {
      color: var(--primary-color);
      text-align: center;
      margin-bottom: 1.5rem;
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

    .progress {
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
      transition: all 0.3s ease;
    }

    .progress-step-active {
      background: var(--primary-color);
      transform: scale(1.1);
    }

    .progress-step::after {
      content: attr(data-title);
      position: absolute;
      top: calc(100% + 0.5rem);
      font-size: 0.85rem;
      color: #666;
      white-space: nowrap;
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

    input, select {
      width: 100%;
      padding: 0.7rem;
      border-radius: 10px;
      border: 1px solid #ccc;
      margin-bottom: 1rem;
      outline: none;
      transition: 0.3s;
      font-family: inherit;
    }

    input:focus, select:focus {
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
      font-family: inherit;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      justify-content: center;
    }

    .btn-primary:hover {
      background: #084cdf;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .btn-secondary {
      background: #6c757d;
      border: none;
      color: #fff;
      padding: 0.7rem 1.5rem;
      border-radius: 10px;
      transition: 0.3s;
      cursor: pointer;
      font-family: inherit;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      justify-content: center;
    }

    .btn-secondary:hover {
      background: #5a6268;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .btns-group {
      display: flex;
      justify-content: space-between;
      gap: 1rem;
      flex-wrap: wrap;
      margin-top: 1.5rem;
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

    .profile-image-card {
      background: #fff;
      border-radius: 15px;
      padding: 2rem;
      text-align: center;
      margin-bottom: 1.5rem;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      border: 1px solid #eaeaea;
    }

    .profile-images {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      overflow: hidden;
      margin: 0 auto 1rem;
      border: 3px solid var(--primary-color);
    }

    .profile-images img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .file-input {
      position: relative;
      overflow: hidden;
      display: inline-block;
      margin-top: 1rem;
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
      display: inline-block;
      padding: 0.7rem 1.5rem;
      background: var(--primary-color);
      color: #fff;
      border-radius: 10px;
      cursor: pointer;
      transition: 0.3s;
    }

    .file-input-label:hover {
      background: #084cdf;
    }

    .step-title {
      color: var(--primary-color);
      margin-bottom: 1.5rem;
      padding-bottom: 0.5rem;
      border-bottom: 1px solid #eaeaea;
    }

    .input-hint {
      font-size: 0.8rem;
      color: #6c757d;
      margin-top: -0.5rem;
      margin-bottom: 1rem;
    }

    .required-field::after {
      content: " *";
      color: #dc3545;
    }

    @media (max-width: 768px) {
      .form-col {
        flex: 1 1 100%;
      }
      
      .card-form {
        padding: 1rem;
      }
      
      .btns-group {
        flex-direction: column;
      }
      
      .progress-step::after {
        font-size: 0.7rem;
      }
    }
    </style>
</head>

<body>
    <div class="card-form">
        <form class="form" method="post" action="actions/action.complete_registration.php" id="myForm" name="myForm" enctype="multipart/form-data" onsubmit="return checkForm(this);">
            <h1>Complete Your Registration</h1>
            
            <!-- Progress bar -->
            <div class="progressbar">
                <div class="progress" id="progress"></div>
                
                <div class="progress-step progress-step-active" data-title="Profile"><i class="fa fa-user-circle" aria-hidden="true"></i></div>
                <div class="progress-step" data-title="Personal"><i class="fa fa-address-card" aria-hidden="true"></i></div>
                <div class="progress-step" data-title="Details"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                <div class="progress-step" data-title="Finish"><i class="fa fa-check-circle" aria-hidden="true"></i></div>
            </div>

            <!-- Step 1: Profile -->
            <div class="form-step form-step-active">
                <h3 class="step-title">Profile Information</h3>
                <div class="profile-image-card">
                    <div class="profile-images">
                        <img src="resources/profile/user.png" id="upload-img" alt="Profile Image">
                    </div>
                    <div class="file-input">
                        <label for="fileupload" class="file-input-label">
                            <i class="fa fa-upload"></i> Upload Profile Picture
                        </label>
                        <input required type="file" id="fileupload" name="image" accept="image/*">
                    </div>
                   
                </div>
                <input type="hidden" name="user_id" value="<?= $_SESSION[$session_user_id] ?? '' ?>">
                
                <div class="btns-group">
                    <div></div> <!-- Empty div for spacing -->
                    <button type="button" class="btn-primary btn-next">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                </div>
            </div>

            <!-- Step 2: Personal Information -->
            <div class="form-step">
                <h3 class="step-title">Personal Information</h3>
                <div class="form-row">
                    <div class="form-col">
                        <label for="username" class="required-field">Username</label>
                        <input required type="text" name="username" value="<?= $_SESSION[$session_username] ?? '' ?>" placeholder="Enter your username">
                    </div>
                    <div class="form-col">
                        <label for="email" class="required-field">Email</label>
                        <input required type="email" name="email" value="<?= $_SESSION[$session_email] ?? '' ?>" placeholder="Enter your email">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label for="last_name" class="required-field">Last Name</label>
                        <input required type="text" name="last_name" value="<?= $_SESSION[$session_lname] ?? '' ?>" placeholder="Enter your last name">
                    </div>
                    <div class="form-col">
                        <label for="first_name" class="required-field">First Name</label>
                        <input required type="text" name="first_name" value="<?= $_SESSION[$session_fname] ?? '' ?>" placeholder="Enter your first name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" name="middle_name" value="<?= $_SESSION[$session_mname] ?? '' ?>" placeholder="Enter your middle name">
                    </div>
                    <div class="form-col">
                        <label for="ext_name">Extension Name</label>
                        <select name="ext_name">
                            <option value="" disabled selected>Select Suffix</option>
                            <option value="Jr." <?= $_SESSION[$session_ext_name] == 'Jr.' ? 'selected' : '' ?>>Jr.</option>
                            <option value="Sr." <?= $_SESSION[$session_ext_name] == 'Sr.' ? 'selected' : '' ?>>Sr.</option>
                            <option value="II" <?= $_SESSION[$session_ext_name] == 'II' ? 'selected' : '' ?>>II</option>
                            <option value="III" <?= $_SESSION[$session_ext_name] == 'III' ? 'selected' : '' ?>>III</option>
                        </select>
                    </div>
                </div>
                
                <div class="btns-group">
                    <button type="button" class="btn-secondary btn-prev"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</button>
                    <button type="button" class="btn-primary btn-next">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                </div>
            </div>

            <!-- Step 3: Additional Details -->
            <div class="form-step">
                <h3 class="step-title">Personal Details</h3>
                <div class="form-row">
                    <div class="form-col">
                        <label for="gender" class="required-field">Sex</label>
                        <select required name="gender">
                            <option value="" disabled selected>Select Sex</option>
                            <option value="Male" <?= $_SESSION[$session_gender] == 'Male' ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= $_SESSION[$session_gender] == 'Female' ? 'selected' : '' ?>>Female</option>
                        </select>
                    </div>
                    <div class="form-col">
                        <label for="dob" class="required-field">Date of Birth</label>
                        <input required type="date" name="dob" placeholder="Select your date of birth" value="<?= $_SESSION[$session_dob] ?? '' ?>">
                       
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label for="contact_number" class="required-field">Contact Number</label>
                        <input required type="number" name="mobile_no" placeholder="Enter your contact number" minlength="11" value="<?= $_SESSION[$session_mobile] ?? '' ?>">
                    </div>
                    <div class="form-col">
                        <label for="nationality" class="required-field">Nationality</label>
                        <select required name="nationality">
                            <option value="" disabled selected>Select Nationality</option>
                            <option value="Filipino" <?= $_SESSION[$session_nationality] == 'Filipino' ? 'selected' : '' ?>>Filipino</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col-full">
                        <label for="address" class="required-field">Complete Address</label>
                        <input required type="text" name="address" id="address" placeholder="Enter your complete address" value="<?= $_SESSION[$session_address] ?? '' ?>">
                    </div>
                </div>
                
                <div class="btns-group">
                    <button type="button" class="btn-secondary btn-prev"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</button>
                    <button type="button" class="btn-primary btn-next">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                </div>
            </div>

            <!-- Step 4: Final Details -->
            <div class="form-step">
                <h3 class="step-title">Additional Information</h3>
                <div class="form-row">
                    <div class="form-col">
                        <label for="religion" class="required-field">Religion</label>
                        <select required name="religion">
                            <option value="" disabled selected>Select Religion</option>
                            <option value="Roman Catholic" <?= $_SESSION[$session_religion] == 'Roman Catholic' ? 'selected' : '' ?>>Roman Catholic</option>
                            <option value="Islam" <?= $_SESSION[$session_religion] == 'Islam' ? 'selected' : '' ?>>Islam</option>
                            <option value="Iglesia ni Cristo" <?= $_SESSION[$session_religion] == 'Iglesia ni Cristo' ? 'selected' : '' ?>>Iglesia ni Cristo</option>
                            <option value="Protestant" <?= $_SESSION[$session_religion] == 'Protestant' ? 'selected' : '' ?>>Protestant</option>
                            <option value="Baptist" <?= $_SESSION[$session_religion] == 'Baptist' ? 'selected' : '' ?>>Baptist</option>
                            <option value="Methodist" <?= $_SESSION[$session_religion] == 'Methodist' ? 'selected' : '' ?>>Methodist</option>
                            <option value="Seventh-day Adventist" <?= $_SESSION[$session_religion] == 'Seventh-day Adventist' ? 'selected' : '' ?>>Seventh-day Adventist</option>
                            <option value="Mormon" <?= $_SESSION[$session_religion] == 'Mormon' ? 'selected' : '' ?>>Mormon</option>
                            <option value="Jehovah's Witness" <?= $_SESSION[$session_religion] == 'Jehovah\'s Witness' ? 'selected' : '' ?>>Jehovah's Witness</option>
                            <option value="Buddhism" <?= $_SESSION[$session_religion] == 'Buddhism' ? 'selected' : '' ?>>Buddhism</option>
                            <option value="Hinduism" <?= $_SESSION[$session_religion] == 'Hinduism' ? 'selected' : '' ?>>Hinduism</option>
                            <option value="Judaism" <?= $_SESSION[$session_religion] == 'Judaism' ? 'selected' : '' ?>>Judaism</option>
                            <option value="Aglipayan" <?= $_SESSION[$session_religion] == 'Aglipayan' ? 'selected' : '' ?>>Aglipayan</option>
                            <option value="Evangelical" <?= $_SESSION[$session_religion] == 'Evangelical' ? 'selected' : '' ?>>Evangelical</option>
                            <option value="None" <?= $_SESSION[$session_religion] == 'None' ? 'selected' : '' ?>>None</option>
                            <option value="Other" <?= $_SESSION[$session_religion] == 'Other' ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>
                    <div class="form-col">
                        <label for="civil_status" class="required-field">Civil Status</label>
                        <select required name="civil_status" id="civil_status">
                            <option selected disabled value="">Select Civil Status</option>
                            <option value="Single" <?= $_SESSION[$session_civil_status] == 'Single' ? 'selected' : '' ?>>Single</option>
                            <option value="Married" <?= $_SESSION[$session_civil_status] == 'Married' ? 'selected' : '' ?>>Married</option>
                            <option value="Annulled" <?= $_SESSION[$session_civil_status] == 'Annulled' ? 'selected' : '' ?>>Annulled</option>
                            <option value="Divorced" <?= $_SESSION[$session_civil_status] == 'Divorced' ? 'selected' : '' ?>>Divorced</option>
                            <option value="Widowed" <?= $_SESSION[$session_civil_status] == 'Widowed' ? 'selected' : '' ?>>Widowed</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label for="highest_education" class="required-field">Highest Education</label>
                        <select required name="highest_education">
                            <option value="" disabled selected>Select Highest Education</option>
                            <option value="No Formal Education" <?= $_SESSION[$session_highest_education] == 'No Formal Education' ? 'selected' : '' ?>>No Formal Education</option>
                            <option value="Elementary Level" <?= $_SESSION[$session_highest_education] == 'Elementary Level' ? 'selected' : '' ?>>Elementary Level</option>
                            <option value="Elementary Graduate" <?= $_SESSION[$session_highest_education] == 'Elementary Graduate' ? 'selected' : '' ?>>Elementary Graduate</option>
                            <option value="High School Level" <?= $_SESSION[$session_highest_education] == 'High School Level' ? 'selected' : '' ?>>High School Level</option>
                            <option value="High School Graduate" <?= $_SESSION[$session_highest_education] == 'High School Graduate' ? 'selected' : '' ?>>High School Graduate</option>
                           <option value="Senior High School Graduate" <?= $_SESSION[$session_highest_education] == 'Senior High School Graduate' ? 'selected' : '' ?>>Senior High School Graduate</option>
                            <option value="Vocational/Trade Course" <?= $_SESSION[$session_highest_education] == 'Vocational/Trade Course' ? 'selected' : '' ?>>Vocational/Trade Course</option>
                            <option value="College Level" <?= $_SESSION[$session_highest_education] == 'College Level' ? 'selected' : '' ?>>College Level</option>
                            <option value="College Graduate" <?= $_SESSION[$session_highest_education] == 'College Graduate' ? 'selected' : '' ?>>College Graduate</option>
                            <option value="Post Graduate" <?= $_SESSION[$session_highest_education] == 'Post Graduate' ? 'selected' : '' ?>>Post Graduate</option>
                            <option value="Master's Degree" <?= $_SESSION[$session_highest_education] == 'Master\'s Degree' ? 'selected' : '' ?>>Master's Degree</option>
                            <option value="Doctorate Degree" <?= $_SESSION[$session_highest_education] == 'Doctorate Degree' ? 'selected' : '' ?>>Doctorate Degree</option>
                        </select>
                    </div>
                    <div class="form-col">
                        <label for="skill_occupation" class="required-field">Skills/Occupation</label>
                        <input required type="text" name="skill_occupation" placeholder="Enter your skills or occupation" value="<?= $_SESSION[$session_skills_occupation] ?? '' ?>">
                    </div>
                </div>
                
                <div class="btns-group">
                    <button type="button" class="btn-secondary btn-prev"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</button>
                    <button type="submit" class="btn-primary" name="complete_registration">Submit <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </div>
            </div>
        </form>
    </div>

    <?php require 'includes/sweet-alert-toast.php'; ?>
    <script src="resources/js/sweetalert.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <script type="text/javascript">
    $(document).ready(function() {
        // Profile image preview
        $("#fileupload").change(function(event) {
            var x = URL.createObjectURL(event.target.files[0]);
            $("#upload-img").attr("src", x);
        });

        // Multi-step form functionality
        const prevBtns = document.querySelectorAll(".btn-prev");
        const nextBtns = document.querySelectorAll(".btn-next");
        const progress = document.getElementById("progress");
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
                    // Add visual feedback for empty required fields
                    inputs[i].style.borderColor = "#dc3545";
                    setTimeout(() => {
                        inputs[i].style.borderColor = "";
                    }, 2000);
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

        // Form validation function
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
                }
            });
            
            if (document.myForm.image.value=="") {
                Toast.fire({
                    icon: 'warning',
                    title: 'Please Provide Image'
                });
                document.myForm.image.focus();
                return false;
            }

            if (document.myForm.username.value=="") {
                Toast.fire({
                    icon: 'warning',
                    title: 'Please Provide Username'
                });
                document.myForm.username.focus();
                return false;
            }
            
            if (document.myForm.email.value=="") {
                Toast.fire({
                    icon: 'warning',
                    title: 'Please Provide Email'
                });
                document.myForm.email.focus();
                return false;
            }
            
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

            if (document.myForm.address.value=="") {
                Toast.fire({
                    icon: 'warning',
                    title: 'Please Provide Complete Address'
                });
                document.myForm.address.focus();
                return false;
            }

            if (document.myForm.mobile_no.value=="") {
                Toast.fire({
                    icon: 'warning',
                    title: 'Please Provide Contact Number'
                });
                document.myForm.mobile_no.focus();
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

            if (document.myForm.religion.value=="") {
                Toast.fire({
                    icon: 'warning',
                    title: 'Please Provide Religion'
                });
                document.myForm.religion.focus();
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

            if (document.myForm.highest_education.value=="") {
                Toast.fire({
                    icon: 'warning',
                    title: 'Please Provide Highest Education'
                });
                document.myForm.highest_education.focus();
                return false;
            }

            if (document.myForm.skill_occupation.value=="") {
                Toast.fire({
                    icon: 'warning',
                    title: 'Please Provide Skill Occupation'
                });
                document.myForm.skill_occupation.focus();
                return false;
            }
            
            // If all validations pass
            return true;
        }
    });
    </script>
</body>
</html>