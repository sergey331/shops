{!!
    /**
     * @var \App\Models\Option[] $options
     */
!!}

<div>
    <h1>Options</h1>

    <div class="category-header">
        <a href="/admin/option/create" class="btn btn-add">Add New Option</a>
    </div>
    <div class="category-table">
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Value</th>
                <th>Price</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($options as $option)
            <tr>
                <td>{{ $option->id }}</td>
                <td>{{ $option->variant_name }}</td>
                <td>{{ $option->value }}</td>
                <td>{{ $option->price }}</td>

                <td>
                    <a href="/admin/option/{{ $option->id }}" class="btn btn-sm btn-edit">Edit</a>
                    <a href="/admin/option/delete/{{ $option->id }}" class="btn btn-sm btn-delete">Delete</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>