<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        // Event delegation for delete-category buttons
        $(document).on('click', '.delete-category', function() {
            var categoryId = $(this).attr('id');
            if (confirm("Are you sure you want to delete this category?")) {
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
            }
        });

        // Event delegation for restore-category buttons
        $(document).on('click', '.restore-category', function() {
            var restoreid = $(this).attr('id');
            if (confirm("Are you sure you want to restore this category?")) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/recategory/' + restoreid,
                    type: 'POST',
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
                        $('#categorydeletesmirror').html(response.html);
                    },
                    error: function(xhr, status, error) {
                        alert('Error restoring category');
                    }
                });
            }
        });

        // Event delegation for forcedelete-category buttons
        $(document).on('click', '.forcedelete-category', function() {
            var forcedeleteid = $(this).attr('id');
            if (confirm("Are you sure you want to force delete this category?")) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/forcedeletecategory/' + forcedeleteid,
                    type: 'POST',
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
                        // console.log(response.message);
                        $('#categorydeletesmirror').html(response.html);
                    },
                    error: function(xhr, status, error) {
                        alert('Error force deleting category');
                    }
                });
            }
        });
    });
</script>
