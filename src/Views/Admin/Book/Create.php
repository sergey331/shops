{!! $errors = $session->getCLean('errors') ?? []; !!}

<div class="card">
    <div class="card-body">
        <h4 class="card-title">New Book</h4>

        <form action="">
            <div class="d-flex gap-5">
                <div class="form-group flex-fill">
                    <label for="title">Title</label>
                    <input type="text" class="form-control"  name="title" id="title"   />
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
                    <input type="text" class="form-control"  name="slug" id="slug"   />
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
                    <label for="price">Price</label>
                    <input type="number" class="form-control"  name="price" id="price"   />
                    @isset($errors['price'])
                    <ul class="errors">
                        @foreach ($errors['price'] as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endisset
                </div>
                <div class="form-group flex-fill">
                    <label for="pages">Pages</label>
                    <input type="number" class="form-control"  name="pages" id="pages"   />
                    @isset($errors['pages'])
                    <ul class="errors">
                        @foreach ($errors['pages'] as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endisset
                </div>
            </div>


            <div class="d-flex gap-5">
                <div class="form-group flex-fill">
                    <label for="language">Language</label>
                    <select class="form-control"  name="language_id" id="language_id">
                        <option value="">Select Language</option>
                        @foreach($languages as $language)
                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                        @endforeach
                    </select>
                    @isset($errors['language_id'])
                    <ul class="errors">
                        @foreach ($errors['language_id'] as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endisset
                </div>
                <div class="form-group flex-fill">
                    <label for="publisher_id">Publisher</label>
                    <select class="form-control"  name="publisher_id" id="publisher_id" >
                        <option value="">Select publisher</option>
                        @foreach($publishers as $publisher)
                            <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                        @endforeach
                    </select>
                    @isset($errors['publisher_id'])
                    <ul class="errors">
                        @foreach ($errors['publisher_id'] as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endisset
                </div>
                <div class="form-group flex-fill">
                    <label for="authors">Authors</label>
                    <select class="form-control"  name="authors[]" id="authors" multiple >
                        <option value="">Select authors</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                    @isset($errors['authors'])
                    <ul class="errors">
                        @foreach ($errors['authors'] as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endisset
                </div>
            </div>

            <div>
                <div class="flex-fill">
                    <label for="">Published at</label>
                    <div id="publication_date" class="input-group date datepicker navbar-date-picker">
                        <span class="input-group-addon input-group-prepend border-right">
                            <span class="icon-calendar input-group-text calendar-icon"></span>
                        </span>
                        <input type="text" name="publication_date" class="form-control">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>