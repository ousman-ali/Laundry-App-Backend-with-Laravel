<?php

namespace App\Http\Controllers;
use App\Models\Order_Item;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    //get all order-items
    public function index()
    {
        return Order_Item::with('order')->get();
    }

    //create new item under a specific order
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'item_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $validated['total_price'] = $validated['quantity'] * $validated['unit_price'];

        $item = Order_Item::create($validated);

        return response()->json($item, 201);
    }

    //get details of single order-item by id
    public function show($id)
    {
        return Order_Item::with('order')->findOrFail($id);
    }

    //update an existing order-item by id
    public function update(Request $request, $id)
    {
        $item = Order_Item::findOrFail($id);

        $validated = $request->validate([
            'item_name' => 'sometimes|string',
            'quantity' => 'sometimes|integer|min:1',
            'unit_price' => 'sometimes|numeric|min:0',
        ]);

        if (isset($validated['quantity']) || isset($validated['unit_price'])) {
            $quantity = $validated['quantity'] ?? $item->quantity;
            $unit_price = $validated['unit_price'] ?? $item->unit_price;
            $validated['total_price'] = $quantity * $unit_price;
        }

        $item->update($validated);

        return response()->json($item);
    }

    //finds order-item by id and delete it
    public function destroy($id)
    {
        $item = Order_Item::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Order item deleted']);
    }
}
