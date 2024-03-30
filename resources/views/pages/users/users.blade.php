<style>
    .dataTables_filter {
        display: flex;
        justify-content: flex-end;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- {{ __("You're logged in! Users") }} --}}
                    <a href="{{ route('create.users') }}" class="btn btn-primary text-white font-bold px-4 rounded mt-2">Create Users</a>
                </div>
                <div class="table-responsive">
                    <div class="container mt-1 mb-4">
                        <table id="myTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'role', name: 'role'},
                {data: 'action', name: 'action'},
                ]
            });
        });
        
        $(document).on('click', '.delete', function(){
            var userId = $(this).data("id");
            if(confirm("Are you sure you want to delete this user?")) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('users.destroy') }}",
                    data: {
                        "id": userId,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        $('#myTable').DataTable().ajax.reload();
                    },
                    error: function (data) {
                        console.error('Error:', data);
                    }
                });
            }
        });
        
        
        $(document).on('click', '.edit', function(){
            var userId = $(this).data("id");
            window.location.href = "{{ route('users.edit') }}?id=" + userId;
        });
        
    </script>
</x-app-layout>
