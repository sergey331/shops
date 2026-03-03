{!!
use Kernel\Model\Paginator;
!!}

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Geo-Zones</h4>
        <div class="category-header">
            <a href="/admin/geo-zones/create" class="btn btn-add">Add New</a>
        </div>
        <div class="table-responsive">
            {{ $tableData->render() }}
            {{ Paginator::html($geoZone) }}
        </div>
    </div>
</div>