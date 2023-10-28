<head>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style1.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<section class="job_listing_area sec-ptb-100 decoration-wrap clearfix">
    <div class="container">
        <div class="section-title text-center mb-70">
            <h2 class="title-text mb-3">Les dernières offres</h2>
            <p class="mb-0">Vous êtes en quête d'expérience professionnelle ? Rejoignez-nous donc !</p>
        </div>
        <div class="job_lists">
            <div class="row">

                @if (!empty($emploi))
                    @foreach ($emploi as $row)
                        <div class="col-lg-12 col-md-12">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">
                                    <div class="thumb">
                                        <img src="https://familiapro.akpany.ci/assets/ns/images/favicon.ico"
                                            alt="">
                                    </div>
                                    <div class="jobs_conetent">
                                        <a href="{{ route('job_details', ['job_id'=>$row->id]) }}">
                                            <h4> {{$row->intitule_poste}} </h4>
                                        </a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location">
                                                <p><span class="material-icons">map</span> {{$row->localisation}} </p>
                                            </div>
                                            {{-- <div class="location">
                                                <p><span class="material-icons">place</span>Sur site</p>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="jobs_right">
                                    <div class="apply_now">
                                        <!-- <a class="heart_mark" href="#"> <i class="ti-heart"></i> </a> -->
                                        <a href="{{ route('job_details', ['job_id'=>$row->id]) }}" class="boxed-btn3">Postuler</a>
                                    </div>
                                    <div class="date">
                                        <p>Date limite: {{$row->date_limite}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12 d-flex justify-content-center">
                        <p class="text-muted">Aucune offre disponible pour l'instant</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="brouse_job text-right">
            <a href="{{ route('all_job') }}" class="boxed-btn4">Voir plus</a>
        </div>
    </div>
    <!-- Funfact Section Start Here -->

</section>

<section id="blog">
    <div class="funfact-section d-flex flex-column justify-content-center">
        <div class="container-fluid p-0">
            <div class="row no-gutters counters align-items-center">
                <div class="col-lg-3 col-6">
                    <div class="single-fun-fact-wrap" data-aos="fade-up" data-aos-delay="100">
                        <div class="counter-area" id="lines1">
                            <strong class="counter">10</strong>
                        </div>
                        <div class="counter-content">
                            <h3 class="title">ans d'expérience</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 item">
                    <div class="single-fun-fact-wrap" data-aos="fade-up" data-aos-delay="300">
                        <div class="counter-area" id="lines2">
                            <strong class="counter">
                                +10
                            </strong>
                        </div>
                        <div class="counter-content">
                            <h3 class="title">Employés</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="single-fun-fact-wrap" data-aos="fade-up" data-aos-delay="600">
                        <div class="counter-area" id="lines3">
                            <strong class="counter">+100</strong>
                            < </div>
                                <div class="counter-content">
                                    <h3 class="title">Projets réalisés</h3>
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="single-fun-fact-wrap" data-aos="fade-up" data-aos-delay="900">
                            <div class="counter-area" id="lines4">
                                <strong class="counter">+100</strong>
                            </div>
                            <div class="counter-content">
                                <h3 class="title">Clients satisfaits</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
