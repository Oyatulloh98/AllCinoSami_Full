<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        // Event delegation for delete-category buttons
        $(document).on('click', '.delete-brand', function() {
            var brandId = $(this).attr('id');
            if (confirm("Are you sure you want to delete this brand?")) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/brand/' + brandId,
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
                        $('#brandmirror').html(response.html);
                    },
                    error: function(xhr, status, error) {
                        alert('Error deleting category');
                    }
                });
            }
        });

        // Event delegation for restore-category buttons
        $(document).on('click', '.restore-brand', function() {
            var restoreid = $(this).attr('id');
            if (confirm("Are you sure you want to restore this Brand?")) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/rebrand/' + restoreid,
                    type: 'POST',
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
                        $('#branddeletesmirror').html(response.html);
                    },
                    error: function(xhr, status, error) {
                        alert('Error restoring brand');
                    }
                });
            }
        });

        // Event delegation for forcedelete-category buttons
        $(document).on('click', '.forcedelete-brand', function() {
            var forcedeleteid = $(this).attr('id');
            if (confirm("Are you sure you want to force delete this brand?")) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/forcedeletebrand/' + forcedeleteid,
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
                        $('#branddeletesmirror').html(response.html);
                    },
                    error: function(xhr, status, error) {
                        alert('Error force deleting category');
                    }
                });
            }
        });
    });
</script>
