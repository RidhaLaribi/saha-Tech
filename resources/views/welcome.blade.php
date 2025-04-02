<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>SehaTech</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">


    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap"
        rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/bootstrap-icons.css" rel="stylesheet">

    <link href="css/templatemo-topic-listing.css" rel="stylesheet">

    <link rel="stylesheet" href="css/carousel.css">

    <link rel="stylesheet" href="css/owl.theme.carousel.css">

    <link rel="stylesheet" href="css/templatecarousel.css">


    <link rel="stylesheet" href="css/owl.theme.carousel.css">

    <link rel="stylesheet" href="css/templatecarousel.css">


</head>

<body id="top">

    <main>

        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <i class="bi-back"></i>
                    <span>Sehatech</span>
                </a>

                <div class="d-lg-none ms-auto me-4">


                    <a href="#top" class="navbar-icon bi-person smoothscroll"></a>


                </div>


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-5 me-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_1">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="{{ route('medecin') }}">medecins</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_3">How it works</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_4">FAQs</a>
                        </li>


                    </ul>

                    <!-- Fixed: ID syntax and class attribute -->
                    <a href="{{ url('/loginp') }}" id="smoothLoginButton" class="praticien-link" style="
    margin-right: 20px;
    color: white;
    font-family: 'Montserrat', sans-serif;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.3s ease;
