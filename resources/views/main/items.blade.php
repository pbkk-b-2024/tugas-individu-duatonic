<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Items') }}
            </h2>
            @can('isAdmin', App\Models\User::class)
            <a href="{{ route('items.add') }}" class="text-white font-bold py-2 px-4 box-border bg-gray-800 rounded border border-gray-700 p-4">
                Add New Item
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200 w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                @can('isAdmin', App\Models\User::class)
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">ID</th>
                                @endcan
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Category</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Quantity</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Price</th>
                                @can('isAdmin', App\Models\User::class)
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Actions</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($items as $item)
                                <tr>
                                    @can('isAdmin', App\Models\User::class)
                                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $item->item_id }}</td>
                                    @endcan
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $item->item_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $item->item_category }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $item->item_quantity }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">Rp{{ $item->item_price }}</td>
                                    @can('isAdmin', App\Models\User::class)
                                        <td class="px-6 py-4 whitespace-nowrap text-center border border-gray-300">
                                            <a href="{{ route('items.edit', $item->item_id) }}" class="btn btn-sm btn-warning mr-2 bg-gray-400 rounded border px-2 py-2">
                                                Edit
                                            </a>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>