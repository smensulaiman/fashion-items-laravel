@extends('frontend.layouts.master')

@section('content')

{{--    <section id="wsus__breadcrumb">--}}
{{--        <div class="wsus_breadcrumb_overlay">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12">--}}
{{--                        <h4>login / register</h4>--}}
{{--                        <ul>--}}
{{--                            <li><a href="#">home</a></li>--}}
{{--                            <li><a href="#">login / register</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 m-auto">
                    <div class="wsus__login_reg_area">
                        <ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab2" data-bs-toggle="pill"
                                        data-bs-target="#pills-homes" type="button" role="tab" aria-controls="pills-homes"
                                        aria-selected="true"
                                        style="border-top-right-radius: 0;
                                        border-bottom-right-radius: 0">login</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab2" data-bs-toggle="pill"
                                        data-bs-target="#pills-profiles" type="button" role="tab"
                                        aria-controls="pills-profiles" aria-selected="true"
                                        style="border-top-left-radius: 0;
                                        border-bottom-left-radius: 0">signup</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent2">
                            <div class="tab-pane fade show active" id="pills-homes" role="tabpanel"
                                 aria-labelledby="pills-home-tab2">
                                <div class="wsus__login">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="wsus__login_input">
                                            <i class="fas fa-mail-bulk"></i>
                                            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required autofocus>
                                        </div>

                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input id="password" type="password" name="password" placeholder="Enter your password" required>
                                        </div>
                                        <div class="wsus__login_save">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                                                <label class="form-check-label" for="remember">{{ __('Remember me') }}</label>
                                            </div>
                                            <a class="forget_p" href="forget_password.html">forget password ?</a>
                                        </div>
                                        <button class="common_btn" type="submit">login</button>
                                        <p class="social_text">Sign in with social account</p>
                                        <ul class="wsus__login_link">
                                            <li><a href="#"><i class="fab fa-google"></i></a></li>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul>
                                    </form>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-profiles" role="tabpanel"
                                 aria-labelledby="pills-profile-tab2">
                                <div class="wsus__login">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="wsus__login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <input id="name" name="name" value="{{ old('name') }}" type="text" placeholder="Name" required autofocus>
                                        </div>

                                        <div class="wsus__login_input">
                                            <i class="far fa-envelope"></i>
                                            <input type="email" id="email"  name="email" value="{{ old('email') }}" required placeholder="Email">
                                        </div>
                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input type="password" id="password" name="password" placeholder="Password" required>
                                        </div>
                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                                        </div>
                                        <div class="wsus__login_save">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                       id="flexSwitchCheckDefault03">
                                                <label class="form-check-label" for="flexSwitchCheckDefault03">I consentto the privacy policy</label>
                                            </div>
                                        </div>
                                        <button class="common_btn" type="submit">signup</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
