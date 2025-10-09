<div class="family_composition_group mb-3">
    <hr>
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="family_first_name">First name</label>
            <input required type="text" class="form-control" id="family_first_name" name="first_name[]" placeholder="First name">
        </div>
        <div class="col-md-6 mb-3">
            <label for="family_middle_name">Middle name</label>
            <input type="text" class="form-control" id="family_middle_name" name="middle_name[]" placeholder="Middle name">
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="family_last_name">Last name</label>
            <input required type="text" class="form-control" id="family_last_name" name="last_name[]" placeholder="Last name">
        </div>
        <div class="col-md-6 mb-3">
            <label for="family_relationship">Relationship</label>
            <input required type="text" class="form-control" id="family_relationship" name="relationship[]" placeholder="Relationship">
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="family_gender">Sex</label>
            <select required class="form-control" name="gender[]" id="family_gender">
                <option value="" selected disabled>--SELECT--</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="family_dob">Date of Birth</label>
            <input required type="date" class="form-control" id="family_dob" name="dob[]">
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="family_civil_status">Civil Status</label>
            <select required class="form-control" name="civil_status[]" id="civil_status">
                <option value="" selected disabled>--SELECT--</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
                <option value="Widowed">Widowed</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="family_hea">Highest Educational Attainment</label>
            <input required type="text" class="form-control" id="family_hea" name="highest_education[]" placeholder="Highest Educational Attainment">
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="family_skill_occupation">Skill/Occupation</label>
            <input required type="text" class="form-control" id="family_skill_occupation" name="skill_occupation[]" placeholder="Skill/Occupation">
        </div>
        <div class="col-md-6 mb-3">
            <label for="family_monthly_income">Est. Monthly Income</label>
            <input required type="number" class="form-control" id="family_monthly_income" name="est_monthly_income[]" placeholder="Estimate Monthly Income" maxlength="7">
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-danger mr-1" id="remove_fields" onclick="removeParent(this)"><i class="fa fa-user-times" aria-hidden="true"></i> REMOVE</button>
    </div>
</div>
</div>