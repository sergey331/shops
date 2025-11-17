{!! $errors = $session->getCLean('errors') ?? []; !!}

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create New Category</h4>

        <form action="/admin/categories/store" method="POST" enctype="multipart/form-data" class="forms-sample">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control"  name="name" id="name"   />
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
                <textarea  class="form-control" name="description" id="description" rows="3" ></textarea>
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
                <input type="file" class="form-control"  name="logo" id="logo" accept="image/*">
                @isset($errors['logo'])
                <ul class="errors">
                    @foreach ($errors['logo'] as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endisset
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-inverse-primary me-2">Create Category</button>
            </div>
        </form>
    </div>
</div>
