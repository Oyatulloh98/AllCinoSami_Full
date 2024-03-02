<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        // Event delegation for delete-category buttons
        $(document).on('click', '.delete-film', function() {
            var filmId = $(this).attr('id');
            // alert(filmId);
            if (confirm("Are you sure you want to delete this film?")) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/film_one_delete_store/' + filmId,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        // console.log(response.data);
                        swal({
                            title: "Good luck!",
                            text: response.message,
                            icon: "success",
                            timer: 3000, // Set the timer to 5 seconds (5000 milliseconds)
                            buttons: false // Disable the "Confirm" button
                        });
                        $('#film_miror').html(response.html);
                    },
                    error: function(xhr, status, error) {
                        alert('Error deleting category');
                    }
                });
            }
        });

        // Event delegation for restore-category buttons
        $(document).on('click', '.restore-film', function() {
            var restoreid = $(this).attr('id');
            if (confirm("Are you sure you want to restore this Film?")) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/films_restore/' + restoreid,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        // console.log(response.html);
                        if (response.message) {
                            swal({
                                title: "Good luck!",
                                text: response.message,
                                icon: "success",
                                timer: 3000, // Set the timer to 5 seconds (5000 milliseconds)
                                buttons: false // Disable the "Confirm" button
                            });
                        } else {
                            swal({
                                title: "Good luck!",
                                text: response.error,
                                icon: "error",
                                timer: 3000, // Set the timer to 5 seconds (5000 milliseconds)
                                buttons: false // Disable the "Confirm" button
                            });
                        }
                        $('#deleted_film_miror').html(response.html);
                    },
                    error: function(xhr, status, error) {
                        alert('Error restoring brand');
                    }
                });
            }
        });

        $(document).on('click', '.remove-film', function() {
            var filmId = $(this).attr('id');
            if (confirm("Are you sure you want to force delete this Film?")) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/remove_film', // Endpoint matches your route definition
                    type: 'POST',
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: JSON.stringify({
                        id: filmId
                    }), // Sending Film ID as JSON data
                    success: function(response) {
                        if (response.message) {
                            swal({
                                title: "Good luck!",
                                text: response.message,
                                icon: "success",
                                timer: 3000, // Set the timer to 5 seconds (5000 milliseconds)
                                buttons: false // Disable the "Confirm" button
                            });
                        } else {
                            swal({
                                title: "Good luck!",
                                text: response.error,
                                icon: "error",
                                timer: 3000, // Set the timer to 5 seconds (5000 milliseconds)
                                buttons: false // Disable the "Confirm" button
                            });
                        }
                        $('#deleted_film_miror').html(response.html);
                    },
                    error: function(xhr, status, error) {
                        alert('Error force deleting film');
                        // Handle error response here
                    }
                });
            }
        });





    });
</script>
