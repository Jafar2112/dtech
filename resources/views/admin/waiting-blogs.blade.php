@extends('layout')
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name Surname</th>
            <th scope="col">Content</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
       @foreach($blogs as $blog)
           <tr>
               <th scope="row">{{$blog->id}}</th>
               <td>{{$blog->user->name}} {{$blog->user->surname}}</td>
               <td>{{Str::limit($blog->content,20)}}</td>
               <td><a href="/admin/blog/{{$blog->id}}">See</a></td>
           </tr>
       @endforeach
        </tbody>
    </table>
@stop
