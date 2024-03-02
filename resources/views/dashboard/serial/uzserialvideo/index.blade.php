@extends('dashboard.includes.app')
@section('tittle', 'Serial Video UZ')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Seriallar</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('serial.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('UzbekSerialVideo.create', $id) }}">Serial Yaratish</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-8 offset-2">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Serial name : {{ $serial->name_uz }} | {{ $serial->name_ru }} and table
                                uz</h5>
                            <!-- Default Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Part</th>
                                        <th scope="col">Video</th>
                                        <th scope="col">Edit</th>
                                        @if ($serial->deleted_at != null)
                                        @else
                                            <th scope="col">24/7</th>
                                        @endif
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @foreach ($serial_uz_videos as $item)
                                        <tr>
                                            <td>{{ $item->part }}</td>
                                            <td>
                                                <a href="{{ $item->serial_uz_video_path() }}{{ $item->path }}">
                                                    <video src="{{ $item->serial_uz_video_path() }}{{ $item->path }}"
                                                        class="img img-thumbnail" width="30" style="height: 30px">
                                                </a>
                                            </td>
                                            <td>
                                                <a
                                                    href="{{ route('UzbekSerialVideo.edit', $item->id) }}"class="badge bg-info">
                                                    <i class="ri-quill-pen-fill"></i>
                                                </a>
                                            </td>

                                            @if ($serial->deleted_at != null)
                                            @else
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $item->deleted_at == null ? 'success' : 'danger' }} deleteserialpart"
                                                        style="cursor: pointer">
                                                        <i id="{{ $item->id }}"
                                                            style="user-select: none">{{ $item->deleted_at == null ? 'active' : 'noactive' }}</i>
                                                    </span>
                                                </td>
                                            @endif


                                            <td>
                                                {{-- @if ($item->deleted_at != null) --}}
                                                <span class="badge bg-danger deleteserial <?php if ($item->deleted_at === null) {
                                                    echo 'hidden';
                                                } ?>">
                                                    <i class="ri-delete-bin-2-fill " id="{{ $item->id }}"></i>
                                                </span>
                                                {{-- @endif --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Default Table Example -->
                            @include('dashboard.serial.uzserialvideo.action.deletetrue')
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
