@extends('frontend.layouts.master')

@section('content')
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-10 col-lg-7 m-auto">
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf
                        <div class="wsus__change_password">
                            <h4>change password</h4>
                            <div class="wsus__single_pass">
                                <label>email</label>
                                <input id="email" type="email" name="email" placeholder="Your mail" value="{{ old('email') }}">
                            </div>
                            <div class="wsus__single_pass">
                                <label>new password</label>
                                <input id="password" type="password" name="password" placeholder="New Password" required>
                            </div>
                            <div class="wsus__single_pass">
                                <label>confirm password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password" required>
                            </div>
                            <button class="common_btn" type="submit">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
