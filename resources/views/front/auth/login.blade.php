@extends('front.layouts.main')
@section('title', 'Login')
@section('css')
    <style>
        .open_eye {
            display: none;
        }
    </style>
@stop
@section('content')

    <main id="main">


        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url('{{ asset('assets/front/img/page-header.jpg') }}');">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h2>Login</h2>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="{{ route('front.homepage') }}">Home</a></li>
                        <li>Login</li>
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
                                <p class="mb-4">Please sign-in to your account and start the adventure</p>

                                <form id="formAuthentication" class="mb-3" action="{{ route('front.post.login') }}"
                                    method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email or Username<span
                                                class="text-danger">*</span></label>
                                        <input type="text" value="" class="form-control " id="email"
                                            name="email" placeholder="Enter your email or username" autofocus />
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 form-password-toggle">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="adminpassword">Password<span
                                                    class="text-danger">*</span></label>
                                            <a href="{{ route('front.forgotpassword') }}">
                                                <small>Forgot Password?</small>
                                            </a>
                                        </div>
                                        <div class="input-group  input-group-merge">
                                            <input type="password" id="password" value="" class="form-control "
                                                name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password">
                                            <span class="input-group-text toggle_password" id="basic-addon2"><i
                                                    class="fa fa-eye-slash close_eye" aria-hidden="true"></i><i
                                                    class="fa fa-eye open_eye" aria-hidden="true"></i></span>
                                        </div>
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                                    </div>
                                </form>

                                <p class="text-center">
                                    <span>New on our Platform?</span>
                                    <a href="{{ route('front.register') }}">
                                        <span>Create an account</span>
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
        $('.toggle_password').click(function() {
            $('#password').attr('type', function(index, attr) {
                return attr == 'password' ? 'text' : 'password';
            });
            $('.open_eye').toggle();
            $('.close_eye').toggle();
        })
    </script>
@stop
