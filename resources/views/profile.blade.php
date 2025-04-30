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

    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link href="../css/bootstrap-icons.css" rel="stylesheet">

    <link href="../css/profile.css" rel="stylesheet">
    <!--

TemplateMo 590 topic listing

https://templatemo.com/tm-590-topic-listing

calendar links-->

    <link rel="stylesheet" href="../fonts/icomoon/style.css">

    <link href='../fullcalendar/packages/core/main.css' rel='stylesheet' />
    <link href='../fullcalendar/packages/daygrid/main.css' rel='stylesheet' />


    <!-- Bootstrap CSS -->


    <!-- Style -->
    <link rel="stylesheet" href="../css/calendstyle.css">

</head>

<body id="top">

    <main>

        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{route("home")}}">
                    <i class="bi-back"></i>
                    <span>SehaTech</span>
                </a>



                <div class="d-lg-none ms-auto me-4">
                    <a href="{{ route('logout') }}" class="navbar-icon b-logout"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> <!-- Bootstrap logout icon -->
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

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


                    {{-- <div class="d-none d-lg-block">
                        <a href="#top" class="navbar-icon b-notification smoothscroll">
                            <i class="bi bi-bell"></i> <!-- Bootstrap bell icon -->
                        </a>
                    </div> --}}
                    @if ($user->role == 'patient')



                        <x-notifications-dropdown />





                        <div class="d-none d-lg-block" style="padding-left: 5px">
                            <a href="#" class="navbar-icon b-notification smoothscroll"
                                onclick="event.preventDefault();document.getElementById('modify').submit()">
                                <i class="bi bi-pencil-square"></i> <!-- Bootstrap edit/modification icon -->
                            </a>
                            <form method="POST" action="{{ route('modify.toggle') }}" id="modify">
                                @csrf

                            </form>
                        </div>


                    @endif




                    <div class="d-none d-lg-block" style="padding-left: 5px">
                        <a href="{{ route('logout') }}" class="navbar-icon b-logout"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i> <!-- Bootstrap logout icon -->
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>

                </div>
            </div>
        </nav>


        @if(!session('modifying') || $user->role != 'patient')

            <section class="hero-section d-flex justify-content-center align-items-center" id="section_1" class="vh-100">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col col-lg-6 mb-4 mb-lg-0">
                            <div class="card mb-3" style="border-radius: .5rem;">
                                <div class="row g-0">
                                    <div class="col-md-4 gradient-custom text-center text-white"
                                        style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                        @if ($patients[session('id_p')]->pic == null)
                                            <img src="https://t4.ftcdn.net/jpg/00/65/77/27/240_F_65772719_A1UV5kLi5nCEWI0BNLLiFaBPEkUbv5Fv.jpg"
                                                alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                                        @else
                                            <a href="" id="changepic">
                                                <img src="{{asset('storage/' . $patients[session('id_p')]->pic)}}" alt=" Avatar"
                                                    class="img-fluid my-5"
                                                    style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 3px solid #000;" />
                                            </a>

                                        @endif



                                        <h5> {{$patients->get(session('id_p'))->name}} </h5>
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
                                                    <p class="text-muted">{{$patients->get(session('id_p'))->user->email}}
                                                    </p>
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <h6>Phone</h6>


                                                    <p class="text-muted">{{$patients->get(session('id_p'))->user->tel}}
                                                    </p>
                                                </div>
                                            </div>
                                            <h6></h6>
                                            <hr class="mt-0 mb-4">
                                            <div class="row pt-1">
                                                <div class="col-6 mb-3">
                                                    <h6>age</h6>
                                                    <p class="text-muted"> {{ $patients[session('id_p')]->age }} </p>
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <h6>Sexe</h6>
                                                    <p class="text-muted">{{ $patients[session('id_p')]->sexe }} </p>
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
        @else
            <form action="{{route('modify')}}" method="post" enctype="multipart/form-data">
                @csrf

                <section class="hero-section d-flex justify-content-center align-items-center" id="section_1"
                    class="vh-100">
                    <div class="container py-5 h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col col-lg-6 mb-4 mb-lg-0">
                                <div class="card mb-3" style="border-radius: .5rem;">
                                    <div class="row g-0">
                                        <div class="col-md-4 gradient-custom text-center text-white"
                                            style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                            @if ($patients[session('id_p')]->pic == null)
                                                <img src="https://t4.ftcdn.net/jpg/00/65/77/27/240_F_65772719_A1UV5kLi5nCEWI0BNLLiFaBPEkUbv5Fv.jpg"
                                                    alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                                            @else
                                                <img src="{{asset('storage/' . $patients[session('id_p')]->pic)}}" alt=" Avatar"
                                                    class="img-fluid my-5"
                                                    style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 3px solid #000;" />
                                            @endif

                                            <input type="file" name="pic" class="form-control">


                                            <h5> {{$patients[session('id_p')]->name}} </h5>
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
                                                        <input type="email" name="email" id="" value="{{$user->email}}">

                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <h6>Phone</h6>

                                                        <input type="text" name="phone" placeholder=""
                                                            value="{{ $user->tel }}">

                                                    </div>
                                                </div>
                                                <h6></h6>
                                                <hr class="mt-0 mb-4">
                                                <div class="row pt-1">
                                                    <div class="col-6 mb-3">
                                                        <h6>age</h6>
                                                        <p class="text-muted">{{ $patients[session('id_p')]->age }}</p>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <h6>Submit</h6>
                                                        <button type="submit">save</button>
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
            </form>


        @endif




        <section class="featured-section">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                        <div class="custom-block bg-white shadow-lg">

                            <div class="d-flex">
                                <div>
                                    <h5 class="mb-2">Next Appointment </h5>
                                    @if ($next != null)
                                        <p class="mb-0">{{ $next->rendezvous }}</p>
                                        <p class="mb-0">{{ $next->type }}</p>

                                    @else
                                        <p class="mb-0"> No dates</p>

                                    @endif
                                </div>

                                {{-- <span class="badge bg-design rounded-pill ms-auto">37</span> --}}
                            </div>

                            <img src="images/topics/undraw_Remote_design_team_re_urdx.png"
                                class="custom-block-image img-fluid" alt="">

                        </div>
                    </div>

                    {{-- <div class="col-lg-6 col-12">
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
                    </div> --}}

                </div>
            </div>
        </section>


        <section class="explore-section section-padding" id="section_2">
            <div class="container">
                <div class="row">

                    <div class="col-12 text-center">
                        <h2 class="mb-4">My Folder</h1>
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

                        @if ($user->role == 'patient')

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="finance-tab" data-bs-toggle="tab"
                                    data-bs-target="#finance-tab-pane" type="button" role="tab"
                                    aria-controls="finance-tab-pane" aria-selected="false">add member</button>
                            </li>
                        @endif


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
                                            defaultDate: '2025-04-19',
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
                                                        title: 'Rendez-vous',
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
                                                                <th scope="col">date</th>
                                                                <th scope="col">specialite</th>
                                                                <th scope="col">name</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @if (!$r->isEmpty())

                                                                @foreach ($r as $re)

                                                                    <tr>
                                                                        <th scope="row">{{substr($re->rendezvous, 0, 10)}}</th>

                                                                        <td>{{ $re->doctor->specialty }}</td>
                                                                        <td>{{ $re->doctor->user->name }}</td>

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
                                            <a href="" id="showf">
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


                                    <div id="myfiles" class="col-lg-4 col-md-6 col-12 mb-4 myfiles">
                                        <div class="custom-block bg-white " style=" overflow-y: auto; ">

                                            <div class="d-flex">
                                                <div style=" overflow-y: auto; ">

                                                    <a href="" id="ret_fil" class="retour-button">
                                                        Retour
                                                    </a>
                                                    @if(session('modifying'))


                                                        <a href="" id="add_fil" class="retour-button">
                                                            Add File
                                                        </a>
                                                        {{-- <input type="text" name="name of the file or is about what"
                                                            id="" style="margin-left: 120px;margin-top: 10px ;"> --}}

                                                        <!-- Hidden form for file upload -->
                                                        <form id="uploadForm" action="{{ route('files.upload') }}"
                                                            method="POST" enctype="multipart/form-data"
                                                            style="display: none;">
                                                            @csrf
                                                            <input type="file" name="files[]" id="fileInput" multiple
                                                                onchange="document.getElementById('uploadForm').submit();">
                                                            <input type="hidden" name="pid"
                                                                value="{{ $patients[session('id_p')]->user_id}}">
                                                        </form>
                                                    @endif
                                                    <!-- Trigger link -->

                                                    <!-- Trigger the file input click -->
                                                    <script>
                                                        document.getElementById('add_fil').addEventListener('click', function (e) {
                                                            e.preventDefault();
                                                            document.getElementById('fileInput').click();
                                                        });
                                                    </script>





                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">File</th>
                                                                <th scope="col">Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($files as $file)
                                                                <tr>
                                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                                    <td><a href="{{ asset('storage/' . $file->file_path) }}"
                                                                            download>{{ Str::limit($file->mime, 20, '..') }}</a>
                                                                    </td>
                                                                    <td>{{ $file->created_at->format('Y-m-d H:i:s') }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>




                                                </div>

                                            </div>
                                            <script>
                                                const divfil = document.getElementById('myfiles');
                                                const ret_fil = document.getElementById('ret_fil');

                                                const linkf = document.getElementById('showf');
                                                linkf.addEventListener('click', function (e) {

                                                    e.preventDefault();
                                                    console.log("fdksj");

                                                    divfil.style.transform = 'translateY(-790px)';


                                                });

                                                ret_fil.addEventListener('click', function (e) {

                                                    e.preventDefault();
                                                    divfil.style.transform = 'translateY(800px)';


                                                });

                                            </script>


                                        </div>
                                    </div>







                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a id="showN" href="">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Notes</h5>

                                                        <p class="mb-0">Lorem Ipsum dolor sit amet consectetur
                                                        </p>
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
                                                            @if (session('modifying'))

                                                                <form action="{{ route('addnote') }}" method="post"
                                                                    style="display: none;">
                                                                    @csrf
                                                                    <tr>
                                                                        <th scope="row"><input type="submit" value="add">
                                                                        </th>
                                                                        <td>{{ Str::limit($user->doctor[0]->specialty, 1000, '...') }}
                                                                        </td>
                                                                        <td> {{ Str::limit($user->name, 10, '...') }} </td>
                                                                        <input type="hidden" name="rdvid" value="1"
                                                                            style="display: none;">
                                                                        <input type="hidden" name="docid" value="1"
                                                                            style="display: none;">
                                                                        <input type="hidden" name="ptnid"
                                                                            value="{{ $patients[session('id_p')]->id }}"
                                                                            style="display: none;">
                                                                        <td> <input type="text" name="note" id=""> </td>
                                                                    </tr>
                                                                </form>
                                                            @endif

                                                            @foreach ($notes as $note)
                                                                <tr>
                                                                    <th scope="row">
                                                                        {{ Str::limit($note->rend->rendezvous, 10, '') }}
                                                                    </th>
                                                                    <td>{{ $note->doctor->specialty }}</td>
                                                                    <td>{{ $note->doctor->user->name }}</td>
                                                                    <td>{{ $note->note }}</td>
                                                                </tr>
                                                            @endforeach


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

                            <div class="tab-pane fade" id="music-tab-pane" role="tabpanel" aria-labelledby="music-tab"
                                tabindex="0">
                                <div class="row">



                                    @if ($patients->count() == 1)
                                        <h1>No members</h1>
                                        {{-- Show members here --}}

                                        <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                                            <div class="custom-block bg-white shadow-lg">
                                                <a href="">
                                                    <div class="d-flex">
                                                        <div>
                                                            <h5 class="mb-2">Empty</h5>

                                                            <p class="mb-0">there is no member in this acount !</p>
                                                        </div>


                                                    </div>

                                                    {{-- <img
                                                        src="https://t4.ftcdn.net/jpg/00/65/77/27/240_F_65772719_A1UV5kLi5nCEWI0BNLLiFaBPEkUbv5Fv.jpg"
                                                        class="custom-block-image img-fluid" alt=""> --}}
                                                </a>
                                            </div>
                                        </div>

                                    @else
                                        @foreach ($patients as $index => $p)
                                            <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                                                <div class="custom-block bg-white shadow-lg">

                                                    <a href="#"
                                                        onclick="event.preventDefault(); document.getElementById('changep{{ $index }}').submit();">
                                                        <div class="d-flex">
                                                            <div>
                                                                <h5 class="mb-2">{{ $p->rel }} </h5>
                                                                <p class="mb-0">Click to see more about</p>
                                                            </div>
                                                        </div>

                                                        @if ($p->pic == null)
                                                            <img src="https://t4.ftcdn.net/jpg/00/65/77/27/240_F_65772719_A1UV5kLi5nCEWI0BNLLiFaBPEkUbv5Fv.jpg"
                                                                class="custom-block-image img-fluid" alt="">
                                                        @else
                                                            <img src="{{ asset('storage/' . $p->pic) }}" alt="Avatar"
                                                                class="img-fluid my-5" />
                                                        @endif
                                                    </a>

                                                    <!-- Form placed outside the <a> and with unique ID -->
                                                    <form method="POST" action="{{ route('changep.toggle') }}"
                                                        id="changep{{ $index }}">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $index }}">
                                                    </form>

                                                </div>
                                            </div>
                                        @endforeach

                                    @endif







                                </div>
                            </div>
                            @if ($user->role == 'patient')

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
                                                        <form class="person-form-container person-form"
                                                            action="{{route('remove_P') }}" method="post">
                                                            @csrf
                                                            <label for="person">Choose a Person:</label>
                                                            <select id="person" name="id">
                                                                <option value="" disabled selected>Select...</option>

                                                                @foreach ($patients->skip(1) as $p)
                                                                    <option value="{{ $p->id }}">{{ $p->rel }}</option>
                                                                @endforeach

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
                                                            <form class="custom-form" action="{{ route('addMember') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf

                                                                <input type="text" placeholder="Full Name"
                                                                    class="custom-input" name="name" required>

                                                                <input type="text" placeholder="Relation"
                                                                    class="custom-input" name="relation" required>

                                                                <input type="number" placeholder="Age" class="custom-input"
                                                                    name="age" required>

                                                                <select class="custom-input" name="gender" required>
                                                                    <option value="" disabled selected>Gender</option>
                                                                    <option value="Homme">Homme</option>
                                                                    <option value="Femme">Femme</option>
                                                                </select>

                                                                <label for="file-upload" class="custom-file-label">
                                                                    Choose Medical Files
                                                                    <input type="file" id="file-upload" name="files[]"
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



                            @endif

                        </div>

                    </div>
                </div>
        </section>





    </main>

    <footer class="site-footer section-padding">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-12 mb-4 pb-2">
                    <a class="navbar-brand mb-2" href="{{ route('home') }}">
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