<!-- update_status.php -->
<?php
// Replace these credentials with your database details
require '../../includes/pdo_conn.php';
require '../includes/session_variables.php';
require '../../includes/functions.php';

header('location: ../account.php');


    $userId = $_GET["userId"];
    $blocked = $_GET["blocked"];

        if($blocked==0){
            $status_blocked = "enable";
        }else{
             $status_blocked = "disable";
        }   

     // Set the timezone to Philippines
     date_default_timezone_set('Asia/Manila');
    
     $currentDateTime = new DateTime();
     $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
    try {


        // Prepare and execute the SQL query to update the user status
        $stmt = $pdo->prepare("UPDATE user SET blocked = :blocked WHERE user_id = :userId");
        $stmt->bindParam(':blocked', $blocked, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $account_username = $_GET["username"];
        $username =  $_SESSION[$session_username]; // Assuming username is stored in the session
        $activity_log = "$username change the status $status_blocked with the named $account_username";
        $log_params = ['activity' => $activity_log, 'timestamp' => $formattedDateTime];
        $log_sql = createInsertSql('activity_logs', $log_params);
        $log_query = $pdo->prepare($log_sql);
        $log_query->execute($log_params);


        $_SESSION['success'] = "1 account successfully blocked!";
        return;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Something went wrong, please try again.";
        return;
    }