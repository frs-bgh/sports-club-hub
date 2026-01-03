@extends('layouts.admin')

@section('title', 'create user')

@section('content')
    <h1>create user</h1>

    @if ($errors->any())
        <ul style="color:darkred;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div>
            <label>name</label><br>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <label>email</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label>password</label><br>
            <input type="password" name="password" required>
        </div>

        <div>
            <label>
                <input type="checkbox" name="is_admin" value="1" {{ old('is_admin') ? 'checked' : '' }}>
                admin account
            </label>
        </div>

        <button type="submit">create</button>
    </form>
@endsection
