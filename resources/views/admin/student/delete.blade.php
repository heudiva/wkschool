<div class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full" id="delete-student-modal">
    <div class="relative w-full h-full max-w-md px-4 md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex justify-end p-2">
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white" data-modal-hide="delete-student-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>
            <!-- Modal body -->
            <form id="form-delete-student">

                <input type="text" id="ids" name="id">
                <div class="p-6 pt-0 text-center">
                    <svg class="w-16 h-16 mx-auto text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mt-5 mb-6 text-lg text-gray-500 dark:text-gray-400">Are you sure you want to delete this student?</h3>
                    <button id="confirm-delete-student-btn" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2 dark:focus:ring-red-800">
                        Yes, I'm sure
                    </button>
                    <a href="#" class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700" data-modal-hide="delete-student-modal">
                        No, cancel
                    </a>
                </div>
            </form>

    </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $(document).on('click', '#delete-student-btn', function(e){
          e.preventDefault();
          var id=$(this).val();
          
          $.ajax({
            type: "POST",
            url: "{{ route('admin.student.delete') }}",
            data: {
                "_token":"{{ csrf_token() }}",
                id:id
              },
            success: function (response) {
                $('#ids').val(response.id);
            },
                error: function(xhr) {
                    console.error("Error:", xhr.responseText);
                    alert("An error occurred!");
                }
          });
        });

        $('#form-delete-student').on('submit', function(e){
            e.preventDefault();
            var data = $('#form-delete-student').serialize();  // Serialize form data

            $.ajax({
                type: "POST",
                url: "{{ route('admin.student.destroy') }}",
                data: {
                    "_token":"{{ csrf_token() }}",
                    data:data
                },
                dataType: "json",
                success: function (response) {
                    location.reload();
                },
                error: function(xhr) {
                  console.error("Error:", xhr.responseText);
                  alert("An error occurred!");
              }
            });

        });



    });
</script>