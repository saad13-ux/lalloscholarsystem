<div class="modal fade" id="viewApplication" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Manage Application</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="actions/action.handle-application.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="application_id" id="application_id">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="date_applied">Date Applied</label>
                            <input type="text" class="form-control" name="date_applied" id="date_applied" readonly>
                        </div>
                
                        <div class="col-md-4 mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="beneficiary_name" id="beneficiary_name" readonly>
                        </div>
                    
                        <div class="col-md-4 mb-3">
                            <label for="gender">Sex</label>
                            <input type="text" class="form-control" name="gender" id="gender" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Date of Birth</label>
                            <input type="text" class="form-control" name="dob" id="dob" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Monthly Income</label>
                            <input type="number" class="form-control" name="b_monthly_income" id="b_monthly_income" readonly></input>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Type of Scholarship</label>
                            <input type="text" class="form-control" name="scholarship_type" id="scholarship_type" readonly></input>
                        </div>
                         </div>
                        <div class="form-row">
                        <div class=" col-md-4 mb-3">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" name="amount" id="amount" readonly></input>
                        </div>
                    
                        <div class="col-md-4 mb-3">
                            <label for="pob">Place of Birth</label>
                            <input class="form-control" name="pob" id="pob" readonly>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="mobile_no">Mobile Number</label>
                            <input class="form-control" name="mobile_no" id="mobile_no" readonly>
                        </div>
                        </div>
                        <div class="form-row">
                             <div class="col-md-4 mb-3">
                            <label>Nationality</label>
                            <input type="text" class="form-control" name="nationality" id="nationality" readonly></input>
                            </div>
                            <div class="col-md-4 mb-3">
                            <label>Civil Status</label>
                            <input type="text" class="form-control" name="civil_status" id="civil_status" readonly></input>
                            </div>
                            <div class="col-md-4 mb-3">
                            <label>Religion</label>
                            <input type="text" class="form-control" name="religion" id="religion" readonly></input>
                            </div>
                        </div>
                        <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Barangay</label>
                            <input type="text" class="form-control" name="barangay" id="barangay" readonly></input>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Municipality</label>
                            <input type="text" class="form-control" name="municipality" id="municipality" readonly></input>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Province</label>
                            <input type="text" class="form-control" name="province" id="province" readonly></input>
                        </div>
                        <div class="form-group col-md-4">
                            <label>School Name</label>
                            <input type="text" class="form-control" name="school_name" id="school_name" readonly></input>
                        </div>
                        <div class="form-group col-md-4">
                            <label>School Year</label>
                            <input type="text" class="form-control" name="school_year" id="school_year" readonly></input>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Year Level</label>
                            <input type="text" class="form-control" name="year_level" id="year_level" readonly></input>
                        </div>
    
                        <div class="form-group col-md-4">
                            <label>Semester</label>
                            <input type="text" class="form-control" name="semester" id="semester" readonly></input>
                        </div>
                    </div>
                    
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3>Family Background</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="family_table" class="table table-bordered table-hover"></table>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3>Files</h3>
                            <h4>please click the name to view</h4>
                        </div>
                        <!-- /.card-header -->
                        
                        <div class="card-body">
                            <table id="links" class="table table-bordered table-hover"></table>  
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mr-2" name="approve_application"><i class='fa fa-thumbs-up' aria-hidden='true'></i> Approved</button>
                        <button type="submit" class="btn btn-warning mr-2" name="ongoing_application"><i class='fa fa-spinner' aria-hidden='true'></i> Pending</button>
                        <button type="submit" class="btn btn-danger" name="decline_application"><i class='fa fa-thumbs-down' aria-hidden='true'></i> Declined</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->

<script>
    function getApplication(
        application_id,
        date_applied,
        beneficiary_name,
        gender,
        dob,
        pob,
        b_monthly_income,
        scholarship_type,
        amount,
        barangay,
        municipality,
        province,
        school_name,
        school_year,
        year_level,
        semester,
        mobile_no,
        religion,
        nationality,
        b_civil_status
    ) {
        // Set the values of form elements using their IDs
        $('#application_id').val(application_id);
        $('#date_applied').val(date_applied);
        $('#beneficiary_name').val(beneficiary_name);
        $('#gender').val(gender);
        $('#dob').val(dob);
        $('#pob').val(pob);
        $('#mobile_no').val(mobile_no);
        $('#nationality').val(nationality);
        $('#civil_status').val(b_civil_status);
        $('#religion').val(religion);
        $('#b_monthly_income').val(b_monthly_income);
        $('#scholarship_type').val(scholarship_type);
        $('#amount').val(amount);
        $('#barangay').val(barangay);
        $('#municipality').val(municipality);
        $('#province').val(province);
        $('#school_name').val(school_name);
        $('#school_year').val(school_year);
        $('#year_level').val(year_level);
        $('#semester').val(semester);

        $("#family_table").load("components/viewModal_application_family.php", {
            application_id: application_id
        });

        // Load content from "viewModal_application_links.php" and insert it into an element with ID "links"
        $.ajax({
            url: "components/viewModal_application_links.php",
            type: "POST",
            data: { application_id: application_id },
            success: function(response) {
                $("#links").html(response);
            }
        });
    }
