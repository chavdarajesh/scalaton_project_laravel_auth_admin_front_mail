@extends('admin.layouts.main')
@section('title', 'Password Setting')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Password Setting</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.profile.setting') }}"><i class="bx bx-user me-1"></i>
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
                        <form id="formAccountSettings" method="POST"
                            action="{{ route('admin.profile.setting.changepassword.post') }}">
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
                                    @error('adminoldpassword')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
                                    @error('adminnewpassword')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
                                    @error('adminconfirmnewpasswod')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@stop
