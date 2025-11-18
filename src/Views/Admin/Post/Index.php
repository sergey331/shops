{!!
    /**
     * @var \App\Models\Post[] $posts
     */
    use Kernel\Model\Paginator;
!!}

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Posts</h4>
        <div class="category-header">
            <a href="/admin/posts/create" class="btn btn-add">Add New</a>
        </div>
        <div class="table-responsive">
            <div class="table-responsive">
                {{ $tableData->render() }}
                {{ Paginator::html($posts) }}
            </div>
        </div>
    </div>
</div>

<div>