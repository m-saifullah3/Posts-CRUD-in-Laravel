@extends('layouts.app')
<script src="https://use.fontawesome.com/3a2eaf6206.js"></script>
<style>
    #book_picture {
        display: none;
    }

    #inputTag {
        display: none;
    }

    #book_picture_label {
        cursor: pointer;
    }
</style>

@section('contents')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h4>Add Post</h4>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('show_posts') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">

            @include('paritials.alerts')

            <form action="{{ route('create_post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="post_pic">Post Picture</label>
                    <div class="text-center">
                        <label for="inputTag" class="form-control @error('post_pic') is-invalid @enderror" id="book_picture_label">
                            Select Image <br />
                            <i class="fa fa-2x fa-camera"></i>
                            <input id="inputTag" name="post_pic" type="file" accept="image/*">
                            <br />
                            <span class="text-success" id="imageName"></span>
                        </label>
                    </div>
                    @error('post_pic')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="title">Post Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                        id="title" value="{{ old('title') }}" placeholder="Please enter your title">
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="body">Post Body</label>
                    <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror" cols="30"
                        rows="10" placeholder="Please enter your Post Body">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <input type="submit" value="Submit" name="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
    <script>
        let input = document.getElementById("inputTag");
        let imageName = document.getElementById("imageName")

        input.addEventListener("change", () => {
            let inputImage = document.querySelector("input[type=file]").files[0];
            imageName.innerText = inputImage.name;
        })
    </script>
@endsection
