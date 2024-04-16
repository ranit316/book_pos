<x-layout>
    @slot('title', 'customer payment')
    @slot('body')
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xxl-12 col-xl-12">
                            <div class="card">
                                <div class="card-header justify-content-between d-flex align-items-center">
                                    <h4 class="card-title">Transaction</h4>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class=" abc table table-striped table-bordered" id="">
                                            <thead>
                                                <tr>
                                                    <th>Sys id</th>
                                                    <th>SINV NO</th>
                                                    <th>Store Name</th>
                                                    <th>Customer Name</th>
                                                    <th>Customer Phone</th>
                                                    <th>Transaction No</th>
                                                    <th>Mode Of Payment</th>
                                                    <th>Amount</th>
                                                    <th>Date of Generation</th>
                                                    <th>Date of Update</th>
                                                    <th>Status</th>
                                                    <th>Download</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table><!-- end table -->


                                        <script type="text/javascript">
                                            $(function() {
                                                var i = 1;
                                                var table = $('.abc').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: "{{ route('customer.payment') }}",
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
                                                            data: 'customername.invoice_no',
                                                            name: 'customername.invoice_no'
                                                        },
                                                        {
                                                            data: 'customername.supplier.publisher.store_name',
                                                            name: 'customername.supplier.publisher.store_name'
                                                        },
                                                        {
                                                            data: 'customername.customer.name',
                                                            name: 'customername.customer.name'
                                                        },
                                                        {
                                                            data: 'customername.customer.phone',
                                                            name: 'customername.customer.phone'
                                                        },
                                                        {
                                                            data: 'trancaction_no',
                                                            name: 'trancaction_no'
                                                        },
                                                        {
                                                            data: 'payament_mode',
                                                            name: 'payament_mode'
                                                        },
                                                        {
                                                            data: 'amount',
                                                            name: 'amount'
                                                        },
                                                        {
                                                            data: 'created_at',
                                                            name: 'created_at',
                                                            render: function(data, type, full, meta) {
                                                                return moment(data).format('DD-MM-YYYY'); 
                                                            }
                                                        },
                                                        {
                                                            data: 'updated_at',
                                                            name: 'updated_at',
                                                            render: function(data, type, full, meta) {
                                                                return moment(data).format('DD-MM-YYYY'); 
                                                            }
                                                        },
                                                        {
                                                            data: 'status',
                                                            name: 'status'
                                                            // "render": function(data, type, full, meta) {
                                                            //     if (data == 'cancel') {
                                                            //         return "<span class='badge bg-warning'>PENDING</span>";
                                                            //     } else if (data == 'accept') {
                                                            //         return "<span class='badge bg-success'>SUCCESS</span>";
                                                            //     } else {
                                                            //         return "<span class='badge bg-danger'>FAILED</span>";
                                                            //     }
                                                            // }
                                                        },
                                                        {
                                                            data: 'pdf_action',
                                                            name: 'pdf_action',
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
                                    </div><!-- end table responsive -->
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endslot
</x-layout>

{{-- @foreach ($data as $entry)

<tr>
    <th scope="row">{{$entry->id}}</th>
    <td>{{$entry->customer->name}}</td>
    <td>{{$entry->invoice_no}}</td>
    <td>{{$entry->sale_mode}}</td>
    <td>{{$entry->total}}</td>
    <td>{{$entry->supplier->name}}</td>
    <td>{{$entry->status}}</td>
</tr>
@endforeach --}}

<div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="edit">View {{ $page2 }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="edit_form">
                </div>
            </div>
        </div>
    </div>
