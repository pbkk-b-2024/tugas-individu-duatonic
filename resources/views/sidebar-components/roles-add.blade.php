<!-- resources/views/roles/add.blade.php -->

@extends('layout.master')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Add New Role</h1>

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Add Role</button>
        </form>
    </div>
@endsection