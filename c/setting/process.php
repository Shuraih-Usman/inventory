<?php
require_once __DIR__.'/../../config/init.php';
$action = Input('action');
header("Content-Type: application/json");

if($action == 'changepassword') {
    $s = 0;
    $oldp = $_POST['oldp'];
    $newp = $_POST['newp'];
    $confirmp = $_POST['confirmp'];

    if(empty(Input('username'))) {
        $m = "Username cannot be blank";
    } else {
        if(empty($oldp) AND empty($newp) AND empty($confirmp)) {
            if($db->where('id', $admin['id'])->update('user', ['username' => Input('username')])) {
                $s = 1;
                $m = "Successfully change username";
            } else {
                $m = $db->getLastError();
            }
        } else {

            if(empty($newp) || empty($oldp) || empty($confirmp)) {
                $m = "All pasword fields are required";
            } else {
                if(password_verify($oldp, $admin['password'])) {

                    if($newp != $confirmp) {
                        $m = "New and confirm password must match";
                    } else {
                        if($db->where('id', $admin['id'])->update('user', ['username' => Input('username'), 'password' => password_hash($newp, PASSWORD_DEFAULT)] )) {
                            $s = 1;
                            $m = "Password successfully changed";
                        }
                    }
                } else {
                    $m = "Wrong password";
                }
            }
        }
    }

    echo json_encode(['m' =>$m, 's' => $s]);
}