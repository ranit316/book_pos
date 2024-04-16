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
                                    <a class=" btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                        href="{{ route('mannual-grn.index') }}"><i class="uil-arrow-left me-2 me-2"></i>Back
                                        To
                                        Mannual-grn List</a>
                                </div>
                                <!-- Modal body -->

                                @php
                                $storage_sites = \App\Models\StorageSite::where('deleted_at', null)
                                                                ->where('store_id', loginStore()->id)
                                                                ->get();
                                                            $storage_locations = \App\Models\StorageLocation::with([
                                                                'storage_site' => function ($query) {
                                                                    $query->where('store_id', loginStore()->id)->where('flag', 'default');
                                                                },
                                                            ])
                                                                ->whereHas('storage_site', function ($query) {
                                                                    $query->where('store_id', loginStore()->id)->where('flag', 'default');
                                                                })
                                                                ->where('deleted_at', null)
                                                                ->first();
                                                                  
                                                  

                                                                $racks=[];   
                                                                if(!empty($storage_locations)) 
                                                                {
                                                                    $racks = \App\Models\Rack::where('deleted_at', null)->where('storage_location_id', $storage_locations->id)->first();
                                                                }
                                                               

                                                            
                                                          

                                                        @endphp
                                <?php 
                                if(!empty($storage_sites) && !empty($storage_locations) && !empty($racks))
                                {
                                    ?>
                                     <div class="card-body">
                                    <form id="form_data" action="{{ route('mannual-grn.store') }}" method="POST">
                                        <div class="row">
                                            @csrf
                                            @if (isRetail())
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="to_store" class="required">Choose Store</label>
                                                        <select id="to_store" required class="form-control selectpicker "
                                                            data-live-search="true" placeholder="Enter  Supplier "
                                                            name="to_store">
                                                            <option selected disabled> - Select Store - </option>
                                                            @foreach ($stores as $store)
                                                                <option value="{{ $store->id }}">{{ $store->store_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (isCentral())
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="supplier_id" class="required">Publisher</label>
                                                        <select id="supplier_id" required class="form-control "
                                                            data-live-search="true" placeholder="Enter  Supplier "
                                                            name="supplier_id">

                                                            @foreach ($suppliers as $supplier)
                                                                <option value="{{ $supplier->id }}">{{ $supplier->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            {{-- <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="grn_no" class="required">grn_no</label>
                                                    <input id="grn_no" required type="text" class="form-control"
                                                        readonly value="{{ 'GRN' . rand(1000000000, 9999999999) }}"
                                                        placeholder="Enter Purchase no" name="grn_no">
                                                </div>
                                            </div> --}}

                                            {{-- <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="grn_no" class="required">grn_no</label>
                                                    <input id="grn_no" required type="text" class="form-control"
                                                        readonly value="{{ $grn_no }}" placeholder="Enter Purchase no"
                                                        name="grn_no">
                                                </div>
                                            </div> --}}

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="optional"> Description</label>
                                                    <textarea type="text" class="form-control" placeholder="Enter name" name="description"></textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="card-body table-responsive">
                                               
                                                <table class="table table-bordered " id="dynamic_field"
                                                    style="overflow-y:auto;">
                                                    <thead>
                                                        <tr>
                                                            <th data-field="S.NO" data-sortable="true" rowspan="2">S.NO
                                                            </th>
                                                            <th>Products </th>
                                                            <th>Storage Site</th>
                                                            <th>Storage Location</th>
                                                            <th>Rack</th>
                                                            <th>Batch No</th>
                                                            {{-- <th>Lot No</th> --}}
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            {{-- <th>Sale Price</th> --}}
                                                            {{-- <th>Tax Amount</th> --}}
                                                            <th>Total Amount</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php ?>
                                                       
                                                        <tr>
                                                            <td width=""><input type="text" id="slno1"
                                                                    value="1" readonly class="form-control "
                                                                    style="border:none;" /></td>
                                                            <td width=""><select onchange="product(this.value,0)"
                                                                    name="products[]"placeholder="Search products.."
                                                                    class="form-control form-control-sm prod_dd selectpicker "
                                                                    data-live-search="true" id="first_product">

                                                                    <?php $p_c = 0; ?>
                                                                    @foreach ($products as $product)
                                                                        <?php $p_c++; ?>
                                                                        <option value="{{ $product->id }}"
                                                                            >
                                                                            {{ $product->title }}</option>
                                                                    @endforeach
                                                                </select> </td>



                                                            <td width=""><select id="storage_site_id0"
                                                                    name="storage_site_id[]"
                                                                    class="form-control form-control-sm  "
                                                                    onchange=" get_storage_location(this.value,0)">
                                                                    {{-- <option value="" selected> -Search Storage Site-
                                                                    </option> --}}
                                                                    @foreach ($storage_sites as $sites)
                                                                        <option value="{{ $sites->id ?? '' }}">
                                                                            {{ $sites->name ?? '' }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td width=""><select id="storage_location_id0"
                                                                    name="storage_location_id[]"placeholder="Search products.."
                                                                    class="form-control form-control-sm  "
                                                                    onchange="get_rack(this.value,0)">
                                                                    <option disabled> -Search Locations-
                                                                    </option>
                                                                    <option value="{{$storage_locations->id}}">{{$storage_locations->name}}</option>
                                                                    {{-- @foreach ($storage_locations as $location)
                                                                        <option value="{{ $location->id ?? '' }}">
                                                                            {{ $location->name ?? '' }}</option>
                                                                    @endforeach --}}
                                                                </select>
                                                            </td>
                                                            <td width=""><select id="rack_id0"
                                                                    name="rack_id[]"placeholder="Search products.."
                                                                    class="form-control form-control-sm  ">
                                                                    <option disabled> -Search Racks-
                                                                    </option>
                                                                    <option value="{{$racks->id}}">{{$racks->name}}</option>
                                                                    {{-- @foreach ($racks as $rack)
                                                                        <option value="{{ $rack->id ?? '' }}">
                                                                            {{ $rack->name ?? '' }}</option>
                                                                    @endforeach --}}
                                                                </select>
                                                            </td>
                                                            <td width=""><input type="text" name="batch_no[]"
                                                                    value="" placeholder="batch_no" required
                                                                    class="form-control-sm form-control" />
                                                            </td>
                                                            {{-- <td width=""><input type="text" name="lot_no[]"
                                                                    value="" placeholder="lot_no"
                                                                    class="form-control-sm form-control" />
                                                            </td> --}}
                                                            <td><input type="number" name="request_qty[]"
                                                                    onkeyup="qtyCal();check_positive(this.value,0);"
                                                                    id="request_qty_0" onclick="qtyCal()"
                                                                    placeholder="Request Qty"
                                                                    class="form-control-sm form-control request_qty"
                                                                    min="1" />
                                                            </td>
                                                            <td><input type="number" name="price[]" placeholder=""
                                                                    placeholder="price" onkeyup="qtyCal()"
                                                                    onclick="qtyCal()"
                                                                    class="form-control-sm form-control price"
                                                                    id="price_0" />
                                                            </td>
                                                            {{-- <td><input type="number" name="sale_price[]"
                                                                    placeholder="sale_price" value=""
                                                                    onkeyup="qtyCal()" onclick="qtyCal()"
                                                                    class="form-control-sm form-control sale_price"
                                                                    id="sale_price_0" />
                                                            </td> --}}
                                                            {{-- <td><input type="number" name="array_taxeble_amount[]"
                                                                    onkeyup="calculation()" onclick="calculation()"
                                                                    placeholder="taxeble_amount"
                                                                    class="form-control-sm form-control array_taxeble_amount" /> --}}
                                                            </td>
                                                            <td><input type="number" name="array_total_amount[]"
                                                                    onkeyup="calculation()" onclick="calculation()"
                                                                    required placeholder="total_amount"
                                                                    class="form-control-sm form-control array_total_amount" readonly/>
                                                            </td>


                                                            <td><button type="button" name="add" id="add"
                                                                    class="btn btn-success btn-sm"><i class="fa fa-plus"
                                                                        aria-hidden="true"></i>
                                                                </button>
                                                            </td>

                                                        </tr>
                                                    </tbody>

                                                    <tfoot>

                                                        <tr>
                                                            <th data-field="S.NO" data-sortable="true" rowspan="2">

                                                            </th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            {{-- <th></th> --}}
                                                            {{-- <th></th> --}}
                                                            <th></th>
                                                            <th></th>
                                                            <th>Sub Total</th>

                                                            {{-- <th><input type="number" name="tax_amount" id="tax_amount"
                                                                    placeholder="total tax"
                                                                    class="form-control-sm form-control" /> </th>
                                                            </th> --}}
                                                            {{-- <th><input type="number" name="taxeble_amount"
                                                                    id="taxeble_amount" placeholder="taxeble_amount"
                                                                    class="form-control-sm form-control" /> </th> --}} 


                                                            <th colspan="2"><input type="number" name="total_amount"
                                                                    id="total_amount" placeholder="total amount"
                                                                    class="form-control-sm form-control" readonly />
                                                            </th>

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
                                                                            id="tax_percentage_label">{{$tax_rate}}%</span>)
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
                                                                            id="adjustment" value="0" placeholder="Adjustment amount"  min="0" onkeyup="calculation();"
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
                                                <button onclick="ajaxCall('form_data','{{ route('mannual-grn.index') }}')"
                                                    type="button"
                                                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i
                                                        class="uil uil-check me-2"></i>Add
                                                    {{ $page }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                    <?php 

                                }
                                else 
                                {
                                    echo "Please Add Storage site, location, rack - first, then try";
                                }
                               
                                ?>
                               




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $prod_det = [];
        foreach ($products as $product) {
            $prod_det[] = ['id' => $product->id, 'title' => $product->title];
        }
        
        ?>


    @endslot
</x-layout>

<script>
    $(document).ready(function() {
        var i = 1;

        var prod_det = '<?php echo json_encode($prod_det); ?>';
        //alert(prod_det);
        prod_det = JSON.parse(prod_det);
        //alert(prod_det);
        //alert(JSON.stringify(prod_det));

        //product(prod_det[0].id, 0);



        $('#add').click(function() {


            i++;
            j = i - 1;

            var ddop = '';

            var all_selected_prod = [];
            $(".prod_dd").each(function() {

                if ($(this).val() > 0) {
                    all_selected_prod.push(parseInt($(this).val()));
                }

            });

            for (var aa = 0; aa < prod_det.length; aa++) {
                //alert(JSON.stringify(all_selected_prod));
                //alert(prod_det[aa].id);
                //alert(all_selected_prod.indexOf("1"));
                if (all_selected_prod.indexOf(prod_det[aa].id) > -1) {

                } else {
                    ddop = ddop + '<option value="' + prod_det[aa].id + '">' + prod_det[aa].title +
                        '</option>';
                }

            }
            //alert(ddop);

            $('#dynamic_field').append('<tr id="row' + i +
                '" class="dynamic-added" ><td><input type="text" id="slno' + i + '" value="' + i +
                '"readonly class="form-control-sm form-control" style="border:none;" /></td>' +
                '<td><select onchange="product(this.value,' + j +
                ')"  name="products[]"placeholder="Search products.." class="form-control form-control-sm prod_dd " data-live-search="true">  <option selected disabled> -Search Products-   </option> ' +
                ddop + ' </select></td>' +
                '<td width="10%"><select id="storage_site_id' + i +
                '" name="storage_site_id[]"placeholder="Search products.."class="form-control form-control-sm  " onchange=" get_storage_location(this.value,' +
                i + ')">' +
                ' @foreach ($storage_sites as $sites) <option value="{{ $sites->id ?? '' }}">   {{ $sites->name ?? '' }}</option>' +
                '@endforeach </select> </td>' +
                '<td width="10%"><select id="storage_location_id' + i +
                '" name="storage_location_id[]"placeholder="Search products.." class="form-control form-control-sm  " onchange="get_rack(this.value,' +
                i + ')"> <option disabled> -Search Locations-' +
                '</option> <option value="{{$storage_locations->id}}">{{$storage_locations->name}}</option></select>' +
                '</td>' +
                '<td width="10%"><select id="rack_id' + i +
                '" name="rack_id[]"placeholder="Search products.."  class="form-control form-control-sm  ">' +
                '<option disabled> -Search Racks- </option>  <option value="{{$racks->id}}">{{$racks->name}}</option></select>' +
                '</td>' +
                '<td width="100px"><input type="text" name="batch_no[]" value="" placeholder="batch_no" required class="form-control-sm form-control" />' +
                '</td>' +
                // '<td width=""><input type="text" name="lot_no[]"  value="" placeholder="lot_no"  class="form-control-sm form-control" /> </td>' +
                '<td><input    onclick="qtyCal(this.value)"   type="number" name="request_qty[]" placeholder="Request Qty" class="form-control-sm form-control request_qty" onkeyup="qtyCal(this.value);calculation();check_positive(this.value,' +
                j + ');" id="request_qty_' + j + '" onclick="calculation()" min="1" /></td>' +
                '<td><input type="number"  name="price[]" id="price_' + j +
                '" placeholder="price"  class="form-control-sm form-control price" onkeyup="qtyCal()" onclick="qtyCal()" /> </td>' +
                // '<td><input type="number" name="sale_price[]" id="sale_price_' + j +
                // '" placeholder="sale_price" onkeyup="qtyCal()" onclick="qtyCal()" class="form-control-sm form-control sale_price" /></td>' +
                // '<td><input type="number" name="array_tax_amount[]" placeholder="tax_amount"  class="form-control-sm form-control array_tax_amount " onkeyup="calculation()" onclick="calculation()" /> </td>' +
                // ' <td><input type="number" name="array_taxeble_amount[]"placeholder="taxeble_amount" class="form-control-sm form-control array_taxeble_amount " onkeyup="calculation()" onclick="calculation()" /></td>' +
                ' <td><input type="number" name="array_total_amount[]" placeholder="total_amount" class="form-control-sm form-control array_total_amount " onkeyup="calculation()" onclick="calculation()" readonly /> </td>' +
                '<td><button type="button" name="remove" id="' + i +
                '" class="btn btn-danger btn-sm btn_remove" >X</button></td></tr>');

        });



        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            //alert('qtyCal');
            setTimeout(qtyCal, 2000);
            $('#row' + button_id + '').remove();
        });


    });

    function check_positive(val, no) {
        val = parseInt(val);
        if(val==0)
        {
            val = 1;
        }
        val = Math.abs(val);
        //alert(val);
        if (!isNaN(val)) {
            $('#request_qty_' + no).val(val);
            qtyCal();
            calculation();
        }

    }

    function qtyCal() {

        const request_qty = document.getElementsByClassName('request_qty');
        const price = document.getElementsByClassName('price');
        // var array_taxeble_amount = document.getElementsByClassName('array_taxeble_amount');
        var array_total_amount = document.getElementsByClassName('array_total_amount');
        for (i = 0; i < array_total_amount.length; i++) {
            // array_taxeble_amount[i].value = Number(request_qty[i].value) * Number(price[i].value).toFixed(2);
            array_total_amount[i].value = Number(request_qty[i].value) * Number(price[i].value).toFixed(2);
            console.log(array_total_amount[i]);
        }

        calculation();
    }



    function calculation() {
        // const array_tax_amount = document.getElementsByClassName('array_tax_amount');
        // const array_taxeble_amount = document.getElementsByClassName('array_taxeble_amount');
        const array_total_amount = document.getElementsByClassName('array_total_amount');

        // for seting the value into the total amount
        // const tax_amount = document.getElementById('tax_amount');
        const taxeble_amount = document.getElementById('taxeble_amount');
        const total_amount = document.getElementById('total_amount');
        // updating the amount
        // var total_tax_amount = 0;
        var total_taxeble_amount = 0;
        var total_total_amount = 0;

        for (i = 0; i < array_total_amount.length; i++) {
            // total_tax_amount = total_tax_amount + Number(array_tax_amount[i].value);
            // total_taxeble_amount = total_taxeble_amount + Number(array_taxeble_amount[i].value);
            total_total_amount = total_total_amount + Number(array_total_amount[i].value);
        }

        // tax_amount.value = total_tax_amount;
        // taxeble_amount.value = total_taxeble_amount;
        total_amount.value = total_total_amount;

        
        $('#taxeble_amount_label').html(total_total_amount.toFixed(2));

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

    // fetch data behalf of price

    function product(product_id, prosition) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                data = JSON.parse(this.responseText)
                //console.log(data);
                //document.getElementsByClassName('price')[prosition].value = data.price;
                //document.getElementsByClassName('sale_price')[prosition].value = data.price;
                document.getElementById('price_' + prosition).value = data.price;
                document.getElementById('sale_price_' + prosition).value = data.price;
            }
        };
        xhttp.open('GET', "{{ route('requisition.product.price') }}/" + product_id, true);
        xhttp.send();

    }

    function get_storage_location(site_id, position) {
        //alert(site_id+'======'+position);
        var form = document.getElementById('form_data');
        var method = "POST";
        var formdata = new FormData(form);
        var formElements_button = Array.from(form.elements).pop();
        //preloader(formElements_button);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);

                $('#storage_location_id' + position).empty();
                data = JSON.parse(this.responseText);
                // Populate the Book dropdown with new options
                var loc_str = '<option value=""> -Search Location- </option>';
                if (data.length > 0) {
                    $.each(data, function(key, value) {
                        console.log(value);
                        loc_str += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $('#storage_location_id' + position).append(loc_str);

                    // Refresh the selectpicker to reflect the changes

                } else {
                    alert("No location available");
                }
                //stopPreloader(formElements_button);
            }
            method;
        };
        xhttp.open(method, "{{ route('storagelocations.by.siteid') }}/" + site_id, true);
        xhttp.send(formdata);
    }

    function get_rack(loc_id, position) {
        var form = document.getElementById('form_data');
        var method = "POST";
        var formdata = new FormData(form);
        var formElements_button = Array.from(form.elements).pop();
        //preloader(formElements_button);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);

                $('#rack_id' + position).empty();
                data = JSON.parse(this.responseText);
                // Populate the Book dropdown with new options
                if (data.length > 0) {
                    $.each(data, function(key, value) {
                        console.log(value);
                        $('#rack_id' + position).append('<option value="' + value.id + '">' + value.name +
                            '</option>');
                    });

                    // Refresh the selectpicker to reflect the changes

                } else {
                    alert("No rack available");
                }
                //stopPreloader(formElements_button);
            }
            method;
        };
        xhttp.open(method, "{{ route('rack.by.locationid') }}/" + loc_id, true);
        xhttp.send(formdata);
    }
</script>

<!-- // model -->
