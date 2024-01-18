@extends('admin.layouts.main')
@section('title', 'View Blog')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Blogs /</span> All Blogs /</span> View Blog</h4>

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
                        <div class="row mb-3">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ asset($Blog['image']) }}" alt="user-avatar" class="d-block rounded"
                                    height="100" width="100" id="uploadedAvatar" />
                                <div id="dvPreview">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="title" class="form-label">Title</label>
                                <input class="form-control" type="text" disabled id="title" name="title"
                                    value="{{ $Blog['title'] }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="author" class="form-label">Author</label>
                                <input class="form-control" type="text" disabled id="author" name="author"
                                    value="{{ $Blog['author'] }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="published_date" class="form-label">Published Date</label>
                                <input class="form-control" type="text" disabled id="published_date"
                                    name="published_date" value="{{ $Blog['published_date'] }}" />
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <div class="form-control">
                                    {!! html_entity_decode($Blog['description']) !!}
                                </div>
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('admin.edit.blog', $Blog->id) }}" class="btn btn-success">Edit</a>
                                <a href="{{ route('admin.get.blogs') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@stop
