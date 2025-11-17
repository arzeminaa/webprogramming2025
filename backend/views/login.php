<div class="container">
  <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
            <div class="col-lg-6">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                </div>
                <form id="login-form" class="user">
                  <div class="form-group">
                    <input type="email" id="email" class="form-control form-control-user" placeholder="Enter Email Address..." required>
                  </div>
                  <div class="form-group">
                    <input type="password" id="password" class="form-control form-control-user" placeholder="Password" required>
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                </form>
                <div id="login-message" class="alert alert-danger mt-3" style="display:none;"></div>
                <hr>
                <div class="text-center">
                  <a class="small" href="/register">Create an Account!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById('login-form').addEventListener('submit', async function(e){
  e.preventDefault();
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  const msgDiv = document.getElementById('login-message');
  msgDiv.style.display = 'none';
  msgDiv.textContent = '';

  if(!email || !password){ 
    msgDiv.textContent = 'Enter email & password'; 
    msgDiv.style.display = 'block';
    return; 
  }

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
      msgDiv.textContent = data.error || 'Login failed';
      msgDiv.style.display = 'block';
    }
  } catch(err){
    msgDiv.textContent = 'Server error';
    msgDiv.style.display = 'block';
  }
});
</script>
