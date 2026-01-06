{!! $errors = $session->getCLean('errors') ?? []; !!}

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create New Category</h4>
        {{ $form->render() }}
    </div>
</div>
