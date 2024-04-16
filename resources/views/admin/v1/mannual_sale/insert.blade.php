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
                                        <h4 class="card-title">{{ $page }} Create</h4>
                                    </div>
                                    <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                        href="{{ route('sale.index') }}"><i class="uil-arrow-left me-2 me-2"></i>Back to
                                        {{ $page }} List</a>
                                </div>
                                <!-- Modal body -->
                                <div class="card-body">
                                    <form id="form_data" action="{{ route('sale.store') }}" method="POST"
                                        autocomplete="off">
                                        <div class="row">
                                            @csrf
                                            {{-- <div class="col-sm-4">
                                                <div class="form-group"> --}}
                                            {{-- <label for="store_id" class="required">Selected Store</label> --}}
                                            {{-- <select id="store_id" required class="form-control  "
                                                        data-live-search="true" placeholder="Select Store " name="store_id">
                                                        @foreach ($stores as $store)
                                                            <option value="{{ $store->id }}">{{ $store->store_name }}
                                                            </option>
                                                        @endforeach
                                                    </select> --}}
                                            <input type="hidden" value="{{ $stores->id }}" name="store_id">
                                            {{-- </div>
                                            </div> --}}

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="publisher_id" class="required">Publisher</label>
                                                    @if (auth()->user()->type == 'retail-store')
                                                        <select id="publisher_id" required
                                                            class="form-control selectpicker  " data-live-search="true"
                                                            name="publisher_id">
                                                            @foreach ($suppliers as $supplier)
                                                                <option value="{{ $supplier->store_name }}">
                                                                    {{ $supplier->store_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @else
                                                        <input type="text" class="form-control" id="publisher_id0"
                                                            value="{{ $suppliers->publisher->store_name }}" readonly
                                                            name="publisher_id">
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="storage_site_id" class="required">Storage Site</label>
                                                    <select id="storage_site_id" required
                                                        class="form-control selectpicker  " data-live-search="true"
                                                        placeholder=" Select Storage Site " name="storage_site_id">
                                                        @foreach ($storage_sites as $site)
                                                            <option value="{{ $site->id }}">{{ $site->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="customer_id" class="required">Customer</label>
                                                    <select id="customer_id" required class="form-control selectpicker  "
                                                        data-live-search="true" placeholder="Enter  Customer "
                                                        name="customer_id">
                                                        @foreach ($customers as $customer)
                                                            <option value="{{ $customer->customer_id }}">{{ $customer->customer->name }}
                                                                ({{ $customer->customer->phone }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                         

                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label class="optional"> Description</label>
                                                    <textarea type="text" class="form-control" placeholder="Enter name" name="description"></textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="card-body table-responsive">
                                                <table class="table align-middle table-nowrap table-check "
                                                    id="dynamic_field" style="overflow-y:auto;">
                                                    <thead>
                                                        <tr>
                                                            <th data-field="S.NO" data-sortable="true">S.NO
                                                            </th>
                                                            <th>Products </th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            {{-- <th>Sale Price</th> --}}
                                                            <!-- <th>Tax Percentage</th> -->
                                                            {{-- <th>Taxeble Amount</th> --}}
                                                            <th>Total Amount</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <div class="inline-scroll">
                                                            <tr>
                                                                <td>

                                                                    <input type="text" id="slno1" value="1"
                                                                        readonly class="form-control "
                                                                        style="border:none;" />
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="my_row_id" value="0">

                                                                    <select onchange="price_get(this.value,0)"
                                                                        name="products[]" id="product0"
                                                                        placeholder="Search products.."
                                                                        class="form-control products selectpicker prod_dd"
                                                                        data-live-search="true">
                                                                        <option value="">Select Book</option>
                                                                        @if (auth()->user()->type == 'central-store')
                                                                            @foreach ($products as $product)
                                                                                <option value="{{ $product->id }}">
                                                                                    {{ $product->title }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                    <br>
                                                                    <small class="availbal_qty0" id="availbal_qty0"></small>

                                                                </td>
                                                               

                                                                <td><input type="number" name="request_qty[]"
                                                                        onkeyup="qtyCal(this.value,0)"
                                                                        onclick="qtyCal(this.value,0)" placeholder="Qty" id="reqqty0"
                                                                        class="form-control-sm form-control request_qty req_q0" />
                                                                </td>




                                                                <td><input type="number" name="price[]" placeholder="price"
                                                                        onkeyup="calculation()" readonly
                                                                        onclick="calculation()"
                                                                        class="form-control-sm form-control price price_per_u0" />


                                                                    <input type="hidden" name="array_tax_percentage[]"
                                                                        id="arr_tax_amt0" class="array_tax_amount " />
                                                                </td>


                                                               
                                                                <td><input type="number" name="array_total_amount[]"
                                                                        onkeyup="calculation()" onclick="calculation()"
                                                                        readonly required placeholder="amount"
                                                                        class="form-control-sm form-control array_total_amount arr_total_amt0" />
                                                                </td>


                                                                <td><button type="button" name="add" id="add"
                                                                        class="btn btn-outline-success btn-sm"><i
                                                                            class="fa fa-plus" aria-hidden="true"></i>
                                                                    </button>
                                                                </td>

                                                            </tr>
                                                        </div>
                                                    </tbody>



                                                </table>
                                                <div class="row">
                                                    <div class="col-sm-7"></div>
                                                    <div class="col-sm-5">
                                                        <table class="table table-striped table-sm">
                                                            <tbody>



                                                                <tr>
                                                                    <td class="bold">Order Amount</td>
                                                                    <td class="text-end">
                                                                        <input type="hidden" id="taxeble_amount"
                                                                            placeholder="taxeble_amount"
                                                                            name="taxeble_amount"
                                                                            class="form-control-sm form-control" value="0" />
                                                                        ₹ <span id="taxeble_amount_label"> 0.00 </span>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td class="bold"><span id=discount-span>
                                                                        </span>Discount
                                                                        <button type="button"
                                                                            class="btn btn-link btn-sm ps-0"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#discount-sec"
                                                                            ><i
                                                                                class="bx bx-edit"></i></button>
                                                                        <span id="discount_percentage"></span>
                                                                    </td>
                                                                    <td class="text-end">
                                                                        <input readonly type="hidden" id="discount"
                                                                            placeholder="discount" name="discount"
                                                                            value="0"
                                                                            class="form-control-sm form-control" />

                                                                            <input  type="hidden" id="discount_p"
                                                                          name="discount_p"
                                                                            value="0"
                                                                             />

                                                                        -₹<span id="total_discount">0.00 </span> <span
                                                                            id="discount_percentage"></span>
                                                                    </td>
                                                                </tr>


                                                                <tr>


                                                                    <td class="bold"><?php
                                                                    $tax_name = '';
                                                                    $tax_rate = 0;
                                                                    $gstslab = \App\Models\GstSlab::first();
                                                                    if (!empty($gstslab)) {
                                                                        $tax_name = $gstslab->name;
                                                                        $tax_rate = $gstslab->tax;
                                                                    }
                                                                    
                                                                    ?>Tax -
                                                                        {{ $tax_name }}</td>
                                                                    <td class="text-end">

                                                                        <input type="hidden" name="tax_amount"
                                                                            id="total_tax" placeholder="total tax"
                                                                            class="form-control-sm form-control" />
                                                                        <input type="hidden" id="tax_percentage"
                                                                            placeholder="tax percentage"
                                                                            class="form-control-sm form-control" />

                                                                        ₹ <span id="total_tax_lable"> </span>( <span
                                                                            id="tax_percentage_label">{{ $tax_rate }}</span>%)
 


                                                                            <input type="hidden" id="tax_percentage_value"  name="tax_percentage_value" value="{{ $tax_rate }}" />
 
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="bold"><span>Delivery Charge</span>
                                                                        <input type="number" name="delivery_charge"
                                                                            id="delivery_charge" value="0"
                                                                            placeholder="Delivery charge" min="0"
                                                                            onkeyup="calculation();"
                                                                            class="form-control-sm form-control"
                                                                            style="float:inline-end;width:150px;" />

                                                                    </td>
                                                                    <td class="text-end">

                                                                        ₹ <span id="delivery_charge_lable"> 0.00 </span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="bold"><span>Adjustment</span>
                                                                        <input type="number" name="round_off_amount"
                                                                            id="adjustment" value="0"
                                                                            placeholder="Adjustment amount" min="0"
                                                                            onkeyup="calculation();"
                                                                            class="form-control-sm form-control"
                                                                            style="float:inline-end;width:150px;" />

                                                                    </td>
                                                                    <td class="text-end">

                                                                        -₹ <span id="adjustment_lable"> 0.00 </span>
                                                                    </td>
                                                                </tr>
                                                                {{--   <tr>
                                                                <td class="bold">Shipping</td>
                                                                <td>₹ 0.00</td>
                                                            </tr> --}}
                                                                <tr>
                                                                    <td class="bold font-size-18">Grand Total
                                                                    </td>
                                                                    <td class="text-end">
                                                                        <input type="hidden" name="total_amount"
                                                                            id="total_amount_value" placeholder="amount"
                                                                            class="form-control-sm form-control" />
                                                                        ₹<span class="font-size-18 font-weight-bold"
                                                                            id="total_amount_label">
                                                                            00.00</span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card card-body p-2 pt-1">
                                            <div class="row">

                                                <input type="hidden" name="mode_status" id="mode_status"
                                                    value="">

                                                <div class="col-sm-12 text-center">
                                                    <button onclick="addsale('unpaid')" type="button"
                                                        class="btn btn-success mt-2" >Add
                                                        {{ $page }}</button>
                                                    <button onclick="addsale('draft')" type="button"
                                                        class="btn btn-primary mt-2">
                                                        Draft
                                                        {{ $page }}</button>
                                                </div>



                                               
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    @endslot
</x-layout>


<div class="modal fade" id="discount-sec" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Discount</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="discount_coupon_field">

                <form class="form-inline">
                    <div class="form-group mb-2">
                     
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                      <label for="inputPassword2" class="sr-only">Percentage</label>
                      <select class="form-control" id="discount_percentage_dd" name="discount_percentage_dd" >

                        <option value="20" selected>20%</option>
                        <option value="25">25%</option>
                        <option value="30">30%</option>
                        <option value="35">35%</option>
                      </select>
                    </div>
 
                   
                    <button type="button" class="btn btn-primary mb-2" onClick="confirm_discount_check();">Apply Special Discount</button>
 
                  </form>

            </div>
        </div>
    </div>
</div>
</div>

{{-- ================== END MODAL ============== --}}
{{-- ===================MODAL INVOICE ===========- --}}

<div class="modal fade" id="invoice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Tax Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    onclick="modalclosethis('invoice');"></button>
            </div>
            <div class="modal-body" id="tax_invoice">
            </div>
        </div>
    </div>
</div>

{{-- --============= END MODAL ======================== --}}
<script>
    $(document).ready(function() {
        var i = 1;
        //tax();



        $('#publisher_id').change(function() {
            fetchProducts(0);
        });


        $('#add').click(function() {

            i++;
            j = i - 1;

            var return_status = 1;

            $(".my_row_id").each(function() {

                var compare_id = $(this).val();
                if ($('#product' + compare_id).val() == '' || $('#product' + compare_id)
                .val() == null) {
                    return_status = return_status * 0;
                    alert('Select Book first');
                } else {
                   // return_status = return_status * 1;

                   if ($('#reqqty' + compare_id).val() == '' || $('#reqqty' + compare_id)
                    .val() == null || $('#reqqty' + compare_id)
                    .val() ==0) {
                        return_status = return_status * 0;
                        alert('Please give quantity');
                    } else {
                        //return_status = return_status * 1;
                    }
                }

               

                

            });
            // alert(return_status);
            if (return_status == 1) {
                $('#dynamic_field').append('<tr id="row' + i +
                    '" class="dynamic-added" ><td><input type="text" id="slno' + i + '" value="' +
                    i +
                    '"readonly class="form-control-sm form-control" style="border:none;" />  </td>' +
                    '<td width="18%">  <input type="hidden" class="my_row_id" value="' + i +
                    '" > <select ' +
                    'onchange="price_get(this.value,' + i + ')"' +
                    '" name="products[]" id="product' + i +
                    '" placeholder="Search products.."  class="form-control products selectpicker prod_dd " data-live-search="true" > ' +
                    '</select>' +
                    '<br><small class="availbal_qty' + i + '" id="availbal_qty' + i + '"></small>' +
                    '</td>' +
                    //'<datalist id="product' + i + '"></datalist> <small class="availbal_qty'+i+'"></small>' +
                    '<td><input   onkeyup="qtyCal(this.value,' + i +
                    ')" onclick="qtyCal(this.value,' + i +
                    ')"   type="number" name="request_qty[]"  id="reqqty'+i+'" placeholder="Qty" class="form-control-sm form-control request_qty req_q' +
                    i + ' " onkeyup="calculation()" onclick="calculation()" /></td>' +
                    '<td><input type="number" readonly  name="price[]" placeholder="price"  class="form-control-sm form-control price price_per_u' +
                    i + ' " onkeyup="calculation()" onclick="calculation()" /> ' +
                    '<input type="hidden"   name="array_tax_percentage[]" id="arr_tax_amt' + i +
                    '" class="array_tax_amount "  /> </td>' +
                    // ' <td><input type="number" name="array_taxeble_amount[]"placeholder="taxeble_amount" class="form-control-sm form-control array_taxeble_amount " onkeyup="calculation()" onclick="calculation()" /></td>' +
                    ' <td><input type="number" readonly name="array_total_amount[]" placeholder="amount" class="form-control-sm form-control array_total_amount arr_total_amt' +
                    i + ' " onkeyup="calculation()" onclick="calculation()" /> </td>' +
                    '<td><button type="button" onclick="qtyCal(this.value,' + i +
                    ')" name="remove" id="' + i +
                    '" class="btn btn-outline-danger btn-sm btn_remove"><i class="fas fa-times"></i></button></td></tr>'
                    );
                //product(i);
                fetchProducts(i);
            }
        });



        function fetchProducts(index) {
            <?php  if (isCentral()) {
                ?>


            var pub_id = $('#publisher_id0').val();
            <?php 
            }
            else{
                ?>

            var pub_id = $('#publisher_id').val();
            <?php 

            }
            ?>
            // alert('{{ route('manual.newbook', ':pub_id') }}'.replace(':pub_id', pub_id));

            if (pub_id) {
                $.ajax({
                    type: "GET",
                    url: '{{ route('manual.newbook', ':pub_id') }}'.replace(':pub_id', pub_id),
                    success: function(data) {
                        //alert(data);

                        var all_selected_prod = [];
                        $(".prod_dd").each(function() {

                            if ($(this).val() > 0) {
                                all_selected_prod.push(parseInt($(this).val()));
                            }

                        });

                        var dropdown = $('#product' + index);
                        dropdown.empty(); // Clear existing options

                        $.each(data, function(key, value) {


                            if (all_selected_prod.indexOf(value.id) > -1) {

                           



                            } else {
                                dropdown.append($('<option>').text(value.title).attr(
                                    'value',
                                    value.id));

 
                            }

                        });

                        // Trigger the Bootstrap Selectpicker to refresh the dropdown
                        dropdown.selectpicker('refresh');
                    }
                });
            }
        }

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
            qtyCal(this.value, 0);
        });



        $(document).on('change', '#customer_id', function() {
            var customer_id = $(this).val();
            //alert("{{ route('sale.pendinginvoice.customer_id') }}/" + customer_id);
            // editForm('{{ route('sale.get_cus.invoice') }}/' + customer_id, 'tax_invoice');
            target_id = 'tax_invoice';
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    if (this.responseText != 'false') {
                        document.getElementById(target_id).innerHTML = this.responseText;
                        $('#invoice').modal('show');
                    }

                }

                if (this.status == 404) {
                   // console.log('no')

                }
            };


            xhttp.open('GET', "{{ route('sale.pendinginvoice.customer_id') }}/" + customer_id, true);
            xhttp.send();
            if ($('#storage_site_id').val() == '') {
                alert("Please select warehouse");
            }
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


    });

    function qtyCal(thisval, position) {
        //alert(thisval);
        //alert(position);
        if (thisval !== undefined) {

            var max_val = document.getElementsByClassName('req_q' + position)[0].max;
            var min_val = document.getElementsByClassName('req_q' + position)[0].min;

            max_val = parseInt(max_val);
            min_val = parseInt(min_val);
            thisval = parseInt(thisval);

            //alert(thisval+'....'+position+'----'+max_val+'===='+min_val);
            if (thisval > max_val) {
                document.getElementsByClassName('req_q' + position)[0].value = max_val;
            } else if (thisval < min_val) {
                document.getElementsByClassName('req_q' + position)[0].value = min_val;
            }

        }
        document.getElementById('discount').value = '';
        document.getElementById('total_discount').innerText = '';
        document.getElementById('discount_percentage').innerText = '';

        const request_qty = document.getElementsByClassName('request_qty');
        const price = document.getElementsByClassName('price');
        // var array_taxeble_amount = document.getElementsByClassName('array_taxeble_amount');
        var array_total_amount = document.getElementsByClassName('array_total_amount');
        var array_tax_amount = document.getElementsByClassName('array_tax_amount');
        for (i = 0; i < request_qty.length; i++) {
            // array_taxeble_amount[i].value = Number(request_qty[i].value) * Number(price[i].value).toFixed(2);
            total_amount_without_tax = Number(request_qty[i].value) * Number(price[i].value).toFixed(2);
            // array_total_amount[i].value = total_amount_without_tax + ((total_amount_without_tax / 100) * Number(
            //     array_tax_amount[i].value))
            array_total_amount[i].value = total_amount_without_tax;
        }
        calculation();
    }



    function calculation() {

        const array_tax_amount = document.getElementsByClassName('array_tax_amount');
        const array_taxeble_amount = document.getElementsByClassName('array_taxeble_amount');
        const array_total_amount = document.getElementsByClassName('array_total_amount');
        const array_cgst = document.getElementsByClassName('array_cgst');
        const array_sgst = document.getElementsByClassName('array_sgst');
        const array_igst = document.getElementsByClassName('array_igst');
        // for seting the value into the total amount
        var tax_amount = document.getElementById('tax_amount');
        const taxeble_amount = document.getElementById('taxeble_amount');
        const total_amount = document.getElementById('total_amount');
        const cgst = document.getElementById('cgst');
        const igst = document.getElementById('igst');
        const sgst = document.getElementById('sgst');

        var total_tax_amount = 0;
        var total_taxeble_amount = 0;
        var total_total_amount = 0;
        var total_igst = 0;
        var total_sgst = 0;
        var total_cgst = 0;


        for (i = 0; i < array_total_amount.length; i++) {

            total_total_amount = total_total_amount + Number(array_total_amount[i].value);

        }
        //console.log(total_tax_amount);

        //alert(total_total_amount);
        //getHidden();


        $('#taxeble_amount_label').html(total_total_amount.toFixed(2));
        $('#taxeble_amount').val(total_total_amount.toFixed(2));

        var tax_percentage_label = $('#tax_percentage_label').html();

        //total_discount
        var total_discount = $('#total_discount').html();
        if (total_discount == '') {
            total_discount = 0;
        }
        total_discount = parseFloat(total_discount);

        tax_percentage_label = parseFloat(tax_percentage_label);
        var total_tax_amount = (tax_percentage_label * (total_total_amount - total_discount)) / 100;
        total_tax_amount = total_tax_amount.toFixed(2);
        $('#total_tax_lable').html(total_tax_amount);
        $('#total_tax').val(total_tax_amount);

        var adjustment = $('#adjustment').val();
        if (adjustment == '' || adjustment == null) {
            adjustment = 0;
        }
        adjustment = parseFloat(adjustment);
        $('#adjustment_lable').html(adjustment.toFixed(2));

        var delivery_charge = $('#delivery_charge').val();
 
        console.log('delivery_charge=' + delivery_charge);

 
        if (delivery_charge == '' || delivery_charge == null) {
            delivery_charge = 0;
        }
        delivery_charge = parseFloat(delivery_charge);
        $('#delivery_charge_lable').html(delivery_charge.toFixed(2));

        var grand_total = parseFloat(total_total_amount) + parseFloat(total_tax_amount) + parseFloat(delivery_charge) -
            parseFloat(adjustment) - parseFloat(total_discount);
        grand_total = parseFloat(grand_total);
        $('#total_amount_label').html(grand_total.toFixed(2));
        $('#total_amount_value').val(grand_total.toFixed(2));

        confirm_discount();


    }


    function getHidden() {
        document.getElementById('total_tax_lable').innerText = document.getElementById('total_tax').value;
        document.getElementById('taxeble_amount_label').innerText = document.getElementById('taxeble_amount').value;


        const array_tax_amount = document.getElementsByClassName('array_tax_amount');
        const array_total_amount = document.getElementsByClassName('array_total_amount');

        var total_tax_amount = 0;
        var total_total_amount = 0;

        for (i = 0; i < array_total_amount.length; i++) {
            total_tax_amount = total_tax_amount + Number(array_tax_amount[i].value);
            total_total_amount = total_total_amount + Number(array_total_amount[i].value);
        }

        const tax_percentage = document.getElementById('tax_percentage');
        tax_percentage.innerText = (Number(total_tax_amount) / array_tax_amount.length).toFixed(2);

        const taxebleAmountLabel = document.getElementById('taxeble_amount_label');
        taxebleAmountLabel.innerText = total_total_amount.toFixed(2);

        const total_tax_label = document.getElementById('total_tax_label');
        total_tax_label.innerText = '₹ ' + total_tax_amount.toFixed(2);
    }



    function price_get(product_id, prosition) {
        var xhttp = new XMLHttpRequest();
        formdata = new FormData(document.getElementById('form_data'));
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.responseText);
                data = JSON.parse(this.responseText)
                // console.log(data);
                var positionIndex = prosition;

                //alert(data.stock.qty)

                // Update the elements with the specified class names
                //document.getElementsByClassName('req_q' + positionIndex)[0].value = 1;
                document.getElementsByClassName('price_per_u' + positionIndex)[0].value = data.price;
                document.getElementsByClassName('arr_total_amt' + positionIndex)[0].value = data.price;
                //document.getElementById('arr_tax_amt' + positionIndex).value = data.gst.tax;
                //alert(data.stock);
                var total_qty_ext = 0;
                if (data.stock) {
                    document.getElementById('availbal_qty' + positionIndex).innerText = "Avl Qty  :" + data
                        .stock.qty;
                    document.getElementsByClassName('req_q' + positionIndex)[0].max = data.stock.qty;
                    document.getElementsByClassName('req_q' + positionIndex)[0].min = 1;
                    document.getElementsByClassName('req_q' + positionIndex)[0].value = 1;
                    total_qty_ext = data.stock.qty;
                } else {
                    document.getElementById('availbal_qty' + positionIndex).innerText = "Avl Qty  :0";

                    document.getElementsByClassName('req_q' + positionIndex)[0].max = 0;
                    document.getElementsByClassName('req_q' + positionIndex)[0].min = 0;
                    document.getElementsByClassName('req_q' + positionIndex)[0].value = 0;
                    total_qty_ext = 0;
                }

                if (total_qty_ext == 0) {
                    //alert(prosition);
                    $('#product' + prosition).val('').change();
                    $('#product' + prosition).selectpicker('refresh');
                    alert('This book is not exist in your store, Please add book in your store');
                }

                // document.getElementsByClassName('req_q' + positionIndex)[0].value = 

                // let avlqty = data.stock.qty;

                // alert(avlqty);

                qtyCal(this.value, 0);
            }
        };
        xhttp.open('POST', "{{ route('sale.product.price') }}/" + product_id, true);
        xhttp.send(formdata);

    }

   
    function confirm_discount()
    {
        var discount_percentage = $('#discount_percentage_dd').val();
        discount_percentage=parseFloat(discount_percentage);
        var taxeble_amount = $('#taxeble_amount').val();
        taxeble_amount=parseFloat(taxeble_amount);

        $('#discount_p').val(discount_percentage);

        if((taxeble_amount )> 0 && (discount_percentage > 0))
        {
            var tot_dis = ((taxeble_amount * discount_percentage ) / 100);
            apply_discount(tot_dis, discount_percentage);
 

        }
        
        
    } 

    function confirm_discount_check()
    {
        var discount_percentage = $('#discount_percentage_dd').val();
        if(discount_percentage==20)
        {
            confirm_discount();
        }
        else 
        {
            var confstatus = confirm("Please confirm if the customer's purchase is eligible for the special discount.");
            if(confstatus)
            {
                confirm_discount();
            }
            else 
            {
                $('#discount_percentage_dd').val(20).change();
            }
 
        }
        
        
    }



    
 
    function apply_discount(dis_amt, dis_per) {
        // alert(dis_amt+"========"+dis_per);

        document.getElementById('discount').value = dis_amt;
        document.getElementById('total_discount').innerText = dis_amt.toFixed(2);
        document.getElementById('discount_percentage').innerText = dis_per + '%';
        $('#discount-sec').modal('hide');
        // total_amt = document.getElementById('total_amount').value;
        // document.getElementById('total_amount').value = Number(total_amt) - Number(dis_amt);
        // document.getElementById('total_amount_label').innerText = document.getElementById('total_amount').value;

        document.getElementById('discount-span').innerText = 'Applied ';

        //$('#discount-sec').modal('hide');
        calculation();
    }




    function addsale(mode) {
        var return_status = 1;

            $(".my_row_id").each(function() {

                var compare_id = $(this).val();
                if ($('#product' + compare_id).val() == '' || $('#product' + compare_id)
                .val() == null) {
                    return_status = return_status * 0;
                    alert('Select Book first');
                } else {
                   // return_status = return_status * 1;

                   if ($('#reqqty' + compare_id).val() == '' || $('#reqqty' + compare_id)
                    .val() == null || $('#reqqty' + compare_id)
                    .val() ==0) {
                        return_status = return_status * 0;
                        alert('Please give quantity');
                    } else {
                        //return_status = return_status * 1;
                    }
                }

               

                

            });
            // alert(return_status);

            var customer_id = $('#customer_id').val();
            var storage_site_id = $('#storage_site_id').val();

            if(customer_id=='' || customer_id==null)
            {
                alert('Select Customer');
            }
            else  if(storage_site_id=='' || storage_site_id==null)
            {
                alert('Select warehouse');
            }
            

            if ((return_status == 1) && (customer_id > 0) && (storage_site_id > 0)) {

                 // $('#invoice').modal('show');
                //alert(mode);
                document.getElementById('mode_status').value = mode;
                if (mode == 'unpaid') {

                    //var invoice_no1 = document.getElementById('invoice_no').value;
                    //selectDrop('form_data_pos','{{ route('pos.cartstore') }}', 'tax_invoice');

                    var form = document.getElementById('form_data');
                    var url_name = form.action;
                    var method = "POST"
                    target_id = 'tax_invoice';

                    var formdata = new FormData(form);
                    var formElements_button = Array.from(form.elements).pop();
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            //alert(this.responseText);
                            document.getElementById(target_id).value = this.responseText;
                            document.getElementById(target_id).innerHTML = this.responseText;

                            window.location.href='{{route("sale.index")}}';

                        }
                    };
                    xhttp.open(method, url_name, true);
                    xhttp.send(formdata);

                     

                    // $('#invoice').modal('show');
 

                }

                if (mode == 'draft') {
                    ajaxCall('form_data', '{{ route('sale.index') }}');
                }
            }

    }
</script>

<!-- // model -->
