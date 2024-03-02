<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Cino</title>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- local css file link -->
    <link rel="stylesheet" href="allcinosrc/scss/style.css">

    <!-- local js file link -->
    <script src="allcinosrc/js/script.js" defer></script>

</head>

<body>
    <!-- header section start -->
    <div class="header">

        <div id="menu-btn" class="fas fa-bars"></div>

        <a href="#" class="logo"><img src="allcinosrc/img/logoo.png" alt="" srcset=""></a>
        <nav class="navbar">
            <a href="#home" class="" id="">home</a>
            <a href="#primera" class="" id="">primera</a>
            <a href="#films" class="" id="">films</a>
            <a href="#serials" class="" id="">serials</a>
            <a href="#footer" class="" id="">contact</a>
        </nav>
        @if (1 > 0)
            <a href="{{ route('Admin-Panel.index') }}" class="btn">Admin</a>
        @else
            <a href="#footer" class="btn">Join us</a>
        @endif
    </div>
    <!-- header section end -->

    <!-- home section starts -->
    <section class="home" id="home">
        <div class="content">
            {{-- <span>All Cino</span>
            <h3>Enjoy your day</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat et numquam corrupti alias nesciunt
                quibusdam quisquam perspiciatis deleniti accusantium beatae.</p> --}}
            {{-- <a href="#footer" class="btn">Join us</a> --}}
        </div>
    </section>
    <!-- home section end -->

    <!-- Registration form starts -->
    <section class="registration" id="registration">
        <form action="" method="post">
            <div class="input-box">
                <span>Email</span>
                <input type="email" name="email" placeholder="Email here ...." id="">
            </div>
            <div class="input-box">
                <span>Phone</span>
                <input type="text" name="phone" placeholder="Phone number here ...." id="">
            </div>
            <div class="input-box">
                <span>Password</span>
                <input type="password" name="password" placeholder="Password here ...." id="">
            </div>
            <input type="submit" value="submit" class="btn">
        </form>
    </section>
    <!-- Registration form end -->

    <!-- Primera section starts -->

    <section class="primera" id="primera">
        <div class="video-container">
            <video height="300px" src="allcinosrc/video/Dilnoz - Saharlarda.mp4" controls muted autoplay loop
                class="video"></video>
            <div class="controls">
                <span class="control-btn" data-src="allcinosrc/video/video.mp4"></span>
                <span class="control-btn" data-src="allcinosrc/video/Dilnoz - Saharlarda.mp4"></span>
                <span class="control-btn" data-src="allcinosrc/video/video.mp4"></span>
            </div>
        </div>
        <div class="content">
            <span>Primera date here</span>
            <h3>Film name here</h3>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptates, quibusdam similique temporibus
                dicta cumque debitis!</p>
            <a href="/" class="btnn"> read more </a>
        </div>
    </section>

    <!-- Primera section end -->

    <!-- Films section starts -->

    {{-- @include('render/film_render_for_paginate') --}}

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
                                <a href="{{ route('AllCino_Film_Video.view', $film->id) }}">view film <i
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

    <!-- Serials section starts -->
    @if (isset($serials) && count($serials) > 0)
        <section class="serials" id="serials">
            <div class="heading">
                <span>our serials</span>
                <h1>the best serials</h1>
            </div>
            <div class="box-container">
                @foreach ($serials as $serial)
                    <div class="box">
                        <div class="img">
                            <img src="{{ $serial->serialImagePath() }}{{ $serial->serial_image[0]['path'] }}"
                                alt="" srcset="">
                        </div>
                        <div class="content">
                            <h3>{{ $serial->name_uz }}</h3>
                            <h4>seriyalari <i>( {{ count($serial->serialuzvideo) }} )</i></h4>
                            <p>Serialning janiri {{ $serial->category->name_uz }} va {{ $serial->brand->name }}</p>
                            <div class="viws">
                                <a href="{{ route('AllCino_Serial_Video.view', $serial->id) }}">view serial <i
                                        class="fas fa-angle-right"></i></a>
                                <span><i class="fas fa-eye"></i> ( 10000000 ) views</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="paginator_for_serials">
                {{ $serials->appends(['films' => $films->currentPage()])->links() }}
            </div>
        </section>
    @endif
    <!-- Serials section starts -->

    <!-- Banner section starts -->
    <div class="banner">
        <section>
            <div class="content">
                <span>Spend your day enjoyable with us</span>
                <h3>start your adventure from all cino world</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit quis at exercitationem perferendis
                    obcaecati itaque, similique harum ad dolore quaerat error dolorum esse, ipsa blanditiis nemo eum
                    facilis deserunt deleniti.</p>
                <a href="#register" class="banner_btn">register</a>
            </div>
        </section>
    </div>
    <!-- Banner section end -->

    <!-- Footer section starts -->
    <section class="footer" id="footer">
        <div class="box-container">
            <div class="box">
                <a href="#" class="logo"><img src="allcinosrc/img/logoo.png" alt=""
                        srcset=""></a>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="https://www.youtube.com/@AllCino-xl6iq" class="fab fa-youtube"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="https://t.me/AllCino" class="fab fa-telegram"></a>
                </div>
            </div>
            <div class="box">
                <h3>quick links</h3>
                <a href="#home" class="links"> <i class="fas fa-arrow-right"></i>home </a>
                <a href="#primera" class="links"> <i class="fas fa-arrow-right"></i>primera </a>
                <a href="#films" class="links"> <i class="fas fa-arrow-right"></i>films </a>
                <a href="#serials" class="links"> <i class="fas fa-arrow-right"></i>serials </a>
                <a href="#contact" class="links"> <i class="fas fa-arrow-right"></i>contact </a>
            </div>
            <div class="box">
                <h3>contact info</h3>
                <p> <i class="fas fa-map"></i> Uzbekistan Fergana </p>
                <p> <i class="fas fa-phone"></i> +998 77 010 89 98 </p>
                <p> <i class="fas fa-envelope"></i> oyatullamacoffice@gmail.com </p>
                <p> <i class="fas fa-clock"></i> 09:00am - 10:00pm </p>
            </div>
            <div class="box">
                <h3>newsletter</h3>
                <p>subscribe for latest updates</p>
                <form action="" method="post">
                    <input type="email" name="email" placeholder="enter your email" id=""
                        class="email">
                    <input type="submit" value="submit" class="btn">
                </form>
            </div>
        </div>
    </section>
    <div class="creator">created by <span>mr. web developer</span> | all rights reserved!</div>
    <!-- Footer section end -->

    <script src="/pagination_for_allsrial/film_for_paginate.js"></script>
</body>

</html>
