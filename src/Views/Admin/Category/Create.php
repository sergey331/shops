{!! $errors = $session->getCLean('errors') ?? []; !!}
<div class="form-wrapper">
    <h2>Create New Category</h2>

    <form action="/admin/categories/store" method="POST" enctype="multipart/form-data" class="form-grid">
        <div class="form-row">
            <label for="name">Category Name</label>
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
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="3" placeholder="Short description..."></textarea>
            @isset($errors['description'])
                <ul class="errors">
                    @foreach ($errors['description'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endisset
        </div>

        <div class="form-row">
            <label for="avatar">Avatar Image</label>
            <input type="file" name="avatar" id="avatar" accept="image/*">
            @isset($errors['avatar'])
                <ul class="errors">
                    @foreach ($errors['avatar'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endisset
        </div>

        <div class="form-row">
            <label for="category_id">Parent Category</label>
            <select name="category_id" id="category_id">
                <option value="">-- None --</option>
                @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
            @isset($errors['category_id'])
                <ul class="errors">
                    @foreach ($errors['category_id'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endisset
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-add btn-sm">Create Category</button>
        </div>
    </form>
</div>
