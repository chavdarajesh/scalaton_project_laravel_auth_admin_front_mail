@extends('admin.layouts.main')
@section('title', 'View User')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users /</span> All Users / View User</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> All Users
                        </a>
                    </li>

                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">User View</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <input type="hidden" name="id" value="{{ $User->id }}">
                        <div class="row mb-3">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ $User->profileimage ? asset($User->profileimage) : asset('assets/admin/img/avatars/1.png') }}"
                                    alt="user-avatar" class="d-block rounded" height="100" width="100"
                                    id="uploadedAvatar" />
                                <div id="dvPreview">
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control" type="text" id="name" name="name"
                                    value="{{ $User->name }}" disabled />
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="text" id="email" name="email"
                                    value="{{ $User->email }}" disabled />
                            </div>

                            <div class="mb-3 col-md-12">
                                <label class="form-label" for="phone">Phone Number</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">IND (+91)</span>
                                    <input type="text" id="phone" name="phone" class="form-control"
                                        value="{{ $User->phone }}" disabled />
                                </div>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="username" class="form-label">User Name</label>
                                <input class="form-control" type="text" id="username" name="username"
                                    value="{{ $User->username }}" disabled />
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="address" rows="3" class="form-control" disabled> {{ $User->address }}</textarea>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="dateofbirth" class="form-label">Date OF Birth</label>
                                <input class="form-control" type="date" id="dateofbirth" name="dateofbirth"
                                    value="{{ $User->dateofbirth }}" disabled />
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="referral_code" class="form-label">Referral Code</label>
                                <input class="form-control" type="text" id="referral_code" name="referral_code"
                                    value="{{ $User->other_referral_code }}" disabled />
                            </div>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('admin.edit.user', $User->id) }}"><button type="submit"
                                    class="btn btn-success me-2">Edit</button></a>
                            <a href="{{ route('admin.get.users') }}"><button type="submit"
                                    class="btn btn-secondary me-2">Back</button></a>
                        </div>

                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@stop
