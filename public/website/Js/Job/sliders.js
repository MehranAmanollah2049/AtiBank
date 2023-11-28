let slider = new Swiper(".adversting_swiper", {

    slidesPerView: 2,
    spaceBetween: 25,
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
      1000: {

        slidesPerView: 2,
      }
    }
})

let slider2 = new Swiper(".ImageGallery", {

    slidesPerView: 1,
    spaceBetween: 25,
    navigation: {
      nextEl: ".gallery_btns.prev",
      prevEl: ".gallery_btns.next",
    },
  });