</script>
   <tbody class="table-body"> 
                    <td colspan="16" style="font-size: 15px;"><label>IV. Assesstment </label></td>
                </tbody>
                <tbody class="table-body">
                    <td colspan="6" style="font-size: 12px; border-bottom: 1px solid white;"><span>1. </span><label>Problem Presented</label></td>
                    <td colspan="3" style="font-size: 12px; border-bottom: 1px solid white; border-right: 1px solid white"><span>2. </span><label>Social Worker Assestment</label></td>
                    <td colspan="7" style="font-size: 12px; border-bottom: 1px solid white;"><span>3. </span><label>Client Category (check only one)</label></td>
                </tbody>
                <tbody class="table-body">
                    <td colspan="6" style="font-size: 12px; border-bottom: 1px solid white;"><span> </span><label></label></td>
                    <td colspan="3" style="font-size: 12px; border-bottom: 1px solid white; border-right: 1px solid white"><span></span><label></label></td>
                    <td colspan="7" style="font-size: 12px; border-bottom: 1px solid white;"><span><input type="checkbox" name=""></span><label>Children Need of Special Portection</label></td>
                </tbody>
                 <tbody class="table-body">
                    <td colspan="6" style="font-size: 12px; border-bottom: 1px solid white;"><span></span><label></label></td>
                    <td colspan="3" style="font-size: 12px; border-bottom: 1px solid white; border-right: 1px solid white"><span> </span><label></label></td>
                    <td colspan="7" style="font-size: 12px; border-bottom: 1px solid white;"><span><input type="checkbox" name=""></span><label> Youth in Need of Special Protection</label></td>
                </tbody>
                 <tbody class="table-body">
                    <td colspan="6" style="font-size: 12px; border-bottom: 1px solid white;"><span></span><label></label></td>
                    <td colspan="3" style="font-size: 12px; border-bottom: 1px solid white; border-right: 1px solid white"><span></span><label></label></td>
                    <td colspan="7" style="font-size: 12px; border-bottom: 1px solid white;"><span><input type="checkbox" name=""></span><label> Woman in Escpecially Difficult Circumstances</label></td></td>
                </tbody>
                <tbody class="table-body">
                    <td colspan="6" style="font-size: 12px; border-bottom: 1px solid white;"><span></span><label></label></td>
                    <td colspan="3" style="font-size: 12px; border-bottom: 1px solid white; border-right: 1px solid white"><span></span><label></label></td>
                    <td colspan="7" style="font-size: 12px; border-bottom: 1px solid white;"><span><input type="checkbox" name=""></span><label> Person With Disability</label></td>
                </tbody>
                <tbody class="table-body">
                    <td colspan="6" style="font-size: 12px; border-bottom: 1px solid white;"><span></span><label></label></td>
                    <td colspan="3" style="font-size: 12px; border-bottom: 1px solid white; border-right: 1px solid white"><span></span><label></label></td>
                    <td colspan="7" style="font-size: 12px; border-bottom: 1px solid white;"><span><input type="checkbox" name=""></span><label> Senior Citezen</label></td>
                </tbody>
                <tbody class="table-body">
                    <td colspan="6" style="font-size: 12px; border-bottom: 1px solid white;"><span></span><label></label></td>
                    <td colspan="3" style="font-size: 12px; border-bottom: 1px solid white; border-right: 1px solid white"><span></span><label></label></td>
                    <td colspan="7" style="font-size: 12px; border-bottom: 1px solid white;"><span><input type="checkbox" name=""> </span><label>Family Needs & Other Needy Adult</label></td>
                </tbody>
                 <tbody class="table-body">
                    <td colspan="6" style="font-size: 12px; border-bottom: 1px solid white;"><span> </span><label></label></td>
                    <td colspan="3" style="font-size: 12px; border-bottom: 1px solid white; border-right: 1px solid white; "><span></span><label></label></td>
                    <td colspan="7" style="font-size: 12px; border-bottom: 1px solid white; "><span>4. </span><label>Client Sub Category</label></td>
                </tbody>
                <tbody class="table-body">
                    <td colspan="6" style="font-size: 12px; "><span> </span><label></label></td>
                    <td colspan="3" style="font-size: 12px; border-right: 1px solid white; "><span></span><label></label></td>
                    <td colspan="7" style="font-size: 12px; "><span style=" border-bottom:1px solid black;">____________________________________________</span></td>
                </tbody>
                <tbody class="table-body"> 
                    <td colspan="16" style="font-size: 15px;"><label>IV. Recommended Service and Assistance </label></td>
                </tbody>
                <tbody class="table-body"> 
                    <td colspan="16" style="font-size: 12px;"><label>1. Nature of Service/Assistance</label></td>
                </tbody>
                <tbody class="table-body"> 
                    <td colspan="1" style="font-size: 12px;  border-right: 1px solid white;"><label><span><input type="checkbox" name=""> </span><label>Counselling</label></label></td>
                    <td colspan="6" style="font-size: 12px;  border-right: 1px solid white;"><label><span><input type="checkbox" name=""> </span><label>Legal Assistance(Retainer/Other)</label></label></td>
                    <td colspan="2" style="font-size: 12px;  border-right: 1px solid white;"><label><span><input type="checkbox" name=""> </span><label>Referral</label></label></td>
                    <td colspan="7" style="font-size: 12px;  border-right: 1px solid white; "><label>(Specify)</label><span style="border-bottom:1px solid black;">________________________________</span></td>

                </tbody>
                 <tbody class="table-body">
                    
                </tbody>
