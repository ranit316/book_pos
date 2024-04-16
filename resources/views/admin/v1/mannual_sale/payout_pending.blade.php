<x-layout>
    @slot('title', 'pending payout')
    @slot('body')
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xxl-12 col-xl-12">
                            <div class="card">
                                <div class="card-header justify-content-between d-flex align-items-center">
                                    <h4 class="card-title">Transaction</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class=" abc table table-striped table-bordered">
                                            <thead>
                                                <tr class="ligth">
                                                    <th>Sys id</th>
                                                    <th>SINV NO</th>
                                                    <th>Store Name</th>
                                                    <th>Customer Name</th>
                                                    <th>Customer Phone</th>
                                                    <th>Customer Transaction No</th>
                                                    <th>Payout Transaction No</th>
                                                    <th>Amount</th>
                                                    <th>Date of Customer Payment</th>
                                                    <th>Date of Publisher Payment</th>
                                                    <th>Status</th>
                                                    <th>Download</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        <script type="text/javascript">
                                            $(function() {
                                                var i = 1;
                                                var table = $('.abc').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: "{{ route('payout.list.pending') }}",
                                                    columns: [{
                                                            data: 'id',
                                                            name: 'id'
                                                        },
                                                        {
                                                            data: 'sale.invoice_no',
                                                            name: 'sale.invoice_no'
                                                        },
                                                        {
                                                            data: 'publisher.store_name',
                                                            name: 'publisher.store_name'
                                                        },
                                                        {
                                                            data: 'sale.customer.name',
                                                            name: 'sale.customer.name'
                                                        },
                                                        {
                                                            data: 'sale.customer.phone',
                                                            name: 'sale.customer.phone'
                                                        },
                                                        {
                                                            data: 'sale.salepayament.trancaction_no',
                                                            name: 'sale.salepayament.trancaction_no'
                                                        },
                                                        {
                                                           data: 'txn_no',
                                                           name: 'txn_no',
                                                        },
                                                        {
                                                            data: 'amount',
                                                            name: 'amount'
                                                        },
                                                        {
                                                            data: 'sale.salepayament.created_at',
                                                            name: 'sale.salepayament.created_at',
                                                            render: function(data) {
                                                                return moment(data).format('YYYY-MM-DD HH:mm:ss');
                                                             }
                                                        },
                                                        {
                                                            data: null,
                                                            name: null,
                                                            orderable: null,
                                                            searchable: null
                                                        },
                                                        {
                                                            data: 'status',
                                                            name: 'status'
                                                        },
                                                        {
                                                            data: 'action_pdf',
                                                            name: 'action_pdf',
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
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endslot
</x-layout>


{{-- @foreach ($data as $dt)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $dt->salepayament->ref_no }}</td>
    <td>{{$dt->salepayament->bank_name}}</td>
    <td>{{$dt->salepayament->card_no}}</td>
    <td>{{$dt->salepayament->upi_no}}</td>
    <td>{{ $dt->supplier->name }}</td>
    <td class="text-right">{{ $dt->salepayament->amount }}</td>
    <td>{{ $dt->salepayament->payment_status }}</td>
</tr>
@endforeach --}}
