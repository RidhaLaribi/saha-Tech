<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>My profile</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap"
        rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/bootstrap-icons.css" rel="stylesheet">

    <link href="css/profile.css" rel="stylesheet">
    <!--

TemplateMo 590 topic listing

https://templatemo.com/tm-590-topic-listing

calendar links-->

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link href='fullcalendar/packages/core/main.css' rel='stylesheet' />
    <link href='fullcalendar/packages/daygrid/main.css' rel='stylesheet' />


    <!-- Bootstrap CSS -->


    <!-- Style -->
    <link rel="stylesheet" href="css/calendstyle.css">

</head>

<body id="top">

    <main>

        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <i class="bi-back"></i>
                    <span>SehaTech</span>
                </a>

                <div class="d-lg-none ms-auto me-4">


                    <a href="#top" class="navbar-icon b-notification smoothscroll"></a>


                </div>


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-5 me-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_1">My Card</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_2">More information</a>
                        </li>






                    </ul>
                    <div class="d-none d-lg-block">
                        <a href="#top" class="navbar-icon b-notification smoothscroll">
                            <i class="bi bi-bell"></i> <!-- Bootstrap bell icon -->
                        </a>


                    </div>
                </div>
            </div>
        </nav>



        <section class="hero-section d-flex justify-content-center align-items-center" id="section_1" class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-lg-6 mb-4 mb-lg-0">
                        <div class="card mb-3" style="border-radius: .5rem;">
                            <div class="row g-0">
                                <div class="col-md-4 gradient-custom text-center text-white"
                                    style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                    <img src="https://t4.ftcdn.net/jpg/00/65/77/27/240_F_65772719_A1UV5kLi5nCEWI0BNLLiFaBPEkUbv5Fv.jpg"
                                        alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                                    <h5> {{$user->name}} </h5>
                                    <p>patient</p>
                                    <i class="far fa-edit mb-5"></i>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-4">
                                        <h6>info</h6>
                                        <hr class="mt-0 mb-4">
                                        <div class="row pt-1">
                                            <div class="col-6 mb-3">
                                                <h6>Email</h6>
                                                <p class="text-muted">info@example.com</p>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <h6>Phone</h6>
                                                <p class="text-muted">123 456 789</p>
                                            </div>
                                        </div>
                                        <h6></h6>
                                        <hr class="mt-0 mb-4">
                                        <div class="row pt-1">
                                            <div class="col-6 mb-3">
                                                <h6>age</h6>
                                                <p class="text-muted">44</p>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <h6>last doctor's visit</h6>
                                                <p class="text-muted"></p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                                            <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                                            <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="featured-section">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                        <div class="custom-block bg-white shadow-lg">
                            <a href="topics-detail.html">
                                <div class="d-flex">
                                    <div>
                                        <h5 class="mb-2">Next Appointment </h5>

                                        <p class="mb-0">Monday, March 31 at 8 AM</p>
                                    </div>

                                    <span class="badge bg-design rounded-pill ms-auto">37</span>
                                </div>

                                <img src="images/topics/undraw_Remote_design_team_re_urdx.png"
                                    class="custom-block-image img-fluid" alt="">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="custom-block custom-block-overlay">
                            <div class="d-flex flex-column h-100">
                                <img src="" class="custom-block-image img-fluid" alt="">

                                <div class="custom-block-overlay-text d-flex">
                                    <div>
                                        <h5 class="text-white mb-2">Today</h5>

                                        <p class="text-white"></p>

                                        <a href="topics-detail.html" class="btn custom-btn mt-2 mt-lg-3">Learn More</a>
                                    </div>

                                </div>

                                <div class="social-share d-flex">



                                </div>

                                <div class="section-overlay"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="explore-section section-padding" id="section_2">
            <div class="container">
                <div class="row">

                    <div class="col-12 text-center">
                        <h2 class="mb-4">Mon Dossier</h1>
                    </div>

                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="design-tab" data-bs-toggle="tab"
                                data-bs-target="#design-tab-pane" type="button" role="tab"
                                aria-controls="design-tab-pane" aria-selected="true">Calendar</button>
                        </li>



                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="marketing-tab" data-bs-toggle="tab"
                                data-bs-target="#marketing-tab-pane" type="button" role="tab"
                                aria-controls="marketing-tab-pane" aria-selected="false">medical file</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="music-tab" data-bs-toggle="tab"
                                data-bs-target="#music-tab-pane" type="button" role="tab" aria-controls="music-tab-pane"
                                aria-selected="false">Members</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="finance-tab" data-bs-toggle="tab"
                                data-bs-target="#finance-tab-pane" type="button" role="tab"
                                aria-controls="finance-tab-pane" aria-selected="false">add member</button>
                        </li>



                        <!--<li class="nav-item" role="presentation">
                            <button class="nav-link" id="education-tab" data-bs-toggle="tab"
                                data-bs-target="#education-tab-pane" type="button" role="tab"
                                aria-controls="education-tab-pane" aria-selected="false">Education</button>
                        </li>-->
                    </ul>
                </div>
            </div>

            <div class="container">
                <div class="row">

                    <div class="col-12">
                        <div class="tab-content" id="myTabContent">


                            <div class="tab-pane fade show active" id="design-tab-pane" role="tabpanel"
                                aria-labelledby="design-tab" tabindex="0">

                                <div class="content">
                                    <div id='calendar'></div>
                                </div>
                                <script src='fullcalendar/packages/core/main.js'></script>
                                <script src='fullcalendar/packages/interaction/main.js'></script>
                                <script src='fullcalendar/packages/daygrid/main.js'></script>

                                <script>


                                    document.addEventListener('DOMContentLoaded', function () {
                                        var calendarEl = document.getElementById('calendar');

                                        var calendar = new FullCalendar.Calendar(calendarEl, {
                                            plugins: ['interaction', 'dayGrid'],
                                            defaultDate: '2025-03-19',
                                            editable: true,
                                            eventLimit: true, // allow "more" link when too many events
                                            events: [

                                                /* {
                                                     title: 'Long Event',
                                                     start: '2025-12-07',
                                                     end: '2025-12-10',
                                                     url: 'http://google.com/',
 
                                                 },*/

                                                @foreach ($r as $re)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           {
                                                        title: 'tbib',
                                                        start: '{{$re->rendezvous}}',
                                                        url: 'https://youtube.com/',
                                                    },
                                                @endforeach

                                               
                                               
                                            ]
                                        });

                                        calendar.render();
                                    });

                                </script>





                            </div>

                            <div class="tab-pane fade" id="music-tab-pane" role="tabpanel" aria-labelledby="music-tab"
                                tabindex="0">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a href="topics-detail.html">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Father</h5>

                                                        <p class="mb-0">Lorem ipsum dolor sit amet consectetur
                                                            adipisicing elit. Enim, laudantium?</p>
                                                    </div>

                                                </div>

                                                <img src="https://t4.ftcdn.net/jpg/00/65/77/27/240_F_65772719_A1UV5kLi5nCEWI0BNLLiFaBPEkUbv5Fv.jpg"
                                                    class="custom-block-image img-fluid" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a href="topics-detail.html">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Son</h5>

                                                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur
                                                            adipisicing elit. Officia, inventore.</p>
                                                    </div>

                                                </div>

                                                <img src="https://t4.ftcdn.net/jpg/00/65/77/27/240_F_65772719_A1UV5kLi5nCEWI0BNLLiFaBPEkUbv5Fv.jpg"
                                                    class="custom-block-image img-fluid" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a href="topics-detail.html">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Brother</h5>

                                                        <p class="mb-0"> Lorem, ipsum dolor sit amet consectetur
                                                            adipisicing e</p>
                                                    </div>

                                                </div>

                                                <img src="https://t4.ftcdn.net/jpg/00/65/77/27/240_F_65772719_A1UV5kLi5nCEWI0BNLLiFaBPEkUbv5Fv.jpg"
                                                    class="custom-block-image img-fluid" alt="">
                                            </a>
                                        </div>
                                    </div>





                                </div>
                            </div>

                            <div class="tab-pane fade" id="marketing-tab-pane" role="tabpanel"
                                aria-labelledby="marketing-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-3">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a id="showR" href="">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Medical Appointments</h5>

                                                        <p class="mb-0">Lorem Ipsum dolor sit amet consectetur</p>
                                                    </div>

                                                </div>

                                                <img src="images/topics/undraw_online_ad_re_ol62.png"
                                                    class="custom-block-image img-fluid" alt="">
                                            </a>
                                        </div>
                                    </div>


                                    <div id="mesrendivous" class="col-lg-4 col-md-6 col-12 mb-4 mesrendivous">
                                        <div class="custom-block bg-white " style=" overflow-y: auto; ">

                                            <div class="d-flex">
                                                <div style=" overflow-y: auto; ">

                                                    <a href="" id="ret_rend" style="right: 0%" class="retour-button">
                                                        Retour
                                                    </a>



                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">specialite</th>
                                                                <th scope="col">name</th>
                                                                <th scope="col">date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @if (!$r->isEmpty())

                                                                @foreach ($r as $re)

                                                                    <tr>
                                                                        <th scope="row">1</th>
                                                                        <td>Mark</td>
                                                                        <td>Otto</td>
                                                                        <td>
                                                                            {{substr($re->rendezvous, 0, 10)}}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                            @else
                                                                <tr>
                                                                    <th scope="row">1</th>
                                                                    <td>No dates</td>
                                                                </tr>


                                                            @endif


                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                    <script>
                                        const divrend = document.getElementById('mesrendivous');
                                        const ret_rend = document.getElementById('ret_rend');

                                        const link = document.getElementById('showR');
                                        link.addEventListener('click', function (e) {

                                            e.preventDefault();

                                            divrend.style.transform = 'translateX(500px)';


                                        });
                                        const divrend1 = document.getElementById('mesrendivous');

                                        ret_rend.addEventListener('click', function (e) {

                                            e.preventDefault();
                                            divrend.style.transform = 'translateX(-500px)';


                                        });

                                    </script>



                                    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-3">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a href="topics-detail.html">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Files</h5>

                                                        <p class="mb-0">Lorem Ipsum dolor sit amet consectetur</p>
                                                    </div>

                                                </div>

                                                <img src="images/topics/undraw_Group_video_re_btu7.png"
                                                    class="custom-block-image img-fluid" alt="">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a id="showN" href="">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Notes</h5>

                                                        <p class="mb-0">Lorem Ipsum dolor sit amet consectetur</p>
                                                    </div>

                                                </div>

                                                <img src="images/topics/undraw_viral_tweet_gndb.png"
                                                    class="custom-block-image img-fluid" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div id="mesnotes" class="col-lg-4 col-md-6 col-12 mb-4 mesnotes">
                                        <div class="custom-block bg-white " style=" overflow-y: auto; ">

                                            <div class="d-flex">
                                                <div style=" overflow-y: auto; ">

                                                    <a href="" id="ret_not" class="retour-button">
                                                        Retour
                                                    </a>



                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">specialite</th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">note</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">1</th>
                                                                <td>Mark</td>
                                                                <td>Otto</td>
                                                                <td>@mdo</td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">1</th>
                                                                <td>Mark</td>
                                                                <td>Otto</td>
                                                                <td>@mdo</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">2</th>
                                                                <td>Jacob</td>
                                                                <td>Thornton</td>
                                                                <td>@fat</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">3</th>
                                                                <td>Larry</td>
                                                                <td>the Bird</td>
                                                                <td>@twitter</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                            <script>
                                                const divnot = document.getElementById('mesnotes');
                                                const ret_not = document.getElementById('ret_not');

                                                const linkn = document.getElementById('showN');
                                                linkn.addEventListener('click', function (e) {

                                                    e.preventDefault();
                                                    console.log("fdksj");

                                                    divnot.style.transform = 'translateX(-500px)';


                                                });

                                                ret_not.addEventListener('click', function (e) {

                                                    e.preventDefault();
                                                    divnot.style.transform = 'translateX(500px)';


                                                });

                                            </script>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="finance-tab-pane" role="tabpanel"
                                aria-labelledby="finance-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12 mb-4 mb-lg-0">
                                        <div class="custom-block bg-white shadow-lg">
                                            <!--  <a href="topics-detail.html">                rani mna7i -->
                                            <div class="d-flex">
                                                <div>
                                                    <h5 class="mb-2">remove a member</h5>
                                                    <p class="mb-0"></p>
                                                    <form class="person-form-container person-form">
                                                        <label for="person">Choose a Person:</label>
                                                        <select id="person" name="person">
                                                            <option value="">Select...</option>
                                                            <option value="person1">Father</option>
                                                            <option value="person2">Mother</option>
                                                            <option value="person3">son</option>
                                                        </select>
                                                        <button type="submit">Submit</button>
                                                    </form>


                                                </div>


                                            </div>


                                            <!--</a>-->
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="custom-block custom-block-overlay">
                                            <div class="d-flex flex-column h-100">


                                                <div class="custom-block-overlay-text d-flex">
                                                    <div>
                                                        <h5 class="text-white mb-2">Add member</h5>

                                                        <form class="custom-form">
                                                            <input type="text" placeholder="Full Name"
                                                                class="custom-input">
                                                            <input type="text" placeholder="relation"
                                                                class="custom-input">

                                                            <input type="number" placeholder="Age" class="custom-input">
                                                            <select class="custom-input">
                                                                <option value="" disabled selected>Gender</option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                            </select>

                                                            <label for="file-upload" class="custom-file-label">
                                                                Choose Files
                                                                <input type="file" id="file-upload"
                                                                    class="custom-file-input" multiple>
                                                            </label>

                                                            <button type="submit" class="custom-button">Submit</button>
                                                        </form>



                                                    </div>


                                                </div>

                                                <div class="social-share d-flex">
                                                    <p class="text-white me-4"></p>




                                                </div>

                                                <div class="section-overlay"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




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

                    <p class="copyright-text mt-lg-5 mt-4">Copyright © 2048 Topic Listing Center. All rights reserved.
                        <br><br>Design: <a rel="nofollow" href="https://templatemo.com" target="_blank">TemplateMo</a>
                    </p>

                </div>

            </div>
        </div>
    </footer>


    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/click-scroll.js"></script>
    <script src="js/custom.js"></script>


</body>

</html>