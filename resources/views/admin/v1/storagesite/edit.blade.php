<form id="form_update" action="{{ route('storagesites.update', $data->id) }}" method="POST">
    <div class="row">
        @csrf
        @method('PUT')
        <div class="col-sm-12">
            <div class="form-group">
                <label class="required">Name</label>
                <input required type="text" class="form-control" value="{{ $data->name }}"
                    placeholder="Enter Category Name" name="name">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label class="required">Address</label>
                <input required type="text" class="form-control" value="{{ $data->address }}" name="address">
            </div>
        </div>

       
        <div class="col-sm-12">
            <div class="form-group">
                <label class="optional" >pincode</label>
                <input value="{{ $data->picode}}" type="text" class="form-control" placeholder="Enter pincode" name="pincode">
            </div>
        </div>
        




        <div class="col-sm-12">
            <div class="form-group">
                <label class="optional"> Description</label>
                <textarea  type="text" class="form-control" placeholder="Enter description" name="description">{{ $data->description }}</textarea>
            </div>
        </div>
        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="required" >default</label>
                                <select class="form-control"  name="flag" >
                                  <option value="" {{ ($data->flag=='')?'selected':'' }}>No</option>
                                  <option value="default" {{ ($data->flag=='default')?'selected':'' }}>Yes</option>
                                </select>
                            </div>
                        </div>

        <div class="col-sm-12 text-center">
            <button type="button" onclick="ajaxCall('form_update')" class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i>Update
                {{ $pagename }}</button>
        </div>
    </div>

</form>
