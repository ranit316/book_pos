<!-- The Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title">New {{ $page }}</h6>
                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"
                    class =""></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="form_data" action="" method="POST">
                    <div class="row">
                        @csrf

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="customer_id" class="required">Customer</label>
                                <select id="customer_id" required type="text" class="form-control selectpicker"
                                    data-live-search="true" placeholder="Enter  customer " name="customer_id">
                                    <option selected disabled> - Select customer - </option>
                                    @foreach ($customer as $cus)
                                        <option value="{{ $cus->id }}">{{ $cus->customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="product_id" class="required">Product</label>
                                <select id="product_id" required type="text" class="form-control selectpicker"
                                    data-live-search="true" placeholder="Enter  Product " name="product_id">
                                    <option selected disabled> - Select Products - </option>
                                    @foreach ($product as $pro)
                                        <option value="{{ $pro->id }}">{{ $pro->product->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                       


                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="status" class="required">Status</label>
                                <select id="status" required type="text" class="form-control"
                                    placeholder="Enter status " name="status">
                                    <option selected> - select status - </option>
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">InActive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 text-center">
                            <button type="button" onclick="" id="savebtn" class="btn btn-success btn-rounded"><i
                                    class="uil uil-check me-2"></i>Add {{ $page }}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- // model -->
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('#savebtn').click(function() {
            $('.clear_error_msg').html("");

            var form = $('#form_data')[0];
            
            // Collect form data using FormData
            var formData = new FormData(form);
            
            // Send AJAX request
            $.ajax({
                url: '{{ route('customer.save') }}', // Replace with your actual endpoint URL
                method: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    // Handle success response
                    console.log(response);

                    $('#staticBackdrop').modal('hide');
                    // $('#product_id .modal-content').empty();
                    $('.datatable').DataTable().draw();
                   $('#product_id').val('');
                   $('#customer_id').val('');
                    // if (response.success) {
                    //     swal("Success!", response.success, "success");
                    // }
                },
                error: function(error) {
                    // console.log(error);
                    if (error.responseJSON && error.responseJSON.errors) {
                        console.log(error.responseJSON.errors.name);
                        $('#product_id').html(error.responseJSON.errors.product_id);
                        $('#customer_id').html(error.responseJSON.errors.customer_id);
                    }
                    // Handle error response
                }
            });
        });
    });
</script>

