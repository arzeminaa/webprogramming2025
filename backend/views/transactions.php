<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card shadow mt-4">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
          <h2 class="mb-0">Transactions</h2>
          <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
            <i class="fas fa-plus"></i> Add Transaction
          </button>
        </div>
        <div class="card-body">
          <p class="text-muted mb-4">List of your monthly income and expenses.</p>
          
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead class="table-dark">
                <tr>
                  <th>Date</th>
                  <th>Description</th>
                  <th>Category</th>
                  <th>Amount</th>
                  <th>Type</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="transactions-list">
                <tr>
                  <td>2025-10-01</td>
                  <td>Sample Transaction</td>
                  <td>Food</td>
                  <td>$50.00</td>
                  <td><span class="badge bg-danger">Expense</span></td>
                  <td>
                    <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add Transaction Modal -->
<div class="modal fade" id="addTransactionModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Transaction</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="transaction-form">
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" id="description" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" id="amount" class="form-control" step="0.01" required>
          </div>
          <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" id="category" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select id="type" class="form-select" required>
              <option value="income">Income</option>
              <option value="expense">Expense</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="saveTransaction()">Save Transaction</button>
      </div>
    </div>
  </div>
</div>

<script>
function saveTransaction() {
  const description = document.getElementById('description').value;
  const amount = document.getElementById('amount').value;
  const category = document.getElementById('category').value;
  const type = document.getElementById('type').value;
  
  // TODO: Implement transaction save API call
  console.log('Transaction saved:', { description, amount, category, type });
  alert('Transaction saved successfully!');
  
  // Close modal
  const modal = bootstrap.Modal.getInstance(document.getElementById('addTransactionModal'));
  modal.hide();
  
  // Reset form
  document.getElementById('transaction-form').reset();
}
</script>
