<?php 
$request_method = $_SERVER['REQUEST_METHOD'];
include("../class/User.php");
$user = new User();

switch ($request_method) {
    case 'GET':
        $users = '';
        $users = $user->getUsers();

        if(!empty($users)) {
            $json = json_encode($users);
        } else {
            $json = json_encode(array('status' => FALSE, 'message' => 'There is no record yet.'), true);
        }

        header('Content-Type: application/json');
        echo $json;
        break;

    default:
    header("HTTP/1.0 405 Method Not Allowed");
	break;
}