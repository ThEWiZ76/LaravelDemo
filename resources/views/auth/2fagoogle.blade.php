@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">2FA Authentication</div>
                    <div class="panel-body">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{session('error')}}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        @endif
                        <p>Enter the code from the Authenticator app</p>
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('2faVerify') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                {!! Form::label('one_time_password', 'Code') !!}
                                {!! Form::password('one_time_password', ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    {!! Form::submit('Proceed', ['class'=>'btn btn-success']) !!}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
