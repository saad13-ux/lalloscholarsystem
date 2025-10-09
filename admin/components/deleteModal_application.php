<!-- Delete Scholarship Modal -->
<div class="modal fade" id="deleteApplication" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 align="left">Delete Application</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="actions/action.delete-application.php" method="POST">
                <div class="modal-body">
                    <b>Are you sure you want to delete this Application?</b>
                </div>
                <input type="hidden" name="application_id" id="delete_application_id">
                <input type="hidden" name="indigency_file" id="indigency_file">
                <input type="hidden" name="coe_file" id="coe_file">
                <input type="hidden" name="cog_file" id="cog_file">
                <input type="hidden" name="id_pic_file" id="id_pic_file">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" name="delete_application"><i class='fa fa-check' aria-hidden='true'></i> Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class='fa fa-times' aria-hidden='true'></i> No</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->