{!! use Shop\model\Book; !!}
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Book Details</h4>
    </div>

    <div class="card-body">

        <!-- Top Section -->
        <div class="row g-4">
            <div class="col-md-3 ">
                @if($book->cover_image)
                <img src="{{ public_path('uploads/books/'. $book->cover_image)}}" alt="Book Cover"
                    class="img-fluid rounded shadow-sm">
                @endif
            </div>
            <div class="col-md-9">
                <h3 class="fw-semibold">{{ $book->title }}</h3>
                <ul class="list-group">
                    <li class="list-group-item">
                        Authors:
                        <span class="fw-medium">
                            @foreach($book->authors as $index => $author)
                            {{ $author->name }} @if(($index + 1) < count($book->authors)),@endif
                                @endforeach
                        </span>
                    </li>
                    <li class="list-group-item">
                        Categories: <span class="fw-medium">
                            @foreach($book->categories as $index => $category)
                            {{ $category->name }} @if(($index + 1) < count($book->categories)),@endif
                                @endforeach
                        </span>
                    </li>
                    <li class="list-group-item">
                        Tags: <span class="fw-medium">
                            @foreach($book->tags as $index => $tag)
                            {{ $tag->name }} @if(($index + 1) < count($book->tags)),@endif
                                @endforeach
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <hr>

        <!-- Info Grid -->
        <div class="row mb-4">
            <div class="col-sm-6 mb-3">
                <strong>ISBN:</strong><br>
                {{ $book->isbn }}
            </div>
            <div class="col-sm-6 mb-3">
                <strong>Pages:</strong><br>
                {{ $book->pages }}
            </div>
            <div class="col-sm-6 mb-3">
                <strong>Published:</strong><br>
                {{ $book->publication_date }}
            </div>
            <div class="col-sm-6 mb-3">
                <strong>Publisher:</strong><br>
                {{ $book->publisher->name }}
            </div>
            {!!
            $statusClasses = [
            'draft' => 'bg-secondary',
            'published' => 'bg-success',
            'archived' => 'bg-dark',
            ];
            !!}
            <div class="col-sm-6 mb-3">
                <strong>Status:</strong><br>
                <span class="badge {{ $statusClasses[$book->status] ?? 'bg-secondary' }}">
                    {{ Book::STATUS[$book->status] }}
                </span>
            </div>
            <div class="col-sm-6 mb-3">
                <strong>Price:</strong><br>
                {{ $book->price }}
            </div>
        </div>

        <hr>

        <!-- Description -->
        <h6>Description</h6>
        <p class="text-secondary">{{ $book->description }}</p>

        <hr>

        <div class="row">
            <div class="col-sm-12">
                <div class="d-flex align-items-center justify-content-between mb-5">
                    <strong>Discount</strong>
                    <button type="button" class="btn btn-primary text-white mb-0" data-bs-toggle="modal"
                        data-bs-target="#discountBook">
                        Add Discount
                    </button>
                </div>
                @if($book->discount)
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Price:</strong><br>
                            <span id="discount_show_price" >{{ $book->discount->price }}</span>
                        </div>
                        <div class="col-sm-4">
                            <strong>Started:</strong><br>
                            <span id="discount_show_started" >{{ $book->discount->started_at }}</span>
                        </div>
                        <div class="col-sm-4">
                            <strong>Finished:</strong><br>
                            <span id="discount_show_finished" >{{ $book->discount->finished_at ?? '' }}</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-sm-12">
                <div class="d-flex align-items-center justify-content-between mb-5">
                    <strong>Images</strong>
                    <button type="button" class="btn btn-primary text-white mb-0" data-bs-toggle="modal"
                        data-bs-target="#uploadImage">
                        Add image
                    </button>
                </div>
                <div class="d-flex align-items-center gap-4 " id="book-images">
                    @if($book->images)
                    @foreach($book->images as $image)
                    <div class="image-box" style="width: 150px;height: 150px; position: relative">
                        <button class="delete-button" data-image-id="{{ $image->id }}" data-book-id="{{ $book->id }}">
                            <i class="fa fa-trash"></i>
                        </button>
                        <img style="width: 100%;height: 100%;object-fit:cover"
                            src="{{ public_path('uploads/books/images/'. $image->image_path)}}" alt="">
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>

        <hr>
        <!-- Action Buttons -->
        <div class="d-flex justify-content-end gap-2">
            <a href="#" class="btn btn-secondary">Back</a>
            <a href="#" class="btn btn-primary">Edit Book</a>
            <a href="#" class="btn btn-danger">Delete</a>
        </div>
    </div>

</div>


<div class="modal fade" id="deleteBookModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Delete Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Are you sure you want to delete this book?
                <p class="text-muted mb-0">This action cannot be undone.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBook">
                    Yes, Delete
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadImage" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Upload image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" id="book_id" value="{{ $book->id }}">
                    <input type="file" id="book_images" class="form-control" multiple>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-danger" id="uploadConfirm">
                    Upload
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="discountBook" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Discount</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="discount_price">Price</label>
                    <input type="hidden" id="book_id" value="{{ $book->id }}">
                    <input type="number" id="discount_price" class="form-control"
                        value="{{ $book->discount->price ?? '' }}" />
                        <div class="errors" id="price-error"></div>

                </div>

                <div class="form-group">
                    <label for="discount_started_at">Started</label>
                    <div id="discount_started" class="input-group date datepicker navbar-date-picker">
                        <span class="input-group-addon input-group-prepend border-right"
                            style="border-right: 2px solid #dee2e6;">
                            <span class="icon-calendar input-group-text calendar-icon"></span>
                        </span>
                        <input type="text" id="discount_started_at" class="form-control"
                            value="{{ $book->discount->started_at ?? '' }}">
                    </div>
                    <div class="errors" id="started_at-error"></div>
                </div>

                <div class="form-group">
                    <label for="discount_finished_at">Finished</label>

                    <div id="discount_finished" class="input-group date datepicker navbar-date-picker">
                        <span class="input-group-addon input-group-prepend border-right"
                            style="border-right: 2px solid #dee2e6;">
                            <span class="icon-calendar input-group-text calendar-icon"></span>
                        </span>
                        <input type="text" id="discount_finished_at" class="form-control"
                            value="{{ $book->discount->finished_at ?? '' }}">
                    </div>
                    <div class="errors" id="finished_at-error"></div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-danger" id="discountSave">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>