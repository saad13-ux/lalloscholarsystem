<?php
$login_user_query = "SELECT * FROM user WHERE username=:username";
$set_user_email_vcode = 'UPDATE user SET email_vcode=:email_vcode WHERE user_id=:user_id';
$search_user_id_query = 'SELECT * FROM user WHERE user_id=:user_id';
$search_user_email_query = 'SELECT * FROM user WHERE email=:email';
$set_user_reset_code_query = 'UPDATE user SET password_reset_code=:password_reset_code, password_reset_valid=:password_reset_valid WHERE user_id=:user_id';
$check_reset_password_code_query = 'SELECT * FROM user where password_reset_code=:code AND NOW() < password_reset_valid';


$update_user_password_query = 'UPDATE user SET password=:password, password_reset_code=NULL, password_reset_valid=NULL WHERE user_id=:id';
