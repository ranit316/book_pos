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


                                    <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" href="{{ route('purches.create.invoice') }}"><i class="mdi mdi-plus me-1"></i>Add
                                        {{ $page }}</a>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class=" datatable table   table-striped table-bordered ">
                                            <thead>
                                                <tr class="ligth">
                                                    <th>Sys id</th>
                                                    <th>GRN Doc No</th>
                                                    <th>DO No</th>
                                                    <th>PO No</th>
                                                    <th>Req No</th>
                                                    <th>CS Name</th>
                                                    <th>RS Name</th>
                                                    <th>No of Books</th>
                                                    <th>Date of Generation</th>
                                                    <th>Date of Update</th> 
                                                    <th>Status</th>
                                                    <th>Download</th>
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
                                                    ajax: "{{ route('grn.index') }}",

                                                    columns: [{
                                                            data: 'DT_RowIndex',
                                                            name: 'DT_RowIndex'
                                                        },
                                                        {
                                                            data: 'po_no',
                                                            name: 'po_no'
                                                        },
                                                        {
                                                            data: 'dispatch_no',
                                                            name: 'dispatch_no'
                                                        },
                                                        {
                                                            data: 'grn_no',
                                                            name: 'grn_no'
                                                        },
                                                        {
                                                            data: 'grn_date',
                                                            name: 'grn_date'
                                                        },

                                                        {
                                                            data: 'recieved_date',
                                                            name: 'recieved_date'
                                                        },
                                                        {
                                                            data: 'expected_delivery_date',
                                                            name: 'expected_delivery_date'
                                                        },
                                                        {
                                                            data: 'transport_charge',
                                                            name: 'transport_charge'
                                                        },
                                                        {
                                                            data: 'supplier.name',
                                                            name: 'supplier.name'
                                                        },
                                                        {
                                                            data: 'store.store_name',
                                                            name: 'store.store_name'
                                                        },
                                                        {
                                                            data: 'store.type',
                                                            name: 'store.type'
                                                        },
                                                       

                                                        {
                                                            data: 'total_amount',
                                                            name: 'total_amount'
                                                        },

                                                        {
                                                            data: 'action',
                                                            name: 'action',
                                                            orderable: false,
                                                            searchable: false
                                                        },
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
