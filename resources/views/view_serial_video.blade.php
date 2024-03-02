<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Cino</title>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- local css file link -->
    <link rel="stylesheet" href="/allcinovideosrc/style.css">

</head>

<body>
    <div>

        <div class="header">

        </div>

        <div class="container">
            <div class="main-video">
                <div class="video">
                    <video src="{{ asset('allcinosrc/video/video.mp4') }}" controls autoplay muted></video>
                    <h3 class="title">1 Sarlavha uchun</h3>
                </div>
            </div>
            <div class="video-list">
                @foreach ($uz_serial_video as $item)
                    <div class="vid">
                        <video src="{{ $item->serial_uz_video_path() }}{{ $item->path }}"></video>
                        <h3 class="title">{{ $item->serial_for_serial_video->name_uz }} : {{$item->part}} - qism</h3>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script src="/allcinovideosrc/script.js"></script>
</body>

</html>