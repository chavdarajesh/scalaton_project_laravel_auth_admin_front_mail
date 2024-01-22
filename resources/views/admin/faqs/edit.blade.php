@extends('admin.layouts.main')
@section('title', 'Edit Faqs')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Faqs /</span> All Faqs /</span> Edit Faq</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">

                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.faqs.index') }}"><i
                                class='bx bx-question-mark  me-1'></i> All Faqs</a>
                    </li>

                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Faqs Setting</h5>
                    <!-- Account -->
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="form" method="POST" action="{{ route('admin.faqs.update') }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $Faq['id'] }}">
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="title" class="form-label">Title</label>
                                    <input class="form-control" type="text" id="title" name="title"
                                        value="{{ $Faq['title'] }}" autofocus />
                                        <div id="title_error" class="text-danger"> @error('title')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" rows="5" type="text" id="description" name="description" value="">{{ $Faq['description'] }}</textarea>
                                    <div id="description_error" class="text-danger"> @error('description')
                                        {{ $message }}
                                    @enderror
                                </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Back</a>
                                </div>
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
    <script src="{{ asset('assets/admin/js/jquery.validate.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#form').validate({
                rules: {
                    title: {
                        required: true,
                    },
                    description: {
                        required: true,
                    }
                },
                messages: {
                    title: {
                        required: 'This field is required',
                    },
                    description: {
                        required: 'This field is required',
                    }
                },
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    $('#' + element.attr('name') + '_error').html(error)
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@stop
