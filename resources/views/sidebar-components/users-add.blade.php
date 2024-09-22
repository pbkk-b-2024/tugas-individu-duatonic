<!-- resources/views/users/create.blade.php -->

@extends('layout.master')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Add New User</h1>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">User Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="role_id">Role ID</label>
                <input type="text" class="form-control" id="role_id" name="role_id" required>
            </div>

            <button type="submit" class="btn btn-success">Add User</button>
        </form>
    </div>
@endsection