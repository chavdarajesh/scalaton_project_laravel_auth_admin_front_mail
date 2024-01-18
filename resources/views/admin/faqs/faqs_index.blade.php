@extends('admin.layouts.main')
@section('title', 'Faqs List')
@section('css')
    <link href="{{ asset('assets/admin/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dataTables.bootstrap5.min.css') }}">
@stop
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Faqs /</span> All Faqs</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">


                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class='bx bx-question-mark  me-1'></i>All
                            Faqs</a>
                    </li>

                </ul>
                <div class="card mb-4">
                    <h5 class="card-header justify-content-between d-flex">
                        <div>Faqs Setting </div>
                        <div><a href="{{ route('admin.add.faq') }}" class="btn btn-primary add-btn">Add New Faq</a></div>
                    </h5>
                    <!-- Account -->

                    <hr class="my-0" />

                    <!-- /Account -->
                </div>
                <div class="card">
                    <h5 class="card-header">All Faqs</h5>
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
                                @foreach ($Faqs as $Faq)
                                    <tr>
                                        <td class="text-center"><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $Faq->id }}</strong>
                                        </td>
                                        <td class="text-center" title="{{ $Faq->title }}">
                                            @if (strlen($Faq->title) > 20)
                                                @php
                                                    echo substr($Faq->title, 0, 20) . '..';
                                                @endphp
                                            @else
                                                {{ $Faq->title }}
                                            @endif
                                        </td>
                                        <td class="text-center" title="{{ $Faq->description }}">
                                            @if (strlen($Faq->description) > 20)
                                                @php
                                                    echo substr($Faq->description, 0, 20) . '..';
                                                @endphp
                                            @else
                                                {{ $Faq->description }}
                                            @endif
                                        </td>

                                        <td class="text-center"> <input data-id="{{ $Faq->id }}" class="toggle-class"
                                                type="checkbox" data-onstyle="success" data-offstyle="danger"
                                                data-toggle="toggle" data-on="Active" data-off="InActive"
                                                {{ $Faq->status ? 'checked' : '' }}></td>
                                        <td class="text-center">{{ $Faq->created_at }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.view.faq', $Faq->id) }}"> <button type="button"
                                                    class="btn btn-icon btn-outline-success">
                                                    <i class='bx bx-show'></i>
                                                </button></a>
                                            <a href="{{ route('admin.edit.faq', $Faq->id) }}"> <button type="button"
                                                    class="btn btn-icon btn-outline-primary">
                                                    <i class='bx bxs-edit'></i>
                                                </button></a>

                                            <button type="button" class="btn btn-icon btn-outline-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#Faq-delete-modal-{{ $Faq->id }}">
                                                <i class="bx bx-trash-alt"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="Faq-delete-modal-{{ $Faq->id }}"
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
                                                            <form action="{{ route('admin.delete.faq', $Faq->id) }}"
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
                    url: '{{ route('admin.update.faq.status') }}',
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
