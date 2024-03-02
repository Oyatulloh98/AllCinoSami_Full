@extends('dashboard.includes.app')
@section('tittle', 'Serial Video UZ')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Filmlar</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('films.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('UzbekFilmVideo.create', $id) }}">{{ $film->name_uz }} | {{ $film->name_ru }} filmini yaratish</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-8 offset-2">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Film name : {{ $film->name_uz }} | {{ $film->name_ru }} and table
                                uz</h5>
                            <!-- Default Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Part</th>
                                        <th scope="col">Video</th>
                                        <th scope="col">Edit</th>
                                        @if ($film->deleted_at != null)
                                        @else
                                            <th scope="col">24/7</th>
                                        @endif
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @if ($film_uz_videos && count($film_uz_videos) > 0)
                                        @foreach ($film_uz_videos as $item)
                                            <tr>
                                                <td>{{ $item->part }}</td>
                                                <td>
                                                    <a href="{{ $item->uz_film_path() }}{{ $item->path }}">
                                                        <video src="{{ $item->uz_film_path() }}{{ $item->path }}"
                                                            class="img img-thumbnail" width="30" style="height: 30px">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{route('UzbekFilmVideo.edit',$item->id)}}"class="badge bg-info">
                                                        <i class="ri-quill-pen-fill"></i>
                                                    </a>
                                                </td>

                                                @if ($film->deleted_at != null)
                                                @else
                                                    <td>
                                                        <span
                                                            class="badge bg-{{ $item->deleted_at == null ? 'success' : 'danger' }} deletepartfilm"
                                                            style="cursor: pointer">
                                                            <i id="{{ $item->id }}"
                                                                style="user-select: none">{{ $item->deleted_at == null ? 'active' : 'noactive' }}</i>
                                                        </span>
                                                    </td>
                                                @endif


                                                <td>
                                                    <span class="badge bg-danger removebasefilm <?php if ($item->deleted_at === null) {
                                                        echo 'hidden';
                                                    } ?>">
                                                        <i class="ri-delete-bin-2-fill " id="{{ $item->id }}"></i>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                            <!-- End Default Table Example -->
                            @include('dashboard/film/uz_film_video/action/action')
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
