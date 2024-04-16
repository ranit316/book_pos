    <div class="row">
        @csrf
        @method('post')
        {{--   <div class="col-sm-4">
            <div class="form-group">
                <label class="required">Name</label>
                {{ $data->name }}
            </div>
        </div> --}}

        <div class="col-sm-4">
            <div class="form-group">
                <label class="required">Name</label>
                <input type="text" class="form-control" readonly placeholder="Enter Name" name=" name"
                    value="{{ $data->name }}">
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label class="required">Email</label>
                <input type="text" class="form-control" readonly placeholder="Enter Name" name=" name"
                    value="{{ $data->email }}">
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label class="required">Phone</label>
                <input type="text" class="form-control" readonly placeholder="Enter Name" name=" name"
                    value="{{ $data->phone }}">
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label class="required">Type</label>
                <input type="text" class="form-control" readonly placeholder="Enter Name" name=" name"
                    value="{{ $data->type }}">
            </div>
        </div>
    </div>
