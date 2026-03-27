{!!

use Kernel\Model\Paginator;
!!}

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Orders</h4>
        <div class="table-responsive">
            {{ $tableData->render() }}
            {{ Paginator::html($orders) }}
        </div>
    </div>
</div>