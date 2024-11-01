<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- title -->
    <title>@yield('title')</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/logo/favicon.png">

    <!-- css -->
    <link rel="stylesheet" href="{{ asset('assets/website/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/all-fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="icon" href="{{ asset('assets/media/logos/favicon.png') }}">
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/node-snackbar@latest/src/js/snackbar.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/node-snackbar@latest/dist/snackbar.min.css" />
    <style type="text/css">
        h4 {
            font-size: 20px;
        }
    </style>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-DFGY3K4E3Y"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-DFGY3K4E3Y');
    </script>
</head>

<body>

    <!-- preloader -->
    <!-- <div class="preloader">
        <div class="loader"></div>
    </div> -->
    <!-- preloader end -->


    <!-- header area -->
    <header class="header">
        <!-- top header -->
        <div class="header-top">
            <div class="container">
                <div class="header-top-wrapper">
                    <div class="header-top-left">
                        <div class="header-top-contact">
                            <ul>
                                <li>
                                    <div class="header-top-contact-info">
                                        <a href="#">Licensed Home Childcare Agency</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="header-top-right">
                        <div class="header-top-contact">
                            <ul>
                                <li>
                                    <div class="header-top-contact-icon">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </div>
                                    <div class="header-top-contact-info">
                                        <a href="https://api.whatsapp.com/send?phone=19054628120&text=Hello" target="_blank">+1 (905) 462-8120</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="header-top-contact-icon">
                                        <i class="far fa-envelopes"></i>
                                    </div>
                                    <div class="header-top-contact-info">
                                        <a href="mailto:info@example.com">info@high5daycare.ca</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="header-top-contact-icon">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div class="header-top-contact-info">
                                        <a href="#">Mon - Fri (7AM - 6PM)</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="main-navigation">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('website') }}">
                        <img src="{{ asset('assets/website/High5_Daycare_Logo.png') }}" alt="logo">
                    </a>
                    <div class="mobile-menu-right">
                        <div class="mobile-menu-list">
                            <a href="#" class="mobile-menu-link search-box-outer"><i class="far fa-search"></i></a>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"><i class="far fa-stream"></i></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="main_nav">
                        <ul class="navbar-nav d-flex" style="align-items: center">
 

                            <!-- <li class="nav-item"><a class="nav-link" href="{{ route('website') }}">Home</a></li> -->
                            <li class="nav-item"><a class="nav-link" href="/#aboutus">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('parents') }}">Parents</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('providers') }}">Providers</a></li>
                            
                            <li class="nav-item"><a class="nav-link" href="{{ route('blogs') }}">Blogs</a></li>
                            <li class="nav-item"><a class="nav-link" href="/#contact">Contact</a></li>
                            <li class="nav-item"><a class="nav-link" href="/#creative">Creative wing</a></li>
                            <li class="nav-item">
                                <a href="{{ route('base') }}" class="theme-btn mt-2">Login </a>
                            </li>
                        </ul>
                        <div class="header-nav-right">
       

                            <div class="header-top-social">
                                <a style="background: #557b43; color: #fff;" href="https://www.facebook.com/High5DaycareInc" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a style="background: #557b43; color: #fff;" href="https://www.instagram.com/high5daycareinc/?igshid=YmMyMTA2M2Y%3D" target="_blank"><i class="fab fa-instagram"></i></a>
                                <a style="background: #557b43; color: #fff;" href="https://api.whatsapp.com/send?phone=19054628120&text=Hello" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                <!-- <a href="#"><i class="fab fa-linkedin-in"></i></a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- header area end -->

    @yield('content')


    <!-- footer area -->
    <footer class="footer-area" id="footer">
        <div class="footer-widget">
            <div class="container">
                <div class="row footer-widget-wrapper">
                    <div class="col-md-6 col-lg-4">
                        <div class="footer-widget-box about-us">
                            <a href="{{ route('website') }}" class="footer-logo">
                                <img src="{{ asset('assets/website/High5_Daycare_Logo.png') }}" alt="">
                            </a>
                            <p class="mb-4">
                                High5 Day Care Inc. is a licensed home childcare agency operating in the Halton region, Ontario. We make an impact on young minds and help to build a better tomorrow for the next generation.
                            </p>

                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Quick Links</h4>
                            <ul class="footer-list">
                                <li><a href="/#aboutus"><i class="far fa-circle-dot"></i> About Us</a></li>
                                <li><a href="/#faqtarget"><i class="far fa-circle-dot"></i> FAQ's</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Contact</h4>
                            <div class="footer-newsletter">
                                <ul class="footer-contact">
                                    <li><a href="https://api.whatsapp.com/send?phone=19054628120&text=Hello" target="_blank"><i class="far fa-phone"></i>+1 (905) 462-8120</a></li>
                                    <li><a href="mailto:info@example.com"><i class="far fa-envelope"></i>
                                            info@high5daycare.ca
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 align-self-center">
                        <p class="copyright-text">
                            &copy; Copyright <span id="date"></span> <a href="{{ route('website') }}"> High5 Daycare Inc. </a> All Rights Reserved. | Design & Develop by <a href="https://hashedsystem.com/" target="_blank"> Hashed System </a>
                        </p>
                    </div>
                    <div class="col-md-4 align-self-center" style="display: none">
                        <ul class="footer-social">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->




    <!-- scroll-top -->
    <a href="#" id="scroll-top"><i class="far fa-arrow-up"></i></a>
    <!-- scroll-top end -->
 

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

<!-- Start of LiveChat (www.livechat.com) code -->
<script>
    window.__lc = window.__lc || {};
    window.__lc.license = 17105016;
    ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
</script>
<noscript><a href="https://www.livechat.com/chat-with/17105016/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
<!-- End of LiveChat code -->

<script>
    $(document).ready(function () {
        // Check if a success or error message is present in the session
        var successMessage = '{{ Session::get("success") }}';
        var errorMessage = '{{ Session::get("error") }}';

        if (successMessage !== '') {
            Snackbar.show({
                pos: 'bottom-center',
                text: successMessage,
                backgroundColor: '#556d33',
                actionTextColor: '#fff',
                duration: 100000,
            });
        }

        if (errorMessage !== '') {
            Snackbar.show({
                pos: 'bottom-center',
                text: errorMessage,
                backgroundColor: '#ea6f44',
                actionTextColor: '#fff',
                duration: 100000,
            });
        }

    });


</script>
</body>

</html>