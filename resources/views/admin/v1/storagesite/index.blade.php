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
                                        class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="mdi mdi-plus me-1"></i>Add
                                        {{ $pagename }}</a>
                                </div>

                                <div class="card-body">
                                   @if($default_exist==0)
                                   <div class="blink_me">Please select default store for you </div>
                                   @endif
                                    <div class="table-responsive-lg">
                                        <table class=" datatable table   table-striped table-bordered ">
                                            <thead>
                                                <tr class="ligth">
                                                    <th>S.No</th>
                                                    <th>Store</th>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>Default</th>
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
                                                    ajax: "{{ route('storagesites.index') }}",

                                                    buttons: [
                                                        {
                                                             extend: 'collection',
                                                             text:    'Export',
                                                             buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
                                                             className: 'custom-exp-btn',
                                                        },
                                                    ],

                                                    columns: [{
                                                            data: 'DT_RowIndex',
                                                            name: 'DT_RowIndex'
                                                        },
                                                        {
                                                            data: 'store.store_name',
                                                            name: 'store.store_name'
                                                        },
                                                        {
                                                            data: 'name',
                                                            name: 'name',
                                                        },
                                                        {
                                                            data: 'address',
                                                            name: 'address'
                                                        },
                                                        {
                                                            data: 'flag',
                                                            name: 'flag'
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
        @include('admin.v1.storagesite.insert')

        <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
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
    <style>
       .blink_me {
        font-size:18px;
        color:#ff0000;
        font-weight:bold;
        animation: blinker 1s linear infinite;
        }

        @keyframes blinker {
        50% {
            opacity: 0;
        }
        }
    </style>
    @endslot
</x-layout>
