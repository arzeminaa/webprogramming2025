<?php
require_once __DIR__ . '/../dao/ProfileDAO.php';

class ProfileService {
    private $dao;

    public function __construct($conn) {
        $this->dao = new ProfileDAO($conn);
    }

    public function getAllProfiles() {
        return $this->dao->getAllProfiles();
    }

    public function getProfileById($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid profile ID");
        }
        return $this->dao->getProfileById($id);
    }

    public function createProfile($data) {
        if (empty($data['user_id'])) {
            throw new Exception("user_id is required");
        }
        return $this->dao->createProfile($data['user_id'], $data['age'], $data['occupation'], $data['location']);
    }

    public function updateProfile($id, $data) {
        return $this->dao->updateProfile($id, $data['age'], $data['occupation'], $data['location']);
    }

    public function deleteProfile($id) {
        return $this->dao->deleteProfile($id);
    }
}
?>
