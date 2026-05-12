// زاجل - Frontend JS
document.addEventListener('DOMContentLoaded', function () {

    // Navbar scroll effect
    const navbar = document.querySelector('.navbar-front');
    if (navbar) {
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });
    }

    // Active nav link
    const currentPath = window.location.pathname;
    document.querySelectorAll('.navbar-front .nav-link').forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });
});
