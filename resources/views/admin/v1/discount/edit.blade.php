<form id="form_update" action="{{ route('discount.update', $data->id) }}" method="POST">
    <div class="row">
        @csrf
        @method('PUT')
       

        <div class="col-sm-6">
            <div class="form-group">
                <label class="required">Title</label>
                <input type="text" required class="form-control" placeholder="Enter Name"
                    name="name" id="name" value="{{ $data->name }}">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="required">Discount %</label>
                <input type="number" required class="form-control" placeholder="Enter Discount %"
                    name="discount" id="discount"  value="{{ $data->discount }}" >
            </div>
        </div>
       
        <div class="col-sm-6">
            <div class="form-group">
                <label class="required">Min Amount</label>
                <input type="number" required class="form-control" placeholder="Enter Min Amount" name="min"  value="{{ $data->min }}">
            </div>
        </div>


        <div class="col-sm-6">
            <div class="form-group">
                <label class="required">Coupon Code</label>
                <input type="text" class="form-control" placeholder="Coupon code" name="coupon_code"
                    id="coupon_code"  required  value="{{ $data->coupon_code }}">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="required">Status</label>
                <select class="form-control"  name="status" >
                    <option value="active" {{ ($data->status=='active')?'selected':'' }}>Active</option>
                    <option value="inactive" {{ ($data->status=='inactive')?'selected':'' }}>Inactive</option>
                </select>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label class="optional"> Description</label>
                <textarea type="text" class="form-control" placeholder="Enter name" name="description" id="description">{{ $data->description }}</textarea>
            </div>
        </div>

       
        <div class="col-sm-12 text-center">
            <button type="button" onclick="ajaxCall('form_update')" class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i>Update
                {{ $page }}</button>
        </div>
    </div>

</form>
