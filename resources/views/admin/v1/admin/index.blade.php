<x-layout>
    @slot('title', $page)
    @slot('body')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        {{-- <h4 class="card-title">{{ $type }} List</h4> --}}
                                        <h4 class="card-title">Users List</h4>
                                    </div>


                                    <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"  href="{{ route('admin.create')}}" ><i class="mdi mdi-plus me-1"></i>Add User</a>
                                      
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive-lg">
                                        <table class=" datatable table table-bordered table-striped ">
                                            <thead>
                                                <tr class="ligth">
                                                    <th>Sys ID</th>
                                                    <th>Email</th>
                                                    <th>Name</th>
                                                    <th>Roles</th>
                                                    <th>Type</th>
                                                    <th>Store/Pub</th>
                                                    <th>Last Login</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>

                                        </table>
                                        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

                                        <script type="text/javascript">
                                            $(function() {
                                                var i = 1;
                                                var table = $('.datatable').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                 ajax: "{{ route('admin.index') }}",

                                                 buttons: [
                                                             {
                                                                extend: 'collection',
                                                                text: 'Export',
                                                                buttons: ['copy', 'excel', 'csv', 'pdf', 'print']
                                                             }
                                                           ],
                                                
                                                    columns: [{
                                                            data: 'id',
                                                            name: 'id'
                                                        },
                                                        {
                                                            data: 'email',
                                                            name: 'email'
                                                        },
                                                        {
                                                            data: 'name',
                                                            name: 'name'
                                                        },
                                                        {
                                                            data: 'role.name',
                                                            name: 'role.name'
                                                        },
                                                        {
                                                            data: 'type',
                                                            name: 'type'
                                                        },
                                                        {
                                                            data: 'store.store_name',
                                                            name: 'store.store_name',
                                                            defaultContent: "null"
                                                        },
                                                        {
                                                            data: 'last_login',
                                                            name: 'last_login'
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
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div> <!-- container-fluid -->
            </div>
        </div>
        <!-- Button trigger modal -->



        <!-- The Modal -->
        <div class="modal fade" id="show">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h6 class="modal-title">View {{ $page }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body" id="show_form">

                    </div>
                </div>
            </div>
        </div>
        <!-- // model -->

        <!-- The Modal -->
        <div class="modal fade" id="password_change">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h6 class="modal-title">Change Password {{ $page }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body" id="password_change_form">

                    </div>
                </div>
            </div>
        </div>
        <!-- // model -->
    @endslot
</x-layout>
