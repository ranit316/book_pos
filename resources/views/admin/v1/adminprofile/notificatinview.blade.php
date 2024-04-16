<div class="row">
   
    <div class="col-sm-12">
        <div class="form-group">
            <label class="required"> User Name</label>
            <input value="{{ $editdata->pubnotic->store_name}}" required type="text" class="form-control"
                placeholder="Enter Store  Name" name="store_name" readonly>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label for="address" class="required">Message</label>
            <input value="{{ $editdata->message }}" required type="text" class="form-control" name="store_name" readonly>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label class="optional"> Create On</label>
            <textarea type="text" class="form-control" placeholder="Enter name" name="description" readonly>{{ $editdata->created_at }}</textarea>
        </div>
    </div>

</div>
