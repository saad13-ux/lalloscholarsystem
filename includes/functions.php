<?php
function getPassedTime($datetime_mysql)
{
    // Convert the datetime to a DateTime object
    $datetime_object = new DateTime($datetime_mysql, new DateTimeZone('Asia/Manila'));

    // Get the current date and time
    $current_datetime = new DateTime("now", new DateTimeZone('Asia/Manila'));

    // Calculate the difference between the two dates
    $difference = date_diff($datetime_object, $current_datetime);

    // Calculate the number of seconds, minutes, hours, days, months, and years that have passed
    $seconds = $difference->s + $difference->i * 60 + $difference->h * 3600 + $difference->d * 86400 + $difference->m * 2592000 + $difference->y * 31536000;
    $minutes = floor($seconds / 60);
    $hours = floor($seconds / 3600);
    $days = floor($seconds / 86400);
    $months = floor($seconds / 2592000);
    $years = floor($seconds / 31536000);
    if ($years > 0) {
        return $years . " years.";
    } else if ($months > 0) {
        return $months . " months.";
    } else if ($days > 0) {
        return $days . " days.";
    } else if ($hours > 0) {
        return $hours . " hours.";
    } else if ($minutes > 0) {
        return $minutes . " minutes.";
    } else if ($seconds > 0) {
        return $seconds . " seconds.";
    }
}
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function generateRandomCode($length = 6)
{
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomCode = '';
    for ($i = 0; $i < $length; $i++) {
        $randomCode .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomCode;
}

function hasEmptyFields(array $arr, array $must_not_be_empty)
{
    foreach ($must_not_be_empty as $key) {
        if ($arr[$key] == '' || empty($arr[$key])) {
            $field =  str_replace('_', ' ', $key);
            return ucwords($field);
        }
    }
    return false;
}

function allowOnly(array $arr, array $allowed)
{
    $result = array();
    foreach ($allowed as $key) {
        $result[$key] = $arr[$key] ?? '';
    }
    return $result;
}

function arrayAllowOnly(array $arr, array $allowed, $index)
{
    $result = array();
    foreach ($allowed as $key) {
        $result[$key] = $arr[$key][$index] ?? '';
    }
    return $result;
}

function dd($data)
{
    echo "<pre>";
    die(var_dump($data));
    echo "</pre>";
}

function createInsertSql(string $table, array $parameters)
{
    return sprintf(
        'INSERT INTO %s (%s) VALUES(%s)',
        $table,
        implode(', ', array_keys($parameters)),
        ':' . implode(', :', array_keys($parameters))
    );
}


function createUpdateSql(string $table, array $parameters, string $primary_key_column)
{
    $sql = "UPDATE $table SET ";
    $i = 0;
    foreach (array_keys($parameters) as $param) {
        if ($i > 0) $sql .= ', ';
        $sql .= "$param=:$param ";
        $i += 1;
    }
    $sql .= "WHERE $primary_key_column=:$primary_key_column;";
    return $sql;
}
