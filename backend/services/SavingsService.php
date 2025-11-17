<?php
require_once __DIR__ . '/../dao/savingsDAO.php';

class SavingsService {
    private $dao;

    public function __construct($conn) {
        $this->dao = new SavingsDAO($conn);
    }

    public function getAllSavings() {
        return $this->dao->getAllSavings();
    }

    public function createSavings($user_id, $monthly_savings, $yearly_savings, $date_recorded = null) {
        if (!is_numeric($user_id) || $user_id <= 0) {
            throw new Exception("Invalid user ID");
        }
        if (!is_numeric($monthly_savings) || !is_numeric($yearly_savings)) {
            throw new Exception("Savings values must be numeric");
        }
        return $this->dao->createSavings($user_id, $monthly_savings, $yearly_savings, $date_recorded);
    }

    public function getSavingsByUser($user_id) {
        if (!is_numeric($user_id) || $user_id <= 0) {
            throw new Exception("Invalid user ID");
        }
        return $this->dao->getSavingsByUser($user_id);
    }

    public function updateSavings($user_id, $monthly_savings, $yearly_savings, $date_recorded) {
        if (!is_numeric($user_id) || $user_id <= 0) {
            throw new Exception("Invalid user ID");
        }
        if (!is_numeric($monthly_savings) || !is_numeric($yearly_savings)) {
            throw new Exception("Savings values must be numeric");
        }
        return $this->dao->updateSavings($user_id, $monthly_savings, $yearly_savings, $date_recorded);
    }

    public function deleteSavings($user_id) {
        if (!is_numeric($user_id) || $user_id <= 0) {
            throw new Exception("Invalid user ID");
        }
        return $this->dao->deleteSavings($user_id);
    }
}
?>
