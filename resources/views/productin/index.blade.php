@extends('layouts.app1')

@section('content')
<div class="container">
    <h2 class="my-4">Product In Records</h2>

    <a href="{{ route('productin.create') }}" class="btn btn-primary mb-3">Add New Product In Entry</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Date</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
                <th colspan="2" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productIns as $productIn)
                <tr>
                    <td>{{ $productIn->id }}</td>
                    <td>{{ $productIn->product?->PName ?? 'No Product Name' }}</td>
                    <td>{{ $productIn->prIn_Date }}</td>
                    <td>{{ $productIn->prIn_Quantity }}</td>
                    <td>{{ $productIn->prIn_Unit_Price }}</td>
                    <td>{{ $productIn->prIn_TotalPrice }}</td>
                    <td class="text-center">
                        <a href="{{ route('productin.edit', ['productin' => $productIn->id]) }}" class="btn btn-warning btn-sm">Edit</a>

                    </td>
                    <td class="text-center">
                        <form action="{{ route('productin.destroy', $productIn->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; {{ date('Y') }} Designed by Niyonkuru Wilson. All Rights Reserved.</p>
    </footer>
</div>
@endsection
