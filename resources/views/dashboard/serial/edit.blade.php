@extends('dashboard.includes.app')
@section('tittle', 'Serial')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Serials tahrirlash</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('Admin-Panel.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('serial.index') }}">Seriallar</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('serial.create') }}">Yaratish</a></li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="card col-8 offset-2">
                <div class="card-body">
                    <h5 class="card-title">Serials Update Form</h5>
                    <form class="row g-3" action="{{ route('serial.update', $serial->id) }}" enctype="multipart/form-data"
                        autocomplete="off" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <label for="inputSerialName4" class="form-label">Serial Janr</label>
                            @php
                                $id = old('categories', $serial->category_id);
                            @endphp
                            <label for="inputSerialName4" class="form-label">Category Name</label>
                            <select id="category" name="category" class="form-control">
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" {{ $id == $item->id ? 'selected' : '' }}>
                                        {{ $item->name_uz }} | {{ $item->name_ru }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="inputSerialName4" class="form-label">Serial Brend </label>
                            @php
                                $id = old('brands', $serial->brand_id);
                            @endphp
                            <select id="brands" name="brand" class="form-control">
                                @foreach ($brands as $item)
                                    <option value="{{ $item->id }}" {{ $id == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="inputSerialNanme4" class="form-label">Serial Name uz</label>
                            <input type="text" name="name_uz" value="{{ $serial->name_uz }}" class="form-control"
                                id="inputNanme4">
                            @error('name_uz')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputSerialName4" class="form-label">Serial Name ru</label>
                            <input type="text" name="name_ru" value="{{ $serial->name_ru }}" class="form-control"
                                id="inputEmail4">
                            @error('name_ru')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputSerialNanme4" class="form-label">Serial Image :<a
                                    href="{{ $serial->serialImagePath() }}{{ $serial->serial_image[0]['path'] }}">
                                    <img src="{{ $serial->serialImagePath() }}{{ $serial->serial_image[0]['path'] }}"
                                        class="img img-thumbnail" width="30">
                                </a></label>
                            <input type="file" name="imageserial" value="" class="form-control" id="inputNanme4">
                            @error('imageserial')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form><!-- Vertical Form -->

                </div>
            </div>
            @include('dashboard.serial.ajax.ajaxEdit')
        </section>






    </main><!-- End #main -->
@endsection
