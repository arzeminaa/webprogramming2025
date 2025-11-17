<?php
require_once __DIR__ . '/../config/db.php';

class IncomeDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createIncome($amount, $user_id, $month = null) {
        if ($month === null) $month = date('Y-m-d H:i:s');
        $stmt = $this->conn->prepare("INSERT INTO income (amount, user_id, month) VALUES (?, ?, ?)");
        $stmt->bind_param("dis", $amount, $user_id, $month);
        return $stmt->execute();
    }

    public function getIncomeById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM income WHERE budget_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getIncomeByUser($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM income WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function updateIncome($id, $amount, $user_id, $month) {
        $stmt = $this->conn->prepare("UPDATE income SET amount = ?, user_id = ?, month = ? WHERE budget_id = ?");
        $stmt->bind_param("disi", $amount, $user_id, $month, $id);
        return $stmt->execute();
    }

    public function deleteIncome($id) {
        $stmt = $this->conn->prepare("DELETE FROM income WHERE budget_id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
