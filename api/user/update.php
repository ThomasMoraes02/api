<?php 

$request_method = $_SERVER['REQUEST_METHOD'];
include("../class/User.php");
$user = new User();

switch ($request_method) {
    case 'POST':
        
        $id = $_GET['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];

        $user->setId($id);
        $user->setName($name);
        $user->setEmail($email);

        $result = $user->updateUser();

        if(!empty($result)) {
            $json = json_encode(array("status" => TRUE, "message" => "Employee update successfully"), true);
        } else {
            $json = json_encode(array("status" => FALSE, "message" => "Employee update failed"), true);
        }

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        echo $json;

        break;
    
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}