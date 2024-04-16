<x-layout>
    @slot('title', 'pos')
    @slot('body')
        <link rel="stylesheet" href="{{ asset('assets/css/pos.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/frontend.css') }}">
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content p_content p-0">
                <div class="container-fluid">

                    <form id="form_data_pos" action="{{ route('pos.cartstore') }}">
                        <div class="row">
                            @csrf
                            <div id="pos_header" class="col-xl-7 col-lg-7">
                                @include('admin.v1.pos.header')
                                <div class="card mt-3">
                                    <div class="row filter p-2">
                                        <div class="col-xl-3 col-md-4">
                                            <select required onchange="book_search()" name="publisher_id"
                                                class="form-control form-select w-100" id="publisher_id">
                                                @if (isCentral())
                                                    @foreach ($publishers as $publisher)
                                                        <option value="{{ $publisher->id }}">
                                                            {{ $publisher->publisher->store_name }}</option>
                                                    @endforeach
                                                @else
                                                    <option value=""> -Select Publisher- </option>
                                                    @foreach ($publishers as $publisher)
                                                        <option value="{{ $publisher->id }}">
                                                            {{ $publisher->publisher->store_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>



                                        <div class="col-xl-3 col-md-4">
                                            <select id="storage_site_id" required class="form-control form-select w-100"
                                                name="storage_site_id" onchange="book_search()">
                                                <option value=""> -Select Storage Site- </option>
                                                @foreach ($storage_sites as $site)
                                                    <option value="{{ $site->id }}"
                                                        @if ($loop->first) selected @endif>
                                                        {{ $site->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-xl-3 col-md-4">
                                            <select class="form-control form-select w-100 border-primary" name="category_id"
                                                id="cat_id" onchange="category_search()">
                                                <option selected disabled> - Select Genere - </option>
                                                @foreach ($category as $cat)
                                                    <option value="{{ $cat->id }}"> {{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>



                                        {{-- <div class="col-md-3">
                                            <select class="form-control form-select w-100 border-primary" name=""
                                                id="">
                                                <option selected disabled> - Top Selling - </option>

                                                <option value=""> Featured 1</option>
                                                <option value=""> Featured 2</option>
                                            </select>
                                        </div> --}}


                                    </div>
                                </div>
                                <div class="card-body p-2" id="book_list">
                                    @include('admin.v1.pos.book_list')
                                    {{-- <div class="row pt-2">
                                        <div class="col-sm-12">
                                            <div class="">
                                                {!! $books->links() !!}
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>

                            </div>

                            <div class="col-xl-5 col-lg-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row g-2 invoice-fields-area">
                                            <div class="col-md-8">
                                                <input id="" name="" required type="text"
                                                    class="form-control" readonly required value="{{ $user->name }}">
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input class="form-control" type="date" value="2023-12-04"
                                                        id="date">
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-8">
                                                <div class="form-group">
                                                    <input type="hidden" name="warehouse_id_hidden" value="2">
                                                    <select
                                                        onchange="selectDrop('form_data_pos', '{{ route('pos.search') }}', 'book_list')"
                                                        name="store_id" required id="warehouse_id" name="warehouse_id"
                                                        class="form-select form-control" data-live-search="true"
                                                        data-live-search-style="begins" title="Select warehouse...">
                                                        <option selected disabled> -Select Storage Site- </option>
                                                        @foreach ($stores as $store)
                                                            <option value="{{ $store->id }}">{{ $store->store_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> --}}

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {{-- <input type="hidden" name="customer_id_hidden" value="11"> --}}
                                                    <div class="input-group pos">
                                                        <select
                                                            onchange="editForm('{{ route('pos.cart.get.customer') }}/'+this.value,'pos_cart');confirm_discount_after_5sec();"
                                                            required name="customer_id" id="customer_id"
                                                            class="form-select form-control selectpicker"
                                                            data-live-search="true" title="Select customer..."
                                                            style="width: 100px">
                                                            <option selected disabled value="null">- Select Customers -
                                                            </option>
                                                            @foreach ($customers as $customer)
                                                                <option value="{{ $customer->customer_id }}">
                                                                    {{ $customer->customer->name }}
                                                                    ({{ $customer->customer->phone }})
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                        {{-- <button type="button" class="btn btn-default btn-sm border"
                                                        data-bs-toggle="modal" data-bs-target="#addCustomer"><i
                                                                class="fas fa-plus"></i></button> --}}
                                                        <a class="btn btn-default btn-sm border" data-bs-toggle="modal"
                                                            data-bs-target="#customerAdd" style="padding-top: 10px;"><i
                                                                class="fas fa-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-4">
                                                <select name="currency_id" id="currency" class="form-control form-select"
                                                    data-toggle="tooltip" title=""
                                                    data-original-title="Sale currency">
                                                    <option selected value="1" data-rate="1">₹ INR</option>
                                                </select>
                                            </div> --}}
                                            <div class="col-md-12">
                                                <div class="form-inline">
                                                    <div class="search-box">
                                                        <div class="position-relative">
                                                            <input type="text"
                                                                class="form-control bg-light border-light rounded "
                                                                placeholder="Search Book by name/code">
                                                            <i class="bx bx-search search-icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="pos_cart">
                                        </div>
                                        <div class="d-flex mt-4">
                                            <button type="button" class="btn btn-success w-100 font-size-18 mx-1"
                                                onclick="" id="add_sale">
                                                Place Order
                                            </button>
                                            <!-- <button type="button" class="btn btn-success w-100 font-size-18 mx-1" data-bs-toggle="modal"  data-bs-target="#payment_stat_mod">
                                                                                Place Order
                                                                            </button> -->
                                            {{--  <button type="button" class="btn btn-outline-primary w-50 mx-1">
                                                Save Draft
                                            </button> --}}
                                        </div>
                                        {{-- <div class="d-flex flex-wrap gap-2">
                                            <button type="button" class="btn btn-primary"><i
                                                    class="bx bx-card icon-sm"></i>
                                                Card</button>
                                            <button type="button" class="btn btn-success"><i
                                                    class="bx bx-money icon-sm"></i> Cash</button>
                                            <button type="button" class="btn btn-warning"><i
                                                    class="uil uil-paypal me-2"></i> PayPal</button>
                                            <button type="button" class="btn btn-info"><i class="bx bx-money icon-sm"></i>
                                                Cheque</button>
                                            <button type="button" class="btn btn-danger"><i
                                                    class="uil uil-exclamation-triangle me-2"></i> Cancel</button>
                                            <button type="button" class="btn btn-purple"><i
                                                    class="uil uil-clock me-2"></i>
                                                Recent Transaction</button>
                                            <button type="button" class="btn btn-purple"><i class="fa fa-shopping-cart"></i>Check Out</button>
                                        </div> --}}

                                    </div>
                                </div>
                            </div>

                        </div>


                    </form>
                </div>

            </div> <!-- container-fluid -->

        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script>2023 © Vuesy.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        </div>
        <input type="hidden" id="error_payment" value="{{ session('payment_error') }}" name="error_payment">

        </div>
        @include('admin.v1.pos.addcustomer')
        <div class="modal fade" id="invoice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header p-0">

                        <button type="button" class="btn-close" onclick="modalclosethis('invoice');"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="tax_invoice">
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="unpaid_bill" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Unpaid Bill List</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="listunpaid">
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="print_bill" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Print Bill List</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="listprint">
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="payment_stat_mod" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Payment Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            onclick="modalclosethis('payment_stat_mod');"></button>
                    </div>
                    <div class="modal-body">
                        {{-- <div class="text-center">
                            <h4 class="text-dark"><strong>Success</strong></h4>
                            <img src="{{asset('assets/images/green-check.png')}}" class="img-fluid mb-3" width="100">
                            <h4><strong>₹ 8,000.00 Paid</strong></h4>
                            <h5>On: 16-02-2024 3.30PM</h5>
                            <h5>Tran No: 123456789</h5>
                            <h5>Customer Name: Sudip Kumar</h5>
                            <button type="button" class="btn btn-primary mt-4" id="">
                <i class="fas fa-print"></i> Print Bill</button>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="payment_success_mod" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Payment Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" id="info-close" aria-label="Close"
                           ></button>
                           {{-- onclick="modalclosethis('payment_stat_mod');" --}}
                    </div>
                    <div class="modal-body" id="payment_success_body">

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="payment_error_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Error</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            onclick="modalclosethis('payment_stat_mod');"></button>
                    </div>
                    <div class="modal-body" id="payment_error_blade">
                        
                    </div>
                </div>
            </div>
        </div>

        {{--  @include('admin.v1.bill.bill') --}}
        <!-- END layout-wrapper -->

    @endslot

</x-layout>
<script src="https://demos.codexworld.com/convert-html-to-pdf-using-javascript-jspdf/js/html2canvas.min.js"></script>

<script src="https://demos.codexworld.com/3rd-party/jsPDF-2.5.1/dist/jspdf.umd.js"></script>
<script>
    // for the paginatin purpose 
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //alert('123456');

        <?php
                                            if (Session::has('return_form') && session('return_form') == 'PaymentSuccess')
                                            {
                                                $session_msg_rt = session('return_form');
                                                $sesson_sale_id = session('saleidreturn');
                                                if($session_msg_rt == 'PaymentSuccess')
                                                {
                                                    session()->forget('return_form');
                                                    session()->forget('saleidreturn');
                                                    //echo "comming after successfull payment";
                                                    ?>
        //alert('abcd');
        $('#payment_success_mod').modal('show');
        ajax_load_for_payment_show({{ $sesson_sale_id }});

        <?php
                                                }else{
                                                    ?>
        alert('payment faild');
        <?php
                                                }
                                                
                                            }

                                        ?>


        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page) {
            selectDrop('form_data_pos', '{{ route('pos.search') }}?page=' + page, 'book_list')
        }

        function ajax_load_for_payment_show(sale_id) {
            //alert(sale_id);
            $.ajax({
                type: "POST",
                url: "{{ route('pos.success.payment') }}",
                data: {
                    'sale_id': sale_id
                },
                //dataType: "dataType",
                success: function(response) {
                    $('#payment_success_body').html(response);
                    <?php
                    session()->forget('return_form');
                    session()->forget('saleidreturn');
                    ?>
                }
            });
        }

        $(document).on('click', '#discount_apply', function(event) {
            event.preventDefault();
            var discountid = $(this).val();
            //alert(discountid);

            // Corrected route with the discountid parameter
            var routeUrl = '{{ route('discount.apply', ['id' => ':discountid']) }}';
            routeUrl = routeUrl.replace(':discountid', discountid);

            selectDrop('form_data_pos', routeUrl, 'pos_cart');
            $('#discount-sec').modal('hide');

        });

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



        $('#pos_unpaid').click(function() {
            //alert('hiiii');

            $('#unpaid_bill').modal('show');
            $.ajax({
                type: "GET",
                url: "{{ route('cust.unpaid') }}",
                success: function(data) {
                    //console.log(data);
                    $('#listunpaid').html(data);
                },
                error: function(error) {
                    console.log(error);
                }
            })



        });

        $('#print').click(function() {
            //alert('hiiii');

            $('#print_bill').modal('show');
            $.ajax({
                type: "GET",
                url: "{{ route('cust.print') }}",
                success: function(data) {
                    //console.log(data);
                    $('#listprint').html(data);
                },
                error: function(error) {
                    console.log(error);
                }
            })



        });






        document.getElementById("full_screen").addEventListener("click", function() {
            toggleFullScreen();
        });

        function toggleFullScreen() {
            if (!document.fullscreenElement) {
                // If no element is in full-screen mode, make the whole document full-screen
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    /* Firefox */
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                    /* Chrome, Safari & Opera */
                    document.documentElement.webkitRequestFullscreen();
                } else if (document.documentElement.msRequestFullscreen) {
                    /* IE/Edge */
                    document.documentElement.msRequestFullscreen();
                }
            } else {
                // If an element is in full-screen mode, exit full-screen
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    /* Firefox */
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) {
                    /* Chrome, Safari & Opera */
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) {
                    /* IE/Edge */
                    document.msExitFullscreen();
                }
            }
        }


        $('#dashboard_button').click(function(e) {
            e.preventDefault();
            var url = '{{ route('dashboard.show') }}';
            window.location.href = url;

        });



        // $('.datatable').on('click', '#duebill', function(){
        //     //console.log('hiiii');
        // })
        $('#add_sale').click(function() {
            var cus_id = $('#customer_id').val();
            $.ajax({
                type: "GET",
                url: "{{ route('bill.status', ['cus_id' => ':cus_id']) }}".replace(':cus_id',
                    cus_id),
                success: function(data) {
                    if (data == true) {
                        alert('Customer have already unpaid bill');
                        //abort;
                    } else {
                        addsale();

                        editForm('{{ route('pos.cart.get.customer') }}/' + cus_id,
                            'pos_cart');
                    }
                },
                error: function(error) {

                }
            })
        });

        function openPaymentErrorModal() {
            var error_message = $('#error_payment').val();
            console.log(error_message);
            if (error_message !== undefined && error_message !== null && error_message !== '') {
                $('#payment_error_modal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "{{ route('unset.payment.error') }}",
                    success: function(response) {
                        console.log('Session variable unset');
                        $('#payment_error_blade').html(response);
                    },
                    error: function(error) {
                        console.error('Error unsetting session variable');
                    }
                });
            }
        }

        // Call the function to open the modal when needed
        openPaymentErrorModal();

    });

    function addToCart(bookId) {

        var selectedCustomer = document.getElementById('customer_id').value;
        var route = '{{ route('pos.add_cart', ':bookId') }}';
        route = route.replace(':bookId', bookId);

        if (selectedCustomer == 'null') {

            alert("Please select a customer before adding a book to the cart.");
        } else {

            selectDrop('form_data_pos', route, 'pos_cart');
        }
    }



    function alertmsd(ms) {
        alert(ms);
    }

    function addsale() {

        var publisher_id = document.getElementById('publisher_id').value;
        var storage_site_id = document.getElementById('storage_site_id').value;



        // alert(publisher_id);

        if (storage_site_id == '' || storage_site_id == null) {
            alert('Please select warehouse ');

        } else if (publisher_id == '' || publisher_id == null) {
            alert('Please select publisher');

        } else if (document.querySelector('#pos_cart #total_amount') !== null) {
            var tot_val = document.getElementById('total_amount').value;
            if (tot_val > 0) {
                //var invoice_no1 = document.getElementById('invoice_no').value;
                //selectDrop('form_data_pos','{{ route('pos.cartstore') }}', 'tax_invoice');

                var form = document.getElementById('form_data_pos');
                var method = "POST"
                target_id = 'tax_invoice';

                var formdata = new FormData(form);
                var formElements_button = Array.from(form.elements).pop();
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById(target_id).value = this.responseText;
                        document.getElementById(target_id).innerHTML = this.responseText;

                    }

                };
                xhttp.open(method, '{{ route('pos.cartstore') }}', true);
                xhttp.send(formdata);
                $('#invoice').modal('show');

            } else {
                alert("Add atleast one book to cart");
            }
        } else {
            alert("Add atleast one book to cart");
        }

    }

    function adjustment(val) {
        var adj = 0;
        if (val != '') {
            adj = val;
            adj = parseFloat(adj);
        }
        var subtotal = $('#subtotal').html();
        subtotal = parseFloat(subtotal);

        //var tax = $('#total_tax').val();
        //tax = parseFloat(tax);

        var discount = $('#discount').html();
        discount = parseFloat(discount);

        var tax_percentage_label = $('#tax_percentage_label').html();

        tax_percentage_label = parseFloat(tax_percentage_label);
        var total_tax_amount = (tax_percentage_label * (subtotal - discount)) / 100;
        total_tax_amount = total_tax_amount.toFixed(2);
        $('#total_tax_lable').html(total_tax_amount);
        $('#total_tax').val(total_tax_amount);


        //alert('subtotal='+subtotal+'discount='+discount+'total_tax_amount='+total_tax_amount+'adj='+adj);
        var grand_total = parseFloat(subtotal) - parseFloat(discount) + parseFloat(total_tax_amount) - parseFloat(adj);
        $('#grand_total').html(grand_total.toFixed(2));
        $('#total_amount').val(grand_total.toFixed(2));



    }

    function confirm_discount_check() {
        var discount_percentage = $('#discount_percentage_dd').val();
        if (discount_percentage == 20) {
            confirm_discount();
        } else {
            var confstatus = confirm("Please confirm if the customer's purchase is eligible for the special discount.");
            if (confstatus) {
                confirm_discount();
            } else {
                $('#discount_percentage_dd').val(20).change();
            }
        }
    }

    function confirm_discount() {
        // alert('confirm_discount');
        var discount_percentage = $('#discount_percentage_dd').val();
        discount_percentage = parseFloat(discount_percentage);
        var taxeble_amount = $('#taxeble_amount').val();
        taxeble_amount = parseFloat(taxeble_amount);

        $('#discount_p').val(discount_percentage);

        if ((taxeble_amount) > 0 && (discount_percentage > 0)) {
            var tot_dis = ((taxeble_amount * discount_percentage) / 100);
            apply_discount(tot_dis, discount_percentage);
        }


    }

    function apply_discount(dis_amt, dis_per) {
        // alert(dis_amt+"========"+dis_per);

        document.getElementById('discount_value').value = dis_amt;
        document.getElementById('discount').innerText = dis_amt.toFixed(2);
        document.getElementById('discount_percentage').innerText = dis_per + '%';
        $('#discount-sec').modal('hide');
        // total_amt = document.getElementById('total_amount').value;
        // document.getElementById('total_amount').value = Number(total_amt) - Number(dis_amt);
        // document.getElementById('total_amount_label').innerText = document.getElementById('total_amount').value;

        //document.getElementById('discount-span').innerText = 'Applied ';

        //$('#discount-sec').modal('hide');
        //calculation();
        var round_off = $('#round_off').val();
        if (round_off == '' || round_off == null) {
            round_off = 0;
        } else {
            round_off = parseFloat(round_off);
        }

        adjustment(round_off);
    }


    function book_search() {
        spinner_show();
        var publisher = $('#publisher_id').val();
        var storage_id = $('#storage_site_id').val();
        var cat_id = $('#cat_id').val();
        var customer_id = $('#customer_id').val();
        //alert(customer_id);
        //console.log(publisher);
        //console.log(storage_id);
        if (storage_id == null) {
            alert('select storage site')
        };

        if (publisher == null) {
            alert('select Publisher');
        }



        if (publisher && storage_id) {

            if (confirm("Your cart items will remove, do you want to proceed?") == true) {

                $.ajax({
                    type: "POST",
                    url: "{{ route('pos.search') }}",
                    data: {
                        publisher: publisher,
                        storage_id: storage_id,
                        cat_id: cat_id,
                        customer_id: customer_id
                    },
                    success: function(data) {
                        $('#book_list').html(data);

                        editForm('{{ route('pos.cart.get.customer') }}/' + customer_id, 'pos_cart');

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            } else {

            }


        }
        spinner_hide();
    }

    function confirm_discount_after_5sec() {
        //alert('confirm_discount_after_5sec');
        setTimeout(confirm_discount, 1000);
    }

    function category_search() {
        var cat_id = document.getElementById('cat_id').value;
        //console.log(cat_id);
        var publisher = document.getElementById('publisher_id').value;
        var storage_id = $('#storage_site_id').val();

        if (!storage_id) {
            alert("please Select Storage side");
        }
        if (cat_id && storage_id) {
            $.ajax({
                type: "POST",
                url: "{{ route('pos.searchcategory') }}",
                data: {
                    cat_id: cat_id,
                    publisher: publisher,
                    storage_id: storage_id,
                },
                success: function(data) {
                    $('#book_list').html(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }


    }



    function cus_note() {
        $('#purchase-sec').modal('show');
    }

    function pur_note() {
        var note = document.getElementById('purchase_note').value;
        document.getElementById('description').value = note;
        $('#purchase-sec').modal('hide');
        //console.log(note);
    }


    // function printthispage() {
    // //content_print
    // //alert('content_print');
    // exportCanvasAsPdf('content_print', 'Bill.pdf');
    // //exportCanvasAsPNG('pos-prod-item-wrapper','Bill.png');


    // }

    // window.jsPDF = window.jspdf.jsPDF;

    // function exportCanvasAsPdf(id, fileName) {
    // var doc = new jsPDF();

    // // Source HTMLElement or a string containing HTML.
    // var elementHTML = document.querySelector("#" + id);

    // doc.html(elementHTML, {
    // callback: function(doc) {
    // // Save the PDF



    // doc.save(fileName);
    // },
    // margin: [5, 5, 5, 5],
    // autoPaging: 'text',
    // x: 0,
    // y: 0,
    // width: 190, //target width in the PDF document
    // windowWidth: 675 //window width in CSS pixels
    // });

    // }
</script>

<?php 
if(isset($_GET['customer_id']) && ($_GET['customer_id'] > 0))
{
    ?>
<script>
    $('#customer_id').val(<?php echo $_GET['customer_id']; ?>);
    editForm('<?php echo route('pos.cart.get.customer'); ?>/<?php echo $_GET['customer_id']; ?>', 'pos_cart');
</script>
<?php
}
?>

<script>
    spinner_show();

    function spinner_show() {
        $('.preloader').show();
        //console.log('spinner_show');

    }

    function spinner_hide() {
        $('.preloader').hide();
    }
    $(document).ready(function() {
        //spinner_hide();
        const myTimeout = setTimeout(spinner_hide, 3000);
    });
</script>
