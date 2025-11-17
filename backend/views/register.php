<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg mt-5">
        <div class="card-body p-5">
          <div class="text-center mb-4">
            <h2>Create an Account</h2>
            <p class="text-muted">Join Finance Tracker today</p>
          </div>
          <form id="register-form">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" id="username" name="username" class="form-control" placeholder="Enter username" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email" class="form-control" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Register</button>
          </form>
          <div id="register-message" class="alert mt-3" style="display:none;"></div>
          <div class="text-center mt-3">
            <p>Already have an account? <a href="/login">Login here</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById('register-form').addEventListener('submit', async function(e) {
  e.preventDefault();

  const data = {
    username: document.getElementById('username').value.trim(),
    email: document.getElementById('email').value.trim(),
    password: document.getElementById('password').value
  };

  const messageDiv = document.getElementById('register-message');
  messageDiv.style.display = 'none';
  messageDiv.textContent = '';

  try {
    const response = await fetch('/users', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    });

    const result = await response.json();

    if (response.ok) {
      messageDiv.className = 'alert alert-success mt-3';
      messageDiv.textContent = 'Registration successful! Redirecting...';
      messageDiv.style.display = 'block';
      localStorage.setItem('userId', result.user_id);
      setTimeout(() => {
        window.location.href = '/dashboard';
      }, 1500);
    } else {
      messageDiv.className = 'alert alert-danger mt-3';
      messageDiv.textContent = result.error || 'Registration failed';
      messageDiv.style.display = 'block';
    }
  } catch (err) {
    messageDiv.className = 'alert alert-danger mt-3';
    messageDiv.textContent = 'Server error. Try again later.';
    messageDiv.style.display = 'block';
    console.error(err);
  }
});
</script>
