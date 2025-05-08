@extends('layouts.app1')

@section('content')
    <div class="container">
        <h2 class="mb-4">Add Product In Entry</h2>

        <form method="POST" action="{{ route('productin.store') }}">
            @csrf

            <!-- Product Selection -->
            <div class="mb-3">
                <label for="PCode" class="form-label">Product</label>
                <select name="PCode" class="form-select" required>
                    <option value="">-- Select Product --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->PCode }}">{{ $product->PName }}</option>
                    @endforeach
                </select>
                @error('PCode')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Date -->
            <div class="mb-3">
                <label for="prIn_Date" class="form-label">Date</label>
                <input type="date" name="prIn_Date" class="form-control" required>
                @error('prIn_Date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Quantity -->
            <div class="mb-3">
                <label for="prIn_Quantity" class="form-label">Quantity</label>
                <input type="number" name="prIn_Quantity" class="form-control" required>
                @error('prIn_Quantity')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Unit Price -->
            <div class="mb-3">
                <label for="prIn_Unit_Price" class="form-label">Unit Price</label>
                <input type="number" name="prIn_Unit_Price" step="0.01" class="form-control" required>
                @error('prIn_Unit_Price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
