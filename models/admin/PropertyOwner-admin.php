<?php
include 'config/db.php';

class PropertyOwner {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getAllOwners() {
        $result = $this->conn->query("SELECT * FROM property_owner ORDER BY property_owner_id");
        if ($result === false) {
            die("Error executing query: " . $this->conn->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOwnerById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM property_owner WHERE property_owner_id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addOwner($data) {
        $stmt = $this->conn->prepare("INSERT INTO property_owner (property_owner_id, name, password, phone, security_answer) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $data['property_owner_id'], $data['name'], $data['password'], $data['phone'], $data['security_answer']);
        return $stmt->execute();
    }

    public function updateOwner($id, $data) {
        $stmt = $this->conn->prepare("UPDATE property_owner SET name=?, password=?, phone=?, security_answer=? WHERE property_owner_id=?");
        $stmt->bind_param("sssss", $data['name'], $data['password'], $data['phone'], $data['security_answer'], $id);
        return $stmt->execute();
    }

    public function deleteOwner($id) {
        $stmt = $this->conn->prepare("DELETE FROM property_owner WHERE property_owner_id = ?");
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }

    public function isPropertyOwnerIdAvailable($property_owner_id) {
        $stmt = $this->conn->prepare("SELECT property_owner_id FROM property_owner WHERE property_owner_id = ?");
        $stmt->bind_param("s", $property_owner_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows == 0;
    }
}
?>