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
                                    <label for="adminoldpassword" class="form-label">Old Password</label>
                                    <div class="input-group input-group-merge">
                                        <input name="adminoldpassword" type="password"
                                            class="form-control @error('adminoldpassword') is-invalid @enderror"
                                            id="adminoldpassword" placeholder="············"
                                            aria-describedby="basic-default-password" value="{{ old('adminoldpassword') }}">
                                        <span class="input-group-text cursor-pointer" id="basic-default-password"><i
                                                class="bx bx-hide"></i></span>
                                    </div>
                                    <div id="adminoldpassword_error" class="text-danger"> @error('adminoldpassword')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 col-md-12 form-password-toggle">
                                    <label for="adminnewpassword" class="form-label">New Password</label>
                                    <div class="input-group input-group-merge">
                                        <input name="adminnewpassword" type="password"
                                            class="form-control @error('adminnewpassword') is-invalid @enderror"
                                            id="adminnewpassword" placeholder="············"
                                            aria-describedby="basic-default-password" value="{{ old('adminnewpassword') }}">
                                        <span class="input-group-text cursor-pointer" id="basic-default-password"><i
                                                class="bx bx-hide"></i></span>
                                    </div>
                                    <div id="adminnewpassword_error" class="text-danger"> @error('adminnewpassword')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 col-md-12 form-password-toggle">
                                    <label class="form-label" for="adminconfirmnewpasswod">Confirm New Password</label>
                                    <div class="input-group input-group-merge">
                                        <input name="adminconfirmnewpasswod" type="password"
                                            class="form-control @error('adminconfirmnewpasswod') is-invalid @enderror"
                                            id="adminconfirmnewpasswod" placeholder="············"
                                            aria-describedby="basic-default-password"
                                            value="{{ old('adminconfirmnewpasswod') }}">
                                        <span class="input-group-text cursor-pointer" id="basic-default-password"><i
                                                class="bx bx-hide"></i></span>
                                    </div>
                                    <div id="adminconfirmnewpasswod_error" class="text-danger">
                                        @error('adminconfirmnewpasswod')
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
                    adminoldpassword: {
                        required: true,
                        minlength: 6,
                    },
                    adminnewpassword: {
                        required: true,
                        minlength: 6,
                    },
                    adminconfirmnewpasswod: {
                        required: true,
                        minlength: 6,
                        equalTo: "#adminnewpassword"
                    }
                },
                messages: {
                    adminpassword: {
                        required: 'This field is required',
                        minlength: 'Old Password must be at least 6 characters long'
                    },
                    adminnewpassword: {
                        required: 'This field is required',
                        minlength: 'New Password must be at least 6 characters long'
                    },
                    adminconfirmnewpasswod: {
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
