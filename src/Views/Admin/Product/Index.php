<div class="container">
    <h1>Products</h1>

    <div class="category-header">
        <a href="/admin/products/create" class="btn btn-add">Add New Product</a>
    </div>
    <div class="category-table">
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Sku</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Discount</th>
                <th>Category</th>
                <th>Status</th>
                <th>Featured</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->discount->discount_value ?? '' }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->status }}</td>
                    <td>
                        @if ($product->featured)
                        <span class="badge badge-success">Yes</span>
                        @else
                            <span class="badge badge-secondary">No</span>
                        @endif
                    <td>{{ $product->description }}</td>
                    <td>
                        <a href="/admin/products/{{ $product->id }}" class="btn btn-sm btn-edit">Edit</a>
                        <a href="/admin/products/delete/{{ $product->id }}" class="btn btn-sm btn-delete">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
