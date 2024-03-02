@extends('dashboard.includes.app')
@section('title', 'Serial')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Films create</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('Admin-Panel.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('films.index') }}">Filmlar</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('films.deleted') }}">O'chirilganlar</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('films.create') }}">Yaratish</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="card col-8 offset-2">
                <div class="card-body">
                    <h5 class="card-title">Film Form</h5>
                    <!-- Vertical Form -->
                    <form class="row g-3" action="{{ route('films.store') }}" enctype="multipart/form-data"
                        autocomplete="off" method="POST">
                        @csrf
                        <div class="col-12">
                            <label for="inputSerialName4" class="form-label">Film janri</label>
                            <select name="category" id="categories" class="form-control">
                                <option value="" disabled selected>Please select a genre first</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name_uz }} | {{ $category->name_ru }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <div class="col-12">
                                <label for="inputSerialName4" class="form-label">Film brendi </label>
                                <select name="brand" id="brands" class="hidden">

                                </select>
                                @error('brand')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="inputSerialNanme4" class="form-label">Film nomi uz</label>
                            <input type="text" name="name_uz" value="{{ old('name_uz') }}" class="form-control"
                                id="inputNanme4">
                            @error('name_uz')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputSerialName4" class="form-label">Film nomi ru</label>
                            <input type="text" name="name_ru" value="{{ old('name_ru') }}" class="form-control"
                                id="inputEmail4">
                            @error('name_ru')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputSerialNanme4" class="form-label">Film rasmi</label>
                            <input type="file" name="imagefilm" value="" class="form-control" id="inputNanme4">
                            @error('imagefilm')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" id="send" class="btn btn-primary">Jo'natish</button>
                            <button type="reset" class="btn btn-secondary">Yangilash</button>
                        </div>
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </section>
        @include('dashboard.film.axios.select_brand')


    </main><!-- End #main -->
@endsection
