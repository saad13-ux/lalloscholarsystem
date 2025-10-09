<?php
require '../includes/pdo_conn.php';
require '../includes/user_query_set.php';
require '../includes/functions.php';
require '../includes/session_variables.php';

if (isset($_POST['complete_registration'])) {
    $required_fields = [
        'first_name',
        'last_name',
        'gender',
        'dob',
        'address',
        'mobile_no',
        'civil_status',
        'nationality',
        'highest_education',
        'religion',
    ];
    $optional_fields = ['skill_occupation', 'ext_name','middle_name'];

    $has_empty_required = hasEmptyFields($_POST, $required_fields);
    if ($has_empty_required) {
        $_SESSION['error'] = $has_empty_required . ' is required.';
        header('Location: ../complete_registration.php');
        return;
    }

    $birthdate = $_POST['dob'];
    $today = new DateTime();
    $diff = $today->diff(new DateTime($birthdate));
    $age = $diff->y;

    if ($age < 16) {
        $_SESSION['error'] = "You must be 16 years or older to complete the registration.";
        header('Location: ../complete_registration.php');
        return;
    }

    if (empty($_FILES['image']['name'])) {
        $_SESSION['error'] = "Please select an image.";
        return;
    }

    // unique filename
    $image_filename = time() . '_' . basename($_FILES['image']['name']);
    $image_target_dir = "../resources/profile/" . $image_filename;
    $tmp = $_FILES['image']['tmp_name'];

    $params = allowOnly($_POST, array_merge($required_fields, $optional_fields));
    $params = array_merge($params, ['image_filename' => $image_filename, 'image_mime_type' => $_FILES['image']['type']]);
    $params['registration_complete'] = 1;
    $update_user_profile_sql = createUpdateSql('user', $params, 'user_id');
    $params['user_id'] = $_SESSION[$session_user_id];
    try {
        $pdo->beginTransaction();
        $update_query = $pdo->prepare($update_user_profile_sql);
        if ($update_query->execute($params) && $update_query->rowCount() == 1) {
            move_uploaded_file($tmp, $image_target_dir);
            // Success
            $_SESSION['success'] = "Registration completed!";
            unset($_SESSION['error']);
            // Assign new values to session
            foreach ($params as $key => $value) {
                $_SESSION[$session_prefix . $key] = $value;
            }

            // insert new notification
            $notif_params = array('message' => 'New registration from ' . $_SESSION[$session_prefix . 'email'] . '!');
            $insert_notif_sql = "INSERT INTO `admin_notification`(`type`, `message`) VALUES(2, :message);";
            $insert_notif_qry = $pdo->prepare($insert_notif_sql);
            $insert_notif_qry->execute($notif_params);

            $pdo->commit();
            header('Location: ../dashboard.php');
            return;
        } else {
            $_SESSION['error'] = "Error updating user profile, please try again.";
            header('Location: ../complete_registration.php');
            return;
        }
    } catch (\PDOException $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollback();
        }
        $_SESSION['error'] = $e->getMessage();
        header('Location: ../complete_registration.php');
        return;
    }
}
