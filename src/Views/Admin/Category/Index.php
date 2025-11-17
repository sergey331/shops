{!!
    /**
     * @var \App\Models\Slider[] $sliders
     */

use Kernel\Model\Paginator;
!!}

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Categories</h4>
        <div class="category-header">
            <a href="/admin/categories/create" class="btn btn-add">Add New</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories->data as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        @if ($category->logo)
                        <img src="/images/categories/{{ $category->logo }}" alt="Category Image" style="width: 50px; height: 50px;">
                        @else
                        No Image
                        @endif
                    </td>
                    <td>
                        <a href="/admin/categories/{{ $category->id }}" class="btn btn-sm btn-edit">Edit</a>
                        <a href="/admin/categories/delete/{{ $category->id }}" class="btn btn-sm btn-delete">Delete</a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="5">
                        {{ Paginator::html($categories) }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>