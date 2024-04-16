
<x-layout>
    @slot('title', )
    @slot('body')

    

<script>
  @if(Session::has('success'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
    "positionClass": "toast-top-center",
    "showDuration": "300",                     
  }
  		toastr.success("{{ session('success') }}");
  @endif
  
    @if (Session::has('message'))
                    toastr.options = {
                        "closeButton": true,
                        "positionClass": "toast-top-center",
                        "showDuration": "300",
                    }
                    toastr.success("{{ session('message') }}");
      @endif
</script>



<div class="main-content">
    <div class="page-content">
       
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title"> Customer WishList</h4>
                            </div>

{{-- 
                            <a class="btn btn-primary add-list btn-sm text-white" href="{{route('admin.setting.showpages')}}"><i
                                    class="las la-plus mr-3"></i>Add Pages</a> --}}
                        </div>


                        <div class="card-body">
                            <div class="table-responsive-lg">
                                <table class="datatable table table-striped table-bordered ">
                                    <thead>
                                        <tr class="ligth">
                                            <th>Sys ID</th>
                                            <th>Customer Name</th>
                                            <th>Book Title</th>
                                            <th>publisher</th>
                                            <th>Status</th>
                                            <th>Created on</th>
                                            <th>Action</th>
                                            {{-- <th class="text-center">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
      
                                <script type="text/javascript">
                                    $(function() {
                                        var i = 1;
                                        var table = $('.datatable').DataTable({
                                            processing: true,
                                            serverSide: true,
                                            ajax: "{{ route('central.wishlist') }}",
                                            buttons: [
                                                {
                                                    extend: 'collection',
                                                    text:    'Export',
                                                    buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
                                                    className: 'custom-exp-btn',
                                                },
                                            ],
                                            columns: [{
                                                    data: 'id',
                                                    name: 'id'
                                                },
                                                {
                                                    data: 'customer.name',
                                                    name: 'customer.name'
                                                },
                                                {
                                                    data: 'product.title',
                                                    name: 'product.title'
                                                },
                                                {
                                                    data: 'publisher.store_name',
                                                    name: 'publisher.store_name'
                                                },
                                                {
                                                    data: 'status',
                                                    name: 'status'  
                                                },
                                                {
                                                    data: 'created_at',
                                                    name: 'created_at'
                                                },
                                                {
                                                    data: 'action',
                                                    name: 'action',
                                                    orderable: false,
                                                    searchable: false
                                                },
                                            ],
                                            colReorder: true,
                                            dom: 'lBfrtip',
                                            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 100]],
                                            select: true,
                                        });

                                    });
                                </script>

                            </div>
                        </div>
                        <!-- end card body -->
                        
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
</div>

@endslot
</x-layout>