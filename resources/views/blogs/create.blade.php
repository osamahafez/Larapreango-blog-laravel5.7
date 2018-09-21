@extends('layouts.app')

@section('title')
    New Blog
@endsection

@section('navbar')
    @include('inc.navbarUser');
@endsection

@section('content')
    <div class="create-blog">
        <div class="container">

            {{--SUCCESS MESSAGE--}}
            @if(session('msg_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('msg_success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endisset

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
            
            <h1>Create Blog</h1>
            
            {!! Form::open(['action' => 'BlogsController@store', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Title', 'required'=>'required'])}}
                </div>
                <div class="form-group">
                    {{Form::textarea('body', '', ['class'=>'form-control blog-body', 'cols'=>'50', 'required'=>'required'])}}
                </div>
                <div class="form-group">
                    {{Form::file('cover')}}
                </div>
                {{Form::submit('Create', ['class'=>'btn btn-orange'])}}
            {!! Form::close() !!}

        </div>
    </div>
@endsection

