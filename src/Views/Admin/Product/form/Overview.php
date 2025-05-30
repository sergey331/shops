{!!
$errors = $session->getCLean('errors') ?? [];
    $name = $product->name ?? '';
    $price = $product->price ?? '';
    $sku = $product->sku ?? '';
    $quantity = $product->quantity ?? '';
    $status = $product->status ?? '';
    $category_id = $product->category_id ?? '';
    $brand_id = $product->brand_id ?? '';
    $description = $product->description ?? '';
    $featured = $product->featured ?? false;

!!}
<div class="form-row">
    <label for="name">Product Name</label>
    <input type="text" name="name" id="name" value="{{ $name }}" >
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
    <input type="text" name="price" id="price" value="{{ $price }}" >
    @isset($errors['price'])
    <ul class="errors">
        @foreach ($errors['price'] as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endisset
</div>

<div class="form-row">
    <label for="sku">Sku</label>
    <input type="text" name="sku" id="sku" value="{{ $sku }}" >
    @isset($errors['sku'])
    <ul class="errors">
        @foreach ($errors['sku'] as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endisset
</div>
<div class="form-row">
    <label for="quantity">Quantity</label>
    <input type="number" name="quantity" id="sku" value="{{ $quantity }}" >
    @isset($errors['quantity'])
    <ul class="errors">
        @foreach ($errors['quantity'] as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endisset
</div>

<div class="form-row">
    <label for="featured">Featured</label>
    <input type="checkbox" name="featured" id="featured" {{ $featured  ? 'checked' : '' }} value="1" >
    @isset($errors['quantity'])
    <ul class="errors">
        @foreach ($errors['quantity'] as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endisset
</div>

<div class="form-row">
    <label for="description">Description</label>
    <textarea name="description" id="description" rows="3" placeholder="Short description...">{{ $description }}</textarea>
    @isset($errors['description'])
    <ul class="errors">
        @foreach ($errors['description'] as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endisset
</div>

<div class="form-row">
    <label for="status">Status</label>
    <select name="status" id="status">
        <option value="">-- None --</option>
        @foreach ($statuses as $s)
        <option value="{{ $s }}" @if($s === $status) selected @endif  >{{ $s }}</option>
        @endforeach
    </select>

    @isset($errors['status'])
    <ul class="errors">
        @foreach ($errors['status'] as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endisset
</div>

<div class="form-row">
    <label for="category_id">Category</label>
    <select name="category_id" id="category_id">
        <option value="">-- None --</option>
        @foreach ($categories as $cat)
        <option value="{{ $cat->id }}" @if($category_id === $cat->id ) selected @endif >{{ $cat->name }}</option>
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

<div class="form-row">
    <label for="brand_id">Brand</label>
    <select name="brand_id" id="brand_id">
        <option value="">-- None --</option>
        @foreach ($brands as $brand)
        <option value="{{ $brand->id }}" @if($brand_id === $brand->id ) selected @endif >{{ $brand->name }}</option>
        @endforeach
    </select>
    @isset($errors['brand_id'])
    <ul class="errors">
        @foreach ($errors['brand_id'] as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endisset
</div>