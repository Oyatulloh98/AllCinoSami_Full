@foreach ($brands as $brand)
    <tr>
        <td>{{ $brand->id }}</td>
        <td>{{ $brand->category->name_uz }} | {{ $brand->category->name_ru }}</td>
        <td>{{ $brand->name }}</td>
        <td>{{ $brand->created_at }}</td>
        <td>
            <span class="badge bg-success">
                <i class="ri-24-hours-fill restore-brand" id="{{ $brand->id }}"></i>
            </span>
        </td>
        <td>

            <span class="badge bg-danger">
                <i class="ri-delete-bin-2-fill forcedelete-brand" id="{{ $brand->id }}"></i>
            </span>
        </td>
    </tr>
@endforeach
