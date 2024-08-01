@php use Illuminate\Support\Facades\Auth; @endphp
@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, {{ Auth::user()->name }}</h2>
            <p class="section-lead">
                Change information about yourself on this page.
            </p>

            <div class="row mt-sm-4">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <form method="POST" action="{{ route('admin.profile.update') }}" class="needs-validation"
                              novalidate=""
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4>Edit Personal Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @if(!empty(Auth::user()->image))
                                        <div class="form-group" style="padding-left: 15px">
                                            <img class="img-thumbnail rounded d-block" src="{{ asset(Auth::user()->image)  }}" alt="..." width="100">
                                        </div>
                                    @endif
                                    <div class="form-group col-12">
                                        <label>Image</label>
                                        <input type="file" class="form-control d-flex align-items-center" name="image" style="padding: 7px">
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required="">
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Last Name</label>
                                        <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Update Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row mt-sm-4">
                <div class="col-12 col-lg-6 col-xl-4 col-xxl-4">
                    <div class="card">
                        <form method="POST" action="{{ route('admin.profile.update.password') }}"
                              class="needs-validation" novalidate="">
                            @csrf
                            <div class="card-header">
                                <h4>Edit Password</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Current Password</label>
                                        <input type="text" class="form-control" name="current_password" value=""
                                               required="">
                                        @php
                                            if($errors->has('current_password')){
                                        @endphp
                                        <div class="invalid-feedback" style="display: block">
                                            {{$errors->first('current_password')}}
                                        </div>
                                        @php } @endphp
                                    </div>
                                    <div class="form-group col-12">
                                        <label>New Password</label>
                                        <input type="text" class="form-control" name="password" value="" required="">
                                        @php
                                            if($errors->has('password')){
                                        @endphp
                                        <div class="invalid-feedback" style="display: block">
                                            {{$errors->first('password')}}
                                        </div>
                                        @php } @endphp
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Confirm Password</label>
                                        <input type="text" class="form-control" name="password_confirmation" value=""
                                               required="">
                                        @php
                                            if($errors->has('confirm_password')){
                                        @endphp
                                        <div class="invalid-feedback" style="display: block">
                                            {{$errors->first('confirm_password')}}
                                        </div>
                                        @php } @endphp
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
