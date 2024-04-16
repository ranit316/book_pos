<form id="form_update" action="{{ route('gstslabs.update', $data->id) }}" method="POST">
    <div class="row">
        @csrf
        @method('PUT')
        <div class="col-sm-12">
            <div class="form-group">
                <label class="required">Title</label>
                <input required type="text" class="form-control" value="{{ $data->name }}"
                    placeholder="Enter GstSlab Name" name="name">
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label class="required" >Tax</label>
                <input  required type="number" class="form-control" value="{{$data->tax}}" placeholder="Enter tax" name="tax">
            </div>
        </div>

     

        <div class="col-sm-12">
            <div class="form-group">
                <label class="optional"> Description</label>
                <textarea required type="text" class="form-control" placeholder="Enter name" name="description">{{ $data->description }}</textarea>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">   
                        <option value="active" {{ $data->status == 'active' ? 'selected' : '' }}> active </option>
                        <option value="inactive" {{ $data->status == 'inactive' ? 'selected' : '' }}> inactive </option>
                </select>
            </div>
        </div>
        <?php if($data->is_default==0){ ?>
        <div class="col-sm-12">
            <div class="form-group">
                <label class="required"> Default</label>
                <select class="form-control"  name="is_default" >
                    <option value="0" {{ ($data->is_default==0)?'selected':'' }}>No</option>
                    <option value="1" {{ ($data->is_default==1)?'selected':'' }}>Yes</option>
                </select>
            </div>
        </div>
        <?php } ?>

        <div class="col-sm-12 text-center">
            <button type="button" onclick="ajaxCall('form_update')" class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i>Update
                {{ $page }}</button>
        </div>
    </div>

</form>
