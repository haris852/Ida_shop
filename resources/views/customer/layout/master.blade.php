<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Costum CSS -->
    <link rel="stylesheet" href="{{ asset('customer_asset/css/style.css') }}">
    <!-- AOS Animate -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Icon -->
    <link rel="icon" href="{{ asset('customer_asset/img/logo.svg') }}">
    <title>
        {{config('app.name')}}
    </title>
</head>

<body>
    <!-- Navbar Section Open -->
    <nav class="navbar navbar-expand-lg sticky-top bg-white">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('customer_asset/img/logo.svg') }}" class="me-3" alt="brand">
                <span class="text-dark">
                    {{config('app.name')}}
                </span>
            </a>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class='bx bx-menu'></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.html#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html#menu">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html#newslatter">Newslatter</a>
                    </li>
                </ul>
                <a href="" class="btn btn-primary shadow-none">Contact</a>
            </div>
        </div>
    </nav>
    <!-- Navbar Section Close -->

    <!-- Home Section Open -->
    <section class="home" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="home-content" data-aos="fade-up" data-aos-duration="1000">
                        <p class="badge fs-6 fw-normal bg-primary-light text-primary"> You have to try it 😋</p>
                        <h1 class="text-home-bold fw-bold text-dark mt-1">
                            For you, we serve the best food & <span class="text-primary">delicious</span>
                        </h1>
                        <h4 class="text-home-reguler fw-normal text-secondary">
                            We found a concept that fits and deserves to be served in a restaurant so that people can
                            feel it!
                        </h4>
                        <div class="home-btn mt-5">
                            <a href="#" class="btn btn-primary shadow-none">Order now</a>
                            <a href="#" class="btn btn-video-play">
                                <i class='bx bx-play'></i>
                            </a>
                            <span class="video-play text-dark">See video</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="home-img" data-aos="fade-up" data-aos-duration="2000">
                        <img src="{{ asset('customer_asset/img/home-img.svg') }}" class="w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Home Section Close -->

    <!-- Services Section Open -->
    <section class="services text-center">
        <div class="container">
            <span class="text-primary">Services</span>
            <h2 class="fw-bold text-dark mt-3">Our best services</h2>
            <div class="row">
                <div class="col-lg-4 col-md-6 content mt-5" data-aos="fade-up" data-aos-duration="1000">
                    <img src="{{ asset('customer_asset/img/services-1.svg') }}" alt="">
                    <h5 class="services-title text-dark mt-4">Fastest delivery</h5>
                    <p class="text-secondary mt-3">We can deliver delicious ready-to-eat meals quickly to your
                        doorstep.
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 content mt-5" data-aos="fade-up" data-aos-duration="2000">
                    <img src="{{ asset('customer_asset/img/services-2.svg') }}" alt="">
                    <h5 class="services-title text-dark mt-4">Affordable prices</h5>
                    <p class="text-secondary mt-3">Every food we provide has an affordable price and according to
                        taste.
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 content mt-5" data-aos="fade-up" data-aos-duration="3000">
                    <img src="{{ asset('customer_asset/img/services-3.svg') }}" alt="">
                    <h5 class="services-title text-dark mt-4">Delicious & hygienic</h5>
                    <p class="text-secondary mt-3">In every food, we serve it with the best recipe so that it tastes
                        good.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section Close -->

    <!-- About Section Open -->
    <section class="about" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="gallery-img mt-3" data-aos="fade-up" data-aos-duration="1000">
                                <img src="{{ asset('customer_asset/img/about-img.svg') }}" class="w-100"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="about-content" data-aos="fade-up" data-aos-duration="2000">
                        <span class="text-primary">About</span>
                        <h2 class="fw-bold text-dark mt-3">Food gallery on our menu</h2>
                        <p class="text-secondary mt-3">
                            Our food gallery contains a collection of pictures that we take
                            when customers order food, we have a large selection of delicious food and drinks with
                            various variants and affordable prices, you can see them here.
                        </p>
                        <a href="#" class="btn btn-primary shadow-none mt-5">Load more</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section Close -->

    <!-- Menu Section Open -->
    <section class="menu" id="menu">
        <div class="container">
            <span class="text-primary">Our menu</span>
            <h2 class="fw-bold text-dark mt-3">Menu of the week</h2>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="card-menu bg-white mt-3" data-aos="fade-up" data-aos-duration="1000">
                        <div class="item">
                            <img src="{{ asset('customer_asset/img/menu-1.svg') }}" alt="">
                            <h5 class="menu-title text-dark mt-3">Pancake fluffy</h5>
                            <p class="text-secondary mt-2">With caramel and extra honey</p>
                            <h4 class="text-primary fw-bold mt-4">$20.00</h4>
                            <a href="#" class="btn btn-cart shadow-none text-white bg-primary"><i
                                    class='bx bx-cart fs-5'></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card-menu bg-white mt-3" data-aos="fade-up" data-aos-duration="2000">
                        <div class="item">
                            <img src="{{ asset('customer_asset/img/menu-2.svg') }}" alt="">
                            <h5 class="menu-title text-dark mt-3">Veggie fried rice</h5>
                            <p class="text-secondary mt-2">With celery and half-boiled eggs</p>
                            <h4 class="text-primary fw-bold mt-4">$18.50</h4>
                            <a href="#" class="btn btn-cart shadow-none text-white bg-primary"><i
                                    class='bx bx-cart fs-5'></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card-menu bg-white mt-3" data-aos="fade-up" data-aos-duration="3000">
                        <div class="item">
                            <img src="{{ asset('customer_asset/img/menu-3.svg') }}" alt="">
                            <h5 class="menu-title text-dark mt-3">Meat egg rice</h5>
                            <p class="text-secondary mt-2">With different meat variations</p>
                            <h4 class="text-primary fw-bold mt-4">$35.99</h4>
                            <a href="#" class="btn btn-cart shadow-none text-white bg-primary"><i
                                    class='bx bx-cart fs-5'></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Menu Section Close -->

    <!-- Testimonials Section Open -->
    <section class="testimonials text-center">
        <div class="container">
            <span class="text-primary">Testimonials</span>
            <h2 class="fw-bold text-dark mt-3">What our customers say?</h2>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active rounded-circle bg-primary" aria-current="true"
                                aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                class="rounded-circle bg-primary" aria-label="Slide 2"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="content-testimonials mt-5" data-aos="fade-up" data-aos-duration="1000">
                                    <img class="rounded-circle" src="{{asset('customer_asset/img/img-testimonials-1.svg')}}"
                                        style="width: 80px;">
                                    <h5 class="name-testimonials text-dark mt-3">Ananda Ayu Gempita</h5>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star-half'></i>
                                    <p class="text-secondary mt-3">I love the food here. The atmosphere is
                                        comfortable and every time I come here it is always crowded with people.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="content-testimonials mt-5" data-aos="fade-up" data-aos-duration="1000">
                                    <img class="rounded-circle" src="{{asset('customer_asset/img/img-testimonials-2.svg')}}"
                                        style="width: 80px;">
                                    <h5 class="name-testimonials text-dark mt-3">Alya Farhana</h5>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <p class="text-secondary mt-3">I really like the food here, it's delicious
                                        and the price is very affordable. I often come here with my friends on
                                        weekends. Love it!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials Section Close -->


    <!-- Gallery Section Open -->
    <section class="gallery" id="gallery">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="gallery-content" data-aos="fade-up" data-aos-duration="1000">
                                <span class="text-primary">Gallery</span>
                                <h2 class="fw-bold text-dark mt-3">Food gallery on our menu</h2>
                                <p class="text-secondary mt-3">
                                    Our food gallery contains a collection of pictures that we take
                                    when customers order food, we have a large selection of delicious food and drinks
                                    with
                                    various variants and affordable prices, you can see them here.
                                </p>
                                <a href="#" class="btn btn-primary shadow-none mt-5">Load more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="gallery-img" data-aos="fade-up" data-aos-duration="2000">
                        <img src="{{asset('customer_asset/img/gallery-img.svg')}}" class="w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Gallery Section Close -->


    <!-- Newslatter Section Open -->
    <section class="newslatter" id="newslatter">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="newslatter-content bg-primary text-center" data-aos="fade-up"
                        data-aos-duration="1000">
                        <h2 class="title-newslatter fw-bold text-white">Hurry up! Subscribe our newslatter and get 25%
                            off</h2>
                        <p class="text-white mt-3">Limited time offer for this month. No credit card required</p>
                        <div class="form-newslatter mt-5">
                            <input type="email" class="form-control w-50 shadow-none"
                                placeholder="elfiranurul02@gmail.com">
                            <a href="#" class="btn btn-primary-light shadow-none">Subscribe</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Newslatter Section Close -->

    <!-- Footer Section Open -->
    <footer class="footer-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-5">
                    <div class="col-md-10">
                        <a href="#" class="footer-brand">
                            <img src="{{ asset('customer_asset/img/logo.svg') }}" class="me-3" alt="brand">
                            <span class="text-dark">Foodly</span>
                            <p class="text-secondary mt-3">Foodly is a restaurant that has been around since 1988 in
                                South Jakarta. We serve the best quality food for you.</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="footer-content">
                                <span>Services</span>
                                <ul class="footer-link mt-3 list-unstyled">
                                    <li><a href="#" class="py-1 d-block">Delivery</a></li>
                                    <li><a href="#" class="py-1 d-block">Pricing</a></li>
                                    <li><a href="#" class="py-1 d-block">Fast food</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="footer-content">
                                <span>Info</span>
                                <ul class="footer-link mt-3 list-unstyled">
                                    <li><a href="#" class="py-1 d-block">Promo date</a></li>
                                    <li><a href="#" class="py-1 d-block">Event</a></li>
                                    <li><a href="#" class="py-1 d-block">Careers</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="footer-content">
                                <span>Contact</span>
                                <ul class="footer-link mt-3 list-unstyled">
                                    <li><a href="#" class="py-1 d-block">South Jakarta - Indonesia</a></li>
                                    <li><a href="#" class="py-1 d-block">+0628-2267-9981</a></li>
                                    <li><a href="#" class="py-1 d-block">contact@foodly.co.id</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <p class="copyright text-secondary text-center">
                    Copyright &copy; 2022 All rights reserved | By
                    <a class="text-primary" href="https://ilmaelfiraa.github.io">Elfira Nurul Ilma</a>
                </p>
            </div>
        </div>
    </footer>
    <!-- Footer Section Close -->

    <!-- AOS Animate on Scroll -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Add Drop Shadow on Scroll -->
    <script>
        window.addEventListener('scroll', (e) => {
            const nav = document.querySelector('.navbar');
            if (window.pageYOffset > 0) {
                nav.classList.add("drop-shadow");
            } else {
                nav.classList.remove("drop-shadow");
            }
        });
    </script>

    <script>
        AOS.init();
    </script>

</body>

</html>
