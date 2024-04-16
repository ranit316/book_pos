<x-layout>
    @slot('title', $page)
    @slot('body')




        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title"> User {{ $page }} </h4>
                                    </div>  
                                </div>

                                <div class="card-body">
                                    
                                    <form  action="{{ route('profile.update',[$data->id])}}" method="POST">
                                        @csrf
                                        <div class="row">
                                    
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="required">Name</label>
                                                <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{$data->name }}">
                                            </div>
                                        </div>
                                    
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="required">Email</label>
                                                <input type="text" class="form-control" placeholder="Enter Email" name="email" value="{{$data->email}}" readonly>
                                            </div>
                                        </div>
                                    
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="required">Phone</label>
                                                <input type="text" class="form-control" placeholder="Enter Phone" name="phone" value="{{$data->phone}}">
                                            </div>
                                        </div>
                                    
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="required">Address</label>
                                                <input type="text" class="form-control" placeholder="Enter Address" name="address" value="{{$data->address }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="required">Status</label><br>
                                                @if ($data->status == 'active') 
                                                   <span class='badge bg-success'>Active</span>
                                                @else 
                                                   <span class='badge bg-danger'>Block</span>
                                                    
                                                 @endif   
                                                {{-- <span class="badge bg-danger">{{$data->status}}</span> --}}
                                                {{-- <select class="form-control" name="status">
                                                <option value="active" {{ $data->status == 'active' ? 'selected' : '' }}>  Active </option>
                                                <option value="inactive" {{ $data->status == 'inactive' ? 'selected' : '' }}>  Block </option>
                                                </select> --}}
                                            </div>
                                        </div>
                                    
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="">Password</label>
                                                <input type="password" class="form-control" placeholder="Enter Address" name="password" value="">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-primary mt-2">Update User</button>
                                        </div>
                                        
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

        <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="edit">Edit {{ $page }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="edit_form">

                    </div>

                </div>
            </div>
        </div>
    @endslot
</x-layout>
