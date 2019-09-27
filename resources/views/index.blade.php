@extends('layouts.app')

@section('title')
    larapreango
@endsection

@section('navbar')
    @include('inc.navbarGuest')
@endsection

@section('content')
    <div class="jumbotron jumb-custom">
        <div class="container">
            <h1 class="display-4">Welcome, </h1>
            <p class="lead">A Social Network made in 2018 with <span style="color:#ff8839">Laravel</span>. You can view user's blogs without registration, but if must sign up and login to create a blog.</p>
            <p><a class="btn btn-yellow btn-lg btn-block" href="{{url('/register')}}" role="button"> Sign up</a></p>
            <p><a class="btn btn-orange btn-lg btn-block" href="{{url('/login')}}" role="button"> Login</a></p>
        </div>
    </div>
    
    <div class="container">
        <h1 class="text-center">Popular Blogs</h1> <br>
        <div class="row">
            @forelse ($popular_blogs as $blog)
                <div class="col-md-4 col-sm-6">
                    <div class="card card-custom">
                        <img class="card-img-top" src="{{ ($blog->cover == NULL) ? '/img/no-cover.png' : 'storage/cover_pics/' . $blog->cover }}" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">{{ $blog->title }}</h4>
                            <p class="card-text">{{ str_limit($blog->content, rand(120,150)) }}</p>
                            <small>posted by {{ $blog->firstName }} {{ $blog->lastName }} {{Carbon\Carbon::parse($blog->created_at)->diffForHumans()}}</small>
                            <hr>
                            <a href="blogs/{{$blog->id}}" class="btn btn-orange">Read More &raquo;</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="display-3 text-center">No Blogs Available</div>
            @endforelse
        </div>
    </div>

@endsection

@section('body-style')
    <style> 
        .py-4 {
            background-color: #f3f3f3;
        }
    </style>
@endsection