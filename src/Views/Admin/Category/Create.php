<div class="form-wrapper">
    <h2>Create New Category</h2>

    <form action="/admin/category/store" method="POST" enctype="multipart/form-data" class="form-grid">
        <div class="form-row">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" required placeholder="e.g. Electronics">
        </div>

        <div class="form-row">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="3" placeholder="Short description..."></textarea>
        </div>

        <div class="form-row">
            <label for="avatar">Avatar Image</label>
            <input type="file" name="avatar" id="avatar" accept="image/*">
        </div>

        <div class="form-row">
            <label for="category_id">Parent Category</label>
            <select name="category_id" id="category_id">
                <option value="">-- None --</option>
                @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Create Category</button>
        </div>
    </form>
</div>
