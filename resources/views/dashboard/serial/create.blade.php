@extends('dashboard.includes.app')
@section('tittle', 'Serial')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Serials create</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('Admin-Panel.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('serial.index') }}">Seriallar</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('serial.create') }}">Yaratish</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="card col-8 offset-2">
                <div class="card-body">
                    <h5 class="card-title">Serials Form</h5>

                    <!-- Vertical Form -->
                    <form class="row g-3" action="{{ route('serial.store') }}" enctype="multipart/form-data"
                        autocomplete="off" method="POST">
                        @csrf
                        <div class="col-12">
                            <label for="inputSerialName4" class="form-label">Serial janri</label>
                            <select name="category" id="categories" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" data-brands="{{ json_encode($category->brands) }}"
                                        {{ $selectedCategory->id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name_uz }} | {{ $category->name_ru }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <div class="col-12">
                                <label for="inputSerialName4" class="form-label">Serial brendi </label>
                                <select name="brand" id="brand" class="form-control">
                                    @foreach ($selectedCategoryBrands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="inputSerialNanme4" class="form-label">Serial nomi uz</label>
                            <input type="text" name="name_uz" value="{{ old('name_uz') }}" class="form-control"
                                id="inputNanme4">
                            @error('name_uz')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputSerialName4" class="form-label">Serial nomi ru</label>
                            <input type="text" name="name_ru" value="{{ old('name_ru') }}" class="form-control"
                                id="inputEmail4">
                            @error('name_ru')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputSerialNanme4" class="form-label">Serial rasmi</label>
                            <input type="file" name="imageserial" value="{{ old('imageserial') }}" class="form-control"
                                id="inputNanme4">
                            @error('imageserial')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Jo'natish</button>
                            <button type="reset" class="btn btn-secondary">Yangilash</button>
                        </div>
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </section>


        <script>
            // Execute the change event function on page load
            document.addEventListener('DOMContentLoaded', function() {
                // Select the first category by default
                var categorySelect = document.getElementById('categories');
                var selectedCategoryBrands = JSON.parse(categorySelect.options[categorySelect.selectedIndex]
                    .getAttribute('data-brands'));
                var brandSelect = document.getElementById('brand');

                // Add brands associated with the selected category
                populateBrandSelect(selectedCategoryBrands);
            });

            // Event listener for changing category
            document.getElementById('categories').addEventListener('change', function() {
                var categorySelect = document.getElementById('categories');
                var brandSelect = document.getElementById('brand');
                var selectedCategoryBrands = JSON.parse(categorySelect.options[categorySelect.selectedIndex]
                    .getAttribute('data-brands'));

                // Clear existing options
                brandSelect.innerHTML = '';

                // Add brands associated with the selected category
                populateBrandSelect(selectedCategoryBrands);
            });

            function populateBrandSelect(brands) {
                var brandSelect = document.getElementById('brand');
                brands.forEach(function(brand) {
                    var option = document.createElement('option');
                    option.value = brand.id;
                    option.textContent = brand.name;
                    brandSelect.appendChild(option);
                });
            }
        </script>


    </main><!-- End #main -->
@endsection
