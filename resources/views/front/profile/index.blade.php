@extends('front.layouts.main')
@section('title', 'Profile And Password Setting')
@section('css')
    <style>
        .contact-slider {
            background-color: #f3f6fc;
        }

        .password_setting {
            display: none;
        }




        .copy-click {
            position: relative;
            padding-bottom: 2px;
            text-decoration: none;
            cursor: copy;
            /* color: #484848; */
            /* border-bottom: 1px dashed #767676; */
            /* transition: background-color calc(var(--duration) * 2) var(--ease); */
        }

        .copy-click:after {
            content: attr(data-tooltip-text);
            position: absolute;
            bottom: calc(100% + 6px);
            left: 50%;
            padding: 8px 16px;
            white-space: nowrap;
            background-color: white;
            border-radius: 4px;
            box-shadow: 0 0 0 -12px rgba(0, 0, 0, 0);
            pointer-events: none;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            opacity: 0;
            -webkit-transform: translate(-50%, 12px);
            transform: translate(-50%, 12px);
            transition: box-shadow calc(var(--duration) / 1.5) var(--bounce), opacity calc(var(--duration) / 1.5) var(--bounce), -webkit-transform calc(var(--duration) / 1.5) var(--bounce);
            transition: box-shadow calc(var(--duration) / 1.5) var(--bounce), opacity calc(var(--duration) / 1.5) var(--bounce), transform calc(var(--duration) / 1.5) var(--bounce);
            transition: box-shadow calc(var(--duration) / 1.5) var(--bounce), opacity calc(var(--duration) / 1.5) var(--bounce), transform calc(var(--duration) / 1.5) var(--bounce), -webkit-transform calc(var(--duration) / 1.5) var(--bounce);
        }

        .copy-click.is-hovered:after {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            opacity: 1;
            -webkit-transform: translate(-50%, 0);
            transform: translate(-50%, 0);
            transition-timing-function: var(--ease);
        }

        .copy-click.is-copied {
            background-color: #0d6efd;
            color: black;
        }

        .copy-click.is-copied:after {
            content: attr(data-tooltip-text-copied);
        }

        .open_eye,
        .open_eye_c {
            display: none;
        }
    </style>
    @error('oldpassword')
        <style>
            .password_setting {
                display: block;
            }

            .profile_setting {
                display: none;
            }
        </style>
    @enderror
    @error('newpassword')
        <style>
            .password_setting {
                display: block;
            }

            .profile_setting {
                display: none;
            }
        </style>
    @enderror
    @error('confirmnewpassword')
        <style>
            .password_setting {
                display: block;
            }

            .profile_setting {
                display: none;
            }
        </style>
    @enderror
@stop
@php
    use App\Models\User;
