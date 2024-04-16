<!-- The Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title">New {{$page}}</h6>
                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close" class =""></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="form_data" action="{{route('admin.sub.unit')}}" method="POST">
                    <div class="row">
                        @csrf
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="required">Name</label>
                                <input  type="text" class="form-control" placeholder="Enter Unit Name" name="name" required = "required"/>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                      
                       
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="status" class="required">Status</label>
                                <select id="unit" required type="text" class="form-control"
                                    placeholder="Enter status " name="status">
                                    <option selected> - select status - </option>
                                    {{-- @foreach ($units as $unit) --}}
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">InActive</option>
                                    {{-- @endforeach --}}
                                </select>
                            </div>
                        </div>


                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="optional"> Description</label>
                                <textarea  type="text" class="form-control" placeholder="Enter name" name="description"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-12 text-center">
                            <button type="button" onclick="unit_add()"
                                class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i>Add {{$page}}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- // model -->
<script>


function unit_add() {
    var form = document.getElementById('form_data');
    var url_name = form.action;
    var method = "POST";
    var formdata = new FormData(form);

    // Remove existing error messages
    var errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(function (errorMessage) {
        errorMessage.remove();
    });

    // Perform form validation
    var requiredFields = form.querySelectorAll('[required]');
    var isValid = true;

    requiredFields.forEach(function (field) {
        if (!field.value.trim()) {
            isValid = false;
            showErrorMessage(field, 'This field is required.');
        }
    });

    if (!isValid) {
        return; // Prevent form submission
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            location.reload();
        }
    };
    xhttp.open(method, url_name, true);
    xhttp.send(formdata);
}

function showErrorMessage(field, message) {
    var errorMessage = document.createElement('div');
    errorMessage.className = 'error-message text-danger';
    errorMessage.textContent = message;

    // Insert the error message after the field
    field.parentNode.appendChild(errorMessage);
}
</script>