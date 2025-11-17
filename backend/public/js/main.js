const routes = {
  login: "views/login.html",
  register: "views/register.html",
  dashboard: "views/dashboard.html",
  profile: "views/profile.html",
  transactions: "views/transactions.html",
  settings: "views/settings.html",
};

function loadView(view) {
  const path = routes[view] || routes["login"];
  fetch(path)
    .then(res => res.text())
    .then(html => {
      document.getElementById("app").innerHTML = html;
    });
}

window.addEventListener("hashchange", () => {
  const view = location.hash.substring(1);
  loadView(view);
});

window.addEventListener("load", () => {
  const view = location.hash.substring(1) || "login";
  loadView(view);
});
