<?php
$login_admin_query = 'SELECT * FROM admin WHERE username=:username';
$set_admin_reset_code_query = 'UPDATE admin SET password_reset_code=:password_reset_code, password_reset_valid=:password_reset_valid WHERE admin_id=:id';
$search_admin_email_query = 'SELECT * FROM admin WHERE email=:email';
$check_reset_password_code_query = 'SELECT * FROM admin where password_reset_code=:code AND NOW() < password_reset_valid';
$update_admin_password_query = 'UPDATE admin SET password=:password, password_reset_code=NULL, password_reset_valid=NULL WHERE admin_id=:id';
$search_admin_id_query = 'SELECT * FROM admin WHERE admin_id=:id';
$delete_scholarship_admin_query = 'DELETE FROM scholarship WHERE scholarship_id=:scholarship_id';
$delete_application_admin_query= 'DELETE FROM user_application WHERE application_id=:application_id';
$delete_feedback_admin_query= 'DELETE FROM feedback WHERE feedback_id=:feedback_id';
$delete_user_admin_query= 'DELETE FROM user WHERE user_id=:user_id';