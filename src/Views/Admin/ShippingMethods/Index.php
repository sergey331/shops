{!!
use Kernel\Model\Paginator;
!!}

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Shipping Methods</h4>
        <div class="category-header">
            <a href="/admin/shipping-methods/create" class="btn btn-add">Add New</a>
        </div>
        <div class="table-responsive">
            {{ $tableData->render() }}
            {{ Paginator::html($shippingMethods) }}
        </div>
    </div>
</div>