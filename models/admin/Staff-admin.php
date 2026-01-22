<?php
include 'config/db.php';

class Staff {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getAllStaff() {
        $result = $this->conn->query("SELECT * FROM staff ORDER BY staff_id");
        if ($result === false) {
            die("Error executing query: " . $this->conn->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getStaffById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM staff WHERE staff_id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addStaff($data) {
        $stmt = $this->conn->prepare("INSERT INTO staff (staff_id, name, password, phone, security_answer) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $data['staff_id'], $data['name'], $data['password'], $data['phone'], $data['security_answer']);
        return $stmt->execute();
    }

    public function updateStaff($id, $data) {
        $stmt = $this->conn->prepare("UPDATE staff SET name=?, password=?, phone=?, security_answer=? WHERE staff_id=?");
        $stmt->bind_param("sssss", $data['name'], $data['password'], $data['phone'], $data['security_answer'], $id);
        return $stmt->execute();
    }

    public function deleteStaff($id) {
        $stmt = $this->conn->prepare("DELETE FROM staff WHERE staff_id = ?");
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }

    public function login($staff_id, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM staff WHERE staff_id = ? AND password = ?");
        $stmt->bind_param("ss", $staff_id, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function isStaffIdAvailable($staff_id) {
        $stmt = $this->conn->prepare("SELECT staff_id FROM staff WHERE staff_id = ?");
        $stmt->bind_param("s", $staff_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows == 0;
    }
}
?>