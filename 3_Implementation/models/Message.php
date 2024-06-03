<?php
require_once 'db-conn.php';
class Message
{
    public $id;
    public $sender_email;
    public $receiver_email;
    public $content;
    public $date_created;

    public function __construct($sender_email, $receiver_email, $content)
    {
        $this->sender_email = $sender_email;
        $this->reciever_email = $receiver_email;
        $this->content = $content;
        $this->date_created = date("Y-m-d H:i:s");
    }

    public static function saveMessage($content)
    {
        global $con;
        $stmt = $con->prepare("INSERT INTO messages (sender_email, reciever_email, content, date_created) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $content->sender_email, $content->reciever_email, $content->content, $content->date_created);
        $stmt->execute();
        $stmt->close();
    }

    public static function getMessage($id)
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM messages WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $content = $result->fetch_assoc();
        $stmt->close();
        return $content;
    }

    public static function getMessages()
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM messages");
        $stmt->execute();
        $result = $stmt->get_result();
        $contents = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $contents;
    }

    public static function getMessagesBySender($sender_email)
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM messages WHERE sender_email = ?");
        $stmt->bind_param("i", $sender_email);
        $stmt->execute();
        $result = $stmt->get_result();
        $contents = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $contents;
    }

    public static function getMessagesByReceiver($receiver_email)
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM messages WHERE reciever_email = ?");
        $stmt->bind_param("i", $receiver_email);
        $stmt->execute();
        $result = $stmt->get_result();
        $contents = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $contents;
    }
}