<style>
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
<form method="post" action="<?= $action ?? 'actions/action.update-profile.php' ?>" id="myForm">
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

            $imagePath = "./resources/profile/" . $row['image_filename'];
            $defaultImagePath = "./resources/image/user.png";

            if (file_exists($imagePath)) {
                ?>
                <img src="<?= $imagePath ?>" id="upload-img" alt="<?= $imagePath ?>" width="300" height="300">
            <?php } else {?>
                <img src="<?= $defaultImagePath ?>" id="upload-img" alt="<?= $defaultImagePath ?>" width="300" height="300">
            <?php } ?>
              </div>
              <div class="custom-file">
                <label for="fileupload">Upload Profile</label>
                <input type="file" id="fileupload" name="image" required>
              </div>
            </div>
</div>
<input required class="form-control" type="hidden" name="user_id" value="<?= $_SESSION[$session_user_id] ?? '' ?>">
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="username">Username</label>
                <input required class="form-control" type="text" name="username" value="<?= $_SESSION[$session_username] ?? '' ?>" placeholder="Please Enter">
            </div>
            <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input required class="form-control" type="email" name="email" value="<?= $_SESSION[$session_email] ?? '' ?>" placeholder="Please Enter">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="last_name">Last Name</label>
                <input required class="form-control" type="text" name="last_name" value="<?= $_SESSION[$session_lname] ?? '' ?>" placeholder="Please Enter">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first_name">First Name</label>
                <input required class="form-control" type="text" name="first_name" value="<?= $_SESSION[$session_fname] ?? '' ?>" placeholder="Please Enter">
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
                    <option value="" disabled selected>Suffix</option>
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
                <select required name="gender" class="form-control">
                    <option value="" disabled selected>-- SELECT --</option>
                    <option value="Male" <?= $_SESSION[$session_prefix . 'gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= $_SESSION[$session_prefix . 'gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="dob">Date of Birth</label>
                <input required class="form-control" type="date" name="dob" value="<?= $_SESSION[$session_prefix . 'dob'] ?? '' ?>">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="contact_number">Contact Number</label>
                <input required class="form-control" type="number" name="mobile_no" value="<?= $_SESSION[$session_prefix . 'mobile_no'] ?? '' ?>" minlenght="11">
            </div>
            <div class="col-md-6 mb-3">
                <label for="nationality">Nationality</label>
                <input required class="form-control" type="text" name="nationality" value="<?= $_SESSION[$session_prefix . 'nationality'] ?? '' ?>">
            </div>
        </div>
    </div>
            
    <div class="form-group">
        <div class="form-row">
             <div class="col-md-6 mb-3">
                <label for="religion">Religion</label>
                <input required class="form-control" type="text" name="religion" value="<?= $_SESSION[$session_prefix . 'religion'] ?? '' ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="civil_status">Civil Status</label>
                <select required class="form-control" name="civil_status" id="civil_status">
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
                <input required class="form-control" type="text" name="highest_education" value="<?= $_SESSION[$session_prefix . 'highest_education'] ?? '' ?>">
            </div>
        
            <div class="col-md-6 mb-3">
                <label required for="skill_occupation">Skills/Occupation</label>
                <input class="form-control" type="text" name="skill_occupation" value="<?= $_SESSION[$session_prefix . 'skill_occupation'] ?? '' ?>">
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-3">
        <button type="submit" name="<?= $submit_name ?? 'update_profile' ?>" class="btn btn-primary">Submit</button>
    </div>
</form>
<script type="text/javascript">
$("#fileupload").change(function(event) {
    var x = URL.createObjectURL(event.target.files[0]);
    $("#upload-img").attr("src", x);
    console.log(event);
  });
</script>