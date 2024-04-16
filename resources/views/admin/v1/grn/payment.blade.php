<div class="card-body">
    <div class="table-responsive-lg">
        <table class=" datatable table   table-striped table-bordered ">
            <thead>
                <tr class="ligth">
                    <th>S.No</th>
                    <th>Customer Name</th>
                    <th>Invoice Number</th>
                    <th>Sale Date</th>
                    <th>Amount</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>

        </table>

        <script type="text/javascript">
            $(function() {
                var i = 1;
                var table = $('.datatable').DataTable();
                table.destroy();
                var newtable = $('.datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "#",

                    // buttons: [{
                    //     extend: 'collection',
                    //     text: 'Export',
                    //     buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
                    //     className: 'custom-exp-btn',
                    // }, ],
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'customer.name',
                            name: 'customer.name'
                        },

                        {
                            data: 'invoice_no',
                            name: 'invoice_no'
                        },

                        {
                            data: 'sale_date',
                            name: 'sale_date'
                        },
                        {
                            data: 'total',
                            name: 'total'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],

                    // colReorder: true,
                    // dom: 'lBfrtip',
                    // lengthMenu: [
                    //     [10, 25, 50, -1],
                    //     [10, 25, 50, 100]
                    // ],
                    // select: true,
                });

                // $('.datatable').on('click', '#duebill', function() {
                //     //console.log('hiiii');
                //     var invno = $(this).data('id');
                //     //console.log(invno);
                //     $.ajax({
                //         type: "GET",
                //         url: "{{route('pos.sale.show',['invno' => ':invno']) }}".replace(':invno', invno),
                //         success: function(response) {
                //             $('#unpaid_bill').modal('hide');
                //             $('#invoice').modal('show');
                //             $('#tax_invoice').html(response);

                //         },
                //         error: function(xhr, status, error) {
                //             // Handle errors
                //             console.error(xhr.responseText);
                //         }
                //     });
                // })


            });
        </script>


    </div>
</div>
