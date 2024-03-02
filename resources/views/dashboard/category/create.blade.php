@extends('dashboard.includes.app')
@section('tittle', 'Category')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Janrlar yaratish</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('Admin-Panel.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Janrlar</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('category.deletes') }}">O'chirilganlar</a></li>
                    <li class="breadcrumb-item"><a href=" {{ route('category.create') }}">Yaratish</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="card col-8 offset-2">
                <div class="card-body">
                    <h5 class="card-title">Janr formasi</h5>

                    <!-- Vertical Form -->
                    <form class="row g-3" action="{{ route('category.store') }}" autocomplete="off" method="POST">
                        @csrf
                        <div class="col-12">
                            <label for="inputSerialNanme4" class="form-label">Janr nomi uz</label>
                            <input type="text" name="name_uz" class="form-control" id="inputNanme4">
                            @error('name_uz')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputSerialName4" class="form-label">Janr nomi ru</label>
                            <input type="text" name="name_ru" class="form-control" id="inputEmail4">
                            @error('name_ru')
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

    </main><!-- End #main -->
@endsection
