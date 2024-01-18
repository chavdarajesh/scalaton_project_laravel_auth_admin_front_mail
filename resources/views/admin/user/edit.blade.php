@extends('admin.layouts.main')
@section('title', 'User Page')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users /</span> All Users / Edit User</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> All Users
                        </a>
                    </li>

                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Profile Setting</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('admin.update.user') }}"
                            enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <input type="hidden" name="id" value="{{ $User->id }}">
                            <div class="row mb-3">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ $User->profileimage ? asset($User->profileimage) : asset('assets/admin/img/avatars/1.png') }}"
                                        alt="user-avatar" class="d-block rounded" height="100" width="100"
                                        id="uploadedAvatar" />
                                    <div id="dvPreview">
                                    </div>
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload"
                                                class="account-file-input adminpgrofilephoto" hidden
                                                accept="image/png, image/jpeg" name="pgrofilephoto"
                                                onchange="readURL(this)" />
                                        </label>
                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="name" class="form-label">Name</label>
                                    <input class="form-control" type="text" id="name" name="name"
                                        value="{{ $User->name }}" autofocus />
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        value="{{ $User->email }}" />
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="phone">Phone Number</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">IND (+91)</span>
                                        <input type="text" id="phone" name="phone" class="form-control"
                                            value="{{ $User->phone }}" />
                                    </div>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="username" class="form-label">User Name</label>
                                    <input class="form-control" type="text" id="username" name="username"
                                        value="{{ $User->username }}" autofocus />
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="adminname" class="form-label">Address</label>
                                    <textarea name="address" id="address" rows="3" class="form-control">{{ $User->address }}</textarea>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="dateofbirth" class="form-label">Date OF Birth</label>
                                    <input class="form-control" type="date" id="dateofbirth" name="dateofbirth"
                                        value="{{ $User->dateofbirth }}" autofocus />
                                </div>
                                <div class="mb-3 col-md-12 form-password-toggle">
                                    <label for="password" class="form-label"> Password</label>
                                    <div class="input-group input-group-merge">
                                        <input name="password" type="password" class="form-control" id="password"
                                            placeholder="············" aria-describedby="basic-default-password">
                                        <span class="input-group-text cursor-pointer" id="basic-default-password"><i
                                                class="bx bx-hide"></i></span>
                                    </div>
                                </div>

                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <a href="{{ route('admin.get.users') }}" class="btn btn-outline-secondary">Cancel</a>
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
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {

                var reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector("#uploadedAvatar").setAttribute("src", e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@stop
