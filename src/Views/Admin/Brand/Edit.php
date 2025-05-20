{!! $errors = $session->getCLean('errors') ?? []; !!}
<div class="form-wrapper">
    <h2>Edit brand</h2>

    <form action="/admin/brand/{{$brand->id}}" method="POST"  class="form-grid">
        <div class="form-row">
            <label for="name">Name</label>
            <input type="text" name="name" id="name"  placeholder="e.g. Electronics" value="{{$brand->name}}">
            @isset($errors['name'])
                <ul class="errors">
                    @foreach ($errors['name'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endisset
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-add btn-sm">Update Brand</button>
        </div>
    </form>
</div>
