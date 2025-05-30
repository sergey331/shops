{!!
    /**
     * @var \App\Models\News[] $categories
     */
!!}

<div class="container">
    <h1>News</h1>

    <div class="category-header">
        <a href="/admin/news/create" class="btn btn-add">Add New</a>
    </div>
    <div class="category-table">
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Content</th>
                <th>Is Published</th>
                <th>Published</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($news as $new)
            <tr>
                <td>{{ $new->id }}</td>
                <td>{{ $new->title }}</td>
                <td>{{ $new->slug }}</td>
                <td>{{ $new->content }}</td>
                <td>
                    @if ($new->is_published)
                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Yes</span>
                    @else
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300">No</span>
                    @endif
                </td>
                <td>{{ $new->published_at }}</td>
                <td>
                    @if ($new->image_url)
                        <img src="/uploads/news/{{ $new->image_url }}" alt="News Image" style="width: 50px; height: 50px;">
                    @else
                        No Image
                    @endif
                <td>
                    <a href="/admin/news/{{ $new->id }}" class="btn btn-sm btn-edit">Edit</a>
                    <a href="/admin/news/delete/{{ $new->id }}" class="btn btn-sm btn-delete">Delete</a>
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