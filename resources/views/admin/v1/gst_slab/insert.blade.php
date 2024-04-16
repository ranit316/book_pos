<!-- The Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title">Add {{$page}}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="form_data" action="{{ route('gstslabs.store') }}" method="POST">
                    <div class="row">
                        @csrf
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="required" >Title</label>
                                <input required type="text" class="form-control"    placeholder="Enter Gstslab Name" name="name">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="required" >Tax</label>
                                <input  required type="number" class="form-control" placeholder="Enter tax" name="tax">
                            </div>
                        </div>
              

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="optional"> Description</label>
                                <textarea  type="text" class="form-control" placeholder="Enter name" name="description"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="required"> Default</label>
                                <select class="form-control"  name="is_default" >
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 text-center">
                            <button type="button" onclick="ajaxCall('form_data')"
                                class="btn btn-success btn-rounded"> <i class="uil uil-check me-2"></i>Add {{$page}}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- // model -->
