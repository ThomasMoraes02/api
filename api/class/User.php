<?php 

include("DBConnection.php");

class User
{
    protected $db;
    private $name;
    private $email;

    public function __construct()
    {
        $this->db = new DBConnection();
        $this->db = $this->db->getConnection();
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsers()
    {
        try {
            $sql = "SELECT * FROM users";
            $stmt = $this->db->prepare($sql);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
            
        } catch (Exception $e) {
            die("Oh noes! There's an error in the query!");
        }
    }

    public function getUserByName()
    {
        try {
            $sql = "SELECT * FROM users WHERE name = :name";

            $data = [
                "name" => $this->name
            ];
    
            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }  catch (Exception $e) {
		    die("Oh noes! There's an error in the query!");
		}
    }
}