<?php

// app/Http/Controllers/ProductInController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductIn;
use Illuminate\Http\Request;

class ProductInController extends Controller
{
    // Display a listing of the ProductIn records
    public function index()
    {
        // Fetch all ProductIn records with related Product data
        $productIns = ProductIn::with('product')->get();

        // Return the index view with the productIn data
        return view('productin.index', compact('productIns'));
    }

    // Show the form for creating a new ProductIn record
    public function create()
    {
        // Fetch all products for the dropdown
        $products = Product::all();

        // Return the create view with the products data
        return view('productin.create', compact('products'));
    }

    // Store a newly created ProductIn record in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'PCode' => 'required|string|exists:products,PCode',
            'prIn_Date' => 'required|date',
            'prIn_Quantity' => 'required|integer|min:1',
            'prIn_Unit_Price' => 'required|numeric|min:0',
        ]);

        // Calculate the total price
        $totalPrice = $request->prIn_Quantity * $request->prIn_Unit_Price;

        // Create the ProductIn record
        ProductIn::create([
            'PCode' => $request->PCode,
            'prIn_Date' => $request->prIn_Date,
            'prIn_Quantity' => $request->prIn_Quantity,
            'prIn_Unit_Price' => $request->prIn_Unit_Price,
            'prIn_TotalPrice' => $totalPrice,
        ]);

        // Redirect to the index with a success message
        return redirect()->route('productin.index')->with('success', 'Product In added successfully.');
    }

    // Display the specified ProductIn record
    public function show($id)
    {
        $productIn = ProductIn::with('product')->findOrFail($id);
        return view('productin.show', compact('productIn'));
    }

    // Show the form for editing the specified ProductIn record
    public function edit($id)
    {
        $productIn = ProductIn::findOrFail($id);
        $products = Product::all();
        return view('productin.edit', compact('productIn', 'products'));
    }

    // Update the specified ProductIn record in the database
    // Update the specified ProductIn record in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'PCode' => 'required|string|exists:products,PCode',
            'prIn_Date' => 'required|date',
            'prIn_Quantity' => 'required|integer|min:1',
            'prIn_Unit_Price' => 'required|numeric|min:0',
        ]);

        // Calculate the total price
        $totalPrice = $request->prIn_Quantity * $request->prIn_Unit_Price;

        // Find the ProductIn record by its primary key
        $productIn = ProductIn::findOrFail($id);
        $productIn->update([
            'PCode' => $request->PCode,
            'prIn_Date' => $request->prIn_Date,
            'prIn_Quantity' => $request->prIn_Quantity,
            'prIn_Unit_Price' => $request->prIn_Unit_Price,
            'prIn_TotalPrice' => $totalPrice,
        ]);

        return redirect()->route('productin.index')->with('success', 'Product In updated successfully.');
    }

    // Remove the specified ProductIn record from the database
    public function destroy($id)
    {
        $productIn = ProductIn::findOrFail($id);
        $productIn->delete();

        return redirect()->route('productin.index')->with('success', 'Product In deleted successfully.');
    }
}
