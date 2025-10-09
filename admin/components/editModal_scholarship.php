<!-- Edit Scholarship Modal -->
<div class="modal fade" id="editScholarship" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 align="left">Edit Scholarship</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="actions/action.edit-scholarship.php" method="POST" enctype="multipart/form-data" id="myForm" onsubmit="return validateArrays(this)">
        <div class="modal-body">
          <div class=" form-group">
            <div class="profile-image-card">
              <div class="profile-images d-flex justify-content-center p-1 mb-2">
                <img src="../resources/image/default.jpg" id="edit-upload-img" alt="" width="150" height="150">
              </div>
              <div class="custom-file">
                <label for="edit_file_upload">Upload Image</label>
                <input type="file" id="edit_file_upload" name="image">
              </div>
            </div>
          </div>
          <div class=" form-group row mb-2">
            <label class="control-label col-md-4 col-sm-3 col-xs-12">Scholarship type: </label>
            <div class="col-md-12 col-sm-6 col-xs-12">
              <input required type="text" name="scholarship_type" id="edit_scholarship_type" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label>Date and time range:</label>

            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-clock"></i></span>
              </div>
              <input type="text" class="form-control float-right" id="edit_scholarship_date_range" name="date_range">
            </div>
            <!-- /.input group -->
          </div>

          <div class=" form-group row mb-2">
            <label class="control-label col-md-4 col-sm-3 col-xs-12">Amount: </label>
            <div class="col-md-12 col-sm-6 col-xs-12">
              <input required type="text" name="amount" id="edit_amount" class="form-control">
            </div>
          </div>
          <div class=" form-group row mb-2">
            <label class="control-label col-md-4 col-sm-3 col-xs-12">Description: </label>
            <div class="col-md-12 col-sm-6 col-xs-12">
              <textarea required name="description" id="edit_description" cols="30" rows="5" class="form-control"></textarea>
            </div>
          </div>
          
          <!-- Update Id -->
          <input type="hidden" name="scholarship_id" id="edit_scholarship_id">

          <div id="edit_requirement">



          </div>

          <div class="form-group" id="edit_add">
              <label class="form-label col-md-4 col-sm-3 col-xs-12">Requirement: </label>
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="text" name="req_name[]" class="form-control" >
              </div>
          </div>
          <div class="d-flex justify-content-end">
              <button type="button" class="btn btn-success" id="edit_add_req"><i class="fas fa-plus"></i>ADD</button>
          </div>

         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-times' aria-hidden='true'></i> Close</button>
          <button type="submit" class="btn btn-primary" name="edit_scholarship" ><i class='fa fa-paper-plane' aria-hidden='true'></i> Save</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
  $(function() {
    $("#edit_file_upload").change(function(event) {
      var x = URL.createObjectURL(event.target.files[0]);
      $("#edit-upload-img").attr("src", x);
      console.log(event);
    });
  });

   function addNew() {
        var newField = `
            <div class="form-group" id="edit_id">
                <div class="row">
                    <div class="col-md-10 col-sm-10 col-xs-10">
                        <input type="text" name="req_name[]" class="form-control">
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <button type="button" class="btn btn-danger" onclick="removeParent(this)"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
        `;
        $("#edit_add").before(newField);
    }

    function removeParent(element) {
        $(element).closest("#edit_id").remove();
    }

    $(document).ready(function() {
        $("#edit_add_req").on("click", function() {
            addNew();
        });
    });


    function validateArrays(form) {
    var req_name = form.elements["req_name[]"];
    var requirement_name = form.elements["requirement_name[]"];
    var reqValues = {};
    var reqReqValues = {};

    // Validate the first array (req_name[])
    for (var i = 0; i < req_name.length; i++) {
      var value = req_name[i].value.trim();

      // Skip empty values
      if (value === "") continue;

      // Check for duplicates within the first array
      if (reqValues[value]) {
        showErrorMessage();
        return false; // Prevent form submission
      }

      reqValues[value] = true;
    }

    // Validate the second array (requirement_name[])
    for (var i = 0; i < requirement_name.length; i++) {
      var value_requirement_name = requirement_name[i].value.trim();

      // Skip empty values
      if (value_requirement_name === "") continue;

      // Check for duplicates within the second array
      if (reqReqValues[value_requirement_name]) {
        showErrorMessage();
        return false; // Prevent form submission
      }

      reqReqValues[value_requirement_name] = true;

      // Check if the value exists in the first array (req_name[])
      for (var j = 0; j < req_name.length; j++) {
        if (value_requirement_name === req_name[j].value.trim()) {
          // Duplicate found between the arrays
          showErrorMessage();
          return false; // Prevent form submission
        }
      }
    }

    return true; // Allow form submission
  }

  function showErrorMessage() {
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
      title: 'Please check for duplicate values',
      showConfirmButton: false,
      timer: 3000
    });
  }

  // Date range picker initialization for EDIT modal
  $(document).ready(function() {
    // Initialize DateRangePicker for EDIT modal - ALL DATES ALLOWED
    $('#edit_scholarship_date_range').daterangepicker({
      timePicker: true,
      timePicker24Hour: true,
      locale: {
        format: 'YYYY-MM-DD HH:mm:ss',
        cancelLabel: 'Clear'
      },
      autoUpdateInput: false
    });

    // Update the input when dates are selected
    $('#edit_scholarship_date_range').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(
        picker.startDate.format('YYYY-MM-DD HH:mm:ss') + ' - ' + 
        picker.endDate.format('YYYY-MM-DD HH:mm:ss')
      );
    });

    // Clear date when clear button is clicked
    $('#edit_scholarship_date_range').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });
  });

  // Function to load scholarship data into the modal
  function loadScholarshipData(scholarshipId, scholarshipType, amount, description, startDate, endDate, requirements = []) {
    // Populate basic fields
    $('#edit_scholarship_id').val(scholarshipId);
    $('#edit_scholarship_type').val(scholarshipType);
    $('#edit_amount').val(amount);
    $('#edit_description').val(description);
    
    // Set current date range
    var currentDateRange = startDate + ' - ' + endDate;
    $('#edit_scholarship_date_range').val(currentDateRange);
    
    // Reinitialize date picker with current dates
    $('#edit_scholarship_date_range').daterangepicker({
      timePicker: true,
      timePicker24Hour: true,
      startDate: startDate,
      endDate: endDate,
      locale: {
        format: 'YYYY-MM-DD HH:mm:ss',
        cancelLabel: 'Clear'
      },
      autoUpdateInput: true
    });
    
    // Load existing requirements
    $('#edit_requirement').empty();
    if (requirements.length > 0) {
      requirements.forEach(function(req) {
        var requirementHtml = `
          <div class="form-group" id="edit_id">
            <div class="row">
              <div class="col-md-10 col-sm-10 col-xs-10">
                <input type="text" name="requirement_name[]" class="form-control" value="${req}" readonly>
              </div>
              <div class="col-md-2 col-sm-2 col-xs-2">
                <button type="button" class="btn btn-danger" onclick="removeParent(this)"><i class="fas fa-trash"></i></button>
              </div>
            </div>
          </div>
        `;
        $('#edit_requirement').append(requirementHtml);
      });
    }
    
    // Open modal
    $('#editScholarship').modal('show');
  }

  // Example function to simulate opening the modal with data
  function openEditModalExample() {
    // Example data - replace with actual data from your database
    var scholarshipId = 1;
    var scholarshipType = "Academic Excellence";
    var amount = "$5,000";
    var description = "This scholarship is for students with outstanding academic achievements.";
    var startDate = "2024-01-01 00:00:00";
    var endDate = "2024-12-31 23:59:59";
    var requirements = ["GPA 3.5 or higher", "Letter of recommendation", "Essay submission"];
    
    loadScholarshipData(
      scholarshipId, 
      scholarshipType, 
      amount, 
      description, 
      startDate, 
      endDate, 
      requirements
    );
  }
</script>