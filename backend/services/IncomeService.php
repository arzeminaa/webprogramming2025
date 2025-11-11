<?php
require_once __DIR__ . '/../dao/IncomeDAO.php';

class IncomeService {
    private $dao;

    public function __construct($conn) {
        $this->dao = new IncomeDAO($conn);
    }

    public function createIncome($data) {
        if (empty($data['amount']) || empty($data['user_id'])) {
            throw new Exception("Amount and user_id are required");
        }

        if (!is_numeric($data['amount'])) {
            throw new Exception("Amount must be numeric");
        }

        return $this->dao->createIncome(
            $data['amount'],
            $data['user_id'],
            $data['month'] ?? null
        );
    }

    public function getIncomeById($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid income ID");
        }
        return $this->dao->getIncomeById($id);
    }

    public function getIncomeByUser($user_id) {
        if (!is_numeric($user_id) || $user_id <= 0) {
            throw new Exception("Invalid user ID");
        }
        return $this->dao->getIncomeByUser($user_id);
    }

    public function updateIncome($id, $data) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid income ID");
        }

        if (empty($data['amount']) || empty($data['user_id']) || empty($data['month'])) {
            throw new Exception("All fields (amount, user_id, month) are required");
        }

        return $this->dao->updateIncome(
            $id,
            $data['amount'],
            $data['user_id'],
            $data['month']
        );
    }

    public function deleteIncome($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid income ID");
        }
        return $this->dao->deleteIncome($id);
    }
}
?>
