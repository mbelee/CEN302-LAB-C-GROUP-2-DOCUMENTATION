<?php
require_once 'db-conn.php';
class Doctor
{
    public $id;
    public $name;
    public $father_name;
    public $surname;
    public $birth_year;
    public $gender;
    public $password;
    public $photo;
    public $telephone;
    public $specialty;
    public $email;

    public function __construct($name, $father_name, $surname, $birth_year, $gender, $password, $telephone, $specialty, $email)
    {
        $this->name = $name;
        $this->father_name = $father_name;
        $this->surname = $surname;
        $this->birth_year = $birth_year;
        $this->gender = $gender;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->photo = "default.jpg";
        $this->telephone = $telephone;
        $this->specialty = $specialty;
        $this->email = $email;
    }

    public static function saveDoctor($doctor) {
        global $con;
        $stmt = $con->prepare("INSERT INTO doctors (name, father_name, surname, birth_year,gender, password, photo, telephone, specialty, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $doctor->name, $doctor->father_name, $doctor->surname, $doctor->birth_year, $doctor->gender, $doctor->password, $doctor->photo, $doctor->telephone, $doctor->specialty, $doctor->email);
        $stmt->execute();
        $stmt->close();
    }

    public static function getDoctor($id) {
        global $con;
        $stmt = $con->prepare("SELECT * FROM doctors WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $doctor = $result->fetch_assoc();
        $stmt->close();
        return $doctor;
    }

    public static function getDoctorByEmail($email) {
        global $con;
        $stmt = $con->prepare("SELECT * FROM doctors WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $doctor = $result->fetch_assoc();
        $stmt->close();
        return $doctor;
    }

    public static function getDoctors() {
        global $con;
        $stmt = $con->prepare("SELECT * FROM doctors");
        $stmt->execute();
        $result = $stmt->get_result();
        $doctors = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $doctors;
    }

    public static function deleteDoctor($id) {
        global $con;
        $stmt = $con->prepare("DELETE FROM doctors WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public static function getSpecialties() {
        global $con;
        $stmt = $con->prepare("SELECT DISTINCT specialty FROM doctors");
        $stmt->execute();
        $result = $stmt->get_result();
        $specialties = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $specialties;
    }

    public static function getDoctorsBySpecialty($specialty) {
        global $con;
        $stmt = $con->prepare("SELECT * FROM doctors WHERE specialty = ?");
        $stmt->bind_param("s", $specialty);
        $stmt->execute();
        $result = $stmt->get_result();
        $doctors = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $doctors;
    }

    public static function searchDoctors($search) {
        global $con;
        $stmt = $con->prepare("SELECT * FROM doctors WHERE name LIKE ? OR father_name LIKE ? OR surname LIKE ? OR specialty LIKE ?");
        $search = "%$search%";
        $stmt->bind_param("ssss", $search, $search, $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();
        $doctors = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $doctors;
    }
    public static function JSONDoctors() {
        global $con;
        $stmt = $con->prepare("SELECT * FROM doctors");
        $stmt->execute();
        $result = $stmt->get_result();
        $doctors = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return json_encode($doctors);
    }
    public static function name($id) {
        global $con;
        $stmt = $con->prepare("SELECT name, surname FROM doctors WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $doctor = $result->fetch_assoc();
        $stmt->close();
        return $doctor['name'] . " " . $doctor['surname'];
    }

    public static function getPatients($doctor_id) {
        global $con;
        $stmt = $con->prepare("SELECT patients.* FROM patients JOIN checkups ON patients.id = checkups.patients_id WHERE checkups.doctors_id = ?");
        $stmt->bind_param("i", $doctor_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $patients = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $patients;
    }

    public static function getMessages($id) {
        global $con;
        $stmt = $con->prepare("SELECT * FROM messages WHERE doctors_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $messages = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $messages;
    }
}