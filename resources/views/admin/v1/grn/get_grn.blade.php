<div class="row">
    @csrf
   
    @if (isRetail())
        <div class="col-sm-4">
            <div class="form-group">
                <label for="to_store" class="required"> Store Name</label>
                <select id="to_store" required class="form-control " data-live-search="true" 
                    name="to_store">
                    <option value="{{ $data->store2->user->id }}">
                        {{ $data->store2->store_name }} ( {{ $data->store2->publisher->store_name }})
                    </option>
                </select>
            </div>
        </div>
    @endif
    @if (isCentral())
        <div class="col-sm-4">
            <div class="form-group">
                <label for="supplier_id" class="required">Supplier Name</label>
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
            <label for="dispatch_no" class="required">Dispatch No</label>
            <input readonly id="dispatch_no" name="dispatch_no" required type="text" class="form-control" readonly
                value="{{ $data->dispatch_no }}" placeholder="Enter Purchase no">
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="form-group">
            <label for="po_no" class="required">Purchase order No</label>
            <input readonly id="po_no" name="po_no" required type="text" class="form-control" readonly
                value="{{ $data->po_no }}" placeholder="Enter Purchase no">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="dispatch_date" class="required">Dispatch Date</label>
            <input id="dispatch_date" required value="{{ $data->dispatch_date }}" type="date" class="form-control"
                readonly placeholder="Enter Purchase no" name="dispatch_date">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="transport_charge" class="required">transport_charge</label>
            <input id="transport_charge" readonly required type="number" value="{{ $data->transport_charge }}"
                class="form-control" placeholder="transport_charge" name="transport_charge">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="expected_delivery_date" class="required">expected_delivery_date</label>
            <input id="expected_delivery_date" required value="{{ $data->expected_delivery_date }}" type="date"
                readonly class="form-control" placeholder="Enter Purchase no" name="expected_delivery_date">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="recieved_date" class="required">Received Date</label>
            <input id="recieved_date" required value="{{ date('Y-m-d') }}" type="date" class="form-control"
                placeholder="Enter Purchase no" name="recieved_date">
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
            <textarea type="text" class="form-control" placeholder="Enter name" name="description">{{ $data->description }}</textarea>
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
                    <th>Storage Site</th>
                    <th>Storage Location</th>
                    <th>Rack</th>
                    <th>Batch No</th>
                    <th>Quantity</th>
                    <th>Price </th>
                    <th>Purchase Price</th>
                    
                    <th>Total Amount</th> 
                   
                </tr>
            </thead>
            <tbody>

             

                @foreach ($data->details as $p)

                @php
                   /*
                    $storage_sites = \App\Models\StorageSite::where('deleted_at', null)->get();
                    $storage_locations = \App\Models\StorageLocation::where('deleted_at', null)->get();
                    $racks = \App\Models\Rack::where('deleted_at', null)->get();
                    */

                    $inventry_stock = \App\Models\MasterStockInventery::where('product_id', $p->product_id)
                            ->where('store_id', $data->store2->id )
                            //->where('sale_price',$p->purchase_price)
                            // ->where('qty', '>=', $p->request_qty)
                            ->first();


                  /*  $storage_sites = \App\Models\StorageSite::where('deleted_at', null)
                        ->where('id', $inventry_stock->storage_site_id)
                        ->get();
                    $storage_locations = \App\Models\StorageLocation::where('deleted_at', null)
                        ->where('id', $inventry_stock->storage_location_id)
                        ->get();
                    $racks = \App\Models\Rack::where('deleted_at', null)
                        ->where('id', $inventry_stock->rack_id)
                        ->get();
                        */
                         $storage_sites = \App\Models\StorageSite::where('deleted_at', null)
                        ->where('store_id',loginStore()->id)->where('flag','default')
                        ->get();

                         $storage_locations = \App\Models\StorageLocation::where('deleted_at', null)
                          ->where('storage_site_id',$storage_sites->first()->id)->where('flag','default')
                        ->get();

                          $racks = \App\Models\Rack::where('deleted_at', null)
                          ->where('storage_location_id', $storage_locations->first()->id)->where('flag','default')
                        ->get();



                @endphp
                   
                <tr id="row{{ $loop->index + 1 }}">
                    <td width="2%"><input readonly type="text" id="slno1"
                            value="{{ $loop->index + 1 }}" readonly class="form-control "
                            style="border:none;" /></td>
                    <td width="18%"><select name="products[]"placeholder="Search products.."
                            class="form-control form-control-sm  ">

                            <option value="{{ $p->product_id }}">
                                {{ $p->product->title }}</option>
                        </select>
                    </td>
                    <td width="18%"><select name="storage_site_id[]"placeholder="Search products.."
                            class="form-control form-control-sm  ">
                            <option disabled> -Search Storage Site-
                            </option>
                            @foreach ($storage_sites as $sites)
                                <option
                                    value="{{ $sites->id }}">
                                    {{ $sites->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td width="18%"><select name="storage_location_id[]"placeholder="Search products.."
                            class="form-control form-control-sm  ">
                            <option disabled> -Search Locations-
                            </option>
                            @foreach ($storage_locations as $location)
                                <option
                                    value="{{ $location->id  }}">
                                    {{ $location->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td width="18%"><select name="rack_id[]"placeholder="Search products.."
                            class="form-control form-control-sm  ">
                            <option disabled> -Search Racks-
                            </option>
                            @foreach ($racks as $rack)
                                <option 
                                    value="{{ $rack->id ?? '' }}">
                                    {{ $rack->name ?? '' }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td width="100px"><input readonly type="text" name="batch_no[]"
                             placeholder="batch_no" value="{{ $p->batch_no }}"
                            class="form-control-sm form-control" />
                    </td>
                    <td width="100px"><input readonly type="number" name="request_qty[]" value="{{ $p->request_qty }}"
                            placeholder="Request Qty" class="form-control-sm form-control" /></td>
                    <td width="100px"><input readonly type="number" name="price[]"
                            value="{{ $p->price }}" placeholder="price"
                            class="form-control-sm form-control" /></td>
                     <td width="100px"><input readonly type="hidden" required name="purchase_price[]"
                            value="{{ $p->sale_price }}" placeholder="purchase_price"
                            class="form-control-sm form-control" />
                            <input readonly type="number" required name="sale_price[]"
                            value="{{ $p->sale_price }}" placeholder="sale price"
                            class="form-control-sm form-control" />
                    </td>
                   


                 
                    <input readonly type="hidden" name="array_tax_amount[]" value="{{ $p->tax_amount }}"
                            placeholder="tax_amount" class="form-control-sm form-control" />
              

                    <input readonly type="hidden" name="array_taxeble_amount[]"
                            value="{{ $p->taxeble_amount }}" placeholder="taxeble_amount"
                            class="form-control-sm form-control" />
                    <td><input readonly type="number" name="array_total_amount[]"
                            value="{{ $p->total_amount }}" placeholder="total_amount"
                            class="form-control-sm form-control" />
                    </td>


                    </td>

                </tr>
            @endforeach

        </tbody>

        <tfoot>

            <tr>
                <th colspan="8"></th>
                <th>Sub Total</th>

                
               
                <th>
                <input type="hidden" name="tax_amount" id="tax_amount" value="{{ $data->tax_amount }}"
                        placeholder="tax_amount" class="form-control-sm form-control" /> 
                <input type="hidden" name="taxeble_amount" id="taxeble_amount"
                        value="{{ $data->taxeble_amount }}" placeholder="taxeble_amount"
                        class="form-control-sm form-control" /> 
               <input type="number" readonly name="total_amount" id="total_amount"
                        value="{{ $data->taxeble_amount }}" placeholder="total_amount"
                        class="form-control-sm form-control" /> 
                </th>
                
            </tr>
        </tfoot>
    </table>
</div>

<div class="row mt-2">
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
<!-- /.card-body -->
<div class="col-sm-12 mt-3 text-center">
    <button onclick="ajaxCall('form_data')" type="button" data-bs-toggle="modal" data-bs-target="#" class="btn btn-primary mt-2">Generate Good Receive Note</button>
</div>
</div>

<style>
table input {
    width: 100px !important;
}

table select {
    width: 180px !important;
}
</style>

