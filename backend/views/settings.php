<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card shadow mt-4">
        <div class="card-header bg-info text-white">
          <h2 class="mb-0">Settings</h2>
        </div>
        <div class="card-body p-4">
          <p class="text-muted mb-4">Customize your app preferences.</p>
          
          <form id="settings-form">
            <div class="mb-3">
              <label for="currency" class="form-label">Currency</label>
              <select id="currency" class="form-select">
                <option value="USD">USD - US Dollar</option>
                <option value="EUR">EUR - Euro</option>
                <option value="GBP">GBP - British Pound</option>
                <option value="PHP">PHP - Philippine Peso</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="theme" class="form-label">Theme</label>
              <select id="theme" class="form-select">
                <option value="light">Light</option>
                <option value="dark">Dark</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="language" class="form-label">Language</label>
              <select id="language" class="form-select">
                <option value="en">English</option>
                <option value="es">Spanish</option>
                <option value="fr">French</option>
              </select>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-info">Save Settings</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById('settings-form').addEventListener('submit', function(e) {
  e.preventDefault();
  
  const currency = document.getElementById('currency').value;
  const theme = document.getElementById('theme').value;
  const language = document.getElementById('language').value;
  
  // TODO: Implement settings save API call
  console.log('Settings saved:', { currency, theme, language });
  alert('Settings saved successfully!');
});
</script>
