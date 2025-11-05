{!! $errors = $session->getCLean('errors') ?? []; !!}
<div class="form-wrapper">
    <h2>Edit Post</h2>

    <form action="/admin/posts/{{ $post->id}}" method="POST" enctype="multipart/form-data" class="form-grid">


        <div class="form-actions">
            <button type="submit" class="btn btn-add btn-sm">Update</button>
        </div>
    </form>

</div>
