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
                                        <h4 class="card-title">{{ $page }} Edit</h4>
                                    </div>
                                    <a class="btn btn-primary add-list btn-sm text-white"
                                        href="{{ route('requisition-request.index') }}"><i class="las la-plus mr-3"></i>Back to
                                        {{ $page }} List</a>
                                </div>
                                <!-- Modal body -->


                                <div class="card-body">
                                    <form id="form_update" action="{{ route('requisition-request.update', $data->id) }}"
                                        method="POST">
                                        <div class="row">
                                            @csrf
                                            @method('PUT')
                                            @if (isCentral())
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="store_id" class="required">From Store</label>
                                                        <select id="store_id" required class="form-control  "
                                                            data-live-search="true" >
                                                            <option value="{{ $data->store_id }}">
                                                                {{ $data->store->store_name }} 
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="to_store" class="required">To Store</label>
                                                        <select id="to_store" required class="form-control  "
                                                            data-live-search="true" >
                                                            <option value="{{ $data->store_id }}">
                                                                {{ $data->store2->store_name }}  
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (isPublisher())
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="store_id" class="required">From Store</label>
                                                        <select id="store_id" required class="form-control  "
                                                            data-live-search="true" placeholder="Enter  Supplier ">
                                                            <option value="{{ $data->store_id }}">
                                                                {{ $data->store->store_name }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="supplier_id" class="required">Supplier</label>
                                                        <select id="supplier_id" required class="form-control "
                                                            data-live-search="true" placeholder="Enter  Supplier "
                                                            name="supplier_id">
                                                            <option value="{{ $data->supplier->id }}">
                                                                {{ $data->supplier->name }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif 
                                            
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="requisition_no" class="required">Requisition No</label>
                                                    <input id="requisition_no" name="requisition_no" required type="text"
                                                        class="form-control" readonly value="{{ $data->requisition_no }}"
                                                        placeholder="Enter Purchase no" name="requisition_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="transport_charge" class="optional">Transport Charge</label>  
                                                    <input id="transport_charge" type="number"
                                                        value="{{ ($data->transport_charge=='')?0: $data->transport_charge}}" class="form-control"
                                                        placeholder="transport_charge" name="transport_charge"  min="0" onkeyup="calculation();"> 
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="requisition_date" class="required">Requisition Date</label>
                                                    <input id="requisition_date" required
                                                        value="{{ $data->requisition_date }}" type="date"
                                                        class="form-control" readonly 
                                                        name="requisition_date">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="expected_delivery_date"
                                                        class="required">Expected Delivery Date</label>
                                                    <input  id="expected_delivery_date" required
                                                        value="{{ ($data->expected_delivery_date=='')?date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d')))): $data->expected_delivery_date}}" type="date"
                                                        class="form-control" 
                                                        name="expected_delivery_date">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="status" class="required">Status</label>
                                                    <select id="status" name="status" required
                                                        class="form-control selectpicker" data-live-search="true"
                                                        name="status">
                                                        <option disabled> - Select Status - </option>
                                                        <option {{ $data->status == 'pending' ? 'selected' : '' }}
                                                            value="pending"> Pending</option>
                                                        <option {{ $data->status == 'rejected' ? 'selected' : '' }}
                                                            value="rejected"> Rejected</option>
                                                        <option {{ $data->status == 'approved' ? 'selected' : '' }}
                                                            value="approved"> Approved </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="optional"> Transport Details</label>
                                                    <textarea type="text" class="form-control" placeholder="transport_details" name="transport_details">{{ $data->transport_details }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="optional"> Description</label>
                                                    <textarea type="text" class="form-control" placeholder="Enter name" name="description">{{ $data->description }}</textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="card-body table-responsive">
                                                <table class="table table-bordered " id="dynamic_field"
                                                    style="overflow-y:auto;">
                                                    <thead>
                                                        <tr>
                                                            <th data-field="S.NO" data-sortable="true" rowspan="2">
                                                                S.NO
                                                            </th>
                                                            <th>Products </th>
                                                            <th>Quantity</th>
                                                            <th>Price </th>
                                                          
                                                            <th>Total Amount</th>
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data->details as $p)
                                                           

                                                            <tr id="row{{ $loop->index + 1 }}">
                                                                <td width="2%"><input type="text" id="slno1"
                                                                        value="{{ $loop->index + 1 }}" readonly
                                                                        class="form-control " style="border:none;" /></td>
                                                                <td width="18%"><select name="products[]"
                                                                        id="product" 
                                                                      
                                                                        class="form-control form-control-sm selectpicker "
                                                                        data-live-search="true">
                                                                        <option disabled> -Search Products-</option>
                                                                        @foreach ($products as $product)
                                                                            <?php if($product->id == $p->product_id)
                                                                            {
                                                                                ?>
                                                                                 <option
                                                                                {{ $product->id == $p->product_id ? 'selected' : '' }}
                                                                                value="{{ $product->id }}" >
                                                                                {{ $product->title }}</option>
                                                                                <?php 
                                                                            }
                                                                            else{
                                                                                ?>
                                                                                 <option
                                                                                {{ $product->id == $p->product_id ? 'selected' : '' }}
                                                                                value="{{ $product->id }}" disabled>
                                                                                {{ $product->title }}</option>
                                                                                <?php 

                                                                            }
                                                                            ?>
                                                                           
                                                                        @endforeach
                                                                    </select> 
                                                                    <?php $sale_price = \App\Models\MasterStockInventery::where('store_id', loginStore()->id)->where('product_id', $p->product_id)->first();
                                                                    $avlQty = $sale_price ? $sale_price->qty : 0;
                                                                    ?>
                                                                Avl Qty : {{$avlQty}}
                                                                </td>

                                                                <td>

                                                                   
                                                                   



                                                               
                                                                    <input
                                                                        onkeyup="qtyCal();check_positive(this.value,{{ $p->id }});"
                                                                        onclick="qtyCal()" type="number"
                                                                        name="request_qty[]"
                                                                        value="{{ $p->request_qty }}"
                                                                        placeholder="Request Qty"
                                                                        class="form-control-sm form-control request_qty" min="1" id="request_qty_{{ $p->id }}" readonly />
                                                                   
                                                                </td>
                                                                <td><input  onkeyup="qtyCal();"
                                                                        onclick="qtyCal()" type="number" name="purchase_price[]"
                                                                        value="{{ ($p->purchase_price=='')?$p->price:$p->purchase_price }}" placeholder="price"
                                                                        class="form-control-sm form-control purchase_price" />

                                                                        <input   type="hidden" name="price[]"
                                                                        value="{{ $p->price }}" />
                                                             
                                                            

                                                           
                                                          
                                                                <input type="hidden" class="tax"
                                                                    {{-- value="{{ $p->product->gst->tax }}"> --}}>
                                                                <input onkeyup="qtyCal()" onclick="qtyCal()"
                                                                    type="hidden" name="array_tax_amount[]"
                                                                    value="" placeholder="tax_amount"
                                                                    class="form-control-sm form-control array_tax_amount" />


                                                                <input onkeyup="qtyCal()" onclick="qtyCal()"
                                                                    type="hidden" name="array_taxeble_amount[]"
                                                                    value="{{ $p->taxeble_amount }}"
                                                                    placeholder="taxeble_amount"
                                                                    class="form-control-sm form-control array_taxeble_amount" />
                                                            </td>                                                       

                                                                <td><input onkeyup="qtyCal()" onclick="qtyCal()"
                                                                        type="number" name="array_total_amount[]"
                                                                        value="{{ $p->total_amount }}"
                                                                        placeholder="total_amount"
                                                                        class="form-control-sm form-control array_total_amount" readonly/>
                                                                </td>


                                                             

                                                            </tr>
                                                        @endforeach

                                                    </tbody>

                                                     <tfoot>

                                                        <tr>
                                                            <th colspan="3"></th>
                                                            
                                                            <th>Sub Total
                                                          
                                                            <input type="hidden" name="tax_amount" id="tax_amount"
                                                                value="{{ $data->tax_amount }}" placeholder="tax_amount"
                                                                class="form-control-sm form-control" />

                                                            <input type="hidden" name="taxeble_amount"
                                                                id="taxeble_amount" value="{{ $data->taxeble_amount }}"
                                                                placeholder="taxeble_amount"
                                                                class="form-control-sm form-control" /> </th>

                                                            <th><input type="number" 
                                                                    id="total_amount" value="{{ $data->total_amount }}"
                                                                    placeholder="total_amount"
                                                                    class="form-control-sm form-control" readonly /> </th>
                                                            
                                                          
                                                        </tr>
                                                    </tfoot>  
                                                </table>

                                                <div class="row">
                                                    <div class="col-sm-7"></div>
                                                    <div class="col-sm-5">
                                                        <table class="table table-striped table-sm">
                                                            <tbody>



                                                                <tr>
                                                                    <td class="bold">Order Amount</td>
                                                                    <td>
                                                                        <input type="hidden" 
                                                                            id="taxeble_amount"
                                                                            placeholder="taxeble_amount"
                                                                            class="form-control-sm form-control" /> </th>
                                                                        ₹ <span id="taxeble_amount_label"> 0.00 </span>
                                                                    </td>
                                                                </tr>
                                                               
                                                                <tr>
                                                                    <td class="bold"><span id=discount-span>
                                                                        </span>Discount
                                                                        
                                                                    </td>
                                                                    <td>
                                                                        <input readonly type="hidden" 
                                                                            id="discount" placeholder="discount"
                                                                            class="form-control-sm form-control" />
                                                                            ₹<span id="total_discount">0.00 </span> <span
                                                                            id="discount_percentage"></span> 
                                                                    </td> 
                                                                </tr>
                                                               
                                                                
                                                                <tr>
                                                                

                                                                    <td class="bold"><?php 
                                                                        $tax_name='';
                                                                        $tax_rate=0;
                                                                        $gstslab =\App\Models\GstSlab::first();
                                                                        if(!empty($gstslab)){
                                                                            $tax_name =  $gstslab->name;
                                                                            $tax_rate =  $gstslab->tax;
                                                                        }
                                                                        
                                                                        ?>Tax - {{$tax_name}}</td>
                                                                    <td>
                                                                       
                                                                        <input type="hidden" name="tax_amount"
                                                                            id="total_tax" placeholder="total tax"
                                                                            class="form-control-sm form-control" />
                                                                            <input type="hidden" 
                                                                            id="tax_percentage" placeholder="tax percentage"
                                                                            class="form-control-sm form-control" />

                                                                        ₹ <span id="total_tax_lable">  </span>( <span
                                                                            id="tax_percentage_label">{{$tax_rate}}</span>%)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="bold"><span>Transport Charge</span>
                                                                   

                                                                    </td>
                                                                    <td> 
                                                                        
                                                                        ₹ <span id="transport_charge_lable"> 0.00 </span> 
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="bold"><span>Adjustment</span>
                                                                    <input  type="number" name="round_off_amount"
                                                                            id="adjustment" value="{{ $data->round_off_amount }}" placeholder="Adjustment amount"  min="0" onkeyup="calculation();"
                                                                            class="form-control-sm form-control" style="float:inline-end;width:150px;" />

                                                                    </td>
                                                                    <td>
                                                                        
                                                                        ₹ <span id="adjustment_lable"> 0.00 </span>
                                                                    </td>
                                                                </tr>
                                                                {{--   <tr>
                                                                    <td class="bold">Shipping</td>
                                                                    <td>₹ 0.00</td>
                                                                </tr> --}}
                                                                <tr>
                                                                    <td><span class="font-weight-bold">Grand Total</span>
                                                                    </td>
                                                                    <td>
                                                                        <input type="hidden" name="total_amount"
                                                                            id="total_amount_value" placeholder="amount"
                                                                            class="form-control-sm form-control" />
                                                                        ₹<span class="font-weight-bold"
                                                                            id="total_amount_label">
                                                                            00.00</span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                            <div class="col-sm-12 mt-3 text-center">
                                                <button
                                                    onclick="ajaxCall('form_update','{{ route('requisition-request.index') }}')"
                                                    type="button" class="btn btn-primary mt-2">Update
                                                    {{ $page }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="discount-sec" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="discount-sec" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" >Discount</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="discount_div">
                        aaaa

                    </div>

                </div>
            </div>
        </div>
    @endslot
</x-layout>

<script>
    $(document).ready(function() {
        var i = {{ count($data->details) }};

        $('#add').click(function() {
            i++;
            j = i - 1;

            $('#dynamic_field').append('<tr id="row' + i +
                '" class="dynamic-added" ><td><input type="text" id="slno' + i + '" value="' + i +
                '"readonly class="form-control-sm form-control" style="border:none;" /></td>' +
                '<td><select  onchange="product(this.value,' + j +
                ')" name="products[]"placeholder="Search products.." class="form-control form-control-sm  " data-live-search="true">  <option selected disabled> -Search Products-   </option> @foreach ($requisation_book as $product) <option value="{{ $product->id }}">  {{ $product->title }}</option>   @endforeach </select></td>' +
                '<td><input onkeyup="qtyCal()" onclick="qtyCal()"    type="number" name="request_qty[]" placeholder="Request Qty" class="form-control-sm form-control request_qty" /></td>' +
                '<td><input onkeyup="qtyCal()" onclick="qtyCal()"    type="number" name="price[]" placeholder="price" class="form-control-sm form-control price" /></td>' +
                // '<td><input onkeyup="qtyCal()" onclick="qtyCal()"    type="number" name="purchase_price[]" placeholder="" class="form-control-sm form-control purchase_price" /> </td>' +
                // '<td><input onkeyup="qtyCal()" onclick="qtyCal()"    type="number" name="sale_price[]" placeholder="sale_price"  class="form-control-sm form-control sale_price" /> </td>' +
                // '<td><input onkeyup="qtyCal()" onclick="qtyCal()"    type="number" name="batch_no[]" placeholder="batch_no" class="form-control-sm form-control batch_no" />  </td>' +
                // '<td width="5%"><select name="gst[]" placeholder="gst" class="form-control-sm form-control "> <option value="5">@5%</option> <option value="12">@12%</option> <option value="18">@18%</option>  <option value="28">@28%</option>   </select>  </td>' +
                '<input onkeyup="qtyCal()" onclick="qtyCal()"    type="hidden" name="array_cgst[]" placeholder="array_cgst" class="form-control-sm form-control array_cgst" />' +
                '<input onkeyup="qtyCal()" onclick="qtyCal()"    type="hidden" name="array_igst[]" placeholder="array_igst" class="form-control-sm form-control array_igst" /> ' +
                '<input onkeyup="qtyCal()" onclick="qtyCal()"    type="hidden" name="array_sgst[]" placeholder="array_sgst" class="form-control-sm form-control array_sgst" /> ' +
                '<input onkeyup="qtyCal()" onclick="qtyCal()"    type="hidden" name="array_tax_amount[]" placeholder="tax_amount"  class="form-control-sm form-control array_tax_amount" /> ' +
                ' <input onkeyup="qtyCal()" onclick="qtyCal()"    type="hidden" name="array_taxeble_amount[]"placeholder="taxeble_amount" class="form-control-sm form-control array_taxeble_amount" />' +
                ' <td><input onkeyup="qtyCal()" onclick="qtyCal()"    type="number" name="array_total_amount[]"placeholder="total_amount" class="form-control-sm form-control array_total_amount" /> </td>' +
                '<td><button type="button" name="remove" id="' + i +
                '" class="btn btn-danger btn-sm btn_remove">X</button></td></tr>');
        });

       

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

        // $('#sale_price').change();

        $('#sale_price_7777').on('change', function(e) {
            e.preventDefault();
            var sale_price = $(this).val()
            var product = $('#product').val()
            //var selected_sale_price = $('#sale_price option:selected').data('sale-price');
            //console.log(product,sale_price);
            //console.log(sale_price);
            //console.log(selected_sale_price);
            if (sale_price) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('available.qty') }}",
                    data: {
                        sale_price: sale_price,
                        product: product
                    },
                    success: function(data) {
                        alert(JSON.stringify(data));
                        $('#avlqty').text('Available Qty - ' + data.qty);
                        $('.batch_no').val(data.batch_no);

                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
        });

        // $(document).on('change', '#sale_price option', function() {
        //     var purchasePrice = $(this).data('sale-price');
        //     //alert(purchasePrice);
        //     console.log(purchasePrice);
        // });

        // document.getElementById('sale_price').addEventListener('change', function(e) {
        //     e.preventDefault();

        //     var sale_price = this.value;
        //     var product = document.getElementById('product').value;

        //     if (sale_price) {
        //         var xhr = new XMLHttpRequest();
        //         xhr.open('GET', "{{ route('available.qty') }}?sale_price=" + encodeURIComponent(
        //             sale_price) + "&product=" + encodeURIComponent(product), true);

        //         xhr.onreadystatechange = function() {
        //             if (xhr.readyState == 4) {
        //                 if (xhr.status == 200) {
        //                     var data = JSON.parse(xhr.responseText);
        //                     document.getElementById('avlqty').innerText = 'Available Qty - ' + data
        //                         .qty;
        //                 } else {
        //                     console.error(xhr.statusText);
        //                 }
        //             }
        //         };

        //         xhr.send();
        //     }
        // });




    });

    /**
     * calculate the all kind of tax according the tax percentage
     * as well as also the particular store located on the which state 
     * if both state are in same state the calculate the cgst and sgst accrodinly
     * 
     */
    function open_discount()
    {
        var total_amount = $('#total_amount').val();
        if(total_amount > 0)
        {
            $.ajax({
                    type: "GET",
                    url: "{{ route('all_discount_for_total_amount') }}",
                    data: {
                        total_amount: total_amount
                    },
                    success: function(data) {
                        //alert(JSON.stringify(data));
                        var local_html ='';
                        if(data.length > 0)
                        {
                            local_html=local_html+'<table class="table">';
                            local_html=local_html+'<tr><td>Name</td><td>Discount (%)</td><td>Coupon Code</td><td>Submit</td></tr>';
                            for(var a=0; a < data.length; a++)
                            {
                                var temp = data[a];
                                local_html=local_html+'<tr><td>'+temp.name+'</td><td>'+temp.discount+'</td><td><input type="text" id="coupon_code_'+temp.id+'" class="form-control" placeholder="Enter Coupon Code" /></td><td><button class="btn btn-primary btn-sm" onClick="check_coupon_code('+temp.id+');">Submit</button></td></tr>';
                            }
                            local_html=local_html+'</table>';
                        }
                        //alert(local_html);
                        $('#discount_div').html(local_html);
                        

                    },
                    error: function(error) {
                        //console.error(error);
                        alert('error');
                        alert(JSON.stringify(error));
                    }
                });
        }
       
    }
    function check_coupon_code(id)
    {
        var coupon_code = $('#coupon_code_'+id).val();
        var total_amount = $('#total_amount').val();
        if(coupon_code!=''){
            //alert(id+'....'+coupon_code); 
            $.ajax({
                    type: "GET",
                    url: "{{ route('check_discount_for_total_amount') }}",
                    data: {
                        total_amount: total_amount,
                        id:id,
                        coupon_code:coupon_code

                    },
                    success: function(data) {
                        alert(JSON.stringify(data));
                        
                        

                    },
                    error: function(error) {
                        //console.error(error);
                        alert('error');
                        alert(JSON.stringify(error));
                    }
                });
        }
        
    }
    function sale_price_cal(product,sale_price){
        if (sale_price) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('available.qty') }}",
                    data: {
                        sale_price: sale_price,
                        product: product
                    },
                    success: function(data) {
                        //alert(JSON.stringify(data));
                        $('#avlqty_'+product).text('Available Qty - ' + data.qty);
                        $('#batch_no_'+product).val(data.batch_no);

                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
    }
    function check_positive(val,no){
        val = parseInt(val);
        val = Math.abs(val);
        //alert(val);
        if(!isNaN(val)){
            $('#request_qty_'+no).val(val);
            qtyCal();
        }
       
    }

    function gstCal() {

        const request_qty = document.getElementsByClassName('request_qty');
        const price = document.getElementsByClassName('sale_price');

        const array_cgst = document.getElementsByClassName('array_cgst');
        const array_sgst = document.getElementsByClassName('array_sgst');
        const array_igst = document.getElementsByClassName('array_igst');
        const tax = document.getElementsByClassName('tax');

        for (i = 0; i < request_qty.length; i++) {
            if (array_cgst.length > 0) {
                array_cgst[i].value = (((Number(request_qty[i].value) * Number(price[i].value)) / 200) * Number(tax[i]
                    .value)).toFixed(2)
            }
            if (array_sgst.length > 0) {
                array_sgst[i].value = (((Number(request_qty[i].value) * Number(price[i].value)) / 200) * Number(tax[i]
                    .value)).toFixed(2)
            }
            if (array_igst.length > 0) {
                array_igst[i].value = (((Number(request_qty[i].value) * Number(price[i].value)) / 100) * Number(tax[i]
                    .value)).toFixed(2)
            }
        }


    }


    function qtyCal() {
        //gstCal();
        const request_qty = document.getElementsByClassName('request_qty');
        const purchase_price = document.getElementsByClassName('purchase_price');
        const array_taxeble_amount = document.getElementsByClassName('array_taxeble_amount');
        const array_total_amount = document.getElementsByClassName('array_total_amount');
        const array_cgst = document.getElementsByClassName('array_cgst');
        const array_sgst = document.getElementsByClassName('array_sgst');
        const array_igst = document.getElementsByClassName('array_igst');
        const array_tax_amount = document.getElementsByClassName('array_tax_amount');
        const taxebleAmountLabel = document.getElementById('taxeble_amount_label');
        let total_tax = 0;

        //alert(JSON.stringify(request_qty));

        for (i = 0; i < request_qty.length; i++) {
            try {
                //alert(request_qty[i].value);
                var purchasePrice = purchase_price[i].value;
               // alert(purchasePrice);
                if(purchasePrice === undefined){}
                else{ 
                    // console.log(sprice[i].options[sprice[i].selectedIndex].dataset);
                    //console.log(purchasePrice)
                    //var total_tax = 0
                    // if (array_cgst.length > 0) {
                    //     total_tax = total_tax + Number(array_cgst[i].value);
                    // }
                    // if (array_sgst.length > 0) {
                    //     total_tax = total_tax + Number(array_sgst[i].value);
                    // }
                    // if (array_igst.length > 0) {
                    //     total_tax = total_tax + Number(array_igst[i].value);
                    // }
                    //alert(Number(request_qty[i].value) * Number(purchasePrice) + total_tax);
                    array_taxeble_amount[i].value = Number(request_qty[i].value) * Number(purchasePrice) + total_tax;
                    //alert(request_qty[i].value+'===='+purchasePrice+'===='+total_tax);
                    array_total_amount[i].value = Number(request_qty[i].value) * Number(purchasePrice) + total_tax;
                    array_tax_amount[i].value = total_tax;
                    total_tax += Number(array_tax_amount[i].value);
                }
            } catch (error) {

            }
        }
        taxebleAmountLabel.innerText = total_tax.toFixed(2);
        //console.log('total_tax='+total_tax);

       
       // alert(tax_percentage_label);
       
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

        // updating the amount
        var total_tax_amount = 0;
        var total_taxeble_amount = 0;
        var total_total_amount = 0;
        var total_igst = 0;
        var total_sgst = 0;
        var total_cgst = 0;


        for (i = 0; i < array_taxeble_amount.length; i++) {
            total_tax_amount = total_tax_amount + Number(array_tax_amount[i].value);
            total_taxeble_amount = total_taxeble_amount + Number(array_taxeble_amount[i].value);
            total_total_amount = total_total_amount + Number(array_total_amount[i].value);
            if (array_cgst.length > 0) {
                total_cgst = total_cgst + Number(array_cgst[i].value);
            }
            if (array_igst.length > 0) {
                total_igst = total_igst + Number(array_igst[i].value);
            }
            if (array_sgst.length > 0) {
                total_sgst = total_sgst + Number(array_sgst[i].value);
            }
        }
       //console.log(total_tax_amount);
       if(total_tax_amount > 0)
       {
        total_tax_amount=total_tax_amount.toFixed(2);
       }
        tax_amount.value = total_tax_amount;
        taxeble_amount.value = total_taxeble_amount.toFixed(2);
        total_amount.value = total_total_amount.toFixed(2);
        $('#taxeble_amount_label').html(total_total_amount.toFixed(2));
        if (array_cgst.length > 0) {
            cgst.value = total_cgst.toFixed(2);
        }
        if (array_igst.length > 0) {
            igst.value = total_igst.toFixed(2);
        }
        if (array_sgst.length > 0) {
            sgst.value = total_sgst.toFixed(2);
        }

        var tax_percentage_label = $('#tax_percentage_label').html();
        tax_percentage_label = parseFloat(tax_percentage_label);
        var total_tax_amount = (tax_percentage_label * total_total_amount) / 100;
        total_tax_amount = total_tax_amount.toFixed(2);
        console.log(total_tax_amount);
        $('#total_tax_lable').html(total_tax_amount);
        $('#total_tax').val(total_tax_amount);

        var adjustment =$('#adjustment').val();
        if(adjustment=='' || adjustment==null){
            adjustment = 0;
        }
        adjustment = parseFloat(adjustment);
        $('#adjustment_lable').html(adjustment.toFixed(2));

        var transport_charge =$('#transport_charge').val();
        console.log('transport_charge='+transport_charge);
        if(transport_charge=='' || transport_charge==null){
            transport_charge = 0;
        }
        transport_charge = parseFloat(transport_charge);
        $('#transport_charge_lable').html(transport_charge.toFixed(2));


        var grand_total = parseFloat(total_total_amount) + parseFloat(total_tax_amount)  + parseFloat(transport_charge) - parseFloat(adjustment);
        grand_total = parseFloat(grand_total);
        $('#total_amount_label').html(grand_total.toFixed(2));
        $('#total_amount_value').val(grand_total.toFixed(2));



    }
    // after load the document envent will be fire
    document.addEventListener("DOMContentLoaded", () => {
        qtyCal();
    });
    // fetch data behalf of price

    function product(product_id, prosition) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                data = JSON.parse(this.responseText)
                console.log(data);
                document.getElementsByClassName('price')[prosition].value = data.price
            }
        };
        xhttp.open('GET', "{{ route('requisition.product.price') }}/" + product_id, true);
        xhttp.send();

    }

    
</script>

<!-- // model -->
