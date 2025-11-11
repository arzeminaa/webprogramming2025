<?php
class ExpensesDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createExpense($amount, $category_id, $user_id, $date = null) {
        if ($date === null) $date = date('Y-m-d H:i:s');
        $stmt = $this->conn->prepare("INSERT INTO expenses (amount, category_id, user_id, date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("diis", $amount, $category_id, $user_id, $date);
        return $stmt->execute();
    }

    public function getExpenseById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM expenses WHERE expense_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getExpensesByUser($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM expenses WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function updateExpense($id, $amount, $category_id, $user_id, $date) {
        $stmt = $this->conn->prepare("UPDATE expenses SET amount = ?, category_id = ?, user_id = ?, date = ? WHERE expense_id = ?");
        $stmt->bind_param("diisi", $amount, $category_id, $user_id, $date, $id);
        return $stmt->execute();
    }

    public function deleteExpense($id) {
        $stmt = $this->conn->prepare("DELETE FROM expenses WHERE expense_id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
