@foreach ($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name_uz }}</td>
        <td>{{ $category->name_ru }}</td>
        <td>{{ $category->created_at }}</td>
        <td>
            <a href="{{ route('category.edit', $category->id) }}"class="badge bg-warning">
                <i class="ri-quill-pen-fill"></i>
            </a>
        </td>
        <td>

            <span class="badge bg-danger">
                <i class="ri-delete-bin-2-fill delete-category" id="{{ $category->id }}"></i>
            </span>
        </td>
    </tr>
@endforeach
