@extends('layouts.app')

@section('title')
    {{$user[0]->firstName}}'s Blogs
@endsection

@section('navbar')
    @include('inc.navbarUser')
@endsection

@section('content')
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 sidebar">
                
                <div class="text-center"><img class="rounded-circle" src="/storage/profile_pics/{{$image}}"></div>
                <h2 class="text-center">{{$user[0]->firstName}} {{$user[0]->lastName}}</h2>
                <hr>
                <h5><span>Age:</span> {{$user[0]->age}}</h5>
                <h5><span>Gender:</span> {{$user[0]->gender}}</h5>
                <h5><span>Country:</span> {{$user[0]->country}}</h5> <!--Country flag-->
                <h5><span>Degree:</span> {{$user[0]->degree}}</h5>
                <h5><span>Job:</span> {{$user[0]->job}}</h5>
                <h5><span>Email:</span> {{$user[0]->email}}</h5>
                <h5><span>Joined:</span> {{Carbon\Carbon::parse($user[0]->created_at)->format('d-M-Y')}}</h5>
                <hr>
                <h5><span>Blogs:</span> {{count($blogs)}}</h5>
                <h5><span>Stars:</span> {{$stars}}</h5>

            </div>
            <div class="col-md-9">
                
                {{--SUCCESS MESSAGE--}}
                @if(session('msg_success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('msg_success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endisset

                <div class="row">
                    @forelse ($blogs as $blog)
                        <div class="col-md-4 col-sm-6">
                            <div class="card card-custom">
                                <img class="card-img-top" src="{{ ($blog->cover == NULL) ? '/storage/cover_pics/no-cover-image.jpg' : 'storage/cover_pics/' . $blog->cover }}" alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $blog->title }}</h4>
                                    <p class="card-text">{{ strip_tags(str_limit($blog->content, rand(120,150))) }}</p>
                                   
                                    <small>posted {{Carbon\Carbon::parse($blog->created_at)->diffForHumans()}}</small>
                                    <div class="text-center">
                                        <hr>
                                        <a href="blogs/{{$blog->id}}/edit" class="btn btn-sm btn-outline-success"> <i class="fas fa-edit fa-2x"></i> </a>
                                        <a href="blogs/{{$blog->id}}" class="btn btn-dark">Show</a>
                                        <div class="delete-form">
                                            {!! Form::open(['action' => ['BlogsController@destroy', $blog->id], 'method' => 'POST']) !!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit( '&#xf2ed;' , ['class'=>'btn btn-sm btn-outline-danger fas fa-2x'])}}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    <div class="display-3 text-center" style="color:#fff;">No Blogs Available</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body-style')
    <style> 
        .py-4 {
            background-color: #5a5a5a;
        }
    </style>
@endsection