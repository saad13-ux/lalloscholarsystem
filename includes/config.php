<?php
// Detect base URL dynamically
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$folder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); // remove trailing slash

define('BASE_URL', $protocol . "://" . $host . $folder . "/"); // always ends with slash


