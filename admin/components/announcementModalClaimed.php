<!-- claimed modal -->
<div class="modal fade" id="ClaimedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Allowance Claimed</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="actions/action.announce-claimed.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="application_id" id="edit_application_id"  readonly>
            <input type="text" class="form-control" name="scholarship_type" id="edit_scholarship_type" readonly>
            <input type="hidden" class="form-control" name="name" id="name" readonly>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class='fa fa-times' aria-hidden='true'></i> Cancel</button>
                    <button type="submit" name="claimed" class="btn btn-primary"><i class='fa fa-check' aria-hidden='true'></i> Claimed</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function claim(application_id, scholarship_type, beneficiary_name,) {
        $("#edit_application_id").val(application_id);
        $("#edit_scholarship_type").val(scholarship_type);
        $("#name").val(beneficiary_name);
    }
</script>