@endphp
@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url('{{ asset('assets/front/img/page-header.jpg') }}');">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h2>Profile And Password</h2>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="{{ route('front.home') }}">Home</a></li>
                        <li>Profile And Password</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact contact-slider">
            <div class="container" data-aos="fade-up">
                <div class="col-lg-9 my-5 m-auto bank-acc-detail-main-div">
                    <div class="card">
                        <div class="card-body">
                            <!-- Logo -->
                            <form action="{{ route('front.post.profilepage') }}" method="post"
                                enctype="multipart/form-data" id="profileForm">
                                <!-- /Logo -->
                                @csrf
                                <input type="hidden" name="old_profileimage" value="{{ Auth::user()->profileimage }}">
                                <div class="row p-3 border-bottom shadow-lg p-3 mb-5 bg-white rounded ">
                                    <div class="col-lg-3 p-2">
                                        <img src="{{ Auth::user()->profileimage ? asset(Auth::user()->profileimage) : asset('assets/front/img/avatars/1.png') }}"
                                            alt="user-avatar" class="d-block rounded" width="200px" height="200px"
                                            id="uploadedAvatar" />
                                    </div>
                                    <div class="col-lg-8">
                                        <h5 class="mb-2">Hi! {{ Auth::user()->name }} 👋</h5>
                                        <hr>
                                        <a href="javascript:void(0);" class="text-decoration-none copy-click">
                                            <h6 class="text-decoration-none copy-click" data-tooltip-text="Click to copy"
                                                data-value="{{ route('front.register') }}?referral_code={{ Auth::user()->referral_code }}"
                                                data-tooltip-text-copied="✔ Copied to clipboard" class="mb-2 d-inline">Your
                                                Referral Code Is -
                                                {{ Auth::user()->referral_code }}&nbsp;&nbsp;
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                                                    <path
                                                        d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z">
                                                    </path>
                                                </svg> &nbsp;&nbsp;
                                                <span>(click to copy)</span>
                                            </h6>
                                        </a>
                                        Total Referral Counts <span
                                            class="badge badge-secondary bg-primary">{{ User::get_total_use_referral_user_by_id(Auth::user()->id) }}</span>
                                        <hr>
                                        <div class="button-wrapper">
                                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                <span class="d-sm-block">Upload new photo</span>
                                                <i class="bx bx-upload d-block d-sm-none"></i>
                                                <input type="file" id="upload" class="account-file-input" hidden
                                                    accept="image/*" name="profileimage" onchange="readURL(this)" />
                                            </label>
                                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 4Mb</p>
                                        </div>
                                    </div>
                                    <div id="profileimage_error" class="text-danger"> @error('profileimage')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row profile_setting">
                                    <h3 class="my-3">Profile Setting</h3>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror "
                                            id="name" value="{{ Auth::user()->name }}" name="name">
                                        <div id="name_error" class="text-danger"> @error('name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror "
                                            id="email" value="{{ Auth::user()->email }}" name="email">
                                        <div id="email_error" class="text-danger"> @error('email')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror "
                                            id="username" value="{{ Auth::user()->username }}" name="username">
                                        <div id="username_error" class="text-danger"> @error('username')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror "
                                            id="phone" maxlength="10" value="{{ Auth::user()->phone }}"
                                            name="phone">
                                        <div id="phone_error" class="text-danger"> @error('phone')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ Auth::user()->address }}</textarea>
                                        <div id="address_error" class="text-danger"> @error('address')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dateofbirth" class="form-label">Date Of Birth</label>
                                        <input type="date"
                                            class="form-control @error('dateofbirth') is-invalid @enderror "
                                            value="{{ Auth::user()->dateofbirth }}" id="dateofbirth" name="dateofbirth"
                                            max="2022-06-16">
                                        <div id="dateofbirth_error" class="text-danger"> @error('dateofbirth')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-grid " type="submit">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('front.post.profile.changepassword') }}" method="post"
                                id="passwordForm">
                                @csrf
                                <div class="row password_setting">
                                    <h3 class="my-3">Password Setting</h3>
                                    <div class="mb-3">
                                        <label for="oldpassword" class="form-label">Old Password</label>
                                        <div class="input-group  input-group-merge">
                                            <input type="password" id="oldpassword" value="{{ old('oldpassword') }}"
                                                class="form-control " name="oldpassword"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="oldpassword">
                                            <span class="input-group-text toggle_password" id="basic-addon2"><i
                                                    class="fa fa-eye-slash close_eye" aria-hidden="true"></i><i
                                                    class="fa fa-eye open_eye" aria-hidden="true"></i></span>
                                        </div>
                                        <div id="oldpassword_error" class="text-danger"> @error('oldpassword')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="newpassword" class="form-label">New Password</label>
                                        <input type="text"
                                            class="form-control @error('newpassword') is-invalid @enderror"
                                            id="newpassword" value="{{ old('newpassword') }}" name="newpassword">
                                        <div id="newpassword_error" class="text-danger"> @error('newpassword')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirmnewpassword" class="form-label">Confirm New Password</label>
                                        <div class="input-group  input-group-merge">
                                            <input type="password" id="confirmnewpassword"
                                                value="{{ old('confirmnewpassword') }}" class="form-control "
                                                name="confirmnewpassword"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="confirmnewpassword">
                                            <span class="input-group-text toggle_password_c" id="basic-addon2"><i
                                                    class="fa fa-eye-slash close_eye_c" aria-hidden="true"></i><i
                                                    class="fa fa-eye open_eye_c" aria-hidden="true"></i></span>
                                        </div>
                                        <div id="confirmnewpassword_error" class="text-danger">
                                            @error('confirmnewpassword')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-grid " type="submit">Save Changes</button>
                                    </div>
                                </div>
                            </form>

                            <p class="profile_setting">
                                <span>Password Setting?</span>
                                <a href="" class="click_here_profile cursor-pointer">Click Here</a>
                            </p>
                            <p class="password_setting">
                                <span>Profile Setting?</span>
                                <a href="" class="click_here_password cursor-pointer">Click Here</a>
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </section>


    </main>


