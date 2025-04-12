@extends('layouts.app')

@section('content')
    <!-- Home Section -->
    <section id="home" class="home_bg">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Side: Text Content -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="hero-text">
                        <h2>AA TASKAR BEGE VERIFICATION</h2>
                        <p>Your #1 for instant NIN and BVN verification, Airtime and Data,
                            Cable subscription and educational PIN.
                            Register now and enjoy the amazing services we offer!
                        </p>
                        <div class="home_cta">
                            <a href="{{ route('auth.login') }}" class="btn btn-primary">Login</a>
                            <a href="#" class="btn btn-secondary">Register</a>
                        </div>
                    </div>
                </div>
                <!-- Right Side: Image -->
                <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                    <img src="{{ asset('assets/index/img/icon/smile.png') }}" alt="AA Taskar Bege" class="person-image">
                </div>
            </div>
        </div>
    </section>
    <!-- Home Section -->


    <!-- Token Sale Section -->
    <section id="token_sale" class="token_sale_area section-padding">
        <div class="container">
            <div class="section-title text-center">
                <h1>Features</h1>
                <p>It is a long-established fact that a reader will be distracted by the readable content of a page when
                    looking at its layout.</p>
            </div>
            <div class="row text-center">
                <!-- Feature Items -->
                <div class="col-lg-3 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                    <div class="single_token single_token_bg_one">
                        <div class="image-container">
                            <img src="{{ asset('assets/index/img/icon/bvn.png') }}" alt="BVN Verification">
                        </div>
                        <h4>BVN Verification</h4>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="single_token single_token_bg_two">
                        <div class="image-container">
                            <img src="{{ asset('assets/index/img/icon/nimc.png') }}" alt="NIN Verification">
                        </div>
                        <h4>NIN Verification</h4>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s">
                    <div class="single_token single_token_bg_three">
                        <div class="image-container">
                            <img src="{{ asset('assets/index/img/icon/MTN.png') }}" alt="MTN Airtime & Data">
                        </div>
                        <h4>MTN Airtime & Data</h4>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="single_token single_token_bg_four">
                        <div class="image-container">
                            <img src="{{ asset('assets/index/img/icon/jamb.png') }}" alt="Pay Utility Bills">
                        </div>
                        <h4>Pay Utility Bills</h4>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="single_token single_token_bg_four">
                        <div class="image-container">
                            <img src="{{ asset('assets/index/img/icon/glo.png') }}" alt="Glo Data and Airtime">
                        </div>
                        <h4>Glo Data and Airtime</h4>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="single_token single_token_bg_four">
                        <div class="image-container">
                            <img src="{{ asset('assets/index/img/icon/9mobile.png') }}" alt="9mobile Airtime and Data">
                        </div>
                        <h4>9mobile Airtime and Data</h4>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="single_token single_token_bg_four">
                        <div class="image-container">
                            <img src="{{ asset('assets/index/img/icon/cac.png') }}" alt="CAC Registration">
                        </div>
                        <h4>CAC Registration</h4>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="single_token single_token_bg_four">
                        <div class="image-container">
                            <img src="{{ asset('assets/index/img/icon/airtel.jpg') }}" alt="Airtel Airtime & Data">
                        </div>
                        <h4>Airtel Airtime & Data</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about_us section-padding">
        <div class="container">
            <div class="section-title text-center">
                <h1>The Most Trusted Verification Platform</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
                    <div class="single_about">
                        <i class="bi bi-shield-check fs-1 text-primary"></i>
                        <h3>We Are Reliable</h3>
                        <p>identy is a fully optimized platform for reliability and dependability. You get 100% value for
                            any transaction you carry out with us.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                    <div class="single_about">
                        <i class="bi bi-headset fs-1 text-primary"></i>
                        <h3>24/7 Support</h3>
                        <p>Our customers are premium to us, hence satisfying them is our topmost priority. Our customer
                            service is just a click away.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="single_about">
                        <i class="bi bi-gear fs-1 text-primary"></i>
                        <h3>We Are Automated</h3>
                        <p>Our data delivery and wallet funding are automated. Airtime top-up and data purchases are
                            delivered to you almost instantly.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Content -->

    <section class="about_us section-padding">
        <div class="about-box-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                        <h2>Install Our App Today</h2>
                        <p>We offer users instant recharge of airtime, data bundles, cable TV subscriptions (DSTV, GOTV, &
                            STARTIMES), electricity bill payments, and recharge cards.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
                        <ul>
                            <i class="bi bi-download"></i> Download It For Free
                            <div class="home_cta">
                                <a href="#" class="btn btn-primary" target="_blank">
                                    <i class="bi bi-apple"></i> App Store
                                </a>
                                <a href="#" class="btn btn-secondary" target="_blank">
                                    <i class="bi bi-google-play"></i> Google Play
                                </a>
                            </div>
                    </div>
                </div>
            </div>
            <!-- Right Side: Image -->
            <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                <img src="{{ asset('assets/index/img/icon/LOGO.jpg') }}" alt="AA Taskar Bege" class="img-fluid"
                    style="max-width: 200%; height: 200px;">
            </div>
        </div>
    </section>
@endsection
