@extends('frontend.main_master')
@section('main')
@section('title')
Portfolio | SDK Website
@endsection


@php
$portfolio_det=App\Models\Portfolio::latest()->get();
@endphp
<main>
<section class="breadcrumb__wrap">
                <div class="container custom-container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-8 col-md-10">
                            <div class="breadcrumb__wrap__content">
                                <h2 class="title">Case Details</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="breadcrumb__wrap__icon">
                    <ul>
                        <li><img src="{{asset('frontend/assets/img/icons/breadcrumb_icon01.png')}}" alt=""></li>
                        <li><img src="{{asset('frontend/assets/img/icons/breadcrumb_icon02.png')}}" alt=""></li>
                        <li><img src="{{asset('frontend/assets/img/icons/breadcrumb_icon03.png')}}" alt=""></li>
                        <li><img src="{{asset('frontend/assets/img/icons/breadcrumb_icon04.png')}}" alt=""></li>
                        <li><img src="{{asset('frontend/assets/img/icons/breadcrumb_icon05.png')}}" alt=""></li>
                        <li><img src="{{asset('frontend/assets/img/icons/breadcrumb_icon06.png')}}" alt=""></li>
                    </ul>
                </div>
            </section>
<section class="services__details">
    <div class="container">
        <div class="row">


            @foreach ($portfolio_det as $item)
            <div class="col-lg-8">
                <div class="services__details__thumb">
                    <img src="{{asset($item->portfolio_image)}}" alt="">
                </div>
                <div class="services__details__content">
                    <h2 class="title">{{$item->portfolio_title}}</h2>
                    <p>{!!$item->portfolio_description!!}</p>
                </div>
            </div>
            @endforeach
            <div class="col-lg-4">

                <aside class="services__sidebar">

                </aside>
            </div>
        </div>
    </div>
</section>
<!-- contact-area -->
<section class="homeContact homeContact__style__two">
    <div class="container">
        <div class="homeContact__wrap">
            <div class="row">
                <center><div class="col-lg-8">
                    <div class="section__title">
                        <span class="sub-title"> Say hello</span>
                        <h2 class="title">Any questions? Feel free <br> to contact</h2>
                    </div>
                    <div class="homeContact__content">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                        <h2 class="mail"><a href="mailto:deepankumars499@gmail.com">deepankumars499@gmail.com</a></h2>
                    </div>
                </div></center>
            </div>
        </div>
    </div>
</section>
<!-- contact-area-end -->
</main>
@endsection
