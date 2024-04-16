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
                                        <h4 class="card-title">{{ $page }} </h4>
                                    </div>
                                    <a class="btn btn-primary add-list btn-sm text-white"
                                        href="{{ route('dispatch.index') }}"><i class="las la-plus mr-3"></i>Back to
                                        {{ $page }} List</a>
                                </div>
                                <!-- Modal body -->

                                <div class="card-body">
                                    <form id="form_update" action="{{ route('requisition.update', $data->id) }}"
                                        method="POST">
                                        <div class="row">
                                            @csrf
                                            @if (isCentral()) 
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="store_id" class="">From Store</label>
                                                        <select id="store_id" name="store_id" 
                                                            class="form-control  " data-live-search="true"
                                                            placeholder="Enter  Supplier ">
                                                            <option value="{{ $data->store_id }}">
                                                                {{ $data->store->store_name }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="to_store" class="">To Store</label>
                                                        <select id="to_store" name="to_store" 
                                                            class="form-control  " data-live-search="true"
                                                            placeholder="Enter  Supplier ">
                                                            <option value="{{ $data->to_store }}">
                                                                {{ $data->store2->store_name }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (isPublisher())
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="store_id" class="">From Store</label>
                                                        <select id="store_id"  class="form-control  "
                                                            data-live-search="true" placeholder="Enter  Supplier ">
                                                            <option value="{{ $data->store_id }}">
                                                                {{ $data->store->store_name }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="supplier_id" class="">Supplier</label>
                                                        <select id="supplier_id"  class="form-control "
                                                            data-live-search="true" placeholder="Enter  Supplier "
                                                            name="supplier_id">
                                                            <option value="{{ $data->supplier->id }}">
                                                                {{ $data->supplier->name }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (isPublisher())
                                                <input type="hidden" name="store_id" value="{{ $data->store_id }}">
                                                <input type="hidden" name="to_store" value="{{ $data->to_store }}">
                                                <input type="hidden" name="supplier_id" value="{{ $data->supplier_id }}">
                                            @endif
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="po_no" class="">Purchase No</label>
                                                    <input readonly id="po_no" name="po_no"  type="text"
                                                        class="form-control" readonly
                                                        value="PO{{ rand(111111111, 9999999999) }}"
                                                        placeholder="Enter Purchase no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="transport_charge" class="">transport_charge</label>
                                                    <input readonly id="transport_charge"  type="number"
                                                        value="{{ $data->transport_charge }}" class="form-control"
                                                        placeholder="transport_charge" name="transport_charge">
                                                </div>
                                            </div>

                                           
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="expected_delivery_date"
                                                        class="">expected_delivery_date</label>
                                                    <input readonly 
                                                        id="expected_delivery_date" 
                                                        value="{{ $data->expected_delivery_date }}" type="date"
                                                        class="form-control" placeholder="Enter Purchase no"
                                                        name="expected_delivery_date">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="status" class="">status</label>
                                                    <select id="status" name="status" 
                                                        class="form-control selectpicker"
                                                        name="status">
                                                      @if($data->status == 'pending')
                                                        <option {{ $data->status == 'pending' ? 'selected' : '' }}
                                                          
                                                            value="pending"> Pending</option>
                                                            @endif
                                                            @if($data->status == 'rejected')
                                                        <option {{ $data->status == 'rejected' ? 'selected' : '' }}
                                                            value="rejected"> Rejected</option>
                                                            @endif
                                                            @if($data->status == 'approved')
                                                        <option {{ $data->status == 'approved' ? 'selected' : '' }}
                                                            value="approved"> Approved
                                                        </option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="optional"> transport_details</label>
                                                    <textarea readonly class="form-control" placeholder="transport_details" name="transport_details">{{ $data->transport_details }}</textarea>
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
                                                             <th>Purchase Price</th>
                                                           
                                                            
                                                            <th>Total Amount</th>
                                                            {{-- <th>Actions</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data->details as $p)
                                                            <tr id="row{{ $loop->index + 1 }}">
                                                                <td width="2%"><input readonly type="text"
                                                                        id="slno1" value="{{ $loop->index + 1 }}"
                                                                        readonly class="form-control "
                                                                        style="border:none;" /></td>
                                                                <td width="18%"><select
                                                                        name="products[]"placeholder="Search products.."
                                                                        class="form-control form-control-sm  ">
                                                                        <option value="{{ $p->product->id }}">
                                                                            {{ $p->product->title }}</option>
                                                                    </select> </td>

                                                                <td><input readonly type="number" name="request_qty[]"
                                                                        value="{{ $p->request_qty }}"
                                                                        placeholder="Request Qty"
                                                                        class="form-control-sm form-control" /></td>
                                                                <td><input readonly type="number" name="price[]"
                                                                        value="{{ $p->price }}" placeholder="price"
                                                                        class="form-control-sm form-control" /></td>
                                                               

                                                                <td><input readonly type="number"
                                                                        name="array_sale_price[]"
                                                                        value="{{ $p->sale_price }}"
                                                                        placeholder="sale_price"
                                                                        class="form-control-sm form-control" />
                                                                </td>

                                                               
                                                                <td><input readonly type="number"
                                                                        name="array_total_amount[]"
                                                                        value="{{ $p->total_amount }}"
                                                                        placeholder="total_amount"
                                                                        class="form-control-sm form-control" />
                                                                </td>


                                                              
                                                                </td>

                                                            </tr>
                                                        @endforeach

                                                    </tbody>

                                                    <tfoot>

                                                        <tr>
                                                            <th colspan="4"></th>
                                                            <th>Sub Total</th>
                                                            
                                                            <th>
                                                                
                                                            
                                                                    <input readonly type="number" name="taxeble_amount"
                                                                    value="{{ $data->taxeble_amount }}"
                                                                    placeholder="taxeble_amount"
                                                                    class="form-control-sm form-control" /> 
                                                                    
                                                                  
                                                            </th>
                                                           
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

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
                                                                        
                                                                      -  ₹ <span id="adjustment_lable"> {{ sprintf('%0.2f', $data->round_off_amount) }} </span>
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
                                                
                                            <!-- /.card-body -->
                                            {{-- <div class="col-sm-12 mt-3 text-center">
                                                <button onclick="ajaxCall('form_data')" type="button" class="btn btn-primary mt-2">Create
                                                    {{ $page }}</button>
                                            </div> --}}
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
