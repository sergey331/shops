{!! $errors = $session->getCLean('errors') ?? []; !!}
<div class="form-wrapper">
    <h2>Edit Product</h2>

    <form action="/admin/products/{{$product->id}}" method="POST" enctype="multipart/form-data" class="form-grid">
        <div class="form-row">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name"  placeholder="e.g. Electronics" value="{{$product->name}}">
            @isset($errors['name'])
                <ul class="errors">
                    @foreach ($errors['name'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endisset
        </div>

        <div class="form-row">
            <label for="price">Price</label>
            <input type="text" name="price" id="price"  placeholder="e.g. 200" value="{{$product->price}}">
            @isset($errors['price'])
                <ul class="errors">
                    @foreach ($errors['price'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endisset
        </div>
    
        <div class="form-row">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="3" placeholder="Short description...">{{$product->description}}</textarea>
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
                <option value="{{ $cat->id }}" @if($cat->id === $product->category_id) selected @endauth>{{ $cat->name }}</option>
                @endforeach
            </select>
            @isset($errors['category_id'])
                <ul class="errors">
                    @foreach ($errors['category_id'] as $error)
                        <li >{{ $error }}</li>
                    @endforeach
                </ul>
            @endisset
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-add btn-sm">Update Product</button>
        </div>
    </form>
</div>
