<style type="text/css">
  .profile-image-card {
    margin: auto;
    display: table;
    background: #fff;
    padding: 30px 50px;
    box-shadow: 0px 0px 5px #ddd;
  }

  .profile-images {
    width: 150px;
    height: 150px;
    background: #fff;
    border-radius: 5%;
    overflow: hidden;
  }

  .profile-images img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .custom-file input[type="file"] {
    display: none;
  }

  .custom-file label {
    cursor: pointer;
    color: #000;
    text-align: center;
    display: table;
    margin: auto;
    margin-top: 15px;
  }
  #clock {
      font-size: 20px;
      font-weight: bold;
      color:white;
    }
</style>
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
    <!-- Notifications -->
    <?php
    $pdo->query("DELETE FROM admin_notification WHERE status = 1;");

    $notif_sql = "SELECT * FROM admin_notification WHERE status = 0;";
    $notif_qry = $pdo->query($notif_sql);

    ?>
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fa fa-bell"></i>
        <?php
        if ($notif_qry->rowCount() > 0) {
        ?>
          <span class="badge badge-danger navbar-badge"><?= $notif_qry->rowCount() ?></span>
        <?php } ?>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <?php
        if ($notif_qry->rowCount() > 0) {
        ?>
          <span class="dropdown-item dropdown-header"> <?= $notif_qry->rowCount() ?> Notifications</span>
        <?php } else { ?>
          <span class="dropdown-item dropdown-header"> No new notifications</span>
        <?php } ?>
        <?php
        while ($row = $notif_qry->fetch(PDO::FETCH_ASSOC)) {
        ?>
          <div class="dropdown-divider"></div>
          <a href="<?= $row['type'] == 1 ? 'application.php' : ($row['type'] == 2 ? 'account.php' : ($row['type'] == 3 ? 'feedback.php' : '#')) ?>" class="dropdown-item pb-4 pl-2 pr-3">
            <div class="d-flex justify-content-center align-content-center">
              <i class="fas fa-envelope mr-2 align-self-center"></i>
              <span class="text-wrap text-sm"><?= $row['message'] ?></span>
            </div>
            <span class="float-right text-muted text-sm"><?= getPassedTime($row['dt_created']) ?></span>
          </a>
        <?php } ?>
        <div class="dropdown-divider"></div>
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link" id="dropdownSubMenu1" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
      <div class="user-panel d-flex">
        <div class="image">
           <?php
            $admin_id =  $_SESSION[$session_id];

            // Prepare and execute the query
            $stmt = $pdo->prepare("SELECT image_filename FROM admin WHERE admin_id = :admin_id");
            $stmt->bindParam(':admin_id', $admin_id);
            $stmt->execute();

            // Fetch the result
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $imagePath = "../resources/admin_profile/" . $row['image_filename'];
            $defaultImagePath = "../resources/admin_profile/user.png";

            if (file_exists($imagePath)) {
                ?>
                <img src="<?= $imagePath ?>" class="img-size-10 mr-1 img-circle"  style="width:30px; height: 30px;" alt="<?= $imagePath ?>">
                <?php
            } else{ ?>
                <img src="<?= $defaultImagePath ?>" class="img-size-10 mr-1 img-circle" style="width: 30px; height: 30px;" alt="<?= $defaultImagePath ?>">
              <?php
            }
            ?>
            </div>
          </div>
        </a>
      <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
        <li><a class="dropdown-item" href="#!" data-toggle="modal" data-target="#editprofile"><i class="fas fa-user mr-2"></i>Profile</a></li>
        <!-- <li><a class="dropdown-item" href="#!" data-toggle="modal" data-target="#settings">Settings</a></li> -->
        <li><a class="dropdown-item" href="#!" data-toggle="modal" data-target="#changepass"><i class="fas fa-lock mr-2"></i>Change Password</a></li>
          <!-- <li><a class="dropdown-item" href="#!" data-toggle="modal" data-target="#deleteaccount"><i class="fas fa-trash mr-2"></i>Delete Account</a></li>-->
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
      <div class="modal-body">Are you Sure you want to exit?</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
        <a class="btn btn-danger" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteaccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h4 align="left">Delete Account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="actions/action.delete-account_admin.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <b>Are you sure you want to delete this Account?</b>
                </div>
                <input type="hidden" name="user_id" value="<?php echo $_SESSION[$session_id]; ?>">
                <input type="hidden" name="user_name" value="<?php echo $_SESSION[$session_username]; ?>">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" name="delete_user"><i class="fa fa-check" aria-hidden="true"></i> Yes</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> No</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
      <form action="actions/action.update-profile.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
           <div class=" form-group  row mb-2">
            <div class="profile-image-card">
              <div class="profile-images d-flex justify-content-center p-1 mb-2">
           <?php
            $admin_id =  $_SESSION[$session_id];

            // Prepare and execute the query
            $stmt = $pdo->prepare("SELECT image_filename FROM admin WHERE admin_id = :admin_id");
            $stmt->bindParam(':admin_id', $admin_id);
            $stmt->execute();

            // Fetch the result
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $imagePath = "../resources/admin_profile/" . $row['image_filename'];
             $defaultImagePath = "../resources/admin_profile/user.png";

            if (file_exists($imagePath)) {
                ?>
                <img src="<?= $imagePath ?>" id="img"  alt="<?= $imagePath ?>">
            
               <?php
            } else{
                ?>
                <img src="<?= $defaultImagePath ?>" id="img"  alt="<?= $defaultImagePath ?>">
              <?php
            }
            ?>
              </div>
              <div class="custom-file">
                <label for="fileupload">Upload Image</label>
                <input type="file" id="fileupload" name="image">
              </div>
            </div>
          </div>
       
          <div class=" form-group row mb-2">
            <label class="control-label col-md-4 col-sm-3 col-xs-12">Username: </label>
            <div class="col-md-8 col-sm-6 col-xs-12">
              <input type="text" name="username" class="form-control" value="<?= $_SESSION[$session_username]; ?>">
            </div>
          </div>
          <div class=" form-group row mb-2">
            <label class="control-label col-md-4 col-sm-3 col-xs-12">Email: </label>
            <div class="col-md-8 col-sm-6 col-xs-12">
              <input type="text" name="email" class="form-control"  value="<?= $_SESSION[$session_email]; ?>">
            </div>
          </div>
          <div class="form-group row mb-2">
            <label class="control-label col-md-4 col-sm-3 col-xs-12">First Name: </label>
            <div class="col-md-8 col-sm-6 col-xs-12">
              <input type="text" name="first_name" value="<?= $_SESSION[$session_fname] ?>" class="form-control">
            </div>
          </div>
          <div class="form-group row mb-2">
            <label class="control-label col-md-4 col-sm-3 col-xs-12">Middle Name: </label>
            <div class="col-md-8 col-sm-6 col-xs-12">
              <input type="text" name="middle_name" value="<?= $_SESSION[$session_mname] ?>" class="form-control">
            </div>
          </div>
          <div class="form-group row mb-2">
            <label class="control-label col-md-4 col-sm-3 col-xs-12">Last Name: </label>
            <div class="col-md-8 col-sm-6 col-xs-12">
              <input type="text" name="last_name" value="<?= $_SESSION[$session_lname] ?>" class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
          <button type="submit" class="btn btn-primary" name="update_profile"><i class="fa fa-paper-plane" aria-hidden="true"></i> Save</button>
        </div>
      </form>
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
    document.getElementById("img").src = e.target.result;
  };

  reader.readAsDataURL(file);
  console.log(event);
});


</script>


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
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
          <button type="submit" name="change_password" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Save</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="../../resources/js/sweetalert.js"></script>

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

      if (!/[#@$!%*?&]/.test(new_password)) {
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