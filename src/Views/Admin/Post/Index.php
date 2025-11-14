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
                <th>#</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Category</th>
                <th>Tags</th>
                <th>Status</th>
               <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->slug}}</td>
                <td>{{$post->category->name}}</td>
                <td>
                    {!! $tag = '' !!}
                    @foreach($post->tags as $t)
                        {!! $tag .= '<b> ' . $t->name .'</b>,' !!}
                    @endforeach
                    {!! $tag = trim($tag,',') !!}
                    {{ $tag }}
                </td>
                <td>{{ ucfirst($post->status) }}</td>
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