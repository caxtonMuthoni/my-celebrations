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

// acordion

const acc = document.getElementsByClassName("faqs__accordion");
if (acc.length > 0) {
    let i;
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            this.classList.toggle("faqs__accordion--active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
}