@stop
@section('js')
    <script src="{{ asset('assets/front/js/jquery.validate.min.js') }}"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                if (input.files[0].type.startsWith('image/')) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.querySelector("#uploadedAvatar").setAttribute("src", e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#profileimage_error').html('Allowed JPG, GIF or PNG.')
                    $('#upload').val('');
                }
            }
        }
        dateofbirth.max = new Date().toISOString().split("T")[0];

        $('.click_here_profile').click(function(event) {
            event.preventDefault();
            $('.profile_setting').slideUp();
            $('.password_setting').slideDown();
        });
        $('.click_here_password').click(function(event) {
            event.preventDefault();
            $('.profile_setting').slideDown();
            $('.password_setting').slideUp();
        });

        $('.toggle_password').click(function() {
            $('#oldpassword').attr('type', function(index, attr) {
                return attr == 'password' ? 'text' : 'password';
            });
            $('.open_eye').toggle();
            $('.close_eye').toggle();
        })
        $('.toggle_password_c').click(function() {
            $('#confirmnewpassword').attr('type', function(index, attr) {
                return attr == 'password' ? 'text' : 'password';
            });
            $('.open_eye_c').toggle();
            $('.close_eye_c').toggle();
        })


        const links = document.querySelectorAll('.copy-click');
        const cls = {
            copied: 'is-copied',
            hover: 'is-hovered'
        };


        const copyToClipboard = str => {
            const el = document.createElement('input');
            el.value = str.dataset.value
            el.setAttribute('readonly', '');
            el.style.position = 'absolute';
            el.style.opacity = 0;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
        };

        const clickInteraction = e => {
            e.preventDefault();
            copyToClipboard(e.target);
            e.target.classList.add(cls.copied);
            setTimeout(() => e.target.classList.remove(cls.copied), 1000);
            setTimeout(() => e.target.classList.remove(cls.hover), 700);
        };

        Array.from(links).forEach(link => {
            link.addEventListener('click', e => clickInteraction(e));
            link.addEventListener('keypress', e => {
                if (e.keyCode === 13) clickInteraction(e);
            });
            link.addEventListener('mouseover', e => e.target.classList.add(cls.hover));
            link.addEventListener('mouseleave', e => {
                if (!e.target.classList.contains(cls.copied)) {
                    e.target.classList.remove(cls.hover);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#profileForm').validate({
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

            $('#passwordForm').validate({
                rules: {
                    oldpassword: {
                        required: true,
                        minlength: 6,
                    },
                    newpassword: {
                        required: true,
                        minlength: 6,
                    },
                    confirmnewpassword: {
                        required: true,
                        minlength: 6,
                        equalTo: "#newpassword"
                    }
                },
                messages: {
                    password: {
                        required: 'This field is required',
                        minlength: 'Old Password must be at least 6 characters long'
                    },
                    newpassword: {
                        required: 'This field is required',
                        minlength: 'New Password must be at least 6 characters long'
                    },
                    confirmnewpassword: {
                        required: 'This field is required',
                        minlength: 'Confirm Password must be at least 6 characters long',
                        equalTo: 'Confirm password and New Password is not same'
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
