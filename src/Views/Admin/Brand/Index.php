{!!
    /**
     * @var \App\Models\Brand[] $brands
     */
!!}

<div>
    <h1>Brands</h1>

    <div class="category-header">
        <a href="/admin/brand/create" class="btn btn-add">Add New Brand</a>
    </div>
    <div class="category-table">
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Image</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($brands as $brand)
            <tr>
                <td>{{ $brand->id }}</td>
                <td>{{ $brand->name }}</td>
                <td>
                    @if ($brand->image_url)
                    <img src="/uploads/brands/{{ $brand->image_url }}" alt="News Image" style="width: 50px; height: 50px;">
                    @else
                    No Image
                    @endif
                </td>
                <td>
                    <a href="/admin/brand/{{ $brand->id }}" class="btn btn-sm btn-edit">Edit</a>
                    <a href="/admin/brand/delete/{{ $brand->id }}" class="btn btn-sm btn-delete">Delete</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>