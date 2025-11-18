{!!

use Kernel\Model\Paginator;
!!}

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Categories</h4>
        <div class="category-header">
            <a href="/admin/categories/create" class="btn btn-add">Add New</a>
        </div>
        <div class="table-responsive">
            {{ $tableData->render() }}
            {{ Paginator::html($categories) }}
        </div>
    </div>
</div>