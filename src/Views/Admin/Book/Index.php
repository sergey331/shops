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
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Isbn</th>
                    <th>Language</th>
                    <th>Pages</th>
                    <th>Price</th>
                    <th>Publisher</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($books->data as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->slug }}</td>
                    <td>{{ $book->description }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->language }}</td>
                    <td>{{ $book->pages }}</td>
                    <td>{{ $book->price }}</td>
                    <td>{{ $book->publisher->name }}</td>
                    <td>
                        @if ($book->logo)
                        <img src="/images/categories/{{ $book->logo }}" alt="Category Image" style="width: 50px; height: 50px;">
                        @else
                        No Image
                        @endif
                    </td>
                    <td>
                        <a href="/admin/categories/{{ $book->id }}" class="btn btn-sm btn-edit">Edit</a>
                        <a href="/admin/categories/delete/{{ $book->id }}" class="btn btn-sm btn-delete">Delete</a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="5">
                        {{ Paginator::html($books) }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>