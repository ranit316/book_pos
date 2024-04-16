<!-- The Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5 ">Add {{ $pagename }} </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">

                <form id="form_data" action="{{ route('stores.store') }}" method="POST">
                    @csrf
                    <div id="addproduct-accordion" class="custom-accordion">
                        <div class="card">
                            <div class= "card-header">
                                <h5 class="font-size-18 mb-0"> Primary Details </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" value="{{ $page }}" name="type" id="type">

                                    @if ($page == 'central-store')
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="store_type" class="required">Store Type</label>
                                                <select id="store_type" onchange="masterstore(this.value)" required
                                                    type="text" class="form-control" placeholder="Enter Store Type "
                                                    name="store_type">
                                                    <option value=""><strong>Select store type</strong>
                                                    </option>
                                                    <option value="master"><strong>Master Store</strong> </option>
                                                    <option value="substore"><strong>Sub Store</strong> </option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif

                                    @if (auth()->user()->type == 'admin')
                                        @if ($page == 'central-store')
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="publisher_id" class="required">Publisher</label>
                                                    <select id="publisher_id" onchange="publisherforstore(this.value)"
                                                        required class="form-control selectpicker"
                                                        data-live-search="true" name="publisher_id">
                                                        <option selected disabled> - Select Publisher - </option>
                                                        @foreach ($publishers as $publisher)
                                                            <option value="{{ $publisher->id }}">
                                                                <strong>{{ $publisher->store_name }}</strong>
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                    @endif

                                    <div class="col-sm-4 d-none centralstore">
                                        <div class="form-group">
                                            <label for="store_id" class="required">Central Store</label>
                                            <select id="store_id" type="text" class="form-control"
                                                placeholder="Enter Store Type " name="master_store_id">
                                                <option value=""><strong>Select Store</strong> </option>
                                                @if (auth()->user()->type == 'publisher')
                                                    @foreach ($store as $k)
                                                        <option value="{{ $k->id }}">
                                                            <strong>{{ $k->store_name }}</strong>
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="state_id" class="required">State</label>
                                            <select id="state_id" required type="text" class="form-control"
                                                placeholder="Enter  District " name="state_id">
                                                <option value="West Bengal"><strong>West Bengal</strong> </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="district_id" class="required">District</label>
                                            <select id="district_id" required class="form-control selectpicker"
                                                data-live-search="true" name="district_id">
                                                <option selected disabled> - Select District - </option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}">
                                                        <strong>{{ $district->name }}</strong> -
                                                        <span class="text-red">{{ $district->state }}</span>
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required"> Store Name</label>
                                            <input required type="text" class="form-control"
                                                placeholder="Enter Store  Name" name="store_name">
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">Contact Person Name</label>
                                            <input required type="text" class="form-control"
                                                placeholder="Enter contact person name" name="name">

                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">Mobile</label>
                                            <input required type="tel" class="form-control limitedphne"
                                                placeholder="Enter  mobile number" maxlength="10" data-max-chars='10'
                                                class="input-control count-chars" name="phone" id="phone"
                                                onkeyup="maxnumvalidate(this.value,'phone',10);">
                                        </div>
                                    </div>





                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">Email</label>
                                            <input required type="text" class="form-control"
                                                placeholder="Enter  email address" name="email">

                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">password</label>
                                            <input required type="password" class="form-control"
                                                placeholder="Enter  password" name="password" id="pass">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">Confirm Password</label>
                                            <input required type="password" class="form-control"
                                                placeholder="Enter  Confirmed Passoword" name="password_confirmation"
                                                id="conpass">
                                            <div>
                                                <span id="wrong" style="background-color: red;">Password is
                                                    Incorrect</span>
                                                <span id="right" style="background-color: green;">Password is
                                                    correct</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required"> Pin Code</label>
                                            <input required type="number" class="form-control limitedTxt"
                                                placeholder="Enter Pin Code" maxlength="6" data-max-chars='6'
                                                class="input-control count-chars" name="pin_code" id="pin_code"
                                                onkeyup="maxnumvalidate(this.value,'pin_code',6);">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="address" class="required">Address</label>
                                            <textarea required id="address" class="form-control" placeholder="Enter address Name" name="address"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Bank account Details --}}

                        <div class= "card">

                            <div class="col-sm-12">
                                <div class= "card-header">
                                    <h5 class="font-size-18 mb-0"> Official Details </h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class ="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="optional"> Bank Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Bank Name"
                                                name="bank_name">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="optional"> Account Holder Name</label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter Acc Holder Name" name="acc_holder_name">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="optional"> Account No</label>
                                            <input type="number" class="form-control" placeholder="Enter Acc/no"
                                                name="acc_no">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="optional"> IFSC Code</label>
                                            <input type="text" class="form-control" placeholder="Enter IFSC Code"
                                                name="ifsc_code">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="optional"> Gst No</label>
                                            <input type="number" class="form-control limitedno"
                                                placeholder="Enter Gst No" name="gst_no">
                                        </div>
                                    </div>

                                    {{-- ----------end------- --}}
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">Logo</label>
                                            <input onchange="image_check(this, 1024)" title="upload logo images"
                                                required class="form-control" type="file" name="logo_image"
                                                placeholder="Enter logo">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="optional"> Description</label>
                                            <textarea type="text" class="form-control" placeholder="Enter name" name="description"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class ="card">
                            <div class="col-sm-12">
                                <div class= "card-header">
                                    <h5 class="font-size-18 mb-0"> Billing Information</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class ="row">

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="required"> Billing Header</label>
                                            <textarea class="form-control" placeholder="Enter Billing details" name="billing_header"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Signature</label>
                                            <input onchange="image_check(this, 1024)" title="upload signature"
                                                class="form-control" type="file" name="signature"
                                                placeholder="Enter Signature">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="optional">Map Url</label>
                                            <input type="text" class="form-control" placeholder="Enter url"
                                                name="map_url">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-12 text-center">
                        <button type="button" onclick="ajaxCall('form_data')" class="btn btn-success btn-rounded"><i
                                class="uil uil-check me-2"></i>Save
                            {{ $pagename }}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- // model -->


