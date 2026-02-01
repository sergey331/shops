<div class="card">
    <div class="card-body">
        <h4 class="card-title">New Book</h4>

        {{ $forms->render() }}
    </div>
</div>

<script>
    if ($("#started_at").length) {
      $('#started_at').datepicker({
        format: 'yyyy-mm-dd',   // ← Y-m-d format
        enableOnReadonly: true,
        todayHighlight: true,
        autoclose: true
      });
    }
     if ($("#finished_at").length) {
      $('#finished_at').datepicker({
        format: 'yyyy-mm-dd',   // ← Y-m-d format
        enableOnReadonly: true,
        todayHighlight: true,
        autoclose: true
      });
    }
</script>