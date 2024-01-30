@extends('layout')
@section('content')
<div class="form-group">
    @include('includes.errors')
   <form method="post" action="{{route('blog.content_store')}}">
       @csrf
       <h1 style="text-align: center">Blog Content</h1>

       <textarea name="content" style="width: 1000px" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
       <button type="submit" class="btn btn-primary">Create</button>

   </form>
</div>
@endsection
