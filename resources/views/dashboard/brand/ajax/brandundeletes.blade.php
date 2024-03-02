@foreach ($brands as $brand)
    <tr>
        <td>{{ $brand->id }}</td>
        <td>{{ $brand->category->name_uz }} | {{ $brand->category->name_ru }}</td>
        <td>{{ $brand->name }}</td>
        <td>{{ $brand->created_at }}</td>
        <td>
            <a href="{{ route('brand.edit', $brand->id) }}"class="badge bg-warning">
                <i class="ri-quill-pen-fill"></i>
            </a>
        </td>
        <td>

            <span class="badge bg-danger">
                <i class="ri-delete-bin-2-fill delete-brand" id="{{ $brand->id }}"></i>
            </span>
        </td>
    </tr>
@endforeach
