<input type="hidden" name="type" value="old">
<h4>Personal Information</h4>
<hr>

<div class="form-row">
    <div class="col-md-6 mb-3">
        <label for="first_name">First name</label>
        <input type="text" class="form-control" id="first_name" name="b_fname" placeholder="First name" value="<?php echo $_SESSION[$session_fname];?>" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="middle_name">Middle name</label>
        <input type="text" class="form-control" id="middle_name" name="b_mname" placeholder="Middle name" value="<?php echo $_SESSION[$session_mname];?>">
    </div>
</div>
<div class="form-row">
    <div class="col-md-6 mb-3">
        <label for="last_name">Last name</label>
        <input type="text" class="form-control" id="last_name" name="b_lname" placeholder="Last name" value="<?php echo $_SESSION[$session_lname];?>"required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="gender">Extension Name</label>
         <select id="ext_name" name="b_ext_name" class="form-control">
                    <option value="" disabled selected>Suffix</option>
                    <option value="Jr." <?= $_SESSION[$session_prefix . 'ext_name'] == 'Jr.' ? 'selected' : '' ?>>Jr.</option>
                    <option value="Sr." <?= $_SESSION[$session_prefix . 'ext_name'] == 'Sr.' ? 'selected' : '' ?>>Sr.</option>
                    <option value="II" <?= $_SESSION[$session_prefix . 'ext_name'] == 'II.' ? 'selected' : '' ?>>II</option>
                    <option value="III" <?= $_SESSION[$session_prefix . 'ext_name'] == 'III.' ? 'selected' : '' ?>>III</option>
        </select>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6 mb-3">
        <label for="gender">Sex</label>
        <select name="b_gender" id="gender" class="form-control">
                    <option value="" disabled selected>-- SELECT --</option>
                    <option value="Male" <?= $_SESSION[$session_prefix . 'gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= $_SESSION[$session_prefix . 'gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
        </select> 
    </div>
    <div class="col-md-6 mb-3">
        <label for="dob">Date of Birth</label>
        <input class="form-control" type="date" id="dob" name="b_dob" value="<?= $_SESSION[$session_prefix . 'dob'] ?? '' ?>">
    </div>
</div>
<div class="form-row">
    <div class="col-md-6 mb-3">
        <label for="b_pob">Place of birth</label>
        <input type="text" class="form-control" id="b_pob" name="b_pob" placeholder="Place of birth" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="b_monthly_income">Family Monthly Income</label>
        <input type="text" class="form-control" id="b_monthly_income" name="b_monthly_income" placeholder="Monthly Income" required>
    </div>
</div>
<div class="form-row">
    <div class="col-md-12 mb-3">
        <label for="b_monthly_income">Address</label>
    </div>
    <div class="col-md-3 mb-2">
        <input type="type" class="form-control" id="zipcode" name="zipcode" placeholder="Zip Code" required></input>
    </div>
    <div class="col-md-3 mb-2">
        <select class="form-control" id="barangay" name="barangay" placeholder="Barangay">
            <option></option>
        </select>
    </div>
    <div class="col-md-3 mb-2">
        <select type="type" class="form-control" id="municipality" name="municipality" placeholder="Municipality">
            <option></option>
        </select>
    </div>
    <div class="col-md-3 mb-2">
        <select type="type" class="form-control" id="province" name="province" placeholder="Province">
            <option></option>
        </select>
    </div>
    <div class="col-md-3 mb-2">
        <select type="type" class="form-control" id="region" name="region" placeholder="Region">
            <option></option>
        </select>
    </div>

</div>
<div class="form-row">
    <div class="col-sm-12 col-md-4 mb-3">
        <label for="schoolname">School Name</label>
        <input required type="text" class="form-control" name="school_name" id="school_name" placeholder="School Name">
    </div>
    <div class="col-sm-12 col-md-4 mb-3">
        <label for="yearlevel">School Year</label>
        <input required type="text" class="form-control" name="school_year" id="school_year" placeholder="School Year">
    </div>

    <div class="col-sm-12 col-md-4 mb-3">
        <label for="yearlevel">Year Level</label>
        <input required type="text" class="form-control" name="year_level" id="year_level" placeholder="Year Level">
    </div>

    <div class="col-sm-12 col-md-4 mb-3">
        <label for="semester">Semester</label>
        <select  class="form-control" name="semester" id="semester" required="">
                    <option value="" disabled selected>-- SELECT --</option>
                    <option value="1st">1st</option>
                    <option value="2nd">2nd</option>
                    <option value="3rd">3rd</option>
        </select> 
    </div>
</div>
<hr>
<h4>General Requirement</h4>
<hr>
<div class="form-row">
    <div class="col-sm-12 col-md-4 mb-3">
        <label for="indigency">Brgy. Indigency</label>
        <input required type="file" class="form-control" name="file_indigency" id="file_indigency" accept=".doc,.docx,.pdf,.jpg,.jpeg,.png" >
    </div>
    <div class="col-sm-12 col-md-4 mb-3">
        <label for="file_cog">Certification of Grades</label>
        <input required type="file" class="form-control" name="file_cog" id="file_cog" accept=".doc,.docx,.pdf,.jpg,.jpeg,.png">
    </div>
    <div class="col-sm-12 col-md-4 mb-3">
        <label for="file_cog">Certification of Enrollment</label>
        <input required type="file" class="form-control" name="file_coe" id="file_coe" accept=".doc,.docx,.pdf,.jpg,.jpeg,.png">
    </div>
    <div class="col-sm-12 col-md-4 mb-3">
        <label for="indigency">School ID</label>
        <input class="form-control" type="file" id="img_id_pic" name="img_id_pic" accept=".jpg,.jpeg,.png" required>
    </div>

</div>
<hr>
<h4>Additional Requirement</h4>
<hr>
<div class="form-row" id="additional_requirements">

</div>
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
                <select class="form-control" name="civil_status[]" id="civil_status">
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
    <button type="button" class="btn btn-success" id="add_family_member"><i class="fas fa-plus"></i>ADD</button>
</div>
</div>