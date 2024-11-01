@extends('layouts.website')
@section('title', ' High5 Daycare')
@section('content')



<style>
    .choose-img{
        min-height: 600px;
        object-fit: cover;
    }
    
    .last_img{
        min-height: auto;
    }
    p{
        text-align: justify;
    }

    .choose-item {
        margin-top: 0;
    }

    .choose-area ul{
        padding-left: 20px;
    }
    .choose-area ul li{
        list-style: disc;
    }
    #providers .team-item{
        border: 5px solid green;
    }
    @media screen and (max-width: 992px) {
        .container{
            padding: 20px 10px !important;
        }

        .choose-content {
            padding: 20px 0;
        }
    }

    .site-breadcrumb{
        padding: 120px 0;
    }

    .team-item {
        padding: 0;
    }
    
</style>

<main class="main">

    <!-- breadcrumb -->
    <div class="site-breadcrumb" style="background: url({{ asset('assets/website/img/slider/slider-2.jpg') }})">
        <div class="container">
            <h2 class="breadcrumb-title">Provider</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('website') }}">Home</a></li>
                <li class="active">Provider</li>
            </ul>
            <div class="header-btn mt-2">
                <a href="{{ asset('assets/pdf/homedaycareprovider.docx') }}" download="" class="theme-btn mt-2">Home Daycare Provider </a>
            </div>
        </div>
        <div class="hero-shape">
            <img class="hero-shape-1" src="{{ asset('assets/website/img/shape/01.png') }}" alt="">
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- choose-area end -->
    <div class="choose-area pb-80">
        <div class="shape">
            <img class="shape-3 horizontal-animation" src="{{ asset('assets/website/img/shape/24.png') }}" alt="">
        </div>
        <div class="container">
            <div class="row align-items-center">
          
                <div class="col-lg-6">
                    <div class="choose-content">
                        <div class="site-heading mb-4">
                            <span class="site-title-tagline">Provider </span>
                            <h2 class="site-title mb-10">What makes us a <span>great</span> place to <span>work?</span></h2>
                            
                        </div>
                        <div class="choose-content-wrapper">
                            <div class="choose-item mt-0">
                                <!-- <div class="choose-item-icon">
                                    <img src="{{ asset('assets/website/img/icon/light.svg') }}" alt="">
                                </div> -->
                                <div class="choose-item-info">
                                    <!-- <h3>Special Education</h3> -->
                                    <p>At High5 Day Care Agency, we believe being a provider is an amazing role where you get to take care of wonderful children. 
                                    Your job involves lots of things like organizing fun activities, helping with meals, and making sure everything is safe and clean. 
                                    We're here to support you every step of the way!
                                    </p>
                                    <p>Before you start, we just need a few important documents like health clearances and plans for emergencies. We want to make sure everything is good to go.</p>
                                    <b>At High5 Day Care Agency, we're like a big family, and we have some cool benefits for you:</b>
                                    <ul>
                                        <li>Your home gets a special license for childcare, making it a safe and fun place. </li>
                                        <li>You can take care of up to 6 kids, so it's not too overwhelming. We help out with some costs to make things easier for you.</li>
                                        <li>You can join fun meetings and webinars to learn new things. </li>
                                        
                                    </ul>
                                </div>
                            </div>
                          
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="choose-img-box">
                        <img class="choose-img " src="{{ asset('assets/website/img/provider/provider1.jpg') }}" alt="">
                        <!-- <div class="video-wrapper">
                            <a class="play-btn popup-youtube" href="https://www.youtube.com/watch?v=ckHzmP1evNU">
                                <i class="fas fa-play"></i>
                            </a>
                        </div> -->
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-center">
          
            <div class="col-lg-6">
                    <div class="choose-img-box">
                        <img class="choose-img " src="{{ asset('assets/website/img/provider/provider2.jpg') }}" alt="">
                        <!-- <div class="video-wrapper">
                            <a class="play-btn popup-youtube" href="https://www.youtube.com/watch?v=ckHzmP1evNU">
                                <i class="fas fa-play"></i>
                            </a>
                        </div> -->
                        
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="choose-content">
                        
                        <div class="choose-content-wrapper">
                            <div class="choose-item mt-0">
                                <!-- <div class="choose-item-icon">
                                    <img src="{{ asset('assets/website/img/icon/light.svg') }}" alt="">
                                </div> -->
                                <div class="choose-item-info">
                                    <!-- <h3>Special Education</h3> -->
                                    <p>Before you start, we just need a few important documents like health clearances and plans for emergencies. We want to make sure everything is good to go.</p>
                                    <b>You'll meet other providers and share ideas - it's like a community! We're here to help you with:</b>
                                    <ul>
                                        
                                        <li>Figuring out what activities the kids can enjoy every day. </li>
                                        <li>Planning their daily routines.</li>
                                        <li>Deciding what yummy food they can have. </li>
                                        <li>Connecting with parents and making them feel comfortable.</li>
                                        <li>Supporting kids with different needs. </li>
                                        <li>Getting advice from an expert about child development. </li>
                                        <li>Arranging backup care if you need a day off.</li>
                                        <li>At High5 Day Care Agency, we're not just aiming to be good; we want to be the best together. </li>
                                        <li>Join us, and let's make childcare a fantastic experience where your dedication is valued, and we're here to cheer you on!</li>
                                    </ul>
                                </div>
                            </div>
                          
                        </div>
                    </div>
                </div>

        
            </div>
        </div>
       
    
    </div>

    <div id='providers' class="team-area pt-80 pb-90">
                <div class="shape">
                    <img class="shape-1 horizontal-animation" src="asset('assets/website/img/shape/22.png') }}" alt="">
                    <img class="shape-2 horizontal-animation" src="asset('assets/website/img/shape/10.png') }}" alt="">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="site-heading text-center">
                                <span class="site-title-tagline">Providers</span>
                                <h2 class="site-title">Support to<span> providers</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6 col-lg-4">
                            <div class="team-item">
                                <!-- <div class="team-img">
                                    <img src="{{ asset('assets/website/img/team/01.jpg') }}" alt="thumb">
                                </div>
                                <div class="team-social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                </div> -->
                                <div class="team-content">
                                    <!-- <a href="#" class="team-social-btn"><i class="far fa-share-nodes"></i></a> -->
                                    <div class="team-bio">
                                        <h5><a href="#">Subsidized families</a></h5>
                                        <!-- <span>Founder</span> -->
                                        <!-- <p><b>Meet the Heart Behind High5 Daycare:</b></p> -->
                                        <!-- <ul>
                                                                        <li>With a passion for nurturing young minds and over a decade of hands-on experience, Sidra Altaf is the visionary founder of High5 Daycare Agency.</li>
                                        </ul> -->
                                        <!-- <a href="{{ route('about') }}" class="theme-btn mt-2">View all </a> -->
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="team-item">
                                <!-- <div class="team-img">
                                    <img src="{{ asset('assets/website/img/team/02.jpg') }}" alt="thumb">
                                </div>
                                <div class="team-social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                </div> -->
                                <div class="team-content">
                                    <div class="team-bio">
                                        <h5><a href="#">Quality first</a></h5>
                                        <!-- <span>Home visitor</span> -->
                                        <!-- <p><b>Meet the Heart Behind High5 Daycare:</b></p> -->
                                        <!-- <ul>
                                            <li>With a passion for nurturing young minds and over a decade of hands-on experience, Sidra Altaf is the visionary founder of High5 Daycare Agency.</li>
                                        </ul> -->
                                        <!-- <a href="{{ route('about') }}" class="theme-btn mt-2">View all </a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="team-item">
                                <!-- <div class="team-img">
                                    <img src="{{ asset('assets/website/img/team/03.jpg') }}" alt="thumb">
                                </div>
                                <div class="team-social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                </div> -->
                                <div class="team-content">
                                    <div class="team-bio">
                                        <h5><a href="#">THRC support</a></h5>
                                        <!-- <span>Program consultant</span> -->
                                        <!-- <p><b>Meet the Heart Behind High5 Daycare:</b></p> -->
                                        <!-- <ul>
                                            <li>With a passion for nurturing young minds and over a decade of hands-on experience, Sidra Altaf is the visionary founder of High5 Daycare Agency.</li>
                                        </ul> -->
                                        <!-- <a href="{{ route('about') }}" class="theme-btn mt-2">View all </a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="team-item">
                                <!-- <div class="team-img">
                                    <img src="{{ asset('assets/website/img/team/03.jpg') }}" alt="thumb">
                                </div>
                                <div class="team-social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                </div> -->
                                <div class="team-content">
                                    <div class="team-bio">
                                        <h5><a href="#">Connecting with parents</a></h5>
                                        <!-- <span>Program consultant</span> -->
                                        <!-- <p><b>Meet the Heart Behind High5 Daycare:</b></p> -->
                                        <!-- <ul>
                                            <li>With a passion for nurturing young minds and over a decade of hands-on experience, Sidra Altaf is the visionary founder of High5 Daycare Agency.</li>
                                        </ul> -->
                                        <!-- <a href="{{ route('about') }}" class="theme-btn mt-2">View all </a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="team-item">
                                <!-- <div class="team-img">
                                    <img src="{{ asset('assets/website/img/team/03.jpg') }}" alt="thumb">
                                </div>
                                <div class="team-social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                </div> -->
                                <div class="team-content">
                                    <div class="team-bio">
                                        <h5><a href="#">Backup care</a></h5>
                                        <!-- <span>Program consultant</span> -->
                                        <!-- <p><b>Meet the Heart Behind High5 Daycare:</b></p> -->
                                        <!-- <ul>
                                                                        <li>With a passion for nurturing young minds and over a decade of hands-on experience, Sidra Altaf is the visionary founder of High5 Daycare Agency.</li>
                                        </ul> -->
                                        <!-- <a href="{{ route('about') }}" class="theme-btn mt-2">View all </a> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="team-item">
                                <!-- <div class="team-img">
                                    <img src="{{ asset('assets/website/img/team/03.jpg') }}" alt="thumb">
                                </div>
                                <div class="team-social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                </div> -->
                                <div class="team-content">
                                    <div class="team-bio">
                                        <h5><a href="#">Documentation</a></h5>
                                        <!-- <span>Program consultant</span> -->
                                        <!-- <p><b>Meet the Heart Behind High5 Daycare:</b></p> -->
                                        <!-- <ul>
                                            <li>With a passion for nurturing young minds and over a decade of hands-on experience, Sidra Altaf is the visionary founder of High5 Daycare Agency.</li>
                                        </ul> -->
                                        <!-- <a href="{{ route('about') }}" class="theme-btn mt-2">View all </a> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="team-item">
                                <!-- <div class="team-img">
                                    <img src="{{ asset('assets/website/img/team/03.jpg') }}" alt="thumb">
                                </div>
                                <div class="team-social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                </div> -->
                                <div class="team-content">
                                    <div class="team-bio">
                                        <h5><a href="#">Promotion </a></h5>
                                        <!-- <span>Program consultant</span> -->
                                        <!-- <p><b>Meet the Heart Behind High5 Daycare:</b></p> -->
                                        <!-- <ul>
                                             <li>With a passion for nurturing young minds and over a decade of hands-on experience, Sidra Altaf is the visionary founder of High5 Daycare Agency.</li>
                                        </ul> -->
                                        <!-- <a href="{{ route('about') }}" class="theme-btn mt-2">View all </a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>


</main>

@endsection