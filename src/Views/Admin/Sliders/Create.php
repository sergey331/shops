{!! $errors = $session->getCLean('errors') ?? []; !!}
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create New Slide</h4>

        <form action="/admin/sliders/store" method="POST" enctype="multipart/form-data" class="form-sample">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title"   />
                @isset($errors['title'])
                <ul class="errors">
                    @foreach ($errors['title'] as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endisset
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" class="form-control" id="content" rows="3" ></textarea>
                @isset($errors['content'])
                <ul class="errors">
                    @foreach ($errors['content'] as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endisset
            </div>
            <div class="form-group">
                <label for="image_url">Image</label>
                <input type="file" name="image_url" class="form-control" id="image_url" accept="image/*">
                @isset($errors['image_url'])
                <ul class="errors">
                    @foreach ($errors['image_url'] as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endisset
            </div>
            <div class="form-check form-check-flat form-check-primary " style="margin-left: 24px">
                <label for="form-check-label">
                    <input type="checkbox" name="is_show" class="form-check-input" id="is_show"  value="1" >
                    Show
                </label>

                @isset($errors['is_show'])
                <ul class="errors">
                    @foreach ($errors['is_show'] as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endisset
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-inverse-primary me-2">Create Slide</button>
            </div>
        </form>
    </div>
</div>