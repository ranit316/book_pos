<div class="row">

    <div class="col-sm-4">
        <div class="form-group">
            <label for="customer_name" class="">Customer Name</label>
            <input readonly id="customer_name" type="text" value="{{ ucwords($data->customer->name) }}"
                class="form-control" placeholder="Customer Name" name="Customer_name">
            <input type="hidden" name="customer_id" id="customer_id" value="{{ $data->customer->id }}">
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label for="po_date" class="required">Sale Date</label>
            <input readonly id="sale_date" required value="{{ $data->sale_date }}" type="date" class="form-control"
                readonly placeholder="Enter Purchase no" name="sale_data">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="expected_delivery_date" class="required">Sale Amount</label>
            <input readonly id="sale_amount" required value="{{ $data->total }}" type="text" class="form-control"
                name="expected_delivery_date">
        </div>
    </div>
    {{-- <div class="col-sm-4">
        <div class="form-group">
            <label for="status1" class="required">status</label>
            <select id="status1" name="status" required class="form-control" name="status">
                <option value=""> </option>
            </select>
        </div>
    </div> --}}

    {{-- <div class="col-sm-12">
        <div class="form-group">
            <label class="optional"> transport details</label>
            <textarea readonly class="form-control" placeholder="transport_details" name="transport_details"></textarea>
        </div>
    </div> --}}
    <div class="col-sm-12">
        <div class="form-group">
            <label class="optional"> Description</label>
            <textarea type="text" class="form-control" placeholder="Enter name" name="description"></textarea>
        </div>
    </div>
    <hr>
    @php
        function getAvailableQty($productId)
        {
            $product = App\Models\MasterStockInventery::where('store_id', loginStore()->id)
                ->where('qty', '>', 0)
                ->where('product_id', $productId)
                ->first();
            return $product ? $product->qty : 0;
        }
    @endphp

    <div class="card-body table-responsive">
        <table class="table align-middle table-nowrap table-check " id="dynamic_field" style="overflow-y:auto;">
            <thead>
                <tr>
                    <th data-field="S.NO" data-sortable="true">S.NO
                    </th>
                    <th>Products </th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Storage Site</th>
                    <th>Storage location</th>
                    <th>Racks</th>
                    <th>Batch No</th>
                    {{-- <th>Total Amount</th> --}}
                    <th>Lot no</th>
                </tr>
            </thead>

            <tbody>
                <div class="inline-scroll">

                    @foreach ($products as $index => $k)
                        <tr>
                            <td>
                                <input type="text" id="slno{{ (int) $index + 1 }}" value="{{ (int) $index + 1 }}"
                                    readonly class="form-control " style="border:none;" />
                            </td>
                            <td>
                                <input type="hidden" readonly class="form-control" style="border:none;"
                                    value="{{ $k->product_id }}" name="product_id[]">
                                <input type="text" readonly class="form-control" style="border:none;"
                                    value="{{ $k->product->title }}">
                                <br>
                                <small class="" id="" value="">Available Qty:
                                    {{ getAvailableQty($k->product_id) }}</small>
                            </td>
                            <td>
                                <input onkeyup="checkQty(this)" type="text" class="form-control exchange-qty"
                                    style="border:none;" value="" name="Qty[]">
                                <small class="errorshow text-danger"></small>
                                <br>
                                <small class="" id="" value="">Purchase Qty:
                                    <span class="purchan-qty"> {{ $k->qty }}</span></small>
                            </td>
                            <td>
                                <input type="text" readonly class="form-control " style="border:none;"
                                    value="{{ $k->price }}" name="price[]">
                            </td>
                            <td>
                                <input type="text" readonly class="form-control" style="border:none;"
                                    value="{{ $data->storage_site->name }}" name="">
                                    <input type="hidden" readonly value="{{ $data->storage_site->id }}" name="storage_site_id[]">
                            </td>
                            <td>
                                <select id="storage_site_id{{ (int) $index + 1 }}" name="storage_location_id[]"
                                    class="form-control form-control-sm  " onchange="">
                                    @foreach ($sites as $site)
                                        <option value="{{ $site->id ?? '' }}">
                                            {{ $site->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <select id="rack_id{{ (int) $index + 1 }}" name="rack_id[]"
                                    class="form-control form-control-sm  " onchange="">
                                    @foreach ($racks as $rack)
                                        <option value="{{ $rack->id ?? '' }}">
                                            {{ $rack->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <input type="text" class="form-control" style="border:none;" value=""
                                    name="batch_no[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" style="border:none;" value=""
                                    name="lot_no[]">
                            </td>
                        </tr>
                    @endforeach
                </div>
            </tbody>
        </table>
    </div>
</div>
<div class="col-sm-12 mt-3 text-center">
    <button type="submit" class="btn btn-primary mt-2 submit">Generate Exchange</button>
</div>
