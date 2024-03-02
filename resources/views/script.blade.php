<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var filmPages = document.querySelectorAll('.film_page');
        var serialPages = document.querySelectorAll('.film_serial');
        filmPages.forEach(function(element) {
            element.addEventListener('click', function() {
                var clickedId = element.id;
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/category/' + categoryId,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        swal({
                            title: "Good luck!",
                            text: response.message,
                            icon: "success",
                            timer: 3000, // Set the timer to 5 seconds (5000 milliseconds)
                            buttons: false // Disable the "Confirm" button
                        });
                        $('#categorymirror').html(response.html);
                    },
                    error: function(xhr, status, error) {
                        alert('Error deleting category');
                    }
                });
            });
        });
    });
</script>
