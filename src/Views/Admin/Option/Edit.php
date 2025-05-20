{!! $errors = $session->getCLean('errors') ?? []; !!}
<div class="form-wrapper">
    <h2>Edit Option</h2>

    <form action="/admin/option/{{$option->id}}" method="POST"  class="form-grid">
        <div class="form-row">
            <label for="name">Name</label>
            <input type="text" name="variant_name" id="name"  value="{{$option->variant_name}}">
            @isset($errors['name'])
                <ul class="errors">
                    @foreach ($errors['name'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endisset
        </div>

        <div class="form-row">
            <label for="value">Value</label>
            <input type="text" name="value" id="value"  value="{{$option->value}}">
            @isset($errors['value'])
            <ul class="errors">
                @foreach ($errors['value'] as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endisset
        </div>

        <div class="form-row">
            <label for="price">Price</label>
            <input type="text" name="price" id="price"  value="{{$option->price}}">
            @isset($errors['price'])
            <ul class="errors">
                @foreach ($errors['price'] as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endisset
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-add btn-sm">Update option</button>
        </div>
    </form>
</div>
