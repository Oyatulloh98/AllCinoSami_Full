@extends('dashboard.includes.app')
@section('tittle', 'Serial')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Filmlar</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('Admin-Panel.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('films.index') }}">Filmlar</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('films.deleted') }}">O'chirilganlar</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('films.create') }}">Yaratish</a></li>

                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Filmlar</h5>
                            <p>Add lightweight datatables to your project with using the <a
                                    href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple
                                    DataTables</a> library. Just add <code>.datatable</code> class name to any table you
                                wish to conver to a datatable. Check for <a
                                    href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more
                                    examples</a>.</p>



                            <!-- Default Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Video</th>
                                        <th scope="col">Name (Uz)</th>
                                        <th scope="col">Name (Ru)</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="film_miror">
                                    @if ($films && count($films) > 0)
                                        @foreach ($films as $film)
                                            <tr>
                                                <td>{{ $film->id }}</td>
                                                <td>{{ $film->category->name_ru }} | {{ $film->category->name_uz }}</td>
                                                <td>{{ $film->brand->name }}</td>
                                                <td>
                                                    <a
                                                        href="{{ $film->filmImagePath() }}{{ $film->film_image[0]['path'] }}">
                                                        <img src="{{ $film->filmImagePath() }}{{ $film->film_image[0]['path'] }}"
                                                            alt="{{ $film->name_uz }}" srcset="" width="30"
                                                            height="30">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('UzbekFilmVideo.index', $film->id) }}"
                                                        class="badge bg-info">
                                                        <i>uz</i>
                                                    </a>
                                                    <a href="{{ route('RussianFilmVideo.index', $film->id) }}"
                                                        class="badge bg-info">
                                                        <i>ru</i>
                                                    </a>
                                                </td>
                                                <td>{{ $film->name_uz }}</td>
                                                <td>{{ $film->name_ru }}</td>
                                                <td>{{ $film->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('films.edit', $film->id) }}"class="badge bg-warning">
                                                        <i class="ri-quill-pen-fill"></i>
                                                    </a>
                                                </td>
                                                <td>

                                                    <span class="badge bg-danger">
                                                        <i class="ri-delete-bin-2-fill delete-film"
                                                            id="{{ $film->id }}"></i>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @include('dashboard/film/ajax/film_delete')
                            <!-- End Default Table Example -->
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
