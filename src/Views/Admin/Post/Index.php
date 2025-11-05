{!!
    /**
     * @var \App\Models\Post[] $posts
     */
!!}

<div>
    <h1>Posts</h1>

    <div class="category-header">
        <a href="/admin/posts/create" class="btn btn-add">Add New</a>
    </div>
    <div class="category-table">
        <table>
            <thead>
            <tr>
               <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($posts as $post)
            <tr>

                <td>
                    <a href="/admin/posts/{{ $post->id }}" class="btn btn-sm btn-edit">Edit</a>
                    <a href="/admin/posts/delete/{{ $post->id }}" class="btn btn-sm btn-delete">Delete</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>