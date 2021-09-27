<?php 

include("DBConnection.php");

class User
{
    protected $db;
    private $id;
    private $name;
    private $email;

    public function __construct()
    {
        $this->db = new DBConnection();
        $this->db = $this->db->getConnection();
    }

    public function setId($id)
    {
        $this->id = $id;
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

    public function createUser()
    {
        try {
            $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";

            $data = [
                "name" => $this->name,
                "email" => $this->email
            ];

            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
            $result = $stmt->rowCount();
            
            return $result;

        } catch(Exception $e) {
            die("Oh noes! There's an error in the query!");
        }
    }

    public function updateUser()
    {
        try {
            $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";

            $data = [
                "id" => $this->id,
                "name" => $this->name,
                "email" => $this->email
            ];

            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
            $result = $stmt->rowCount();
            
            return $result;

        } catch(Exception $e) {
            die("Oh noes! There's an error in the query");
        }
    }

    public function deleteUser()
    {
        try {
            $sql = "DELETE FROM users WHERE id = :id";

            $data = [
                "id" => $this->id
            ];

            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
            $result = $stmt->rowCount();

            return $result;
        } catch(Exception $e) {
            die("Oh noes! There's an error in the query!");
        }
    }
}