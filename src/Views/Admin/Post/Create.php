{!! $errors = $session->getCLean('errors') ?? []; !!}

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create New Post</h4>

        <form action="/admin/posts/store" method="POST" enctype="multipart/form-data" class="forms-sample">

            <div class="d-flex gap-5">
                <div class="form-group flex-fill">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" />
                    @isset($errors['title'])
                    <ul class="errors">
                        @foreach ($errors['title'] as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endisset
                </div>
                <div class="form-group flex-fill">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" />
                    @isset($errors['slug'])
                    <ul class="errors">
                        @foreach ($errors['slug'] as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endisset
                </div>
            </div>

            <div class="d-flex gap-5">
                <div class="form-group flex-fill">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                        <option value="archived">Archived</option>

                    </select>
                    @isset($errors['tag_id'])
                    <ul class="errors">
                        @foreach ($errors['tag_id'] as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endisset
                </div>
                <div class="form-group flex-fill">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" accept="image/*" class="form-control">
                    @isset($errors['image'])
                    <ul class="errors">
                        @foreach ($errors['image'] as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endisset
                </div>
            </div>

            <div class="d-flex gap-5">
                <div class="form-group flex-fill">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" class="form-control"></textarea>
                    @isset($errors['content'])
                    <ul class="errors">
                        @foreach ($errors['content'] as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endisset
                </div>
                <div class="form-group flex-fill">
                    <label for="excerpt">Excerpt</label>
                    <textarea name="excerpt" id="excerpt" class="form-control"></textarea>
                    @isset($errors['excerpt'])
                    <ul class="errors">
                        @foreach ($errors['excerpt'] as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endisset
                </div>
            </div>

            <div class="d-flex gap-5">
                <div class="form-group flex-fill">
                    <label for="published_at">Published at</label>
                    <input type="text" name="published_at" id="published_at" class="form-control"/>
                    @isset($errors['published_at'])
                    <ul class="errors">
                        @foreach ($errors['published_at'] as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endisset
                </div>
                <div class="form-group flex-fill">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" class="form-control"/>
                    @isset($errors['meta_title'])
                    <ul class="errors">
                        @foreach ($errors['meta_title'] as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endisset
                </div>
                <div class="form-group flex-fill">
                    <label for="meta_description">Meta description</label>
                    <textarea name="meta_description" id="meta_description" class="form-control"></textarea>
                    @isset($errors['meta_description'])
                    <ul class="errors">
                        @foreach ($errors['meta_description'] as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endisset
                </div>
            </div>

            <div class="d-flex gap-5">
                <div class="form-group flex-fill">
                    <label for="tag_id">Tags</label>
                    <select name="tag_id[]" id="category_id" multiple class="form-control">
                        <option value="">Select Tags</option>
                        @foreach( $tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
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
                <div class="form-group flex-fill">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach( $categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
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
                <button type="submit" class="btn btn-inverse-primary me-2">Create Post</button>
            </div>
        </form>
    </div>
</div>
