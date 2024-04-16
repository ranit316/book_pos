<div id="addproduct-accordion" class="custom-accordion">
    <div class="card">
        <div class= "card-header">
            <h5 class="font-size-18 mb-0"> Primary Details </h5>
        </div>
        <div class="card-body">
            <div class="row">        
                
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class=""> Store Name</label>
                        <input value="{{ $data->store_name }}"  type="text" class="form-control"
                             name="store_name" readonly>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="district_id" class="">District</label>
                        <input value="{{ $data->district->name }}"  type="text" class="form-control"
                           name="store_name" readonly>
                       
                    </div>
                </div>
                <div class="col-sm-4">
                        <div class="form-group">
                            <label class="">Contact Person Name</label>
                            <input  type="text" class="form-control" 
                                name="name" value="{{ $user->name }}" readonly>

                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="">Email</label>
                            <input type="text" class="form-control"  value="{{ $user->email }}" readonly>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="">Mobile</label>
                            <input type="text" class="form-control"  value="{{ $user->phone }}" readonly>

                        </div>
                    </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>PIN</label>
                        <input value="{{ $data->pin_code }}"  type="text" class="form-control" name="pin" readonly>
                    </div>
                </div>

                
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="address">Status</label>
                        <input  id="address" type="text" class="form-control"  name="address" value="{{ $data->status }}" readonly>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="address" class="">address</label>
                        <textarea  id="address" type="text" class="form-control"  name="address" readonly>{{ $data->address }}</textarea>
                    </div>
                </div>

              


               
                
            </div>
        </div>
    </div>

    <div class="card">
        <div class= "card-header">
            <h5 class="font-size-18 mb-0"> Official Details </h5>
        </div>
        
        <div class="card-body">
                                <div class ="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class=""> Bank Name</label>
                                            <input type="text" class="form-control" 
                                                name="bank_name" value="{{ $data->bank_name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class=""> Account Holder Name</label>
                                            <input type="text" class="form-control"
                                                 name="acc_holder_name" value="{{ $data->acc_holder_name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class=""> Account No</label>
                                            <input type="number" class="form-control" 
                                                name="acc_no" value="{{ $data->acc_no }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class=""> IFSC Code</label>
                                            <input type="text" class="form-control" 
                                                name="ifsc_code"  value="{{ $data->ifsc_code }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class=""> Gst No</label>
                                            <input type="text" class="form-control limitedno" maxlength ="15"
                                                data-max-chars="15" name="gst_no" id="gst_no" onkeyup="maxnumvalidate(this.value,'gst_no',15);"  value="{{ $data->gst_no }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class=""> Merchant Id</label>
                                            <input type="text" class="form-control limitedno" maxlength ="15"
                                                data-max-chars="15" name="gst_no" id="mercid"  value="{{ $data->mercid }}" readonly>
                                        </div>
                                    </div>

                                    {{-- ----------end------- --}}
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="">Logo</label>
                                           

                                                <?php if($data->logo_image!=''){
                                                    ?>
                                                      <img src="{{ asset($data->logo_image) }}" alt="Company Logo" class="img-fluid mb-2"
                            style="width:200px;">
                                                    <?php
                                                } ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                        <label class=""> Description</label>
                            <textarea type="text" class="form-control"  name="description" readonly>{{ $data->description }}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
        
    </div>

    <div class="card">
        <div class= "card-header">
            <h5 class="font-size-18 mb-0"> Billing Information </h5>
        </div>
        <div class="card-body">
                                <div class ="row">

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class=""> Billing Header</label>
                                            <textarea class="form-control"  name="billing_header" readonly>{{ $data->billing_header }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Signature</label>
                                           

                                                <?php if($data->signature!=''){
                                                    ?>
                                                    <img src="{{asset($data->signature)}}" alt="Company Logo" class="img-fluid mb-2"
                            style="width:200px;">
                                                    <?php
                                                } ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
    </div>
</div>

                    
                
                
    