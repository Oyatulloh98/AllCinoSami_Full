@extends('dashboard.includes.app')
@section('tittle', 'Category')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Janrlar</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('Admin-Panel.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Janrlar</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('category.deletes') }}">O'chirilganlar</a></li>
                    <li class="breadcrumb-item"><a href=" {{ route('category.create') }}">Yaratish</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Janrlar</h5>
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
                                        <th scope="col">Name (Uz)</th>
                                        <th scope="col">Name (Ru)</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="categorymirror">
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name_uz }}</td>
                                            <td>{{ $category->name_ru }}</td>
                                            <td>{{ $category->created_at }}</td>
                                            <td>
                                                <a
                                                    href="{{ route('category.edit', $category->id) }}"class="badge bg-warning">
                                                    <i class="ri-quill-pen-fill"></i>
                                                </a>
                                            </td>
                                            <td>

                                                <span class="badge bg-danger">
                                                    <i class="ri-delete-bin-2-fill delete-category"
                                                        id="{{ $category->id }}"></i>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @include('dashboard.category.script')
                            <!-- End Default Table Example -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
