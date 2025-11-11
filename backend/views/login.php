<div class="text-center">
<h2>Login</h2>
<form id="login-form">
  <input type="email" id="email" placeholder="Email" class="form-control mb-2">
  <input type="password" id="password" placeholder="Password" class="form-control mb-2">
  <button type="submit" class="btn btn-primary w-100">Login</button>
</form>
<div id="login-message" class="text-danger mt-2"></div>
</div>

<script>
document.getElementById('login-form').addEventListener('submit', async function(e){
  e.preventDefault();
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  const msg = document.getElementById('login-message');
  msg.textContent = '';

  if(!email || !password){ msg.textContent = 'Enter email & password'; return; }

  try {
    const res = await fetch('/users/login', {
      method:'POST',
      headers:{'Content-Type':'application/json'},
      body: JSON.stringify({email,password})
    });
    const data = await res.json();
    if(res.ok){
      localStorage.setItem('userId', data.user_id);
      window.location.href = '/dashboard';
    } else {
      msg.textContent = data.error || 'Login failed';
    }
  } catch(err){
    msg.textContent = 'Server error';
  }
});
</script>
