<form id="form_update" action="{{route('publisher.update',[$data->id])}}" method="POST">
@csrf
        @method('PUT')
        <input type="hidden" name ="id" value="{{$data->id}}">
        <div id="addproduct-accordion" class="custom-accordion">
            <div class="card">
                <div class= "card-header">
                    <h5 class="font-size-18 mb-0"> Primary Details </h5>
                </div>
                <div class="card-body">
                <div class="row">
       
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="district_id" class="required">District</label>
                            <select id="district_id" required type="text" class="form-control" placeholder="Enter District" name="district_id">
                                <option disabled> - Select District - </option>
                                @foreach ($districts as $district)
                                    <option {{ ($data->district_id == $district->id)?'selected':'' }} value="{{ $district->id }}">
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
                            <input value="{{ $data->store_name }}" required type="text" class="form-control"
                                placeholder="Enter Store  Name" name="store_name">
                        </div>
                    </div>

                  

                  
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="required">Contact Person Name</label>
                            <input required type="text" class="form-control" placeholder="Enter name"
                                name="name" value="{{ $user->name }}" >

                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="optional">Email</label>
                            <input type="text" class="form-control"  value="{{ $user->email }}" readonly>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="optional">Mobile</label>
                            <input type="text" class="form-control"  value="{{ $user->phone }}" readonly>

                        </div>
                    </div>

                   

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="required"> Pin Code</label>
                            <input required type="number" placeholder="Enter Pin Code"
                                class="form-control " maxlength ="6"  onkeyup="maxnumvalidate(this.value,'pin_code',6);"  data-max-chars="6"
                                 name="pin_code" id="pin_code" value="{{ $data->pin_code }}" >
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="required">Status</label>
                            <select class="form-control" name="status">
                              
                                <option value="active" {{ ($data->status=='active')?'selected':'' }}>Active</option>
                                <option value="inactive" {{ ($data->status=='inactive')?'selected':'' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="address" class="required">Address</label>
                            <textarea required id="address" type="text" class="form-control" placeholder="Enter address Name" name="address">{{ $data->address }}</textarea>
                        </div>
                    </div>



                    

                    
                    {{-- <div class="col-sm-12 text-center">
                        <button type="submit"  class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i>Update
                            {{ $page }}</button>
                    </div> --}}
                   
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
                                            <label class="optional"> Bank Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Bank Name"
                                                name="bank_name" value="{{ $data->bank_name }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="optional"> Account Holder Name</label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter Acc Holder Name" name="acc_holder_name" value="{{ $data->acc_holder_name }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="optional"> Account No</label>
                                            <input type="number" class="form-control" placeholder="Enter Acc/no"
                                                name="acc_no" value="{{ $data->acc_no }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="optional"> IFSC Code</label>
                                            <input type="text" class="form-control" placeholder="Enter IFSC Code"
                                                name="ifsc_code"  value="{{ $data->ifsc_code }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="optional"> Gst No</label>
                                            <input type="text" class="form-control limitedno" maxlength ="15"
                                                data-max-chars="15" placeholder="Enter Gst No" name="gst_no" id="gst_no" onkeyup="maxnumvalidate(this.value,'gst_no',15);"  value="{{ $data->gst_no }}">
                                        </div>
                                    </div>

                                    {{-- ----------end------- --}}
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="optional">Logo</label>
                                            <input onchange="image_check(this, 1024)" title="upload logo images"
                                                 class="form-control" type="file" name="logo_image"
                                                placeholder="Enter logo">

                                                <?php if($data->logo_image!=''){
                                                    ?>
                                                    <img src="{{asset($data->logo_image)}}" width="60" />
                                                    <?php
                                                } ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                        <label class="optional"> Description</label>
                            <textarea type="text" class="form-control" placeholder="Enter name" name="description">{{ $data->description }}</textarea>
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

                                                <?php if($data->signature!=''){
                                                    ?>
                                                    <img src="{{asset($data->signature)}}" width="60" />
                                                    <?php
                                                } ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="optional">Map Url</label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter url" name="map_url" value="{{$data->map_url}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
            </div>
            <div class="col-sm-12 text-center">
                        <button type="button" onclick="ajaxCall('form_update')" class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i>Update
                            {{ $page }}</button>
                    </div>
        </div>



</form>
