<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Book</h4>

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
    }
</script>