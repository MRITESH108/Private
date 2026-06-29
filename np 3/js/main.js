window.addEventListener("scroll", function () {

    const navbar = document.querySelector(".custom-navbar");

    if (window.scrollY > 80) {

        navbar.classList.add("shadow-lg");

    } else {

        navbar.classList.remove("shadow-lg");

    }

});


const heroSwiper = new Swiper(".heroSwiper",{

    loop:true,

    effect:"fade",

    speed:1200,

    autoplay:{

        delay:5000,

        disableOnInteraction:false

    },

    pagination:{

        el:".swiper-pagination",

        clickable:true

    },

    navigation:{

        nextEl:".swiper-button-next",

        prevEl:".swiper-button-prev"

    }

});

const lightbox = GLightbox({
    selector: '.glightbox'
});