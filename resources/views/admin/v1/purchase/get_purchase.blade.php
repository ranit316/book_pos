<div class="row">
    @csrf
    @if (isRetail())
        <div class="col-sm-4">
            <div class="form-group">
                <label for="to_store" class="required">From Store</label>
                <select id="to_store" required class="form-control  " data-live-search="true"
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
                <label for="supplier_id" class="required">Publisher</label>
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
            <label for="transport_charge" class="required">transport_charge</label>
            <input readonly id="transport_charge" required type="number" value="{{ $data->transport_charge }}"
                class="form-control" placeholder="transport_charge" name="transport_charge">
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label for="po_date" class="required">Purchase Date</label>
            <input readonly id="po_date" required value="{{ $data->requisition_date }}"
                type="date" class="form-control" readonly placeholder="Enter Purchase no" name="po_date">
        </div>
    </div>
    <div class="col-sm-4"> 
        <div class="form-group">
            <label for="expected_delivery_date" class="required">expected_delivery_date</label>
            <input readonly  id="expected_delivery_date" required
                value="{{ $data->expected_delivery_date }}" type="date" class="form-control"
                 name="expected_delivery_date">
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
            <label class="optional"> transport details</label>
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
                    <th>Quantity</th>
                    <th>MRP </th>
                  
                    <th>Purchase Price </th>
                   
                    <th>Total Amount</th>
                 
                </tr>
            </thead>
            <tbody>
                @foreach ($data->details as $p)
                  <?php /* ?> <tr><td colspan="6"><?php echo "<pre>"; print_r($p); echo "</pre>"; ?></td></tr><?php */ ?>
                    <tr id="row{{ $loop->index + 1 }}">
                        <td width="2%"><input readonly type="text" id="slno1" value="{{ $loop->index + 1 }}"
                                readonly class="form-control " style="border:none;" /></td>
                        <td width="18%"><select name="products[]"
                                class="form-control form-control-sm  " readonly>
                               
                                @foreach ($products as $product)
                                    @if($product->id == $p->product_id)
                                    <option {{ $product->id == $p->product_id ? 'selected' : '' }}
                                        value="{{ $product->id }}" >
                                        {{ $product->title }}</option>
                                        @endif
                                @endforeach
                            </select>
                        </td>

                        <td><input readonly type="number" name="request_qty[]" value="{{ $p->request_qty }}"
                                placeholder="Request Qty" class="form-control-sm form-control" />
                            </td>
                        <td><input readonly type="number" name="price[]" value="{{ $p->price }}"
                                placeholder="price" class="form-control-sm form-control" />
                            </td>
                        <td>
                  
                        <input readonly type="number" name="purchase_price[]" value="{{ $p->purchase_price }}"
                                placeholder="" class="form-control-sm form-control" />
                        </td>
                     
                        <td>
                        <input readonly type="hidden" name="array_tax_amount[]" value="{{ $p->tax_amount }}"
                                placeholder="tax_amount" class="form-control-sm form-control" />
                      

                        <input readonly type="hidden" name="array_taxeble_amount[]"
                                value="{{ $p->taxeble_amount }}" placeholder="taxeble_amount"
                                class="form-control-sm form-control" />
                        
                        <input readonly type="number" name="array_total_amount[]"
                                value="{{ $p->total_amount }}" placeholder="total_amount"
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
                    @if ($data->store->district->state == $data->store2->district->state)
                        <input readonly type="hidden" name="igst" value="{{ $data->igst }}"
                                placeholder="total_igst" class="form-control-sm form-control" /> </th>
                        
                    @else
                        <input readonly type="hidden" name="cgst" placeholder="total_cgst"
                                value="{{ $data->cgst }}" class="form-control-sm form-control" /> </th>
                        

                        <input readonly type="hidden" name="sgst" value="{{ $data->sgst }}"
                                placeholder="total_sgst" class="form-control-sm form-control" /> </th>
                        
                    @endif

                    <input readonly type="hidden" name="tax_amount" value="{{ $data->tax_amount }}"
                            placeholder="tax_amount" class="form-control-sm form-control" />
                    
                    <input readonly type="hidden" name="taxeble_amount" value="{{ $data->taxeble_amount }}"
                            placeholder="taxeble_amount" class="form-control-sm form-control" /> 
                    
                    <th><input readonly type="number" if="taxeble_amount" value="{{ $data->taxeble_amount }}"
                            placeholder="total_amount" class="form-control-sm form-control" /> 
                    </th>
                    <th></th>
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
    <!-- /.card-body -->
    <div class="col-sm-12 mt-3 text-center">
        <button onclick="ajaxCall('form_data','{{route('purchase.index')}}')" type="button" class="btn btn-primary mt-2">Generate
            {{ $page }}</button>
    </div>
</div>
