@extends('layouts.website')
@section('title', ' High5 Daycare')
@section('content')

<main class="main">

    <!-- breadcrumb -->
    <div class="site-breadcrumb" style="background: url({{ asset('assets/website/img/slider/slider-2.jpg') }})">
        <div class="container">
            <h2 class="breadcrumb-title">{{ $blog->title }}</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('website') }}">Home</a></li>
                <li class="active">{{ $blog->title }}</li>
            </ul>
        </div>
        <div class="hero-shape">
            <img class="hero-shape-1" src="{{ asset('assets/website/img/shape/01.png') }}" alt="">
        </div>
    </div>
    <!-- breadcrumb end -->



    <!-- blog single area -->
    <div class="blog-single-area pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-single-wrapper">
                        <div class="blog-single-content">
                            <div class="blog-thumb-img">
                                <img src="{{ url($blog->image) }}" alt="thumb">
                            </div>
                            <div class="blog-info">
                                <div class="blog-meta">
                                    <div class="blog-meta-left">
                                        <ul>
                                            <li><i class="far fa-calendar-alt"></i><a href="#">{{ date('Y-m-d', strtotime($blog->created_at))  }}</a></li>

                                        </ul>
                                    </div>

                                </div>
                                <div class="blog-details">
                                    <h3 class="blog-details-title mb-20">{{ $blog->title }}</h3>
                                    <p class="mb-10">
                                        {{ $blog->content }}
                                    </p>

                                    <hr>

                                </div>

                                <!-- <div class="blog-author">
                                    <div class="blog-author-img">
                                        <img src="{{ asset('assets/website/img/blog/author.jpg') }}" alt="">
                                    </div>
                                    <div class="author-info">
                                        <h6>Author</h6>
                                        <h3 class="author-name">Roger D Duque</h3>
                                        <p>It is a long established fact that a reader will be distracted by the abcd readable content of a page when looking at its layout that more less.</p>
                                        <div class="author-social">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                            <a href="#"><i class="fab fa-whatsapp"></i></a>
                                            <a href="#"><i class="fab fa-youtube"></i></a>
                                        </div>
                                    </div>
                                </div> -->
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar">
                        <!-- search-->
                        <div class="widget search">
                            <h5 class="widget-title">Search</h5>
                            <form class="search-form" action="{{ route('blogs') }}" method="GET">
                                <input type="text" class="form-control" placeholder="Search Here..." name="search_text">
                                <button type="submit"><i class="far fa-search"></i></button>
                            </form>
                        </div>

                        <!-- recent post -->
                        <div class="widget recent-post">
                            <h5 class="widget-title">Recent Post</h5>

                            @foreach($latest as $latestBlogs)
                            <div class="recent-post-single">
                                <div class="recent-post-img">
                                    <img src="{{ url($latestBlogs->image) }}" alt="thumb">
                                </div>
                                <div class="recent-post-bio">
                                    <h6><a href="{{ route('sigle.blog',['slug'=>$latestBlogs->slug]) }}">{{ $latestBlogs->title }}</a></h6>
                                    <span><i class="far fa-clock"></i>{{ date('Y-m-d', strtotime($latestBlogs->created_at))  }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- social share -->
                        <div class="widget social-share">
                            <h5 class="widget-title">Follow Us</h5>
                            <div class="social-share-link">
                                <a href="https://www.facebook.com/High5DaycareInc" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://www.instagram.com/high5daycareinc/?igshid=YmMyMTA2M2Y%3D" target="_blank"><i class="fab fa-instagram"></i></a>
                                <a href="https://api.whatsapp.com/send?phone=19054628120&text=Hello" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                
                            </div>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- blog single area end -->


</main>

<!-- Start of LiveChat (www.livechat.com) code -->
<script>
    window.__lc = window.__lc || {};
    window.__lc.license = 17105016;
    ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
</script>
<noscript><a href="https://www.livechat.com/chat-with/17105016/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
<!-- End of LiveChat code -->



@endsection