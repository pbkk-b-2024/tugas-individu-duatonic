<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
            </h2>
            <a href="{{ route('roles.add') }}" class="text-white font-bold py-2 px-4 box-border bg-gray-800 rounded border border-gray-700 p-4">
            Add New Role
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200 w-full border border-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Description</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $role->role_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $role->role_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $role->role_description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center border border-gray-300">
                                        <a href="{{ route('roles.edit', $role->role_id) }}" class="btn btn-sm btn-warning mr-2 bg-gray-400 rounded border px-2 py-2">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>