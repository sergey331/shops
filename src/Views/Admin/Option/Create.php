{!! $errors = $session->getCLean('errors') ?? []; !!}
<div class="form-wrapper">
    <h2>Create New Option</h2>

    <form action="/admin/option/store" method="POST" class="form-grid">
        <div class="form-row">
            <label for="name"> Name</label>
            <input type="text" name="variant_name" id="name"  placeholder="Enter option name" >
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
            <input type="text" name="value" id="value"  placeholder="Enter option value" >
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
            <input type="number" name="price" id="price"  placeholder="Enter option price" >
            @isset($errors['price'])
            <ul class="errors">
                @foreach ($errors['price'] as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endisset
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-add btn-sm">Create option</button>
        </div>
    </form>
</div>
