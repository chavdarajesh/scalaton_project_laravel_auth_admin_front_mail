@extends('front.layouts.main')
@section('title', 'Register')
@section('css')
    <style>
        .open_eye,
        .open_eye_c {
            display: none;
        }
    </style>
@stop
@section('content')
    @php
        $referral_code = @$_GET['referral_code'] ? @$_GET['referral_code'] : '';
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
                        <li><a href="{{ route('front.home') }}">Home</a></li>
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
                                <h4 class="mb-2">Welcome to {{ env('APP_NAME', 'Laravel App') }} 👋</h4>
                                <p class="mb-4">Please sign-up to your account and start the adventure</p>

                                <form id="form" class="mb-3" action="{{ route('front.post.register') }}"
                                    method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" id="name" name="name"
                                            placeholder="Enter your Name" autofocus />
                                        <div id="name_error" class="text-danger"> @error('name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username<span
                                                class="text-danger">*</span></label>
                                        <input type="username" class="form-control @error('username') is-invalid @enderror"
                                            value="{{ old('username') }}" id="username" name="username"
                                            placeholder="Enter your Username" />
                                        <div id="username_error" class="text-danger"> @error('username')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email<span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" value="{{ old('email') }}" name="email"
                                            placeholder="Enter your Email" />
                                        <div id="email_error" class="text-danger"> @error('email')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 form-password-toggle">
                                        <label class="form-label" for="password">Password<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group  input-group-merge">
                                            <input type="password" id="password" value="{{ old('password') }}"
                                                class="form-control " name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password">
                                            <span class="input-group-text toggle_password" id="basic-addon2"><i
                                                    class="fa fa-eye-slash close_eye" aria-hidden="true"></i><i
                                                    class="fa fa-eye open_eye" aria-hidden="true"></i></span>
                                        </div>
                                        <div id="password_error" class="text-danger">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 form-password-toggle">
                                        <label class="form-label" for="confirmpassword">Confirm Password<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group  input-group-merge">
                                            <input type="password" id="confirmpassword"
                                                value="{{ old('confirmpassword') }}" class="form-control "
                                                name="confirmpassword"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password">
                                            <span class="input-group-text toggle_password_c" id="basic-addon2"><i
                                                    class="fa fa-eye-slash close_eye_c" aria-hidden="true"></i><i
                                                    class="fa fa-eye open_eye_c" aria-hidden="true"></i></span>
                                        </div>
                                        <div id="confirmpassword_error" class="text-danger">
                                            @error('confirmpassword')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone<span
                                                class="text-danger">*</span></label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone') }}" id="phone" name="phone"
                                            placeholder="Enter your Phone" />
                                        <div id="phone_error" class="text-danger"> @error('phone')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address<span
                                                class="text-danger">*</span></label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" name="address" id="address"
                                            rows="2" placeholder="Enter Your Address">{{ old('address') }}</textarea>
                                        <div id="address_error" class="text-danger"> @error('address')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dateofbirth" class="form-label">Date Of Birth<span
                                                class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control @error('dateofbirth') is-invalid @enderror"
                                            value="{{ old('dateofbirth') }}" id="dateofbirth" name="dateofbirth" />
                                        <div id="dateofbirth_error" class="text-danger"> @error('dateofbirth')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="referral_code" class="form-label">Referral Code</label>
                                        <input type="tel"
                                            class="form-control @error('referral_code') is-invalid @enderror"
                                            value="{{ $referral_code ? $referral_code : old('referral_code') }}"
                                            id="referral_code" name="referral_code" placeholder="Enter Referral code" />
                                        <div id="referral_code_error" class="text-danger"> @error('referral_code')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                @if (old('accept_t_c')) {{ 'checked' }} @endif
                                                type="checkbox" id="accept_t_c" name="accept_t_c" />
                                            <label class="form-check-label" for="accept_t_c">I agree to the <a
                                                    target="_blank" href="{{ route('front.term_and_condition') }}">Terms
                                                    and
                                                    Conditions</a> and <a target="_blank"
                                                    href="{{ route('front.privacy_policy') }}">Privacy
                                                    Policy</a>.<span class="text-danger">*</span> </label>
                                        </div>
                                        <div id="accept_t_c_error" class="text-danger"> @error('accept_t_c')
                                                {{ $message }}
                                            @enderror
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
    <script src="{{ asset('assets/front/js/jquery.validate.min.js') }}"></script>

    <script>
        dateofbirth.max = new Date().toISOString().split("T")[0];
        $('.toggle_password').click(function() {
            $('#password').attr('type', function(index, attr) {
                return attr == 'password' ? 'text' : 'password';
            });
            $('.open_eye').toggle();
            $('.close_eye').toggle();
        })
        $('.toggle_password_c').click(function() {
            $('#confirmpassword').attr('type', function(index, attr) {
                return attr == 'password' ? 'text' : 'password';
            });
            $('.open_eye_c').toggle();
            $('.close_eye_c').toggle();
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                    },
                    username: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    dateofbirth: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 6,
                    },
                    confirmpassword: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    },
                    accept_t_c: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: 'This field is required',
                    },
                    email: {
                        required: 'This field is required',
                        email: 'Enter a valid email',
                    },
                    phone: {
                        required: 'This field is required',
                        minlength: 'Phone must be at least 10 characters long'
                    },
                    username: {
                        required: 'This field is required',
                    },
                    address: {
                        required: 'This field is required',
                    },
                    dateofbirth: {
                        required: 'This field is required',
                    },
                    password: {
                        required: 'This field is required',
                        minlength: 'Password must be at least 6 characters long'
                    },
                    confirmpassword: {
                        required: 'This field is required',
                        minlength: 'Confirm password must be at least 6 characters long',
                        equalTo: 'Confirm password and Password is not same'
                    },
                    accept_t_c: {
                        required: 'This field is required',
                    },
                },
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    $('#' + element.attr('name') + '_error').html(error)
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@stop
