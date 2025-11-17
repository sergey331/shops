{!! $errors = $session->getCLean('errors') ?? []; !!}

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Category</h4>

        <form action="/admin/categories/{{ $category->id}}" method="POST" enctype="multipart/form-data" class="forms-sample">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name"  value="{{ $category->name }}" />
                @isset($errors['name'])
                <ul class="errors">
                    @foreach ($errors['name'] as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endisset
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" rows="3" >{{ $category->description }}</textarea>
                @isset($errors['description'])
                <ul class="errors">
                    @foreach ($errors['description'] as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endisset
            </div>
            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" class="form-control" name="logo" id="logo" accept="image/*">
                @isset($errors['logo'])
                <ul class="errors">
                    @foreach ($errors['logo'] as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endisset
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-inverse-primary me-2">Update</button>
            </div>
        </form>
    </div>
</div>
<div class="form-wrapper">
    <h2></h2>



</div>
