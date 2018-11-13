@extends('layouts.admin')

@section('content')

    <h1>Users</h1>

    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $user)
                <tr>
                    <td height="50">{{$user->id}}</td>
                    <td>
                        @if($user->photo)
                            <img height="50" src="{{$user->photo->file}}" alt="">
                            @else
                            No image
                            @endif
                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>@if($user->is_active)
                            Active
                            @else
                            Deactivated
                            @endif
                        {{--alternative--}}
                        {{--$user->is_active == 1 ? 'Active' : 'Deactivated'--}}
                    </td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>



@endsection