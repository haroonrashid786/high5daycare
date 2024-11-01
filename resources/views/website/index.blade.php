@extends('layouts.website')
@section('title', ' High5 Daycare')
@section('content')


<style>
    .e1mwfyk10 {
        background: red !important;
    }

    #aboutus .team-item {
        border: 5px solid green;
    }
</style>

<main class="main">
    <!-- hero slider -->
    <div class="hero-section">
        <div class="hero-shape">
            <img class="hero-shape-1" src="{{ asset('assets/website/img/shape/01.png') }}" alt="">
            <img class="hero-shape-2" src="{{ asset('assets/website/img/shape/02.png') }}" alt="">
        </div>
        <div class="hero-slider ">
            <div class="hero-single" style="background: url({{ asset('assets/slider/slider-3.jpg') }})">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-12 col-lg-12">
                            <div class="hero-content">
                                <h6 class="hero-sub-title wow animate__animated animate__fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">Leading Licensed <br> <span class='text-[#FDB21D]'>Home</span> Child Care</h6>
                                <p class="wow animate__animated animate__fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
                                    High5 Day Care Inc. is a licensed home childcare agency operating in the Halton region, Ontario. We make an impact on young minds and help to build a better tomorrow for the next generation.
                                </p>
                                <div class='d-flex flex-column flex-md-row gap-3'>
                                    <div class="header-btn">
                                        <a href="{{ route('parents') }}" class="theme-btn mt-2">I AM A PARENT </a>
                                    </div>
                                    <div class="header-btn">
                                        <a href="{{ route('providers') }}" class="theme-btn mt-2">I AM A CHILD PROVIDER </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- hero slider end -->



    <!-- feature area -->
    <div class="feature-area pt-40 pb-80 mt-30">
        <div class="shape">
            <img class="shape-1 horizontal-animation" src="{{ asset('assets/website/img/shape/10.png') }}" alt="">
            <img class="shape-2 horizontal-animation" src="{{ asset('assets/website/img/shape/06.png') }}" alt="">
        </div>
        <div class="container">
            <div class="feature-wrapper">
                <div class="row">
                    <h2 class="site-title mb-50" style="margin-bottom: 100px;text-align: center;">5 pillars of <span>high5 day care</span></h2>
                    <div class="col-md-6 col-lg-6">
                        <div class="feature-item feature-color-1">
                            <div class="feature-icon">
                                <img src="{{ asset('assets/website/img/icon/active-learning.svg') }}" alt="">
                            </div>
                            <div class="feature-content">
                                <h4>Belonging</h4>
                                <p>When children experience a feeling of belonging, they start building their trust and self-image. A child gets an insight into their individual identity through their associations and encounters at home, family collaborations, and their surroundings. As they participate in fun activities, learn, and attempt new things, they start understanding of their own personality.

                                </p>
                                <div class="feature-shadow-icon">
                                    <img src="{{ asset('assets/website/img/icon/active-learning.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="feature-item feature-color-2">
                            <div class="feature-icon">
                                <img src="{{ asset('assets/website/img/icon/safe-enviroment.svg') }}" alt="">
                            </div>
                            <div class="feature-content">
                                <h4>Wellbeing</h4>
                                <p>Children today confront a perplexing universe, prompting numerous parents, researchers, and care specialists to consider how to measure a kid's prosperity. Wellbeing alludes to physical and psychological well-being and health. It incorporates capacities, for example, self-care, solid personality, and self-administration aptitudes.

                                </p>
                                <div class="feature-shadow-icon">
                                    <img src="{{ asset('assets/website/img/icon/safe-enviroment.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="feature-item feature-color-3">
                            <div class="feature-icon">
                                <img src="{{ asset('assets/website/img/icon/fully-equipment.svg') }}" alt="">
                            </div>
                            <div class="feature-content">
                                <h4>Affection</h4>
                                <p>Offering warmth and fondness to children from a young age produces long-term positive effects on their self-esteem, scholastic results, communication with parents, and their mental and behavioral health. Providing a professional and user-friendly atmosphere can help foster these important results.

                                </p>
                                <div class="feature-shadow-icon">
                                    <img src="{{ asset('assets/website/img/icon/fully-equipment.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="feature-item feature-color-4">
                            <div class="feature-icon">
                                <img src="{{ asset('assets/website/img/icon/affordable-price.svg') }}" alt="">
                            </div>
                            <div class="feature-content">
                                <h4>Engagement</h4>
                                <p>Engagements enable children to be included and centered. When they are able investigate their environment with their innate curiosity and enthusiasm, they are completely engaged and this facilitates the development of skills such as critical and creative thinking, and growth.

                                </p>
                                <div class="feature-shadow-icon">
                                    <img src="{{ asset('assets/website/img/icon/affordable-price.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="feature-item feature-color-4">
                            <div class="feature-icon">
                                <img src="{{ asset('assets/website/img/icon/affordable-price.svg') }}" alt="">
                            </div>
                            <div class="feature-content">
                                <h4>Expressions</h4>
                                <p>Effective communication is essential for all individuals, particularly young children. Through their bodies, spoken words, and engagement with materials, children can foster their communication skills, refining them to higher levels of complexity.

                                </p>
                                <div class="feature-shadow-icon">
                                    <img src="{{ asset('assets/website/img/icon/affordable-price.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- feature area end -->



    <!-- about area -->
    <!-- <div class="about-area pt-80 pb-120">
        <div class="shape">
            <img class="shape-1 horizontal-animation" src="{{ asset('assets/website/img/shape/06.png') }}" alt="">
            <img class="shape-2 horizontal-animation" src="{{ asset('assets/website/img/shape/07.png') }}" alt="">
            <img class="shape-4 horizontal-animation" src="{{ asset('assets/website/img/shape/08.png') }}" alt="">
        </div>
        <div class="container" id="aboutus">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-left">
                        <div class="about-img vertical-animation">
                            <img src="{{ asset('assets/website/img/about/02.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-right">
                        <div class="site-heading mb-3">
                            <span class="site-title-tagline">About Us</span>
                            <h2 class="site-title">
                                We Provide <span>Special Care For</span> Your Children
                            </h2>
                        </div>
                        <p class="about-text">
                            High5 Day Care Inc. is a licensed home childcare agency operating in the Halton region, Ontario. We make an impact on young minds and help to build a better tomorrow for the next generation.
                        </p>
                        <div class="about-list-wrapper">
                            <ul class="about-list list-unstyled">
                                <li>
                                    We look for like-minded individuals having a passion to transform children’s lives through learning.
                                </li>
                                <li>
                                    We believe that early learning experiences, including careful nurturing, monitoring, and stimulation are the foundation of a child’s growth and development.
                                </li>

                            </ul>
                            <a href="/parent-guide-latest-agency-1.docx" download="" class="theme-btn mt-2">Parent Guide </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- about area end -->

    <!-- team-area -->
    <!-- linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.2)), -->
    <div id='aboutus' class="team-area bg pt-40 pb-90 fix_bg">
        <!-- <div class="team-shape">
                    <img class="shape-1 horizontal-animation" src="{{ asset('assets/website/img/shape/23.png') }}" alt="img">
                    <img class="shape-2 horizontal-animation" src="{{ asset('assets/website/img/shape/10.png') }}" alt="img">
                </div> -->
        <div class="hero-shape">
            <!-- <img class="hero-shape-1" src="{{ asset('assets/website/img/shape/01.png') }}" alt=""> -->
            <!-- <img class="hero-shape-2" style='top:-50px;transform:rotate(180deg);' src="{{ asset('assets/website/img/shape/02.png') }}" alt=""> -->
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">About us</span>
                        <h2 class="site-title">Meet our <span>Team</span></h2>
                        <div class='mt-2'>
                            <a href="{{ asset('assets/pdf/Parent Handbook.pdf') }}" download="" class="theme-btn mt-2">Parent Handbook </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">

                <div class="col-md-6 col-lg-4">
                    <div class="team-item team_card">
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
                                <h5><a href="#">Sidra Altaf</a></h5>
                                <span>Founder</span>
                                <p><b>Meet the Heart Behind High5 Daycare:</b></p>
                                <ul>
                                    <li>With a passion for nurturing young minds and over a decade of hands-on experience, Sidra Altaf is the visionary founder of High5 Daycare Agency. As a dedicated advocate for quality childcare, Sidra brings a ...</li>
                                </ul>
                                <a href="{{ route('about') }}" class="theme-btn mt-2">Read more </a>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="team-item team_card">
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
                                <h5><a href="#">Akif Jamal</a></h5>
                                <span>Co Founder</span>
                                <p><b>Meet the Co Founder of High5 Daycare:</b></p>
                                <ul>
                                    <li>The Co-founder leading High5 Daycare Agency's expansion across Ontario. With a background in business strategy, Akif envisions extending the agency's excellence from Halton ...</li>
                                </ul>
                                <a href="{{ route('about') }}" class="theme-btn mt-2">Read more </a>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="team-item team_card">
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
                                <h5><a href="#">Aliya </a></h5>
                                <span>Home visitor</span>
                                <p><b>Home Visitor with High5 Day Care:</b></p>
                                <ul>
                                    <li>I’m a Registered Early Childhood Educator and has been in the field for more than 10 years. I have also experience working as Educational Resource Worker for almost 2 years where I would work with children...</li>
                                </ul>
                                <a href="{{ route('about') }}" class="theme-btn mt-2">Read more </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="team-item team_card">
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
                                <h5><a href="#">Haroon Lazar </a></h5>
                                <span>Financial Analyst</span>
                                <p><b>Financial Analyst with High5 Day Care:</b></p>
                                <ul>
                                    <li>Our meticulous Financial Analyst at High5 Daycare Agency. With a sharp focus on numbers, Haroon ensures the financial well-being of the agency. His expertise in finance ...</li>
                                </ul>
                                <a href="{{ route('about') }}" class="theme-btn mt-2">Read more </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="team-item team_card">
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
                                <h5><a href="#">Zain Mahmood </a></h5>
                                <span>Chief IT Officer</span>
                                <p><b>Chief IT Officer with High5 Day Care:</b></p>
                                <ul>
                                    <li>The mastermind behind High5 Daycare Agency's digital presence. As our IT Expert and Software Developer, Zain brings innovation and technical prowess to the forefront. With a knack for crafting ...</li>
                                </ul>
                                <a href="{{ route('about') }}" class="theme-btn mt-2">Read more </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div style='display: none;' class="col-md-6 col-lg-4">
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
                                <h5><a href="#">Lisa Loblaw </a></h5>
                                <span>Program Consultant</span>
                                <p><b>The Halton Resource Connection:</b></p>
                                <ul>
                                    <li>This facility is a participant of
                                        the Quality First Framework and I will be providing consultation to the educators who
                                        are working here.
                                        I am a Registered Early Childhood Educator... </li>
                                </ul>
                                <a href="{{ route('about') }}" class="theme-btn mt-2">Read more </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- team-area end -->



    <style>
        .class-content {
            min-height: 420px;
        }

        @media screen and (max-width: 1200px) {
            .class-content {
                min-height: 500px;
            }
        }

        @media screen and (max-width: 992px) {
            .class-content {
                min-height: auto;
            }
        }

        .min_height_not {
            min-height: auto;
        }
    </style>
    <!-- class area -->
    <div class="class-area bg pt-120" id="classes">
        <div class="hero-section">
            <div class="hero-shape">
                <!-- <img class="hero-shape-1" src="{{ asset('assets/website/img/shape/01.png') }}" alt=""> -->
                <!-- <img class="hero-shape-2" src="{{ asset('assets/website/img/shape/02.png') }}" alt=""> -->
            </div>
            <div class="shape">
                <img class="shape-1 horizontal-animation" src="{{ asset('assets/website/img/shape/09.png') }}" alt="">
                <img class="shape-4 horizontal-animation" src="{{ asset('assets/website/img/shape/15.png') }}" alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline">On Going Programs</span>
                            <h2 class="site-title">Get The Best <span>Program</span> With Us</h2>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6 col-lg-4">
                        <div class="class-item">
                            <div class="class-img">
                                <img src="{{ asset('assets/website/img/class/01.jpg') }}" alt="">
                            </div>
                            <div class="class-content">
                                <h4><a href="#">Infants</a></h4>
                                <p>The first step of infant development goes from infancy to 24 months. High5 Daycare makes sure that sensorimotor coordination, social skills, and symbolic learning are boosted through a range of activities such as games, toys, puzzles, and songs. During the infant years, a child depends more on caregivers and their main focus is to meet the individual needs of the child in a professional, user-friendly manner.
                                </p>
                                <!--    <ul class="class-list">
                                        <li>
                                            <span>Age:</span>
                                            <h6>5-10 Years</h6>
                                        </li>
                                        <li>
                                            <span>Time:</span>
                                            <h6>8-10 Am</h6>
                                        </li>
                                        <li>
                                            <span>Seat:</span>
                                            <h6>28 Kids</h6>
                                        </li>
                                    </ul> -->
                            </div>
                            <div class="class-footer">
                                <!--<span class="class-price">$50</span>--> <a href="#" class="theme-btn">Join</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="class-item">
                            <div class="class-img">
                                <img src="{{ asset('assets/website/img/class/02.jpg') }}" alt="">
                            </div>
                            <div class="class-content">
                                <h4><a href="#">Toddlers</a></h4>
                                <p>It is the second stage of child development, which spans from 2 to 4 years. High5 Daycare ensures physical and cognitive growth of toddlers through a range of indoor and outdoor activities.
                                    The final stage of child development runs from 4 to 6 years. High5 Daycare ensures that both mathematical and reading skills are developed by organizing structured activities and outings. During these activities, a child is provided with special care for emotional, social, cognitive, and physical development.
                                </p>
                                <!--   <ul class="class-list">
                                        <li>
                                            <span>Age:</span>
                                            <h6>5-10 Years</h6>
                                        </li>
                                        <li>
                                            <span>Time:</span>
                                            <h6>8-10 Am</h6>
                                        </li>
                                        <li>
                                            <span>Seat:</span>
                                            <h6>28 Kids</h6>
                                        </li>
                                    </ul> -->
                            </div>
                            <div class="class-footer">
                                <!--                                 <span class="class-price">$75</span>--> <a href="#" class="theme-btn">Join</a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-6 col-lg-4">
                                <div class="class-item">
                                    <div class="class-img">
                                        <img src="{{ asset('assets/website/img/class/03.jpg') }}" alt="">
                                    </div>
                                    <div class="class-content" style="
                                        margin-bottom: 157px;
                                        ">
                                        <h4><a href="#">Kindergarten</a></h4>
                                        <p>It is the final stage of child development ranges from 4 to 6 years. High5 Daycare ensure to develop mathematical and reading skills by organizing structured outings.
                                            During these activities, a child is provided with special attention in terms of emotional, social, cognitive, and physical growth.
                                            .</p> -->
                    <!--  <ul class="class-list">
                                        <li>
                                            <span>Age:</span>
                                            <h6>5-10 Years</h6>
                                        </li>
                                        <li>
                                            <span>Time:</span>
                                            <h6>8-10 Am</h6>
                                        </li>
                                        <li>
                                            <span>Seat:</span>
                                            <h6>28 Kids</h6>
                                        </li>
                                    </ul> -->
                    <!-- </div>
                                    <div class="class-footer"> -->
                    <!--  <span class="class-price">$65</span>-->
                    <!-- <a href="#" class="theme-btn">Join</a>
                                    </div>
                                </div>
                            </div> -->
                    <div class="col-md-6 col-lg-4">
                        <div class="class-item">
                            <div class="class-img">
                                <img src="{{ asset('assets/website/img/class/03.jpg') }}" alt="">
                            </div>
                            <div class="class-content">
                                <h4><a href="#">Pre School</a></h4>

                                <p>During the third stage of child development, which ranges from 4 to 8 years, High5 Daycare nurtures the emotional growth of children by teaching them numbers, shapes, vocabulary, colors, listening activities, patterning, and sequencing. At this stage, children are also able to socially flourish through jumping, running, dancing, and climbing activities.
                                </p>
                                <!--  <ul class="class-list">
                                        <li>
                                            <span>Age:</span>
                                            <h6>5-10 Years</h6>
                                        </li>
                                        <li>
                                            <span>Time:</span>
                                            <h6>8-10 Am</h6>
                                        </li>
                                        <li>
                                            <span>Seat:</span>
                                            <h6>28 Kids</h6>
                                        </li>
                                    </ul> -->
                            </div>
                            <div class="class-footer">
                                <!-- <span class="class-price">$65</span>--> <a href="#" class="theme-btn">Join</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="class-item">
                            <div class="class-img">
                                <img src="{{ asset('assets/website/img/class/04.jpg') }}" alt="">
                            </div>
                            <div class="class-content min_height_not">
                                <h4><a href="#">Before & After School</a></h4>
                                <p>High5 Daycare provides a user-friendly and professional before and after school programs for children ranging from 8 to 12 years. We strive to cultivate cognitive, physical, social, and emotional skills in children by organizing various indoor and outdoor activities.
                                </p>
                                <!--   <ul class="class-list">
                                        <li>
                                            <span>Age:</span>
                                            <h6>5-10 Years</h6>
                                        </li>
                                        <li>
                                            <span>Time:</span>
                                            <h6>8-10 Am</h6>
                                        </li>
                                        <li>
                                            <span>Seat:</span>
                                            <h6>28 Kids</h6>
                                        </li>
                                    </ul> -->
                            </div>
                            <div class="class-footer">
                                <!--                                 <span class="class-price">$45</span>
            --> <a href="#" class="theme-btn">Join</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- class area end -->
    <!-- cta-area -->
    <div id='creative' class="cta-area mt-0 pt-80 pb-80">
        <div class="hero-section">
            <div class="hero-shape">
                <!-- <img class="hero-shape-1" src="{{ asset('assets/website/img/shape/01.png') }}" alt=""> -->
                <img class="hero-shape-2" src="{{ asset('assets/website/img/shape/02.png') }}" alt="">
            </div>
            <div class="cta-wrapper" style="background-image: url({{ asset('assets/website/img/slider/slider-1.jpg') }});">
                <div class="container cta_container p-3 py-40 ">
                    <div class="row align-items-center">
                        <div class="col-lg-12 text-center text-lg-center">
                            <div class="cta-text cta-divider">
                                <h2 class="site-title" style="margin-bottom: 20px;text-align: center;">Creative <span>wing</span></h2>
                                <p class='' style="text-align:justify;padding: 0 10px;">I am Afsheen, an artist from Milton, Ontario. I have been intrigued by art since I was a child. I worked with several mediums, from acrylic to oil, fabric or glass painting, Clay work or rock painting. I use my passion for colour, texture and the flow of acrylic paint to express my artwork. “My inspiration is from nature, which to me is art on its own. I find my vision to be subject in daily life , however the studio is also a place where my creativity comes to life. "My creative interests evolved into running my home art studio - Afsheen Artworks. At this location, several immature artists learn from sketching, drawing to acrylic paintings. Side by side, I conduct paint parties whether its birthday or corporate level.</p>
                                <!-- <a class='theme-btn' style='margin: 20px 0;' href="https://www.instagram.com/high5daycareinc/?igshid=YmMyMTA2M2Y%3D" target="_blank"><i class="fab fa-instagram"></i> Visit my Instagram</a> -->
                                <p class='text-end'><a href="https://www.instagram.com/afsheen_art_works?igsh=bXk3dmYxdjVhMW44&utm_source=qr" target="_blank" class='theme-btn' style='margin-top: 20px;'><b>Visit me</b></a></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cta-area end -->



    <!-- counter area -->
    <div class="counter-area pt-70 pb-120" style="display: none">
        <div class="counter-shape"><img src="assets/img/shape/02.png" alt=""></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box counter-color-1">
                        <div class="icon">
                            <img src="{{ asset('assets/website/img/icon/student.svg') }}" alt="">
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="200" data-speed="3000">200</span>
                            <h6 class="title">+ Students Enrolled</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box counter-color-2">
                        <div class="icon">
                            <img src="{{ asset('assets/website/img/icon/classes.svg') }}" alt="">
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="50" data-speed="3000">50</span>
                            <h6 class="title">+ Total programs</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box counter-color-3">
                        <div class="icon">
                            <img src="{{ asset('assets/website/img/icon/teacher.svg') }}" alt="">
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="10" data-speed="3000">10</span>
                            <h6 class="title">+ Expert Provider</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box counter-color-4">
                        <div class="icon">
                            <img src="{{ asset('assets/website/img/icon/experience.svg') }}" alt="">
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="5" data-speed="3000">5</span>
                            <h6 class="title">+ Years Of Experience</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- counter area end -->


    <!-- team-area -->
    <div class=" pt-80 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <div class="site-heading text-center">
                        <h2 class="site-title">Importance of <span>Home child care</span> Vs. <span>Child Care Centers</span></h2>
                        <p class="about-text">
                            Child Care Centers contribute more to better language, social, and cognitive development. Children can learn excellent pre-academic skills, including numbers and letters.
                            On the other hand, home childcare contributes less towards social and language development. Moreover, children can not learn pre-academic skills due to a lack of social development and interaction.</p><br><br>


                        <h2 class="site-title"> <span>CWELCC</span></h2>
                        <p class="about-text">
                            Canada-Wide Early Learning Child Care System (CWELCC) is a childcare program to make childcare more accessible and affordable. High5 Daycare actively participates and exercises the CWELCC, providing high-quality and affordable childcare to eligible children.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12 col-lg-12">

                </div>
                <!--    <div class="col-md-6 col-lg-3">
                <div class="team-item">
                    <div class="team-img">
                        <img src="assets/img/team/02.jpg" alt="thumb">
                    </div>
                    <div class="team-social">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                    <div class="team-content">
                        <a href="#" class="team-social-btn"><i class="far fa-share-nodes"></i></a>
                        <div class="team-bio">
                            <h5><a href="#">Malissa Fie</a></h5>
                            <span>Kids Teacher</span>
                        </div>
                    </div>
                </div>
            </div> -->
                <!--  <div class="col-md-6 col-lg-3">
                <div class="team-item">
                    <div class="team-img">
                        <img src="assets/img/team/03.jpg" alt="thumb">
                    </div>
                    <div class="team-social">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                    <div class="team-content">
                        <a href="#" class="team-social-btn"><i class="far fa-share-nodes"></i></a>
                        <div class="team-bio">
                            <h5><a href="#">Arron Rodri</a></h5>
                            <span>CEO & Founder</span>
                        </div>
                    </div>
                </div>
            </div> -->
                <!--   <div class="col-md-6 col-lg-3">
                <div class="team-item">
                    <div class="team-img">
                        <img src="assets/img/team/04.jpg" alt="thumb">
                    </div>
                    <div class="team-social">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                    <div class="team-content">
                        <a href="#" class="team-social-btn"><i class="far fa-share-nodes"></i></a>
                        <div class="team-bio">
                            <h5><a href="#">Tony Pinto</a></h5>
                            <span>Kids Teacher</span>
                        </div>
                    </div>
                </div>
            </div> -->
            </div>
        </div>

    </div>
    <!-- team-area end -->



    <!-- process-area -->
    <div class="process-area bg pt-120 pb-100">
        <div class="shape">
            <img class="shape-1 horizontal-animation" src="{{ asset('assets/website/img/shape/13.png') }}" alt="">
            <img class="shape-4 horizontal-animation" src="{{ asset('assets/website/img/shape/18.png') }}" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">How It Works</span>
                        <h2 class="site-title">Take A Look Our <span>Awesome</span> Steps To Success</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-3 col-md-6 text-center mb-50">
                    <div class="process-single process-color-1">
                        <span class="process-count">01</span>
                        <div class="icon">
                            <img src="{{ asset('assets/website/img/icon/expert-teacher.svg') }}" alt="">
                        </div>
                        <h4>Complete the application</h4>
                        <!-- <p>It is a long established fact that a reader will be distracted readable content of
                        a page. </p> -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-50">
                    <div class="process-single process-color-2">
                        <span class="process-count">02</span>
                        <div class="icon">
                            <img src="{{ asset('assets/website/img/icon/child-read.svg') }}" alt="">
                        </div>
                        <h4>Choose your preferred provider</h4>
                        <!--  <p>It is a long established fact that a reader will be distracted readable content of
                        a page. </p> -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-50">
                    <div class="process-single process-color-3">
                        <span class="process-count">03</span>
                        <div class="icon">
                            <img src="{{ asset('assets/website/img/icon/well-child.svg') }}" alt="">
                        </div>
                        <h4>Enjoy hassle-free professional childcare</h4>
                        <!--  <p>It is a long established fact that a reader will be distracted readable content of
                        a page. </p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- process-area end -->



    <!-- choose-area -->
    <div class="choose-area py-120" style="display: none">
        <div class="shape">
            <img class="shape-3 horizontal-animation" src="{{ asset('assets/website/img/shape/24.png') }}" alt="">
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="choose-content">
                        <div class="site-heading mb-4">
                            <span class="site-title-tagline">Why Choose Us</span>
                            <h2 class="site-title mb-10">We are dedicated <span>to provide</span> quality care</h2>
                            <p>
                                It is a long established fact that a reader will be distracted by the readable
                                content of a page when looking at its layout.
                            </p>
                        </div>
                        <div class="choose-content-wrapper">
                            <div class="choose-item mt-0">
                                <div class="choose-item-icon">
                                    <img src="{{ asset('assets/website/img/icon/light.svg') }}" alt="">
                                </div>
                                <div class="choose-item-info">
                                    <h3>Special Education</h3>
                                    <p>There are many variations of passages of Lorem Ipsum available but the
                                        majority have suffered alteration.</p>
                                </div>
                            </div>
                            <div class="choose-item">
                                <div class="choose-item-icon">
                                    <img src="{{ asset('assets/website/img/icon/lab.svg') }}" alt="">
                                </div>
                                <div class="choose-item-info">
                                    <h3>Digital Laboratory</h3>
                                    <p>There are many variations of passages of Lorem Ipsum available but the
                                        majority have suffered alteration.</p>
                                </div>
                            </div>
                            <div class="choose-item">
                                <div class="choose-item-icon">
                                    <img src="{{ asset('assets/website/img/icon/event.svg') }}" alt="">
                                </div>
                                <div class="choose-item-info">
                                    <h3>Events And Party</h3>
                                    <p>There are many variations of passages of Lorem Ipsum available but the
                                        majority have suffered alteration.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="choose-img-box">
                        <img class="choose-img" src="{{ asset('assets/website/img/choose/01.jpg') }}" alt="">
                        <div class="video-wrapper">
                            <a class="play-btn popup-youtube" href="https://www.youtube.com/watch?v=ckHzmP1evNU">
                                <i class="fas fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- choose-area end -->

    <!-- faq area -->
    <div class="faq-area py-120">
        <div class="container">
            <div class='mb-5'>
                <div class="site-heading mb-3">
                    <span class="site-title-tagline">Faq's</span>
                    <h2 class="site-title my-3">General <span>frequently</span> asked questions</h2>
                </div>
                <p class="about-text">Canada-Wide Early Learning Child Care System (CWELCC) is a childcare program to make childcare more affordable and accessible. High5 Daycare is also participating in the CWELCC, providing high-quality and affordable childcare to eligible children.
                </p>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="faq-right" id="faqtarget">

                        <div class="faq-img mt-3">
                            <img class="choose-img" src="{{ asset('assets/website/img/choose/01.jpg') }}" alt="">

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span><i class="far fa-question"></i></span> How many children can each home provider enroll ?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Our network providers are permitted to take care of up to 6 children aged 13 and under, with no more than 3 of them being younger than 2 years old. Whether there are one or two adults present, the maximum number of children that can be cared for in each licensed daycare is 6.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    <span><i class="far fa-question"></i></span> Safety measures
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                <div class="accordion-body">


                                    <ul class="list-unstyled">
                                        <li>
                                            <b>1.Childproofing: </b> Homes used for daycare services are childproofed to minimize potential hazards. This includes securing
                                            furniture, covering electrical outlets, and ensuring that dangerous items are out of reach, staircase gate.
                                        </li>
                                        <li>
                                            <b>2.First Aid and Emergency Preparedness: </b> Providers are trained in basic first aid, and they have an emergency plan in place.
                                            This includes knowing the location of emergency exits, having a first aid kit, and conducting regular emergency drills.
                                        </li>
                                        <li>
                                            <b>3.CPR Training: </b> Providers get the training in cardiopulmonary resuscitation (CPR) to respond to emergencies effectively.
                                        </li>
                                        <li>
                                            <b>4.Supervision: </b> Close and constant supervision is crucial for the safety of children. Providers ensure that children are
                                            adequately supervised both indoors and outdoors.
                                        </li>
                                        <li>
                                            <b>5.Background Checks: </b> Providers typically undergo background checks to ensure they have no criminal record or history of
                                            child abuse. This helps ensure the safety of the children in their care.
                                        </li>
                                        <li>
                                            <b>6.Health and Hygiene Practices: </b> Providers implement strict health and hygiene practices to prevent the spread of illnesses.
                                            This may include regular handwashing, proper diaper-changing procedures, and sanitation of toys and equipment.
                                        </li>
                                        <li>
                                            <b>7.Secure Entry and Exit Points: </b> Home daycares have fully controlled entry and exit points to prevent unauthorized
                                            individuals from accessing the premises.
                                        </li>
                                        <li>
                                            <b>8.Fire Safety: </b> Providers have fire safety measures in place, such as smoke detectors, fire extinguishers, and evacuation plans.
                                            Regular fire drills may also be conducted.
                                        </li>
                                        <li>
                                            <b>9.Written Policies and Procedures: </b> Providers have written policies and procedures that outline safety protocols, emergency
                                            procedures, and other important information for parents and caregivers.
                                        </li>
                                        <li>
                                            <b>10.Communication with Parents: </b> Open communication with parents is essential. Providers keep parents informed about their
                                            child's activities, any accidents or incidents, and any changes to the daily routine.
                                        </li>



                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span><i class="far fa-question"></i></span>Why choose High5 Day Care Agency?


                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <h4>For Parents</h4>
                                    High5 Daycare Agency is a one-stop solutions for parents looking for safe and professional daycare. We provide complete 360 services, from helping you find a provider, to setting up interviews, taking care of all the paperwork, and guaranteeing quality services. You can be sure that your child is in good care as our home visitors make monthly unannounced visits to daycare providers to ensure that they meet the standards set by the CCEYA.<br>
                                    <h4 style="margin-top: 10px">For Providers </h4>
                                    Being a provider with High5 Day Care Agency, you will be required to handle multiple tasks related to your daycare children, such as training, advertising, providing learning activities, helping with meal plans and outdoor activities whilst ensuring good hygiene, managing sleep schedules, and helping with diaper change, whenever required. <br>
                                    Prior to starting care, providers are required to submit CPR and first aid certifications, medical clearances and fire evacuation plans, as well as pet vaccination documents.


                                </div>
                            </div>
                        </div> -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span><i class="far fa-question"></i></span> Why parents choose Home Daycare Vs. Childcare Center?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    It is essential to provide children with a nurturing and secure environment such as home, where your child can feel safe rather than in a classroom environment. One-on-one attention is extremely beneficial in shaping their personality. Small groups foster more interaction and create a strong bond that encourages confidence and promotes intelligence.

                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <span><i class="far fa-question"></i></span> Why parents choose Licensed Home Daycare Vs. Unlicensed?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Licensed home care agencies provide the best safety and well-being for children due to the following benefits:

                                    <ul class="about-list list-unstyled">
                                        <li>
                                            Professionally trained providers
                                        </li>
                                        <li>
                                            Unannounced visits to monitor compliance with CCEYA standards
                                        </li>
                                        <li>Limited number of children per house to ensure one-on-one attention
                                        </li>
                                        <li>Government standards for maintaining a license are adhered to, including fire escape plans, menu plans, space requirements, babyproofing, outdoor activity plans, and Ministry of Education visits
                                        </li>


                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- faq area end -->


    <!-- testimonial-area -->
    <div class="testimonial-area bg py-80" style="">
        <div class="shape">
            <img class="shape-2 horizontal-animation" src="{{ asset('assets/website/img/shape/16.png') }}" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">Testimonials</span>
                        <h2 class="site-title">What Our Client <span>Say's</span> About Us</h2>
                    </div>
                </div>
            </div>
            <div class="testimonial-slider owl-carousel owl-theme">
                <div class="testimonial-single">
                    <div class="testimonial-content">

                        <div class="testimonial-author-info">
                            <h4>Shaheryar Khan</h4>
                        </div>
                    </div>
                    <div class="testimonial-quote">
                        <span class="testimonial-quote-icon"><i class="flaticon-quote-hand-drawn-symbol"></i></span>
                        <p>
                            Exceptional day care that provides personalized attention and a secure haven for children to thrive in. A five-star gem for nurturing and safeguarding young minds!
                        </p>
                        <div class="testimonial-quote-icon">
                            <img src="{{ asset('assets/website/img/icon/quote.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="testimonial-rate">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="testimonial-single">
                    <div class="testimonial-content">

                        <div class="testimonial-author-info">
                            <h4>Arif Pyarali</h4>
                        </div>
                    </div>
                    <div class="testimonial-quote">
                        <span class="testimonial-quote-icon"><i class="flaticon-quote-hand-drawn-symbol"></i></span>
                        <p>
                            My son went to High5 Licensed daycare and I would highly recommend this day care service.
                            My son developed cognitive skills and collaborative learning in impressive time.
                            High5 day care providers are responsible and highly professional.
                        </p>
                        <div class="testimonial-quote-icon">
                            <img src="{{ asset('assets/website/img/icon/quote.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="testimonial-rate">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="testimonial-single">
                    <div class="testimonial-content">

                        <div class="testimonial-author-info">
                            <h4>Sumaya khan malik</h4>
                        </div>
                    </div>
                    <div class="testimonial-quote">
                        <span class="testimonial-quote-icon"><i class="flaticon-quote-hand-drawn-symbol"></i></span>
                        <p>
                            Highly recommended. The service provided by Sidra and her team are exceptional. Choosing the right daycare
                            for any parent can be challaneging and overwhelming however, Sidra ensured to provide us with the best
                            facilities, staff and most imortantly a safe environment where our little ones can learn and play happily.
                        </p>
                        <div class="testimonial-quote-icon">
                            <img src="{{ asset('assets/website/img/icon/quote.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="testimonial-rate">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="testimonial-single">
                    <div class="testimonial-content">

                        <div class="testimonial-author-info">
                            <h4>Tooba Tariq</h4>
                        </div>
                    </div>
                    <div class="testimonial-quote">
                        <span class="testimonial-quote-icon"><i class="flaticon-quote-hand-drawn-symbol"></i></span>
                        <p>
                            Excellent place for kids!! We have been nothing but impressed by the program and the engaging activities the
                            kids get to do here. The facility is clean and bright and seems to be a great environment. We are so happy to
                            have found this center and would recommend it to anyone looking for daycare.
                        </p>
                        <div class="testimonial-quote-icon">
                            <img src="{{ asset('assets/website/img/icon/quote.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="testimonial-rate">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <div class="testimonial-single">
                    <div class="testimonial-content">

                        <div class="testimonial-author-info">
                            <h4>Amna Ammar</h4>
                        </div>
                    </div>
                    <div class="testimonial-quote">
                        <span class="testimonial-quote-icon"><i class="flaticon-quote-hand-drawn-symbol"></i></span>
                        <p>
                            Looking for a Daycare to care for my son was definitely a challenging and an emotional task. Fortunately we came across Sidra at High 5! Our experience has been great and the environment meets all our criteria for being safe, educational, caring and fun! Plenty of activities with regular adventures outside. There are lots of stimulating and educational learnings and my son is really happy with the friends he’s made there.
                        </p>
                        <div class="testimonial-quote-icon">
                            <img src="{{ asset('assets/website/img/icon/quote.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="testimonial-rate">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="testimonial-single">
                    <div class="testimonial-content">

                        <div class="testimonial-author-info">
                            <h4>Dureem Munir</h4>
                        </div>
                    </div>
                    <div class="testimonial-quote">
                        <span class="testimonial-quote-icon"><i class="flaticon-quote-hand-drawn-symbol"></i></span>
                        <p>
                            I have a very good experience with this day care agency. Sidra who is the director is very helpful and supportive as it took a while for my son to get settled in daycare environment. She did regular visits to the daycare to see that everything was going on according to the Ministry regulations. My childcare provider (Anila) was a very loving lady and my son was very happy with her. She was very understanding and never bothered me.
                        </p>
                        <div class="testimonial-quote-icon">
                            <img src="{{ asset('assets/website/img/icon/quote.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="testimonial-rate">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="testimonial-single">
                    <div class="testimonial-content">

                        <div class="testimonial-author-info">
                            <h4>Sidra Moosa</h4>
                        </div>
                    </div>
                    <div class="testimonial-quote">
                        <span class="testimonial-quote-icon"><i class="flaticon-quote-hand-drawn-symbol"></i></span>
                        <p>
                            Grateful to be a part of the High5 Daycare Agency! 🌟 From licensing assistance to valuable resources, it's been a collaborative journey. Appreciate the balanced, yet effective, approach in guiding daycare providers like me.
                        </p>
                        <div class="testimonial-quote-icon">
                            <img src="{{ asset('assets/website/img/icon/quote.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="testimonial-rate">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="testimonial-single">
                    <div class="testimonial-content">

                        <div class="testimonial-author-info">
                            <h4>Asma Imran</h4>
                        </div>
                    </div>
                    <div class="testimonial-quote">
                        <span class="testimonial-quote-icon"><i class="flaticon-quote-hand-drawn-symbol"></i></span>
                        <p>
                            Working with high five has been a great experience. Our daycare director has been an amazing and flexible person to work with. She respects and understands all of us. Anytime I have a concern or issue, our director is always considerate and handles problems with care.
                        </p>
                        <div class="testimonial-quote-icon">
                            <img src="{{ asset('assets/website/img/icon/quote.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="testimonial-rate">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="testimonial-single">
                    <div class="testimonial-content">

                        <div class="testimonial-author-info">
                            <h4>Anum Ghafoor</h4>
                        </div>
                    </div>
                    <div class="testimonial-quote">
                        <span class="testimonial-quote-icon"><i class="flaticon-quote-hand-drawn-symbol"></i></span>
                        <p>
                            I have been working with high5 from 1 year. What I enjoy about working with high5 is they give exceptional guidance and training. My director and home visitor is so supportive and professional . The children in my care, I treat them like my family. I am so proud and happy to see the children grow up as they move on to school.
                        </p>
                        <div class="testimonial-quote-icon">
                            <img src="{{ asset('assets/website/img/icon/quote.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="testimonial-rate">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="testimonial-single">
                    <div class="testimonial-content">

                        <div class="testimonial-author-info">
                            <h4>Shamim Akhtar</h4>
                        </div>
                    </div>
                    <div class="testimonial-quote">
                        <span class="testimonial-quote-icon"><i class="flaticon-quote-hand-drawn-symbol"></i></span>
                        <p>
                            Working with high5 is such a good experience. My director is very passionate and supportive. Always ready to help in any situation. I never had any problem regarding kids and parents and payments. she always make sure that she follows the ministry guidelines and give us different activities time to time.
                        </p>
                        <div class="testimonial-quote-icon">
                            <img src="{{ asset('assets/website/img/icon/quote.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="testimonial-rate">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="testimonial-single">
                    <div class="testimonial-content">

                        <div class="testimonial-author-info">
                            <h4>Ameena</h4>
                        </div>
                    </div>
                    <div class="testimonial-quote">
                        <span class="testimonial-quote-icon"><i class="flaticon-quote-hand-drawn-symbol"></i></span>
                        <p>
                            I have been working for High5 Daycare Agency for sometime and I already love it. I love the strong and hard working management, I found Specially Sidra a knowledgeable person who is actively working hard to help parents to find loving home daycare for their little ones. She also fully cooperate with home daycare providers to help them to do their best to provide safe, secure and healthy child care environment to support the optimal development of young children. Thank you Sidra !
                        </p>
                        <div class="testimonial-quote-icon">
                            <img src="{{ asset('assets/website/img/icon/quote.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="testimonial-rate">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- testimonial-area end -->

    <!-- blog-area -->
    <div class="blog-area pt-120 pb-80" style="display: none">
        <div class="shape">
            <img class="shape-1 horizontal-animation" src="{{ asset('assets/website/img/shape/20.png') }}" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">Our Blog</span>
                        <h2 class="site-title">Get Our Latest <span>Update</span> News & Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6 col-lg-4">
                    <div class="blog-item">
                        <div class="blog-item-img">
                            <img src="{{ asset('assets/website/img/blog/01.jpg') }}" alt="Thumb">
                        </div>
                        <div class="blog-item-info">
                            <div class="blog-item-meta">
                                <ul>
                                    <li><a href="#"><i class="far fa-user-circle"></i> By Alicia Davis</a></li>
                                    <li><a href="#"><i class="far fa-calendar-alt"></i> August 25, 2022</a></li>
                                </ul>
                            </div>
                            <h4 class="blog-title">
                                <a href="#">There are many passages of the available suffered</a>
                            </h4>
                            <p>At vero eos et accusamus et iusto odio the dignissimos ducimus qui blanditiis deleniti sunt in culpa qui offici atque.</p>
                            <a class="theme-btn" href="#">Read More<i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="blog-item">
                        <div class="blog-item-img">
                            <img src="{{ asset('assets/website/img/blog/02.jpg') }}" alt="Thumb">
                        </div>
                        <div class="blog-item-info">
                            <div class="blog-item-meta">
                                <ul>
                                    <li><a href="#"><i class="far fa-user-circle"></i> By Alicia Davis</a></li>
                                    <li><a href="#"><i class="far fa-calendar-alt"></i> August 25, 2022</a></li>
                                </ul>
                            </div>
                            <h4 class="blog-title">
                                <a href="#">There are many passages of the available suffered</a>
                            </h4>
                            <p>At vero eos et accusamus et iusto odio the dignissimos ducimus qui blanditiis deleniti sunt in culpa qui offici atque.</p>
                            <a class="theme-btn" href="#">Read More<i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="blog-item">
                        <div class="blog-item-img">
                            <img src="{{ asset('assets/website/img/blog/03.jpg') }}" alt="Thumb">
                        </div>
                        <div class="blog-item-info">
                            <div class="blog-item-meta">
                                <ul>
                                    <li><a href="#"><i class="far fa-user-circle"></i> By Alicia Davis</a></li>
                                    <li><a href="#"><i class="far fa-calendar-alt"></i> August 25, 2022</a></li>
                                </ul>
                            </div>
                            <h4 class="blog-title">
                                <a href="#">There are many passages of the available suffered</a>
                            </h4>
                            <p>At vero eos et accusamus et iusto odio the dignissimos ducimus qui blanditiis deleniti sunt in culpa qui offici atque.</p>
                            <a class="theme-btn" href="#">Read More<i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog-area end -->

    <!-- Contact Section Start  -->

    <div id='contact' class="contact-area">
        <div class="hero-section">
            <div class="hero-shape">
                <!-- <img class="hero-shape-1" src="{{ asset('assets/website/img/shape/01.png') }}" alt=""> -->
                <img class="hero-shape-2" src="{{ asset('assets/website/img/shape/02.png') }}" alt="">
            </div>

            <div class="hero-slider ">
                <div class="hero-single" style="background: url({{ asset('assets/slider/slider-3.jpg') }});    background-attachment: fixed;">
                    <div class="container">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-8 col-lg-8 ">
                                <div class="hero-content px-20">
                                    <div class='site-heading'>
                                        <h6 class="site-title wow animate__animated animate__fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">Contact Us</h6>
                                    </div>

                                    <form action="{{ route('form.submit') }}"  method="POST">
                                        @csrf
                                        <div class="row mx-auto">
                                            <div class="form-group col-lg-6">
                                                <label for="inputName">Name</label>
                                                <input type="text" class="form-control" name="name" id="inputName" placeholder="Enter Your Name" required>
                                                @error('name')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="inputEmail">Email</label>
                                                <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Enter Your Email" required>
                                                @error('email')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mx-auto">
                                            <div class="form-group col-lg-12">
                                                <label for="inputPhone">Phone Number</label>
                                                <input type="number" class="form-control" id="inputPhone" name="phone_number" placeholder="Enter Your Phone" required>
                                                @error('phone_number')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mx-auto">
                                            <div class="form-group col-lg-12">
                                                <label for="inputMessage">Message</label>
                                                <textarea rows="3" type="text" class="form-control" name="message" id="inputMessage" placeholder="Enter Your Message" required></textarea>
                                                @error('message')
                                                <div style="color: red;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mx-auto">
                                            <div class="form-group">
                                                <label for="">I am a</label>
                                                <div class="row">
                                                    <div class="form-radio col-lg-3">
                                                        <input class="form-radio-input" name="type" type="radio" id="parent" value="parent" required>
                                                        <label class="form-radio-label" for="parent">Parent</label>
                                                    </div>
                                                    <div class="form-radio col-lg-3">
                                                        <input class="form-radio-input" name="type" type="radio" id="childprovider" value="childprovider" required>
                                                        <label class="form-radio-label" for="childprovider">Child Provider</label>
                                                    </div>
                                                    <div class="form-radio col-lg-3">
                                                        <input class="form-radio-input" name="type" type="radio" id="other" value="other" required>
                                                        <label class="form-radio-label" for="other">Other</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mx-auto justify-content-center py-20">
                                            <button type="submit" value="Submit" class="theme-btn theme-btn2 col-lg-2">Submit</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section End -->

    <!-- partner area -->
    <div class="partner-area pt-50 pb-50">
        <div class="container">
            <div class="partner-wrapper partner-slider owl-carousel owl-theme">
                <img src="{{ asset('assets/website/1.png') }}" alt="thumb">
                <img src="{{ asset('assets/website/3.png') }}" alt="thumb">
                <img src="{{ asset('assets/website/4.png') }}" alt="thumb">
                <img src="{{ asset('assets/website/6.png') }}" alt="thumb">
                <img src="{{ asset('assets/website/5.png') }}" alt="thumb">

            </div>
        </div>
    </div>
    <!-- partner area end -->


