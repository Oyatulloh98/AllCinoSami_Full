    <!-- Films section starts -->
    @if (isset($films) && count($films) > 0)
        <section class="films" id="films">
            <div class="heading">
                <span>our films</span>
                <h1>the best movies </h1>
            </div>
            <div class="box-container">
                @foreach ($films as $film)
                    <div class="box" style="max-width: 330px">
                        <div class="img">
                            <img src="{{ $film->filmImagePath() }}{{ $film->film_image[0]['path'] }}" alt="">
                        </div>
                        <div class="content">
                            <h3>{{ $film->name_uz }}</h3>
                            <p>Filmning janiri {{ $film->category->name_uz }} brendi esa {{ $film->brand->name }}</p>
                            <div class="viws">
                                <a href="{{ route('AllCino.view', $film->id) }}">view film <i
                                        class="fas fa-angle-right"></i></a>
                                <span><i class="fas fa-eye"></i> ( 10000000 ) views</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="paginator_for_film">
                {{ $films->appends(['serials' => $serials->currentPage()])->links() }}
            </div>
        </section>


    @endif
    <!-- Films section end -->
