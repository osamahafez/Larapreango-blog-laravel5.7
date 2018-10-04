@extends('layouts.app')

@section('title')
    Home
@endsection

@section('navbar')
    @include('inc.navbarUser')
@endsection

@section('content')

    <!--START CAROUSEL-->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{asset('img/laravel_carousel.jpg')}}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('img/FCC_carousel.jpg')}}" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('img/django_carousel.jpg')}}" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!--END CAROUSEL-->

    <!--START BLOGS-->
    <div class="container-fluid">
        <h1 class="text-center" style="color:#fff;">Recent Blogs</h1> <br>
        <div class="row">
                @forelse ($recent_blogs as $blog)
                    <div class="col-md-3 col-sm-6">
                        <div class="card card-custom">
                            <img class="card-img-top" src="{{ ($blog->cover == NULL) ? '/img/no-cover.png' : 'storage/cover_pics/' . $blog->cover }}" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">{{ $blog->title }}</h4>
                                <p class="card-text">{{ strip_tags(str_limit($blog->content, rand(120,150))) }}</p>
                                <small>posted by {{ $blog->firstName }} {{ $blog->lastName }} {{Carbon\Carbon::parse($blog->created_at)->diffForHumans()}}</small>
                                <hr>
                                <a href="blogs/{{$blog->id}}" class="btn btn-orange">Read More &raquo;</a>
                            </div>
                        </div>
                    </div>
                @empty
                <div class="display-3 text-center" style="color:#fff;">No Blogs Available</div>
                @endforelse
            </div>
    </div>
    <!--END BLOGS-->
@endsection

@section('body-style')
    <style> 
        .py-4 {
            background-color: #5a5a5a;
        }
    </style>
@endsection