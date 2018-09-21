@extends('layouts.app')

@section('title')
    About
@endsection

@section('navbar')
    @guest {{--if you are a guest then include the guest navbar--}}
        @include('inc.navbarGuest')
    @else {{--if you are a user then include the user navbar--}}
        @include('inc.navbarUser')
    @endguest
@endsection

@section('content')
    <div class="container text-center about-custom">
        <h1>Larapreango</h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatem debitis aliquam ea veniam repellat eum vel sapiente consequuntur veritatis unde. Qui, deserunt velit totam id exercitationem est ab eius obcaecati.</p>
    </div>
@endsection

@section('body-style')
    <style> 
        .py-4 {
            background-color: #5a5a5a;
            height: 530px;
        }
    </style>
@endsection