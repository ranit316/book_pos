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
                                        <h4 class="card-title">{{ $page }} View</h4>
                                    </div>
                                    <a class="btn btn-primary add-list btn-sm text-white"
                                        href="{{ route('payout.list.pending') }}"><i class="las la-plus mr-3"></i>Back to
                                        {{ $page }} List</a>
                                </div>
                                <!-- Modal body -->

                                <div class="card-body">
                                        <div class="row">
                                            
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="sinv_no" class="required">SINV NO</label>
                                                    <input readonly id="sinv_no" name="sinv_no" required type="text"
                                                        class="form-control" readonly
                                                        value="{{$data->sale->invoice_no}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="customer_name" class="required">Customer Name</label>
                                                    <input readonly  required type="text"
                                                        value="{{$data->sale->customer->name}}" class="form-control"
                                                        placeholder="Customer Name" name="customer_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="customer_phone" class="required">Customer Phone</label>
                                                    <input readonly  required type="text"
                                                        value="{{$data->sale->customer->phone}}" class="form-control"
                                                        placeholder="Customer Phone" name="customer_phone">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="txn_no" class="required">Payout Transaction No</label>
                                                    <input readonly  required type="text"
                                                        value="{{$data->txn_no}}" class="form-control"
                                                        placeholder="Txn No" name="txn_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="amount" class="required">Amount</label>
                                                    <input readonly  required type="text"
                                                        value="{{$data->amount}}" class="form-control"
                                                        placeholder="Amount" name="amount">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="date_payment" class="required">Date of Customer Payment</label>
                                                    <input readonly  required type="text"
                                                        value="{{$data->created_at }}" class="form-control"
                                                        placeholder="" name="date_payment">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="payment_mode" class="required">Payment Mode</label>
                                                    <input readonly  required type="text"
                                                        value="{{$data->payament_mode }}" class="form-control"
                                                        placeholder="" name="payment_mode">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="status" class="required">Status</label>
                                                    <input readonly  required type="text"
                                                        value="{{$data->status }}" class="form-control"
                                                        placeholder="" name="status">
                                                </div>
                                            </div>

                                
                                           
                                            <hr>
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