<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    var deleteruvideoserialparts = document.querySelectorAll('.deleteserialpart');
    var ruserialvideoforcedeletes = document.querySelectorAll('.deleteserial');

    // Iterate over each element and add an event listener
    deleteruvideoserialparts.forEach(function(deleteruvideoserialpart, index) {
        deleteruvideoserialpart.addEventListener('click', function() {
            var id = this.querySelector('i').getAttribute('id');

            axios.get('http://127.0.0.1:8000/api/serial_russian_video_remuve_or_put', {
                    params: {
                        serial_id: id,
                    }
                })
                .then(function(response) {
                    // console.log(response.data);
                    if (response.data.success == true) {
                        deleteruvideoserialpart.querySelector('i').textContent = 'noactive';
                        deleteruvideoserialpart.classList.replace('bg-success',
                            'bg-danger');
                        ruserialvideoforcedeletes[index].classList.remove('hidden')
                    } else {
                        deleteruvideoserialpart.querySelector('i').textContent = 'active';
                        deleteruvideoserialpart.classList.replace('bg-danger',
                            'bg-success');
                        ruserialvideoforcedeletes[index].classList.add('hidden')
                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
        });
    });
    ruserialvideoforcedeletes.forEach(function(ruserialvideoforcedelete) {
        ruserialvideoforcedelete.addEventListener('click', function() {
            var id = this.querySelector('i').getAttribute('id');
            // alert(1);
            axios.get('http://127.0.0.1:8000/api/serial_russian_video_compolately_destroy', {
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
