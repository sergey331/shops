{!! $errors = $session->getCLean('errors') ?? []; !!}

 <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f4f4f4;
      padding: 2rem;
    }

    .tabs {
      width: 100%;
      max-width: 600px;
      margin: 0 auto;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      overflow: hidden;
    }

    .tab-labels {
      display: flex;
      background: #eee;
    }

    .tab-labels label {
      flex: 1;
      padding: 1rem;
      text-align: center;
      cursor: pointer;
      background: #eee;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    .tab-labels label:hover {
      background: #ddd;
    }

    input[type="radio"] {
      display: none;
    }

    .tab-content {
      display: none;
      padding: 1.5rem;
      background: white;
    }

    input#tab1:checked ~ .tab-labels label[for="tab1"],
    input#tab2:checked ~ .tab-labels label[for="tab2"],
    input#tab3:checked ~ .tab-labels label[for="tab3"] {
      background: #fff;
      border-bottom: 2px solid #007bff;
      color: #007bff;
    }

    input#tab1:checked ~ .content #content1,
    input#tab2:checked ~ .content #content2,
    input#tab3:checked ~ .content #content3 {
      display: block;
    }
  </style>
 <div class="tabs">
    <!-- Radio Buttons -->
    <input type="radio" id="tab1" name="tab" checked>
    <input type="radio" id="tab2" name="tab">
    <input type="radio" id="tab3" name="tab">

    <!-- Labels -->
    <div class="tab-labels">
      <label for="tab1">Overview</label>
      <label for="tab2">Details</label>
      <label for="tab3">Reviews</label>
    </div>

    <!-- Tab Content -->
    <div class="content">
      <div class="tab-content" id="content1">
        <h2>Overview</h2>
        <p>This is the overview content of the product.</p>
      </div>
      <div class="tab-content" id="content2">
        <h2>Details</h2>
        <p>Here are the detailed specifications of the product.</p>
      </div>
      <div class="tab-content" id="content3">
        <h2>Reviews</h2>
        <p>Read what other users have said about this product.</p>
      </div>
    </div>
  </div>


<div class="form-wrapper">
    <h2>Create New Product</h2>

    <form action="/admin/products/store" method="POST" enctype="multipart/form-data" class="form-grid">
        <div class="form-row">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" >
            @isset($errors['name'])
                <ul class="errors">
                    @foreach ($errors['name'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endisset
        </div>
    
        <div class="form-row">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" >
            @isset($errors['price'])
                <ul class="errors">
                    @foreach ($errors['price'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endisset
        </div>

        <div class="form-row">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="3" placeholder="Short description..."></textarea>
            @isset($errors['description'])
                <ul class="errors">
                    @foreach ($errors['description'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endisset
        </div>

        <div class="form-row">
            <label for="avatar">Avatar Image</label>
            <input type="file" name="avatar" id="avatar" accept="image/*">
            @isset($errors['avatar'])
                <ul class="errors">
                    @foreach ($errors['avatar'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endisset
        </div>

        <div class="form-row">
            <label for="category_id">Parent Category</label>
            <select name="category_id" id="category_id">
                <option value="">-- None --</option>
                @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
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
        <div class="form-actions">
            <button type="submit" class="btn btn-add btn-sm">Create Product</button>
        </div>
    </form>
</div>
