<x-app-layout>
    <x-slot name="header">
       <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
            </h2>
            <a href="{{ route('users.add') }}" class="text-white font-bold py-2 px-4 box-border bg-gray-800 rounded-md border border-gray-700 p-4">
            Add New User
            </a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('users.index') }}" method="GET" class="form-inline rounded-md py-4 flex items-center">
                <input type="text" name="search" class="form-control mr-2 rounded-md border-gray-300 px-4" placeholder="Search users" value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-primary rounded-md bg-gray-800 text-white px-4 py-2">Search</button>
            </form>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200 w-full border border-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Email</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Role</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if($users->count())
                                @foreach ($users as $user)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $user->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $user->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $user->email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $user->role->role_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center border border-gray-300">
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning mr-2 bg-gray-400 rounded border px-2 py-2">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                            @else
                                <tr>
                                    <td colspan="12" class="px-6 py-4 whitespace-nowrap border border-gray-300 text-center">No users found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>