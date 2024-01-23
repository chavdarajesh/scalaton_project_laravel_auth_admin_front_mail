@extends('front.layouts.main')
@section('title', 'Forgot Password')
@section('content')

    <main id="main">


        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url('{{ asset('assets/front/img/page-header.jpg') }}');">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h2>Forgot Password</h2>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="{{ route('front.home') }}">Home</a></li>
                        <li>Forgot Password</li>
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
                                <h4 class="mb-2">Forgot Password? 🔒</h4>
                                <p class="mb-4">Enter your email and we'll send you instructions to reset your
                                    password</p>

                                <form id="form" class="mb-3" action="{{ route('front.post.forgotpassword') }}"
                                    method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="Enter your email" autofocus
                                            value="{{ old('email') }}" />
                                        <div id="email_error" class="text-danger"> @error('email')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
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

@section('js')
    <script src="{{ asset('assets/front/js/jquery.validate.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#form').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    }
                },
                messages: {
                    email: {
                        required: 'This field is required',
                        email: 'Enter a valid email',
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
