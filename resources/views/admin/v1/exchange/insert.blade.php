<x-layout>
    @slot('title', 'Exchange')
    @slot('body')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title"> {{ $page }} Generate</h4>
                                    </div>

                                    <a class="  btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                        href="{{ route('exchange.index') }}"><i class="uil-arrow-left me-2 me-2"></i>Back to
                                        {{ $page }} List</a>
                                </div>

                                <!-- Modal body -->
                                <div class="card-body">
                                    <form id="form_data" action="{{ route('exchange.store') }}" method="POST">
                                        <div class="row">
                                            @csrf
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="invoice_no" class="required">Invoice No</label>
                                                    <input type="text" class="form-control"
                                                        onkeyup="editForm('{{ route('exchange.sale.get', ['invoice_no' => '']) }}/'+document.getElementById('invoice_no').value, 'data2')"
                                                        name="invoice_no" id="invoice_no">
                                                </div>
                                            </div>
                                            <span id="data2">

                                            </span>
                                        </div>
                                        <!-- /.card-body -->
                                    </form>
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


<script>
    var product0 = document.getElementById("product0");

    function selectProduct() {
        alert("test")
    }

    function checkQty(input) {
        const purchaseQty = document.querySelectorAll(".purchan-qty");
        const exchangeQty = document.querySelectorAll(".exchange-qty");
        const errorshow = document.querySelectorAll(".errorshow");
        const submit = document.querySelector(".submit");

        for (i = 0; i < exchangeQty.length; i++) {
            if (Number(purchaseQty[i]?.innerText) < Number(exchangeQty[i].value)) {
                errorshow[i].innerHTML = "Please enter less then " + purchaseQty[i]?.innerText;
                submit.disabled = true;
            }else{
                errorshow[i].innerHTML = "";
                submit.disabled = false;
            }
        }
    }
</script>
