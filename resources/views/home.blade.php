@extends('layout')
@section('header')
    <link rel="stylesheet" href="/css//home.css">
@endsection
@section('content')
    <div class="container mt-5">
        @forelse($blogs as $blog)
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">{{$blog->user->name}} {{$blog->user->surname}}</div>
                            <!-- Post categories-->
                        </header>
                        <!-- Preview image figure-->
                        @if($blog->images->isNotEmpty())
                            @if($blog->images->count()==1)
                                <figure class="mb-4"><img class="img-fluid rounded" src="/blog-images/{{$blog->image}}"
                                                          alt="..."/></figure>
                            @else
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($blog->images as $key => $image)
                                            @if($key == 1)
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100"
                                                         src="/blog-images/{{$image->image}}"
                                                         alt="First slide">
                                                </div>
                                            @else

                                                <div class="carousel-item">
                                                    <img class="d-block w-100"
                                                         src="/blog-images/{{$image->image}}"
                                                         alt="Second slide">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                       data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                       data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            @endif<!-- Post content-->
                        @endif
                        <section class="mb-5">
                            <p class="fs-5 mb-4">
                                {!! nl2br(e($blog->content))  !!}
                            </p>
                        </section>
                    </article>
                    <!-- Comments section-->
                    <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body">
                                <!-- Comment form-->
                                <form method="post" action="{{route('comment.store',$blog->id)}}" class="mb-4">
                                    @csrf
                                    <textarea name="content" class="form-control" rows="3"
                                              placeholder="Join the discussion and leave a comment!"></textarea>
                                    <button type="submit" class="btn btn-success">Send</button>
                                </form>
                                <!-- Comment with nested comments-->
                                @foreach($blog->comments->sortByDesc('id') as $comment)
                                    <div class="d-flex mb-4">
                                        <!-- Parent comment-->
                                        <div class="flex-shrink-0"><img class="rounded-circle"
                                                                        src="https://dummyimage.com/50x50/ced4da/6c757d.jpg"
                                                                        alt="..."/></div>
                                        <div class="ms-3">
                                            <div class="fw-bold">{{$comment->user->name}}</div>
                                            {!! nl2br(e($comment->content)) !!}
                                        </div>
                                    </div>
                                @endforeach
                                <!-- Single comment-->

                            </div>
                        </div>
                    </section>
                </div>
                <!-- Side widgets-->

            </div>
        @empty
            {{'There is no posts yet'}}
        @endforelse
    </div>
@stop
