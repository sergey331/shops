{!!
use Kernel\Model\Paginator;
!!}

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Shipping Methods Items</h4>
        <div class="category-header">
            <a href="/admin/shipping-methods/items/create/{{ $shippingMethod->id }}" class="btn btn-add">Add New</a>
        </div>
        <div class="table-responsive">
            {{ $tableData->render() }}
            {{ Paginator::html($shippingMethodItems) }}
        </div>
    </div>
</div>