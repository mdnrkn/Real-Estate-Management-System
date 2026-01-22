<?php
include_once 'models/admin/Staff-admin.php';

class StaffController {
    private $staffModel;

    public function __construct() {
        $this->staffModel = new Staff();
    }

    public function index() {
        $staff = $this->staffModel->getAllStaff();
        include 'views/admin-views/staff/list_staff-admin.php';
    }

    public function add() {
        $message = '';
        $form_data = [
            'staff_id' => '',
            'name' => '',
            'password' => '',
            'phone' => '',
            'security_answer' => ''
        ];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $staff_id = $_POST['staff_id'];
            $form_data = [
                'staff_id' => $_POST['staff_id'],
                'name' => $_POST['name'],
                'password' => $_POST['password'],
                'phone' => $_POST['phone'],
                'security_answer' => $_POST['security_answer']
            ];
            
            if (!$this->staffModel->isStaffIdAvailable($staff_id)) {
                $message = "Staff ID '$staff_id' is already taken. Please choose a different ID.";
            } else {
                $data = $form_data;
                if ($this->staffModel->addStaff($data)) {
                    $message = "New staff added successfully!";
                    $form_data = array_fill_keys(array_keys($form_data), '');
                } else {
                    $message = "Error adding staff.";
                }
            }
        }
        include 'views/admin-views/staff/add_staff-admin.php';
    }

    public function edit($id) {
        $staff = $this->staffModel->getStaffById($id);
        if (!$staff) {
            die("Staff not found.");
        }
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'password' => $_POST['password'],
                'phone' => $_POST['phone'],
                'security_answer' => $_POST['security_answer']
            ];
            if ($this->staffModel->updateStaff($id, $data)) {
                $message = "Staff updated successfully!";
                $staff = $this->staffModel->getStaffById($id);
            } else {
                $message = "Error updating staff.";
            }
        }
        include 'views/admin-views/staff/update_staff-admin.php';
    }

    public function delete($id) {
        if ($this->staffModel->deleteStaff($id)) {
            header('Location: index.php?action=staff_index');
            exit;
        } else {
            die("Error deleting staff.");
        }
    }
}
?>