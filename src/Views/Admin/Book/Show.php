
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Book Details <small class="text-white-50">Admin Panel</small></h4>
    </div>

    <div class="card-body">

      <!-- Top Section -->
      <div class="row g-4">
        <div class="col-md-3">
            @if($book->cover_image)
                <img src="/uploads/{{$book->cover_image}}" alt="Book Cover" class="img-fluid rounded shadow-sm">
            @endif
        </div>
        <div class="col-md-9">
            <h3 class="fw-semibold">{{ $book->title }}</h3>
            <p class="mb-1 text-muted">
                Authors: 
                <span class="fw-medium">
                    @foreach($book->authors as $author)
                        {{ $author->name }}@if(!$loop->last), @endif
                    @endforeach
                </span>
            </p>
            <p class="text-muted mb-0">
                Categories: <span class="fw-medium">
                    @foreach($book->categories as $category)
                        {{ $category->name }}@if(!$loop->last), @endif
                    @endforeach
                </span>
            </p>
        </div>
      </div>

      <hr>

      <!-- Info Grid -->
      <div class="row mb-4">
        <div class="col-sm-6 mb-3">
          <strong>ISBN:</strong><br>
          978-3-16-148410-0
        </div>
        <div class="col-sm-6 mb-3">
          <strong>Pages:</strong><br>
          320
        </div>
        <div class="col-sm-6 mb-3">
          <strong>Published:</strong><br>
          2024
        </div>
        <div class="col-sm-6 mb-3">
          <strong>Status:</strong><br>
          <span class="badge bg-success">Available</span>
        </div>
      </div>

      <hr>

      <!-- Description -->
      <h6>Description</h6>
      <p class="text-secondary">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent
        interdum orci vitae nulla lacinia, sed faucibus magna luctus.
      </p>

      <hr>

      <!-- Action Buttons -->
      <div class="d-flex justify-content-end gap-2">
        <a href="#" class="btn btn-secondary">Back</a>
        <a href="#" class="btn btn-primary">Edit Book</a>
        <a href="#" class="btn btn-danger">Delete</a>
      </div>
    </div>

  </div>