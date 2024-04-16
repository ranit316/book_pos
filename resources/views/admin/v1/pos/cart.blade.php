
<div class="p-2 pt-1 border rounded">
    <div class="table-responsive-lg" id="pos-slctd-prod-table">
        <table class="table mb-0">
            <thead class="text-center">
                <tr>
                    <th class="col-sm-3">Item</th>
                    {{-- <th class="col-sm-2">Batch No</th> --}}
                    <th class="col-sm-2">Price</th>
                    <th class="col-sm-2">Quantity</th>
                    <th class="col-sm-2">SubTotal</th>
                    <th class="col-sm-1">Action</th>
                </tr>
            </thead>

            <tbody class="text-center" id="res">

                @foreach ($carts as $cart)
                    <tr id="{{ $cart->id }}">
                        <td class="col-sm-4 product-title">

                            <button type="button" class="edit-product btn btn-link p-0" data-toggle="modal"
                                data-target="#editModal"><span><strong>{{ $cart->product->title }}
                                    </strong></span>
                            </button>
                        </td>
                        {{-- <td class="col-sm-2">
                            <input type="text" class="form-control batch-no" disabled=""> <input type="hidden"
                                class="product-batch-id" name="product_batch_id[]">
                        </td> --}}
                        <td class="col-sm-2 product-price">{{ $cart->price }}</td>
                        <td class="col-sm-2">
                            
                            <?php 
                            $avl_qty = \App\Models\MasterStockInventery::where('store_id', loginStore()->id)->where('product_id',$cart->product->id)->first()->qty;
                           
                            ?>
                            <select
                                onchange="editForm('{{ route('pos.cart.updateqty', $cart->id . '-') }}'+this.value,'pos_cart');confirm_discount_after_5sec();"
                                class="form-select form-select-sm cartquantity" style="height: 100px, overfloe-y:auto"
                                name="qty[]">
                                <?php 
                                if($avl_qty >= 100)
                                {
                                for($i = 1; $i <= 100; $i++)
                                    {?>
                                        <option value="{{ $i }}" {{ $i == $cart->qty ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    <?php 
                                    }
                                }
                                else {
                                    for($i = 1; $i <= $avl_qty; $i++)
                                    {?>
                                        <option value="{{ $i }}" {{ $i == $cart->qty ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    <?php 
                                    }
                                }
                                ?>
                            </select>
                        </td>
                        <td class="col-sm-3 sub-total">{{ $cart->price * $cart->qty }} </td>
                        <td class="col-sm-1"><button
                                onclick="editForm('{{ route('pos.cart.delete', $cart->id) }}','pos_cart');confirm_discount_after_5sec();"
                                type="button" class="ibtnDel btn btn-danger-subtle font-size-10 p-1 py-0 ms-2"><i
                                    class="fas fa-times
"></i></button></td>

                    </tr>
                @endforeach


            </tbody>

        </table><!-- end table -->
    </div>

</div>
<div class="col-12 totals" style="padding-top: 10px;">
<div class="row mb-2">

<div class="col-sm-4">
            <span class="totals-title me-1">Items</span>
            <br/>
            <span
                id="item">{{ $carts->count() }}({{ $qty }})</span>
        </div>
        <div class="col-sm-4">
            <span class="totals-title">Sub-Total</span> <br/> <span id="subtotal">{{ $prices }}.00</span>
        </div>
        <div class="col-sm-4">
            <span class="totals-title">Applied Discount <button type="button" class="btn btn-link btn-sm p-0"
                    data-bs-toggle="modal" data-bs-target="#discount-sec"
                  ><i
                        class="bx bx-edit"></i></button></span>
                        <br/>
                        <span id="coupon_text">{{ $data->coupon_code ?? '' }}</span>
                        <span id="discount_percentage"></span>

                        <input  type="hidden" id="discount_p"
                        name="discount_p"
                          value="0"
                           />

                           <input  type="hidden" id="discount_value"
                        name="discount_value"
                          value="0"
                           />
        </div>

</div>
    <div class="row">

        <div class="col-sm-4">
            <span class="totals-title">Discount</span><br>-₹<span id="discount">{{ $disamount ?? '0.00' }}</span>
        </div>
        <div class="col-sm-4">
            <span class="totals-title">Tax <button type="button" class="btn btn-link btn-sm ps-0" data-toggle="modal"
                    data-target="#order-tax"></button></span><br>
                

                <input type="hidden" name="tax_amount"
                id="total_tax" placeholder="total tax"
                class="form-control-sm form-control" value="{{ $tax_amount }}" />
            <input type="hidden" id="tax_percentage"
                placeholder="tax percentage"
                class="form-control-sm form-control" value="{{ $tax->tax }}" />

            ₹ <span id="total_tax_lable">{{ $tax_amount }} </span>( <span
                id="tax_percentage_label">{{ $tax->tax }}</span>%)

                <input type="hidden" id="tax_percentage_value"  name="tax_percentage_value" value="{{ $tax->tax }}" />

        </div>
        <div class="col-sm-4">
            <span class="totals-title">Shipping <button type="button" class="btn btn-link btn-sm ps-0"
                    data-toggle="modal" data-target="#shipping-cost-modal"></button></span><br><span id="shipping_cost">₹0.00</span>
        </div>
        <div class="col-sm-4 col-xl-4 align-self-center">
            <span class="totals-title">Note <button type="button" class="btn btn-link btn-sm ps-0" data-toggle="modal"
                    data-target="#purchase-sec" id="pnote" onclick="cus_note()"><i
                        class="bx bx-edit"></i></button></span>
        </div>
        <div class="col-sm-8 col-xl-8 text-xl-end mt-2">
            <span class="totals-title">Adjustment</span> <input onkeyup="adjustment(this.value)"
                class="form-control py-1 d-inline-block" style="width: 60%" type="number" id="round_off" name="round_off"
                pattern="^(\d+(\.\d{1,2})?|0\.(\d{1,2})?)$" placeholder="0.00">
        </div>
    </div>
</div>
<div class="payment-amount text-center bg-light p-2 mt-3 border rounded">
    <h4 class="mb-0 text-primary">Grand Total ₹<span
            id="grand_total">{{ number_format($prices - $disamount + $tax_amount, 2) }}</span>
    </h4>
</div>
{{-- ================== hidden inputs ================ --}}
<input type="hidden" name="taxeble_amount" value="{{ $prices }}" id="taxeble_amount"placeholder="taxeble_amount"
    class="form-control-sm form-control" />
 



<input readonly type="hidden" name="discount" value="{{ $disamount ?? '0.00' }}" id="discount"
    placeholder="discount" class="form-control-sm form-control" />
<input readonly type="hidden" name="coupon_text" value="{{ $data->coupon_code ?? '' }}" id="coupon_text"
    placeholder="discount" class="form-control-sm form-control" />

<input type="hidden" name="description" id="description">

<input type="hidden" name="total_amount"
    value="{{ str_replace(',', '', number_format($prices - $disamount + $tax_amount, 2)) }}" id="total_amount"
    placeholder="amount" class="form-control-sm form-control" />
{{-- ===================hidden end======================= --}}
<div class="modal fade" id="discount-sec" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Discount</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="dis_offer">
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

{{-- ------------------------------ purchase note---------------- --}}

<div class="modal fade" id="purchase-sec" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Sales Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="">
                <textarea class="form-control" name="purchase_note" id="purchase_note" rows="5"></textarea>
                <small class="d-block">*Maximum Characters 286 Words 50</small>
                <button type="button" class="btn btn-success mt-2 note_pur" id="sdffsz"
                    onclick="pur_note()">Submit</button>
            </div>

        </div>
    </div>
</div>
</div>



<script>
    // for the paginatin purpose 
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page) {
            selectDrop('form_data_pos', '{{ route('pos.search') }}?page=' + page, 'book_list')
        };

        $(document).(function() {
            var total = $('#subtotal').text();
            console.log(total);
        });

        $('#pnote').click(function() {
            $('#abc').toggleClass('d-none');

        });


    });


    /*  function updateQty(cartqty) {
alert(cartqty);
        var route = "/pos.update_cart";

        if (qty <= 0) {

            alert("Please enter quantity greater then 0.");
        } else {
           

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
            method:'POST',
            dataType:'json',
            url:'/getdata',
            data: { cartid: '', qty: cartqty }
            success:function(data) {
               $("#data").html(data.msg);
            },
            error: function (msg) {
               console.log(msg);
               var errors = msg.responseJSON;
            }
         });
        }
    } */

    // Add this script to handle visibility and states
    // document.addEventListener('DOMContentLoaded', function () {
    //     var discountAmount = parseFloat("{{ $disamount }}");

    //     if (discountAmount > 0) {
    //         // If discount amount is greater than 0, disable the buttons and show "applied"
    //         //document.getElementById('discount-amount').innerHTML = discountAmount.toFixed(2);
    //         document.getElementById('discount-sec').disabled = true;
    //         document.getElementById('coupon-text').innerHTML = 'applied';
    //     }
    // });
</script>
