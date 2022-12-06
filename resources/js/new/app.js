window.onscroll = function () { tooggleNavbar() };

function tooggleNavbar() {
    const navbar = document.querySelector('.nav')
    if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
        navbar.classList.add('nav__bg-white')
    } else {
        navbar.classList.remove('nav__bg-white')
    }
}

// menu toogle
const menuIcon = document.querySelector('.nav__icon');
menuIcon.addEventListener('click', function () {
    const navbar = document.querySelector('.nav')
    if (navbar.classList.contains('nav__nav-open')) {
        navbar.classList.remove('nav__nav-open')
    } else {
        navbar.classList.add('nav__nav-open')
    }
})
