<?php
// ← ADD THESE LINES AT THE TOP
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

require '../../includes/pdo_conn.php';
require '../includes/admin_query_set.php';
require '../includes/session_variables.php';
require '../../includes/functions.php';

// ← ADD THIS DEBUG CODE after the if(isset($_POST['application_id'])) line
if (isset($_POST['application_id'])) {
    $app_id = $_POST['application_id'];
    
    // DEBUG: Log what we're processing
    error_log("=== DEBUG VIEW MODAL ===");
    error_log("Received application_id: " . $app_id);
    
    $params = allowOnly($_POST, ['application_id']);
    $qry = $pdo->prepare("SELECT * FROM requirement_files WHERE application_id=:application_id");
    $qry->execute($params);
    
    // DEBUG: Log how many files found
    $rowCount = $qry->rowCount();
    error_log("Found $rowCount files for application_id: $app_id");
    
    $counter = 1;
    $hasFiles = false;
    
    while ($row = $qry->fetch(PDO::FETCH_ASSOC)) {
        // DEBUG: Log each file
        error_log("FILE $counter: " . $row['file_name'] . " => " . $row['file_file']);
        
        $hasFiles = true;
        $fileUrl = "../resources/files/" . $row['file_file'];
        $documentType = $row['file_name']; // This is the document type/description
        $actualFileName = $row['file_file']; // This is the actual stored filename
        $fileType = pathinfo($row['file_file'], PATHINFO_EXTENSION);
        
        // Get appropriate file icon
        $fileIcon = getFileIcon($fileType);
?>
        <tr>
            <td class="text-center"><?= $counter ?></td>
            <td>
                <strong><?= htmlspecialchars($documentType) ?></strong>
            </td>
            <td>
                <a href="#" class="file-link text-primary font-weight-bold" 
                   data-file="<?= htmlspecialchars($fileUrl) ?>" 
                   data-name="<?= htmlspecialchars($documentType) ?>"
                   data-type="<?= strtoupper($fileType) ?>">
                    <i class="<?= $fileIcon ?> mr-2"></i>
                    <?= htmlspecialchars($actualFileName) ?>
                </a>
            </td>
            <td class="text-center">
                <span class="badge badge-info badge-file-type">
                    <?= strtoupper($fileType) ?>
                </span>
            </td>
            <td class="text-center">
                <a href="<?= htmlspecialchars($fileUrl) ?>" 
                   class="btn btn-sm btn-outline-primary" 
                   download 
                   title="Download File">
                    <i class="fas fa-download"></i>
                </a>
            </td>
        </tr>
<?php
        $counter++;
    }
    
    // If no files found
    if (!$hasFiles) {
        echo '<tr><td colspan="5" class="text-center text-muted">No files uploaded for this application</td></tr>';
    }
} else {
    echo '<tr><td colspan="5" class="text-center text-danger">No application ID provided</td></tr>';
}

function getFileIcon($fileType) {
    $fileType = strtolower($fileType);
    switch ($fileType) {
        case 'pdf':
            return 'fas fa-file-pdf text-danger';
        case 'doc':
        case 'docx':
            return 'fas fa-file-word text-primary';
        case 'xls':
        case 'xlsx':
            return 'fas fa-file-excel text-success';
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
            return 'fas fa-file-image text-warning';
        case 'txt':
            return 'fas fa-file-alt text-secondary';
        default:
            return 'fas fa-file text-secondary';
    }
}
?>