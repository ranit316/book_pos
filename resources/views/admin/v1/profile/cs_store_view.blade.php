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
                                        <h4 class="card-title">Central Store Edit</h4>
                                    </div>  
                                </div>

                                <div class="card-body">
                                
                                <form action="{{ route('profile.cs.update',[$cs_store->id])}}" name="app_setting" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class= "row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="required">Store Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{$cs_store->store_name }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="required">State</label>
                                            <select id="state_id" required type="text" class="form-control" placeholder="Enter  District " name="state_id">
                                            <option value="West Bengal"><strong>West Bengal</strong> </option>
                                        </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="required">District</label>
                                            <select id="district" required class="form-control selectpicker" data-live-search="true" name="district">
                                                <option selected disabled> - Select District - </option>
                                                @foreach ($districts as $district)
                                                <option value="{{ $district->id }}" {{ $cs_store->district_id == $district->id ? 'selected' : '' }}>
                                                    <strong>{{ $district->name }}</strong> -
                                                    <span class="text-red">{{ $district->state }}</span>
                                                </option>
                                                @endforeach
                                            </select>                                        
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="required"> Email</label>
                                            <input type="text" class="form-control" placeholder="Enter Name" name="email" value="{{$user->email }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="required">Address</label>
                                            <input type="text" class="form-control" placeholder="Enter Name" name="address" value="{{$cs_store->address }}" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="required">Logo</label>
                                            <input onchange="image_check(this, 100)" type="file" class="form-control"
                                            value="{{ $cs_store->logo_image ?? '' }}" name="logo"
                                            id="app_logo">
                                        @if (!empty($cs_store->logo_image))
                                            <img src="{{ url($cs_store->logo_image) }}"
                                                class="img-thumbnail my-2" height="150" width="150">
                                        @endif
                                        </div>
                                    </div>

                                    {{-- <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="required">Status</label>
                                            <select class="form-control" name="status">
                                            <option value="active" {{ $cs_store->status == 'active' ? 'selected' : '' }}>  Active </option>
                                            <option value="inactive" {{ $cs_store->status == 'inactive' ? 'selected' : '' }}>  Block </option>
                                            </select>
                                        </div>
                                    </div> --}}

                                </div>

                                      
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i>Update Changes</button>
                                </div>
                            </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Button trigger modal -->
                </div>
            </div>
        </div>
        @include('admin.v1.discount.add')
    @endslot
</x-layout>
