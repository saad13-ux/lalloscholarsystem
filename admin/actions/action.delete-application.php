
<?php

require '../../includes/pdo_conn.php';
require '../includes/admin_query_set.php';
require '../../includes/functions.php';

header("Location: ../application.php");

if (isset($_POST['delete_application'])) {
    $application_id = $_POST['application_id'];
    $indigency_file = $_POST['indigency_file'];
    $coe_file = $_POST['coe_file'];
    $cog_file = $_POST['cog_file'];
    $id_pic_file = $_POST['id_pic_file'];
    $params = array('application_id' => $application_id);
    $query = $pdo->prepare($delete_application_admin_query);
    $res = $query->execute($params);

    if ($res && $query->rowCount() == 1) {
        if(file_exists("../../resources/files/".$indigency_file)&&file_exists("../../resources/files/".$coe_file)&&file_exists("../../resources/files/".$cog_file)&&file_exists("../../resources/files/".$id_pic_file)){
            unlink("../../resources/files/".$indigency_file);
            unlink("../../resources/files/".$coe_file);
            unlink("../../resources/files/".$cog_file);
            unlink("../../resources/files/".$id_pic_file);
        }
        // Successfully delete record
        $_SESSION['success'] = "Record Deleted Successfully";
        exit();
    }
    $_SESSION['error'] = "Deleted Record Failed";
    exit();
}
