<?php
require_once 'db-conn.php';
class MedicalRecords
{
    public $id;
    public $patient_id;
    public $doctor_id;
    public $date_created;
    public $details;
    public $allergies;
    public $bloodtype;

    public function __construct($patient_id, $doctor_id, $details, $allergies, $bloodtype)
    {
        $this->patient_id = $patient_id;
        $this->doctor_id = $doctor_id;
        $this->date_created = date("Y-m-d H:i:s");
        $this->details = $details;
        $this->allergies = $allergies;
        $this->bloodtype = $bloodtype;
    }

public static function saveMedicalRecords($medicalRecords)
    {
        global $con;
        $stmt = $con->prepare("INSERT INTO medical_records (patients_id, doctors_id, date_created, details, allergies, bloodtype) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissss", $medicalRecords->patient_id, $medicalRecords->doctor_id, $medicalRecords->date_created, $medicalRecords->details, $medicalRecords->allergies, $medicalRecords->bloodtype);
        $stmt->execute();
        $stmt->close();
    }

    public static function getMedicalRecords($id)
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM medical_records WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $medicalRecords = $result->fetch_assoc();
        $stmt->close();
        return $medicalRecords;
    }

    public static function getMedicalRecordsByPatient($patient_id)
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM medical_records WHERE patients_id = ?");
        $stmt->bind_param("i", $patient_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $medicalRecords = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $medicalRecords;
    }

    public static function getMedicalRecordsByDoctor($doctor_id)
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM medical_records WHERE doctors_id = ?");
        $stmt->bind_param("i", $doctor_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $medicalRecords = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $medicalRecords;
    }
    public static function getAllMedicalRecords()
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM medical_records");
        $stmt->execute();
        $result = $stmt->get_result();
        $medicalRecords = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $medicalRecords;
    }

}