<div>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
</div>



{{-- <script>
    $(document).ready(function() {
        $('#EditstudentForm').on('submit', function(e) {
            e.preventDefault();
            var data = $('#studentCreateForm').serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('student.edit') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    data: data
                },
                success: function(response) {
                    // alert("Successfully submitted!");
                    $('#SubmitForm')[0].reset(); // Reset form
                },
                error: function(xhr) {
                    console.error("Error:", xhr.responseText);
                    alert("An error occurred!");
                }
            });
        })



    });
</script> --}}
