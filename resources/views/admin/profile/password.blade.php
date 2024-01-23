@extends('admin.layouts.main')
@section('title', 'Password Setting')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Password Setting</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.profile.setting.index') }}"><i class="bx bx-user me-1"></i>
                            Profile Setting
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-cog me-1"></i> Password
                            Setting</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Password Setting</h5>
                    <!-- Account -->

                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="form" method="POST"
                            action="{{ route('admin.profile.settings.password.save') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-12 form-password-toggle">
                                    <label for="oldpassword" class="form-label">Old Password</label>
                                    <div class="input-group input-group-merge">
                                        <input name="oldpassword" type="password"
                                            class="form-control @error('oldpassword') is-invalid @enderror"
                                            id="oldpassword" placeholder="············"
                                            aria-describedby="basic-default-password" value="{{ old('oldpassword') }}">
                                        <span class="input-group-text cursor-pointer" id="basic-default-password"><i
                                                class="bx bx-hide"></i></span>
                                    </div>
                                    <div id="oldpassword_error" class="text-danger"> @error('oldpassword')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 col-md-12 form-password-toggle">
                                    <label for="newpasswod" class="form-label">New Password</label>
                                    <div class="input-group input-group-merge">
                                        <input name="newpasswod" type="password"
                                            class="form-control @error('newpasswod') is-invalid @enderror"
                                            id="newpasswod" placeholder="············"
                                            aria-describedby="basic-default-password" value="{{ old('newpasswod') }}">
                                        <span class="input-group-text cursor-pointer" id="basic-default-password"><i
                                                class="bx bx-hide"></i></span>
                                    </div>
                                    <div id="newpasswod_error" class="text-danger"> @error('newpasswod')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 col-md-12 form-password-toggle">
                                    <label class="form-label" for="confirmnewpasswod">Confirm New Password</label>
                                    <div class="input-group input-group-merge">
                                        <input name="confirmnewpasswod" type="password"
                                            class="form-control @error('confirmnewpasswod') is-invalid @enderror"
                                            id="confirmnewpasswod" placeholder="············"
                                            aria-describedby="basic-default-password"
                                            value="{{ old('confirmnewpasswod') }}">
                                        <span class="input-group-text cursor-pointer" id="basic-default-password"><i
                                                class="bx bx-hide"></i></span>
                                    </div>
                                    <div id="confirmnewpasswod_error" class="text-danger">
                                        @error('confirmnewpasswod')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="{{ asset('assets/admin/js/jquery.validate.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#form').validate({
                rules: {
                    oldpassword: {
                        required: true,
                        minlength: 6,
                    },
                    newpasswod: {
                        required: true,
                        minlength: 6,
                    },
                    confirmnewpasswod: {
                        required: true,
                        minlength: 6,
                        equalTo: "#newpasswod"
                    }
                },
                messages: {
                    password: {
                        required: 'This field is required',
                        minlength: 'Old Password must be at least 6 characters long'
                    },
                    newpasswod: {
                        required: 'This field is required',
                        minlength: 'New Password must be at least 6 characters long'
                    },
                    confirmnewpasswod: {
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
