@extends('layouts.admin')

@section('title', 'contact message')

@section('content')
    <div class="mx-auto max-w-2xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <a href="{{ route('admin.contacts.index') }}" class="text-sm text-slate-600 hover:underline">← back</a>

        <h1 class="mt-3 text-2xl font-semibold">{{ $message->subject }}</h1>

        <div class="mt-4 space-y-2 text-sm text-slate-700">
            <p><strong>from:</strong> {{ $message->name }} ({{ $message->email }})</p>
            <p><strong>date:</strong> {{ $message->created_at->format('Y-m-d H:i') }}</p>
        </div>

        <div class="mt-6 rounded-xl border border-slate-200 bg-slate-50 p-4 text-sm text-slate-800 whitespace-pre-line">
            {{ $message->message }}
        </div>
    </div>
@endsection
