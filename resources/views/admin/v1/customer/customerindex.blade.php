
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
                                <h4 class="card-title"> Customer List</h4>
                            </div>


                            <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                            href="{{route('retail.view')}}"><i class="mdi mdi-plus me-1"></i>New Customer
                            </a>
                        </div>


                        <div class="card-body">
                            <div class="table-responsive-lg">
                                <table class=" datatable table align-middle table-nowrap table-check" id="datatable">
                                    <thead>
                                        <tr class="ligth">
                                            <th>Sys id</th>
                                            <th>Customer Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Dist</th>
                                            <th>Wish list</th>
                                            <th>Last Purchased Date</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
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
                                            ajax: "{{ route('retail.customer') }}",

                                            buttons: [{
                                                    extend: 'collection',
                                                    text: 'Export',
                                                    buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
                                                    className: 'custom-exp-btn',
                                                }, ],

                                            columns: [{
                                                    data: 'id',
                                                    name: 'id'
                                                },
                                                {
                                                    data: 'customer.name',
                                                    name: 'customer.name'
                                                },
                                                {
                                                    data: 'customer.email',
                                                    name: 'customer.email'
                                                },
                                                {
                                                    data: 'customer.phone',
                                                    name: 'customer.phone'
                                                },
                                                {
                                                    data: 'customer.cus_address.city',
                                                    name: 'customer.cus_address.city'
                                                },
                                                {
                                                    defaultContent: 'null'
                                                },
                                                {
                                                    defaultContent: 'null'
                                                },
                                                {
                                                    data: 'status',
                                                    name: 'status'
                                               
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
                                                lengthMenu: [
                                                    [10, 25, 50, -1],
                                                    [10, 25, 50, 100]
                                                ],
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