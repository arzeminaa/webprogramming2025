// app.js

async function loadPage(page) {
    try {
        // load pages relative to the current index.html (frontend/views/)
        const response = await fetch(`${page}.html`);
        if (!response.ok) throw new Error('Page not found');
        const html = await response.text();
        document.getElementById('content').innerHTML = html;
    } catch (err) {
        document.getElementById('content').innerHTML = `<p class="text-danger">Error loading page: ${err.message}</p>`;
    }
}

// Attach click events to all links with data-page
function initNavLinks() {
    document.querySelectorAll('[data-page]').forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            const page = link.getAttribute('data-page');
            loadPage(page);
        });
    });
}

// Initialize SPA
window.addEventListener('DOMContentLoaded', () => {
    initNavLinks();
    loadPage('dashboard');
});