" onmouseover="this.style.color='#ffffff';" onmouseout="this.style.color='#002b3a';">
                        Vous êtes praticien !
                    </a>

                    <script>
                        // Fixed: Add CSS transition to body first
                        document.body.style.transition = 'opacity 0.5s ease';

                        // Fixed: Match JavaScript ID with HTML ID (case-sensitive)
                        document.getElementById('smoothLoginButton').addEventListener('click', function (event) {
                            event.preventDefault();
                            const targetUrl = this.href;

                            // Fixed: Match transition duration with timeout
                            document.body.style.opacity = '0';

                            setTimeout(() => {
                                window.location.href = targetUrl;
                            }, 500); // Now matches 0.5s transition
                        });
                    </script>

                    <style>
                        /* Required for initial opacity state */
                        body {
                            opacity: 1;
                        }

                        /* Fixed hover color behavior */
                        .praticien-link:hover {
                            color: #ffffff !important;
                            /* Ensures hover color overrides */
                        }
                    </style>
                    @if ($id == null)
                        <style>
                            body {
                                opacity: 1;
                                transition: opacity 0.3s ease;
                            }

                            .auth-button {
                                display: inline-block;
                                padding: 0.5rem 1.5rem;
                                border-radius: 100px;
                                border: 1.5px solid #80d0c7;
                                color: #80d0c7;
                                background: #ffffff;
                                font-family: 'Montserrat', sans-serif;
                                font-size: 0.95rem;
                                font-weight: 600;
                                text-decoration: none;
                                cursor: pointer;
                                transition: all 0.3s ease;
                                line-height: 1.2;
                                min-width: 120px;
                                text-align: center;
                            }

                            .auth-button:hover {
                                background: #13547a;
                                color: #ffffff;
                                border-color: #13547a;
                                transform: translateY(-1px);
                                box-shadow: 0 4px 8px rgba(0, 43, 58, 0.1);
                            }

                            .auth-button:active {
                                transform: translateY(0);
                                box-shadow: none;
                            }

                            /* Fixed hover color behavior for praticien link */
                            .praticien-link:hover {
                                color: #ffffff !important;
                            }
                        </style>

                        <a href="{{ url('/login') }}" id="smoothLoginButton" class="auth-button">
                            S'inscrire
                        </a>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const smoothLoginButton = document.getElementById('smoothLoginButton');
                                if (smoothLoginButton) {
                                    smoothLoginButton.addEventListener('click', function (event) {
                                        event.preventDefault();
                                        const targetUrl = this.href;

                                        // Start fade-out
                                        document.body.style.opacity = '0';

                                        // After the transition (300ms), redirect
                                        setTimeout(() => {
                                            window.location.href = targetUrl;
                                        }, 300);
                                    });
                                }
                            });
                        </script>
                    @else
                        <div class="d-none d-lg-block">
                            <a href="{{ route('profile') }}" class="navbar-icon bi-person smoothscroll"></a>
                        </div>
                    @endif

                    <!-- Cleaned up closing tags -->
                </div>
            </div>
        </nav>


        <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
            <div class="container">
                <div class="row">

                    <div class="col-lg-8 col-12 mx-auto">
                        <h1 class="text-white text-center">Discover</h1>

                        <h6 class="text-center">...</h6>

                        <form method="get" class="custom-form mt-4 pt-2 mb-lg-0 mb-5" role="search">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bi-search" id="basic-addon1">

                                </span>

                                <input name="keyword" type="search" class="form-control" id="keyword" placeholder="..."
                                    aria-label="Search">

                                <button type="submit" class="form-control">Search</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>


        <section class="featured-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-12">
                        <div class="custom-block custom-block-overlay">
                            <div class="d-flex flex-column h-100">
                                <img src="images/businesswoman-using-tablet-analysis.jpg"
                                    class="custom-block-image img-fluid" alt="">

                                <div class="custom-block-overlay-text d-flex flex-column align-items-center">
                                    <form action="" id="aiForm" class="glass-form">
                                        <h5 class="text-white mb-3 " style="font-family: 'Lato ', sans-serif !important;
    font-weight: 600;">Feel free to ask our chatbot AI Jemy, your medical assistant.</h5>

                                        <div class="custom-form">
                                            <p id="responsechat" class="response-box text-white text-center mb-3"></p>

                                            <input type="text" id="prompt" name="prompt" class="form-control"
                                                placeholder="Ask a medical question..." required>

                                            <button type="submit" class="btn-submit">Ask</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="section-overlay"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <script>

            document.addEventListener("DOMContentLoaded", () => {
                document.getElementById("aiForm").addEventListener("submit", async function (event) {
                    event.preventDefault();

                    let prompt = document.getElementById("prompt").value;
                    let responseBox = document.getElementById("responsechat");
                    responseBox.innerText = "Loading...";

                    try {
                        const response1 = await fetch("https://server-7hqi.onrender.com/ask-ai", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({ prompt })
                        });

                        const data = await response1.json();
                        console.log(data);
                        responseBox.innerText = data.response;
                    } catch (error) {
                        responseBox.innerText = "Error in : " + error.message;
                    }
                });
            });
        </script>



        <section class="hero-section">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12">
                        <div class="text-center mb-5 pb-2">
                            <h1 class="text-white">our best doctors</h1>

                            <p class="text-white">Listen it everywhere. Explore your fav podcasts.</p>

                            <a href="#section_2" class="btn custom-btn smoothscroll mt-3">Start listening</a>
                        </div>

                        <div class="owl-carousel owl-theme">
                            <div class="owl-carousel-info-wrap item">
                                <img src="images/profile/young-doctor-getting-ready-work.jpg"
                                    class="owl-carousel-image img-fluid" alt="">

                                <div class="owl-carousel-info">
                                    <h4 class="mb-2">
                                        Candice

                                    </h4>

                                    <span class="badge">Storytelling</span>

                                    <span class="badge">Business</span>
                                </div>

                                <div class="social-share">
                                    <ul class="social-icon">
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-twitter"></a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-facebook"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="owl-carousel-info-wrap item">
                                <img src="images/profile/beautiful-young-female-doctor-looking-camera-office.jpg"
                                    class="owl-carousel-image img-fluid" alt="">

                                <div class="owl-carousel-info">
                                    <h4 class="mb-2">
                                        William

                                    </h4>

                                    <span class="badge">Creative</span>

                                    <span class="badge">Design</span>
                                </div>

                                <div class="social-share">
                                    <ul class="social-icon">
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-twitter"></a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-facebook"></a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-pinterest"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="owl-carousel-info-wrap item">
                                <img src="images/profile/close-up-health-worker.jpg"
                                    class="owl-carousel-image img-fluid" alt="">

                                <div class="owl-carousel-info">
                                    <h4 class="mb-2">Taylor</h4>

                                    <span class="badge">Modeling</span>

                                    <span class="badge">Fashion</span>
                                </div>

                                <div class="social-share">
                                    <ul class="social-icon">
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-twitter"></a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-facebook"></a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-pinterest"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="owl-carousel-info-wrap item">
                                <img src="images/profile/doctor-preparing-consult.jpg"
                                    class="owl-carousel-image img-fluid" alt="">

                                <div class="owl-carousel-info">
                                    <h4 class="mb-2">Nick</h4>

                                    <span class="badge">Acting</span>
                                </div>

                                <div class="social-share">
                                    <ul class="social-icon">
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-instagram"></a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-youtube"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="owl-carousel-info-wrap item">
                                <img src="images/profile/doctor-presenting-something-isolated-white-background.jpg"
                                    class="owl-carousel-image img-fluid" alt="">

                                <div class="owl-carousel-info">
                                    <h4 class="mb-2">
                                        Elsa

                                    </h4>

                                    <span class="badge">Influencer</span>
                                </div>

                                <div class="social-share">
                                    <ul class="social-icon">
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-instagram"></a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-youtube"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="owl-carousel-info-wrap item">
                                <img src="images/profile/portrait-hansome-young-male-doctor-man.jpg"
                                    class="owl-carousel-image img-fluid" alt="">

                                <div class="owl-carousel-info">
                                    <h4 class="mb-2">Chan</h4>

                                    <span class="badge">Education</span>
                                </div>

                                <div class="social-share">
                                    <ul class="social-icon">
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-linkedin"></a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-whatsapp"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>









        <section class="timeline-section section-padding" id="section_3">
            <div class="section-overlay"></div>

            <div class="container">
                <div class="row">

                    <div class="col-12 text-center">
                        <h2 class="text-white mb-4">How does it work?</h1>
                    </div>

                    <div class="col-lg-10 col-12 mx-auto">
                        <div class="timeline-container">
                            <ul class="vertical-scrollable-timeline" id="vertical-scrollable-timeline">
                                <div class="list-progress">
                                    <div class="inner"></div>
                                </div>

                                <li>
                                    <h4 class="text-white mb-3"> 1. Find Your Doctor & Book an Appointment</h4>

                                    <p class="text-white">Search for doctors and laboratories by specialty and location.
                                        Check reviews, availability, and book your appointment online in just a few
                                        clicks.
                                    </p>

                                    <div class="icon-holder">
                                        <i class="bi-search"></i>
                                    </div>
                                </li>

                                <li>
                                    <h4 class="text-white mb-3">2. Manage & Track Your Consultations</h4>

                                    <p class="text-white">Access your personal space to manage appointments, receive
                                        automatic email reminders, and view your medical history and documents.</p>

                                    <div class="icon-holder">
                                        <i class="bi-bookmark"></i>
                                    </div>
                                </li>

                                <li>
                                    <h4 class="text-white mb-3">3. Attend, Review &amp; Follow Up on Your Health</h4>

                                    <p class="text-white">Attend your appointment with confidence. After the
                                        consultation, leave a review for your doctor and benefit from follow-up services
                                        to ensure continuous care.</p>

                                    <div class="icon-holder">
                                        <i class="bi-book"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-5">
                        <p class="text-white">
                            Want to learn more?
                            <a href="#" class="btn custom-btn custom-border-btn ms-3">Check out Youtube</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>





    </main>

    <footer class="site-footer section-padding">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-12 mb-4 pb-2">
                    <a class="navbar-brand mb-2" href="index.html">
                        <i class="bi-back"></i>
                        <span>SehaTech</span>
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-6">
                    <h6 class="site-footer-title mb-3">Resources</h6>

                    <ul class="site-footer-links">
                        <li class="site-footer-link-item">
                            <a href="#" class="site-footer-link">Home</a>
                        </li>

                        <li class="site-footer-link-item">
                            <a href="#" class="site-footer-link">How it works</a>
                        </li>



                        <li class="site-footer-link-item">
                            <a href="#" class="site-footer-link">Contact</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4 col-6 mb-4 mb-lg-0">
                    <h6 class="site-footer-title mb-3">Information</h6>

                    <p class="text-white d-flex mb-1">
                        <a href="tel: 305-240-9671" class="site-footer-link">
                            305-240-9671
                        </a>
                    </p>

                    <p class="text-white d-flex">
                        <a href="mailto:info@company.com" class="site-footer-link">
                            info@company.com
                        </a>
                    </p>
                </div>

                <div class="col-lg-3 col-md-4 col-12 mt-4 mt-lg-0 ms-auto">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            English</button>


                    </div>

                    <p class="copyright-text mt-lg-5 mt-4">
                        <br><br>Design: <a rel="nofollow" href="https://templatemo.com" target="_blank">TemplateMo</a>
                    </p>

                </div>

            </div>
        </div>
    </footer>


    <!-- JAVASCRIPT FILES -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script defer src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('js/click-scroll.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>




    <script>
        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                center: true,
                items: 3.75,        // Number of items visible at once
                loop: true,      // Infinite loop
                margin: 20,      // Space between items
                nav: true,       // Show nav arrows
                dots: true,      // Show dot indicators
                autoplay: true,
                autoplayTimeout: 3000, // Or true if you want autoplay
                // any other options...
            });

        });
    </script>



</body>

</html>