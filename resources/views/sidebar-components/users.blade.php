<!-- resources/views/users/index.blade.php -->

@extends('layout.master')

@section('content')
    <div class="container mt-4">
        <h1>Users</h1>
            
        <div class="d-flex justify-content-between mb-4">
            <!-- Search Form -->
            <form action="{{ route('users') }}" method="GET" class="form-inline">
                <input type="text" name="search" class="form-control mr-2" placeholder="Search users" value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            <!-- Add User Button -->
            <a href="{{ route('users.add') }}" class="btn btn-success btn-lg">
                Add User
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center" style="width: 5%;">ID</th>
                        <th scope="col" class="text-center" style="width: 25%;">Name</th>
                        <th scope="col" class="text-center" style="width: 25%;">Email</th>
                        <th scope="col" class="text-center" style="width: 15%;">Role ID</th>
                        <th scope="col" class="text-center" style="width: 15%;">Actions</th>
                    </tr>
                </thead>

                @if($data['users']->count())
                    <tbody>
                        @foreach($data['users'] as $user)
                            <tr>
                                <td class="text-center">{{ $user->user_id }}</td>
                                <td>{{ $user->user_name }}</td>
                                <td>{{ $user->user_email }}</td>
                                <td class="text-center">{{ $user->role_id }}</td>
                                <td class="text-center">
                                    <!-- Edit Button -->
                                    <a href="{{ route('users.edit', $user->user_id) }}" class="btn btn-sm btn-warning mr-2">
                                        Edit
                                    </a>
                                    <!-- Delete Button -->
                                    <form action="{{ route('users.destroy', $user->user_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center">No users found.</td>
                        </tr>
                    </tbody>
                @endif
            </table>
            <div class="d-flex justify-content-center">
                {{ $data['users']->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection