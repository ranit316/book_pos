
<!-- The Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
            <h1 class="modal-title fs-5 ">Add {{ $page }} </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="form_data" action="{{ route('publisher.store') }}" method="POST">

                    @csrf
                    <div id="addproduct-accordion" class="custom-accordion">
                        <div class="card">
                            <div class= "card-header">
                                <h5 class="font-size-18 mb-0"> Primary Details </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <input type="hidden" value="publisher" name="type" id="type">
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
                                                <select id="district_id" required class="form-control selectpicker" data-live-search="true" name="district_id">
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
                                            <label class="required"> Publisher House Name</label>
                                            <input required type="text" class="form-control"
                                                placeholder="Enter publisher house  Name" name="store_name">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">Contact Person Name</label>
                                            <input required type="text" class="form-control" placeholder="Enter name"
                                                name="name">

                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">email</label>
                                            <input required type="text" class="form-control"
                                                placeholder="Enter email address" name="email">

                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">mobile</label>
                                            <input required type="number" placeholder="Enter mobile number"
                                                class="form-control limitedphn" maxlength ="10" data-max-chars="10"
                                                name="phone">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">password</label>
                                            <input required type="password" class="form-control"
                                                placeholder="Enter password" class="input-control count-chars"
                                                name="password">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">Confirm Password</label>
                                            <input required type="password" class="form-control"
                                                placeholder="Enter Confirm Password" name="password_confirmation">
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required"> Pin Code</label>
                                            <input required type="number" placeholder="Enter Pin Code"
                                                class="form-control limitedTxt" maxlength ="6" data-max-chars="6"
                                                class="input-control count-chars" name="pin_code">
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="address" class="required">Address</label>
                                            <textarea required id="address" type="text" class="form-control" placeholder="Enter Address"
                                                name="address"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Bank account Details --}}
                        <div class ="card">
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
                                            <input type="text" class="form-control limitedno" maxlength ="15"
                                                data-max-chars="15" placeholder="Enter Gst No" name="gst_no">
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
                                            <label class="optional"> Billing Header</label>
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
                                            <input type="text" class="form-control" placeholder="Enter url" name="map_url">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 text-center">
                            <button type="button" onclick="ajaxCall('form_data','{{route('publisher.index')}}')"
                                class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i>Save
                                {{ $page }}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- // model -->




<script>
    $(document).ready(function() {
        charLimit_gst(15);
        charLimit_pin(6);
        charLimit_phone(10);
    });

    function charLimit_gst(limit) {

        $('.charLimit').text('(' + limit + '):');
        $('.charLeft').text(limit);

        //still working on getting mouse cut and paste working
        $('.limitedno').bind({
            copy: function() {
                console.log("copy");
            },
            paste: function() {
                console.log("paste");
                var charLen = this.value.length;
                var textVal = limit - charLen;
                console.log(charLen);
                console.log(textVal);
                if (charLen >= limit) {
                    this.value = this.value.substring(0, limit);
                }
                if (textVal <= limit && textVal > 1) {
                    $('.charLeft').removeClass('charError').text(textLen);
                }
            },
            cut: function() {
                console.log("cut");
            }
        });

        $('.limitedno').keyup(function() {
            var charLen = this.value.length;
            var textLen = $('.charLeft').text(limit - charLen);
            var textVal = limit - charLen;
            if (charLen >= limit) {
                this.value = this.value.substring(0, limit);
            }
            if (textVal <= limit && textVal > 1) {
                $('.charLeft').removeClass('charError').text(textLen);
            } else if (textVal <= 0) {
                $('.charLeft').text('limit reached').addClass('charError');
            }
        });
    }

    function charLimit_pin(limit) {

        $('.charLimit').text('(' + limit + '):');
        $('.charLeft').text(limit);

        //still working on getting mouse cut and paste working
        $('.limitedTxt').bind({
            copy: function() {
                console.log("copy");
            },
            paste: function() {
                console.log("paste");
                var charLen = this.value.length;
                var textVal = limit - charLen;
                console.log(charLen);
                console.log(textVal);
                if (charLen >= limit) {
                    this.value = this.value.substring(0, limit);
                }
                if (textVal <= limit && textVal > 1) {
                    $('.charLeft').removeClass('charError').text(textLen);
                }
            },
            cut: function() {
                console.log("cut");
            }
        });

        $('.limitedTxt').keyup(function() {
            var charLen = this.value.length;
            var textLen = $('.charLeft').text(limit - charLen);
            var textVal = limit - charLen;
            if (charLen >= limit) {
                this.value = this.value.substring(0, limit);
            }
            if (textVal <= limit && textVal > 1) {
                $('.charLeft').removeClass('charError').text(textLen);
            } else if (textVal <= 0) {
                $('.charLeft').text('limit reached').addClass('charError');
            }
        });
    }


    function charLimit_phone(limit) {

        $('.charLimit').text('(' + limit + '):');
        $('.charLeft').text(limit);

        //still working on getting mouse cut and paste working
        $('.limitedphn').bind({
            copy: function() {
                console.log("copy");
            },
            paste: function() {
                console.log("paste");
                var charLen = this.value.length;
                var textVal = limit - charLen;
                console.log(charLen);
                console.log(textVal);
                if (charLen >= limit) {
                    this.value = this.value.substring(0, limit);
                }
                if (textVal <= limit && textVal > 1) {
                    $('.charLeft').removeClass('charError').text(textLen);
                }
            },
            cut: function() {
                console.log("cut");
            }
        });

        $('.limitedphn').keyup(function() {
            var charLen = this.value.length;
            var textLen = $('.charLeft').text(limit - charLen);
            var textVal = limit - charLen;
            if (charLen >= limit) {
                this.value = this.value.substring(0, limit);
            }
            if (textVal <= limit && textVal > 1) {
                $('.charLeft').removeClass('charError').text(textLen);
            } else if (textVal <= 0) {
                $('.charLeft').text('limit reached').addClass('charError');
            }
        });
    }
</script>
