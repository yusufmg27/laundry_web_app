<style>
    .dataTables_filter {
        display: flex;
        justify-content: flex-end;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                    <a href="{{ route('create.order') }}" class="btn btn-primary text-white font-bold px-4 rounded mt-2">Create Order</a>
                    @endif
                </div>
                <div class="table-responsive">
                    <div class="container mt-1 mb-4">
                        <table id="myTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Order Code</th>
                                    <th>Quantity</th>
                                    <th>Costumer</th>
                                    <th>Service</th>
                                    <th>Payment Status</th>
                                    <th>Laundry Status</th>
                                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                                    <th>Action</th>
                                    @endif
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
                ajax: "{{ route('order.index') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'order_code', name: 'order_code'},
                {data: 'quantity', name: 'quantity'},
                {data: 'customer_id', name: 'customer_id'},
                {data: 'service_id', name: 'service_id'},
                {data: 'payment_status', name: 'payment_status'},
                {data: 'status', name: 'status'},
                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                {data: 'action', name: 'action'},
                @endif
                ]
            });
        });
        
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
        $(document).on('click', '.delete', function(){
            var userId = $(this).data("id");
            if(confirm("Are you sure you want to delete this order?")) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('order.destroy') }}",
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
            window.location.href = "{{ route('order.edit') }}?id=" + userId;
        });
        @endif
        
    </script>
</x-app-layout>