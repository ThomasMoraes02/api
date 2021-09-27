<?php 

$request_method = $_SERVER['REQUEST_METHOD'];
include("../class/User.php");
$user = new User();

switch ($request_method) {
    case 'GET':
        if($_GET['id']) {
            $id = $_GET['id'];
            $user->setId($id);

            $result = $user->deleteUser();

            if(!empty($result)) {
                $json = json_encode(array("status" => TRUE, "message" => "User deleted success"));
            } else {
                $json = json_encode(array("status" => FALSE, "message" => "User not found"));
            }

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