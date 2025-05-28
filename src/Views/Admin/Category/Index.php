{!!
    /**
     * @var \App\Models\Category[] $categories
     */
!!}

<div class="container">
    <h1>Categories</h1>

    <div class="category-header">
        <a href="/admin/categories/create" class="btn btn-add">Add New Category</a>
    </div>
    <div class="category-table">
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Children</th>
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
                    <button onclick="toggleChildren('{{ $category->id }}')" class="btn btn-sm btn-toggle">
                        Show Children
                    </button>
                </td>
                <td>
                    <a href="/admin/categories/{{ $category->id }}" class="btn btn-sm btn-edit">Edit</a>
                    <a href="/admin/categories/delete/{{ $category->id }}" class="btn btn-sm btn-delete">Delete</a>
                </td>
            </tr>
            <tr id="children-{{ $category->id }}" class="children-row" style="display: none;">
                <td colspan="5">
                    <table width="100%" cellpadding="5">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($category->childrens as $child)
                        <tr>
                            <td>{{ $child->id }}</td>
                            <td>{{ $child->name }}</td>
                            <td>{{ $child->description }}</td>
                            <td>
                                <a href="/admin/category/{{ $child->id }}" class="btn btn-sm btn-edit">Edit</a>
                                <a href="/admin/category/delete/{{ $child->id }}"
                                   class="btn btn-sm btn-delete">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function toggleChildren(id) {
        console.log(id);
        const row = document.getElementById('children-' + id);
        row.style.display = row.style.display === 'none' ? 'table-row' : 'none';
    }
</script>