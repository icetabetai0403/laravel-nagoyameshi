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

    // 初期状態で最初のドットをアクティブにする
    dots[0].classList.add("active");

    // オプション: スワイプでのスライド切り替えを有効にする（モバイル向け）
    var hammer = new Hammer(carousel);
    hammer.on("swipeleft", function () {
        carouselInstance.next();
    });
    hammer.on("swiperight", function () {
        carouselInstance.prev();
    });
});
