<x-layout>
   @slot('title',)
    @slot('body')

    <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">


                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Author List</h4>
                                    </div>
                                        @if (isadmin() || isPublisher())
                                        <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"  href="{{ route('author.add') }}"><i class="mdi mdi-plus me-1"></i> Add Author</a>
                                        @endif
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive-lg">
                                        <table class=" datatable table   table-striped table-bordered ">
                                            <thead>
                                                <tr class="ligth">
                                                    <th>sys id</th>
                                                    <th>Author Name</th>
                                                    <th>Status</th>
                                                    <th>Updated At</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            {{-- <tbody>
                                            @foreach($author as $authors)
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$authors->name}}</td>
                                            <td>{{$authors->description}}</td>
                                            <td class="btn-group">
                                            <a href="{{Route('author.edit',[$authors->id])}}"><button type="button" class="btn btn-warning btn-sm tooltip1" data-bs-target="#edit"> 
                                                 <i class="fas fa-edit"></i> <span> Edit Category </span>
                                            </button></a>
        
                                            <a href="{{Route('author.delete',[$authors->id])}}"><button type="button" id="delete10" class="btn btn-danger btn-sm tooltip1">
                                                <i class="fas fa-trash-alt"></i> <span> Delete Category </span>
                                            </button></a>
                                            </td>
                                            </tr>
                                            @endforeach
                                            </tbody> --}}
                                        </table>
                                        <script type="text/javascript">
                                            $(function() {
                                                var i = 1;
                                                var table = $('.datatable').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: "{{ route('auth.index') }}",

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
                                                            data: 'name',
                                                            name: 'name'
                                                        },
                                                        {
                                                            data: 'status',
                                                            name: 'status',
                                                            "render": function(data, type, full, meta) {
                                                            if (data.toLowerCase() == 'active') {
                                                                return "<span class='badge bg-success'>Active</span>";
                                                            } 
                                                            else {
                                                                return "<span class='badge bg-danger'>Block</span>";
                                                                } 
                                                            }
                                                        },
                                                        {
                                                            data: 'updated_at',
                                                            name: 'updated_at',
                                                            render: function(data, type, full, meta) {
                                                                return moment(data).format('DD-MM-YYYY'); // Format to dmY
                                                            }
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
                            </div>
                        </div>
                    </div>
                    <!-- Button trigger modal -->
                </div>
            </div>
        </div>


    @endslot
</x-layout>
