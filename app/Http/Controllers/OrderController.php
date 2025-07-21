<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Order_Item;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //fetches all orders with customer info
    public function index()
    {
        return Order::with('customer')->get();
    }

    //creating new order
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'ticket_number' => 'required|unique:orders,ticket_number',
            'order_type' => 'required|in:normal,urgent',
            'total_price' => 'required|numeric|min:0',
            'pickup_datetime' => 'nullable|date',
            'status' => 'nullable|in:received,washing,drying,steaming,packaging,ready',
        ]);

        $order = Order::create($validated);
        return response()->json($order, 201);
    }

    //returns details of specific order by id
    public function show($id)
    {
        return Order::with('customer')->findOrFail($id);
    }

    //updating the order
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'order_type' => 'sometimes|in:normal,urgent',
            'total_price' => 'sometimes|numeric|min:0',
            'pickup_datetime' => 'nullable|date',
            'status' => 'sometimes|in:received,washing,drying,steaming,packaging,ready',
        ]);

        $order->update($validated);
        return response()->json($order);
    }

    //deleting the order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully']);
    }

    //get all items of the order
    public function items($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return response()->json($order->items);
    }
}
