@extends('admin.layouts.main')
@section('title', 'Contact Settings Page')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Contact /</span> Contact Settings</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.get.contact_msg') }}"><i class='bx bxs-contact me-1'></i>
                            Contact Message
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active " href="javascript:void(0);"><i class='bx bxs-contact me-1'></i>
                            Contact Settings
                        </a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Contact Settings</h5>
                    <!-- Account -->

                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="">
                            @csrf
                            <input type="hidden" name="id"
                                value="{{ $ContactSetting ? $ContactSetting['id'] : 1 }}">
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="map_iframe" class="form-label">Map IFrame</label>
                                    <textarea rows="5" class="form-control @error('map_iframe') is-invalid @enderror" type="text" id="map_iframe"
                                        name="map_iframe" autofocus>{{ $ContactSetting ? $ContactSetting['map_iframe'] : old('map_iframe') }}</textarea>
                                    @error('map_iframe')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="location" class="form-label">Location</label>
                                    <textarea class="form-control @error('location') is-invalid @enderror" type="text" id="location" name="location"
                                        autofocus>{{ $ContactSetting ? $ContactSetting['location'] : old('location') }}</textarea>
                                    @error('location')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input class="form-control @error('phone') is-invalid @enderror" type="text"
                                        id="phone" name="phone"
                                        value="{{ $ContactSetting ? $ContactSetting['phone'] : old('phone') }}"
                                        autofocus />
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="text"
                                        id="email" name="email"
                                        value="{{ $ContactSetting ? $ContactSetting['email'] : old('email') }}"
                                        autofocus />
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save</button>
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
