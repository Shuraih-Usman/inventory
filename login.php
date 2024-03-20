<?php
require_once __DIR__.'/config/login_init.php';

if(isset($_SESSION['user_id']) AND isset($_SESSION['username'])) {
    Redirect('/');
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $check = Signin($username, $password);
    if($check['s'] == 1) {
        Redirect("/");
    } else {
        $error = $check['m'];
        echo "<script> window.alert('$error') </script>";
    }
}


require_once $template.'/login.php';

?>
