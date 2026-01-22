<?php
include 'config/db.php';

class Admin {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getAllAdmins() {
        $result = $this->conn->query("SELECT * FROM admin ORDER BY admin_id");
        if ($result === false) {
            die("Error executing query: " . $this->conn->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAdminById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM admin WHERE admin_id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addAdmin($data) {
        $stmt = $this->conn->prepare("INSERT INTO admin 
            (admin_id, name, password, phone, security_answer) 
            VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", 
            $data['admin_id'], $data['name'], $data['password'], 
            $data['phone'], $data['security_answer']);
        return $stmt->execute();
    }

    public function updateAdmin($id, $data) {
        $fields = [];
        $types = "";
        $values = [];

        if (isset($data['name'])) {
            $fields[] = "name=?";
            $types .= "s";
            $values[] = $data['name'];
        }
        if (isset($data['password'])) {
            $fields[] = "password=?";
            $types .= "s";
            $values[] = $data['password'];
        }
        if (isset($data['phone'])) {
            $fields[] = "phone=?";
            $types .= "s";
            $values[] = $data['phone'];
        }
        if (isset($data['security_answer'])) {
            $fields[] = "security_answer=?";
            $types .= "s";
            $values[] = $data['security_answer'];
        }

        if (empty($fields)) {
            return false; 
        }

        $sql = "UPDATE admin SET " . implode(", ", $fields) . " WHERE admin_id=?";
        $types .= "s";
        $values[] = $id;

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param($types, ...$values);
        return $stmt->execute();
    }

    public function deleteAdmin($id) {
        $stmt = $this->conn->prepare("DELETE FROM admin WHERE admin_id = ?");
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }

    public function isAdminIdAvailable($admin_id) {
        $stmt = $this->conn->prepare("SELECT admin_id FROM admin WHERE admin_id = ?");
        $stmt->bind_param("s", $admin_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows == 0; 
    }

    public function login($admin_id, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM admin WHERE admin_id = ? AND password = ?");
        $stmt->bind_param("ss", $admin_id, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function verifyPassword($admin_id, $password) {
        $stmt = $this->conn->prepare("SELECT admin_id FROM admin WHERE admin_id = ? AND password = ?");
        $stmt->bind_param("ss", $admin_id, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
}
?>
