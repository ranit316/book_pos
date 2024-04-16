<div class="text-center" id="">

    <h4 class="text-dark"><strong>Success</strong></h4>
    <img src="{{ asset('assets/images/green-check.png') }}" class="img-fluid mb-3" width="100">
    <img src="{{ asset('assets/images/pending.png') }}" class="img-fluid mb-3 d-none" width="100">
    <img src="{{ asset('assets/images/failed.png') }}" class="img-fluid mb-3 d-none" width="100">
    <h4><strong>₹ {{ $payment->amount }} Paid</strong></h4>
    <h5>On: {{ $payment->created_at }}</h5>
    <h5>Transaction No: {{ $payment->trancaction_no }}</h5>
    <h5>Customer Name: {{ $data->customer->name }}</h5>
    <div id="print_btn">
        <button type="button" class="btn btn-primary mt-4" id="" onclick="printpaidbill()">
            <i class="fas fa-print"></i> Print Bill</button>
    </div>
    <input type="hidden" name="invoice_no" id="invoice_no" value="{{ $data->invoice_no }}">
    <input type="hidden" name="transaction_no" id="transaction_no" value="{{ '#' . $payment->trancaction_no }}">
    <input type="hidden" name="mop" id="mop"
        value="{{ $payment->payament_mode }} ({{ $payment->payaments_type }})">
    <input type="hidden" name="payment_date" id="payment_date" value="{{ $payment->created_at->format('Y-m-d h:m') }}">
</div>


<script>
    function printpaidbill() {
        var invno = document.getElementById("invoice_no").value;
        //alert (invoice_no);

        $.ajax({
            type: "GET",
            url: "{{ route('pos.sale.showprint', ['invno' => ':invno']) }}".replace(':invno',
                invno),
            success: function(response) {

                // $('#print_bill').modal('hide');
                // $('#invoice').modal('show');
                // $('#tax_invoice').html(response);
                printthispageprint(response);

            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });

    }

    function printthispageprint(divId) {
        var transaction_no = document.getElementById('transaction_no').value;
        var payment_date = document.getElementById('payment_date').value;
        var mop = document.getElementById('mop').value;
        document.querySelector('#print_btn').style.display = "none";
        document.querySelector('#status_123').innerHTML = "Paid";
        document.querySelector('#tran_no').innerHTML = transaction_no;
        document.querySelector('#date_payment').innerHTML  = payment_date;
        document.querySelector('#mode_payment').innerHTML = mop;
        var printContents = document.querySelector("#main_bill1").innerHTML;
        var originalContents = document.body.innerHTML;
        //divId.style.display = "none";

        document.body.innerHTML = printContents;
        window.print();

        document.body.innerHTML = originalContents;
        // document.querySelector('#print_btn').style.display = "block";
        $('#main_bill1').modal('hide');
        //document.querySelector()
        var closeButton = document.querySelector('.btn-close');
        closeButton.addEventListener('click', function() {
            // Close modal code here
            $('#invoice').modal('hide');
            // location.reload();
            window.location.reload();
        });
    }
</script>
