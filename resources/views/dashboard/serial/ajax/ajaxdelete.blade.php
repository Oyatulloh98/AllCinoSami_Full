@foreach ($serials as $serial)
    <tr>
        <td>{{ $serial->id }}</td>
        <td>{{ $serial->category->name_ru }} | {{ $serial->category->name_uz }}</td>
        <td>{{ $serial->brand->name }}</td>
        <td>
            <a
                href="{{ isset($serial->serialImagePath[0]['path']) ? asset('storage/images_folder/' . $serial->serialImagePath[0]['path']) : '#' }}">
                <img src="{{ isset($serial->serialImagePath[0]['path']) ? asset('storage/images_folder/' . $serial->serialImagePath[0]['path']) : '#' }}"
                    class="img img-thumbnail" width="30" style="height: 30px">
            </a>
        </td>
        <td>
            <a href="{{ route('uzserialvideo.index', $serial->id) }}" class="badge bg-info">
                <i>uz</i>
            </a>
            <a href="{{ route('ruserialvideo.index', $serial->id) }}" class="badge bg-info">
                <i>ru</i>
            </a>
        </td>
        <td>{{ $serial->name_uz }}</td>
        <td>{{ $serial->name_ru }}</td>
        <td>{{ $serial->created_at }}</td>
        <td>
            <a href="{{ route('allserial.edit', $serial->id) }}"class="badge bg-warning">
                <i class="ri-quill-pen-fill"></i>
            </a>
        </td>
        <td>

            <span class="badge bg-danger">
                <i class="ri-delete-bin-2-fill delete-serial" id="{{ $serial->id }}"></i>
            </span>
        </td>
    </tr>
@endforeach
