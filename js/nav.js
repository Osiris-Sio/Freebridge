/**
 * Gestionnaire du menu Hamburger pour le mode responsive
 */
document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.getElementById('hamburger-toggle');
    const navMenu = document.getElementById('nav-menu');
    const navOverlay = document.getElementById('nav-overlay');

    if (!hamburger || !navMenu || !navOverlay) return;

    // Fonction pour basculer le menu
    const toggleMenu = () => {
        navMenu.classList.toggle('open');
        navOverlay.classList.toggle('visible');
        document.body.style.overflow = navMenu.classList.contains('open') ? 'hidden' : '';
    };

    // Au clic sur le hamburger
    hamburger.addEventListener('click', (e) => {
        e.preventDefault();
        toggleMenu();
    });

    // Au clic sur l'overlay
    navOverlay.addEventListener('click', () => {
        toggleMenu();
    });

    // Fermer le menu si on clique sur un lien
    const links = navMenu.querySelectorAll('a');
    links.forEach(link => {
        link.addEventListener('click', () => {
            if (navMenu.classList.contains('open')) {
                toggleMenu();
            }
        });
    });

    // Fermer le menu si on redimensionne la fenêtre
    window.addEventListener('resize', () => {
        if (window.innerWidth > 991 && navMenu.classList.contains('open')) {
            toggleMenu();
        }
    });

    // Fermer avec la touche ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && navMenu.classList.contains('open')) {
            toggleMenu();
        }
    });
});