<script>
    document.getElementById('wrong').style.display = 'none';
    document.getElementById('right').style.display = 'none';
    document.getElementById('conpass').addEventListener('keyup', function() {
        var pass = document.getElementById('pass').value;
        var con_pass = document.getElementById('conpass').value;
        if (pass == con_pass) {
            document.getElementById('wrong').value = 'none';
            document.getElementById('right').value = 'block';
        } else {
            document.getElementById('wrong').value = 'block';
            document.getElementById('right').value = 'none';
        }
        if (con_pass.length == 0) {
            document.getElementById('right').value = 'none';
            document.getElementById('wrong').value = 'none';
        }

    });

    function masterstore(value) {
        var store_type = value;

        if (store_type == 'substore') {
            $('.centralstore').removeClass("d-none").show();
        } else {
            $('.centralstore').addClass('d-none').hide();
        }
    }

    function publisherforstore(value) {
        var publisher_id = value;

        $.ajax({
            type: "GET",
            url: "{{ route('store.get.publisher', ['id' => ':publisher_id']) }}".replace(':publisher_id',
                publisher_id),
            success: function(response) {
                $('#store_id').empty();

                if (response.length > 0) {
                    $('#store_id').append('<option selected disabled> - Select Store </option>');
                    response.forEach(function(store) {
                        $('#store_id').append('<option value="' + store.id + '">' + store
                            .store_name + '</option>');
                    });
                } else {
                    $('#store_id').append('<option value="">No store Available</option>');
                }
                $('.selectpicker').selectpicker('refresh');
            }
        });
    }
</script>
