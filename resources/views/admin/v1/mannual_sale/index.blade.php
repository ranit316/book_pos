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
                                        href="{{ route('sale.create') }}"><i class="mdi mdi-plus me-1"></i>Add
                                        {{ $page }}</a>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class=" datatable table  table-striped table-bordered ">
                                            <thead>
                                                <tr class="ligth">
                                                    <th>Sys id</th>
                                                    <th>SINV NO</th>
                                                    <th>Store Name</th>
                                                    <th>Customer Name</th>
                                                    <th>Customer Phone</th>
                                                    <th>No of Books</th>
                                                    <th>Bill Amount</th>
                                                    <th>Date of Generation</th>
                                                    <th>Date of Update</th>
                                                    <th>Sales Type </th>
                                                    <th>Payment ID</th>
                                                    <th>status</th>
                                                    <th>Download</th>
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
                                                    ajax: "{{ route('sale.index') }}",

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
                                                            data: 'invoice_no',
                                                            name: 'invoice_no'
                                                        },
                                                        {
                                                            data: 'store.store_name',
                                                            name: 'store.store_name'
                                                        },
                                                        {
                                                            data: 'customer.name',
                                                            name: 'customer.name'
                                                        },
                                                        {
                                                            data: 'customer.phone',
                                                            name: 'customer.phone'
                                                        },
                                                        {
                                                            data: 'sale_to_details.qty',
                                                            name: 'sale_to_details.qty'
                                                        },
                                                        {
                                                            data: 'total',
                                                            name: 'total'
                                                        },
                                                        {
                                                            data: 'sale_date',
                                                            name: 'sale_date',
                                                            render: function(data, type, full, meta) {
                                                                return moment(data).format('DD-MM-YYYY'); // Format to DMY
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
                                                            data: 'sale_mode',
                                                            name: 'sale_mode'
                                                        },
                                                        {
                                                            data: 'trancaction_no',
                                                            name: 'trancaction_no'
                                                        },

                                                        // {
                                                        //     data: 'total',
                                                        //     name: 'total'
                                                        // },
                                                        {
                                                            data: 'status',
                                                            name: 'status',
                                                            render: function(data, type, full, meta) {
                                                            if (data.toLowerCase() === 'paid') {
                                                                    return "<span class='badge bg-success'>" + data + "</span>";
                                                            } else {
                                                            return "<span class='badge bg-primary'>" + data + "</span>";
                                                                }
                                                            }
                                                        },
                                                        {
                                                            data: 'download_action',
                                                            name: 'download_action',
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
{{-- ===================MODAL INVOICE ===========- --}}

<div class="modal fade" id="invoice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Tax Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="tax_invoice">
            </div>

        </div>
    </div>
</div>

{{-- --============= END MODAL ======================== --}}
<script>
    $(document).ready(function() {

        $(document).on('click', '#pos-payment', function() {
            //event.preventDefault();
            var saleid = $(this).val();
            //alert(saleid);

            // Corrected route with the discountid parameter
            var routeUrl = '{{ route('payment.bank.api', ['sale_id' => ':saleid']) }}';
            routeUrl = routeUrl.replace(':saleid', saleid);

            editForm(routeUrl, 'show-msg');
            alert("Payment Successfully accepted");
            //var redirect_url = '{{ route('sale.index') }}';
            window.print();
            refreshPage(200);

        });

        $(document).on('click', '#abc', function() {
            // window.reload();

            refreshPage();

        });
    });

    function get_invoice_details(invoice_no) {
        editForm('{{ route('sale.get_cus.invoice') }}/' + invoice_no, 'tax_invoice');
        $('#invoice').modal('show');

    }

    function printpaidbill(invno) {
        //var invno = document.getElementById("invoice_no").value;
        //alert (invoice_no);
        invno = invno;
        $.ajax({
            type: "GET",
            url: "{{ route('pos.sale.showprint', ['invno' => ':invno']) }}".replace(':invno',
                invno),
            success: function(response) {

                // $('#print_bill').modal('hide');
                // $('#invoice').modal('show');
                // $('#tax_invoice').html(response);
                printthispage(response);

            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });

    }

    function bill_pdf(invno) {
        //alert(invno);
      
        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Months are zero-indexed, so we add 1
        var day = currentDate.getDate().toString().padStart(2, '0');

        var hours = currentDate.getHours().toString().padStart(2, '0');
        var minutes = currentDate.getMinutes().toString().padStart(2, '0');

        var ymdFormat = year + month + day + hours + minutes;
        // console.log("YMD Format:", ymdFormat);
        // console.log("Time:", time);
        //alert(ymdFormat)
        $.ajax({
            type: 'GET',
            url: "{{ route('download_salepdf', ['invo' => ':invno']) }}".replace(':invno', invno),
            // data: data,
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response) {
                var blob = new Blob([response]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "I&CA_" + invno + ymdFormat + ".pdf";
                link.click();
            },
            error: function(blob) {
                console.log(blob);
            }
        });

    }
</script>
