<?php

namespace App\Http\Controllers;

use App\Models\InventoryTransaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryTransactionController extends Controller
{
    public function index()
    {
        $transactions = InventoryTransaction::with(['product', 'user'])
            ->latest()
            ->paginate(12);

        return view('transactions.index', compact('transactions'));
    }

    public function create(string $type)
    {
        abort_unless(in_array($type, ['in', 'out']), 404);

        $products = Product::orderBy('name')->get();

        return view('transactions.create', compact('type', 'products'));
    }

    public function store(Request $request, string $type)
    {
        abort_unless(in_array($type, ['in', 'out']), 404);

        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'reference_document' => ['nullable', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($data, $type) {
            $product = Product::lockForUpdate()->findOrFail($data['product_id']);

            if ($type === 'out' && $data['quantity'] > $product->quantity) {
                abort(422, 'Stock Out quantity cannot be greater than available stock.');
            }

            $newQuantity = $type === 'in'
                ? $product->quantity + $data['quantity']
                : $product->quantity - $data['quantity'];

            $product->update(['quantity' => $newQuantity]);

            InventoryTransaction::create([
                'product_id' => $product->id,
                'type' => $type,
                'quantity' => $data['quantity'],
                'reference_document' => $data['reference_document'] ?? null,
                'user_id' => auth()->id(),
            ]);
        });

        return redirect()->route('transactions.index')
            ->with('success', 'Stock transaction recorded successfully.');
    }
}
