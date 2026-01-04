@extends('layouts.app')

@section('title', 'home')

@section('content')
    <h1>sports club hub</h1>

    <p>this is the start page</p>

    @auth
        <p>you are logged in as <strong>{{ auth()->user()->email }}</strong></p>

        <ul>
            <li><a href="{{ route('dashboard') }}">go to dashboard</a></li>
            <li><a href="{{ route('profile.edit') }}">edit my profile</a></li>
            <li><a href="{{ route('profiles.show', auth()->user()) }}">my public profile</a></li>

            @if (auth()->user()->is_admin)
                <li><a href="{{ route('admin.users.index') }}">admin: manage users</a></li>
            @endif
        </ul>
    @else
        <p>you are not logged in</p>

        <ul>
            <li><a href="{{ route('login') }}">login</a></li>
            <li><a href="{{ route('register') }}">register</a></li>
        </ul>
    @endauth
@endsection
