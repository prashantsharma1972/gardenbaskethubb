// Garden Basket Hub — Header Navigation Utility
import './main.js';
import './global.js';
import AOS from 'aos';
if (typeof AOS !== 'undefined') {
    AOS.init();
}

document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('gbh-mobile-toggle');
    const closeBtn = document.getElementById('gbh-mobile-close');
    const overlay = document.getElementById('gbh-mobile-overlay');
    const drawer = document.getElementById('gbh-mobile-drawer');

    if (!toggleBtn || !drawer) return;

    const openDrawer = (e) => {
        if (e) e.preventDefault();
        drawer.classList.add('open');
        if (overlay) overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    const closeDrawer = (e) => {
        if (e) e.preventDefault();
        drawer.classList.remove('open');
        if (overlay) overlay.classList.remove('active');
        document.body.style.overflow = '';
    };

    toggleBtn.addEventListener('click', openDrawer);
    if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
    if (overlay) overlay.addEventListener('click', closeDrawer);

    // Close drawer when any nav link inside it is clicked
    const drawerLinks = drawer.querySelectorAll('a');
    drawerLinks.forEach((link) => {
        link.addEventListener('click', closeDrawer);
    });
});