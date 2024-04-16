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
                                        <h4 class="card-title">{{ $page }} List</h4>
                                    </div>


                                    <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                        href="{{ route('requisition.create') }}"><i class="mdi mdi-plus me-1"></i>Add
                                        {{ $page }}</a>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class=" datatable table   table-striped table-bordered ">
                                            <thead>
                                                <tr class="ligth">
                                                    <th>Sys id</th>
                                                    <th>Req Doc No</th>
                                                    <th>Supplier</th>
                                                    <th>Receiver</th>
                                                    <th>No of Books </th>
                                                    <th>PO NO</th>
                                                    <th>GRN NO </th>
                                                    <th>DOG</th>
                                                    <th>DOU </th>
                                                    <th>Status</th>
                                                    <th>Download or Print</th>
                                                    {{-- <th>Total Amount</th> --}}
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
                                                    ajax: "{{ route('requisition.index') }}",

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
                                                            data: 'requisition_no',
                                                            name: 'requisition_no'
                                                        },
                                                        {
                                                            data: 'to_store.store_name',
                                                            name: 'to_store.store_name'
                                                        },
                                                        {
                                                            data: 'store.store_name',
                                                            name: 'store.store_name'
                                                        },
                                                        {
                                                            data: 'rdetails.request_qty',
                                                            name: 'rdetails.request_qty'
                                                        },
                                                        {
                                                            defaultContent: 'null'
                                                        },
                                                        {
                                                            defaultContent: 'null'
                                                        },
                                                        {
                                                            data: 'requisition_date',
                                                            name: 'requisition_date',
                                                            render: function(data, type, row, meta) {
                                                            return moment(data).format('DD-MM-YYYY');
                                                            }
                                                        },
                                                        {
                                                            data: 'updated_at',
                                                            name: 'updated_at',
                                                            render: function(data, type, row, meta) {
                                                            return moment(data).format('DD-MM-YYYY');
                                                            }
                                                        },
                                                        {
                                                            data: 'status',
                                                            name: 'status'
                                                        },
                                                  
                                                        // {
                                                        //     data: 'total_amount',
                                                        //     name: 'total_amount'
                                                        // },
                                                        {
                                                            data: 'down_action',
                                                            name: 'down_action',
                                                            orderable: false,
                                                            searchable: false
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
        <!-- End Page-content -->



        <!-- Modal -->
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


    @endslot
</x-layout>
