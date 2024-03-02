@extends('dashboard.includes.app')
@section('tittle', 'Serial')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>O'chirilgan Seriallar</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('Admin-Panel.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('serial.index') }}">Seriallar</a></li>
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
                                        <th scope="col">Restore</th>
                                        <th scope="col">Force Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="serialmirrordeletes">
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
                                                <a href="{{ route('uzserialvideo.index', $serial->id) }}"
                                                    class="badge bg-info">
                                                    <i>uz</i>
                                                </a>
                                                <a href="{{ route('ruserialvideo.index', $serial->id) }}"
                                                    class="badge bg-info">
                                                    <i>ru</i>
                                                </a>
                                            </td>
                                            <td>{{ $serial->name_uz }}</td>
                                            <td>{{ $serial->name_ru }}</td>
                                            <td>{{ $serial->created_at }}</td>
                                            <td>
                                                <span class="badge bg-success">
                                                    <i class="ri-24-hours-fill restore-serial"
                                                        id="{{ $serial->id }}"></i>
                                                </span>
                                            </td>
                                            <td>

                                                <span class="badge bg-danger">
                                                    <i class="ri-delete-bin-2-fill forcedelete-serial"
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
