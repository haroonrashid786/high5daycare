@extends('layouts.website')
@section('title', ' High5 Daycare')
@section('content')

<style>
    .team-content ul{
        padding-left: 20px;
    }
    .team-content ul li{
        list-style: disc !important;
    }
</style>

<main class="main">

    <!-- breadcrumb -->
    <div class="site-breadcrumb" style="background: url({{ asset('assets/website/img/slider/slider-2.jpg') }})">
        <div class="container">
            <h2 class="breadcrumb-title">About us</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('website') }}">Home</a></li>
                <li class="active">About us</li>
            </ul>
            <div class='mt-2'>
               <a href="{{ asset('assets/pdf/parent-guide-latest-agency-1.docx') }}" download="" class="theme-btn mt-2">Parent Guide </a>
            </div>
        </div>
        <div class="hero-shape">
            <img class="hero-shape-1" src="{{ asset('assets/website/img/shape/01.png') }}" alt="">
        </div>
    </div>
    <!-- breadcrumb end -->

    <div class="about-area pt-80 pb-80">
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
                            <h2 class="site-title">
                               Sidra Altaf
                            </h2>
                            <span class="site-title-tagline">Founder</span>
                        </div>
                        <p class="about-text">
                        Meet the Heart Behind High5 Daycare Agency.
                        </p>
                        <div class="about-list-wrapper">
                            <ul class="about-list list-unstyled">
                                <li>
                                With a passion for nurturing young minds and over a decade of hands-on experience, Sidra Altaf is the visionary founder of High5 Daycare Agency. As a dedicated advocate for quality childcare, Sidra brings a wealth of expertise and a genuine love for fostering an environment where children can thrive.
                                </li>
                                <li>
                                Having spent the last 10 years committed to the field, Sidra Altaf has cultivated a deep understanding of the unique needs of each child. This extensive experience has shaped the ethos of High5 Daycare Agency, where excellence, compassion, and a home-like atmosphere are at the core of every childcare service provided.
                                </li>
                                <li>Driven by the belief that every child deserves a strong foundation for their future, Sidra Altaf has meticulously designed the agency's approach. This approach emphasizes play, exploration, and creativity, creating an enriching experience that prepares children for the exciting journey ahead.</li>
                                <li>As the founder of High5 Daycare Agency, Sidra Altaf is not only a seasoned professional but also a warm and caring presence in the lives of the children and families served. The agency reflects Sidra's commitment to providing a safe, nurturing, and joyful environment where each child's early years are marked by love, laughter, and lasting learning experiences.</li>

                            </ul>
                           
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

 <!-- about area -->
    <div class="about-area pt-80 pb-80">
        <div class="shape">
            <img class="shape-1 horizontal-animation" src="{{ asset('assets/website/img/shape/07.png') }}" alt="">
            <!-- <img class="shape-2 horizontal-animation" src="{{ asset('assets/website/img/shape/07.png') }}" alt=""> -->
            <!-- <img class="shape-4 horizontal-animation" src="{{ asset('assets/website/img/shape/08.png') }}" alt=""> -->
        </div>
        <div class="container" id="aboutus">
            <div class="row align-items-center">
              
                <div class="col-lg-6">
                    <div class="about-right">
                        <div class="site-heading mb-3">
                            <h2 class="site-title">
                                Akif Jamal
                            </h2>
                            <span class="site-title-tagline">Co Founder</span>
                        </div>
                        <p class="about-text">
                        Meet the Co Founder of High5 Daycare Agency.
                        </p>
                        <div class="about-list-wrapper">
                            <ul class="about-list list-unstyled">
                                <li>The co-founder leading High5 Daycare Agency's expansion across Ontario. With a background in business strategy, Akif envisions extending the agency's excellence from Halton Region to every corner of the province.</li>
                                <li>Committed to transformative early childhood education, his mission is to enhance every child's day at High5. Akif's strategic mindset contributes to establishing High5 as a trusted name synonymous with top-notch childcare services.</li>
                                <li>He aims to impact families and communities positively, fostering a professional, safe, and enriching childcare environment. "In nurturing young minds, we shape a brighter tomorrow for our children and communities.</li>

                            </ul>
                           
                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-left">
                        <div class="about-img vertical-animation">
                            <img src="{{ asset('assets/website/img/blog/05.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about area end -->
 <!-- about area -->
    <div class="about-area pt-80 pb-80">
        <div class="shape">
           
        <!-- <img class="shape-1 horizontal-animation" src="{{ asset('assets/website/img/shape/06.png') }}" alt=""> -->
            <img class="shape-2 horizontal-animation" src="{{ asset('assets/website/img/shape/07.png') }}" alt="">
            <!-- <img class="shape-4 horizontal-animation" src="{{ asset('assets/website/img/shape/08.png') }}" alt=""> -->
        </div>
        <div class="container" id="aboutus">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-left">
                        <div class="about-img vertical-animation">
                            <img src="{{ asset('assets/website/img/blog/03.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-right">
                        <div class="site-heading mb-3">
                            <h2 class="site-title">
                               Aliya
                            </h2>
                            <span class="site-title-tagline">Home visitor</span>
                        </div>
                        <p class="about-text">
                        Home Visitor with High5 Day Care.
                        </p>
                        <div class="about-list-wrapper">
                            <ul class="about-list list-unstyled">
                               <li>I’m a Registered Early Childhood Educator and has been in the field for more than 10 years. I have also experience working as Educational Resource Worker for almost 2 years where I would work with children with special needs in a school setting.
                                            My role as a Home Visitor is to mentor and support High5 Day Care Providers by spending time in discussion with the provider about children in her care, child development issues and programming. I also spend time observing and interacting with children which allows me to assess that children are receiving a variety of stimulating activities.</li>

                            </ul>
                           
                        </div>

                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- about area end -->
    <!-- about area -->
    <div class="about-area pt-80 pb-80">
        <div class="shape">
            <img class="shape-1 horizontal-animation" src="{{ asset('assets/website/img/shape/06.png') }}" alt="">
          
        </div>
        <div class="container" id="aboutus">
            <div class="row align-items-center">
               
                <div class="col-lg-6">
                    <div class="about-right">
                        <div class="site-heading mb-3">
                            <h2 class="site-title">
                            Zain Mahmood
                            </h2>
                            <span class="site-title-tagline">Chief IT Officer</span>
                        </div>
                        <p class="about-text">
                            Chief IT Officer with High5 Day Care.
                        </p>
                        <div class="about-list-wrapper">
                            <ul class="about-list list-unstyled">
                             <li>The mastermind behind High5 Daycare Agency's digital presence. As our IT Expert and Software Developer, Zain brings innovation and technical prowess to the forefront. With a knack for crafting seamless online experiences, he has designed and implemented the digital framework that enhances our outreach. Zain's expertise ensures a cutting-edge website and robust IT infrastructure, seamlessly integrating technology to support our mission of providing top-tier childcare services. His dedication to excellence propels High5 into the digital era, ensuring a harmonious blend of technology and compassionate childcare. </li>

                            </ul>
                           
                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-left">
                        <div class="about-img vertical-animation">
                            <img src="{{ asset('assets/website/img/blog/04.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about area end -->
    <div class="about-area pt-80 pb-80">
        <div class="shape">
           
        <!-- <img class="shape-1 horizontal-animation" src="{{ asset('assets/website/img/shape/06.png') }}" alt=""> -->
            <img class="shape-2 horizontal-animation" src="{{ asset('assets/website/img/shape/07.png') }}" alt="">
            <!-- <img class="shape-4 horizontal-animation" src="{{ asset('assets/website/img/shape/08.png') }}" alt=""> -->
        </div>
        <div class="container" id="aboutus">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-left">
                        <div class="about-img vertical-animation">
                            <img src="{{ asset('assets/website/img/blog/06.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-right">
                        <div class="site-heading mb-3">
                            <h2 class="site-title">
                                Haroon Lazar
                            </h2>
                            <span class="site-title-tagline">Financial Analyst</span>
                        </div>
                        <p class="about-text">
                        Financial Analyst with High5 Day Care.
                        </p>
                        <div class="about-list-wrapper">
                            <ul class="about-list list-unstyled">
                               <li>Our meticulous Financial Analyst at High5 Daycare Agency. With a sharp focus on numbers, Haroon ensures the financial well-being of the agency. His expertise in finance and keen attention to detail contribute to effective budget management and planning. As the silent force behind our fiscal operations, Haroon plays a pivotal role, enabling the team to deliver exceptional childcare services with financial stability and efficiency.</li>
                            </ul>
                           
                        </div>

                    </div>
                </div>
                
            </div>
        </div>
    </div>

    

</main>

@endsection