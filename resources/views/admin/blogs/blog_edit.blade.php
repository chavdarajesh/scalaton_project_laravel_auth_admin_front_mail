@extends('admin.layouts.main')
@section('title', 'Edit Blog')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Blogs /</span> All Blogs /</span> Edit Blog</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">

                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.get.blogs') }}"><i class='bx bx-list-ul me-1'></i> All
                            Blogs</a>
                    </li>

                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Blogs Setting</h5>
                    <!-- Account -->
                    <hr class="my-0" />
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.update.blog') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $Blog['id'] }}">
                            <input type="hidden" name="old_image" value="{{ $Blog['image'] }}">
                            <div class="row mb-3">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ $Blog['image'] ? asset($Blog['image']) : asset('assets/admin/img/avatars/dummy-image-square.jpg') }}"
                                        alt="user-avatar" class="d-block rounded" height="100" width="100"
                                        id="uploadedAvatar" />
                                    <div id="dvPreview">
                                    </div>
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" class="account-file-input" hidden
                                                accept="image/*" name="image" onchange="readURL(this)" />
                                        </label>
                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 4Mb</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="title" class="form-label">Title</label>
                                    <input class="form-control" type="text" id="title" name="title"
                                        value="{{ $Blog['title'] }}" autofocus />
                                </div>
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="mb-3 col-md-6">
                                    <label for="author" class="form-label">Author</label>
                                    <input class="form-control @error('author') is-invalid @enderror" type="text"
                                        id="author" name="author"
                                        value="{{ $Blog['author'] ? $Blog['author'] : (Auth::user() && Auth::user()->name ? Auth::user()->name : '') }}" />
                                </div>
                                @error('author')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="mb-3 col-md-6">
                                    <label for="publish-date" class="form-label">Publish Date</label>
                                    <input class="form-control @error('published_date') is-invalid @enderror" type="date"
                                        id="publish-date" name="published_date"
                                        value="{{ $Blog['published_date'] ? $Blog['published_date'] : date('Y-m-d') }}" />
                                </div>
                                @error('published_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="mb-3 col-md-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" rows="5" type="text" id="description" name="description" value="">{{ $Blog['description'] }}</textarea>
                                </div>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <a href="{{ route('admin.get.blogs') }}" class="btn btn-secondary">Back</a>
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
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
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
        CKEDITOR.replace('description');
    </script>
@stop
