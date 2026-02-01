{!!

use Kernel\Model\Paginator;
!!}

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Discounts</h4>
        <div class="category-header">
            <a href="/admin/discounts/create" class="btn btn-add">Add New</a>
        </div>
        <div class="table-responsive">
            {{ $tableData->render() }}
            {{ Paginator::html($discounts) }}
        </div>
    </div>
</div>