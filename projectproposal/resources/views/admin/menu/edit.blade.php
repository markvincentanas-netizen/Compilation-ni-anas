@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Edit Menu Item</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.menu.update', $menuItem) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Item Name</label>
                            <input type="text" name="name" value="{{ old('name', $menuItem->name) }}" 
                                   class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Category</label>
                            <select name="category_id" class="form-select" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" 
                                        {{ old('category_id', $menuItem->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Price (₱)</label>
                            <input type="number" step="0.01" name="price" 
                                   value="{{ old('price', $menuItem->price) }}" 
                                   class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $menuItem->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Image URL</label>
                            <input type="text" name="image" 
                                   value="{{ old('image', $menuItem->image) }}" 
                                   class="form-control" placeholder="https://picsum.photos/...">
                        </div>

                        <!-- Fixed Available Checkbox -->
                        <div class="mb-4 form-check">
                            <input type="checkbox" 
                                   name="available" 
                                   class="form-check-input" 
                                   id="available"
                                   {{ old('available', $menuItem->available) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="available">
                                ✅ Item is Available
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-save"></i> Update Menu Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('admin.menu.index') }}" class="text-muted">← Back to Menu List</a>
            </div>
        </div>
    </div>
</div>
@endsection