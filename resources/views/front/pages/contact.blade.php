@extends('front.layouts.main')
@section('title', 'Contact')
@section('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Taviraj:wght@500&display=swap');

        .breadcrumbs p {
            font-size: 28px !important;
            font-family: 'DM Serif Text', serif;
        }

        @media only screen and (max-width: 767px) {
            .breadcrumbs p {
                font-size: 22px !important;
            }
        }
    </style>
@stop
@section('content')
@section('content')
    <main id="main">


        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url('{{ asset('assets/front/img/page-header.jpg') }}');">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h2>Contact Us</h2>
                            <p>It Is Never Too Get Started On Your Investment Plans Tells Us We Will Give You A Plan To
                                Achieve Them.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="{{ route('front.home') }}">Home</a></li>
                        <li>Contact Us</li>
                    </ol>
                </div>
            </nav>
        </div>


        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">
                @if ($ContactSetting['map_iframe'])
                    <div>
                        {!! $ContactSetting['map_iframe']
                            ? $ContactSetting['map_iframe']
                            : '<iframe style="border:0; width: 100%; height: 340px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>' !!}
                    </div>
                @endif
                <div class="row gy-4 mt-4">
                    <h1 class="text-center">{{ env('APP_NAME', 'Laravel App') }}</h1>
                    <hr>
                    <div class="col-lg-4">
                        @if ($ContactSetting['phone'])
                            <div class="info-item d-flex">
                                <i class="bi bi-whatsapp flex-shrink-0"></i>
                                <div>
                                    <h4>Message On Whatsapp:</h4>
                                    <a target="_blank"
                                        href="https://api.whatsapp.com/send?phone={{ $ContactSetting['phone'] ? $ContactSetting['phone'] : '+919876543210' }}">Send
                                        Message</a>
                                </div>
                            </div>
                        @endif
                        @if ($ContactSetting['location'])
                            <div class="info-item d-flex">
                                <i class="bi bi-geo-alt flex-shrink-0"></i>
                                <div>
                                    <h4>Location:</h4>
                                    <p>{{ $ContactSetting['location'] ? $ContactSetting['location'] : 'A108 Adam Street, New York, NY 535022' }}
                                    </p>
                                </div>
                            </div>
                        @endif
                        @if ($ContactSetting['email'])
                            <div class="info-item d-flex">
                                <i class="bi bi-envelope flex-shrink-0"></i>
                                <div>
                                    <h4>Email:</h4>
                                    <a
                                        href="mailto:{{ $ContactSetting['email'] ? $ContactSetting['email'] : 'contact@website.com' }}">{{ $ContactSetting['email'] ? $ContactSetting['email'] : 'contact@website.com' }}</a>
                                </div>
                            </div>
                        @endif
                        @if ($ContactSetting['phone'])
                            <div class="info-item d-flex">
                                <i class="bi bi-phone flex-shrink-0"></i>
                                <div>
                                    <h4>Call:</h4>
                                    <a href="tel:{{ $ContactSetting['phone'] ? $ContactSetting['phone'] : '+919876543210' }}"
                                        class="Blondie">{{ $ContactSetting['phone'] ? $ContactSetting['phone'] : '+919876543210' }}</a>
                                </div>
                            </div>
                        @endif
                        @if ($ContactSetting['timing'])
                            <div class="info-item d-flex">
                                <i class="bi bi-calendar-check flex-shrink-0"></i>
                                <div>
                                    <h4>Timing:</h4>
                                    <h6>{!! $ContactSetting['timing'] !!}</h6>
                                </div>
                            </div>
                        @endif


                    </div>

                    <div class="col-lg-8">
                        <form action="{{ route('front.contact.message.save') }}" method="post" role="form"
                            class="php-email-form" id="form">
                            @csrf
                            <div class="row">
                                <h4 class="text-center">Send Message To US</h4>
                                <hr>
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name"
                                        class="form-control  @error('name') border border-danger @enderror" id="name"
                                        placeholder="Your Name"
                                        value="{{ Auth::check() ? Auth::user()->name : old('name') }}" autofocus>
                                    <div id="name_error" class="text-danger"> @error('name')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email"
                                        class="form-control  @error('email') border border-danger @enderror" name="email"
                                        id="email" placeholder="Your Email"
                                        value="{{ Auth::check() ? Auth::user()->email : old('email') }}">
                                    <div id="email_error" class="text-danger"> @error('email')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control  @error('subject') border border-danger @enderror"
                                    name="subject" id="subject" placeholder="Subject" value="{{ old('subject') }}">
                            </div>
                            <div id="subject_error" class="text-danger"> @error('subject')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control   @error('message') border border-danger @enderror" name="message" rows="6"
                                    placeholder="Message">{{ old('message') }}</textarea>
                            </div>
                            <div id="message_error" class="text-danger"> @error('message')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>
                    </div>

                </div>
                <div class="row gy-4 mt-4">

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
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    subject: {
                        required: true,
                    },
                    message: {
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
                    subject: {
                        required: 'This field is required',
                    },
                    message: {
                        required: 'This field is required',
                    }
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
