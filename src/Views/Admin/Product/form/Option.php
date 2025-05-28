{!!
$errors = $session->getCLean('errors') ?? [];
    $selectedOptions =  [];
    $productOptions = $product->options ?? [];
    foreach ($productOptions as $option) {
        $selectedOptions[] = $option->option_id;
    }
!!}
<div class="form-row">
    <label for="options">Options</label>
    <select name="options[]" multiple id="options">
        <option value="">-- None --</option>
        @foreach ($options as $option)
        <option value="{{ $option->id }}" {{ in_array($option->id,$selectedOptions) ? 'selected' : '' }} >
            {{ $option->variant_name }}({{ $option->value }})</option>
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