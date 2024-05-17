let search=document.querySelector('.search-box');
let menu = document.querySelector('.navbar');

document.querySelector('#search-icon').onclick=()=>{
    search.classList.toggle('active');
    menu.classList.remove('active');
}


 
document.querySelector('#menu-icon').onclick=()=>{
    menu.classList.toggle('active');
    search.classList.remove('active');
}
//hide menu and search box on scroll
window.onscroll=()=>{
    menu.classList.remove('active');
    search.classList.remove('active');
}

//header
let header = document.querySelector('header');
window.addEventListener('scroll', () => {
    header.classList.toggle('shadow', window.scrollY > 0);
});

const sr = ScrollReveal({
    distance: '60px',
    duration: 2500,
    delay: 400,
    reset: true
});

// Fonction pour calculer la vitesse de défilement
function getScrollSpeed() {
    let lastScrollTop = 0;
    let delta = 50;
    let latestTimestamp = null;

    return function () {
        let now = new Date().getTime();
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (latestTimestamp && (now - latestTimestamp <= delta)) {
            return Math.abs(scrollTop - lastScrollTop);
        } else {
            lastScrollTop = scrollTop;
            latestTimestamp = now;
            return 0;
        }
    };
}

const scrollSpeed = getScrollSpeed();

function revealWithSpeed(element, options) {
    let speed = scrollSpeed();

    if (speed > 100) { // Adjust this threshold as needed
        sr.reveal(element, { delay: 0, ...options }); // Reveal instantly
    } else {
        sr.reveal(element, options); // Reveal with delay as usual
    }
}

revealWithSpeed('.home-text', { delay: 100, origin: 'top' });
revealWithSpeed('.form-container form', { delay: 100, origin: 'left' });
revealWithSpeed('.heading', { delay: 600, origin: 'top' });
revealWithSpeed('.ride-container .box', { delay: 100, origin: 'top' });
revealWithSpeed('.car-container .box', { delay: 100, origin: 'top' });
revealWithSpeed('.reviews-container .box', { delay: 100, origin: 'top' });
revealWithSpeed('.about-container', { delay: 100, origin: 'top' });
revealWithSpeed('.car-container .box', { delay: 100, origin: 'top' });
revealWithSpeed('.footer-container .footer-box', { delay: 100, origin: 'top' });



    

  