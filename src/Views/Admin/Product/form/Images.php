{!! $errors = $session->getCLean('errors') ?? []; !!}
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
    <label for="images">Images</label>
    <input type="file" name="images[]" multiple id="images" accept="image/*">
    @isset($errors['images'])
    <ul class="errors">
        @foreach ($errors['images'] as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endisset
</div>