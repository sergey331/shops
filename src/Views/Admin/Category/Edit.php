{!! $errors = $session->getCLean('errors') ?? []; !!}
<div class="form-wrapper">
    <h2>Edit Slide</h2>

    <form action="/admin/categories/{{ $category->id}}" method="POST" enctype="multipart/form-data" class="form-grid">
        <div class="form-row">
            <label for="name">Name</label>
            <input type="text" name="name" id="name"  value="{{ $category->name }}" />
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
            <textarea name="description" id="description" rows="3" >{{ $category->description }}</textarea>
            @isset($errors['description'])
            <ul class="errors">
                @foreach ($errors['description'] as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endisset
        </div>
        <div class="form-row">
            <label for="logo">Logo</label>
            <input type="file" name="logo" id="logo" accept="image/*">
            @isset($errors['logo'])
            <ul class="errors">
                @foreach ($errors['logo'] as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endisset
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-add btn-sm">Update</button>
        </div>
    </form>

</div>
