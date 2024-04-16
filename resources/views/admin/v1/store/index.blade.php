<x-layout>
    @slot('title', $page)
    @slot('body')

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">{{ $pagename }} List</h4>
                                    </div>


                                    <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" type="button"
                                        class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                                            class="mdi mdi-plus me-1"></i>New 
                                        {{ $pagename }}</a>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive-lg">
                                        <table class=" datatable table   table-striped table-bordered ">
                                            <thead>
                                                <tr class="ligth">
                                                    <th>Store ID</th>
                                                    <th>Store Name</th>
                                                    <th>District</th>
                                                   <th>Primary Emails</th>
                                                    <th>Store Type </th>
                                                    {{-- <th>Logo</th> --}}
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
                                                    ajax: "{{ route('stores.index', [$page]) }}",

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
                                                            data: 'store_name',
                                                            name: 'store_name'
                                                        },
                                                        {
                                                            data: 'district.name',
                                                            name: 'district.name'
                                                        },
                                                        {
                                                            data: 'user.email',
                                                            name: 'user.email'
                                                        },
                                                        {
                                                            data: 'Type',
                                                            name: 'Type'
                                                        },
                                                        // {
                                                        //     data: 'logo_image',
                                                        //     name: 'logo_image',
                                                        //     "render": function(data, type, full, meta) {
                                                        //         if(data=='' || data==null){return "";}else{
                                                        //             return "<img src=\"{{$asset}}" + data + "\" height=\"50\"/>";
                                                        //         }
                                                                
                                                        //     },
                                                        // },
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
                        </div>
                    </div>
                    <!-- Button trigger modal -->
                </div>
            </div>
        </div>
        @include('admin.v1.store.insert')

        <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="edit">Edit {{ $pagename }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="edit_form">

                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="view">View {{ $pagename }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="view_form">

                </div>

            </div>
        </div>
    </div>
    @endslot
</x-layout>
