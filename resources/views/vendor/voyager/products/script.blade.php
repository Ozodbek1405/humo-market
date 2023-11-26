<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'description' );
    $(function () {
        $('#product_color').each(function () {
            $(this).select2({
                theme: 'bootstrap4',
                width: 'style',
                allowClear: Boolean($(this).data('allow-clear')),
            });
        });
        $('#product_size').each(function () {
            $(this).select2({
                theme: 'bootstrap4',
                width: 'style',
                allowClear: Boolean($(this).data('allow-clear')),
            });
        });
        $('#product_shoe_size').each(function () {
            $(this).select2({
                theme: 'bootstrap4',
                width: 'style',
                allowClear: Boolean($(this).data('allow-clear')),
            });
        });
        $('#parent_id').each(function () {
            $(this).select2({
                theme: 'bootstrap4',
                width: 'style',
                allowClear: Boolean($(this).data('allow-clear')),
            });
        });
    });
    $('#parent_category').on('change', function() {
        var parent_id = $(this).val();
        if (parent_id !== "") {
            fetchData(parent_id);
        }
    });
    function fetchData(parent_id) {
        $.ajax({
            url: "{{route('getChildCategory')}}",
            method: 'GET',
            data: { parent_id: parent_id },
            dataType: 'json',
            success: function(data) {
                getChildCategories(data);
            },
            error: function() {
                console.log('Error retrieving data.');
            }
        });
    }
    function getChildCategories(data) {
        var child_category = $('#child_category');
        child_category.empty();
        for (var i = 0; i < data.data.length; i++) {
            var option = $('<option></option>').attr('value', data.data[i].id).text(data.data[i].name);
            child_category.append(option);
        }
    }
    $(document).ready(function() {
        var parent_id = $('#parent_category').val();
        fetchData(parent_id);
    });
</script>
