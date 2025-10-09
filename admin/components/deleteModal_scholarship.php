<!-- Delete Scholarship Modal -->
<div class="modal fade" id="deleteScholarship" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 align="left">Delete Scholarship</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="actions/action.delete-scholarship.php" method="POST">
                <div class="modal-body">
                    <b>Are you sure you want to delete this Scholarship?</b>
                </div>
                <input type="hidden" name="scholarship_id" id="delete_scholarship_id">
                <input type="hidden" name="image_filename" id="image_filename">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" name="delete_scholarship"><i class='fa fa-check' aria-hidden='true'></i> Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class='fa fa-times' aria-hidden='true'></i> No</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->