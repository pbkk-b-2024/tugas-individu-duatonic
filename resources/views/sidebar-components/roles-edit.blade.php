<!-- resources/views/roles/edit.blade.php -->

@extends('layout.master')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Edit Role</h1>

        <form action="{{ route('roles.update', $role->role_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $role->role_name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="desc" name="desc" rows="3" required>{{ $role->role_description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Role</button>
        </form>
    </div>
@endsection