<form id="form_update" action="#" method="get">
    <div class="row">
        @csrf
        <div class="col-sm-12">
            <div class="form-group">
                <label class="">#Sys_id</label>
                <input  type="text" class="form-control" value="{{ $view_transaction->id }}"
                     name="name">
            </div>
        </div>
      
        <div class="col-sm-12">
            <div class="form-group">
                <label class=""> Customer Name</label>
                <input  type="text" class="form-control" placeholder="Enter name" name="description" value="{{ $view_transaction->customername->customer->name }}">
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label class=""> Invoice Number</label>
                <input type="text" class="form-control" name="description" value="{{ $view_transaction->customername->invoice_no }}">
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label class=""> Invoice Amount</label>
                <input  type="text" class="form-control" name="description" value="{{ $view_transaction->amount }}">
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label class="l"> Publisher Name</label>
                <input  type="text" class="form-control" name="description" value="{{ $view_transaction->customername->supplier->publisher->store_name }}">
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label class=""> Sale Mode</label>
                <input  type="text" class="form-control" name="description" value="{{ $view_transaction->customername->sale_mode }}">
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label class=""> Payment Mode</label>
                <input  type="text" class="form-control" name="description" value="{{ $view_transaction->customername->invoice_no }}">
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label class=""> Transaction Ref No</label>
                <input  type="text" class="form-control" name="description" value="{{ $view_transaction->payament_mode }}">
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label class=""> Transaction Date</label>
                <input  type="text" class="form-control" name="description" value="{{ $view_transaction->updated_at }}">
            </div>
        </div>
    </div>
</form>
