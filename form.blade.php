@csrf
<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Product Name</label>
        <input name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">SKU</label>
        <input name="sku" class="form-control" value="{{ old('sku', $product->sku ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Category</label>
        <select name="category" class="form-select" required>
            <option value="">Select category</option>
            @foreach(['Lumber','Hardware','Tools','Electrical','Plumbing','Paint'] as $category)
                <option value="{{ $category }}" @selected(old('category', $product->category ?? '') === $category)>{{ $category }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Supplier</label>
        <input name="supplier" class="form-control" value="{{ old('supplier', $product->supplier ?? '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Quantity</label>
        <input type="number" min="0" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity ?? 0) }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Reorder Level</label>
        <input type="number" min="0" name="reorder_level" class="form-control" value="{{ old('reorder_level', $product->reorder_level ?? 5) }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Unit Price</label>
        <input type="number" min="0" step="0.01" name="unit_price" class="form-control" value="{{ old('unit_price', $product->unit_price ?? 0) }}" required>
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" rows="4" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
    </div>
</div>
