<x-app-layout>
@php
    $avatarPath = 'uploads/suppliers/';
    $empty = 'uploads/empty-image.jpg';
@endphp
    <main>
        <!-- Header supplier Table -->
        @include('admin.supplier.header')

        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600" id="supplier-table-body">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-all" aria-describedby="checkbox-1" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-all" class="sr-only">checkbox</label>
                                        </div>
                                    </th>
                                    <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Name
                                    </th>
                                    <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Phone Number
                                    </th>
        
                                    <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="myTable" class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @foreach ($suppliers as $supplier)
                                    
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input data-id="{{ $supplier->id }}" aria-describedby="checkbox-1" type="checkbox" class="supplier-checkbox w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-{{ $supplier->id }}" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <td class="flex items-center p-4 mr-12 space-x-6 whitespace-nowrap">
                                        <img class="w-10 h-10 rounded-full" src="{{ $supplier->avatar ? asset($avatarPath . $supplier->avatar) : asset($empty) }}" alt="supplier Avatar">
                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                            <div class="text-base font-semibold text-gray-900 dark:text-white">{{ $supplier->name }}</div>
                                            <div class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $supplier->suppliername }}</div>
                                        </div>
                                    </td>
                                    <td class="max-w-sm p-4 overflow-hidden text-base font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">{{ $supplier->phone }}</td>
                                    <td class="p-4 space-x-2 whitespace-nowrap">
                                        <button id="EditsupplierBtn" value="{{ $supplier->id }}" type="button" data-modal-target="edit-supplier-modal" data-modal-toggle="edit-supplier-modal" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                            Edit supplier
                                        </button>
                                        <button id="delete-supplier-btn" type="button" value="{{ $supplier->id }}" data-modal-target="delete-supplier-modal" data-modal-toggle="delete-supplier-modal" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                            Delete supplier
                                        </button>
                                    </td>
                                </tr>
                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- {{ $suppliers->links('vendor/pagination/tailwind-ui') }} --}}
        
        
        <!-- Edit supplier Modal -->
        @include('admin.supplier.edit')
        
        <!-- Add supplier Modal -->
        @include('admin.supplier.create')
        
        
        <!-- Delete supplier Modal -->
        @include('admin.supplier.delete')
        
        <!-- Delete supplier Modal Checkbox -->
        @include('admin.supplier.delete-checkbox')


    </main>
</x-app-layout>


<script>
    // Search supplier in header file
    $(document).ready(function(){
        //#myInput is id for search input
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();

        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        
      });
    


    // Handle 'Select All' checkbox
    $('#checkbox-all').on('change', function () {
        $('.supplier-checkbox').prop('checked', $(this).prop('checked'));
    });

    // If any individual checkbox is unchecked, uncheck 'Select All'
    $('.supplier-checkbox').on('change', function () {
        if ($('.supplier-checkbox:checked').length === $('.supplier-checkbox').length) {
            $('#checkbox-all').prop('checked', true);
        } else {
            $('#checkbox-all').prop('checked', false);
        }
    });

});

</script>


<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<!-- export excel -->
 <script>
    function exportTableToExcel(tableId, filename = 'Product_Analysis_Report_Details.xlsx') {
        const table = document.getElementById(tableId);
        const workbook = XLSX.utils.table_to_book(table, {
            sheet: "Sheet1"
        });
        XLSX.writeFile(workbook, filename);
    }
 </script>