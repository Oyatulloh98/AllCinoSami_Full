@extends('dashboard.includes.app')
@section('tittle', 'Brand')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Brand Deletes</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('Admin-Panel.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('brand.index') }}">Brendlar</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('brand.deletes') }}">O'chirilganlar</a></li>
                    <li class="breadcrumb-item"><a href=" {{ route('brand.create') }}">Yaratish</a></li>  
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Brand Deletes</h5>
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
                                        <th scope="col">Catgory</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Deleted at</th>
                                        <th scope="col">Restore</th>
                                        <th scope="col">Force Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="branddeletesmirror">
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td>{{ $brand->id }}</td>
                                            <td>{{ $brand->category->name_uz }} | {{ $brand->category->name_ru }}</td>
                                            <td>{{ $brand->name }}</td>
                                            <td>{{ $brand->created_at }}</td>
                                            <td>
                                                <span class="badge bg-success">
                                                    <i class="ri-24-hours-fill restore-brand" id="{{ $brand->id }}"></i>
                                                </span>
                                            </td>
                                            <td>

                                                <span class="badge bg-danger">
                                                    <i class="ri-delete-bin-2-fill forcedelete-brand"
                                                        id="{{ $brand->id }}"></i>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @include('dashboard.brand.script')
                            <!-- End Default Table Example -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
