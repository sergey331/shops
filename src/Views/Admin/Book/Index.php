{!!

use Kernel\Model\Paginator;
!!}

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Books</h4>
        <div class="category-header">
            <a href="/admin/books/create" class="btn btn-add">Add New</a>
        </div>
        <div class="table-responsive">
            {{ $tableData->render() }}
            {{ Paginator::html($books) }}
        </div>
    </div>
</div>