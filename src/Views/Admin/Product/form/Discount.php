{!!
    $errors = $session->getCLean('errors') ?? [];
    $discount_type = $product->discount->discount_type ?? '';
    $discount_value = $product->discount->discount_value ?? '';
    $start_date = $product->discount->start_date ?? '';
    $end_date = $product->discount->end_date ?? '';
!!}

<div class="form-row">
    <label for="discount_type">Type</label>
    <select name="discount[discount_type]" id="brand_id">
        <option value="">-- None --</option>
        @foreach ($discountTypes as $type)
            <option value="{{ $type }}" @if($type === $discount_type ) selected @endif >{{ $type }}</option>
        @endforeach
    </select>
    @isset($errors['discount_type'])
    <ul class="errors">
        @foreach ($errors['discount_type'] as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endisset
</div>

<div class="form-row">
    <label for="discount_value">Discount Price</label>
    <input type="text" name="discount[discount_value]" id="discount_value" value="{{ $discount_value }}" >
    @isset($errors['discount_value'])
    <ul class="errors">
        @foreach ($errors['discount_value'] as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endisset
</div>
<div class="form-row">
    <label for="start_date">Start Date</label>
    <input type="text" name="discount[start_date]" id="start_date" value="{{ $start_date }}" >
    @isset($errors['start_date'])
    <ul class="errors">
        @foreach ($errors['start_date'] as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endisset
</div>
<div class="form-row">
    <label for="end_date">End Date</label>
    <input type="text" name="discount[end_date]" id="end_date" value="{{ $end_date }}" >
    @isset($errors['end_date'])
    <ul class="errors">
        @foreach ($errors['end_date'] as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endisset
</div>
