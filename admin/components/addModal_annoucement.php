<link rel="stylesheet" type="text/css" href="../dist/css/modal_scholarship.css">

<!-- Add Scholarship Modal -->
<div class="modal fade" id="addAnnoucement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 align="left">Add Scholarship Payroll</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="#" method="POST" enctype="multipart/form-data">

        <div class="modal-body">
        <div class="form-group"  id="add-person">
        <div class="row">
            <div class="col col-sm-12 col-md-6">
                <div class="form-label">Fist Name</div>
                <input class="form-control" type="text" name="" placeholder="Please Enter">
            </div>
            <div class="col col-sm-12 col-md-6">
                <div class="form-label">Middle Initial</div>
                <input  class="form-control" type="text" name="" placeholder="Please Enter">
            </div>
        </div>
        <div class="row">
            <div class="col col-sm-12 col-md-6">
                <div class="form-label">Last Name</div>
                <input  class="form-control" type="text" name="" placeholder="Please Enter">
            </div>
            <div class="col col-sm-12 col-md-6">
                <div class="form-label">Address</div>
                <input class="form-control" type="text" name="" placeholder="Please Enter">
            </div>
        </div>
        <div class="row">
              <div class="col col-sm-12 col-md-6">
                <div class="form-label">Type of Scholarship</div>
                <input class="form-control" type="text" name="" placeholder="Please Enter">
            </div>
            <div class="col col-sm-12 col-md-6">
                <div class="form-label">Amount</div>
                <input class="form-control" type="text" name="" placeholder="Please Enter">
            </div>
        </div>
        <div class="row">
            <div class="col col-sm-12 col-md-6">
                <div class="form-label">Place to Claim</div>
                <input class="form-control" type="text" name="" placeholder="Please Enter">
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end">
          <button type="button" class="btn btn-success" id="add_person"><i class="fas fa-plus"></i></button>
    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-times-circle' aria-hidden='true'></i> Close</button>
          <button type="submit" class="btn btn-primary" name="add_scholarship"><i class='fa fa-check' aria-hidden='true'></i> Add</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    function addNewFields() {
        $.get("components/additional-person-compostion-fields.php", function(data) {
            $("#additional-person").append(data);
        });
    }
    $("#add_person").on("click", () => addNewFields());

    function removeParent(element) {
        $(element).parent().parent().remove();
    }
</script>
