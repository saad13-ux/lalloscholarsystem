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
</style>

<div class="modal fade" id="addprofile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 align="left">Add Admin</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="add-admin-form" action="actions/action.add_admin.php" method="POST" enctype="multipart/form-data" onsubmit="return checkForm(this);">
        <div class="modal-body">
          <div class="form-group">
            <div class="profile-image-card">
              <div class="profile-images d-flex justify-content-center p-1 mb-2">
                <img src="../resources/admin_profile/user.png" id="uploading" alt="" width="150" height="150">
              </div>
              <div class="custom-file">
                <label for="fileimage">Upload Image</label>
                <input type="file" id="fileimage" name="image">
              </div>
            </div>
          </div>
          <div class="form-group row mb-2">
            <label class="control-label col-md-4 col-sm-3 col-xs-12">Username:</label>
            <div class="col-md-8 col-sm-6 col-xs-12">
              <input type="text" name="username" class="form-control" required>
            </div>
          </div>
         <div class="form-group row  mb-2">
            <label class="control-label col-md-4 col-sm-3 col-xs-12">New Password: </label>
            <div class="col-md-8 col-sm-6 col-xs-12">
              <input type="password" name="password" class="form-control" required>
            </div>
          </div>

          <div class="form-group row  mb-2">
            <label class="control-label col-md-4 col-sm-3 col-xs-12">Confirm Password: </label>
            <div class="col-md-8 col-sm-6 col-xs-12">
              <input type="password" name="confirm_password" class="form-control" required>
            </div>
          </div>
          <div class="form-group row mb-2">
            <label class="control-label col-md-4 col-sm-3 col-xs-12">Email:</label>
            <div class="col-md-8 col-sm-6 col-xs-12">
              <input type="email" name="email" class="form-control" required>
            </div>
          </div>
          <div class="form-group row mb-2">
            <label class="control-label col-md-4 col-sm-3 col-xs-12">First Name:</label>
            <div class="col-md-8 col-sm-6 col-xs-12">
              <input required type="text" name="first_name" class="form-control">
            </div>
          </div>
          <div class="form-group row mb-2">
            <label class="control-label col-md-4 col-sm-3 col-xs-12">Middle Name:</label>
            <div class="col-md-8 col-sm-6 col-xs-12">
              <input required type="text" name="middle_name" class="form-control">
            </div>
          </div>
          <div class="form-group row mb-2">
            <label class="control-label col-md-4 col-sm-3 col-xs-12">Last Name:</label>
            <div class="col-md-8 col-sm-6 col-xs-12">
              <input required type="text" name="last_name" class="form-control">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>  Close</button>
          <button type="submit" class="btn btn-primary" name="add_admin"><i class="fa fa-paper-plane" aria-hidden="true"></i>  Save</button>
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
  document.getElementById("fileimage").addEventListener("change", function(event) {
    var x = URL.createObjectURL(event.target.files[0]);
    document.getElementById("uploading").setAttribute("src", x);
    console.log(event);
  });


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
      if (!checkPassword(form.password.value)) {
        event.preventDefault();
      }
    });

    function checkPassword(password) {
      if (password !== form.confirm_password.value) {
        Toast.fire({
          icon: 'warning',
          title: 'Password mismatch'
        });
        form.password.focus();
        return false;
      }

      if (password.length < 6) {
        Toast.fire({
          icon: 'warning',
          title: 'Password must be at least 6 characters long'
        });
        form.password.focus();
        return false;
      }

      if (!/[a-z]/.test(password)) {
        Toast.fire({
          icon: 'warning',
          title: 'Password must have at least one lowercase letter'
        });
        form.password.focus();
        return false;
      }

      if (!/[A-Z]/.test(password)) {
         Toast.fire({
          icon: 'warning',
          title: 'Password must have at least one uppercase letter'
        });
        form.password.focus();
        return false;
      }

      if (!/[0-9]/.test(password)) {
        Toast.fire({
          icon: 'warning',
          title: 'Password must have at least one digit/number'
        });
        form.password.focus();
        return false;
      }

      if (!/[@$!%*?&]/.test(password)) {
        Toast.fire({
          icon: 'warning',
          title: 'Password must have at least one special character'
        });
        form.password.focus();
        return false;
      }

      return true;
    }
  });
</script>

