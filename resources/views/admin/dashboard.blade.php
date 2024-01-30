@extends('layout')
@section('content')
    <table class="table">
        <thead>

        </thead>
        <tbody>
        <tr>
            <td>Blogs</td>
            <td>{{$blogCount}}</td>
            <td><a href="/home"> See</a></td>
        </tr>
        <tr>
            <td>Waiting Blogs</td>
            <td>{{$waitingBlogsCount}}</td>
            <td><a href="/admin/waiting-blogs/"> See</a></td>
        </tr>
        <tr>
            <td>Users</td>
            <td>{{$userCount}}</td>
            <td><a href="/admin/users"> See</a></td>
        </tr>
        <tr>
            <td>Top blogs</td>
            <td>5</td>
            <td><a href="/admin/top-blogs"> See</a></td>
        </tr>
        </tbody>
    </table>

@stop
