@extends('admin.layouts.main')
@section('title', 'Users Page')
@section('css')
    <style>
        .add-form {
            display: none;
        }
        table.dataTable thead>tr>th.sorting,
table.dataTable thead>tr>th.sorting_desc{
    padding-right : unset !important;
}
    </style>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@stop
@section('content')
@php use App\Models\Front\Payment; use App\Models\User; @endphp
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users /</span> All Users </h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active " href="javascript:void(0);"><i class="bx bx-user me-1"></i>
                            All Users
                        </a>
                    </li>

                </ul>
                <div class="card">
                    <h5 class="card-header">All Users</h5>
                    <div class="table-responsive text-nowrap p-3">
                        <table class="table table-hover " id="example">
                            <thead>
                                <tr>
                                    <th class="text-center" >ID</th>
                                    <th class="text-center" >Refer Count </th>
                                    <th class="text-center" >Name</th>
                                    <th class="text-center" >Email </th>
                                    <th class="text-center" >Status</th>
                                    <th class="text-center" >Is verified</th>
                                    <th class="text-center" >Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($Users as $User)
                                <tr>
                                    <td class="text-center"><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $User->id }}</strong>
                                    </td>
                                    <td class="text-center"><a href="{{route('admin.get.user_referrals',$User->id)}}"><span class="badge badge-center bg-success">{{ User::get_total_use_referral_user_by_id($User->id)}}</span></a></td>

                                        <td class="text-center"><a href="{{ route('admin.view.user', $User->id) }}">{{ $User->name }}</a></td>
                                        <td class="text-center">{{ $User->email }}</td>
                                        <td class="text-center"> <input data-id="{{ $User->id }}" class="user_status" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="InActive" {{ $User->status ? 'checked' : '' }}>
                                        </td>
                                        <td class="text-center"> <input data-id="{{ $User->id }}" class="user_verified" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Verified" data-off="Not Verified"
                                                {{ $User->is_verified ? 'checked' : '' }}></td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.view.user', $User->id) }}">
                                                <button type="button" class="btn btn-icon btn-outline-success" >
                                                    <i class='bx bx-show'></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('admin.edit.user', $User->id) }}">
                                                <button type="button" class="btn btn-icon btn-outline-primary" >
                                                    <i class='bx bxs-edit'></i>
                                                </button>
                                            </a>
                                            <button type="button" class="btn btn-icon btn-outline-danger" data-bs-toggle="modal" data-bs-target="#user-delete-model-{{ $User->id }}">
                                                <i class="bx bx-trash-alt"></i>
                                              </button>


                                            <div class="modal fade" id="user-delete-model-{{ $User->id }}"
                                                tabindex="-1" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalCenterTitle">Delete Item
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('admin.delete.user', $User->id) }}"
                                                                method="post">
                                                                <h3>Do You Want To Really Delete This Item?</h3>
                                                                @csrf
                                                                @method('DELETE')
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "order": [[ 0, 'desc' ]]
            });
        });
        // $('.add-btn').click(function() {
        //     $('.add-form').slideToggle('slow');
        // })

        $(function() {
            $('.user_verified').change(function() {
                var is_verified = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: '{{ route('admin.update.user.is_verified') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'is_verified': is_verified,
                        'id': id
                    },
                    success: function(data) {
                        if (data.success) {
                            toastr.success(data.success);
                        }
                        if (data.error) {
                            toastr.error(data.error);
                        }
                    }
                });
            })




            $('.user_status').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: '{{ route('admin.update.user.status') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'status': status,
                        'id': id
                    },
                    success: function(data) {
                        if (data.success) {
                            toastr.success(data.success);
                        }
                        if (data.error) {
                            toastr.error(data.error);
                        }
                    }
                });
            })
        })
    </script>
@stop
