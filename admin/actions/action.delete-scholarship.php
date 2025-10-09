
<?php

require '../../includes/pdo_conn.php';
require '../includes/admin_query_set.php';
require '../../includes/functions.php';

header("Location: ../scholarships.php");

if (isset($_POST['delete_scholarship'])) {
    $scholarship_id = $_POST['scholarship_id'];
    $image_filename = $_POST['image_filename'];
    $params = array('scholarship_id' => $scholarship_id);
    $query = $pdo->prepare($delete_scholarship_admin_query);
    $res = $query->execute($params);

    if ($res && $query->rowCount() == 1) {
        if (file_exists("../../resources/images/" . $image_filename)) {
            unlink("../../resources/images/" . $image_filename);
        }
        // Successfully delete record
        $_SESSION['success'] = "Record Deleted Successfully";
        exit();
    }
    $_SESSION['error'] = "Deleted Record Failed";
    exit();
}
