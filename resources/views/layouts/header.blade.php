<header>
    <div class="jumbotron">
        <div class="bg active">
            <img src="/img/hotel_bg8.jpg" alt="Hotels">
        </div>
        <div class="bg">
            <img src="/img/hotel_bg7.jpg" alt="Hotels">
        </div>
        <div class="bg">
            <img src="/img/hotel_bg7.jpg" alt="Hotels">
        </div>
        @include('layouts.partials.navbar')
        <div class="title">
            <p class="welcome">
                Welcome To
            </p>
            <h1>Nang Ayan</h1>
            <h2>Hotels</h2>
            <p class="description">
                Book your stay and enjoy Luxury <br>
                redefined at the most affordable rates
            </p>
            <div>
                <a href="/suites"><button type="button">Book Now</button></a>
            </div>
        </div>
    </div>
</header>

<script type="text/javascript">
    var slides = document.querySelectorAll('.bg');
    var btns = document.querySelectorAll('.btn');
    let currentSlide = 0;
    var sliderAuto;

    // Manual Navigation
    var manualNav = function(manual) {
        slides.forEach((slide) => {
            slide.style.opacity = 0;
            slide.classList.remove('active');

            btns.forEach((btn) => {
                btn.classList.remove('active');
            });
        });

        slides[manual].style.opacity = 1;
        slides[manual].classList.add('active');
        btns[manual].classList.add('active');

        // Reset interval untuk memulai otomatis dari awal
        clearInterval(sliderAuto);
        startSliderAuto();
    }

    btns.forEach((btn, i) => {
        btn.addEventListener("click", () => {
            manualNav(i);
            currentSlide = i;
        });
    });

    // auto image slider (jangan dipake kalo mau pake manual)
    function startSliderAuto() {
        sliderAuto = setInterval(() => {
            slides.forEach((slide) => {
                slide.style.opacity = 0;
                slide.classList.remove('active');

                btns.forEach((btn) => {
                    btn.classList.remove('active');
                });
            });

            currentSlide++;

            if (currentSlide >= slides.length) {
                currentSlide = 0;
            }

            slides[currentSlide].style.opacity = 1;
            slides[currentSlide].classList.add('active');
            btns[currentSlide].classList.add('active');
        }, 10000); // interval ganti gambar dalam ms
    }

    // Memulai proses otomatis saat halaman dimuat
    startSliderAuto();
</script>