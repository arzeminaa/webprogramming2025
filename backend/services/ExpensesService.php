<?php
require_once __DIR__ . '/../dao/ExpensesDAO.php';

class ExpensesService {
    private $dao;

    public function __construct($conn) {
        $this->dao = new ExpensesDAO($conn);
    }

    public function createExpense($data) {
        if (empty($data['amount']) || empty($data['category_id']) || empty($data['user_id'])) {
            throw new Exception("Amount, category_id and user_id are required");
        }

        if (!is_numeric($data['amount'])) {
            throw new Exception("Amount must be numeric");
        }

        return $this->dao->createExpense(
            $data['amount'],
            $data['category_id'],
            $data['user_id'],
            $data['date'] ?? null
        );
    }

    public function getExpenseById($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid expense ID");
        }
        return $this->dao->getExpenseById($id);
    }

    public function getExpensesByUser($user_id) {
        if (!is_numeric($user_id) || $user_id <= 0) {
            throw new Exception("Invalid user ID");
        }
        return $this->dao->getExpensesByUser($user_id);
    }

    public function updateExpense($id, $data) {
        if (empty($data['amount']) || empty($data['category_id']) || empty($data['user_id']) || empty($data['date'])) {
            throw new Exception("All fields (amount, category_id, user_id, date) are required");
        }

        return $this->dao->updateExpense(
            $id,
            $data['amount'],
            $data['category_id'],
            $data['user_id'],
            $data['date']
        );
    }

    public function deleteExpense($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid expense ID");
        }
        return $this->dao->deleteExpense($id);
    }
}
?>
