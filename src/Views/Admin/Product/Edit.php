{!! $errors = $session->getCLean('errors') ?? []; !!}
<div class="form-wrapper">
    <h2>Edit Product</h2>

    <form action="/admin/products/{{$product->id}}" method="POST" enctype="multipart/form-data" class="form-grid">
        <div class="tabs">
            <!-- Radio Buttons -->
            <input type="radio" id="tab1" name="tab" checked>
            <input type="radio" id="tab2" name="tab">
            <input type="radio" id="tab3" name="tab">
            <input type="radio" id="tab4" name="tab">

            <!-- Labels -->
            <div class="tab-labels">
                <label for="tab1">Overview</label>
                <label for="tab2">Discount</label>
                <label for="tab3">Options</label>
                <label for="tab4">Images</label>
            </div>
            <!-- Tab Content -->
            <div class="content1">
                <div class="tab-content" id="content1">
                    <h2>Overview</h2>
                    @include('Admin.Product.form.Overview')
                </div>
                <div class="tab-content" id="content2">
                    <h2>Discount</h2>
                    @include('Admin.Product.form.Discount')
                </div>
                <div class="tab-content" id="content3">
                    <h2>Options</h2>
                    @include('Admin.Product.form.Option')
                </div>
                <div class="tab-content" id="content4">
                    <h2>Reviews</h2>
                    @include('Admin.Product.form.Images')
                </div>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-add btn-sm">Update Product</button>
        </div>
    </form>
</div>
