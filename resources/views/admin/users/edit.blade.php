@extends('layouts.admin')

@section('content')

    <h1>Edit user</h1>

    <div class="row">

        <div class="col-sm-3">

            <img src="{{$user->photo ? $user->photo->file : '/images/No_image_available.svg'}}" alt="" class="img-responsive img-rounded">

        </div>

        <div class="col-sm-9">
            {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update',$user->id],'files'=>true]) !!}
            <div class="form-group">
                {!! Form::label('name', 'name') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'email') !!}
                {!! Form::email('email', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'password') !!}
                {!! Form::password('password', ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('role_id', 'role') !!}
                {!! Form::select('role_id', $roles, null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('is_active', 'active') !!}
                {!! Form::select('is_active', [1 => 'Active', 0 => 'Deactivated'] ,null , ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('photo_id', 'avatar') !!}
                {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
            </div>

            {{csrf_field()}}
            <div class="form-group">
                {!! Form::submit('Save user', ['class'=>'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}

        </div>
    </div>
    <div class="row">
        @include('includes.submiterror')
    </div>
@endsection