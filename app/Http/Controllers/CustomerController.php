<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //get all customers
    public function index()
    {
        return Customer::all();
    }

    //create new customer
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|unique:customers,phone',
            'address' => 'nullable|string',
        ]);

        $customer = Customer::create($validated);
        return response()->json($customer, 201);
    }

    //get a customer by id
    public function show($id)
    {
        return Customer::findOrFail($id);
    }

    //update a customer by id
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->only(['name', 'phone', 'address']));
        return response()->json($customer);
    }

    //delete a customer by id
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json(['message' => 'Customer deleted']);
    }

    //get all orders of a customer
    public function orders($id)
    {
        $customer = Customer::with('orders')->findOrFail($id);
        return response()->json($customer->orders);
    }
}
