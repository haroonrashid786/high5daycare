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

    .shapw_right{
        left: auto !important;
        right: 30px !important;
    }

    @media screen and (max-width: 992px) {
        .container{
            padding: 20px 10px !important;
        }
        .choose-content {
            padding: 0;
            padding-top: 20px;
        }
    }

    .site-breadcrumb{
        padding: 120px 0;
    }
    
</style>

<main class="main">

    <!-- breadcrumb -->
    <div class="site-breadcrumb" style="background: url({{ asset('assets/website/img/slider/slider-2.jpg') }})">
        <div class="container">
            <h2 class="breadcrumb-title">Parents</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('website') }}">Home</a></li>
                <li class="active">Parents</li>
            </ul>
            <div class="header-btn mt-2">
                <a href="{{ asset('assets/pdf/ChildCareApplication.pdf') }}" download="" class="theme-btn mt-2">Child Care Application </a>
            </div>
        </div>
        <div class="hero-shape">
            <img class="hero-shape-1" src="{{ asset('assets/website/img/shape/01.png') }}" alt="">
        </div>
    </div>
    <!-- breadcrumb end -->

       <!-- choose-area -->
       <div class="choose-area pt-40 pb-40">
        <div class="shape">
            <img class="shape-3 horizontal-animation" src="{{ asset('assets/website/img/shape/24.png') }}" alt="">
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="choose-content">
                        <div class="site-heading mb-4">
                            <span class="site-title-tagline">Parents </span>
                            <h2 class="site-title mb-10">We are dedicated <span>to provide</span> quality care</h2>
                            
                        </div>
                        <div class="choose-content-wrapper">
                            <div class="choose-item mt-0">
                                <!-- <div class="choose-item-icon">
                                    <img src="{{ asset('assets/website/img/icon/light.svg') }}" alt="">
                                </div> -->
                                <div class="choose-item-info">
                                    <!-- <h3>Special Education</h3> -->
                                    <p> Welcome to High5 Daycare, where we start every child's adventure with love, laughter, and learning. As a licensed daycare dedicated to excellence, we take pride in making a safe and caring space that feels like a second home for your little ones.</p>
                                </div>
                            </div>
                            <div class="choose-item">
                                <!-- <div class="choose-item-icon">
                                    <img src="{{ asset('assets/website/img/icon/light.svg') }}" alt="">
                                </div> -->
                                <div class="choose-item-info">
                                    <!-- <h3>Special Education</h3> -->
                                    <p>Our story begins with a team of caring providers who have lots of experience and a real love for kids. We know that each child is special, and our devoted provider is here to help them grow and learn every step of the way.</p>
                                </div>
                            </div>
                            <div class="choose-item">
                                <!-- <div class="choose-item-icon">
                                    <img src="{{ asset('assets/website/img/icon/lab.svg') }}" alt="">
                                </div> -->
                                <div class="choose-item-info">
                                    <!-- <h3>Digital Laboratory</h3> -->
                                    <p>At High5 Daycare, we believe in the fun and excitement of play, exploration, and creativity. Our special plan for learning is made to make little minds happy and ready for school. From cool activities to creative playtime, we offer a mix of experiences that get kids ready for a great start in school.</p>
                                </div>
                            </div>
                           
                           
                           
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="choose-img-box">
                        <img class="choose-img" src="{{ asset('assets/website/img/parents/parent1.jpg') }}" alt="">
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
                        <img class="choose-img" src="{{ asset('assets/website/img/parents/parent2.jpg') }}" alt="">
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
                        <div class="choose-item">
                                <!-- <div class="choose-item-icon">
                                    <img src="{{ asset('assets/website/img/icon/event.svg') }}" alt="">
                                </div> -->
                                <div class="choose-item-info">
                                    <!-- <h3>Events And Party</h3> -->
                                    <p>Safety is super important to us. Being a licensed daycare, we follow the best rules, making sure the place is safe and clean for your child. Our spaces have all the latest safety stuff, and our team is trained to deal with any problems carefully and quickly.</p>
                                </div>
                            </div>
                      
                    <div class="choose-item">
                                    <!-- <div class="choose-item-icon">
                                        <img src="{{ asset('assets/website/img/icon/event.svg') }}" alt="">
                                    </div> -->
                                    <div class="choose-item-info">
                                        <!-- <h3>Events And Party</h3> -->
                                        <p>We know how vital it is to keep in touch with parents. Our doors are always open, and we love it when you get involved in your child's day. Regular updates, meeting with providers and special events make a strong community, and you become a big part of the High5 Daycare family.</p>
                                    </div>
                                </div>
                    <div class="choose-item">
                                <!-- <div class="choose-item-icon">
                                    <img src="{{ asset('assets/website/img/icon/event.svg') }}" alt="">
                                </div> -->
                                <div class="choose-item-info">
                                    <!-- <h3>Events And Party</h3> -->
                                    <p>Picking a daycare is a big choice, and we're happy you're thinking about High5 Daycare. </p>
                                </div>
                            </div>
                            <div class="choose-item">
                                <!-- <div class="choose-item-icon">
                                    <img src="{{ asset('assets/website/img/icon/event.svg') }}" alt="">
                                </div> -->
                                <div class="choose-item-info">
                                    <!-- <h3>Events And Party</h3> -->
                                    <p>Our homes are contracted and licensed by the Ministry of Education through us. This means that our providers are required to adhere to established standards and regulations to maintain their licensing through our organization. </p>
                                </div>
                            </div>
                            <div class="choose-item">
                                <!-- <div class="choose-item-icon">
                                    <img src="{{ asset('assets/website/img/icon/event.svg') }}" alt="">
                                </div> -->
                                <div class="choose-item-info">
                                    <!-- <h3>Events And Party</h3> -->
                                    <p>Join us in making happy and smart memories for your child's early years. Together, let's start a journey of growth, friendship, and lots of possibilities at High5 Daycare. </p>
                                </div>
                            </div>
                
                           
                           
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
    
    </div>
    <!-- choose-area end -->
       <!-- choose-area -->
       <div class="choose-area pb-40">
        <div class="shape">
            <img class=" shape-3 shapw_right horizontal-animation" src="{{ asset('assets/website/img/shape/24.png') }}" alt="">
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="choose-content">
                        <div class="site-heading mb-4">
                            <span class="site-title-tagline">Parents </span>
                            <h2 class="site-title mb-10">Quality <span>first</span> Program</h2>
                            
                        </div>
                        <div class="choose-content-wrapper">
                            <div class="choose-item mt-0">
                                <!-- <div class="choose-item-icon">
                                    <img src="{{ asset('assets/website/img/icon/light.svg') }}" alt="">
                                </div> -->
                                <div class="choose-item-info">
                                    <!-- <h3>Special Education</h3> -->
                                    <p> High5 Daycare Agency participates in Quality First program , who supports licensed child care programs by providing coaching and consultation by a Quality First Consultant, ongoing Professional Learning, self-reflection activities, and targeted support from a consultant to reach your established goals.Our home visitor, in collaboration with the Quality First program consultant, assists in defining goals and developing action steps to achieve the annual objectives. Goals are established by aligning with the provider's specific aims for running their daycare business or addressing challenges encountered in previous years to ensure the delivery of a high-quality program.</p>
                                    <p>If you would like to more information on Quality First please visit <a href="https://thrc.ca/quality-first/" target="_blank"><b>THRC Website</b></a></p>
                                </div>
                            </div>
                          
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="choose-img-box">
                        <img class="choose-img last_img" src="{{ asset('assets/website/img/parents/parent3.jpg') }}" alt="">
                        <!-- <div class="video-wrapper">
                            <a class="play-btn popup-youtube" href="https://www.youtube.com/watch?v=ckHzmP1evNU">
                                <i class="fas fa-play"></i>
                            </a>
                        </div> -->
                        
                    </div>
                </div>
                
            </div>
        </div>
       
    
    </div>
    <!-- choose-area end -->
    <div class="choose-area pb-80">
        <div class="shape">
            <img class="shape-3 horizontal-animation" src="{{ asset('assets/website/img/shape/24.png') }}" alt="">
        </div>
        <div class="container">
            <div class="row align-items-center">
            <div class="col-lg-6">
                    <div class="choose-img-box">
                        <img class="choose-img " src="{{ asset('assets/website/img/parents/home_visitor.jpg') }}" alt="">
                        <!-- <div class="video-wrapper">
                            <a class="play-btn popup-youtube" href="https://www.youtube.com/watch?v=ckHzmP1evNU">
                                <i class="fas fa-play"></i>
                            </a>
                        </div> -->
                        
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="choose-content">
                        <div class="site-heading mb-4">
                            <span class="site-title-tagline">Parents </span>
                            <h2 class="site-title mb-10">Home <span>visitor</span></h2>
                            
                        </div>
                        <div class="choose-content-wrapper">
                            <div class="choose-item mt-0">
                                <!-- <div class="choose-item-icon">
                                    <img src="{{ asset('assets/website/img/icon/light.svg') }}" alt="">
                                </div> -->
                                <div class="choose-item-info">
                                    <!-- <h3>Special Education</h3> -->
                                    <p> Home visitor is a registered early childhood educator, who plays a vital role in supporting and enhancing the quality of care provided in home-based settings. She visits every provider as unannounced visit on monthly basis to ensure  the rules and regulations set forth by the Childcare and Early Years Act, 2014 (CCEYA) are being met . She follow the inspection checklist approved by Ministry guidelines in each visit  . Tasked with ensuring , the home visitor conducts thorough safety inspections, identifying and rectifying potential hazards to create a secure environment for children. Providing ongoing training and support, they serve as a valuable resource for home daycare providers, offering guidance on best practices in childcare, early childhood development, and health and safety protocols. Additionally, the home visitor monitors the individual development of each child, offering insights into age-appropriate activities and interventions. Facilitating communication with parents, conducting regular meetings During crises or challenging situations, the home visitor offers timely assistance and guidance by visiting the  providers and settling the child. By encouraging ongoing professional development and maintaining accurate records, the home visitor contributes significantly to the overall quality and safety of childcare in the home-based setting, ensuring a positive and enriching experience for the children and their families.</p>
                                </div>
                            </div>
                          
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
       
    
    </div>

</main>

@endsection