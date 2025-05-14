<div class="container">
    <h1>Categories</h1>

    <div class="category-header">
        <a href="/admin/category/create" class="btn btn-add">Add New Category</a>
    </div>
    <div class="category-table">
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Childrens</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                    
                        
                            @foreach($category->childrens as $children)
                                {{ $children->name }}

                            @endforeach
                    </td>
                    <td>
                        <a href="/admin/category/{{ $category->id }}" class="btn btn-sm btn-edit">Edit</a>
                        <a href="/admin/category/delete/{{ $category->id }}" class="btn btn-sm btn-delete">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
