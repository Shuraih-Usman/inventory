<?php
require_once __DIR__.'/config/init.php';

unset($_SESSION['user_id']);
unset($_SESSION['username']);
session_destroy();
Redirect('/login.php');
