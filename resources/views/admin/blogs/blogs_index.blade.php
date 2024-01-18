@extends('admin.layouts.main')
@section('title', 'Blogs List')
@section('css')
    <link href="{{ asset('assets/admin/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dataTables.bootstrap5.min.css') }}">
@stop
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Blogs /</span> All Blogs</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">


                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class='bx bx-list-ul me-1'></i>All
                            Blogs</a>
                    </li>

                </ul>
                <div class="card mb-4">
                    <h5 class="card-header justify-content-between d-flex">
                        <div>Blogs Setting </div>
                        <div><a href="{{ route('admin.add.blog') }}" class="btn btn-primary add-btn">Add New Blog</a></div>
                    </h5>
                    <!-- Account -->

                    <hr class="my-0" />

                    <!-- /Account -->
                </div>
                <div class="card">
                    <h5 class="card-header">All Blogs</h5>
                    <div class="table-responsive text-nowrap p-3">
                        <table class="table table-hover " id="example">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Descriptions</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($Blogs as $Blog)
                                    <tr>
                                        <td class="text-center"><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $Blog->id }}</strong>
                                        </td>
                                        <td class="text-center">{{ $Blog->title }}</td>
                                        <td class="text-center" title="{{ strip_tags($Blog->description) }}">
                                            @if (strlen($Blog->description) > 20)
                                                {{ substr(strip_tags($Blog->description), 0, 20) . '..' }}
                                            @else
                                                {{ $Blog->description }}
                                            @endif
                                        </td>

                                        <td class="text-center"> <input data-id="{{ $Blog->id }}" class="toggle-class"
                                                type="checkbox" data-onstyle="success" data-offstyle="danger"
                                                data-toggle="toggle" data-on="Active" data-off="InActive"
                                                {{ $Blog->status ? 'checked' : '' }}></td>
                                        <td class="text-center">{{ $Blog->created_at }}</td>
                                        <td class="text-center">

                                            <a href="{{ route('admin.view.blog', $Blog->id) }}"> <button type="button"
                                                    class="btn btn-icon btn-outline-success">
                                                    <i class='bx bx-show'></i>
                                                </button></a>
                                            <a href="{{ route('admin.edit.blog', $Blog->id) }}"> <button type="button"
                                                    class="btn btn-icon btn-outline-primary">
                                                    <i class='bx bxs-edit'></i>
                                                </button></a>

                                            <button type="button" class="btn btn-icon btn-outline-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#Blog-delete-modal-{{ $Blog->id }}">
                                                <i class="bx bx-trash-alt"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="Blog-delete-modal-{{ $Blog->id }}"
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
                                                            <form action="{{ route('admin.delete.blog', $Blog->id) }}"
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
    <script src="{{ asset('assets/admin/js/bootstrap-toggle.min.js') }}"></script>

    <script src="{{ asset('assets/admin/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('assets/admin/js/dataTables.bootstrap5.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "order": [
                    [0, 'desc']
                ]
            });
        });
        $(function() {

            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: '{{ route('admin.update.blog.status') }}',
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
