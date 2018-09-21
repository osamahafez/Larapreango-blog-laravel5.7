@extends('layouts.app')

@section('title')
    {{$blog[0]->title}}
@endsection

@section('navbar')
    @guest
        @include('inc.navbarGuest');
    @else
        @include('inc.navbarUser');
    @endguest
@endsection

@section('content')
    <div class="container show-blog">
        <div class="text-center display-4">{{$blog[0]->title}}</div>
        <p class="text-center">by {{$blog[0]->firstName}} {{$blog[0]->lastName}}</small>
        <small class="text-center">{{$date}}</small>
        <br>
        <div class="show-body">
            {!!$blog[0]->content!!}
        </div>

        </div>
    </div>
@endsection
