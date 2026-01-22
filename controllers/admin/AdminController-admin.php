<?php
include_once 'models/admin/Admin-admin.php';
include_once 'models/admin/User-admin.php';
include_once 'models/admin/Staff-admin.php';
include_once 'models/admin/PropertyOwner-admin.php';

class AdminController {
    private $adminModel;

    public function __construct() {
        $this->adminModel = new Admin();
    }

    public function index() {
        $admins = $this->adminModel->getAllAdmins();
        include 'views/admin-views/admin/list_admin-admin.php';
    }

    public function add() {
        $message = '';
        $form_data = [
            'admin_id' => '',
            'name' => '',
            'password' => '',
            'phone' => '',
            'security_answer' => ''
        ];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $admin_id = $_POST['admin_id'];
            $form_data = [
                'admin_id' => $_POST['admin_id'],
                'name' => $_POST['name'],
                'password' => $_POST['password'],
                'phone' => $_POST['phone'],
                'security_answer' => $_POST['security_answer']
            ];
            
            if (!$this->adminModel->isAdminIdAvailable($admin_id)) {
                $message = "Admin ID '$admin_id' is already taken. Please choose a different ID.";
            } else {
                $data = $form_data;
                if ($this->adminModel->addAdmin($data)) {
                    $message = "New admin added successfully!";
                    $form_data = array_fill_keys(array_keys($form_data), ''); 
                } else {
                    $message = "Error adding admin.";
                }
            }
        }
        include 'views/admin-views/admin/add_admin-admin.php';
    }

    public function edit($id) {
        $admin = $this->adminModel->getAdminById($id);
        if (!$admin) {
            die("Admin not found.");
        }
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'password' => $_POST['password'],
                'phone' => $_POST['phone'],
                'security_answer' => $_POST['security_answer']
            ];
            if ($this->adminModel->updateAdmin($id, $data)) {
                $message = "Admin updated successfully!";
                $admin = $this->adminModel->getAdminById($id); 
            } else {
                $message = "Error updating admin.";
            }
        }
        include 'views/admin-views/admin/update_admin-admin.php';
    }

    public function delete($id) {
        if ($this->adminModel->deleteAdmin($id)) {
            header('Location: index.php?action=index');
            exit;
        } else {
            die("Error deleting admin.");
        }
    }

    public function login() {
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $admin_id = $_POST['admin_id'];
            $password = $_POST['password'];
            $admin = $this->adminModel->login($admin_id, $password);
            if ($admin) {
                session_start();
                $_SESSION['admin_id'] = $admin['admin_id'];
                $_SESSION['admin_name'] = $admin['name'];
                header('Location: index.php?action=dashboard');
                exit;
            } else {
                $message = "Invalid admin ID or password.";
            }
        }
        include 'views/login.php';
    }

    public function dashboard() {
        $stats = [
            'total_admins' => count($this->adminModel->getAllAdmins()),
            'total_users' => count((new User())->getAllUsers()),
            'total_staff' => count((new Staff())->getAllStaff()),
            'total_owners' => count((new PropertyOwner())->getAllOwners())
        ];
        include 'views/admin-views/admin/admin_dashboard-admin.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }

    public function profile() {
        session_start();
        if (!isset($_SESSION['admin_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $admin_id = $_SESSION['admin_id'];
        $admin = $this->adminModel->getAdminById($admin_id);
        if (!$admin) {
            die("Admin not found.");
        }

        $message = '';
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $current_password = $_POST['current_password'] ?? '';
            $new_password = $_POST['new_password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            if (!empty($new_password)) {
                if (empty($current_password)) {
                    $error = "Current password is required to change password.";
                } elseif (!$this->adminModel->verifyPassword($admin_id, $current_password)) {
                    $error = "Current password is incorrect.";
                } elseif ($new_password !== $confirm_password) {
                    $error = "New passwords do not match.";
                } elseif (strlen($new_password) < 8) {
                    $error = "New password must be at least 8 characters long.";
                } elseif (!preg_match('/[A-Z]/', $new_password) || !preg_match('/[a-z]/', $new_password) || !preg_match('/[0-9]/', $new_password)) {
                    $error = "New password must contain at least one uppercase letter, one lowercase letter, and one number.";
                }
            }

            if (empty($error)) {
                $data = [
                    'name' => $_POST['name'],
                    'phone' => $_POST['phone'],
                    'security_answer' => $admin['security_answer']
                ];

                if (!empty($new_password)) {
                    $data['password'] = $new_password;
                }

                if ($this->adminModel->updateAdmin($admin_id, $data)) {
                    $message = "Profile updated successfully!";
                    $admin = $this->adminModel->getAdminById($admin_id);
                    $_SESSION['admin_name'] = $admin['name'];
                } else {
                    $error = "Error updating profile.";
                }
            }
        }

        include 'views/admin-views/admin/admin_profile-admin.php';
    }
}
?>
