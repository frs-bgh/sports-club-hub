@extends('layouts.admin')

@section('title', 'admin users')

@section('content')
    <h1>admin - users</h1>

    <p><a href="{{ route('admin.users.create') }}">+ create user</a></p>

    <table border="1" cellpadding="8" cellspacing="0" style="width:100%;">
        <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>admin?</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->is_admin ? 'yes' : 'no' }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.users.toggleAdmin', $user) }}">
                        @csrf
                        <button type="submit">
                            {{ $user->is_admin ? 'remove admin' : 'make admin' }}
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
