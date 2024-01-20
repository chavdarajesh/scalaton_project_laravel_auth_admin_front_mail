@extends('front.layouts.main')
@section('title', 'OTP Verification')
@section('content')
    @php
        use App\Models\User;
    @endphp
    <main id="main">


        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url('{{ asset('assets/front/img/page-header.jpg') }}');">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h2>OTP Verification</h2>
                            <p>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="{{ route('front.homepage') }}">Home</a></li>
                        <li>OTP Verification</li>
                    </ol>
                </div>
            </nav>
        </div>
        <section id="get-a-quote" class="get-a-quote">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <!-- Logo -->
                                <!-- /Logo -->
                                <h4 class="mb-2">Welcome to {{ env('APP_NAME', 'Laravel App') }} 👋</h4>
                                <h4 class="mb-2">OTP Verification 🔒</h4>
                                <p class="mb-4">Please Enter OTP Code Send To Your Email Address To Continue.</p>

                                <form id="form" class="mb-3"
                                    action="{{ route('front.post.otp_verification') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user_id ? $user_id : '' }}">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="Enter your email"
                                            value="{{ User::get_user_by_id($user_id)->email ? User::get_user_by_id($user_id)->email : old('email') }}" />
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="otp" class="form-label">OTP</label>
                                        <input minlength="6" maxlength="6" type="number"
                                            class="form-control @error('otp') is-invalid @enderror" id="otp"
                                            name="otp" placeholder="Enter your OTP" autofocus value="" />
                                        @error('otp')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary d-grid w-100">Submit</button>
                                </form>
                                <div class="text-center">
                                    <a href="{{ route('front.login') }}"
                                        class="d-flex align-items-center justify-content-center">
                                        <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                        Back to login
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="authentication-wrapper authentication-basic container-p-y">
                    <div class="authentication-inner">
                        <!-- Register -->

                        <!-- /Register -->
                    </div>
                </div>
            </div>
        </section>

    </main>
@stop
