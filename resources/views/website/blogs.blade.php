@extends('layouts.website')
@section('title', ' High5 Daycare')
@section('content')
<main class="main">

    <!-- breadcrumb -->
    <div class="site-breadcrumb" style="background: url({{ asset('assets/website/img/slider/slider-1.jpg') }})">
        <div class="container">
            <h2 class="breadcrumb-title">Our Blog</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('website') }}">Home</a></li>
                <li class="active">Our Blog</li>
            </ul>
        </div>
        <div class="hero-shape">
            <img class="hero-shape-1" src="{{ asset('assets/website/img/shape/01.png') }}" alt="">
        </div>
    </div>
    <!-- breadcrumb end -->



    <!-- blog-area -->
    <div class="blog-area pt-120 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        @if(!empty($searchText) )
                        <span class="site-title-tagline">Search results for "{{ $searchText }}"</span>

                        @else
                        <span class="site-title-tagline">Our Blog</span>
                        <h2 class="site-title">Get Our Latest <span>Update</span> News & Blog</h2>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                @if(isset($blogs) && !empty($blogs) && count($blogs) > 0)
                @foreach($blogs as $blog)
                <div class="col-md-6 col-lg-4">
                    <div class="blog-item">
                        <div class="blog-item-img">
                            <img src="{{ url($blog->image) }}" alt="Thumb">
                        </div>
                        <div class="blog-item-info">
                            <div class="blog-item-meta">
                                <ul>
                                    <!-- <li><a href="#"><i class="far fa-user-circle"></i> By Alicia Davis</a></li> -->
                                    <li><a href="{{ route('sigle.blog',['slug'=>$blog->slug]) }}"><i class="far fa-calendar-alt"></i>{{ date('Y-m-d', strtotime($blog->created_at))  }}</a></li>
                                </ul>
                            </div>
                            <h4 class="blog-title">
                                <a href="{{ route('sigle.blog',['slug'=>$blog->slug]) }}">{{ $blog->title }}</a>
                            </h4>
                            <p>{{ \Illuminate\Support\Str::limit($blog->content, 30) }}</p>
                            <a class="theme-btn" href="{{ route('sigle.blog',['slug'=>$blog->slug]) }}">Read More<i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            @include('layouts.partials.no-result')
            @endif

            <!-- pagination -->
            @include('layouts.partials.custom_pagination', ['paginator' => $blogs])
        </div>
    </div>
    <!-- blog-area end -->



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