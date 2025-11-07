{!! $errors = $session->getCLean('errors') ?? []; !!}
<div class="form-wrapper">
    <h2>Edit Post</h2>

    <form action="/admin/posts/{{ $post->id}}" method="POST" enctype="multipart/form-data" class="form-grid">
        <div class="flex gap-5">
            <div class="form-row flex-auto">
                <label for="title">Title</label>
                <input type="text" name="title" id="title"  value="{{ $post->title }}" />
                @isset($errors['title'])
                <ul class="errors">
                    @foreach ($errors['title'] as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endisset
            </div>
            <div class="form-row flex-auto">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug"  value="{{ $post->slug }}" />
                @isset($errors['slug'])
                <ul class="errors">
                    @foreach ($errors['slug'] as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endisset
            </div>
        </div>

        <div class="flex gap-5">
            <div class="form-row flex-1">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="draft" @if($post->status === 'draft')selected@endif>Draft</option>
                    <option value="published" @if($post->status === 'published')selected@endif>Published</option>
                    <option value="archived" @if($post->status === 'archived')selected@endif>Archived</option>

                </select>
                @isset($errors['tag_id'])
                <ul class="errors">
                    @foreach ($errors['tag_id'] as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endisset
            </div>
            <div class="form-row flex-1">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" accept="image/*">
                @isset($errors['image'])
                <ul class="errors">
                    @foreach ($errors['image'] as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endisset
            </div>
        </div>

        <div class="flex gap-5">
            <div class="form-row flex-auto">
                <label for="content">Content</label>
                <textarea name="content" id="content">{{ $post->content }}</textarea>
                @isset($errors['content'])
                <ul class="errors">
                    @foreach ($errors['content'] as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endisset
            </div>
            <div class="form-row flex-auto">
                <label for="excerpt">Excerpt</label>
                <textarea name="excerpt" id="excerpt">{{ $post->excerpt }}</textarea>
                @isset($errors['excerpt'])
                <ul class="errors">
                    @foreach ($errors['excerpt'] as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endisset
            </div>
        </div>

        <div class="flex gap-5">
            <div class="form-row flex-auto">
                <label for="published_at">Published at</label>
                <input type="text" name="published_at" id="published_at" value="{{ $post->published_at }}" />
                @isset($errors['published_at'])
                <ul class="errors">
                    @foreach ($errors['published_at'] as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endisset
            </div>
            <div class="form-row flex-auto">
                <label for="meta_title">Meta Title</label>
                <input type="text" name="meta_title" id="meta_title" value="{{ $post->meta_title }}"/>
                @isset($errors['meta_title'])
                <ul class="errors">
                    @foreach ($errors['meta_title'] as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endisset
            </div>
            <div class="form-row flex-auto">
                <label for="meta_description">Meta description</label>
                <textarea name="meta_description" id="meta_description">{{ $post->meta_description }}</textarea>
                @isset($errors['meta_description'])
                <ul class="errors">
                    @foreach ($errors['meta_description'] as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endisset
            </div>
        </div>

        <div class="flex gap-5">
            <div class="form-row flex-auto">
                <label for="tag_id">Tags</label>
                <select name="tag_id[]" id="category_id" multiple>
                    <option value="">Select Tags</option>
                    @foreach( $tags as $tag)
                    <option value="{{$tag->id}}" @inarray($tag->id,$selectedTagsId)selected@endinarray>{{$tag->name}}</option>
                    @endforeach
                </select>
                @isset($errors['tag_id'])
                <ul class="errors">
                    @foreach ($errors['tag_id'] as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endisset
            </div>
            <div class="form-row flex-auto">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id">
                    <option value="">Select Category</option>
                    @foreach( $categories as $category)
                        <option value="{{$category->id}}" @if($post->category_id === $category->id)selected@endif>{{$category->name}}</option>
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
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-add btn-sm">Update Post</button>
        </div>
    </form>

</div>
