
<div class="form-row">
    <label for="options">Options</label>
    <select name="options[]" multiple id="options">
        <option value="">-- None --</option>
        @foreach ($options as $option)
        <option value="{{ $option->id }}">{{ $option->variant_name }}({{ $option->value }})</option>
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