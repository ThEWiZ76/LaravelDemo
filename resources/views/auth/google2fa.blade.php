@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">2 factor authentication</div>
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
                        @if(!count($data['user']->passwordSecurity))
                                <div class="alert alert-danger">2FA is currently enabled.</div>
                            <p>Click the generate secret button to create your code.</p>
                            <p>Use an authenticator app (e.g. Google or LastPass) to save.</p>
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('generate2faSecretCode') }}">
                                {{ csrf_field() }}
                                <div class="col-md-8 col-md-offset-2">
                                    {!! Form::submit('Generate secret key', ['class'=>'btn btn-info']) !!}
                                </div>
                            </form>
                        @elseif(!$data['user']->passwordSecurity->google2fa_enable)
                            <p>Scan this barcode with the app</p>
                            <img src="{{$data['google2FaUrl']}}">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('enable2fa') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    {!! Form::label('verifyCode', 'Verify code') !!}
                                    {!! Form::password('verifyCode', ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-2">
                                        {!! Form::submit('Enable 2FA', ['class'=>'btn btn-success']) !!}
                                    </div>
                                </div>
                            </form>
                        @elseif($data['user']->passwordSecurity->google2fa_enable)
                                <div class="alert alert-success">2FA is currently enabled.</div>
                              <p>Use the form below to disable it.</p>
                              <form class="form-horizontal" role="form" method="POST" action="{{ route('disable2fa') }}">
                                  {{ csrf_field() }}
                                  <div class="form-group">
                                      {!! Form::label('currentPassword', 'Enter your current password') !!}
                                      {!! Form::password('currentPassword', ['class'=>'form-control']) !!}
                                  </div>
                                  <div class="form-group">
                                      <div class="col-md-8 col-md-offset-2">
                                          {!! Form::submit('Disable 2FA', ['class'=>'btn btn-success']) !!}
                                      </div>
                                  </div>
                              </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
