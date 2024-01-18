@extends('admin.layouts.main')
@section('title', 'Contact Message Page')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@stop
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Contact /</span>  Contact Message</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active " href="javascript:void(0);"><i class='bx bxs-contact me-1' ></i>
                             Contact Message
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.get.contact_settings')}}"><i class='bx bxs-contact me-1' ></i>  Conatct Settings
                        </a>
                    </li>

                </ul>
                <div class="card">
                    <h5 class="card-header">All Conact Message</h5>
                    <div class="table-responsive text-nowrap p-3">
                        <table class="table table-hover " id="example">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email </th>
                                    <th class="text-center">Subject</th>
                                    <th class="text-center">Message</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($Contacts as $Contact)
                                    <tr>
                                        <td class="text-center"><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $Contact->id }}</strong>
                                        </td>

                                        <td class="text-center">{{ $Contact->name }}</td>
                                        <td class="text-center">{{ $Contact->email }}</td>
                                        <td class="text-center">{{ $Contact->subject }}</td>
                                        <td class="text-center">
                                            @if (strlen($Contact->message) > 8)
                                                @php
                                                    echo substr($Contact->message, 0, 8).'..';
                                                @endphp
                                            @else
                                                {{ $Contact->message }}
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('admin.view.contcat_msg', $Contact->id) }}">
                                            <button type="button" class="btn btn-icon btn-outline-success">
                                                <i class='bx bx-show'></i>
                                            </button>
                                            </a>

                                            <button type="button" class="btn btn-icon btn-outline-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#contact-delete-model-{{ $Contact->id }}">
                                                <i class="bx bx-trash-alt"></i>
                                            </button>


                                            <div class="modal fade" id="contact-delete-model-{{ $Contact->id }}"
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
                                                            <form action="{{ route('admin.delete.contact_msg', $Contact->id) }}"
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
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "order": [
                    [0, 'desc']
                ]
            });
        });
    </script>
@stop
