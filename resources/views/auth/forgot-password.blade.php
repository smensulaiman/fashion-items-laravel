@extends('frontend.layouts.master')

@section('content')

    <!--============================
    FORGET PASSWORD START
    ==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="wsus__forget_area p-4">
                        <span class="qiestion_icon"><i class="fal fa-question-circle"></i></span>
                        <p>enter the email address to register with <span>{{ env('APP_NAME') }}</span></p>
                        <div class="wsus__login px-4">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="wsus__login_input">
                                    <i class="fal fa-envelope"></i>
                                    <input id="email" type="email" name="email" placeholder="Your Email" value="{{ old('email') }}">
                                </div>
                                <button class="common_btn" type="submit">send</button>
                            </form>
                        </div>
                        <a class="see_btn mt-4" href="{{ route('login') }}">go to login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        FORGET PASSWORD END
    ==============================-->

@endsection
