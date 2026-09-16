@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div>
        <h2 class="page-title">Dashboard</h2>
        <p class="text-muted mb-0">Real-time hardware inventory overview.</p>
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Add Product
    </a>
</div>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div><span>Total Products</span><h3>{{ $totalProducts }}</h3></div>
            <i class="bi bi-box-seam stat-icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card warning">
            <div><span>Low Stock</span><h3>{{ $lowStock }}</h3></div>
            <i class="bi bi-exclamation-triangle stat-icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card danger">
            <div><span>Out of Stock</span><h3>{{ $outOfStock }}</h3></div>
            <i class="bi bi-x-circle stat-icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div><span>Inventory Value</span><h3>₱{{ number_format($inventoryValue, 2) }}</h3></div>
            <i class="bi bi-cash-stack stat-icon"></i>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <strong>Recent Products</strong>
        <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
    </div>
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead><tr><th>Product</th><th>SKU</th><th>Category</th><th>Qty</th><th>Status</th></tr></thead>
            <tbody>
            @forelse($recentProducts as $product)
                <tr>
                    <td><strong>{{ $product->name }}</strong></td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        @if($product->isOutOfStock())
                            <span class="badge bg-danger">Out of Stock</span>
                        @elseif($product->isLowStock())
                            <span class="badge bg-warning text-dark">Low Stock</span>
                        @else
                            <span class="badge bg-success">In Stock</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-4">No products found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
