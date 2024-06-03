<?php
require_once 'db-conn.php';
class Checkup
{
    public $id;
    public $patient_id;
    public $doctor_id;
    public $date_created;
    public $details;
    public $diagnosis;

    public function __construct($patient_id, $doctor_id, $details, $date)
    {
        $this->patient_id = $patient_id;
        $this->doctor_id = $doctor_id;
        $this->date_created = $date;
        $this->details = $details;
        $this->diagnosis = "";
    }

    public static function saveCheckup($checkup)
    {
        global $con;
        if ($checkup->date_created <=date("Y-m-d")) {
            return false;
        }
        $stmt = $con->prepare("INSERT INTO checkups (patients_id, doctors_id, date_created, details, diagnosis) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $checkup->patient_id, $checkup->doctor_id, $checkup->date_created, $checkup->details, $checkup->diagnosis);
        $stmt->execute();
        $stmt->close();
    }

    public static function getCheckup($id)
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM checkups WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $checkup = $result->fetch_assoc();
        $stmt->close();
        return $checkup;
    }

    public static function getCheckups()
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM checkups");
        $stmt->execute();
        $result = $stmt->get_result();
        $checkups = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $checkups;
    }

    public static function getCheckupsByPatient($patient_id)
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM checkups WHERE patients_id = ?");
        $stmt->bind_param("i", $patient_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $checkups = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $checkups;
    }

    public static function getCheckupsByDoctor($doctor_id)
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM checkups WHERE doctors_id = ?");
        $stmt->bind_param("i", $doctor_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $checkups = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $checkups;
    }

    public static function deleteCheckup($id)
    {
        global $con;
        $stmt = $con->prepare("DELETE FROM checkups WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public static function getCheckupsByPatientOrDoctor($contact)
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM checkups WHERE patient_id LIKE '%$contact%' OR doctor_id LIKE '%$contact%'");
        $stmt->execute();
        $result = $stmt->get_result();
        $checkups = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $checkups;
    }
}