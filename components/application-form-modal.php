<link rel="stylesheet" type="text/css" href="dist/css/modal_scholarship.css">
<!-- Modal -->
<div class="modal fade" id="ApplicationFormModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Application Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <style>
        input.form-check-input {
            width: 20px;
            height: 20px;
        }
        .form-check{
            text-align: center;
            padding: 10px;
            margin: 10px;
            font-size: 20px;
            font-weight: 20px;
            word-spacing: 5px;
        }
    </style>

            <form action="actions/action.apply-scholarship.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="scholarship_id" id="scholarship_id">
                <div class="modal-body">
            <div class="form-row justify-content-center d-flex">
                   <div class="form-check">

                        <div class="col-md-12 col-sm-12 col-lg-12 mb-3">
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" name="type" value="new" id="new_checkbox">

                        <label class="form-check-label" for="new_checkbox">
                            NEW APPLICANT
                        </label>
                        <br><br>
                            
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" name="type" value="old" id="old_checkbox">

                        <label class="form-check-label" for="old_checkbox">
                            OLD APPLICANT
                        </label>
                        </div>
                    </div>
                </div>
                    
                    <div id="form">
                        <div class="form-row">
                                <div class="col-md-6 mb-3">
                                        <label for="first_name">Scholarship type</label>
                                            <input type="text" class="form-control" id="scholarship_type" disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                        <label for="middle_name">Amount</label>
                                            <input type="text" class="form-control" id="amount" disabled>
                                </div>             
                        </div>
                        <hr>
                        <h4>Personal Information</h4>
                        <hr>
                        <div class="form-row">
                                <div class="col-md-6 mb-3">
                                        <label for="first_name">First name</label>
                                            <input type="text" required class="form-control" id="first_name" name="b_fname" placeholder="First name" value="<?php echo isset($_SESSION['first_name']) ? $_SESSION['first_name'] : ''; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                        <label for="middle_name">Middle name</label>
                                            <input type="text" class="form-control" id="middle_name" name="b_mname" placeholder="Middle name" value="<?php echo isset($_SESSION['middle_name']) ? $_SESSION['middle_name'] : ''; ?>">
                                </div>
                        </div>
                        <div class="form-row">
                                <div class="col-md-6 mb-3">
                                            <label for="last_name">Last name</label>
                                                <input type="text" required class="form-control" id="last_name" name="b_lname" placeholder="Last name" value="<?php echo isset($_SESSION['last_name']) ? $_SESSION['last_name'] : ''; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="b_ext_name">Extension Name</label>
                                        <select id="ext_name" name="b_ext_name" class="form-control">
                                            <option value="" disabled selected>Suffix</option>
                                            <option value="Jr." <?= isset($_SESSION['ext_name']) && $_SESSION['ext_name'] == 'Jr.' ? 'selected' : '' ?>>Jr.</option>
                                            <option value="Sr." <?= isset($_SESSION['ext_name']) && $_SESSION['ext_name'] == 'Sr.' ? 'selected' : '' ?>>Sr.</option>
                                            <option value="II" <?= isset($_SESSION['ext_name']) && $_SESSION['ext_name'] == 'II' ? 'selected' : '' ?>>II</option>
                                            <option value="III" <?= isset($_SESSION['ext_name']) && $_SESSION['ext_name'] == 'III' ? 'selected' : '' ?>>III</option>
                                        </select>
                                </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="b_gender">Sex</label>
                                        <select id="b_gender" required name="b_gender" class="form-control">
                                            <option value="" disabled selected>-- SELECT --</option>
                                            <option value="Male" <?= isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                            <option value="Female" <?= isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                    </select>
                            </div>
                            <div class="col-md-6 mb-3">
                            <label for="dob">Date of Birth</label>
                                <input class="form-control" required type="date" id="dob" name="b_dob" value="<?= isset($_SESSION['dob']) ? $_SESSION['dob'] : '' ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                            <label for="b_pob">Place of Birth</label>
                                <input class="form-control" required type="text" id="b_pob" name="b_pob" placeholder="Place of Birth" value="<?= isset($_SESSION['pob']) ? $_SESSION['pob'] : '' ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="b_monthly_income">Family Monthly Income</label>
                                    <input type="text" required class="form-control" id="b_monthly_income" name="b_monthly_income" placeholder="Family Monthly Income" value="<?= isset($_SESSION['monthly_income']) ? $_SESSION['monthly_income'] : '' ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                            <label for="mobile_number">Mobile Number</label>
                                <input class="form-control" required type="text" id="mobile_number" name="mobile_number" value="<?= isset($_SESSION['mobile_no']) ? $_SESSION['mobile_no'] : '' ?>" placeholder="Mobile Number">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="religion">Religion</label>
                                    <input type="text" required class="form-control" value="<?= isset($_SESSION['religion']) ? $_SESSION['religion'] : '' ?>" id="religion" name="religion" placeholder="Religion">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                            <label for="nationality">Nationality</label>
                                <input class="form-control" required type="text" id="nationality" name="nationality" value="<?= isset($_SESSION['nationality']) ? $_SESSION['nationality'] : '' ?>" placeholder="Nationality">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="civil_status">Civil Status</label>
                                    <select id="civil_status" required name="civil_status" class="form-control">
                                             <option selected disabled value="">-- SELECT --</option>
                                            <option value="Single" <?= isset($_SESSION['civil_status']) && $_SESSION['civil_status'] == 'Single' ? 'selected' : '' ?>>Single</option>
                                            <option value="Married" <?= isset($_SESSION['civil_status']) && $_SESSION['civil_status'] == 'Married' ? 'selected' : '' ?>>Married</option>
                                            <option value="Annulled" <?= isset($_SESSION['civil_status']) && $_SESSION['civil_status'] == 'Annulled' ? 'selected' : '' ?>>Annulled</option>
                                            <option value="Divorced" <?= isset($_SESSION['civil_status']) && $_SESSION['civil_status'] == 'Divorced' ? 'selected' : '' ?>>Divorced</option>
                                            <option value="Widowed" <?= isset($_SESSION['civil_status']) && $_SESSION['civil_status'] == 'Widowed' ? 'selected' : '' ?>>Widowed</option>
                                        </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="zipcode">Zip Code</label>
                                    <input type="text" required class="form-control" id="zipcode" name="zipcode" placeholder="Zip Code" value="<?= isset($_SESSION['address']) ? $_SESSION['address'] : '' ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="barangay">Barangay</label>
                                <select class="form-control" required id="barangay" name="barangay" placeholder="Barangay">
                                    <option value="<?= isset($_SESSION['barangay']) ? $_SESSION['barangay'] : '' ?>" selected><?= isset($_SESSION['barangay']) ? $_SESSION['barangay'] : '' ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                            <label for="municipality">Municipality</label>
                            <select type="type" class="form-control" required id="municipality" name="municipality" placeholder="Municipality">
                                <option value="<?= isset($_SESSION['municipality']) ? $_SESSION['municipality'] : '' ?>" selected><?= isset($_SESSION['municipality']) ? $_SESSION['municipality'] : '' ?></option>
                            </select>
                            </div>
                            <div class="col-md-6 mb-3">
                            <label for="province">Province</label>
                            <select type="type" class="form-control" required id="province" name="province" placeholder="Province">
                                <option value="<?= isset($_SESSION['province']) ? $_SESSION['province'] : '' ?>" selected><?= isset($_SESSION['province']) ? $_SESSION['province'] : '' ?></option>
                            </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                            <label for="region">Region</label>
                            <select type="type" class="form-control" required id="region" name="region" placeholder="Region">
                                <option value="<?= isset($_SESSION['region']) ? $_SESSION['region'] : '' ?>" selected><?= isset($_SESSION['region']) ? $_SESSION['region'] : '' ?></option>
                            </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="schoolname">School Name</label>
                                <input type="text" class="form-control" required name="school_name" id="school_name" value="<?= isset($_SESSION['school_name']) ? $_SESSION['school_name'] : '' ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="school_year">School Year</label>
                                <input type="text" class="form-control" required name="school_year" id="school_year" value="<?= isset($_SESSION['school_year']) ? $_SESSION['school_year'] : '' ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="yearlevel">Year Level</label>
                                <select class="form-control" name="year_level" required id="year_level">
                                            <option value="" disabled selected>-- SELECT --</option>
                                            <option value="1st" <?= isset($_SESSION['year_level']) && $_SESSION['year_level'] == '1st' ? 'selected' : '' ?>>1st</option>
                                            <option value="2nd" <?= isset($_SESSION['year_level']) && $_SESSION['year_level'] == '2nd' ? 'selected' : '' ?>>2nd</option>
                                            <option value="3rd" <?= isset($_SESSION['year_level']) && $_SESSION['year_level'] == '3rd' ? 'selected' : '' ?>>3rd</option>
                                            <option value="4th" <?= isset($_SESSION['year_level']) && $_SESSION['year_level'] == '4th' ? 'selected' : '' ?>>4th</option>
                                            <option value="5th" <?= isset($_SESSION['year_level']) && $_SESSION['year_level'] == '5th' ? 'selected' : '' ?>>5th</option>
                                            <option value="6th" <?= isset($_SESSION['year_level']) && $_SESSION['year_level'] == '6th' ? 'selected' : '' ?>>6th</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="semester">Semester</label>
                                <select class="form-control" name="semester" required id="semester">
                                            <option value="" disabled selected>-- SELECT --</option>
                                            <option value="1st" <?= isset($_SESSION['semester']) && $_SESSION['semester'] == '1st' ? 'selected' : '' ?>>1st</option>
                                            <option value="2nd" <?= isset($_SESSION['semester']) && $_SESSION['semester'] == '2nd' ? 'selected' : '' ?>>2nd</option>
                                            <option value="3rd" <?= isset($_SESSION['semester']) && $_SESSION['semester'] == '3rd' ? 'selected' : '' ?>>3rd</option>
                                </select> 
                            </div>
                        </div>
                       
                        <div class="form-row" id="additional_requirements">
                            
                        </div>
                        
                        
                        <style type="text/css">
                            input[type=file]::file-selector-button {
                                margin-right: 20px;
                                border: none;
                                background: #084cdf;
                                padding: 1px;
                                border-radius: 10px;
                                color: #fff;
                                cursor: pointer;
                                transition: background .2s ease-in-out;
                            }

                            input[type=file]::file-selector-button:hover {
                                background: #0d45a5;
                            }
                        </style>
                        <hr>
                        <h4>Family Background</h4>
                        <hr>
                        <div id="family-composition">
                            <div class="family_composition_group">
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="family_first_name">First name</label>
                                        <input type="text" class="form-control" id="family_first_name" name="first_name[]" placeholder="First name">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="family_middle_name">Middle name</label>
                                        <input type="text" class="form-control" id="family_middle_name" name="middle_name[]" placeholder="Middle name">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="family_last_name">Last name</label>
                                        <input type="text" class="form-control" id="family_last_name" name="last_name[]" placeholder="Last name">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="family_relationship">Relationship</label>
                                        <input type="text" class="form-control" id="family_relationship" name="relationship[]" placeholder="Relationship">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="family_gender">Sex</label>
                                        <select class="form-control" name="gender[]" id="family_gender">
                                            <option value="" selected disabled>--SELECT--</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="family_dob">Date of Birth</label>
                                        <input type="date" class="form-control" id="family_dob" name="dob[]">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="family_civil_status">Civil Status</label>
                                        <select class="form-control" name="civil_status[]" id="family_civil_status">
                                            <option value="" selected disabled>--SELECT--</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Divorced">Divorced</option>
                                            <option value="Widowed">Widowed</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="family_hea">Highest Educational Attainment</label>
                                        <input type="text" class="form-control" id="family_hea" name="highest_education[]" placeholder="Highest Educational Attainment">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="family_skill_occupation">Skill/Occupation</label>
                                        <input type="text" class="form-control" id="family_skill_occupation" name="skill_occupation[]" placeholder="Skill/Occupation">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="family_monthly_income">Est. Monthly Income</label>
                                        <input type="number" class="form-control" id="family_monthly_income" name="est_monthly_income[]" placeholder="Estimate Monthly Income">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-success" id="add_family_member"><i class="fas fa-plus"></i> ADD</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="apply_scholarship">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $("#form").hide();
    $(".btn-primary").hide();
    
    // Handle checkbox change event
    $("#new_checkbox, #old_checkbox").change(function() {
        var isNewApplicantChecked = $("#new_checkbox").is(":checked");
        var isOldApplicantChecked = $("#old_checkbox").is(":checked");

        if (isNewApplicantChecked) {
            // Hide the "Old Applicant Form" and show the "New Applicant Form"
            $("#form").show();
            $("#old_checkbox").prop("checked", false);
            $(".btn-primary").show();
        } else if (isOldApplicantChecked) {
            // Hide the "New Applicant Form" and show the "Old Applicant Form"
            $("#form").show();
            $("#new_checkbox").prop("checked", false);
            $(".btn-primary").show();
        }
        
        // Hide the question and checkboxes when one is selected
        if (isNewApplicantChecked || isOldApplicantChecked) {
            $(".form-check").hide();
        } else {
            $(".form-check").show();
        }
    });
});

