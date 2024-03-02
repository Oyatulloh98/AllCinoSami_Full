@extends('dashboard.includes.app')
@section('tittle', 'Brand')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Brand create</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('Admin-Panel.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('brand.index') }}">Brendlar</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('brand.deletes') }}">O'chirilganlar</a></li>
                    <li class="breadcrumb-item"><a href=" {{ route('brand.create') }}">Yaratish</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="card col-8 offset-2">
                <div class="card-body">
                    <h5 class="card-title">Brand Form</h5>

                    <!-- Vertical Form -->
                    <form class="row g-3" action="{{ route('brand.store') }}" autocomplete="off" method="POST">
                        @csrf
                        <div class="col-12">
                            <label for="inputSerialName4" class="form-label">Category </label>
                            <select name="categories" id="categories" name="category_id" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name_uz }} | {{ $category->name_ru }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categories')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputSerialName4" class="form-label">Brand Name</label>
                            <input type="text" name="name" class="form-control" id="inputEmail4">
                            @error('name')
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
        </section>

    </main><!-- End #main -->
@endsection
