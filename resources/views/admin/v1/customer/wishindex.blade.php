
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


                            <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" type="button"
                                        class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                                         class="mdi mdi-plus me-1"></i>Add
                                        {{ $page }}</a>
                        </div>


                        <div class="card-body">
                            <div class="table-responsive-lg">
                                <table class=" datatable table   table-striped table-bordered ">
                                    <thead>
                                        <tr class="ligth">
                                            <th>Sys id</th>
                                            <th>Product Name</th>
                                            <th>Customer Name</th>
                                            {{-- <th>Store Name</th> --}}
                                            {{-- <th class="text-center">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {{-- @foreach($wishlist as $list)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$list->product->title}}</td>
                                                <td>{{$list->customer->name}}</td>
                                                <td>{{$list->gender}}</td>
                                                 <td>{{$list->status}}</td>
                                                 <td class="text-center">
                                                    <!-- Add action buttons here -->
                                                    {{-- <a href="" class="btn btn-primary btn-sm"><i
                                                            class="fas fa-edit"></i> Edit</a>
                                                    <a href=""
                                                        class="btn btn-danger btn-sm delete-btn" id="deleteRoleBtn"><i
                                                            class="fas fa-ban"></i> Delete</a>  --}}
                                                 {{-- </td>  --}}
                                            {{-- </tr> --}}
                                            {{-- @endforeach --}} 
                                    </tbody>
                                </table>
                                


                                <script type="text/javascript">
                                    $(function() {
                                        var i = 1;
                                        var table = $('.datatable').DataTable({
                                            processing: true,
                                            serverSide: true,
                                            ajax: "{{ route('index.wish') }}",

                                            columns: [{
                                                    data: 'id',
                                                    name: 'id'
                                                },
                                                {
                                                    data: 'product.title',
                                                    name: 'product.title'
                                                },
                                                {
                                                    data: 'customer.name',
                                                    name: 'customer.name'
                                                },
                                                // {
                                                //     data: 'store_name',
                                                //     name: 'store_name'
                                                // },
                                                // {
                                                //     data: 'status',
                                                //     name: 'status'
                                               
                                                //     "render": function(data, type, full, meta) {
                                                //         return "<img src=\"" + data + "\" height=\"50\"/>";
                                                //     },
                                                // },

                                                // {
                                                //     data: 'action',
                                                //     name: 'action',
                                                //     orderable: false,
                                                //     searchable: false
                                                // },
                                            ]
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
       
                    <!-- Modal body -->

    </div>
    
</div>
@include('admin.v1.customer.insert')

<div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="edit" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="edit">Edit {{ $page }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="edit_form">

        </div>

    </div>
</div>
</div>
</div>
@endslot
</x-layout>

