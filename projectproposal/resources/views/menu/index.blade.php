<x-guest-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center mb-8">🍽️ OnlineCanteen Menu</h1>

        @foreach($categories as $category)
            <div class="mb-12">
                <h2 class="text-2xl font-semibold mb-4 border-b pb-2">{{ $category->name }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($category->menuItems as $item)
                        <div class="bg-white rounded-2xl shadow p-4 flex flex-col">
                            <img src="{{ $item->image ?? 'https://picsum.photos/300/200' }}" 
                                 class="w-full h-40 object-cover rounded-xl mb-4">
                            <h3 class="font-semibold text-lg">{{ $item->name }}</h3>
                            <p class="text-sm text-gray-500 flex-1">{{ $item->description }}</p>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-2xl font-bold">₱{{ number_format($item->price, 2) }}</span>
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="submit" 
                                            class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <a href="{{ route('cart') }}" 
       class="fixed bottom-8 right-8 bg-green-600 text-white px-8 py-4 rounded-3xl shadow-2xl flex items-center gap-3 text-lg font-medium hover:bg-green-700">
        🛒 Cart 
        <span class="bg-white text-green-600 rounded-full w-7 h-7 flex items-center justify-center">
            {{ count(session('cart', [])) }}
        </span>
    </a>
</x-guest-layout>