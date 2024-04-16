<div class="row">
    @csrf

    @if (isRetail())
        <div class="col-sm-4">
            <div class="form-group">
                <label for="to_store" class="required"> Store Name</label>
                <select id="store_id" required class="form-control " data-live-search="true" name="store_id">
                    <option value="{{ $data->store->id }}">
                        {{ $data->store->store_name }}
                    </option>
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="to_store" class="required"> Supplier Name</label>
                <select id="to_store" required class="form-control " data-live-search="true" name="to_store">
                    <option value="{{ $data->to_store }}">
                        {{ $data->store2->store_name }} ({{ $publisher->store_name }})
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
            <label for="grn_no" class="required">GRN No</label>
            <input readonly id="grn_no" name="grn_no" required type="text" class="form-control" readonly
                value="{{ $data->grn_no }}" placeholder="Enter Purchase no">
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label for="do_no" class="required">Dispatch Order No</label>
            <input readonly id="dispatch_no" name="dispatch_no" required type="text" class="form-control" readonly
                value="{{ $data->dispatch_no }}" placeholder="Enter Purchase no">
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label for="po_no" class="required">purchase Order No</label>
            <input readonly id="po_no" name="po_no" required type="text" class="form-control" readonly
                value="{{ $data->po_no }}" placeholder="Enter Purchase no">
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label for="grn_date" class="required">GRN Date</label>
            <input id="grn_date" required value="{{ $data->grn_date }}" type="date" class="form-control" readonly
                placeholder="Enter Purchase no" name="grn_date">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="transport_charge" class="required">transport_charge</label>
            <input id="transport_charge" readonly required type="number" value="{{ $data->transport_charge }}"
                class="form-control" placeholder="transport_charge" name="transport_charge">
        </div>
    </div>
    {{-- <div class="col-sm-4">
        <div class="form-group">
            <label for="expected_delivery_date" class="required">expected_delivery_date</label>
            <input id="expected_delivery_date" required value="{{ $data->expected_delivery_date }}" type="date"
                readonly class="form-control" placeholder="Enter Purchase no" name="expected_delivery_date">
        </div>
    </div> --}}
    {{-- <div class="col-sm-4">
        <div class="form-group">
            <label for="recieved_date" class="required">Received Date</label>
            <input id="recieved_date" required value="{{ date('Y-m-d') }}" type="date" class="form-control"
                placeholder="Enter Purchase no" name="recieved_date">
        </div>
    </div> --}}

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
                    {{-- <th>Storage Site</th>
                    <th>Storage Location</th>
                    <th>Rack</th> --}}
                    <th>Batch No</th>
                    <th>Quantity</th>
                    <th>Price </th>
                    {{-- <th>Purchase Price</th> --}}
                    <th>Total Amount</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($data->grn_details as $k)
                    <tr id="row{{ $loop->index + 1 }}">
                        <td width="2%"><input readonly type="text" id="slno1"
                                value="{{ $loop->index + 1 }}" readonly class="form-control "
                                style="border:none;" /></td>

                        <td><select name="products[]" class="form-control form-control-sm  " readonly>

                                @foreach ($products as $product)
                                    @if ($product->id == $k->product_id)
                                        <option {{ $product->id == $k->product_id ? 'selected' : '' }}
                                            value="{{ $product->id }}">
                                            {{ $product->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>

                        <td><input readonly type="number" name="batch_no[]" value="{{ $k->batch_no }}"
                                placeholder="Request Qty" class="form-control-sm form-control" />
                        </td>

                        <td><input readonly type="number" name="request_qty[]" value="{{ $k->request_qty }}"
                                placeholder="Request Qty" class="form-control-sm form-control" />
                        </td>

                        <td><input readonly type="number" name="price[]" value="{{ $k->price }}"
                                placeholder="Request Qty" class="form-control-sm form-control" />
                        </td>

                        <td><input readonly type="number" name="array_total_amount[]"
                                value="{{ $k->total_amount }}" placeholder="Request Qty"
                                class="form-control-sm form-control" />
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
    </div>
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
                        <input readonly type="hidden" id="discount" placeholder="discount"
                            class="form-control-sm form-control" />
                        - ₹<span id="total_discount">0.00 </span> <span id="discount_percentage"></span>
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
                    
                    ?>Tax - {{ $tax_name }}</td>
                    <td>

                        <input type="hidden" name="tax_amount" id="total_tax" placeholder="total tax"
                            class="form-control-sm form-control" value="{{ sprintf('%0.2f', $data->tax_amount) }}" />
                        <input type="hidden" id="tax_percentage" placeholder="tax percentage"
                            class="form-control-sm form-control" />

                        ₹ <span id="total_tax_lable">{{ sprintf('%0.2f', $data->tax_amount) }} </span>( <span
                            id="tax_percentage_label">{{ $tax_rate }}</span> %)
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
                        <input type="hidden" name="round_off_amount" id="adjustment"
                            value="{{ $data->round_off_amount }}" placeholder="Adjustment amount" min="0"
                            onkeyup="calculation();" class="form-control-sm form-control"
                            style="float:inline-end;width:150px;" />

                    </td>
                    <td>

                        - ₹ <span id="adjustment_lable"> {{ sprintf('%0.2f', $data->round_off_amount) }} </span>
                    </td>
                </tr>

                <tr>
                    <td><span class="font-weight-bold">Grand Total</span>
                    </td>
                    <td>
                        <input type="hidden" name="total_amount" id="total_amount_value" placeholder="amount"
                            value="{{ sprintf('%0.2f', $data->total_amount) }}"
                            class="form-control-sm form-control" />
                        ₹<span class="font-weight-bold" id="total_amount_label">
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
    <button onclick="selectDrop('form_data', '{{route('purchaseinv.store')}}','listprint')" data-bs-toggle="modal" data-bs-target="#print_inv" type="button"
        class="btn btn-primary mt-2">
        Generate Purchase invoice</button>
    {{-- ajaxCall('form_data','{{route('purches.index')}}') --}}
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
{{-- Modal --}}
{{-- <div class="modal fade" id="print_bill" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
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
        </div> --}}
