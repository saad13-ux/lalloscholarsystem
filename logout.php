<?php
require 'includes/pdo_conn.php';
require 'includes/user_query_set.php';
require 'includes/session_variables.php';
require 'includes/functions.php';

            $sql = "UPDATE user SET active = :active WHERE user_id = :user_id";
            $params = array(':active' => 0, ':user_id' => $_SESSION[$session_user_id]);
            $query = $pdo->prepare($sql);
            $query->execute($params);
            
                session_start();
                session_destroy();
                header('location: index.php');
                
             