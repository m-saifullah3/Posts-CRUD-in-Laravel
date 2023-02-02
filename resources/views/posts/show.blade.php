@extends('layouts.app')

@section('contents')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h4>Post</h4>
            </div>
            <div class="col-6 text-end">
                <a href="{{ route('show_posts') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">

        @include('paritials.alerts')


        <div class="text-center"><img style="width: 200px; height: 320px;" src="{{ asset('post_pics/'. $post->post_picture) }}"></div>
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->body }}</p>

        <a href="{{ route('edit_post', $post) }}" class="btn btn-primary">Edit</a>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
            Delete
        </button>

    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Post?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this post?
            </div>
            <div class="modal-footer">
                <form action="{{ route('delete_post', $post) }}" method="POST">
                    @csrf
                    <input type="submit" value="Delete" class="btn btn-danger">
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
