<?php
require_once 'db-conn.php';
class Receptionist
{
    public $id;
    public $name;
    public $surname;
    public $gender;
    public $email;
    public $birth_year;
    public $telephone;
    public $details;
    public $password;

    public function __construct($name, $surname, $gender, $email, $birth_year, $telephone, $details, $password)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->gender = $gender;
        $this->email = $email;
        $this->birth_year = $birth_year;
        $this->telephone = $telephone;
        $this->details = $details;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public static function saveReceptionist($receptionist)
    {
        global $con;
        $stmt = $con->prepare("INSERT INTO receptionists (name, surname, gender, email, birth_year, telephone, details, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $receptionist->name, $receptionist->surname, $receptionist->gender, $receptionist->email, $receptionist->birth_year, $receptionist->telephone, $receptionist->details, $receptionist->password);
        $stmt->execute();
        $stmt->close();
    }

    public static function getReceptionist($id)
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM receptionists WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $receptionist = $result->fetch_assoc();
        $stmt->close();
        return $receptionist;
    }

    public static function getReceptionistByEmail($email)
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM receptionists WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $receptionist = $result->fetch_assoc();
        $stmt->close();
        return $receptionist;
    }

    public static function getReceptionists()
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM receptionists");
        $stmt->execute();
        $result = $stmt->get_result();
        $receptionists = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $receptionists;
    }

}