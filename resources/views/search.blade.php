@extends('layouts.app')

@section('title')
    Search Results
@endsection

@section('navbar')
    @include('inc.navbarGuest')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            @forelse ($results as $result)
                <div class="col-md-4 col-sm-6">
                    <div class="card card-custom">
                        <img class="card-img-top" src="{{ ($result->cover == NULL) ? '/storage/cover_pics/no-cover-image.jpg' : 'storage/cover_pics/' . $result->cover }}" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">{{ $result->title }}</h4>
                            <p class="card-text">{{ strip_tags(str_limit($result->content, rand(120,150))) }}</p>
                            <small>posted by {{ $result->firstName }} {{ $result->lastName }} {{Carbon\Carbon::parse($result->created_at)->diffForHumans()}}</small>
                            <hr>
                            <a href="blogs/{{$result->id}}" class="btn btn-orange">Read More &raquo;</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="display-3 text-center" style="color:#fff;">No Blogs Available</div>
            @endforelse
        </div>
        {{ $results->appends(['search' => $search])->links() }}
    </div>

@endsection

@section('body-style')
    <style> 
        .py-4 {
            background-color: #5a5a5a;
        }
    </style>
@endsection