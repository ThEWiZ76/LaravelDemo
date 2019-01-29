@extends('layouts.admin')

@section('content')

    <h1>Create user</h1>

            {!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store','files'=>true]) !!}
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
                        {!! Form::select('role_id', [''=>'Pick a role...'] + $roles, null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('is_active', 'active') !!}
                        {!! Form::select('is_active', [1 => 'Active', 0 => 'Deactivated'] ,0 , ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('photo_id', 'avatar') !!}
                        {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
                    </div>

                    {{csrf_field()}}
            <div class="form-group">
                {!! Form::submit('Create user', ['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}

        @include('includes.submiterror')

@endsection