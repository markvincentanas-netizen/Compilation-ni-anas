@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products</h1>


    <form method="GET" class="search-form">
        <input type="text" name="search" placeholder="Search..." value="{{ $search }}">
        <button type="submit">Search</button>
    </form>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groceries as $item)
            <tr>
                <td>
                    @if($item->image)
                    <img src="{{ asset('storage/'.$item->image) }}" class="product-img">
                    @endif
                </td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price }}</td>
                <td>
                    <a href="{{ route('groceries.show',$item->id) }}" class="btn small">View</a>
                    <a href="{{ route('groceries.edit',$item->id) }}" class="btn small edit">Edit</a>
                    <form action="{{ route('groceries.destroy',$item->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn small delete">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $groceries->links() }}
</div>
@endsection