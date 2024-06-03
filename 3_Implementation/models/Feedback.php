<?php
require_once 'db-conn.php';
class Feedback
{
    public $id;
    public $patient_id;
    public $comment;
    public $date_created;

    public function __construct($patient_id, $comment)
    {
        $this->patient_id = $patient_id;
        $this->comment = $comment;
        $this->date_created = date("Y-m-d H:i:s");
    }

    public static function saveFeedback($feedback)
    {
        global $con;
        $stmt = $con->prepare("INSERT INTO feedbacks (patients_id, comment, date_created) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $feedback->patient_id, $feedback->comment, $feedback->date_created);
        $stmt->execute();
        $stmt->close();
    }

    public static function getFeedback($id)
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM feedbacks WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $feedback = $result->fetch_assoc();
        $stmt->close();
        return $feedback;
    }

    public static function getFeedbacks()
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM feedbacks");
        $stmt->execute();
        $result = $stmt->get_result();
        $feedbacks = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $feedbacks;
    }

    public static function getFeedbacksByPatient($patient_id)
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM feedbacks WHERE patient_id = ?");
        $stmt->bind_param("i", $patient_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $feedbacks = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $feedbacks;
    }

    public static function searchFeedbacks($search)
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM feedbacks WHERE comment LIKE ? OR date_created LIKE ?");
        $search = "%$search%";
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        $feedbacks = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $feedbacks;
    }
}