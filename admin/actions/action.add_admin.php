<?php
require '../../includes/pdo_conn.php';
require '../includes/session_variables.php';
require '../../includes/functions.php';

header('location: ../admin_account.php');
if (isset($_POST['add_admin'])) {

      // Set the timezone to Philippines
      date_default_timezone_set('Asia/Manila');
    

    $check_empty = hasEmptyFields($_POST, ['username', 'email', 'first_name', 'middle_name', 'last_name']);
    if ($check_empty) {
        $_SESSION['error'] = $check_empty . ' must not be empty.';
        return;
    }

    // Check if username or email already exist
    $existingUser = false;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $existingUserQuery = $pdo->prepare("SELECT COUNT(*) AS count FROM admin WHERE username = :username OR email = :email");
    $existingUserQuery->bindParam(':username', $username);
    $existingUserQuery->bindParam(':email', $email);
    $existingUserQuery->execute();
    $result = $existingUserQuery->fetch(PDO::FETCH_ASSOC);
    if ($result['count'] > 0) {
        $existingUser = true;
        $_SESSION['error'] = "Username or email already exists.";
        return;
    }

    // unique filename
    $image_filename = time() . '_' . basename($_FILES['image']['name']);
    $image_target_dir = "../../resources/admin_profile/" . $image_filename;
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, $image_target_dir);
    $image_mime_type = $_FILES['image']['type'];
   

    $params = allowOnly($_POST, ['username', 'email', 'first_name', 'middle_name', 'last_name']);
    $params = array_merge($params, ['image_filename' => $image_filename, 'image_mime_type' => $_FILES['image']['type'], 'dt_created' => date('Y-m-d')]);
   
    // Generate hashed password
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $params['password'] = $hashedPassword;

    $sql = createInsertSql('admin', $params);
    $query = $pdo->prepare($sql);

    if ($query->execute($params)) {
        move_uploaded_file($tmp, $image_target_dir);

        $name = $_POST['username'];
        $username =  $_SESSION[$session_username]; // Assuming username is stored in the session
        $activity_log = "$username added new account with the named $name";
        $log_params = ['activity' => $activity_log, 'timestamp' => date('Y-m-d H:i:s')];
        $log_sql = createInsertSql('activity_logs', $log_params);
        $log_query = $pdo->prepare($log_sql);
        $log_query->execute($log_params);

        $_SESSION['success'] = "1 record successfully added!";
        return;
    } else {
        $_SESSION['error'] = "Something went wrong, please try again.";
        return;
    }
}
?>
