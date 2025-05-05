<div class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full"
    id="edit-student-modal">
    <div class="relative w-full h-full max-w-2xl px-4 md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
                <h3 class="text-xl font-semibold dark:text-white">
                    Edit student
                </h3>
                <button type="button" id="closeform"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                    data-modal-toggle="edit-student-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form id="update-student-form" enctype="multipart/form-data">
                    <x-students-form />
                    <!-- Modal footer -->
                    <div class="items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-700">
                        <button class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="submit">Add student</button>
                    </div>
                </form>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#closeform').on('click', function(e){
            e.preventDefault();
            $('#studentCreateForm')[0].reset();

        });



        $(document).on('click', '.edit-student-btn', function(e) {
            e.preventDefault();
            var id = $(this).val();
            $('#update-student-form')[0].reset();

            $.ajax({
                type: "POST",
                url: "{{ route('admin.student.edit') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                success: function(response) {
                    $('#id').val(response.id);
                    $('#fname').val(response.fname);
                    $('#lname').val(response.lname);
                    $('#email').val(response.email);
                    $('#dob').val(response.dob);

                    $('#village').val(response.address?.village ?? '');
                    $('#commune').val(response.address?.commune ?? '');
                    $('#district').val(response.address?.district ?? '');
                    $('#province').val(response.address?.province ?? '');

                    $('#class').val(response.class_id ?? '').change();
                    $('#gender').val(response.gender ?? '').change();
                },
                error: function(xhr) {
                    alert("Something went wrong. Please try again.");
                }
            });
        });


        $('#edit-student-btn').on('submit', function(e){
            e.preventDefault();
            var data = $('#edit-student-btn').serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('admin.student.update') }}",
                data: {
                    "_token":"{{ csrf_token() }}",
                    data:data
                },
                dataType: "json",
                success: function (response) {
                    if (response.error) {
                        printErrorMsg(response.error);
                    } else {
                        // alert(response.success);
                        $("#close-form").click();
                        location.reload();

                    }
                },
                error: function(xhr) {
                    alert("An error occurred. Please try again.");
                    console.log(xhr.responseText);
                }
            });

            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function(key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }
        });

    });
</script>
