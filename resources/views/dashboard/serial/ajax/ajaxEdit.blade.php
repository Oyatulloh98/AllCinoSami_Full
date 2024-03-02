<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#category').change(function() {
            var category_id = $(this).val();
            $.ajax({
                url: "{{ route('getBrandsByCategory') }}",
                type: "GET",
                data: {
                    category_id: category_id
                },
                success: function(data) {
                    $('#brands').empty();
                    $.each(data, function(key, value) {
                        $('#brands').append('<option value="' + value.id + '">' +
                            value.name + '</option>');
                    });
                }
            });
        });
    });
</script>
