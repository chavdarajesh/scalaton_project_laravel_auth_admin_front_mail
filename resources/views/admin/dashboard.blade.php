@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-2 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                    <button type="button" class="btn btn-icon btn-outline-primary" >
                                        <i class='bx bx-user' ></i>
                                    </button>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="{{route('admin.get.users')}}">View
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Total Users</span>
                        <h3 class="card-title mb-2">
                                <i class='bx bx-user' ></i>
                                <span class="badge badge-center bg-primary">{{$data['Total_Users']}}</span>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                    <button type="button" class="btn btn-icon btn-outline-primary" >
                                        <i class='bx bx-wallet'></i>
                                    </button>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="">View
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Total Blogs</span>
                        <h3 class="card-title mb-2"><i class='bx bx-wallet'></i><span class="badge badge-center bg-primary">0</span>   </h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Congratulations {{Auth::user()->name}}! 🎉</h5>
                                <p class="mb-4">
                                    You have posted <span class="badge bg-label-success">0</span> blogs..!
                                </p>

                                <a href="#" class="btn btn-sm btn-outline-primary">View Blogs</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('assets/admin/img/illustrations/man-with-laptop-light.png') }}"
                                    height="140" alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-4 order-1">
                <div class="row">

                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                            <button type="button" class="btn btn-icon btn-outline-success" >
                                                <i class='bx bx-user-check' ></i>
                                            </button>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                            <a class="dropdown-item" href="javascript:void(0);">View
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total Verified Users</span>
                                <h3 class="card-title mb-2"><i class='bx bx-user-check' ></i>  <span class="badge badge-center bg-success">{{$data['Total_Verified_Users']}}</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                            <button type="button" class="btn btn-icon btn-outline-danger" >
                                                <i class='bx bx-user-x' ></i>
                                            </button>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                            <a class="dropdown-item" href="javascript:void(0);">View
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total Not Verified Users</span>
                                <h3 class="card-title mb-2"> <i class='bx bx-user-x' ></i>  <span class="badge badge-center bg-danger">{{$data['Total_Not_Verified_Users']}}</span> </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                            <button type="button" class="btn btn-icon btn-outline-success" >
                                                <i class='bx bxs-user-check' ></i>
                                            </button>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                            <a class="dropdown-item" href="javascript:void(0);">View
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total Active  Users</span>
                                <h3 class="card-title mb-2"><i class='bx bxs-user-check' ></i>  <span class="badge badge-center bg-success">{{$data['Total_Active_Users']}}</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                            <button type="button" class="btn btn-icon btn-outline-danger" >
                                                <i class='bx bxs-user-x'></i>
                                            </button>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                            <a class="dropdown-item" href="javascript:void(0);">View
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total Block Users</span>
                                <h3 class="card-title mb-2"> <i class='bx bxs-user-x'></i>  <span class="badge badge-center bg-danger">{{$data['Total_Not_Active_Users']}}</span> </h3>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                            <button type="button" class="btn btn-icon btn-outline-success" >
                                                <i class='bx bx-credit-card-front' ></i>
                                            </button>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                            <a class="dropdown-item" href="javascript:void(0);">View
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total Verified Blogs</span>
                                <h3 class="card-title mb-2">  <i class='bx bx-credit-card-front' ></i> <span class="badge badge-center bg-success">0</span> </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                            <button type="button" class="btn btn-icon btn-outline-danger" >
                                                <i class='bx bxs-credit-card-front'></i>
                                            </button>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                            <a class="dropdown-item" href="javascript:void(0);">View
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total Not Verified Blogs</span>
                                <h3 class="card-title mb-2">    <i class='bx bxs-credit-card-front'></i> <span class="badge badge-center bg-danger">0</span></h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@stop
