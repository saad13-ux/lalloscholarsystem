<?php
// Detect the application root dynamically
$current_path = $_SERVER['PHP_SELF'];
$root_path = '/lalloscholarsystem'; // Default, adjust based on your URL structure

// If the current path contains the application folder, extract it
if (strpos($current_path, '/lalloscholarsystem/') !== false) {
    $parts = explode('/lalloscholarsystem/', $current_path);
    $root_path = '/lalloscholarsystem';
}

$logo_url = $root_path . "/resources/images/lgulallo.png";
?>
<style type="text/css">
    #pds-table {
    width: 100%;
    max-width: 18in;
    margin: 0 auto;
    border: 2px solid #000;
}
#pds-table td:not(.separator) {
    font-size: 10px;
    border-color: #000;
    height: 20px; /* For Visual Purposes */
}
#pds-table tbody {
    border: 1px solid #000;
}
#pds-table tbody:not(.table-header) td {
    border: 1px solid #000;
}
#pds-table .separator {
    font-size: 12px;
    font-style: italic;
    font-weight: 600;
    background-color:white;
    border-top-width: 2px !important;
    border-bottom-width: 2px !important;
}
#pds-table td.s-label {
    background-color: #dddddd;
    width: 20%;
}
#pds-table td .count {
    display: inline-block;
    width: 1.32em;
    text-align: center;
}
.table-body.question-block td {
    font-size: 13px !important;
}
.table-body.question-block tr td:first-child {
    border-bottom-width: 0px !important;
    border-top-width: 0px !important;
}
.table-body.question-block tr td:not(:first-child) {
    border-width: 0px !important;
}
.table-body.question-block tr td:nth-child(2) {
    padding-left: 15px;
}
@media print {

}






</style>
<?php

$id = isset($_GET['scholarship_id']) ? $_GET['scholarship_id'] : '';
$date_applied = isset($_GET['date_applied']) ? $_GET['date_applied'] : '';
$amount = isset($_GET['amount']) ? $_GET['amount'] : '';
$description = isset($_GET['description']) ? $_GET['description'] : '';

?>

