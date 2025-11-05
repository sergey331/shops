{!! $errors = $session->getCLean('errors') ?? []; !!}
<div class="form-wrapper">
    <h2>Create New Post</h2>

    <form action="/admin/posts/store" method="POST" enctype="multipart/form-data" class="form-grid">

        <div class="form-actions">
            <button type="submit" class="btn btn-add btn-sm">Create Slide</button>
        </div>
    </form>
</div>
