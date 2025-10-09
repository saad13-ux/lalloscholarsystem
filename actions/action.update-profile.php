<?php
require '../includes/pdo_conn.php';
require '../includes/user_query_set.php';
require '../includes/functions.php';
require '../includes/session_variables.php';

header('location: ../dashboard.php');
if (isset($_POST['update_profile'])) {
  

    $required_fields = [
    'username',
    'email',
    'first_name',
    'last_name',
    'gender',
    'dob',
    'mobile_no',
    'civil_status',
    'nationality',
    'highest_education',
    'religion',
];
$optional_fields = ['skill_occupation', 'ext_name', 'middle_name', 'address'];


    $has_empty_required = hasEmptyFields($_POST, $required_fields);
    if ($has_empty_required) {
        $_SESSION['error'] = $has_empty_required . ' is required.';
        return;
    }

    $params = allowOnly($_POST, array_merge($required_fields, $optional_fields));

    // check if there is a new uploaded image
    if (!empty($_FILES['image']['name'])) {
        // unique filename
        $image_filename = time() . '_' . basename($_FILES['image']['name']);
        $image_target_dir = "../resources/profile/" . $image_filename;
        $tmp = $_FILES['image']['tmp_name'];

        // Remove existing image file
        $user_id = $_SESSION[$session_user_id];
        $stmt = $pdo->prepare("SELECT image_filename FROM user WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $existing_img_filename = $row->image_filename;
        
        if (!empty($existing_img_filename) && file_exists("../resources/profile/" . $existing_img_filename)) {
            unlink("../resources/profile/" . $existing_img_filename);
        }

        // Update image file information in params
        $params['image_filename'] = $image_filename;
        $params['image_mime_type'] = $_FILES['image']['type'];

        // Move uploaded file to the target directory
        move_uploaded_file($tmp, $image_target_dir);
    }

    $update_user_profile_sql = createUpdateSql('user', $params, 'user_id');
    $params['user_id'] = $_SESSION[$session_user_id];
    
    try {
        $pdo->beginTransaction();
        $update_query = $pdo->prepare($update_user_profile_sql);
        if ($update_query->execute($params) && $update_query->rowCount() == 1) {
            // Success
            $_SESSION['success'] = "Profile has been updated!";
            unset($_SESSION['error']);

            // Assign new values to session
            foreach ($params as $key => $value) {
                $_SESSION[$session_prefix . $key] = $value;
            }

            $pdo->commit();
            header('location: ../dashboard.php');
            return;
        } else {
            $_SESSION['error'] = "Error updating user profile, please try again.";
            return;
        }
    } catch (\PDOException $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollback();
        }
        $_SESSION['error'] = $e->getMessage();
        return;
    }
}
