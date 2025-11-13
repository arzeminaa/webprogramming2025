<div class="text-center">
  <h2>Dashboard</h2>
  <p class="lead">Welcome to your finance dashboard!</p>
</div>

<div class="row">
  <div class="col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Monthly Savings</div>
        <div class="h5 mb-0 font-weight-bold text-gray-800" id="monthly-savings">$0.00</div>
      </div>
    </div>
  </div>
  <div class="col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Income</div>
        <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-income">$0.00</div>
      </div>
    </div>
  </div>
  <div class="col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Expenses</div>
        <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-expenses">$0.00</div>
      </div>
    </div>
  </div>
  <div class="col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Net Savings</div>
        <div class="h5 mb-0 font-weight-bold text-gray-800" id="net-savings">$0.00</div>
      </div>
    </div>
  </div>
</div>

<script>
async function loadDashboard(){
    const userId = localStorage.getItem('userId');
    if(!userId) { window.location.href='/'; return; }

    try {
        // Fetch savings, income, expenses
        const [savings, resIncome, resExpenses] = await Promise.all([
            fetch(`/savings?user_id=${userId}`).then(r=>r.json()),
            fetch(`/income?user_id=${userId}`).then(r=>r.json()),
            fetch(`/expenses?user_id=${userId}`).then(r=>r.json())
        ]);

        const totalSavings = savings.monthly_savings ?? 0;
        const totalIncome = resIncome.reduce((a,b)=>a+parseFloat(b.amount),0);
        const totalExpenses = resExpenses.reduce((a,b)=>a+parseFloat(b.amount),0);
        const netSavings = totalIncome - totalExpenses;

        document.getElementById('monthly-savings').textContent = `$${totalSavings.toFixed(2)}`;
        document.getElementById('total-income').textContent = `$${totalIncome.toFixed(2)}`;
        document.getElementById('total-expenses').textContent = `$${totalExpenses.toFixed(2)}`;
        document.getElementById('net-savings').textContent = `$${netSavings.toFixed(2)}`;
    } catch(err) {
        console.error('Error loading dashboard:', err);
    }
}

loadDashboard();
</script>
