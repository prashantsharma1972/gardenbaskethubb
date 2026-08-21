// Jai Bajarang Bali
import AOS from 'aos';
AOS.init();

// Header animation Functionality 
let lastScrollY = window.scrollY;
const header = document.querySelector('.header-wrapper');
const toggleBtnMain = document.getElementById('toggle-btn');
const toggleBtn = document.getElementById('toggle-btn');
const sideNavbar = document.getElementById('side-navbar');
const toggleIcon = document.getElementById('toggle-icon');
const sideNavbarLinks = sideNavbar ? sideNavbar.querySelectorAll('a') : [];

let isOpen = false;

// Function to open the sidebar
const openNavbar = () => {
    if (sideNavbar && toggleIcon) {
        sideNavbar.style.right = '0';
        toggleIcon.innerHTML = `<span class="close-svg-inner-header"><svg xmlns="http://www.w3.org/2000/svg" height="329pt" viewBox="0 0 329.26933 329" width="329pt"><path d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0 " fill="#2B2B2B"/></svg></span>`;
        isOpen = true;
    }
};

// Function to close the sidebar
const closeNavbar = () => {
    if (sideNavbar && toggleIcon) {
        sideNavbar.style.right = '-300px';
        toggleIcon.innerHTML = `<svg width="83" height="94" viewBox="0 0 83 94" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M17 82.2666H5.72V81.1146L15.944 76.5866V77.0506L5.72 72.5226V71.3706H17V72.5866H7.432V72.1066L17 76.3786V77.2586L7.432 81.5466V81.0666H17V82.2666ZM17 65.3482H5.72L5.72 58.1482H6.808V64.0522H10.728V58.5002H11.832V64.0522H15.896V58.1482H17V65.3482ZM17 52.742H5.72V51.702L15.32 44.47V44.838H5.72V43.606H17V44.63L7.4 51.862V51.51H17V52.742ZM17.144 33.1409C17.144 34.6662 16.7547 35.8022 15.976 36.5489C15.1973 37.2849 14.0507 37.6529 12.536 37.6529H5.72V36.3409H12.472C13.6347 36.3409 14.5093 36.0849 15.096 35.5729C15.6827 35.0609 15.976 34.2502 15.976 33.1409C15.976 32.0955 15.6827 31.3009 15.096 30.7569C14.5093 30.2129 13.6347 29.9409 12.472 29.9409H5.72V28.6289H12.536C14.0507 28.6289 15.1973 29.0129 15.976 29.7809C16.7547 30.5382 17.144 31.6582 17.144 33.1409Z" fill="#2B2B2B"/>
        <path d="M76.3203 32.8999H32.6797V34.8098H76.3203V32.8999Z" fill="#2B2B2B"/>
        <path d="M76.3203 54.8159H32.6797V56.7258H76.3203V54.8159Z" fill="#2B2B2B"/>
        <path d="M76.3203 77.8159H32.6797V79.7258H76.3203V77.8159Z" fill="#2B2B2B"/>
    </svg>`;
    }
    isOpen = false;
};

// Toggle button click to open/close the sidebar
if (toggleBtn) {
    toggleBtn.addEventListener('click', (event) => {
        event.stopPropagation();
        isOpen ? closeNavbar() : openNavbar();
    });
}

// Close the sidebar when a link inside the sidebar is clicked
if (sideNavbarLinks && sideNavbarLinks.length > 0) {
    sideNavbarLinks.forEach(link => {
        link.addEventListener('click', closeNavbar);
    });
}

// Scroll event to show/hide the navbar and toggle button
window.addEventListener('scroll', () => {
    const currentScrollY = window.scrollY;

    if (currentScrollY <= 10) {
        if (header) header.classList.remove('hidden');
        if (toggleBtnMain) toggleBtnMain.classList.remove('show');
        closeNavbar();
    } else if (currentScrollY > lastScrollY) {
        if (header) header.classList.add('hidden');
        if (toggleBtnMain) toggleBtnMain.classList.add('show');
    }

    lastScrollY = currentScrollY;
});

// Close the sidebar when the user clicks anywhere outside of it
document.addEventListener('click', (event) => {
    if (isOpen && sideNavbar && !sideNavbar.contains(event.target) && event.target !== toggleBtn) {
        closeNavbar();
    }
});