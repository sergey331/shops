{!! $errors = $session->getCLean('errors') ?? []; !!}
<div class="form-wrapper">
    <h2>Edit New</h2>

    <form action="/admin/news/{{ $new->id}}" method="POST" enctype="multipart/form-data" class="form-grid">
        <div class="form-row">
            <label for="title">Title</label>
            <input type="text" name="title" id="title"  value="{{ $new->title }}" />
            @isset($errors['title'])
            <ul class="errors">
                @foreach ($errors['title'] as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endisset
        </div>

        <div class="form-row">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug"  value="{{ $new->slug }}" />
            @isset($errors['slug'])
            <ul class="errors">
                @foreach ($errors['slug'] as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endisset
        </div>

        <div class="form-row">
            <label for="content">Content</label>
            <textarea name="content" id="content" rows="3" >{{ $new->content }}</textarea>
            @isset($errors['content'])
            <ul class="errors">
                @foreach ($errors['content'] as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endisset
        </div>

        <div class="form-row">
            <label for="published_at">Published At</label>
            <input type="text" name="published_at" id="published_at" value="{{ $new->published_at }}"  >
            @isset($errors['published_at'])
            <ul class="errors">
                @foreach ($errors['published_at'] as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endisset
        </div>
        <div class="form-row">
            <label for="is_published">Is Published</label>
            <input type="checkbox" name="is_published" id="is_published"  value="1" {{ $new->is_published ? 'checked' : '' }} >
            @isset($errors['is_published'])
            <ul class="errors">
                @foreach ($errors['is_published'] as $error)
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

        <div class="form-actions">
            <button type="submit" class="btn btn-add btn-sm">Create Category</button>
        </div>
    </form>

</div>
