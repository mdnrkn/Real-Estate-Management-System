<?php
include_once 'models/admin/User-admin.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function index() {
        $users = $this->userModel->getAllUsers();
        include 'views/admin-views/user/list_user-admin.php';
    }

    public function add() {
        $message = '';
        $form_data = [
            'user_id' => '',
            'name' => '',
            'password' => '',
            'phone' => '',
            'security_answer' => ''
        ];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_POST['user_id'];
            $form_data = [
                'user_id' => $_POST['user_id'],
                'name' => $_POST['name'],
                'password' => $_POST['password'],
                'phone' => $_POST['phone'],
                'security_answer' => $_POST['security_answer']
            ];
            
            if (!$this->userModel->isUserIdAvailable($user_id)) {
                $message = "User ID '$user_id' is already taken. Please choose a different ID.";
            } else {
                $data = $form_data;
                if ($this->userModel->addUser($data)) {
                    $message = "New user added successfully!";
                    $form_data = array_fill_keys(array_keys($form_data), '');
                } else {
                    $message = "Error adding user.";
                }
            }
        }
        include 'views/admin-views/user/add_user-admin.php';
    }

    public function edit($id) {
        $user = $this->userModel->getUserById($id);
        if (!$user) {
            die("User not found.");
        }
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'password' => $_POST['password'],
                'phone' => $_POST['phone'],
                'security_answer' => $_POST['security_answer']
            ];
            if ($this->userModel->updateUser($id, $data)) {
                $message = "User updated successfully!";
                $user = $this->userModel->getUserById($id);
            } else {
                $message = "Error updating user.";
            }
        }
        include 'views/admin-views/user/update_user-admin.php';
    }

    public function delete($id) {
        if ($this->userModel->deleteUser($id)) {
            header('Location: index.php?action=user_index');
            exit;
        } else {
            die("Error deleting user.");
        }
    }
}
?>