<div class="modal fade" id="viewApplication" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Manage Application</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="application-form" action="actions/action.handle-application.php" method="post">

                <div class="modal-body">

                    
                    <button type="button" class="btn btn-primary" id="print-btn">
                        <i class="fas fa-print mr-1" aria-hidden="true"></i> PRINT
                        </button>

                    <br>
                    <br>
                    <input type="hidden" name="application_id" id="application_id">

                    <input type="hidden" name="scholarship_type" id="scholarship_type">
                    <table id="pds-table">

                <tbody class="table-header">
                    
                    <tr>
                        <td width="1" class="no-bottom-border"><img src="../resources/images/lgulallo.png" height="60" width="70"></td>
                        <td colspan="5" class="no-bottom-border"><p style="font-size:10px;"><b>Republic of the Philippines<br>LOCAL GOVERNMENT UNIT OF LAL-LO <br></b></p>
                        </td>

                        
                        <td colspan="5" class="no-bottom-border" style="font-style: bold; font-size: 35px"><label>General In Take Sheet<label></td>

                        
                        <td colspan="7" style="border:1px solid#000b;width:8%;font-size: 15px;"><label>Date: <label> <label for="date_applied"></label></td>
                        
                    </tr>
                </tbody>
                <tbody class="table-body">
                    <tr>
                        <td colspan="16" style="font-size: 20px;"><label>I.Client's Identifying Information</label></td>
                    </tr>
                </tbody>
                <tbody class="table-body">
                        <tr>
                        <td colspan="1" style="font-size: 15px;" >
                            <span >1.</span> <label>Client's Name</label>
                        </td>
                        <td colspan="10"  style="font-size: 15px;"><label for="beneficiary_name"></label></td>
                        <td colspan="1"  style="font-size: 15px;">
                            <span >2.</span><label>Sex</label> 
                        </td>
                        <td colspan="4"  style="font-size: 15px;"><label for="gender"></label></td>
                    </tr>
                </tbody>
                <tbody class="table-body">
                        <tr>
                        <td colspan="1" style="font-size: 15px;">
                            <span >3.</span> <label>Date of Birth</label> 
                        </td>
                        <td colspan="7" style="font-size: 15px;"><label for="dob"></label></td>
                        <td colspan="1" style="font-size: 15px;">
                            <span >4.</span> <label>Present Address</label>
                        </td>
                        <td colspan="7" style="font-size: 15px;"><label for="barangay"></label>, <label for="municipality">, <label for="province"></label></td>
                    </tr>
                </tbody>
                <tbody class="table-body">
                        <tr>
                        <td colspan="1"  style="font-size: 15px;">
                            <span >5.</span> <label>Civil Status</label>
                        </td>
                        <td colspan="3" style="font-size: 15px;"><label for="b_civil_status"></label></td>
                        <td colspan="1"  style="font-size: 15px;">
                            <span >6.</span> <label>Religion</label>
                        </td>
                        <td colspan="4" style="font-size: 15px;"><label for="religion"></label></td>
                        <td colspan="2"  style="font-size: 15px;">
                            <span >7.</span> <label>Nationality</label>
                        </td>
                        <td colspan="4" style="font-size: 15px;"><label for="nationality"></label></td>
                    </tr>
                </tbody>
                <tbody class="table-body">
                        <tr>
                        <td colspan="1"  style="font-size: 15px;">
                            <span >8.</span> <label>Highest Educational Attainment</label>
                        </td>
                        <td colspan="5" style="font-size: 15px;"><label for="highest_education"></label></td>
                        <td colspan="1"  style="font-size: 15px;">
                            <span >9.</span> <label>Skill/Occupation</label>
                        </td>
                        <td colspan="4"style="font-size: 15px;"><label for="skill_occupation"></label></td>
                        <td colspan="2"  style="font-size: 15px;">
                            <span >10.</span><label>Estimated Monthly Income</label> 
                        </td>
                        <td colspan="4" style="font-size: 15px;">&#8369; <label for="est"></label></td>
                    </tr>
                </tbody>
                <tbody class="table-body">
                        <tr>
                        <td colspan="1" style="font-size: 15px;">
                            <span >11.</span> <label>Place of Birth</label>
                        </td>
                        <td colspan="4" style="font-size: 15px;"><label for="pob"></label></td>
                        <td colspan="1" style="font-size: 15px;">
                            <span >12.</span> <label>Contact Number</label>
                        </td>
                        <td colspan="3" style="font-size: 15px;"><label for="contact"></label></td>
                        <td colspan="1" style="font-size: 15px;">
                            <span >13.</span> <label>School Name</label>
                        </td>
                        <td colspan="7" style="font-size: 15px;"><label for="school_name"></label></td>
                    </tr>
                </tbody>
                <tbody class="table-body">
                        <tr>
                        <td colspan="1" style="font-size: 15px;">
                            <span >14.</span><label>School Year</label>
                        </td>
                        <td colspan="5" style="font-size: 15px;"><label for="school_year"></label></td>
                        <td colspan="1" style="font-size: 15px;">
                            <span >15.</span> <label>Year Level</label>
                        </td>
                        <td colspan="3" style="font-size: 15px;"><label for="year_level"></label></td>
                        <td colspan="1" style="font-size: 15px;">
                            <span >16.</span> <label>Semester</label>
                        </td>
                        <td colspan="5" style="font-size: 15px;"><label for="semester"></label></td>
                    </tr>
                </tbody>
                <tbody class="table-body">
                        <tr>
                        <td colspan="1" style="font-size: 15px;">
                            <span >17.</span><label>Schlorship Type</label>
                        </td>
                        <td colspan="8" style="font-size: 15px;"><label for="scholarship_type"></label></td>
                        <td colspan="1" style="font-size: 15px;">
                            <span >18.</span> <label>Amount</label>
                        </td>
                        <td colspan="8" style="font-size: 15px;">&#8369; <label for="amount"></label></td>
                    </tr>
                </tbody>
                </tbody>
                <tbody class="table-body">
                    <td colspan="16" style="font-size: 20px;"><label>II. Benificiary Identifying Information</label></td>
                </tbody>
                <tbody class="table-body">
                        <tr>
                        <td colspan="1" style="font-size: 15px;" >
                            <span >1.</span> <label>Benificiary Name</label>
                        </td>
                        <td colspan="8"  style="font-size: 15px;"><label for="beneficiary_name"></label></td>
                        <td colspan="1"  style="font-size: 15px;">
                            <span >2.</span><label>Sex</label> 
                        </td>
                        <td colspan="6"  style="font-size: 15px;"><label for="gender"></label></td>
                    </tr>
                </tbody>
                <tbody class="table-body">
                        <tr>
                        <td colspan="1" style="font-size: 15px;">
                            <span >3.</span> <label>Date of Birth</label> 
                        </td>
                        <td colspan="4" style="font-size: 15px;"><label for="dob"></label></td>
                         <td colspan="3" style="font-size: 15px;">
                            <span >4.</span> <label>Place of Birth</label>
                        </td>
                        <td colspan="6" style="font-size: 15px;"><label for="pob"></label></td>
                    </tr>
                <tbody class="table-body">
                    <td colspan="16" style="font-size: 20px;"><label>III. Benificiary's Family Composition </label></td>
                </tbody>
                <tbody class="table-body">
                    <td colspan="1"style="font-size: 15px;"><label>Last Name</label></td>
                    <td colspan="2" style="font-size: 15px;" ><label>First Name</label></td>
                    <td colspan="2" style="font-size: 15px;"><label>Middle Name</label></td>
                    <td style="font-size: 15px;"><label>Sex</label></td>
                    <td style="font-size: 15px;"><label>Birthdate</label></td>
                    <td style="font-size: 15px;"><label>Civil Status</label></td>
                    <td style="font-size: 15px;"><label>Relationship</label></td>
                    <td colspan="2"style=" font-size: 15px;"><label>Highest Educational Attainment</label></td>
                    <td colspan="2" style="font-size: 15px;"><label>Skills/Occupation</label></td>
                    <td collspan="2"style="font-size: 15px;"><label>Est Monthly Income</label></td>
                </tbody>
                <tbody class="table-body"  id="family_table">

                </tbody>
               
            </table>

            <!-- Uploaded Documents Section -->
            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-paperclip mr-2"></i>Uploaded Documents
                    </h4>
                    <p class="mb-0 mt-1" style="font-size: 0.9rem; opacity: 0.9;">
                        Click on any file name to view it
                    </p>
                </div>
                
                <div class="card-body">
                    <!-- Loading State -->
                    <div id="files-loading" class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading files...</span>
                        </div>
                        <p class="mt-2 text-muted">Loading documents...</p>
                    </div>

                    <!-- Files Table -->
                    <div id="files-table-container">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="50px" class="text-center">#</th>
                                        <th>Document Type</th>
                                        <th>File Name</th>
                                        <th width="100px" class="text-center">File Type</th>
                                        <th width="120px" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="files-tbody">
                                    <!-- Files will be loaded here via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- File Preview Section -->
                    <div id="file-preview" class="mt-4 p-3 border rounded" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">
                                <i class="fas fa-file-pdf text-danger mr-2"></i>
                                <span id="preview-title">Document Preview</span>
                            </h5>
                            <button type="button" class="btn btn-secondary btn-sm" id="exit-btn">
                                <i class="fas fa-times mr-1"></i> Close Preview
                            </button>
                        </div>
                        
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe id="preview-frame" class="embed-responsive-item" src="" 
                                    style="border: 1px solid #dee2e6; border-radius: 4px;"></iframe>
                        </div>
                        
                        <div class="mt-3 d-flex justify-content-between align-items-center">
                            <small class="text-muted" id="preview-info">PDF Document</small>
                            <a href="#" id="download-btn" class="btn btn-outline-primary btn-sm" download>
                                <i class="fas fa-download mr-1"></i> Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer flex-column align-items-stretch">

                <!-- Decline Reason -->
                <div id="decline-reason-box" class="form-group w-100 d-none">
                    <label><b>Reason for Decline:</b></label>
                    <textarea name="reason_decline" class="form-control" placeholder="Enter reason..." required></textarea>
                </div>

                <!-- Pending Reason -->
                <div id="pending-reason-box" class="form-group w-100 d-none">
                    <label><b>Reason for Pending:</b></label>
                    <textarea name="reason_pending" class="form-control" placeholder="Enter reason..." required></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-end mt-3 w-100">
                    <button type="submit" class="btn btn-primary mr-2" name="approve_application">
                        <i class='fa fa-thumbs-up'></i> Approve
                    </button>

                    <button type="button" class="btn btn-warning mr-2" id="pending-btn">
                        <i class="fa fa-spinner"></i> Pending
                    </button>

                    <button type="button" class="btn btn-danger" id="decline-btn">
                        <i class="fa fa-thumbs-down"></i> Decline
                    </button>
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
        b_civil_status,
        highest_education,
        skill_occupation
    ) {
        // Set the values of form elements using their IDs
        $('#application_id').val(application_id);
        $("#scholarship_type").val(scholarship_type);
        $("label[for='date_applied']").text(date_applied);
        $("label[for='beneficiary_name']").text(beneficiary_name);
        $("label[for='gender']").text(gender);
        $("label[for='dob']").text(dob);
        $("label[for='pob']").text(pob);
        $("label[for='contact']").text(mobile_no);
        $("label[for='nationality']").text(nationality);
        $("label[for='b_civil_status']").text(b_civil_status);
        $("label[for='religion']").text(religion);
        $("label[for='est']").text(b_monthly_income);
        $("label[for='scholarship_type']").text(scholarship_type);
        $("label[for='amount']").text(amount);
        $("label[for='barangay']").text(barangay);
        $("label[for='municipality']").text(municipality);
        $("label[for='province']").text(province);
        $("label[for='school_name']").text(school_name);
        $("label[for='school_year']").text(school_year);
        $("label[for='year_level']").text(year_level);
        $("label[for='semester']").text(semester);
        $("label[for='highest_education']").text(highest_education);
        $("label[for='skill_occupation']").text(skill_occupation);

        // Reset file preview section
        $("#file-preview").hide();
        $("#files-loading").show();
        $("#files-tbody").empty();

        // Load family composition
        $("#family_table").load("components/viewModal_application_family.php", {
            application_id: application_id
        });

        // Load files with better structure
        $.ajax({
            url: "components/viewModal_application_links.php",
            type: "POST",
            data: { application_id: application_id },
            success: function(response) {
                $("#files-loading").hide();
                
                if (response.trim() === "" || response.includes('No files')) {
                    $("#files-tbody").html('<tr><td colspan="5" class="text-center text-muted">No files uploaded for this application</td></tr>');
                    return;
                }
                
                $("#files-tbody").html(response);
                
                // Add click handlers to file links
                $(".file-link").on("click", function(e) {
                    e.preventDefault();
                    let fileUrl = $(this).data("file");
                    let fileName = $(this).data("name") || "Document";
                    let fileType = $(this).data("type") || "PDF";
                    
                    showFilePreview(fileUrl, fileName, fileType);
                });
            },
            error: function() {
                $("#files-loading").hide();
                $("#files-tbody").html('<tr><td colspan="5" class="text-center text-danger">Error loading documents</td></tr>');
            }
        });
    }

    function showFilePreview(fileUrl, fileName, fileType) {
        // Update preview section
        $("#preview-title").text(fileName);
        $("#preview-info").text(fileType + " Document");
        $("#download-btn").attr("href", fileUrl);
        
        // Show preview and hide file list
        $("#file-preview").show();
        $("#files-table-container").hide();
        
        // Set PDF preview
        $("#preview-frame").attr("src", fileUrl);
        
        // Scroll to preview
        $('html, body').animate({
            scrollTop: $("#file-preview").offset().top - 20
        }, 500);
    }

    // Exit button handler
    $(document).on("click", "#exit-btn", function() {
        // Hide preview and show file list again
        $("#file-preview").hide();
        $("#preview-frame").attr("src", "");
        $("#files-table-container").show();
    });

    // Get the "Print" button element
    const printBtn = document.getElementById('print-btn');

    // Add click event listener to the "Print" button
    printBtn.addEventListener('click', () => {
      // Call the print function
      printContent();
    });

