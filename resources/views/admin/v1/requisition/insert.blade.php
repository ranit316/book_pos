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
                                    <a class="btn btn-primary add-list btn-sm text-white"
                                        href="{{ route('requisition.index') }}"><i class="las la-plus mr-3"></i>Back to
                                        {{ $page }} List</a>
                                </div>
                                <!-- Modal body -->
                                <div class="card-body">
                                    <form id="form_data" action="{{ route('requisition.store') }}" method="POST">
                                        <div class="row">
                                            @csrf
                                            @if (isRetail())
                                                <div class="col-sm-4">
                                                    <div class="form-group"> 
                                                        <label for="to_store" class="required">Select Central Store</label>
                                                        <select id="to_store" required class="form-control selectpicker "
                                                            onchange="getBooksByStore()"
                                                            data-live-search="true" 
                                                            name="to_store">
                                                            <option selected disabled> - Select Store - </option>
                                                            @foreach ($stores as $store)
                                                                <option value="{{ $store->user->id }}">{{ $store->store_name }} ({{$store->publisher->store_name}})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (isCentral())
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="supplier_id" class="required">Supplier</label>
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
                                           

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="optional"> Description</label>
                                                    <textarea type="text"  class="form-control" placeholder="Enter name" name="description"></textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="card-body table-responsive">
                                                <table class="table table-bordered " id="dynamic_field"
                                                    style="overflow-y:auto;display:none;">
                                                    <thead>
                                                        <tr>
                                                            <th data-field="S.NO" data-sortable="true" rowspan="2">S.NO
                                                            </th>
                                                            <th>Products </th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            {{-- <th>Tax Amount</th> --}}
                                                            {{-- <th>Taxeble Amount</th>  --}}
                                                            <th>Total Amount</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td width="2%"><input type="text" id="slno1"
                                                                    value="1" readonly class="form-control selectpicker"
                                                                    style="border:none;" /></td>
                                                            <td width="18%"><select onchange="product(this.value,0)"
                                                                    id="products0" name="products[]"
                                                                    class="form-control form-control-sm products selectpicker prod_dd"
                                                                    data-live-search="true" required>
                                                                    <option value="" selected disabled> -Search Products-
                                                                    </option>
                                                                    
                                                                </select> </td>

                                                            <td><input type="number" name="request_qty[]"
                                                                    onkeyup="qtyCal(this.value);check_positive(this.value,0);" id="request_qty_0" 
                                                                    onclick="qtyCal(this.value)" placeholder="Request Qty"
                                                                    class="form-control-sm form-control request_qty req_q0" min="1" required/></td>


                                                            <td><input type="number" readonly name="price[]" placeholder=""
                                                                    placeholder="price" onkeyup="calculation();qtyCal(this.value);"
                                                                    onclick="calculation();qtyCal(this.value);" min="1"
                                                                    class="form-control-sm form-control price price_per_u0" required />
                                                            </td>


                                                            <td>


                                                            <input type="hidden" value="0" name="array_taxeble_amount[]" 
                                                                    onkeyup="calculation()" onclick="calculation()"
                                                                    placeholder="taxeble_amount"
                                                                    class="form-control-sm form-control array_taxeble_amount arr_taxeble_amt0" />
                                                          
                                                            <input readonly type="number" name="array_total_amount[]"
                                                                    onkeyup="calculation()" onclick="calculation()" required
                                                                    placeholder="total amount"
                                                                    class="form-control-sm form-control array_total_amount arr_total_amt0" />
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
                                                           
                                                            <th colspan="3"></th>
                                                            <th>Sub Total</th>
                                                            <th>

                                                            <input type="hidden" name="taxeble_amount"
                                                                    id="taxeble_amount" placeholder="taxeble_amount"
                                                                    class="form-control-sm form-control" /> 
                                                           
                                                           <input type="number" readonly name="total_amount"
                                                                    id="total_amount" placeholder="sub total amount"
                                                                    class="form-control-sm form-control" />
                                                            </th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                            <div class="col-sm-12 mt-3 text-center">
                                                <button onclick="ajaxCall('form_data','{{route('requisition.index')}}')" type="button"
                                                    class="btn btn-primary mt-2" id="submit_button" style="display:none;">Add
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
    @endslot
