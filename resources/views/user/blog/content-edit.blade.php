@extends('layout')
@section('content')
    <div class="form-group">
        @include('includes.errors')
        <form method="post" action="{{route('blog.content_update',$blog->id)}}">
            @csrf
            @method('put')
            <h1 style="text-align: center">Blog Content</h1>

            <textarea name="content" style="width: 1000px" class="form-control" id="exampleFormControlTextarea1" rows="3">
                {!! $blog->content !!}
            </textarea>
            <button type="submit" class="btn btn-primary">Edit</button>

        </form>
    </div>
@endsection