function printContent() {
    const printWindow = window.open('', '_blank');

    let tableContent = document.getElementById('pds-table').outerHTML;

    // Use PHP-generated logo URL
    const logoUrl = '<?= $logo_url ?>';
    
    // Fix logo path
    tableContent = tableContent.replace(
        '../resources/images/lgulallo.png',
        logoUrl
    );

    printWindow.document.write(`
        <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; font-size: 12px; }
                    table { border-collapse: collapse; width: 100%; border: 2px solid #000; margin-bottom: 20px; }
                    th, td { border: 1px solid black; padding: 6px; font-size: 12px; }
                    .table-header th, .table-header td { border: none; }
                    h3, h4 { margin: 10px 0; }
                </style>
            </head>
            <body>
                ${tableContent}
            </body>
        </html>
    `);

    printWindow.document.close();

    printWindow.onload = function () {
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    };
}
    // Handle Approve button click
    $(document).on("click", "button[name='approve_application']", function (e) {
        e.preventDefault(); // stop default submit
        $("#application-form").append('<input type="hidden" name="approve_application" value="1">');
        $("#application-form").submit();
    });

    // Handle Decline button click
    $("#decline-btn").on("click", function () {
        $("#pending-reason-box").addClass("d-none"); 
        $("#decline-reason-box").removeClass("d-none"); 

        let reason = $("textarea[name='reason_decline']").val().trim();
        if (reason !== "") {
            $("#application-form").append('<input type="hidden" name="decline_application" value="1">');
            $("#application-form").submit();
        }
    });

    // Handle Pending button click
    $("#pending-btn").on("click", function () {
        $("#decline-reason-box").addClass("d-none"); 
        $("#pending-reason-box").removeClass("d-none"); 

        let reason = $("textarea[name='reason_pending']").val().trim();
        if (reason !== "") {
            $("#application-form").append('<input type="hidden" name="ongoing_application" value="1">');
            $("#application-form").submit();
        }
    });
</script>