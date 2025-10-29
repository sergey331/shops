{!! $errors = $session->getCLean('errors') ?? []; !!}
<div class="form-wrapper">
    <h2>Create New Slide</h2>

    <form action="/admin/sliders/store" method="POST" enctype="multipart/form-data" class="form-grid">
        <div class="form-row">
            <label for="title">Title</label>
            <input type="text" name="title" id="title"   />
            @isset($errors['title'])
                <ul class="errors">
                    @foreach ($errors['title'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endisset
        </div>
    
        <div class="form-row">
            <label for="content">Content</label>
            <textarea name="content" id="content" rows="3" ></textarea>
            @isset($errors['content'])
                <ul class="errors">
                    @foreach ($errors['content'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endisset
        </div>
        <div class="form-row">
            <label for="product_id">Product</label>
            <select name="product_id" id="product_id">
                <option value="">-- None --</option>
                @foreach ($products as $product)
                <option value="{{ $product->id }}" >{{ $product->name }}</option>
                @endforeach
            </select>

            @isset($errors['product_id'])
            <ul class="errors">
                @foreach ($errors['product_id'] as $error)
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
        <div class="form-row">
            <label for="is_show">Show</label>
            <input type="checkbox" name="is_show" id="is_show"  value="1" >
            @isset($errors['is_show'])
            <ul class="errors">
                @foreach ($errors['is_show'] as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endisset
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-add btn-sm">Create Slide</button>
        </div>
    </form>
</div>
