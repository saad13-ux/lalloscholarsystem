<!-- View Modal Feedback -->
<div class="modal fade" id="replyFeedback" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b id="subject"></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="actions/action.send-reply.php" method="POST">
                <div class="card-body">
                     <div class="form-group">
                            <label for="name">Name</label>
                                <input required readonly type="text" id="username" class="form-control" name="username" >
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                    <input required readonly type="text" id="mail" class="form-control" name="email" >
                             </div>
                            <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input required type="text" class="form-control" name="subject" name="subject"placeholder="What is this about...">
                                </div>
                            <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea required type="text" class="form-control" name="body" rows="5" name="body" placeholder="Tell us what you think..."></textarea>
                            </div>
                        </div>
                        <input required readonly type="hidden" class="form-control" name="feedback_id" id="replyfeedback_id" >          
                            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class='fa fa-times' aria-hidden='true'></i> Cancel</button>
                 <button type="submit" class="btn btn-primary" name="send_feedback"><i class='fa fa-paper-plane' aria-hidden='true'></i> Send Feedback</button>
                </form>
            </div>
        </div>
    </div>
</div>