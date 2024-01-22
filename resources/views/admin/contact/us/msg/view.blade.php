@extends('admin.layouts.main')
@section('title', 'View Conatct Message')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users /</span> Conatct Message / View Conatct Message
        </h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class='bx bxs-contact me-1'></i> Conatct
                            Message
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.contact.settings.index') }}"><i
                                class='bx bxs-contact me-1'></i> Conatct Settings
                        </a>
                    </li>

                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Conatct Message View</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <input type="hidden" name="id" value="{{ $Contact->id }}">

                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control" type="text" id="name" name="name"
                                    value="{{ $Contact->name }}" disabled />
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="text" id="email" name="email"
                                    value="{{ $Contact->email }}" disabled />
                            </div>

                            <div class="mb-3 col-md-12">
                                <label class="form-label" for="subject">Subject</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="subject" name="subject" class="form-control"
                                        value="{{ $Contact->subject }}" disabled />
                                </div>
                            </div>


                            <div class="mb-3 col-md-12">
                                <label for="message" class="form-label">Message</label>
                                <textarea name="message" id="message" rows="3" class="form-control" disabled> {{ $Contact->message }}</textarea>
                            </div>

                        </div>
                        <div class="mt-2">
                            <a href="{{ route('admin.contact.us.msg.index') }}"><button type="submit"
                                    class="btn btn-secondary me-2">Back</button></a>
                        </div>

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
