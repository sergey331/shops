{!! $errors = $session->getCLean('errors') ?? []; !!}

<div class="card">
    <div class="card-body">
        <h4 class="card-title">New Book</h4>

        {{ $forms->render() }}
    </div>
</div>

<script>
    if ($("#publication_date").length) {
      $('#publication_date').datepicker({
        format: 'yyyy-mm-dd',   // ← Y-m-d format
        enableOnReadonly: true,
        todayHighlight: true,
        autoclose: true
      });
      $("#publication_date").datepicker("setDate", "0");
    }
</script>