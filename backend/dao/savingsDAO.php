<?php
require_once __DIR__ . '/../config/db.php';

class SavingsDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllSavings() {
        $result = $this->conn->query("SELECT * FROM savings");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createSavings($user_id, $monthly_savings, $yearly_savings, $date_recorded = null) {
        if ($date_recorded === null) $date_recorded = date('Y-m-d H:i:s');
        $stmt = $this->conn->prepare("INSERT INTO savings (user_id, monthly_savings, yearly_savings, date_recorded) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("idds", $user_id, $monthly_savings, $yearly_savings, $date_recorded);
        return $stmt->execute();
    }

    public function getSavingsByUser($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM savings WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateSavings($user_id, $monthly_savings, $yearly_savings, $date_recorded) {
        $stmt = $this->conn->prepare("UPDATE savings SET monthly_savings = ?, yearly_savings = ?, date_recorded = ? WHERE user_id = ?");
        $stmt->bind_param("ddsi", $monthly_savings, $yearly_savings, $date_recorded, $user_id);
        return $stmt->execute();
    }

    public function deleteSavings($user_id) {
        $stmt = $this->conn->prepare("DELETE FROM savings WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }
}
?>
