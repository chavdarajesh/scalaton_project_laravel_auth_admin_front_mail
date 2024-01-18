@extends('front.layouts.main')
@section('title', 'Register')
@section('content')
@php
    $referral_code=@$_GET['referral_code'] ? @$_GET['referral_code'] : ''
@endphp
    <main id="main">


        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url('{{ asset('assets/front/img/page-header.jpg') }}');">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h2>Register</h2>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="{{ route('front.homepage') }}">Home</a></li>
                        <li>Register</li>
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
                                <h4 class="mb-2">Welcome to {{env('APP_NAME', 'Laravel App')}} 👋</h4>
                                <p class="mb-4">Please sign-up to your account and start the adventure</p>

                                <form id="formAuthentication" class="mb-3" action="{{ route('front.post.register') }}"
                                    method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" id="name" name="name"
                                            placeholder="Enter your Name" autofocus required/>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username<span class="text-danger">*</span></label>
                                        <input type="username" class="form-control @error('username') is-invalid @enderror"
                                            value="{{ old('username') }}" id="username" name="username"
                                            placeholder="Enter your Username" required/>
                                        @error('username')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" value="{{ old('email') }}" name="email"
                                            placeholder="Enter your Email" required/>
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone') }}" id="phone" name="phone"
                                            placeholder="Enter your Phone" required/>
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" name="address" id="address"
                                            rows="2" placeholder="Enter Your Address" required>{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="dateofbirth" class="form-label">Date Of Birth<span class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control @error('dateofbirth') is-invalid @enderror"
                                            value="{{ old('dateofbirth') }}" id="dateofbirth" name="dateofbirth" required/>
                                        @error('dateofbirth')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="referral_code" class="form-label">Referral Code</label>
                                        <input type="tel" class="form-control @error('referral_code') is-invalid @enderror"
                                            value="{{ $referral_code ? $referral_code :  old('referral_code') }}" id="referral_code" name="referral_code"
                                            placeholder="Enter Referral code" />
                                        @error('referral_code')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input"  @if(old('accept_t_c')) {{'checked'}} @endif type="checkbox" id="accept_t_c" name="accept_t_c" required/>
                                            <label class="form-check-label" for="accept_t_c">I agree to the <a target="_blank" href="{{route('front.term_and_conditionpage')}}">Terms and Conditions</a> and <a target="_blank"  href="{{route('front.privacy_policypage')}}">Privacy Policy</a>.<span class="text-danger">*</span> </label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>
                                    </div>
                                </form>

                                <p class="text-center">
                                    <span>Already have an account?</span>
                                    <a href="{{ route('front.login') }}">
                                        <span>Sign In</span>
                                    </a>
                                </p>
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
@section('js')
    <script>
        dateofbirth.max = new Date().toISOString().split("T")[0];
    </script>
@stop
