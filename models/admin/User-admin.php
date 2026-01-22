<?php
include 'config/db.php';

class User {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getAllUsers() {
        $result = $this->conn->query("SELECT * FROM user ORDER BY user_id");
        if ($result === false) {
            die("Error executing query: " . $this->conn->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE user_id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addUser($data) {
        $stmt = $this->conn->prepare("INSERT INTO user (user_id, name, password, phone, security_answer) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $data['user_id'], $data['name'], $data['password'], $data['phone'], $data['security_answer']);
        return $stmt->execute();
    }

    public function updateUser($id, $data) {
        $stmt = $this->conn->prepare("UPDATE user SET name=?, password=?, phone=?, security_answer=? WHERE user_id=?");
        $stmt->bind_param("sssss", $data['name'], $data['password'], $data['phone'], $data['security_answer'], $id);
        return $stmt->execute();
    }

    public function deleteUser($id) {
        $stmt = $this->conn->prepare("DELETE FROM user WHERE user_id = ?");
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }

    public function login($user_id, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE user_id = ? AND password = ?");
        $stmt->bind_param("ss", $user_id, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function isUserIdAvailable($user_id) {
        $stmt = $this->conn->prepare("SELECT user_id FROM user WHERE user_id = ?");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows == 0;
    }
}
?>