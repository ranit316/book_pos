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
                                        href="{{ route('purchase.index') }}"><i class="las la-plus mr-3"></i>Back to
                                        {{ $page }} List</a>
                                </div>
                                <!-- Modal body -->

                                <div class="card-body">
                                    <form id="form_update" action="{{ route('requisition.update', $data->id) }}"
                                        method="POST">
                                        <div class="row">
                                            @csrf
                                            @if (isRetail())
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="to_store" class="required">Choose Store</label>
                                                        <select id="to_store" required class="form-control  " data-live-search="true"
                                                            placeholder="Enter  Supplier " name="to_store">
                                                            <option value="{{ $data->store2->id }}">
                                                                {{ $data->store2->store_name }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (isCentral())
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="supplier_id" class="required">Supplier</label>
                                                        <select id="supplier_id" required class="form-control" placeholder="Enter  Supplier "
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
                                                    <label for="po_no" class="required">Purchase No</label>
                                                    <input readonly id="po_no" name="po_no" required type="text" class="form-control" readonly
                                                        value="PO{{ rand(111111111, 9999999999) }}" placeholder="Enter Purchase no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="transport_charge" class="required">transport_charge</label>
                                                    <input readonly id="transport_charge" required type="number" value="{{ $data->transport_charge }}"
                                                        class="form-control" placeholder="transport_charge" name="transport_charge">
                                                </div>
                                            </div>
                                        
                                            <div class="col-sm-4"> 
                                                <div class="form-group">
                                                    <label for="po_date" class="required">Purchase Date</label>
                                                    <input readonly id="po_date" required value="{{ $data->po_date }}"
                                                        type="date" class="form-control" readonly placeholder="Enter Purchase no" name="po_date">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="expected_delivery_date" class="required">expected_delivery_date</label>
                                                    <input readonly  id="expected_delivery_date" required
                                                        value="{{ $data->expected_delivery_date }}" type="date" class="form-control"
                                                        placeholder="Enter Purchase no" name="expected_delivery_date">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="status1" class="required">status</label>
                                                    <select id="status1" name="status" required class="form-control" name="status">
                                                        <option value="{{ $data->status }}"> {{ $data->status }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="optional"> transport_details</label>
                                                    <textarea type="text" readonly class="form-control" placeholder="transport_details" name="transport_details">{{ $data->transport_details }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="optional"> Description</label>
                                                    <textarea readonly class="form-control" placeholder="Enter name" name="description">{{ $data->description }}</textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="card-body table-responsive">
                                                <table class="table table-bordered " id="dynamic_field" style="overflow-y:auto;">
                                                    <thead>
                                                        <tr>
                                                            <th data-field="S.NO" data-sortable="true" rowspan="2">
                                                                S.NO 
                                                            </th>
                                                            <th>Products </th>
                                                            <th>Quantity</th>
                                                            <th>Price </th>
                                                         
                                                            <th>Purchase Price</th>
                                                            <th>Total Amount</th>
                                                            {{-- <th>Actions</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data->details as $p)
                                                            <tr id="row{{ $loop->index + 1 }}">
                                                                <td width="2%"><input readonly type="text" id="slno1" value="{{ $loop->index + 1 }}"
                                                                        readonly class="form-control " style="border:none;" /></td>
                                                                <td width="18%"><select name="products[]"
                                                                        class="form-control form-control-sm  ">
                                                                       
                                                                        @foreach ($products as $product)
                                                                        @if($product->id == $p->product_id)
                                                                            <option {{ $product->id == $p->product_id ? 'selected' : '' }}
                                                                                value="{{ $product->id }}">
                                                                                {{ $product->title }}</option>
                                                                                @endif
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                        
                                                                <td><input readonly type="number" name="request_qty[]" value="{{ $p->request_qty }}"
                                                                        placeholder="Request Qty" class="form-control-sm form-control" /></td>
                                                                <td><input readonly type="number" name="price[]" value="{{ $p->price }}"
                                                                        placeholder="price" class="form-control-sm form-control" /></td>
                                                                {{-- <td><input readonly type="number" name="purchase_price[]" value="{{ $p->purchase_price }}"
                                                                        placeholder="" class="form-control-sm form-control" />
                                                                </td>
                                                                <td><input readonly type="number" name="sale_price[]" value="{{ $p->sale_price }}"
                                                                        placeholder="sale_price" class="form-control-sm form-control" />
                                                                </td> --}}
                                                               
                                        
                                                              
                                        
                                                                <td><input readonly type="number" name="array_purchase_price[]"
                                                                        value="{{ $p->purchase_price }}" placeholder="purchase_price"
                                                                        class="form-control-sm form-control" />
                                                                </td>
                                                                <td><input readonly type="number" name="array_total_amount[]"
                                                                        value="{{ $p->total_amount }}" placeholder="total_amount"
                                                                        class="form-control-sm form-control" />
                                                                </td>
                                        
                                        
                                                                {{-- <td>
                                                                    @if ($loop->index == 0)
                                                                        <button type="button" name="add" id="add"
                                                                            class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>
                                                                        </button>
                                                                    @else
                                                                        <button type="button" name="remove" id="{{ $loop->index + 1 }}"
                                                                            class="btn btn-danger btn-sm btn_remove">X</button>
                                                                    @endif
                                                                </td> --}}
                                                                </td>
                                        
                                                            </tr>
                                                        @endforeach
                                        
                                                    </tbody>
                                        
                                                    <tfoot>
                                        
                                                        <tr>
                                                           
                                                            <th colspan="4"></th>
                                                           
                                                           
                                                            <th>Sub Total</th>
                                        
                                                            <th>
                                                                
                                                            <input readonly type="number" name="taxeble_amount" value="{{ $data->taxeble_amount }}"
                                                                    placeholder="taxeble_amount" class="form-control-sm form-control" /> 
                                                            


                                                         
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
                                                                    <td class="bold"><span id=discount-span>
                                                                        </span>Discount
                                                                        
                                                                    </td>
                                                                    <td>
                                                                        <input readonly type="hidden" 
                                                                            id="discount" placeholder="discount"
                                                                            class="form-control-sm form-control" />
                                                                           - ₹<span id="total_discount">0.00 </span> <span
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
                                                                            class="form-control-sm form-control" value="{{ sprintf('%0.2f', $data->tax_amount) }}" />
                                                                            <input type="hidden" 
                                                                            id="tax_percentage" placeholder="tax percentage"
                                                                            class="form-control-sm form-control" />

                                                                        ₹ <span id="total_tax_lable">{{ sprintf('%0.2f', $data->tax_amount) }}  </span>( <span
                                                                            id="tax_percentage_label">{{$tax_rate}}</span> %)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="bold"><span>Transport Charge</span>
                                                                   

                                                                    </td>
                                                                    <td> 
                                                                        
                                                                        ₹ <span id="transport_charge_lable">{{ sprintf('%0.2f', $data->transport_charge) }} </span> 
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="bold"><span>Adjustment</span>
                                                                    <input  type="hidden" name="round_off_amount"
                                                                            id="adjustment" value="{{ $data->round_off_amount }}" placeholder="Adjustment amount"  min="0" onkeyup="calculation();"
                                                                            class="form-control-sm form-control" style="float:inline-end;width:150px;" />

                                                                    </td>
                                                                    <td>
                                                                        
                                                                       - ₹ <span id="adjustment_lable"> {{ sprintf('%0.2f', $data->round_off_amount) }} </span>
                                                                    </td>
                                                                </tr>
                                                               
                                                                <tr>
                                                                    <td><span class="font-weight-bold">Grand Total</span>
                                                                    </td>
                                                                    <td>
                                                                        <input type="hidden" name="total_amount"
                                                                            id="total_amount_value" placeholder="amount" value="{{ sprintf('%0.2f', $data->total_amount) }}"
                                                                            class="form-control-sm form-control" />
                                                                        ₹<span class="font-weight-bold"
                                                                            id="total_amount_label">
                                                                            {{ sprintf('%0.2f', $data->total_amount) }}</span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
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

<script>
    $(document).ready(function() {
        var i = 1;

        $('#add').click(function() {
            i++;
            $('#dynamic_field').append('<tr id="row' + i +
                '" class="dynamic-added" ><td><input readonly type="text" id="slno' + i +
                '" value="' + i +
                '"readonly class="form-control-sm form-control" style="border:none;" /></td>' +
                '<td><select  name="products[]"placeholder="Search products.." class="form-control form-control-sm  " data-live-search="true">  <option selected disabled> -Search Products-   </option> @foreach ($products as $product) <option value="{{ $product->id }}">  {{ $product->title }}</option>   @endforeach </select></td>' +
                '<td><input readonly type="number" name="request_qty[]" placeholder="Request Qty" class="form-control-sm form-control" /></td>' +
                '<td><input readonly type="number" name="mrp_price[]" placeholder="mrp_price" class="form-control-sm form-control" /></td>' +
                '<td><input readonly type="number" name="purchase_price[]" placeholder="" class="form-control-sm form-control" /> </td>' +
                '<td><input readonly type="number" name="sale_price[]" placeholder="sale_price"  class="form-control-sm form-control" /> </td>' +
                '<td><input readonly type="number" name="batch_no[]" placeholder="batch_no" class="form-control-sm form-control" />  </td>' +
                '<td width="5%"><select name="gst[]" placeholder="gst" class="form-control-sm form-control "> <option value="5">@5%</option> <option value="12">@12%</option> <option value="18">@18%</option>  <option value="28">@28%</option>   </select>  </td>' +
                '<td><input readonly type="number" name="array_cgst[]" placeholder="array_cgst" class="form-control-sm form-control" /></td>' +
                '<td><input readonly type="number" name="array_igst[]" placeholder="array_igst" class="form-control-sm form-control" />  </td>' +
                '<td><input readonly type="number" name="array_sgst[]" placeholder="array_sgst" class="form-control-sm form-control" /> </td>' +
                '<td><input readonly type="number" name="array_tax_amount[]" placeholder="tax_amount"  class="form-control-sm form-control" /> </td>' +
                ' <td><input readonly type="number" name="array_taxeble_amount[]"placeholder="taxeble_amount" class="form-control-sm form-control" /></td>' +
                ' <td><input readonly type="number" name="array_total_amount[]"placeholder="total_amount" class="form-control-sm form-control" /> </td>' +
                '<td><button type="button" name="remove" id="' + i +
                '" class="btn btn-danger btn-sm btn_remove">X</button></td></tr>');
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });


    });
</script>

<!-- // model -->
