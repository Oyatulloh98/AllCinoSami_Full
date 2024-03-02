@extends('dashboard.includes.app')
@section('tittle', 'Serial')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Serials create</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('serial.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('UzbekSerialVideo.index', $serialUzVideo->serial_id) }}">Seriallar</a>
                    </li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="card col-8 offset-2">
                <div class="card-body">
                    <h5 class="card-title">Serials Form</h5>

                    <!-- Vertical Form -->
                    <form id="form" class="row g-3" action="{{ route('UzbekSerialVideo.update', $serialUzVideo->id) }}"
                        enctype="multipart/form-data" autocomplete="off" method="POST">
                        @csrf
                        @method('PUT')
                        @if ($serialUzVideo->category_for_uz_video != null)
                            <div class="col-12">
                                <label for="inputSerialName4" class="form-label">Serial janri :
                                    {{ optional($serialUzVideo->category_for_uz_video)->name_uz }}
                                    | {{ optional($serialUzVideo->category_for_uz_video)->name_ru }}</label>
                            </div>
                        @endif

                        @if ($serialUzVideo->brand_for_uz_video != null)
                            <div class="col-12">
                                <div class="col-12">
                                    <label for="inputSerialName4" class="form-label">Serial brendi :
                                        {{ $serialUzVideo->brand_for_uz_video->name }}</label>
                                </div>
                            </div>
                        @endif

                        @if ($serialUzVideo->serial_for_serial_video != null)
                            <div class="col-12">
                                <label for="inputSerialName4" class="form-label">Serial nomi :
                                    {{ optional($serialUzVideo->serial_for_serial_video)->name_uz }}
                                    | {{ optional($serialUzVideo->serial_for_serial_video)->name_ru }}</label>
                            </div>
                        @endif
                        @if ($serialUzVideo != null)
                            <div class="col-12">
                                <label for="inputSerialNanme4" class="form-label">Serial o'zgartirilayotgan qismi :
                                    {{ $serialUzVideo->part }}</label>
                                <input type="hidden" id="serial_id"
                                    value="{{ $serialUzVideo->serial_for_serial_video->id }}" class="form-control"
                                    id="inputNanme4">
                                <input type="hidden" id="video_id"
                                    value="{{ $serialUzVideo->id }}" class="form-control"
                                    id="inputNanme4">
                                <input type="number" id="serial" name="part" value="" class="form-control"
                                    id="inputNanme4">
                                <div id="error-input" class="alert alert-danger mt-1 hidden">Bunday serial mavjud !</div>
                            </div>
                            @error('part')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        @endif
                        @if ($serialUzVideo != null)
                            <div class="col-12">
                                <label for="inputSerialNanme4" class="form-label">Serial Video : <a
                                        href="{{ $serialUzVideo->serial_uz_video_path() }}{{ $serialUzVideo->path }}">
                                        <video
                                            src="{{ $serialUzVideo->serial_uz_video_path() }}{{ $serialUzVideo->path }}"
                                            class="img img-thumbnail" width="40" style="height: 30px">
                                    </a>
                                </label>
                                <input type="file" name="serialvideo" value="" class="form-control"
                                    id="inputNanme4">
                                @error('serialvideo')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
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
            var serial_part = document.getElementById('serial');
            var serialId = document.getElementById('serial_id').value;
            var videoId = document.getElementById('video_id').value;
            var errorInput = document.getElementById('error-input');
            var btn = document.getElementById('btn');
            serial_part.addEventListener('input', function(event) {
                var value = event.target.value;

                // So'rovni yuborish
                axios.get('http://127.0.0.1:8000/api/serial_uzbek_video_for_update_get_part', {
                        params: {
                            serial_id: serialId,
                            video_id: videoId,
                            part: value
                        }
                    })
                    .then(function(response) {
                        // console.log(response.data);
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
