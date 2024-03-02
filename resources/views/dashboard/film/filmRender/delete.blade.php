@if ($films && count($films) > 0)
    @foreach ($films as $film)
        <tr>
            <td>{{ $film->id }}</td>
            <td>{{ $film->category->name_ru }} | {{ $film->category->name_uz }}</td>
            <td>{{ $film->brand->name }}</td>
            <td>
                <a href="{{ $film->filmImagePath() }}{{ $film->film_image[0]['path'] }}">
                    <img src="{{ $film->filmImagePath() }}{{ $film->film_image[0]['path'] }}" alt="{{ $film->name_uz }}"
                        srcset="" width="30" height="30">
                </a>
            </td>
            <td>
                <a href="{{ route('uzserialvideo.index', $film->id) }}" class="badge bg-info">
                    <i>uz</i>
                </a>
                <a href="{{ route('ruserialvideo.index', $film->id) }}" class="badge bg-info">
                    <i>ru</i>
                </a>
            </td>
            <td>{{ $film->name_uz }}</td>
            <td>{{ $film->name_ru }}</td>
            <td>{{ $film->created_at }}</td>
            <td>
                <span class="badge bg-success">
                    <i class="ri-24-hours-fill restore-film" id="{{ $film->id }}"></i>
                </span>
            </td>
            <td>

                <span class="badge bg-danger">
                    <i class="ri-delete-bin-2-fill remove-film" id="{{ $film->id }}"></i>
                </span>
            </td>
        </tr>
    @endforeach
@endif
