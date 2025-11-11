<?php
class ProfileDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllProfiles() {
        $result = $this->conn->query("SELECT * FROM profile");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProfileById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM profile WHERE profile_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createProfile($user_id, $age, $occupation, $location) {
        $stmt = $this->conn->prepare("INSERT INTO profile (user_id, age, occupation, location) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $user_id, $age, $occupation, $location);
        return $stmt->execute();
    }

    public function updateProfile($id, $age, $occupation, $location) {
        $stmt = $this->conn->prepare("UPDATE profile SET age = ?, occupation = ?, location = ? WHERE profile_id = ?");
        $stmt->bind_param("issi", $age, $occupation, $location, $id);
        return $stmt->execute();
    }

    public function deleteProfile($id) {
        $stmt = $this->conn->prepare("DELETE FROM profile WHERE profile_id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
