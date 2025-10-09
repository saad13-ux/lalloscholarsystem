<?php
    class Admin{
        public int $admin_id;
        public string $username;
        public string $password;
        public string $email;
        public string $first_name;
        public string $last_name;
        public string $middle_name;
        public string $password_reset_code;
        public DateTime $password_reset_valid;
        public DateTime $dt_updated;
        public DateTime $dt_created;
    }

?>