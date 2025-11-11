<div class="text-center">
  <h2>Dashboard</h2>
  <p class="lead">Welcome to your finance dashboard!</p>
</div>
<div id="dashboard-stats">
  <!-- Stats injected by JS -->
</div>

<script>
async function loadDashboard(){
    const userId = localStorage.getItem('userId');
    if(!userId) { window.location.href='/'; return; }

    // Fetch savings, income, expenses
    const [savings,resIncome,resExpenses] = await Promise.all([
        fetch(`/savings?user_id=${userId}`).then(r=>r.json()),
        fetch(`/income?user_id=${userId}`).then(r=>r.json()),
        fetch(`/expenses?user_id=${userId}`).then(r=>r.json())
    ]);

    const totalSavings = savings.monthly_savings ?? 0;
    const totalIncome = resIncome.reduce((a,b)=>a+parseFloat(b.amount),0);
    const totalExpenses = resExpenses.reduce((a,b)=>a+parseFloat(b.amount),0);
    const netSavings = totalIncome - totalExpenses;

    document.getElementById('dashboard-stats').innerHTML = `
    <div class="row">
      <div class="col-md-3"><div class="card p-3 text-center"><h5>Monthly Savings</h5><p>$${totalSavings.toFixed(2)}</p></div></div>
      <div class="col-md-3"><div class="card p-3 text-center"><h5>Total Income</h5><p>$${totalIncome.toFixed(2)}</p></div></div>
      <div class="col-md-3"><div class="card p-3 text-center"><h5>Total Expenses</h5><p>$${totalExpenses.toFixed(2)}</p></div></div>
      <div class="col-md-3"><div class="card p-3 text-center"><h5>Net Savings</h5><p>$${netSavings.toFixed(2)}</p></div></div>
    </div>`;
}

loadDashboard();
</script>