</x-layout>

<script>
    $(document).ready(function() {
        var i = 1;


        $('#add').click(function() {

         var first_product = $('#products0').val(); 
         if(first_product=='' || first_product==null){
            alert('Please select first product');
         }else{
            i++;
            j = i - 1;
            $('#dynamic_field').append('<tr id="row' + i +
                '" class="dynamic-added" ><td><input type="text" id="slno' + i + '" value="' + i +
                '"readonly class="form-control-sm form-control" style="border:none;" /></td>' +
                '<td><select onchange="product(this.value,' + i +
                ')"   name="products[]"  id="products' + i + '" placeholder="Search products.." class="form-control form-control-sm products selectpicker prod_dd" data-live-search="true" required>  <option value=""> -Search Products-   </option>  </select></td>' +
                '<td><input   onkeyup="qtyCal(this.value);check_positive(this.value,'+j+');calculation();" onclick="qtyCal(this.value);check_positive(this.value,'+j+');calculation();" id="request_qty_'+j+'"   type="number" required name="request_qty[]" placeholder="Request Qty" class="form-control-sm form-control request_qty req_q' + i + ' " min="1" /></td>' +
                '<td><input type="number" readonly name="price[]" placeholder="price"  class="form-control-sm form-control price price_per_u' + i + '" onkeyup="calculation();qtyCal(this.value);calculation();" onclick="calculation();qtyCal(this.value);calculation();" min="1" required /> </td>' +
                // '<td><input type="number" name="array_tax_amount[]" placeholder="tax_amount"  class="form-control-sm form-control array_tax_amount " onkeyup="calculation()" onclick="calculation()" /> </td>' +
                '<input type="hidden" name="array_taxeble_amount[]"placeholder="taxeble_amount" class="form-control-sm form-control array_taxeble_amount arr_taxeble_amt' + i + '" onkeyup="calculation()" onclick="calculation()" />' +
                ' <td><input type="number" readonly name="array_total_amount[]"placeholder="total amount" class="form-control-sm form-control array_total_amount arr_total_amt' + i + '" onkeyup="calculation()" onclick="calculation()" /> </td>' +
                '<td><button type="button" name="remove" id="' + i +
                '" class="btn btn-danger btn-sm btn_remove">X</button></td></tr>');
                get_books(i);
         }

          
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            
            $('#row' + button_id + '').remove();
            setTimeout(qtyCal, 1000);
        });


    });
    
    function check_positive(val,no){ 
        val = parseInt(val);
        val = Math.abs(val);
        //alert(val);
        if(!isNaN(val)){
            $('#request_qty_'+no).val(val);
            qtyCal();
        }
       
    }
    function qtyCal() {
        const request_qty = document.getElementsByClassName('request_qty');
        const price = document.getElementsByClassName('price');
        var array_taxeble_amount = document.getElementsByClassName('array_taxeble_amount');
        var array_total_amount = document.getElementsByClassName('array_total_amount');
        //console.log("Wasif")
        for (i = 0; i < request_qty.length; i++) {
            array_taxeble_amount[i].value = Number(request_qty[i].value) * Number(price[i].value).toFixed(2);
            array_total_amount[i].value = Number(request_qty[i].value) * Number(price[i].value).toFixed(2);
        }
        calculation();
    }



    function calculation() {
       // console.log('calculation start');
        spinner_show();
        // const array_tax_amount = document.getElementsByClassName('array_tax_amount');
        const array_taxeble_amount = document.getElementsByClassName('array_taxeble_amount');
        const array_total_amount = document.getElementsByClassName('array_total_amount');

        // for seting the value into the total amount
        // const tax_amount = document.getElementById('tax_amount');
        const taxeble_amount = document.getElementById('taxeble_amount');
        const total_amount = document.getElementById('total_amount');
        // updating the amount
        // var total_tax_amount = 0;
        var total_taxeble_amount = 0;
        var total_total_amount = 0;

        for (i = 0; i < array_taxeble_amount.length; i++) {
            // total_tax_amount = total_tax_amount + Number(array_tax_amount[i].value);
            total_taxeble_amount = total_taxeble_amount + Number(array_taxeble_amount[i].value);
            total_total_amount = total_total_amount + Number(array_total_amount[i].value);
        }

        // tax_amount.value = total_tax_amount;
        taxeble_amount.value = total_taxeble_amount;
        total_amount.value = total_total_amount;
       // console.log('calculation end');
        spinner_hide();

    }

    // fetch data behalf of price

    function product(product_id, prosition) {
       
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    data = JSON.parse(this.responseText)
                   // console.log(data);
                    document.getElementsByClassName('req_q' + prosition)[0].value = 1;
                    document.getElementsByClassName('price_per_u' + prosition)[0].value = data.price;
                    document.getElementsByClassName('arr_taxeble_amt' + prosition)[0].value = data.price;
                    document.getElementsByClassName('arr_total_amt' + prosition)[0].value = data.price;
                    qtyCal();
                }
            };
            xhttp.open('GET', "{{ route('requisition.product.price') }}/" + product_id, true);
            xhttp.send();
        

    }

    function getBooksByStore() {
        var to_store = $('#to_store').val();
        if(to_store=='' || to_store==null)
        {
            $('#dynamic_field').hide();
            $('#submit_button').hide();
            
        }
        else
        {
            $('#dynamic_field').show();
            $('#submit_button').show();
        }
        

        i = 1;
                document.getElementsByClassName('products')[0].value = '';
                document.getElementsByClassName('request_qty')[0].value = '';
                document.getElementsByClassName('price')[0].value = '';
                document.getElementsByClassName('array_taxeble_amount')[0].value = '';
                document.getElementsByClassName('array_total_amount')[0].value = '';

                const elements = document.getElementsByClassName('dynamic-added');
                while (elements.length > 0) {
                    elements[0].remove();
                }
                document.getElementById('taxeble_amount').value = '';
                document.getElementById('total_amount').value = '';

                get_books(0);
    }

    function get_books(prosition) {
       
        var form = document.getElementById('form_data');
            var method = "POST";
            var formdata = new FormData(form);
            var formElements_button = Array.from(form.elements).pop();
            preloader(formElements_button);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   // console.log(this.responseText);

                    $('#products' + prosition).empty();
                    data = JSON.parse(this.responseText);
                    // Populate the Book dropdown with new options
                    var loc_str ='<option value=""> -Search Books- </option>';
                    if(data.length > 0) {

                    var all_selected_prod = [];
                    $(".prod_dd").each(function() {

                        if ($(this).val() > 0) {
                            all_selected_prod.push(parseInt($(this).val()));
                        }

                    });


                    $.each(data, function(key, value) {
                        //console.log(value);
                         if (all_selected_prod.indexOf(value.id) > -1) {

                        } else {
                            loc_str +='<option value="' + value.id + '">' + value.title + '</option>';
                       
                        }
                    });
                    $('#products' + prosition).append(loc_str);

                    // Refresh the selectpicker to reflect the changes
                    $('#products' + prosition).selectpicker('refresh');
                 } else {
                    alert("No books available");
                 }
                 stopPreloader(formElements_button);
                }
                method;
            };
            xhttp.open(method, '{{ route('requisition.product.central') }}', true);
            xhttp.send(formdata);

    }
</script>

<!-- // model -->
<script>
    
 
function spinner_show()
{
  $('#spinner_content').show();
}
function spinner_hide()
{
  $('#spinner_content').hide();
}

</script>