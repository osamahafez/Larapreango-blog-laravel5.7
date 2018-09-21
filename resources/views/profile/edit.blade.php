@extends('layouts.app')

@section('title')
    Edit Profile
@endsection

@section('navbar')
    @include('inc.navbarUser');
@endsection

@section('content')
    <div class="edit-profile-form">
        <div class="container-fluid">
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
                    
                    {{--Password Error--}}
                    @if(session('password_error'))
                        <div class="alert alert-red alert-dismissible fade show" role="alert">
                            {{session('password_error')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endisset

                    <div class="card card-custom">
                        <div class="card-header card-header-custom">
                            Edit Profile
                        </div>
                        <div class="card-body">
                            <div class="profile-edit-img"> <img class="rounded-circle" src="{{ ($user->image == NULL) ? '/storage/profile_pics/no-image.png' : '/storage/profile_pics/' . $user->image }}" alt="profile_pic"> </div>
                            {!! Form::open(['url' => '/profile/update', 'method' => 'POST', 'class' => 'profile-edit-form', 'enctype' => 'multipart/form-data']) !!}
            
                                {{Form::hidden('id', $user->id)}}

                                <div class="form-group">
                                    {{Form::label('email', 'Email Address')}}
                                    {{Form::email('email', $user->email, ['class'=>'form-control', 'required'=>'required'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('newPass', 'New Password')}}
                                    {{Form::password('newPass', ['class'=>'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('confPass', 'Confirm Password')}}
                                    {{Form::password('confPass', ['class'=>'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('firstName', 'First Name')}}
                                    {{Form::text('firstName', $user->firstName, ['class'=>'form-control', 'required'=>'required'])}}
                                </div>
                                    <div class="form-group">
                                    {{Form::label('lastName', 'Last Name')}}
                                    {{Form::text('lastName', $user->lastName, ['class'=>'form-control', 'required'=>'required'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('age', 'Age')}}
                                    {{Form::number('age', $user->age, ['class'=>'form-control', 'required'=>'required'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('genders', 'Gender')}} &nbsp;&nbsp;
                                    {{Form::radio('gender', 'Male', $user->gender == 'Male'? true:'')}} Male &nbsp;
                                    {{Form::radio('gender', 'Female', $user->gender == 'Female'? true:'')}} Female
                                </div>
                                <div class="form-group">
                                    {{Form::label('country', 'Country')}}
                                    {{Form::text('country', $user->country, ['class'=>'form-control', 'required'=>'required'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('degree', 'Degree')}}
                                    {{Form::text('degree', $user->degree, ['class'=>'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('job', 'Job')}}
                                    {{Form::text('job', $user->job, ['class'=>'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('profile_pic', 'Profile Picture')}} <br>
                                    {{Form::file('profile_pic')}}
                                </div>
                                {{Form::submit('Update', ['class'=>'btn btn-orange'])}}

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
@endsection
