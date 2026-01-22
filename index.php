<?php
session_start();
include 'controllers/admin/AdminController-admin.php';
include 'controllers/admin/UserController-admin.php';
include 'controllers/admin/StaffController-admin.php';
include 'controllers/admin/PropertyOwnerController-admin.php';

$adminController = new AdminController();
$userController = new UserController();
$staffController = new StaffController();
$ownerController = new PropertyOwnerController();

$action = isset($_GET['action']) ? $_GET['action'] : 'login';
$id = isset($_GET['id']) ? $_GET['id'] : null;

$protected_actions = ['index', 'add', 'edit', 'delete', 'logout', 'dashboard', 'profile', 'user_index', 'user_add', 'user_edit', 'user_delete', 'staff_index', 'staff_add', 'staff_edit', 'staff_delete', 'owner_index', 'owner_add', 'owner_edit', 'owner_delete'];
if (in_array($action, $protected_actions) && !isset($_SESSION['admin_id'])) {
    $action = 'login';
}

switch ($action) {
    // Admin actions
    case 'login':
        $adminController->login();
        break;
    case 'logout':
        $adminController->logout();
        break;
    case 'dashboard':
        $adminController->dashboard();
        break;
    case 'profile':
        $adminController->profile();
        break;
    case 'index':
        $adminController->index();
        break;
    case 'add':
        $adminController->add();
        break;
    case 'edit':
        if ($id) {
            $adminController->edit($id);
        } else {
            die("No ID provided.");
        }
        break;
    case 'delete':
        if ($id) {
            $adminController->delete($id);
        } else {
            die("No ID provided.");
        }
        break;

    // User actions
    case 'user_index':
        $userController->index();
        break;
    case 'user_add':
        $userController->add();
        break;
    case 'user_edit':
        if ($id) {
            $userController->edit($id);
        } else {
            die("No ID provided.");
        }
        break;
    case 'user_delete':
        if ($id) {
            $userController->delete($id);
        } else {
            die("No ID provided.");
        }
        break;

    // Staff actions
    case 'staff_index':
        $staffController->index();
        break;
    case 'staff_add':
        $staffController->add();
        break;
    case 'staff_edit':
        if ($id) {
            $staffController->edit($id);
        } else {
            die("No ID provided.");
        }
        break;
    case 'staff_delete':
        if ($id) {
            $staffController->delete($id);
        } else {
            die("No ID provided.");
        }
        break;

    // Property Owner actions
    case 'owner_index':
        $ownerController->index();
        break;
    case 'owner_add':
        $ownerController->add();
        break;
    case 'owner_edit':
        if ($id) {
            $ownerController->edit($id);
        } else {
            die("No ID provided.");
        }
        break;
    case 'owner_delete':
        if ($id) {
            $ownerController->delete($id);
        } else {
            die("No ID provided.");
        }
        break;

    default:
        $adminController->dashboard();
        break;
}
?>
