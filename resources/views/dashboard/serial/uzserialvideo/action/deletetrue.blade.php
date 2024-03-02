<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    var deleteserialparts = document.querySelectorAll('.deleteserialpart');
    var forcedeletes = document.querySelectorAll('.deleteserial');

    // Iterate over each element and add an event listener
    deleteserialparts.forEach(function(deleteserialpart, index) {
        deleteserialpart.addEventListener('click', function() {
            var id = this.querySelector('i').getAttribute('id');

            axios.get('http://127.0.0.1:8000/api/serial_uzbek_video_remuve_or_put', {
                    params: {
                        serial_id: id,
                    }
                })
                .then(function(response) {
                    if (response.data.success == true) {
                        deleteserialpart.querySelector('i').textContent = 'noactive';
                        deleteserialpart.classList.replace('bg-success',
                            'bg-danger');
                        forcedeletes[index].classList.remove('hidden')
                    } else {
                        deleteserialpart.querySelector('i').textContent = 'active';
                        deleteserialpart.classList.replace('bg-danger',
                            'bg-success');
                        forcedeletes[index].classList.add('hidden')
                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
        });
    });
    forcedeletes.forEach(function(forcedelete) {
        forcedelete.addEventListener('click', function() {
            var id = this.querySelector('i').getAttribute('id');
            // alert(1);
            axios.get('http://127.0.0.1:8000/api/serial_uzbek_video_compolately_destroy', {
                    params: {
                        serial_id: id,
                    }
                })
                .then(function(response) {
                    if (response.data.success == true) {
                        swal({
                            title: "Good luck!",
                            text: response.data
                                .message, // Access message from response.data
                            icon: "success",
                            timer: 3000, // Set the timer to 3 seconds (3000 milliseconds)
                            buttons: false // Disable the "Confirm" button
                        });
                        window.location.reload();
                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
        });
    });
</script>
