@extends('layout.master')

@section('content')
    <div class="container mt-4">
        <h1>Items</h1>
            
        <div class="d-flex justify-content-between mb-4">
            <!-- Search Form -->
            <form action="{{ route('items') }}" method="GET" class="form-inline">
                <input type="text" name="search" class="form-control mr-2" placeholder="Search items" value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            <!-- Add Item Button -->
            <a href="{{ route('items.add') }}" class="btn btn-success btn-lg">
                Add Item
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center" style="width: 5%;">ID</th>
                        <th scope="col" class="text-center" style="width: 35%;">Name</th>
                        <th scope="col" class="text-center" style="width: 20%;">Price</th>
                        <th scope="col" class="text-center" style="width: 15%;">Quantity</th>
                        <th scope="col" class="text-center" style="width: 15%;">Actions</th>
                    </tr>
                </thead>

                @if($data['items']->count())
                    <tbody>
                        @foreach($data['items'] as $item)
                            <tr>
                                <td class="text-center">{{ $item->item_id }}</td>
                                <td>{{ $item->item_name }}</td>
                                <td class="text-right">Rp{{ number_format($item->item_price, 2) }}</td>
                                <td class="text-center">{{ $item->item_quantity }}</td>
                                <td class="text-center">
                                    <!-- Edit Button -->
                                    <a href="{{ route('items.edit', $item->item_id) }}" class="btn btn-sm btn-warning mr-2">
                                        Edit
                                    </a>
                                    <!-- Delete Button -->
                                    <form action="{{ route('items.destroy', $item->item_id) }}" method="POST" style="display:inline;">
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
                            <td colspan="5" class="text-center">No items found.</td>
                        </tr>
                    </tbody>
                @endif
            </table>
            <div class="d-flex justify-content-center">
                {{ $data['items']->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection