<x-layout>
    @slot('title')
    @slot('body')


        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Publisher List</h4>
                                    </div>       
                                </div>

                                <!-- Modal body -->
                                <div class="card-body">
                                    <form id="form_data" action="" method="POST">
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
                                                        {{-- <div class="col-sm-4">
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
                                                        </div> --}}
                    
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="required"> Publisher House Name</label>
                                                                <input required type="text" class="form-control"
                                                                    placeholder="Enter Store Name" name="store_name" value="{{ $data->store_name }}">
                                                            </div>
                                                        </div>
                    
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="required">Contact Person Name</label>
                                                                <input required type="text" class="form-control" placeholder="Enter name"
                                                                    name="name"  value="{{$data->user->name}}">
                    
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="required">email</label>
                                                                <input required type="text" class="form-control"
                                                                    placeholder="Enter  email address" name="email"  value="{{$data->user->email}}" readonly>
                    
                                                            </div>
                                                        </div>
                    
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="required">mobile</label>
                                                                <input required type="number" placeholder="Enter  mobile number"
                                                                    class="form-control limitedphn" maxlength ="10" data-max-chars="10"
                                                                    name="phone"  value="{{$data->user->phone}}" readonly>
                                                            </div>
                                                        </div>
                    
                                                        {{-- <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="required">password</label>
                                                                <input required type="password" class="form-control"
                                                                    placeholder="Enter  password" class="input-control count-chars"
                                                                    name="password">
                                                            </div>
                                                        </div> --}}
                                                        {{-- <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="required">Confirmed Passoword</label>
                                                                <input required type="password" class="form-control"
                                                                    placeholder="Enter  Confirmed Passoword" name="password_confirmation">
                                                            </div>
                                                        </div> --}}
                    
                    
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="required"> Pin Code</label>
                                                                <input required type="number" placeholder="Enter Pin Code"
                                                                    class="form-control limitedTxt" maxlength ="6" data-max-chars="6"
                                                                    class="input-control count-chars" name="pin_code"  value="{{$data->pin_code}}">
                                                            </div>
                                                        </div>
                    
                    
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="address" class="required">Address</label>
                                                                <textarea required id="address" type="text" class="form-control" placeholder="Enter address Name"
                                                                    name="address"  value="{{$data->address}}"></textarea>
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
                                                                    name="bank_name"  value="{{$data->bank_name}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="optional"> Account Holder Name</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Enter Acc Holder Name" name="acc_holder_name"  value="{{$data->acc_holder_name}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="optional"> Account No</label>
                                                                <input type="number" class="form-control" placeholder="Enter Acc/no"
                                                                    name="acc_no"  value="{{$data->acc_no}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="optional"> IFSC Code</label>
                                                                <input type="text" class="form-control" placeholder="Enter IFSC Code"
                                                                    name="ifsc_code"  value="{{$data->ifsc_code}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="optional"> Gst No</label>
                                                                <input type="text" class="form-control limitedno" maxlength ="15"
                                                                    data-max-chars="15" placeholder="Enter Gst No" name="gst_no"  value="{{$data->gst_no}}">
                                                            </div>
                                                        </div>
                    
                                                        {{-- ----------end------- --}}
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="required">Logo</label>
                                                                <input onchange="image_check(this, 1024)" title="upload logo images"
                                                                    required class="form-control" type="file" name="logo_image"
                                                                    placeholder="Enter logo"  value="{{$data->logo_image}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="optional"> Description</label>
                                                                <textarea type="text" class="form-control" placeholder="Enter name" name="description"  value="{{$data->description}}"></textarea>
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
                    
                                                        {{-- <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="optional"> Billing Header</label>
                                                                <textarea class="form-control" placeholder="Enter Billing details" name="billing_header"  value="{{$data->store_name}}"></textarea>
                                                            </div>
                                                        </div> --}}
                    
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Signature</label>
                                                                <input onchange="image_check(this, 1024)" title="upload signature"
                                                                    required class="form-control" type="file" name="signature"
                                                                    placeholder="Enter Signature"  value="{{$data->signature}}">
                                                            </div>
                                                        </div>
                    
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <div class="col-sm-12 text-center">
                                                <button type="button" class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i>Update Publisher </button>
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
<!-- // model -->