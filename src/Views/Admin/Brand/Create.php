{!! $errors = $session->getCLean('errors') ?? []; !!}
<div class="form-wrapper">
    <h2>Create New Brand</h2>

    <form action="/admin/brand/store" method="POST" enctype="multipart/form-data" class="form-grid">
        <div class="form-row">
            <label for="name">Name</label>
            <input type="text" name="name" id="name"  placeholder="e.g. Electronics">
            @isset($errors['name'])
                <ul class="errors">
                    @foreach ($errors['name'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endisset
        </div>

        <div class="form-row">
            <label for="image_url">Image</label>
            <input type="file" name="image_url" id="image_url" accept="image/*">
            @isset($errors['image_url'])
            <ul class="errors">
                @foreach ($errors['image_url'] as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endisset
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-add btn-sm">Create Brand</button>
        </div>
    </form>
</div>
