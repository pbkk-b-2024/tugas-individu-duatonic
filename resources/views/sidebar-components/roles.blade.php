@extends('layout.master')

@section('content')
    <div class="container mt-4">
        <h1>Roles</h1>
            
        <div class="d-flex justify-content-between mb-4">
            <!-- Search Form -->
            <form action="{{ route('roles') }}" method="GET" class="form-inline">
                <input type="text" name="search" class="form-control mr-2" placeholder="Search roles" value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            <!-- Add Role Button -->
            <a href="{{ route('roles.add') }}" class="btn btn-success btn-lg">
                Add Role
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center" style="width: 5%;">ID</th>
                        <th scope="col" class="text-center" style="width: 20%;">Name</th>
                        <th scope="col" class="text-center" style="width: 35%;">Description</th>
                        <th scope="col" class="text-center" style="width: 15%;">Actions</th>
                    </tr>
                </thead>

                @if($data['roles']->count())
                    <tbody>
                        @foreach($data['roles'] as $role)
                            <tr>
                                <td class="text-center">{{ $role->role_id }}</td>
                                <td>{{ $role->role_name }}</td>
                                <td>{{ $role->role_description }}</td>
                                <td class="text-center">
                                    <!-- Edit Button -->
                                    <a href="{{ route('roles.edit', $role->role_id) }}" class="btn btn-sm btn-warning mr-2">
                                        Edit
                                    </a>
                                    <!-- Delete Button -->
                                    <form action="{{ route('roles.destroy', $role->role_id) }}" method="POST" style="display:inline;">
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
                            <td colspan="4" class="text-center">No roles found.</td>
                        </tr>
                    </tbody>
                @endif
            </table>
            <div class="d-flex justify-content-center">
                {{ $data['roles']->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection