<!-- View Modal Feedback -->
<div class="modal fade" id="AnnounceModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b id="subject"></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="actions/action.announce-scholar.php" method="post">
                <input type="hidden" name="application_id" id="application_id">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label>Scholarship Type</label>
                            <input type="text" class="form-control" name="scholarship_type" id="scholarship_type" readonly>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label>Name</label>
                            <input type="text" class="form-control" name="beneficiary_name" id="beneficiary_name" readonly>
                        </div>
                    </div>

                    <div class="form-row ">
                        <div class="form-group col-sm-12">
                            <label>Barangay</label>
                            <textarea class="form-control" name="barangay" id="barangay" readonly></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label>Amount</label>
                            <input type="number" class="form-control" name="amount" id="amount" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label>Claim Date</label>
                            <input type="date" class="form-control" name="claim_date" id="claim_date">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class='fa fa-times' aria-hidden='true'></i> Cancel</button>
                    <button type="submit" class="btn btn-primary" name="announce-scholar"><i class='fa fa-check' aria-hidden='true'></i> Post Announcement</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const claim_date = document.getElementById("claim_date");
    claim_date.min = new Date().toISOString().split("T")[0];

    function announceScholar(app_id, scholarship_type, beneficiary_name, barangay, amount) {
        $("#application_id").val(app_id);
        $("#scholarship_type").val(scholarship_type);
        $("#beneficiary_name").val(beneficiary_name);
        $("#barangay").val(barangay);
        $("#amount").val(amount);
    }

</script>