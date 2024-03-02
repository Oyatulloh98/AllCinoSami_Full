@extends('dashboard.includes.app')
@section('tittle', 'Serial')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Serials create</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('serial.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('UzbekSerialVideo.index', $serial->id) }}">Seriallar</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="card col-8 offset-2">
                <div class="card-body">
                    <h5 class="card-title">Serials Form only uzbek serial create</h5>

                    <!-- Vertical Form -->
                    <form id="form" class="row g-3" action="{{ route('UzbekSerialVideo.store', $serial->id) }}"
                        enctype="multipart/form-data" autocomplete="off" method="POST">
                        @csrf
                        <div class="col-12">
                            <label for="inputSerialName4" class="form-label">Serial janri : {{ $serial->category->name_uz }}
                                | {{ $serial->category->name_ru }}</label>
                            <input type="numeric" name="category" hidden value="{{ $serial->category->id }}"
                                class="form-control" id="inputNanme4">
                            @error('category')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <div class="col-12">
                                <label for="inputSerialName4" class="form-label">Serial brendi :
                                    {{ $serial->brand->name }}</label>
                                <input type="numeric" name="brand" hidden value="{{ $serial->brand->id }}"
                                    class="form-control" id="inputNanme4">
                                @error('brand')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="inputSerialNanme4" class="form-label">Serial nomi uz :
                                {{ $serial->name_uz }}</label>
                            <input type="text" name="name_uz" hidden value="{{ $serial->id }}" class="form-control"
                                id="inputNanme4">
                            @error('name_uz')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputSerialName4" class="form-label">Serial nomi ru :
                                {{ $serial->name_ru }}</label>
                            <input type="text" name="name_ru" hidden value="{{ $serial->id }}" class="form-control"
                                id="inputEmail4">
                            @error('name_ru')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <input type="hidden" id="serial_id" value="{{ $serial->id }}">
                            <label for="inputSerialNanme4" class="form-label">Serial qismi</label>
                            <input type="number" id="serial" name="part" value="{{ old('part') }}"
                                class="form-control" id="inputNanme4">
                            <div id="error-input" class="alert alert-danger mt-1 hidden">Bunday serial mavjud !</div>

                        </div>
                        <div class="col-12">
                            <label for="inputSerialNanme4" class="form-label">Serial Video</label>
                            <input type="file" name="serialvideo" value="{{ old('imageserial') }}" class="form-control"
                                id="inputNanme4">
                            @error('serialvideo')
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
            var serial = document.getElementById('serial');
            var serialId = document.getElementById('serial_id').value;
            var errorInput = document.getElementById('error-input');
            var btn = document.getElementById('btn');
            serial.addEventListener('input', function(event) {
                var value = event.target.value;

                // So'rovni yuborish
                axios.get('http://127.0.0.1:8000/api/serial_uzbek_video_suitable_recipient', {
                        params: {
                            serial_id: serialId,
                            part: value
                        }
                    })
                    .then(function(response) {
                        // So'rov natijasini qabul qilish

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
