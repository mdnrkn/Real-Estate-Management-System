<?php
include_once 'models/admin/PropertyOwner-admin.php';

class PropertyOwnerController {
    private $ownerModel;

    public function __construct() {
        $this->ownerModel = new PropertyOwner();
    }

    public function index() {
        $owners = $this->ownerModel->getAllOwners();
        include 'views/admin-views/property_owner/list_property_owner-admin.php';
    }

    public function add() {
        $message = '';
        $form_data = [
            'property_owner_id' => '',
            'name' => '',
            'password' => '',
            'phone' => '',
            'security_answer' => ''
        ];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $property_owner_id = $_POST['property_owner_id'];
            $form_data = [
                'property_owner_id' => $_POST['property_owner_id'],
                'name' => $_POST['name'],
                'password' => $_POST['password'],
                'phone' => $_POST['phone'],
                'security_answer' => $_POST['security_answer']
            ];
            
            if (!$this->ownerModel->isPropertyOwnerIdAvailable($property_owner_id)) {
                $message = "Property Owner ID '$property_owner_id' is already taken. Please choose a different ID.";
            } else {
                $data = $form_data;
                if ($this->ownerModel->addOwner($data)) {
                    $message = "New property owner added successfully!";
                    $form_data = array_fill_keys(array_keys($form_data), '');
                } else {
                    $message = "Error adding property owner.";
                }
            }
        }
        include 'views/admin-views/property_owner/add_property_owner-admin.php';
    }

    public function edit($id) {
        $owner = $this->ownerModel->getOwnerById($id);
        if (!$owner) {
            die("Property owner not found.");
        }
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'password' => $_POST['password'],
                'phone' => $_POST['phone'],
                'security_answer' => $_POST['security_answer']
            ];
            if ($this->ownerModel->updateOwner($id, $data)) {
                $message = "Property owner updated successfully!";
                $owner = $this->ownerModel->getOwnerById($id);
            } else {
                $message = "Error updating property owner.";
            }
        }
        include 'views/admin-views/property_owner/update_property_owner-admin.php';
    }

    public function delete($id) {
        if ($this->ownerModel->deleteOwner($id)) {
            header('Location: index.php?action=owner_index');
            exit;
        } else {
            die("Error deleting property owner.");
        }
    }
}
?>