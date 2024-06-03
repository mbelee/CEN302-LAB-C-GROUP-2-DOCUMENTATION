<?php
require_once 'db-conn.php';
class Patient
{
    public $id;
    public $name;
    public $father_name;
    public $surname;
    public $birth_year;
    public $gender;
    public $email;
    public $password;
    public $photo;
    public $telephone;
    public $address;
    public $details;

    public function __construct($name, $father_name, $surname, $birth_year, $gender, $email, $password, $telephone, $address, $details)
    {
        $this->name = $name;
        $this->father_name = $father_name;
        $this->surname = $surname;
        $this->birth_year = $birth_year;
        $this->gender = $gender;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->photo = "default.jpg";
        $this->telephone = $telephone;
        $this->address = $address;
        $this->details = $details;
    }

    public static function savePatient($patient)
    {
        global $con;
        $stmt = $con->prepare("INSERT INTO patients (name, father_name, surname, birth_year, gender, email, password, photo, telephone, address, details) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssss", $patient->name, $patient->father_name, $patient->surname, $patient->birth_year, $patient->gender, $patient->email, $patient->password, $patient->photo, $patient->telephone, $patient->address, $patient->details);
        $stmt->execute();
        $stmt->close();
    }


    public static function getPatient($id)
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM patients WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $patient = $result->fetch_assoc();
        $stmt->close();
        return $patient;
    }

    public static function getPatientByEmail($email)
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM patients WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $patient = $result->fetch_assoc();
        $stmt->close();
        return $patient;
    }

    public static function getPatients()
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM patients");
        $stmt->execute();
        $result = $stmt->get_result();
        $patients = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $patients;
    }

    public static function searchPatients($search)
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM patients WHERE name LIKE ? OR surname LIKE ? OR email LIKE ?");
        $stmt->bind_param("sss", $search, $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();
        $patients = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $patients;
    }

    public static function name($id)
    {
        global $con;
        $stmt = $con->prepare("SELECT name, surname FROM patients WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $patient = $result->fetch_assoc();
        $stmt->close();
        return $patient['name'] . " " . $patient['surname'];
    }

}