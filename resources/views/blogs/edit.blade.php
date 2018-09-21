@extends('layouts.app')

@section('title')
    Edit Blog
@endsection

@section('navbar')
    @include('inc.navbarUser');
@endsection

@section('content')
    <div class="edit-blog">
        <div class="container">
            
            {{--ERROR MESSAGE--}}
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-red alert-dismissible fade show" role="alert">
                        {{ $error }} <br>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endforeach
            @endif

            <h1>Edit Blog</h1>

            @if ($blog->cover != NULL)
                <div>
                    <img style="width:50%; margin:auto; display:block" src="/storage/cover_pics/{{$blog->cover}}" alt="cover-edit">
                </div> <br> <br>
            @endif
            
            {!! Form::open(['action' => ['BlogsController@update', $blog->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::text('title', $blog->title, ['class'=>'form-control', 'placeholder'=>'Title', 'required'=>'required'])}}
                </div>
                <div class="form-group">
                    {{Form::textarea('body', $blog->content, ['class'=>'form-control blog-body', 'cols'=>'50', 'required'=>'required'])}}
                </div>
                <div class="form-group">
                    {{Form::file('cover')}}
                </div>
                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('Update', ['class'=>'btn btn-orange'])}}
            {!! Form::close() !!}

        </div>
    </div>
@endsection
