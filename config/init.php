<?php
session_start();
define("APP_NAME", "U&U RIMI GLOBAL VENTURE & CLASSY COSMETICS SUPPLY");
define('NUMBER', '08039821801, 08082325070, 09031481541');
define("ADDRESS", "Opposite G.D.S.S Rimi, Rimi Local Govt, Katsina State.");
define('APP_URL', '');
$root = realpath(__DIR__ . '/../');
$template = $root."/Template";
$assets = "/assets/";
require_once $root.'/vendor/autoload.php';
require_once $root.'/config/function.php';

$db = new MysqliDb(array(
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'db' => 'rimicosmetics',
    'port' => '3306',
    'prefix' => '',
    'charset' => 'utf8'
));
try {
    $pdo = new PDO("mysql:host=localhost;dbname=rimicosmetics", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if(!isset($_SESSION['user_id']) AND !isset($_SESSION['username'])) {
    Redirect('/login.php');
    exit();
} else {
    $admin = $db->where('id', $_SESSION['user_id'])->getOne('user');
}



