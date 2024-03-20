<?php


function Redirect($url) {

    header("location: $url");
}
function Signin($user, $pass) {
    global $db;
    $s = 0;
    $m = "";

    $userData = $db->where('username', $user)->getOne('user');
    if (!$userData) {
        $m = "Invalid Username";
    } elseif (!password_verify($pass, $userData['password'])) {
        $m = "Wrong Password";
    } else {
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['username'] = $userData['username'];
        $s = 1;
    }

    return ['s' => $s, 'm' => $m];
}


function InputArray($str)
{
    if (isset($_REQUEST[$str])) {
        $val = $_REQUEST[$str];
        if (is_array($val)) {
            $sanVal = [];
            foreach ($val as $key => $value) {
                $sanVal[$key] = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
            return $sanVal;
        }
        return filter_var($val, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    return [];
}


function dtOrderby($var = true)
{
    if ($var == true)
        return $_POST['order']['0']['column'];
    else
        return  $_POST['order']['0']['dir'];
}
function dtlimit($var = true)
{
    if ($var == true)
        return $_POST['start'];
    else
        return  $_POST['length'];
}

function checkSize($size) {
    if($size > 500000) {
        return true;
    } else {
        return false;
    }
}

function removeExtension($file) {
    $FileTo = pathinfo($file);

    return $FileTo['filename'];
}

function checkType($name) {
    $file = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    $allowed = ['jpg','png', 'gif', 'jpeg'];
    if(!in_array($file, $allowed)) {
        return true;
    } else {
        return false;
    }
}

function getPart($url, $key) {
    $part = explode('/', $url);

    return isset( $part[$key] ) ? $part[$key] : null;
}
function Input($value) {
    $val =  "";

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $val =  filter_input(INPUT_POST, $value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    } elseif($_SERVER['REQUEST_METHOD'] === 'GET') {
        $val =  filter_input(INPUT_GET, $value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    return $val;
}