</main>
<!-- js -->
<script src="{{ asset('assets/website/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/website/js/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/website/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/website/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/website/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/website/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/website/js/jquery.appear.min.js') }}"></script>
<script src="{{ asset('assets/website/js/jquery.easing.min.js') }}"></script>
<script src="{{ asset('assets/website/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/website/js/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/website/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/website/main.js') }}"></script>

<script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel({
            // Add your configuration options here
            items: 3,
            loop: true,
            margin: 20,
            autoplay: true, // Enable auto-loop
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 1 // Display 1 item on screens less than 600px
                },
                600: {
                    items: 2 // Display 3 items on screens between 600px and 991px
                },
                992: {
                    items: 3 // Display 4 items on screens 992px and above
                }
                // Add more responsive breakpoints as needed
            }
            // Other options...
        });
    });
</script>


<!-- Start of LiveChat (www.livechat.com) code -->
<script>
    window.__lc = window.__lc || {};
    window.__lc.license = 17105016;
    ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
</script>
<noscript><a href="https://www.livechat.com/chat-with/17105016/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
<!-- End of LiveChat code -->



<!-- Start Code for Contact Email  -->
<script src="https://cdn.emailjs.com/dist/email.min.js"></script>
<script>
    emailjs.init("9qU0JXZdyt4-vDQeT");
</script>
<!-- 
<script>
    // Function to get the selected radio button value
    function getSelectedRadioValue(name) {
        var selectedRadio = document.querySelector('input[name="' + name + '"]:checked');

        if (selectedRadio) {
            return selectedRadio.value;
        }

        // Return a default value or handle the case when no radio button is selected
        return null;
    }

    document.getElementById("myForm").onsubmit = function(event) {
        event.preventDefault();

        // Get form data
        var formData = {
            name: document.getElementById("inputName").value,
            email: document.getElementById("inputEmail").value,
            message: document.getElementById("inputMessage").value,
            phone: document.getElementById("inputPhone").value,
            myself: getSelectedRadioValue("myself")
            // Add other form fields as needed
        };
        console.log('formData', formData);

        // Send email using email.js
        emailjs.send("service_i0rhz27", "template_uhifpzv", formData)
            .then(function(response) {
                console.log("Email sent successfully:", response);
                location.reload();
            })
            .catch(function(error) {
                console.error("Error sending email:", error);
            });
    };
</script> -->



@endsection