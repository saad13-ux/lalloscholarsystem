

<?php
require '../includes/pdo_conn.php';
require '../includes/session_variables.php';
require '../includes/functions.php';

if (isset($_GET['scholarship_id'])) {
    $scholarship_id = $_GET['scholarship_id'];
?>
    <input type="hidden" name="type" value="old">
    <h4>Name</h4>
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="application_id">Name</label>
            <select required id="select_application_id" name="application_id" class="form-control" onchange="getOldInformation(this)">
                <option value="" disabled selected>--SELECT--</option>
                <?php
                $old_query = $pdo->query("SELECT application_id, concat(b_fname, ' ', b_lname) as b_name FROM user_application WHERE user_id='" . $_SESSION[$session_user_id] . "' AND scholarship_id='" . $scholarship_id . "' GROUP BY b_name;");
                while ($row = $old_query->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <option value="<?= $row['application_id'] ?>"><?= $row['b_name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-12 col-md-4 mb-3">
            <label for="schoolname">School Name</label>
            <input required type="text" class="form-control" name="school_name" id="school_name">
        </div>
        <div class="col-sm-12 col-md-4 mb-3">
            <label for="yearlevel">School Year</label>
            <input required type="text" class="form-control" name="school_year" id="school_year">
        </div>

        <div class="col-sm-12 col-md-4 mb-3">
            <label for="yearlevel">Year Level</label>
            <input required type="text" class="form-control" name="year_level" id="year_level">
        </div>

        <div class="col-sm-12 col-md-4 mb-3">
            <label for="semester">Semester</label>
            <select  class="form-control" name="semester" id="semester" required>
                    <option value="" disabled selected>-- SELECT --</option>
                    <option value="1st">1st</option>
                    <option value="2nd">2nd</option>
                    <option value="3rd">3rd</option>
        </select> 
        </div>
    </div>
    <h4>Updated Documents</h4>
    <div class="form-row">
        <div class="col-sm-12 col-md-4 mb-3">
            <label for="indigency">Brgy. Indigency</label>
            <input required type="file" class="form-control" name="file_indigency" id="file_indigency" accept=".doc,.docx,.pdf,.jpg,.jpeg,.png">
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

    <div id="applicant_information">

    </div>
<?php }

