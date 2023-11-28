let slider1 = new Swiper(".best_jobs_swiper", {

    slidesPerView: 2,
    spaceBetween: 20,
    loop: false,
    autoplay: true,
    autoplay: {
        delay: 6000,
        disableOnInteraction: false
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        490: {
            slidesPerView: 1.3,
        },
        660: {
            slidesPerView: 1.8,
        },
        750: {
            slidesPerView: 2,
        },
        1100: {
            slidesPerView: 3,
        },
        1135: {
            slidesPerView: 2,
        }
    },
})

let slider2 = new Swiper(".adversting_swiper", {

    slidesPerView: 2,
    spaceBetween: 25,
    loop: false,
    autoplay: true,
    autoplay: {
        delay: 6000,
        disableOnInteraction: false
    },
    pagination: {
        el: ".swiper-pagination",
        dynamicBullets: true,
        clickable: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        800: {
            slidesPerView: 2,
        }
    },
})
