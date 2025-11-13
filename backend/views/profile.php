<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card shadow mt-4">
        <div class="card-header bg-primary text-white">
          <h2 class="mb-0">User Profile</h2>
        </div>
        <div class="card-body p-4">
          <p class="text-muted mb-4">Manage your account information.</p>
          
          <form id="profile-form">
            <div class="mb-3">
              <label for="fullname" class="form-label">Full Name</label>
              <input type="text" id="fullname" class="form-control" placeholder="John Doe">
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" class="form-control" placeholder="john@example.com">
            </div>

            <div class="mb-3">
              <label for="salary" class="form-label">Monthly Salary</label>
              <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" id="salary" class="form-control" placeholder="3000">
              </div>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-secondary">Update Profile</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById('profile-form').addEventListener('submit', function(e) {
  e.preventDefault();
  
  const fullname = document.getElementById('fullname').value;
  const email = document.getElementById('email').value;
  const salary = document.getElementById('salary').value;
  
  // TODO: Implement profile update API call
  console.log('Profile update:', { fullname, email, salary });
  alert('Profile update functionality coming soon!');
});
</script>
