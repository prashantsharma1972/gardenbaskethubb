import './reels.scss';
import './../../src-utilities/header';
import './../../src-utilities/footer';
import { initEcommerce } from './../../src-utilities/ecommerce.js';

initEcommerce();

document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.reel-card');
    const modal = document.getElementById('gbh-reel-modal');
    if (!modal) return;
    
    const closeBtn = modal.querySelector('.reel-modal-close');
    const overlay = modal.querySelector('.reel-modal-overlay');
    const titleEl = modal.querySelector('.reel-modal-title');
    const bodyEl = modal.querySelector('.reel-modal-body');

    const closeModal = () => {
        modal.classList.remove('active');
        bodyEl.innerHTML = '';
    };

    closeBtn.addEventListener('click', closeModal);
    overlay.addEventListener('click', closeModal);

    cards.forEach(card => {
        card.addEventListener('click', () => {
            const videoUrl = card.getAttribute('data-video');
            const title = card.getAttribute('data-title');
            
            titleEl.textContent = title || 'Reel';
            
            if (videoUrl) {
                if (videoUrl.includes('youtube') || videoUrl.includes('youtu.be')) {
                    bodyEl.innerHTML = `<iframe width="100%" height="100%" src="${videoUrl}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
                } else {
                    bodyEl.innerHTML = `<video src="${videoUrl}" controls autoplay style="width:100%;height:100%;object-fit:cover;"></video>`;
                }
            } else {
                bodyEl.innerHTML = '<p style="color:#fff;">Video not available.</p>';
            }
            
            modal.classList.add('active');
        });
    });
});
