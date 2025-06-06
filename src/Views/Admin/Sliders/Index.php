{!!
    /**
     * @var \App\Models\Slider[] $sliders
     */
!!}

<div>
    <h1>News</h1>

    <div class="category-header">
        <a href="/admin/sliders/create" class="btn btn-add">Add New</a>
    </div>
    <div class="category-table">
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Content</th>
                <th>Is Show</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($sliders as $slider)
            <tr>
                <td>{{ $slider->id }}</td>
                <td>{{ $slider->title }}</td>
                <td>{{ $slider->content }}</td>
                <td>
                    @if ($slider->is_show)
                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Yes</span>
                    @else
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300">No</span>
                    @endif
                </td>
                <td>
                    @if ($slider->image_url)
                        <img src="/uploads/sliders/{{ $slider->image_url }}" alt="News Image" style="width: 50px; height: 50px;">
                    @else
                        No Image
                    @endif
                <td>
                    <a href="/admin/sliders/{{ $slider->id }}" class="btn btn-sm btn-edit">Edit</a>
                    <a href="/admin/sliders/delete/{{ $slider->id }}" class="btn btn-sm btn-delete">Delete</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>