function applyScholarship(scholarship_id, scholarship_type, amount) {
    $("#scholarship_id").val(scholarship_id)
    $("#scholarship_type").val(scholarship_type)
    $("#amount").val(amount)

    $("#additional_requirements").load("components/View_Additional_Requirements.php", {
        scholarship_id: scholarship_id
    });
}

function addNewFields() {
    $.get("components/additional-family-composition-fields.php", function(data) {
        $("#family-composition").append(data);
    });
}

$("#add_family_member").on("click", () => addNewFields());

function removeParent(element) {
    $(element).parent().parent().remove();
}
</script>

<!-- Rest of your JavaScript code remains the same -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#zipcode').on('keyup', function() {
            var zipcode = $(this).val();
            $.ajax({
                method: "POST",
                url: "ajax.php",
                data: "zipp=" + zipcode,
                success: function(html) {
                    $('#barangay').html(html);
                }
            });
        });
    });

    $(document).ready(function() {
        $('#zipcode').on('keyup', function() {
            var zipcode = $(this).val();
            $.ajax({
                method: "POST",
                url: "ajax.php",
                data: "zip=" + zipcode,
                success: function(html) {
                    $('#municipality').html(html);
                }
            });
        });
    });

    $(document).ready(function() {
        $('#zipcode').on('keyup', function() {
            var zipcode = $(this).val();
            $.ajax({
                method: "POST",
                url: "ajax.php",
                data: "zip1=" + zipcode,
                success: function(html) {
                    $('#province').html(html);
                }
            });
        });
    });

    $(document).ready(function() {
        $('#zipcode').on('keyup', function() {
            var zipcode = $(this).val();
            $.ajax({
                method: "POST",
                url: "ajax.php",
                data: "zip2=" + zipcode,
                success: function(html) {
                    $('#region').html(html);
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#region').change(function() {
            loadProvince($(this).find(':selected').val())
        })
        $('#province').change(function() {
            loadMunicipality($(this).find(':selected').val())
        })
        $('#municipality').change(function() {
            loadBarangay($(this).find(':selected').val())
        })
    });

    function loadRegion() {
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: "get=region"
        }).done(function(result) {
            $(result).each(function() {
                $("#region").append($(result));
            })
        });
    }

    function loadProvince(regionId) {
        $("#province").children().remove()
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: "get=province&regionId=" + regionId
        }).done(function(result) {
            $("#province").append($(result));
        });
    }

    function loadMunicipality(provinceId) {
        $("#municipality").children().remove()
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: "get=municipality&provinceId=" + provinceId
        }).done(function(result) {
            $("#municipality").append($(result));
        });
    }

    function loadBarangay(municipalityId) {
        $("#barangay").children().remove()
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: "get=barangay&municipalityId=" + municipalityId
        }).done(function(result) {
            $("#barangay").append($(result));
        });
    }

    loadRegion();
</script>

<script type="text/javascript">
    $("#img_id_pic").change(function(event) {
        var x = URL.createObjectURL(event.target.files[0]);
        $("#upload-img").attr("src", x);
        console.log(event);
    });
</script>