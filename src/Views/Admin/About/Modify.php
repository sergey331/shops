{!! $errors = $session->getCLean('errors') ?? []; !!}
<div class="form-wrapper">
    <h2>Edit Slide</h2>

    <form action="/admin/about/modify" method="POST" id="about-form" enctype="multipart/form-data" class="form-grid">
        <div class="form-row">
            <label for="title">Content</label>
            <input type="hidden" name="content" id="quill_html">
            <div id="editor-container" style="height: 300px;">{{$about->content ?? ''}}</div>

            @isset($errors['content'])
            <ul class="errors">
                @foreach ($errors['content'] as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endisset
        </div>


        <div class="form-row">
            <label for="media_path">Image</label>
            <input type="file" name="media_path" id="media_path" accept="image/*,video/*">
            @isset($errors['media_path'])
            <ul class="errors">
                @foreach ($errors['media_path'] as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endisset
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-add btn-sm">Save</button>
        </div>
    </form>

</div>
<script>
    const quill = new Quill('#editor-container', {
        theme: 'snow'
    });
    document.getElementById('about-form').onsubmit = function() {
        document.getElementById('quill_html').value = quill.root.innerHTML;
    };
</script>