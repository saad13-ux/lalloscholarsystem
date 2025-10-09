<!-- View Modal Feedback -->
<div class="modal fade" id="ReadFeedback" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b id="subject"></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b id="body"></b></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class='fa fa-times' aria-hidden='true'></i> Cancel</button>
                <form action="actions/actions.feedback.php" method="post">
                    <input type="hidden" name="feedback_id" id="feedback_id">
                    <input type="hidden" name="mail_read" id="email">
                    <button type="submit" class="btn btn-primary" name="mark_read"><i class='fa fa-check' aria-hidden='true'></i> Mark as Read</button>
                </form>
            </div>
        </div>
    </div>
</div>