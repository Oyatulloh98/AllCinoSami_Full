@extends('dashboard.includes.app')
@section('tittle', 'Serial')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Seriallar</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('Admin-Panel.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('serial.index') }}">Seriallar</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('serial.deletes') }}">O'chirilganlar</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('serial.create') }}">Yaratish</a></li>

                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Seriallar</h5>
                            <p>
                                Bu yerga qisaqacha info yoziladi
                            </p>



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
                                <tbody id="serialmirror">
                                    @foreach ($serials as $serial)
                                        <tr>
                                            <td>{{ $serial->id }}</td>
                                            <td>{{ $serial->category->name_ru }} | {{ $serial->category->name_uz }}</td>
                                            <td>{{ $serial->brand->name }}</td>
                                            <td>
                                                <a
                                                    href="{{ $serial->serialImagePath() }}{{ $serial->serial_image[0]['path'] }}">
                                                    <img src="{{ $serial->serialImagePath() }}{{ $serial->serial_image[0]['path'] }}"
                                                        alt="{{ $serial->name_uz }}" srcset="" width="30"
                                                        height="30">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('UzbekSerialVideo.index', $serial->id) }}"
                                                    class="badge bg-info">
                                                    <i>uz</i>
                                                </a>
                                                <a href="{{ route('RussianSerialVideo.index', $serial->id) }}"
                                                    class="badge bg-info">
                                                    <i>ru</i>
                                                </a>
                                            </td>
                                            <td>{{ $serial->name_uz }}</td>
                                            <td>{{ $serial->name_ru }}</td>
                                            <td>{{ $serial->created_at }}</td>
                                            <td>
                                                <a href="{{ route('serial.edit', $serial->id) }}"class="badge bg-warning">
                                                    <i class="ri-quill-pen-fill"></i>
                                                </a>
                                            </td>
                                            <td>

                                                <span class="badge bg-danger">
                                                    <i class="ri-delete-bin-2-fill delete-serial"
                                                        id="{{ $serial->id }}"></i>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @include('dashboard.serial.script')
                            <!-- End Default Table Example -->
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
