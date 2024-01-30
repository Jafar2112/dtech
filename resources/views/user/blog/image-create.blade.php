@extends('layout')
@section('content')
    <div>
        @include('includes.errors')
        <form action="{{route('blog.image_store',$blog->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="formFileLg" class="form-label">Upload Image</label>
            <input name="image" class="form-control form-control-lg" id="formFileLg" type="file">

            <button type="submit" class="btn btn-success">Add</button>
            <a href="/home">
                <button type="button" class="btn btn-primary">End</button>
            </a>
            <a href="{{route('blog.content_edit',$blog->id)}}">
                <button type="button" class="btn btn-danger">Back</button>
            </a>
        </form>

        @foreach($blog->images as $image)
            <img style="width: 100px;height: 100px" src="/blog-images/{{$image->image}}" class="img-fluid"
                 alt="Responsive image">
        @endforeach



    </div>
@endsection
