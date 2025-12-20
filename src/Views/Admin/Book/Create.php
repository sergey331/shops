{!! $errors = $session->getCLean('errors') ?? []; !!}

<div class="card">
    <div class="card-body">
        <h4 class="card-title">New Book</h4>

        {{ $forms->render() }}
    </div>
</div>