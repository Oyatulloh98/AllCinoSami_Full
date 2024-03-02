@extends('dashboard.includes.app')
@section('tittle', 'Serial')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Films edit</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('films.index') }}">Home</a></li>
                    </li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="card col-8 offset-2">
                <div class="card-body">
                    <h5 class="card-title">Films Form only russion film update</h5>

                    <!-- Vertical Form -->
                    <form id="form" class="row g-3" action="{{ route('RussianFilmVideo.update', $ru_film->id) }}"
                        enctype="multipart/form-data" autocomplete="off" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <label for="inputSerialNanme4" class="form-label">Film nomi uz :
                                {{ $ru_film->film_for_ru_film->name_uz }}</label>
                            <input type="text" name="name_uz" hidden value="{{ $ru_film->id }}" class="form-control"
                                id="inputNanme4">
                            @error('name_uz')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputSerialName4" class="form-label">Film nomi ru :
                                {{ $ru_film->film_for_ru_film->name_ru }}</label>
                            <input type="text" name="name_ru" hidden value="{{ $ru_film->id }}" class="form-control"
                                id="inputEmail4">
                            @error('name_ru')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <input type="hidden" id="film_id" value="{{ $ru_film->film_for_ru_film->id }}">
                            <input type="hidden" id="video_id" value="{{ $ru_film->id }}">
                            <label for="inputSerialNanme4" class="form-label">Film qismi: {{ $ru_film->part }}</label>
                            <input type="number" id="film" name="part" value="{{ old('part') }}"
                                class="form-control" id="inputNanme4">
                            <div id="error-input" class="alert alert-danger mt-1 hidden">Bunday film mavjud !</div>
                            @error('part')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputSerialNanme4" class="form-label">Film Video:
                                <a href="{{ $ru_film->ru_film_path() }}{{ $ru_film->path }}">
                                    <video src="{{ $ru_film->ru_film_path() }}{{ $ru_film->path }}"
                                        class="img img-thumbnail" width="30" style="height: 30px">
                                </a>
                            </label>
                            <input type="file" name="filmvideo" value="" class="form-control" id="inputNanme4">
                            @error('filmvideo')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button id="btn" type="submit" class="btn btn-primary">Jo'natish</button>
                            <button type="reset" class="btn btn-secondary">Yangilash</button>
                        </div>
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            var film_part = document.getElementById('film');
            var filmId = document.getElementById('film_id').value;
            var videoId = document.getElementById('video_id').value;
            var errorInput = document.getElementById('error-input');
            var btn = document.getElementById('btn');
            film_part.addEventListener('input', function(event) {
                var value = event.target.value;
                axios.get('http://127.0.0.1:8000/api/russion_video_for_update_get_part', {
                        params: {
                            film_id: filmId,
                            video_id: videoId,
                            part: value
                        }
                    })
                    .then(function(response) {
                        console.log(response.data);
                        if (response.data['error']) {
                            if (errorInput.classList.contains('hidden')) {
                                errorInput.classList.remove('hidden');
                                btn.setAttribute('disabled', true);
                            }
                        } else {
                            if (!errorInput.classList.contains('hidden')) {
                                errorInput.classList.add('hidden');
                                btn.removeAttribute('disabled');


                            }
                        }
                    })
                    .catch(function(error) {
                        // Xatolikni qabul qilish
                        console.error('Xatolik:', error);
                    });

            });
        </script>


    </main><!-- End #main -->
@endsection
