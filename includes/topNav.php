<style type="text/css">
    #clock {
      font-size: 20px;
      font-weight: bold;
      color:white;
    }
</style>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color:#1d8c3c;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <div id="clock"></div>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="dropdownSubMenu1" href="#" role="button" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a class="dropdown-item" href="#!" data-toggle="modal" data-target="#editprofile"><i class="fas fa-user mr-2"></i>Profile</a></li>
                <!-- <li><a class="dropdown-item" href="#!" data-toggle="modal" data-target="#settings">Settings</a></li> -->
                <li><a class="dropdown-item" href="#!" data-toggle="modal" data-target="#changepass"><i class="fas fa-lock mr-2"></i>Change Password</a></li>
                <li>
                <li><a class="dropdown-item" href="#!" data-toggle="modal" data-target="#deleteaccount"><i class="fas fa-trash mr-2"></i>Delete Account</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="#!" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your exit.</div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cancel</button>
                <a class="btn btn-danger" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editprofile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 align="left">Edit Profile</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"><style>
    /* Chrome, Safari, Edge, Opera */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none !important;
        margin: 0 !important;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
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
<form method="post" action="./actions/action.update-profile.php" enctype="multipart/form-data" id="myForm">
<div class="form-group">
<div class="profile-image-card">
              <div class="profile-images d-flex justify-content-center p-1 mb-2">
              <?php
            $user_id = $_SESSION[$session_user_id];

            // Prepare and execute the query
            $stmt = $pdo->prepare("SELECT image_filename FROM user WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();

            // Fetch the result
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $imagePath = "resources/profile/" . $row['image_filename'];
            $defaultImagePath = "resources/profile/user.png";

            if (file_exists($imagePath)) {
                ?>
                <img src="<?= $imagePath ?>" id="upload-img" alt="<?= $imagePath ?>" width="300" height="300">
            <?php } else {?>
                <img src="<?= $defaultImagePath ?>" id="upload-img" alt="<?= $defaultImagePath ?>" width="300" height="300">
            <?php } ?>
              </div>
              <div class="custom-file">
                <label for="fileupload">Upload Profile</label>
                <input type="file" id="fileupload" name="image">
              </div>
            </div>
</div>
<input required class="form-control" type="hidden" name="user_id" value="<?= $_SESSION[$session_user_id] ?? '' ?>">
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" value="<?= $_SESSION[$session_username] ?? '' ?>" placeholder="Please Enter">
            </div>
            <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" value="<?= $_SESSION[$session_email] ?? '' ?>" placeholder="Please Enter">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="last_name">Last Name</label>
                <input class="form-control" type="text" name="last_name" value="<?= $_SESSION[$session_lname] ?? '' ?>" placeholder="Please Enter">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first_name">First Name</label>
                <input class="form-control" type="text" name="first_name" value="<?= $_SESSION[$session_fname] ?? '' ?>" placeholder="Please Enter">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="middle_name">Middle Name</label>
                <input class="form-control" type="text" name="middle_name" value="<?= $_SESSION[$session_mname] ?? '' ?>" placeholder="Please Enter">
            </div>
            <div class="col-md-6 mb-3">
                <label for="ext_name">Extension Name</label>
                <select name="ext_name" class="form-control">
                    <option value="" selected>Suffix</option>
                    <option value="Jr." <?= $_SESSION[$session_prefix . 'ext_name'] == 'Jr.' ? 'selected' : '' ?>>Jr.</option>
                    <option value="Sr." <?= $_SESSION[$session_prefix . 'ext_name'] == 'Sr.' ? 'selected' : '' ?>>Sr.</option>
                    <option value="II" <?= $_SESSION[$session_prefix . 'ext_name'] == 'II.' ? 'selected' : '' ?>>II</option>
                    <option value="III" <?= $_SESSION[$session_prefix . 'ext_name'] == 'III.' ? 'selected' : '' ?>>III</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="gender">Sex</label>
                <select name="gender" class="form-control">
                    <option value="" disabled selected>-- SELECT --</option>
                    <option value="Male" <?= $_SESSION[$session_prefix . 'gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= $_SESSION[$session_prefix . 'gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="dob">Date of Birth</label>
                <input class="form-control" type="date" name="dob" value="<?= $_SESSION[$session_prefix . 'dob'] ?? '' ?>">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
        <div class="col-md-12 mb-3">
                <label for="dob">Address</label>
                <input class="form-control" type="text" name="address" value="<?= $_SESSION[$session_prefix . 'address'] ?? '' ?>">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="contact_number">Contact Number</label>
                <input class="form-control" type="number" name="mobile_no" value="<?= $_SESSION[$session_prefix . 'mobile_no'] ?? '' ?>" minlenght="11">
            </div>
            <div class="col-md-6 mb-3">
                <label for="nationality">Nationality</label>
                <input class="form-control" type="text" name="nationality" value="<?= $_SESSION[$session_prefix . 'nationality'] ?? '' ?>">
            </div>
        </div>
    </div>
            
    <div class="form-group">
        <div class="form-row">
             <div class="col-md-6 mb-3">
                <label for="religion">Religion</label>
                <input class="form-control" type="text" name="religion" value="<?= $_SESSION[$session_prefix . 'religion'] ?? '' ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="civil_status">Civil Status</label>
                <select class="form-control" name="civil_status" id="civil_status">
                    <option selected disabled value="">-- SELECT ---</option>
                    <option value="Single" <?= $_SESSION[$session_prefix . 'civil_status'] == 'Single' ? 'selected' : '' ?>>Single</option>
                    <option value="Married" <?= $_SESSION[$session_prefix . 'civil_status'] == 'Married' ? 'selected' : '' ?>>Married</option>
                    <option value="Annulled" <?= $_SESSION[$session_prefix . 'civil_status'] == 'Annulled' ? 'selected' : '' ?>>Annulled</option>
                    <option value="Divorced" <?= $_SESSION[$session_prefix . 'civil_status'] == 'Divorced' ? 'selected' : '' ?>>Divorced</option>
                    <option value="Widowed" <?= $_SESSION[$session_prefix . 'civil_status'] == 'Widowed' ? 'selected' : '' ?>>Widowed</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="form-row">
            <div class=" col-md-6 mb-3">
                <label for="highest_education">Highest Education</label>
                <input class="form-control" type="text" name="highest_education" value="<?= $_SESSION[$session_prefix . 'highest_education'] ?? '' ?>">
            </div>
        
            <div class="col-md-6 mb-3">
                <label for="skill_occupation">Skills/Occupation</label>
                <input class="form-control" type="text" name="skill_occupation" value="<?= $_SESSION[$session_prefix . 'skill_occupation'] ?? '' ?>">
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-3 ">
        <button type="submit" name="update_profile" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
        &nbsp;
        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> Close</button>
        
    </div>
</form>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
document.getElementById("fileupload").addEventListener("change", function(event) {
  var file = event.target.files[0];
  var reader = new FileReader();

  reader.onload = function(e) {
    document.getElementById("upload-img").src = e.target.result;
  };

  reader.readAsDataURL(file);
  console.log(event);
});

</script>

<div class="modal fade" id="deleteaccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h4 align="left">Delete Account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="./actions/action.delete-account.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <b>Are you sure you want to delete this Account?</b>
                </div>
                <input type="hidden" name="user_id" value="<?php echo $_SESSION[$session_user_id]; ?>">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" name="delete_user"><i class="fa fa-check-circle" aria-hidden="true"></i> Yes</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> No</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changepass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 align="left">Change Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-admin-form" action="./actions/action.update-password.php" method="POST" onsubmit="return checkForm(this);">
                <div class="modal-body">
                    <input type="hidden" name="username" value="<?php echo $_SESSION[$session_username]; ?>">
                    <div class="form-group row  mb-2">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Old Password: </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <input type="password" name="old_password" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row  mb-2">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">New Password: </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <input type="password" name="new_password" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row  mb-2">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Confirm Password: </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Close</button>
                    <button type="submit" name="change_password" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Save</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script src="../resources/js/sweetalert.js"></script>

<script type="text/javascript">
  
  document.addEventListener("DOMContentLoaded", function() {

       var Toast = Swal.mixin({
        toast: true,
        position: "top",
        showConfirmButton: false,
        timer: 3000,
        customClass: {
    content: 'text-center',
    heightAuto: 'custom-toast-height'
    // Add this line to center the text
  }
});

    var form = document.getElementById("add-admin-form");
    form.addEventListener("submit", function(event) {
      if (!checkPassword(form.new_password.value)) {
        event.preventDefault();
      }
    });

    function checkPassword(new_password) {
      if (new_password !== form.confirm_password.value) {
        Toast.fire({
          icon: 'warning',
          title: 'Password mismatch'
        });
        form.new_password.focus();
        return false;
      }

      if (new_password.length < 6) {
        Toast.fire({
          icon: 'warning',
          title: 'Password must be at least 6 characters long'
        });
        form.new_password.focus();
        return false;
      }

      if (!/[a-z]/.test(new_password)) {
        Toast.fire({
          icon: 'warning',
          title: 'Password must have at least one lowercase letter'
        });
        form.new_password.focus();
        return false;
      }

      if (!/[A-Z]/.test(new_password)) {
         Toast.fire({
          icon: 'warning',
          title: 'Password must have at least one uppercase letter'
        });
        form.new_password.focus();
        return false;
      }

      if (!/[0-9]/.test(new_password)) {
        Toast.fire({
          icon: 'warning',
          title: 'Password must have at least one digit/number'
        });
        form.new_password.focus();
        return false;
      }

      if (!/[_@$!%*?&]/.test(new_password)) {
        Toast.fire({
          icon: 'warning',
          title: 'Password must have at least one special character'
        });
        form.new_password.focus();
        return false;
      }

      return true;
    }
  });
  
  function updateTime() {
      var currentTime = new Date();
      var hours = currentTime.getHours();
      var minutes = currentTime.getMinutes();
      var seconds = currentTime.getSeconds();
      var ampm = hours >= 12 ? 'PM' : 'AM';

      hours = hours % 12;
      hours = hours ? hours : 12; // Convert to 12-hour format
      minutes = minutes < 10 ? '0' + minutes : minutes;
      seconds = seconds < 10 ? '0' + seconds : seconds;

      var clockElement = document.getElementById('clock');
      var dateOptions = { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' };
      var time = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
      var date = currentTime.toLocaleDateString(undefined, dateOptions);
      clockElement.innerText =' | ' + date + ' | ' + time + ' | ';

      setTimeout(updateTime, 1000); // Update every second
    }

    window.onload = updateTime;
</script>