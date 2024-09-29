@extends('layout.master')

@section('content')
    <div class="container mt-5">
        <h1>Welcome to the Dashboard</h1>
        <p>This is the main content area.</p>
        <form action="{{ route('logout') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
@endsection