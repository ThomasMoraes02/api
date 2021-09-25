<?php 
$request_method = $_SERVER['REQUEST_METHOD'];
include("../class/User.php");
$user = new User();

switch ($request_method) {
    case 'GET':
        $name = '';
        if($_GET['name']) {
            $name = $_GET['name'];
            $user->setName($name);
            $users = $user->getUserByName();
        } else {
            $users = $user->getUsers();
        }
        if(!empty($users)) {
            $json = json_encode($users);
        } else {
            $json = json_encode(array("status" => FALSE, "message" => "There is no record yet."), true);
        }
        header("Content-type: application/json");
        echo $json;
        break;
    
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}