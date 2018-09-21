@extends('layouts.app')

@section('title')
    Contact Us
@endsection

@section('navbar')
    @guest {{--if you are a guest then include the guest navbar--}}
        @include('inc.navbarGuest')
    @else {{--if you are a user then include the user navbar--}}
        @include('inc.navbarUser')
    @endguest
@endsection

@section('content')
    <h1 class="text-center" style="color:#fff;">Contact Us</h1>
    <div class="container-fluid container-fluid-custom"> 
        <div class="row">
            <div class="col-md-6 offset-md-3">

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
                        
                @guest
                    <div class="contact-custom">
                        <!--START FORM MADE BY LARAVEL COLLECTIVE-->
                        {!! Form::open(['url' => '/contact/submit', 'class' => 'contact-form text-center']) !!}
                            <div class="form-group">
                                {{Form::label('name', 'Name')}} 
                                {{Form::text('name', '', ['class'=>'form-control', 'required'=>'required'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('email', 'Email')}} 
                                {{Form::email('email', '', ['class'=>'form-control', 'required'=>'required'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('msg', 'Message')}} 
                                {{Form::textarea('msg', '', ['class'=>'form-control', 'required'=>'required'])}}
                            </div>
                            {{Form::submit('Submit', ['class'=>'btn btn-orange'])}}
                        {!! Form::close() !!}
                        <!--END FORM MADE BY LARAVEL COLLECTIVE-->
                    </div>
                @else
                    <div class="contact-custom">
                        <!--START FORM MADE BY LARAVEL COLLECTIVE-->
                        {!! Form::open(['url' => '/contact/submit', 'class' => 'contact-form text-center']) !!}
                            <div class="form-group">
                                {{Form::hidden('name', Auth::user()->firstName . ' ' . Auth::user()->lastName)}}
                            </div>
                            <div class="form-group"> 
                                {{Form::hidden('email', Auth::user()->email)}}
                            </div>
                            <div class="form-group">
                                {{Form::label('msg', 'Message')}} 
                                {{Form::textarea('msg', '', ['class'=>'form-control', 'required'=>'required'])}}
                            </div>
                            {{Form::submit('Submit', ['class'=>'btn btn-orange'])}}
                        {!! Form::close() !!}
                        <!--END FORM MADE BY LARAVEL COLLECTIVE-->
                    </div>
                @endguest
                
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