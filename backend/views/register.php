<h2>Register</h2>
<form id="register-form">
  <label>Username:</label>
  <input type="text" id="username" name="username" required><br><br>

  <label>Email:</label>
  <input type="email" id="email" name="email" required><br><br>

  <label>Password:</label>
  <input type="password" id="password" name="password" required><br><br>

  <button type="submit">Register</button>
</form>
<div id="register-message"></div>

<script>
document.getElementById('register-form').addEventListener('submit', async function(e) {
  e.preventDefault();

  const data = {
    username: document.getElementById('username').value.trim(),
    email: document.getElementById('email').value.trim(),
    password: document.getElementById('password').value
  };

  const messageDiv = document.getElementById('register-message');
  messageDiv.textContent = '';

  try {
    const response = await fetch('http://localhost/webprogramming2025/users', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    });

    const result = await response.json();

    if (response.ok) {
      localStorage.setItem('userId', result.user_id);
      window.location.href = 'dashboard.html';
    } else {
      messageDiv.textContent = result.error || 'Registration failed';
    }
  } catch (err) {
    messageDiv.textContent = 'Server error. Try again later.';
    console.error(err);
  }
});
</script>
