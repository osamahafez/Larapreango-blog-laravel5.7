@extends('layouts.app')

@section('title')
    Blogs
@endsection

@section('navbar')
    @guest {{--if you are a guest then include the guest navbar--}}
        @include('inc.navbarGuest')
    @else {{--if you are a user then include the user navbar--}}
        @include('inc.navbarUser')
    @endguest
@endsection

@section('content')

        <div class="container">
            <div class="row">
                @forelse ($blogs as $blog)
                    <div class="col-md-4 col-sm-6">
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
            {{ $blogs->links() }}
        </div>  
    
@endsection

@section('body-style')
    <style> 
        .py-4 {
            background-color: #5a5a5a;
        }
    </style>
@endsection