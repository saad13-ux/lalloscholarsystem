<style type="text/css">
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


<!-- Add Scholarship Modal -->
<div class="modal fade" id="addScholarship" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 align="left">Add Scholarship</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="actions/action.add-scholarship.php" method="POST" enctype="multipart/form-data" onsubmit="return validateArray(this);">

        <div class="modal-body">
          <div class=" form-group">
             <div class="profile-image-card">
              <div class="profile-images d-flex justify-content-center p-1 mb-2">
                <img src="../resources/admin_profile/user.png" id="uploading" alt="" width="150" height="150">
              </div>
              <div class="custom-file">
                <label for="fileimage">Upload Image</label>
                <input type="file" id="fileimage" name="image" accept=".jpg, .png, .jpeg">
              </div>
            </div>
          </div>
          <div class=" form-group">
            <label class="form-label col-md-4 col-sm-3 col-xs-12">Scholarship type: </label>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <input required type="text" name="scholarship_type" class="form-control">
            </div>
          </div>
          <!-- Date and time range -->
          <div class="form-group">
            <label>Date and time range:</label>

            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-clock"></i></span>
              </div>
              <input type="text" class="form-control float-right" id="scholarship_date_range" name="date_range">
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->
          <div class=" form-group ">
            <label class="form-label col-md-4 col-sm-3 col-xs-12">Amount: </label>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <input required type="number" name="amount" class="form-control">
            </div>
          </div>
          <div class=" form-group">
            <label class="form-label col-md-4 col-sm-3 col-xs-12">Description: </label>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <textarea required name="description" cols="30" rows="5" class="form-control"></textarea>
            </div>
          </div>
          

          <div class=" form-group" id="form_req">
            <label class="form-label col-md-4 col-sm-3 col-xs-12">Requirement: </label>
            <div class="col-md-12 col-sm-12 col-xs-12"  >
              <input type="text" name="requirement_name[]" class="form-control" required>
            </div>
          </div>
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-success" id="add_requirement_files"><i class="fas fa-plus"></i> ADD</button>
          </div>
        </div>
      
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-times' aria-hidden='true'></i> Close</button>
          <button type="submit" class="btn btn-primary" name="add_scholarship"><i class='fa fa-paper-plane' aria-hidden='true'></i> Save</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<script type="text/javascript">
  
document.getElementById("fileimage").addEventListener("change", function(event) {
    var x = URL.createObjectURL(event.target.files[0]);
    document.getElementById("uploading").setAttribute("src", x);
    console.log(event);
  });


function addNewFields() {
  $.get("components/additional_requirement_files.php", function(data) {
    $("#form_req").append(data);
  });
}

function removeParentform(element) {
  $(element).closest("#remove_form").remove();
}

$(document).ready(function() {
  $("#add_requirement_files").on("click", function() {
    addNewFields();
  });
});

function validateArray(form) {
            var requirement_name = form.elements["requirement_name[]"];
            var uniqueValues = {};

            for (var i = 0; i < requirement_name.length; i++) {
                var value = requirement_name[i].value;

                // Check if the value already exists in the uniqueValues object
                if (uniqueValues[value]) {
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
              title: 'Please check the same requirement',
              showConfirmButton: false,
              timer: 3000
            });
                    return false; // Prevent form submission
                }

                // Add the value to the uniqueValues object
                uniqueValues[value] = true;
            }

            return true; // Allow form submission
        }

</script>