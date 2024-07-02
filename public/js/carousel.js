document.addEventListener("DOMContentLoaded", function () {
    var carousel = document.getElementById("recommendedStoresCarousel");
    var carouselInstance = new bootstrap.Carousel(carousel, {
        interval: 5000,
        wrap: true,
        keyboard: true,
    });

    var dots = document.querySelectorAll(".carousel-custom-indicators .dot");

    carousel.addEventListener("slide.bs.carousel", function (e) {
        dots.forEach(function (dot) {
            dot.classList.remove("active");
        });
        dots[e.to].classList.add("active");
    });

    dots.forEach(function (dot, index) {
        dot.addEventListener("click", function () {
            carouselInstance.to(index);
        });
    });
});
